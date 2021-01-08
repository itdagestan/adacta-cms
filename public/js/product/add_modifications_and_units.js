$(document).ready(function() {
    let tableUnits = document.getElementById('units-table-tbody');
    let productUnitCount = tableUnits.rows.length;
    function changeProductUnit(number) {
        $('#product_unit_table tbody').append(`
            <tr>
                <td><input type="text" name="product_unit[${number}][count]" class="form-control" /></td>
                <td><input type="text" name="product_unit[${number}][unit_type]" class="form-control" /></td>
                <td><input type="text" name="product_unit[${number}][price]" class="form-control" /></td>
                <td><button type="button" name="remove" id="" data-remove-product-unit class="btn btn-danger">Удалить</button></td>
            </tr>
        `);
    }

    $(document).on('click', 'button[data-add-product-unit]', function(){
        productUnitCount++;
        changeProductUnit(productUnitCount);
    });

    $(document).on('click', 'button[data-remove-product-unit]', function(){
        productUnitCount--;
        $(this).closest("tr").remove();
    });

    let tableModification = document.getElementById('modifications-table-tbody');
    let productModificationCount = tableModification.rows.length;
    function changeProductModification(number) {
        $('#product_modification_table tbody').append(`
            <tr>
                <td><input type="text" name="product_modification[${number}][name]" class="form-control" /></td>
                <td><input type="text" name="product_modification[${number}][price]" class="form-control" /></td>
                <td>
                    <select name="product_modification[${number}][price_type]" class="form-control">
                        <option value=""></option>
                        <option value="Цена за количество товара + цена за модификацию">Цена за количество товара + цена за модификацию</option>
                        <option value="Цена товара + цена модификации">Цена товара + цена модификации</option>
                    </select>
                </td>
                <td><button type="button" name="remove" id="" data-remove-product-modification class="btn btn-danger">Удалить</button></td>
            </tr>
        `);
    }

    $(document).on('click', 'button[data-add-product-modification]', function(){
        productModificationCount++;
        changeProductModification(productModificationCount);
    });

    $(document).on('click', 'button[data-remove-product-modification]', function(){
        productModificationCount--;
        $(this).closest("tr").remove();
    });
});
