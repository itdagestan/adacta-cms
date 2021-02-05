<?php
/** @var \App\DataTransferObjects\SingleProductDTO $productDTO */
?>
<div class="form-group">
    <label for="name">Название:</label>
    <input value="{{ $productDTO->getName() }}" type="text" class="form-control" id="name" placeholder="Введите название" name="name">
</div>
<div class="form-group">
    <label for="slug">ЧПУ:</label>
    <input value="{{ $productDTO->getSlug() }}" type="text" class="form-control" id="slug" placeholder="Введите ЧПУ" name="slug">
</div>
<div class="form-group">
    <label for="price_old">Старая цена:</label>
    <input value="{{ $productDTO->getPriceOld() }}" type="text" class="form-control" id="price_old" placeholder="Введите старую цену" name="price_old">
</div>
<div class="form-group">
    <label for="price_new">Новая цена:</label>
    <input value="{{ $productDTO->getPriceNew() }}" type="text" class="form-control" id="price_new" placeholder="Введите новую цену" name="price_new">
</div>
<div class="form-group">
    <label for="category_id">Категория:</label>
    <select class="form-control" id="category_id" name="category_id">
        <option value="">Выберите категорию</option>
        @foreach($modelsProductCategory as $modelProductCategory)
            @if($modelProductCategory->id === $productDTO->getCategoryId())
                <option value="{{ $modelProductCategory->id }}" selected>{{ $modelProductCategory->name }}</option>
            @else
                <option value="{{ $modelProductCategory->id }}">{{ $modelProductCategory->name }}</option>
            @endif
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="description">Описание:</label>
    <textarea type="text" class="form-control" id="description" placeholder="Введите описание" name="description">
        {{ $productDTO->getDescription() }}
    </textarea>
</div>
<div class="form-group">
    <label for="thumbnail_file">Превью картинка:</label>
    <div class="col-md-6">
        <input id="thumbnail_file" type="file" class="form-control" name="thumbnail_file">
    </div>
</div>
<div class="form-group">
    <label for="is_active">Активен:</label>
    <input
        id="is_active"
        name="is_active"
        type="checkbox"
        {{ $productDTO->getIsActive() || !$productDTO->getId() ? 'checked' : '' }}
    >
</div>
