<?php
/** @var \App\Models\Page $modelPage */
?>
<div class="form-group">
    <label for="name">Название:</label>
    <input value="{{ $modelPage->name }}" type="text" class="form-control" id="name" placeholder="Введите название"
       name="name">
</div>
<div class="form-group">
    <label for="slug">ЧПУ:</label>
    <input value="{{ $modelPage->slug }}" type="text" class="form-control" id="slug" placeholder="Введите ЧПУ"
       name="slug">
</div>
<div class="form-group">
    <label for="html">HTML:</label>
    <textarea type="text" class="form-control" id="html" placeholder="Введите описание" name="html">
        {{ $modelPage->html }}
    </textarea>
</div>
<div class="form-group">
    <label for="is_active">Активен:</label>
    <input
        id="is_active"
        name="is_active"
        type="checkbox"
        {{ $modelPage->is_active || !$modelPage->exists ? 'checked' : '' }}
    >
</div>
