@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
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

<div class ="main-content">
<!-- TodoForm Block -->
  <div class="todo-form-block">
    <div class="section__title">
      <h2>新規作成</h2>
    </div>
    <form class="todo-form" action="/todos" method="POST">
      @csrf
        <div class="todo-form__item">
            <input class="todo-form__item--input" type="text" name="content" value="{{ old('content') }}" >
            <select class="todo-form__item--select" name ="category_id">
              <option value="">カテゴリ</option>
              @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
            <button class="todo-form__item--submit" type="submit">作成</button>
        </div>
    </form>
  </div>
<!-- SearchForm Block -->
  <div class="search-form-block">
    <div class="section__title">
      <h2>Todo検索</h2>
    </div>
    <form class="search-form" action="/todos/search" method="get">
    @csrf
      <div class="search-form__item">
        <input class="search-form__item--input" type="text" name="keywword" value="{{ old('keyword') }}" >
        <select class="search-form__item--select" name ="category_id">
          <option value="">カテゴリ</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
        <button class="search-form__item--submit" type="submit">検索</button>
      </div>
  </form>
  </div>

<!-- TodoList Block -->
  <div class="todo-list">
    <table class="todo-list__table">
      <tr>
        <th class="todo-list__header">
          <span class="todo-list__title">Todo</span>
          <span class="todo-list__title--category">カテゴリ</span>
          <p class="todo-list__title--button"></p>
        </th>
      </tr>
      @foreach ($todos as $todo)
      <tr class="todo-list__table--row">
        <td class="todo-list__table-content">
          <form class="update-form" action="/todos/update" method="post">
          @csrf
          @method('PATCH')
            <input type="hidden" name="id" value="{{ $todo->id }}">
            <input class="update-form__item" type="text" name="content" value="{{ $todo->content }}">
            <p class="update-form__category" >{{ $todo['category']['name']}}</p>
            <button class="update-form__button-submit" type="submit">更新</button>
          </form>
          <form class="delete-form" action="/todos/delete" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $todo->id }}">
            <button class="delete-form__button-submit" type="submit">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>

</div>
@endsection