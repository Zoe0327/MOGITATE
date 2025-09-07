<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        return view('product', compact('products'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $sort = $request->input('sort');

        $query = Product::query();
        //検索キーワード・部分一致で絞込み
        if ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        }

        //並べ替え条件
        if ($sort == 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort == 'desc') {
            $query->orderBy('price', 'desc');
        }
        $products = $query->paginate(6)->appends($request->all());


        return view('product', compact('products'));
    }
    public function detail($id)
    {
    $product = Product::findOrFail($id);
    $seasons = Season::all();
    return view('detail', compact('product', 'seasons'));
    }


    public function register()
    {
        return view('register');
    }

    public function store(ProductRequest $request)
    {
        //1.バリデーション //ProductRequestで設定済み

        //2.画像の保存とパスの取得
        if ($request->hasFile('image')) {
            // 元のファイル名を取得
            $originalName = $request->file('image')->getClientOriginalName();
            // 保存先：storage/app/public/img に元の名前で保存
            $request->file('image')->storeAs('public/img', $originalName);
            $imagePath = $originalName; // DB にはファイル名だけ保存
        } else {
            $imagePath = null; // 画像なしの場合
        }

        //3.データベースへの保存
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image_path' => $imagePath,
            'detail' => $request->detail,
        ]);
        if ($request->has('seasons')) {
            $product->seasons()->attach($request->input('seasons'));
        }

        return redirect()->route('products.search')->with('success', '商品が正常に登録されました。');
    }

        //商品情報を更新する
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image_path);
            $imagePath = $request->file('image')->store('img', 'public');
        } else {
            $imagePath = $product->image_path;
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'image_path' => $imagePath,
            'detail' => $request->detail,
        ]);

        $product->seasons()->sync($request->input('seasons'));

        return redirect()->route('products.search')->with('success', '商品情報が正常に更新されました。');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Storage::disk('public')->delete($product->image_path);

        $product->delete();

        return redirect()->route('products.search')->with('success', '商品が正常に削除されました。');
    }
}
