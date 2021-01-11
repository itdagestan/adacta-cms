@extends('layouts.admin')
@section('content')
    <div class="row mt-4">
        <div class="col-md-12 col-md-offset-2">
            <a href="{{ route('admin.product.create', ['type' => \App\Models\Product::TYPE_SINGLE_PRODUCT]) }}" class="btn btn-success mb-2">
                Создать одиночный товар
            </a>
            <a href="{{ route('admin.product.create', ['type' => \App\Models\Product::TYPE_PRODUCT_WITH_MODIFICATIONS_AND_UNITS]) }}" class="btn btn-success mb-2">
                Создать товар с тиражом и модификациями
            </a>
            <a href="{{ route('admin.product.create', ['type' => \App\Models\Product::TYPE_PRODUCT_REDIRECT_LINK]) }}" class="btn btn-success mb-2">
                Создать товар-ссылку
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
                        @foreach($modelsProduct as $modelProduct)
                            <tr>
                                <td>{{ $modelProduct->id }}</td>
                                <td>{{ $modelProduct->name }}</td>
                                <td>{{ $modelProduct->is_visible }}</td>
                                <td>
                                    <a href="{{ route('admin.product.show', $modelProduct->id) }}" class="">Посмотреть</a>
                                    <a href="{{ route('admin.product.edit', $modelProduct->id) }}" class="">Изменить</a>
                                    <a type="submit" class="" onclick="event.preventDefault();
                                            document.getElementById('delete-item').submit();">Удалить</a>
                                    <form id="delete-item" action="{{ route('admin.product.destroy', $modelProduct->id) }}" method="POST" class="d-none">
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
            {{ $modelsProduct->links('admin.paginator.paginator') }}
        </div>
    </div>
@endsection
