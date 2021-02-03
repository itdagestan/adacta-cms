<?php
/** @var \App\Models\Page $modelPage */
?>

<div class="form-group">
    <label for="name">Название:</label>
    <input type="text" class="form-control" id="name" placeholder="Введите название" name="name"
           value="{{ old('name') ?? $modelProductCategory->name }}">
</div>
<div class="form-group">
    <label for="slug">ЧПУ:</label>
    <input type="text" class="form-control" id="slug" placeholder="Введите ЧПУ" name="slug"
           value="{{ old('slug') ?? $modelProductCategory->slug }}">
</div>
<div class="form-group">
    <label for="is_active">Активен:</label>
    <input
        id="is_active"
        name="is_active"
        type="checkbox"
        {{ old('is_active') ? ((bool)old('is_active') ? 'checked' : '') : ($modelProductCategory->is_active || !$modelProductCategory->exists ? 'checked' : '') }}
    >
</div>
