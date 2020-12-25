@extends('layouts.admin')
@section('content')
    <div class="row mt-4">
        <div class="col-md-12 col-md-offset-2">
            <a href="{{ route('admin.product-category.create') }}" class="btn btn-success mb-2">
                Создать категорию товара
            </a>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Виден</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($modelsProductCategories as $modelProductCategories)
                            <tr>
                                <td>{{ $modelProductCategories->id }}</td>
                                <td>{{ $modelProductCategories->name }}</td>
                                <td>{{ $modelProductCategories->is_visible }}</td>
                                <td>
                                    <a href="{{ route('admin.product-category.show', $modelProductCategories) }}" class="">Посмотреть</a>
                                    <a href="{{ route('admin.product-category.edit', $modelProductCategories) }}" class="">Изменить</a>
                                    <a type="submit" class="" onclick="event.preventDefault();
                                            document.getElementById('delete-item').submit();">Удалить</a>
                                    <form id="delete-item" action="{{ route('admin.product-category.destroy', $modelProductCategories->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
