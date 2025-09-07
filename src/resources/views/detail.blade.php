@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection
@section('content')
<div class="detail__form">
    <div class="form__header">
        <div class="product__list">商品一覧</div>
        <div class="product__name">＞ {{ $product->name }}</div>
    </div>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form__detail">
            <div class="detail__img">
                <div class="detail__img-img">
                    <img src="{{ asset('storage/img/' . $product->image_path) }}" alt="{{ $product->name }}">
                </div>
                <label class="custom-file-upload">
                    <input type="file" name="image" accept="image/*" onchange="previewImage(event)">
                    <span>ファイルを選択</span>
                </label>
                <div class="form__error" style="color:red;">
                    @error('image')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="detail__text">
                <div class="detail__name">
                    <div class="detail__name-title"><p>商品名</p></div>
                    <div class="detail__name-input">
                        <input type="text" name="name" value="{{ old('name', $product->name) }}">
                        <div class="form__error" style="color:red;">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="detail__price">
                    <div class="detail__price-title"><p>値段</p></div>
                    <div class="detail__price-input">
                        <input type="number" name="price" value="{{ old('price', $product->price) }}">
                        <div class="form__error" style="color:red;">
                        @error('price')
                        {{ $message }}
                        @enderror
                        </div>
                    </div>
                </div>
                <div class="detail__season">
                    <div class="detail__season-title"><p>季節</p></div>
                    <div class="detail__season-checkbox">
                        @foreach($seasons as $season)
                            <label>
                                <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                                    {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                                {{ $season->name }}
                            </label>
                        @endforeach
                        <div class="form__error" style="color:red;">
                            @error('seasons')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="detail__textarea">
            <div class="detail__textarea-title"><p>商品説明</p></div>
            <div class="detail__textarea-text">
                <textarea name="detail">{{ old('detail', $product->detail) }}</textarea>
                <div class="form__error" style="color:red;">
                    @error('detail')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="detail__btn">
            <div class="btn__center">
                <div class="btn__return-wrapper">
                    <a href="{{ route('products.search') }}" class="btn__back">戻る</a>
                </div>
                <div class="btn__update-wrapper">
                    <button class="btn__update" type="submit">変更を保存</button>
                </div>
            </div>
            <button type="button" class="btn__delete-icon" onclick="document.getElementById('delete-form').submit();">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </div>
    </form>
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: none;" id="delete-form">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');
        const reader = new FileReader();

        reader.onload = (e) => {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
</script>
@endsection