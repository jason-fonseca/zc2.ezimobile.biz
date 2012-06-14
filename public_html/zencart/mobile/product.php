<?php include 'header.php'; ?>

<?php
	$sql = "select p.products_id, pd.products_name,
                  pd.products_description, p.products_model,
                  p.products_quantity, p.products_image,
                  pd.products_url, p.products_price,
                  p.products_tax_class_id, p.products_date_added,
                  p.products_date_available, p.manufacturers_id, p.products_quantity,
                  p.products_weight, p.products_priced_by_attribute, p.product_is_free,
                  p.products_qty_box_status,
                  p.products_quantity_order_max,
                  p.products_discount_type, p.products_discount_type_from, p.products_sort_order, p.products_price_sorter
           from   " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
           where  p.products_status = '1'
           and    p.products_id = '" . (int)$_GET['products_id'] . "'
           and    pd.products_id = p.products_id
           and    pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
    $product_info = $db->Execute($sql);
?>

<div>
	<?php
		$theproductname = $product_info->fields['products_name']; 
		for ($i=0;$i<sizeof($breadcrumb->_trail);$i++) { ?>
	<?php 
		$str = end(explode('_', $breadcrumb->_trail[$i]['link']));	
		$catid = preg_replace('[\D]', '', $str);
		$trailname = $breadcrumb->_trail[$i]['title'];
	?>
		<a href="
		<?php 
		if($i==0) {
			echo '/">';
		} else if($trailname == $theproductname) {
			echo '#">';
		} else {
			echo 'category' . $catid . '_1.htm?cPath='. $catid . '">';
		};
		echo $breadcrumb->_trail[$i]['title']; ?></a> >
	<?php } ?>
</div>

<form method="post" rel="external" action="cart/index.php?action=add_product" class="productform">
	<input type="hidden" name="products_id" value="<?php echo $product_info->fields['products_id']; ?>"/>
	<input type="hidden" name="cart_quantity" value="1" maxlength="6" size="4">
	
	<div style="border-radius:10px; border:1px solid #999; background:#fff; margin-top:4px; padding:5px;">
    <table style="margin-top:10px;">
	<tr>
	<td style="vertical-align: top;">
		<div style="position: relative; width: 126px; height: 126px;">
			<div style="z-index: 1; background-color: #fff; position: absolute; top: 0px; left: -3px; width: 124px; height: 125px; box-shadow: 1px 1px #777; border: 1px solid #ddd; -webkit-transform: rotate(-2deg);"></div>
			<div style="z-index: 2; background-color: #fff; position: absolute; top: -1px; left: -2px; width: 124px; height: 125px; box-shadow: 1px 1px #888; border: 1px solid #ddd; -webkit-transform: rotate(1deg);"></div>
			<div style="z-index: 3; background-color: #fff; position: absolute; top: 0px; left: -2px; width: 124px; height: 125px; box-shadow: 1px 1px #666; border: 1px solid #ddd; -webkit-transform: rotate(1.5deg);"></div>

			<a href="gallery<?php echo $product_info->fields['products_id']; ?>.htm?products_id=<?php echo $product_info->fields['products_id']; ?>" style="position: absolute; top: 0px; left: 0px; display: block; z-index: 4;"><img class="photo" style="margin-top:3px; margin-left:auto; margin-right:auto;" src="images/<?php echo $product_info->fields['products_image']; ?>" width="100"/></a>
		</div>
	</td>
	<td  align="left" valign="top">
			<a href="#" class="url" style="font-size:18px"><?php echo $product_info->fields['products_name']; ?></a>
			
		<table align="center" style="margin-left:auto; margin-right:auto; margin-top:20px;"><tr><td style="border:none; vertical-align:middle; text-align:center;">
		<span style="font-size:15px;">
            <span class="listprice">
				<?php
					if(specials_new_products_price)
						echo $product_info->fields['was $' . number_format(specials_new_products_price , 2)]; ?>
				</span>
				<br />
				<span class="price">
					<?php if(!specials_new_products_price) echo 'now'; ?> $<?php echo number_format($product_info->fields['products_price'] , 2); ?>
			</span>
            
            <!--{if DisplayCurrencies}
            <span class="currencyprice">({Format PriceConverted, DisplayCurrency} {DisplayCurrency} <a href="#">&dagger;</a>)</span>
            {/if}-->
        </span>
        <br />
		<input type="submit" data-theme="e" value="Add to Cart" />
		</td></tr></table>
		
	</td>
	</tr>
	</table>

	<?php
		include('includes/templates/template_default/templates/tpl_modules_attributes.php');
	?>
		<div style="padding: 0.5em; padding-top: 0.8em;">
		<?php 
		$description = $product_info->fields['products_description'];
		if ($description) {
			echo $description;
		} else {
			echo 'There is no description for this product'; 
		};	
		?>
		</div>
</form>

<?php
	//print_r ($breadcrumb);
	//print_r ($product_info);
	//print_r ($_SESSION);
	//echo $_GET['products_id'];
?>

<?php include 'footer.php'; ?>

