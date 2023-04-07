<div class="item">
    <div class="item-title">
        <div class="item-title-info">
            <div class="item-title-name"><?=$line['coffee_name']?></div>
            <div class="item-title-price">$<?=$line['price']?></div>
            <div style="padding: 0 0 0 5px;">x</div>
        </div>
        <div class="item-button-manager">
            <div class="item-quantity">
                <input type="button" class="item-qty-plus" value="+">
                <input type="number" name="coffee-id-<?=$line['coffee_id']?>" value="<?=$line['quantity']?>" min="0" class="item-amount">
                <input type="button" class="item-qty-minius" value="-">
            </div>
            <div style="padding: 0 5px 0 0;">=</div>
            <div class="item-title-price">$<?=$lineTotal?></div>
            <button type="button" onclick="removeProduct(<?=$line['coffee_id']?>)" class="item-button-remove"><i class="bi bi-x-lg text-danger"></i></button>
        </div>
    </div>
    <div class="item-details">
        <div class="item-details-brand">
            <div class="item-brand-title">Brand:</div>
            <div class="item-brand-name"><?=$line['coffee_brand']?></div>
        </div>
        <div class="item-details-type">
            <div class="item-type-title">Type:</div>
            <div class="item-type-name"><?=$line['coffee_type']?></div>
        </div>
    </div>
</div>