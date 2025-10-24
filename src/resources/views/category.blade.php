@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}">
@endsection


@section('content')
<!-- TopComment Block -->
  <div class="top-comment">
    @if ($errors ->any())
        <ul class="top-comment__errors">
            @foreach ($errors->all() as $error)
                <li class="top-comment__error">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @if (session('success'))
        <p class="top-comment__success">{{ session('success') }}</p>
    @endif
  </div>
<!-- CategoryList Block -->
    <div class="category-list">
        <form class="category-list__form" action="/categories" method="POST">
        @csrf
          <div class="category-list__form--item">
            <input class="category-list__form--input" type="text" name="name" value="{{ old('name') }}" >
            <button class="category-list__form--submit" type="submit">作成</button>
          </div>
        </form>
        <table class="category-list__table">
            <tr class="category-list__table--header">
                <th class="category-list__table--header-item">Category</th>
            </tr>
            @foreach ($categories as $category)
            <tr class="category-list__table--row">
                <td class="category-list__table--row-item">
                    <form class ="update-form" action="/categories/update" method="POST">
                    @csrf
                    @method('PATCH')
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <input class="update-form__item" type="text" name="name" value="{{ $category->name }}">
                        <button class="update-form__button-submit" type="submit">更新</button>
                    </form> 
                    <form class ="delete-form" action="/categories/delete" method="POST">
                    @csrf
                    @method('DELETE')
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <button class="delete-form__button-submit" type="submit">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection