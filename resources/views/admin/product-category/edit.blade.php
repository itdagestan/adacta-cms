<?php
/** @var \App\DataTransferObjects\ProductCategoryDTO $productCategoryDTO */
/** @var \App\Models\ProductCategory[] $modelsProductCategory */
?>
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
        <form action="{{ route('admin.product-category.update', $productCategoryDTO->getId()) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.product-category._form', [
                'productCategoryDTO' => $productCategoryDTO,
                'modelsProductCategory' => $modelsProductCategory,
            ])
            <button type="submit" class="btn btn-success">Отправить</button>
        </form>
    </div>
@endsection
