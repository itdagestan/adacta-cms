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

<h3>Тиражи</h3>
<div class="table-responsive">
    <span id="result"></span>
    <table class="table table-bordered table-striped" id="product_unit_table">
        <thead>
        <tr>
            <th width="25%">Количество</th>
            <th width="20%">Ед. Измерения</th>
            <th width="25%">Цена</th>
            <th width="30%">Действие</th>
        </tr>
        </thead>
        <tbody id="units-table-tbody">
        @foreach($modelProduct->units as $key => $modelProductUnit)
            <tr>
                <td>
                    <input hidden value="{{ $modelProductUnit->id }}" type="text" name="product_unit[{{ $key }}][id]" class="form-control" />
                    <input value="{{ $modelProductUnit->count }}" type="text" name="product_unit[{{ $key }}][count]" class="form-control" />
                </td>
                <td><input value="{{ $modelProductUnit->unit_type }}" type="text" name="product_unit[{{ $key }}][unit_type]" class="form-control" /></td>
                <td><input value="{{ $modelProductUnit->price }}" type="text" name="product_unit[{{ $key }}][price]" class="form-control" /></td>
                @if($key === 0)
                    <td><button type="button" name="add" data-add-product-unit class="btn btn-success">Добавить</button></td>
                @else
                    <td><button type="button" name="remove" id="" data-remove-product-unit class="btn btn-danger">Удалить</button>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<h3>Модификации</h3>
<div class="table-responsive">
    <span id="result"></span>
    <table class="table table-bordered table-striped" id="product_modification_table">
        <thead>
        <tr>
            <th width="25%">Название</th>
            <th width="20%">Цена</th>
            <th width="25%">Тип подсчета цены</th>
            <th width="30%">Действие</th>
        </tr>
        </thead>
        <tbody id="modifications-table-tbody">
        @foreach($modelProduct->modifications as $key => $modelProductModifications)
            <tr>
                <td>
                    <input hidden value="{{ $modelProductModifications->id }}" type="text" name="product_modification[{{ $key+1 }}][id]" class="form-control" />
                    <input value="{{ $modelProductModifications->name }}" type="text" name="product_modification[{{ $key+1 }}][name]" class="form-control" />
                </td>
                <td><input value="{{ $modelProductModifications->price }}" type="text" name="product_modification[{{ $key+1 }}][price]" class="form-control" /></td>
                <td>
                    <select name="product_modification[{{ $key+1 }}][price_type]" class="form-control">
                        @if($modelProductModifications->price_type == $modelProductModifications::PRICE_TYPE_ONE)
                            <option value="Цена за количество товара + цена за модификацию" selected>Цена за количество товара + цена за модификацию</option>
                            <option value="Цена товара + цена модификации">Цена товара + цена модификации</option>
                        @else
                            <option value="Цена товара + цена модификации" selected>Цена товара + цена модификации</option>
                            <option value="Цена за количество товара + цена за модификацию">Цена за количество товара + цена за модификацию</option>
                        @endif
                    </select>
                </td>
                @if($key === 0)
                    <td><button type="button" name="add" data-add-product-modification class="btn btn-success">Добавить</button></td>
                @else
                    <td><button type="button" name="remove" id="" data-remove-product-modification class="btn btn-danger">Удалить</button>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@push('scripts')
    <script src="/js/product/add_modifications_and_units.js"></script>
@endpush
