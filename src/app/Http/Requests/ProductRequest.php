<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) { // 追加画面用
            return [
                'name' => 'required|string|max:255',
                'price' => 'required|integer|min:0|max:10000',
                'image' => 'required|image|mimes:jpeg,png',
                'seasons' => 'required|array|min:1',
                'seasons.*' => 'integer|exists:seasons,id',
                'detail' => 'required|string|max:120',
        ];
    } elseif ($this->isMethod('put')) { // 編集（詳細画面）用
        return [
                'name' => 'required|string|max:255',
                'price' => 'required|integer|min:0|max:10000',
                'image' => 'nullable|image|mimes:jpeg,png', // 編集時は画像は任意
                'seasons' => 'required|array|min:1',
                'seasons.*' => 'integer|exists:seasons,id',
                'detail' => 'required|string|max:120',
        ];
    }
}

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.integer' =>'数値で入力してください',
            'price.min' => '0～10000円以内で入力してください',
            'price.max' => '0～10000円以内で入力してください',
            'seasons.required' => '季節を選択してください',
            'detail.required' => '商品説明を入力してください',
            'detail.max' => '120文字以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
        ];
    }
}
