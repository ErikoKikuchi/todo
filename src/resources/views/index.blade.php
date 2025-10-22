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

<!-- TodoForm Block -->
    <form class="todo-form" action="/todos" method="POST">
      @csrf
        <div class="todo-form__item">
            <input class="todo-form__item--input" type="text" name="content">
            <button class="todo-form__item--submit" type="submit">作成</button>
        </div>
    </form>

<!-- TodoList Block -->
  <div class="todo-list">
    <h2 class="todo-list__title">Todo</h2>
    <table class="todo-list__table">
      @foreach ($todos as $todo)
        <tr class="todo-list__table--row">
          <td class="todo-list__table-content">
            <form class="update-form" action="/todos/update" method="post">
             @csrf
              @method('PATCH')
              <input type="hidden" name="id" value="{{ $todo->id }}">
              <input class="update-form__item" type="text" name="content" value="{{ $todo->content }}">
              <button class="update-form__button-submit" type="submit">更新</button>
            </form>
          </td>
          <td class="todo-list__table-content">
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


@endsection