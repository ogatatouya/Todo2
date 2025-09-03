@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<div class="category__alert">
  @if (session('message'))
  <div class="category__alert--success">
    {{ session('message') }}
  </div>
  @endif

  @if ($errors->any())
  <div class="category__alert--danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>

<div class="category__content">
  {{-- 作成フォーム --}}
  <form class="create-form" action="{{ route('categories.store') }}" method="post">
    @csrf
    <div class="create-form__item">
      <input class="create-form__item-input" type="text" name="name" value="{{ old('name') }}">
    </div>
    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">作成</button>
    </div>
  </form>

  {{-- 一覧表示 --}}
  <div class="category-table">
    <table class="category-table__inner">
      <tr class="category-table__row">
        <th class="category-table__header">category</th>
        <th class="category-table__header">操作</th>
      </tr>
      @foreach ($categories as $category)
      <tr class="category-table__row">
        <td class="category-table__item">
          {{-- 更新フォーム --}}
          <form class="update-form" action="{{ route('categories.update', $category->id) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="update-form__item">
              <input class="update-form__item-input" type="text" name="name" value="{{ $category->name }}">
            </div>
            <div class="update-form__button">
              <button class="update-form__button-submit" type="submit">更新</button>
            </div>
          </form>
        </td>
        <td class="category-table__item">
          {{-- 削除フォーム --}}
          <form class="delete-form" action="{{ route('categories.destroy', $category->id) }}" method="post">
            @csrf
            @method('DELETE')
            <div class="delete-form__button">
              <button class="delete-form__button-submit" type="submit"
                onclick="return confirm('本当に削除しますか？');">削除</button>
            </div>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection