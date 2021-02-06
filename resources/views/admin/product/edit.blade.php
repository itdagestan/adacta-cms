<?php
/** @var string $type */
/** @var \App\DataTransferObjects\SingleProductDTO $productDTO */
/** @var \App\DataTransferObjects\UnitDTO[] $unitDTOAsArray */
/** @var \App\DataTransferObjects\ModificationDTO[] $modificationDTOAsArray */
/** @var \App\Models\ProductCategory[] $modelsProductCategory */
/** @var array $modificationsPriceTypeEnum */
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

        @if($type === \App\Models\Product::TYPE_SINGLE_PRODUCT)
            <form action="{{ route('admin.product.updateSingleProduct', ['id' => $productDTO->getId()]) }}" method="POST" enctype="multipart/form-data">
        @elseif($type === \App\Models\Product::TYPE_PRODUCT_WITH_MODIFICATIONS_AND_UNITS)
            <form action="{{ route('admin.product.updateProductWithModificationsAndUnits', ['id' => $productDTO->getId()]) }}" method="POST" enctype="multipart/form-data">
        @elseif($type === \App\Models\Product::TYPE_PRODUCT_REDIRECT_LINK)
            <form action="{{ route('admin.product.updateProductRedirectLink', ['id' => $productDTO->getId()]) }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf
            @method('PUT')
                @includeWhen(
                    $type === \App\Models\Product::TYPE_SINGLE_PRODUCT
                    || $type === \App\Models\Product::TYPE_PRODUCT_WITH_MODIFICATIONS_AND_UNITS
                    || $type === \App\Models\Product::TYPE_PRODUCT_REDIRECT_LINK,
                    'admin.product.form_single_product',
                    [
                        'productDTO' => $productDTO,
                        'modelsProductCategory' => $modelsProductCategory,
                    ]
                )
                @includeWhen(
                    $type === \App\Models\Product::TYPE_PRODUCT_WITH_MODIFICATIONS_AND_UNITS,
                    'admin.product.form_product_with_modifications_and_units',
                    [
                        'unitDTOAsArray' => $unitDTOAsArray,
                        'modificationDTOAsArray' => $modificationDTOAsArray,
                        'modificationsPriceTypeEnum' => $modificationsPriceTypeEnum,
                    ]
                )
                @includeWhen(
                    $type === \App\Models\Product::TYPE_PRODUCT_REDIRECT_LINK,
                    'admin.product.form_product_redirect_link',
                    ['productDTO' => $productDTO]
                )
            <button type="submit" class="btn btn-success">Отправить</button>
        </form>
    </div>
@endsection
