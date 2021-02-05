<?php
/** @var \App\DataTransferObjects\PageDTO $pageDTO */
?>
<div class="form-group">
    <label for="name">Название:</label>
    <input value="{{ $pageDTO->getName() }}" type="text" class="form-control" id="name" placeholder="Введите название"
       name="name">
</div>
<div class="form-group">
    <label for="slug">ЧПУ:</label>
    <input value="{{ $pageDTO->getSlug() }}" type="text" class="form-control" id="slug" placeholder="Введите ЧПУ"
       name="slug">
</div>
<div class="form-group">
    <label for="html">HTML:</label>
    <textarea type="text" class="form-control" id="html" placeholder="Введите описание" name="html">
        {{ $pageDTO->getHtml() }}
    </textarea>
</div>
<div class="form-group">
    <label for="is_active">Активен:</label>
    <input
        id="is_active"
        name="is_active"
        type="checkbox"
        {{ $pageDTO->getIsActive() || !$pageDTO->getId() ? 'checked' : '' }}
    >
</div>
