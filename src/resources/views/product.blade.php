@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection
@section('content')

<div class="product__catalog">
    <div class="product__catalog-header">
        <div class="product__catalog-title">
            <h2>商品一覧</h2>
        </div>
        <div class="product__catalog-add">
            <a href="{{ route('products.register') }}" class="product__catalog-add-button">＋商品を追加</a>
        </div>
    </div>
    <div class="product__catalog-inner">
        <div class="product__search">
            <div class="search__class">
                <form action="{{ route('products.search') }}" method="GET">
                    <div class="search__name">
                        <div class="search__input--text">
                            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名で検索">
                        </div>
                        <div class="search__error">
                            @error('keyword')
                            {{ $message }}
                            @enderror
                        </div>
                        <div class="search__input--button">
                            <button class="search__button-submit" type="submit">検索</button>
                        </div>
                    </div>
                    <div class="search__table">
                        <p>価格順で表示</p>
                        <select class="search__item--select" name="sort" onchange="this.form.submit()">
                            <option value="" {{ request('sort') == '' ? 'selected' : '' }}>価格で並べ替え</option>
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>低い順に表示</option>
                        </select>
                    </div>
                </form>
                <div class="sort-tags">
                    @if(!empty(request('sort')))
                    <span class="sort-tag">
                    @if(request('sort') == 'desc')
                        高い順に表示
                    @else
                        低い順に表示
                    @endif
                        <a href="{{ route('products.search', array_filter(['keyword' => request('keyword')])) }}" class="tag-close">×</a>
                    </span>
                    @endif
                </div>
            </div>
            <div class="search__list-container">
                <div class="search__list">
                    @foreach($products as $product)
                    <a href="{{ route('products.detail', ['productId' => $product->id]) }}" class="product-link">
                        <div class="search__list--display">
                            <div class="search__list--display-img">
                                <img src="{{ asset('storage/img/' . $product->image_path) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="search__list--display-item">
                                <h3 class="item-name">{{ $product->name }}</h3>
                                <p class="item-price">￥{{ number_format($product->price) }}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection