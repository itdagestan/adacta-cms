<?php
/** @var \App\DataTransferObjects\ProductCategoryDTO $productCategoryDTO */
/** @var \App\Models\ProductCategory[] $modelsProductCategory */
?>

<div class="form-group">
    <label for="name">Название:</label>
    <input type="text" class="form-control" id="name" placeholder="Введите название" name="name"
           value="{{ $productCategoryDTO->getName() }}">
</div>
<div class="form-group">
    <label for="slug">ЧПУ:</label>
    <input type="text" class="form-control" id="slug" placeholder="Введите ЧПУ" name="slug"
           value="{{ $productCategoryDTO->getSlug() }}">
</div>
<div class="form-group">
    <label for="parent_id">Категория родитель:</label>
    <select class="form-control" id="parent_id" name="parent_id">
        <option value="">Без родителя</option>
        @foreach($modelsProductCategory as $modelProductCategory)
            @if($modelProductCategory->id === $productCategoryDTO->getParentId())
                <option value="{{ $modelProductCategory->id }}" selected>{{ $modelProductCategory->name }}</option>
            @else
                <option value="{{ $modelProductCategory->id }}">{{ $modelProductCategory->name }}</option>
            @endif
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="is_active">Активен:</label>
    <input
        id="is_active"
        name="is_active"
        type="checkbox"
        {{ $productCategoryDTO->getIsActive() || !$productCategoryDTO->getId() ? 'checked' : '' }}
    >
</div>
