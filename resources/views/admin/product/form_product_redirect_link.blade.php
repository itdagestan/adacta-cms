<?php
/** @var \App\DataTransferObjects\SingleProductDTO $productDTO */
?>
<div class="form-group">
    <label for="link">Ссылка на которую ведет товар:</label>
    <input value="{{ $productDTO->getLink() }}" type="text" class="form-control" id="link" placeholder="Введите ссылку на которую ведет товар" name="link">
</div>
