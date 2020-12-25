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

        @if($type === \App\Models\Product::TYPE_SINGLE_PRODUCT)
            <form action="{{ route('admin.product.updateSingleProduct', ['id' => $modelProduct->id]) }}" method="POST" enctype="multipart/form-data">
        @elseif($type === \App\Models\Product::TYPE_PRODUCT_WITH_MODIFICATIONS_AND_UNITS)
            <form action="{{ route('admin.product.updateProductWithModificationsAndUnits', ['id' => $modelProduct->id]) }}" method="POST" enctype="multipart/form-data">
        @elseif($type === \App\Models\Product::TYPE_REDIRECT_LINK)
            <form action="{{ route('admin.product.updateProductWithModificationsAndUnits', ['id' => $modelProduct->id]) }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf
            @method('PUT')
            @includeWhen(
                $type === \App\Models\Product::TYPE_SINGLE_PRODUCT,
                'admin.product.form_single_product',
                [
                    'modelProduct' => $modelProduct,
                    'modelsProductCategory' => $modelsProductCategory,
                ]
            )
            @includeWhen(
                $type === \App\Models\Product::TYPE_PRODUCT_WITH_MODIFICATIONS_AND_UNITS,
                'admin.product.form_product_with_modifications_and_units',
                [
                    'modelProduct' => $modelProduct,
                    'modelsProductCategory' => $modelsProductCategory,
                ]
            )
            <button type="submit" class="btn btn-success">Отправить</button>
        </form>
    </div>
@endsection
