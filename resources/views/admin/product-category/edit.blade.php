@extends('layouts.admin')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-11">
                <h2>Добавление категории</h2>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Упс!</strong> Ошибки при вводе.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.product-category.update', $modelProductCategory->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Название:</label>
                <input type="text" class="form-control" id="name" placeholder="Введите название" name="name" value="{{ $modelProductCategory->name }}">
            </div>
            <div class="form-group">
                <label for="slug">ЧПУ:</label>
                <input type="text" class="form-control" id="slug" placeholder="Введите ЧПУ" name="slug" value="{{ $modelProductCategory->slug }}">
            </div>
            <div class="form-group">
                <label for="is_visible">Виден:</label>
                <input type="checkbox" class="" id="is_visible" name="is_visible"  value="{{ $modelProductCategory->is_visible }}" checked>
            </div>
            <button type="submit" class="btn btn-success">Отправить</button>
        </form>
    </div>
@endsection
