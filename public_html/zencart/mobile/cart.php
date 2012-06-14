<?php include 'header.php'; ?>

<h1>Cart</h1>
<?php echo zen_draw_form('cart_quantity', zen_href_link(FILENAME_SHOPPING_CART, 'action=update_product', 'NONSSL')); ?>

<?php

	$cartempty = $_SESSION['cart']->count_contents();
	
	if ($cartempty == 0) {
	
	echo '<p>Your cart is empty</p>';
	
	} else {

?>

<table cellpadding="4" align="center" id="cart">
<tr>
	<th style="border-right:0px !important;">Qty</th>
	<th style="border-left:0px !important;"> &nbsp;</th>
	<th>Name</th>
	<th>Price</th>
	<th>Delete </th>
</tr>
<?php
  foreach ($productArray as $product) {
?>
<tbody style="border-bottom:2px solid #ccc;">
<tr>
	<td>
		<?php
		  if ($product['flagShowFixedQuantity']) {
			echo $product['showFixedQuantityAmount'] . '<span class="alert bold">' . $product['flagStockCheck'] . '</span>' . $product['showMinUnits'];
		  } else {
			echo $product['quantityField'] . '<span class="alert bold">' . $product['flagStockCheck'] . '</span>' . $product['showMinUnits'];
		  }
		?>
	</td>
	<td class="update">
	<?php
		if ($product['buttonUpdate'] == '') {
		echo '' ;
		} else {
		echo $product['buttonUpdate'];
		}
	?>
	</td>
	<td><?php echo $product['productsName']; ?> </td>
	<td><?php echo $product['productsPrice']; ?> </td>
	<td align="center">
           <a href="index.php?main_page=shopping_cart&action=remove_product&product_id=<?php echo $product['id']; ?>"><img src="mobile/images/delete.png" /></a>
	</td>
</tr>
<tr>
	<td colspan="5">
		<?php
		  echo $product['attributeHiddenField'];
		  if (isset($product['attributes']) && is_array($product['attributes'])) {
		  echo '<ul style="margin:0px;" padding:0px;">';
			reset($product['attributes']);
			foreach ($product['attributes'] as $option => $value) {
		?>

		<li><?php echo $value['products_options_name'] . TEXT_OPTION_DIVIDER . nl2br($value['products_options_values_name']); ?></li>

		<?php
			}
		  echo '</ul>';
		  }
		?>
	</td>
</tr>
</tbody>
<?php
}
?>
<tr>
	<td colspan="3" align="right" style="font-weight: bolder;">Total (<?php echo $_SESSION['currency']; ?>)</td>
	<td style="font-weight: bolder;"><?php echo $cartShowTotal; ?> </td>
</tr>
<tr>
<td colspan="5" style="text-align:center;">
<input type="submit" value="Update Cart">
</td>
</tr>
</table>

<div style="text-align:center; padding-top:10px;">
	<a rel="external" href="./ipn_main_handler.php?type=ec">
		    <img id="paypalbutton" src="mobile/images/btn_checkout_278x43.png" />
		    <img style="display:none;" src="mobile/images/btn_checkout_278x43down.png" />
    </a>
</div>

<?php
	}
?>

</form>

<?php include 'footer.php'; ?>
