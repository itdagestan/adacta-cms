<?php
/** @var string $type */
/** @var \App\DataTransferObjects\SingleProductDTO $productDTO */
/** @var \App\DataTransferObjects\UnitDTO[] $unitDTOAsArray */
/** @var \App\DataTransferObjects\ModificationDTO[] $modificationDTOAsArray */
/** @var string $modificationsPriceTypeOne */
?>
@extends('layouts.admin')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-11">
                <h2>Добавление товара</h2>
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
            <form action="{{ route('admin.product.storeSingleProduct') }}" method="POST" enctype="multipart/form-data">
        @elseif($type === \App\Models\Product::TYPE_PRODUCT_WITH_MODIFICATIONS_AND_UNITS)
            <form action="{{ route('admin.product.storeProductWithModificationsAndUnits') }}" method="POST" enctype="multipart/form-data">
        @elseif($type === \App\Models\Product::TYPE_PRODUCT_REDIRECT_LINK)
            <form action="{{ route('admin.product.storeProductRedirectLink') }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf
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
                    'modificationsPriceTypeOne' => $modificationsPriceTypeOne,
                ]
            )
            @includeWhen(
                $type === \App\Models\Product::TYPE_PRODUCT_REDIRECT_LINK,
                'admin.product.form_product_redirect_link',
                ['productDTO' => $productDTO]
            )
            <button class="btn btn-success" type="submit">Отправить</button>
        </form>
            <br>
    </div>
@endsection
