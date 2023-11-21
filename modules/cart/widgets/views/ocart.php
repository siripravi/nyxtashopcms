<?php

use yii\bootstrap5\Html;
use app\helpers\ImageHelper;

?>
<?php
$sum = 0;

?>
<?php if (!empty($items)) {  ?>
		<ul class="products">
		<?php foreach ($items as $item) { ?>
			<li class="product" id="i<?= $item->id ?>" rel="<?= $item->id ?>">
				<a href="#" class="product-link">
					<span class="product-image">
						<?php if(!$item->product->image->id):?>
						<img src="https://via.placeholder.com/75x50/ffffff/cccccc?text=PHOTO" alt="Product Photo">
						<?php else:?>
						<?= Html::img(ImageHelper::thumb($item->product->image->id, 'micro'), ['height' => '70']);?>
						<?php endif; ?>
					</span>
					<span class="product-details">
						<h3><?= $item->product->name . ($item->name ? ', ' . $item->name : null); ?></h3>
						<span><?= $item->priceDef ?></span>
						<span class="qty-price">
							<span class="qty">
								<button class="minus-button" id="minus-button-1">-</button>
								<input type="number" id="qty-input-1" class="qty-input product-count" data-id="<?= $item->id; ?>" , data-price="<?= $item->priceDef; ?>" step="1" min="1" max="1000" name="[]qty-input" value="<?= $cart[$item->id]; ?>" pattern="[0-9]*" title="Quantity" inputmode="numeric">
								<button class="plus-button" id="plus-button-1">+</button>
								<!--<input type="hidden" name="item-price" id="item-price-1" value="<= $cart[$item->id];?>"> -->
							</span>
							<span class="price"><?= $item->priceDef * $cart[$item->id]; ?></span>
						</span>
					</span>
				</a>
				<a class="remove-button product-delete" rel="<?= $item->id ?>"><span class="remove-icon">X</span></a>
			</li>
		<?php
			$sum += $cart[$item->id] * $item->priceDef;
		} ?>
	</ul>
	<div class="totals">
		<div class="subtotal">
			<span class="label">Subtotal:</span> <span class="amount"><?= $sum;  ?></span>
		</div>
	</div>
	<div class="action-buttons">
		<a class="view-cart-button" href="#">Cart</a><a class="checkout-button" href="/bag/index">Checkout</a>
	</div>
<?php }  ?>
<div id="offCanvasCart-curtain"></div>