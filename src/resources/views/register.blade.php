@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection
@section('content')
<div class="register-form">
    <div class="register-form__content">
        <div class="register-form__heading">
            <h2>商品登録</h2>
        </div>
        <form class="form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <label class="contact-form__label" for="name">
                        商品名<span class="contact-form__required">必須</span>
                    </label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="商品名を入力">
                    </div>
                    <div class="form__error">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label class="contact-form__label" for="price">
                        値段<span class="contact-form__required">必須</span>
                    </label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="値段を入力">
                    </div>
                    <div class="form__error">
                        @error('price')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label class="contact-form__label" for="image">
                        商品画像<span class="contact-form__required">必須</span>
                    </label>
                </div>
                <div class="form__group-content">
                    <div class="image-preview" style="margin-top:10px;">
                        <img id="preview" src="" alt="プレビュー画像" style="max-width: 200px; display:none;">
                        <script src="{{ asset('js/register.js') }}"></script>
                    </div>
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                    <div class="form__error">
                    @error('image')
                    {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label class="contact-form__label">
                        季節<span class="contact-form__required">必須</span>
                        <span class="contact-form__select">複数選択可</span>
                    </label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--checkbox">
                        <label>
                            <input type="checkbox" name="seasons[]" value="1"
                                {{ (is_array(old('seasons')) && in_array(1, old('seasons'))) ? 'checked' : '' }}>
                            春
                        </label>
                        <label>
                            <input type="checkbox" name="seasons[]" value="2"
                                {{ (is_array(old('seasons')) && in_array(2, old('seasons'))) ? 'checked' : '' }}>
                            夏
                        </label>
                        <label>
                            <input type="checkbox" name="seasons[]" value="3"
                                {{ (is_array(old('seasons')) && in_array(3, old('seasons'))) ? 'checked' : '' }}>
                            秋
                        </label>
                        <label>
                            <input type="checkbox" name="seasons[]" value="4"
                                {{ (is_array(old('seasons')) && in_array(4, old('seasons'))) ? 'checked' : '' }}>
                            冬
                        </label>
                    </div>
                    <div class="form__error">
                        @error('seasons')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label class="contact-form__label" for="description">
                        商品説明<span class="contact-form__required">必須</span>
                    </label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <textarea id="detail" name="detail" placeholder="商品の説明を入力">{{ old('detail') }}</textarea>
                    </div>
                    <div class="form__error">
                        @error('detail')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group-button">
                <a href="{{ route('products.search') }}" class="btn-back">戻る</a>
                <button class="btn-submit" type="submit">登録</button>
            </div>
        </form>
    </div>
</div>

@endsection