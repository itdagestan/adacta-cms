@extends('layouts.admin')
@section('content')
    <div class="row mt-4">
        <div class="col-md-12 col-md-offset-2">
            <a href="{{ route('admin.page.create') }}" class="btn btn-success mb-2">
                Создать страницу
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
                        @foreach($modelsPage as $modelPage)
                            <tr>
                                <td>{{ $modelPage->id }}</td>
                                <td>{{ $modelPage->name }}</td>
                                <td>{{ $modelPage->is_visible }}</td>
                                <td>
                                    <a href="{{ route('admin.page.show', $modelPage->id) }}" class="">Посмотреть</a>
                                    <a href="{{ route('admin.page.edit', $modelPage->id) }}" class="">Изменить</a>
                                    <a type="submit" class="" onclick="event.preventDefault();
                                            document.getElementById('delete-item').submit();">Удалить</a>
                                    <form id="delete-item" action="{{ route('admin.page.destroy', $modelPage->id) }}" method="POST" class="d-none">
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
