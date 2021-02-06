<?php
/** @var \App\DataTransferObjects\UnitDTO[] $unitDTOAsArray */
/** @var \App\DataTransferObjects\ModificationDTO[] $modificationDTOAsArray */
/** @var array $modificationsPriceTypeEnum */
?>
<h3>Тиражи</h3>
<div class="table-responsive">
    <span id="result"></span>
    <table class="table table-bordered table-striped" id="product_unit_table">
        <thead>
        <tr>
            <th width="25%">Количество</th>
            <th width="20%">Ед. Измерения</th>
            <th width="25%">Цена</th>
            <th width="30%">
                Действие
                <button type="button" name="add" data-add-product-unit class="btn btn-success">+</button>
            </th>
        </tr>
        </thead>
        <tbody id="units-table-tbody">
        @foreach($unitDTOAsArray as $key => $unitDTO)
            <tr>
                <td>
                    <input hidden value="{{ $unitDTO->getId() }}" type="text" name="product_unit[{{ $key }}][id]" class="form-control" />
                    <input value="{{ $unitDTO->getCount() }}" type="text" name="product_unit[{{ $key }}][count]" class="form-control" />
                </td>
                <td><input value="{{ $unitDTO->getUnitType() }}" type="text" name="product_unit[{{ $key }}][unit_type]" class="form-control" /></td>
                <td><input value="{{ $unitDTO->getPrice() }}" type="text" name="product_unit[{{ $key }}][price]" class="form-control" /></td>
                <td><button type="button" name="remove" id="" data-remove-product-unit class="btn btn-danger">Удалить</button>
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
            <th width="30%">
                Действие
                <button type="button" name="add" data-add-product-modification class="btn btn-success">+</button>
            </th>
        </tr>
        </thead>
        <tbody id="modifications-table-tbody">
        @foreach($modificationDTOAsArray as $key => $modificationDTO)
            <tr>
                <td>
                    <input hidden value="{{ $modificationDTO->getId() }}" type="text" name="product_modification[{{ $key+1 }}][id]" class="form-control" />
                    <input value="{{ $modificationDTO->getName() }}" type="text" name="product_modification[{{ $key+1 }}][name]" class="form-control" />
                </td>
                <td><input value="{{ $modificationDTO->getPrice() }}" type="text" name="product_modification[{{ $key+1 }}][price]" class="form-control" /></td>
                <td>
                    <select name="product_modification[{{ $key+1 }}][price_type]" class="form-control">
                        @foreach($modificationsPriceTypeEnum as $priceType)
                            @if($modificationDTO->getPriceType() === $priceType)
                                <option value="{{ $priceType }}" selected>{{ $priceType }}</option>
                            @else
                                <option value="{{ $priceType }}">{{ $priceType }}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td><button type="button" name="remove" id="" data-remove-product-modification class="btn btn-danger">Удалить</button>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@push('scripts')
    <script src="/js/product/add_modifications_and_units.js"></script>
@endpush
