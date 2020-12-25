<div class="form-group">
    <label for="name">Название:</label>
    <input value="{{ $modelProduct->name }}" type="text" class="form-control" id="name" placeholder="Введите название" name="name">
</div>
<div class="form-group">
    <label for="slug">ЧПУ:</label>
    <input value="{{ $modelProduct->slug }}" type="text" class="form-control" id="slug" placeholder="Введите ЧПУ" name="slug">
</div>
<div class="form-group">
    <label for="price_old">Старая цена:</label>
    <input value="{{ $modelProduct->price_old }}" type="text" class="form-control" id="price_old" placeholder="Введите старую цену" name="price_old">
</div>
<div class="form-group">
    <label for="price_new">Новая цена:</label>
    <input value="{{ $modelProduct->price_new }}" type="text" class="form-control" id="price_new" placeholder="Введите новую цену" name="price_new">
</div>
<div class="form-group">
    <label for="category_id">Категория:</label>
    <select class="form-control" id="category_id" name="category_id">
        <option value="">Выберите категорию</option>
        @foreach($modelsProductCategory as $modelProductCategory)
            @if($modelProductCategory->id === $modelProduct->category_id)
                <option value="{{ $modelProductCategory->id }}" selected>{{ $modelProductCategory->name }}</option>
            @else
                <option value="{{ $modelProductCategory->id }}">{{ $modelProductCategory->name }}</option>
            @endif
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="description">Описание:</label>
    <textarea type="text" class="form-control" id="description" placeholder="Введите описание" name="description">{{ $modelProduct->description }}</textarea>
</div>
<div class="form-group">
    <label for="thumbnail_file">Превью картинка:</label>
    <div class="col-md-6">
        <input id="thumbnail_file" type="file" class="form-control" name="thumbnail_file">
    </div>
</div>
<div class="form-group">
    <label for="is_visible">Виден:</label>
    <input value="{{ $modelProduct->is_visible }}" type="checkbox" class="" id="is_visible" name="is_visible" checked>
</div>
