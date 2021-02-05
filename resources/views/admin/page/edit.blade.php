<?php
/** @var \App\DataTransferObjects\PageDTO $pageDTO */
?>
@extends('layouts.admin')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-11">
                <h2>Изменение страницы</h2>
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
        <form action="{{ route('admin.page.update', $pageDTO->getId()) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.page._form', [
                'pageDTO' => $pageDTO,
            ])
            <button type="submit" class="btn btn-success">Отправить</button>
        </form>
    </div>
@endsection
