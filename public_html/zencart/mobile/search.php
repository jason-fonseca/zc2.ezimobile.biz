<?php include 'header.php'; ?>

<div>Search Results</div>

<form action="search?main_page=advanced_search_result" method="get" class="searchpopup">
	<table><tr><td>
		<input class="suggest ui-input-text ui-body-null" type="text" id="searchinput" data-type="search" name="keyword" placeholder="Search" autocomplete="off" value="<?php echo htmlspecialchars(stripslashes($_GET['keyword'])); ?>">
	</td><td>
	<input type="submit" value="Go" style="background:none; border:2px solid #dedede; box-shadow:2px 2px 2px 2px #999;  border-radius:10px;" data-role="none"/>
	</td></tr></table>
</form>

<?php
if($result->number_of_rows > 0)
{

$resultset = $db->Execute($result->sql_query);
$listing = $resultset;

?>

<ul data-role="listview" data-inset="true" id="products" class="products" style="margin-top: 8px;">
	<li data-role="list-divider">Results</li>
	<?php
	while(!$listing->EOF)
	{
	?>
	<li style="text-align:center; padding:5px;">
		<div class="hproduct brief" style="text-align:center;">
		<table width="100%">
		<tr>
			<td colspan="2" align="left">
				<a href="prod<?php echo $listing->fields['products_id']; ?>.htm?products_id=<?php echo $listing->fields['products_id']; ?>"><?php echo $listing->fields['products_name']; ?></a>
			</td>
		</tr>
		<tr>
		<td width="0" style="vertical-align: top;">
			<a href="prod<?php echo $listing->fields['products_id']; ?>.htm?products_id=<?php echo $listing->fields['products_id']; ?>"><img class="photo" style="margin-top:3px; margin-left:auto; margin-right:auto;" src="images/<?php echo $listing->fields['products_image']; ?>" width="100"/></a>
		</td>
		<td align="left">
				<!--div class="unavailable">{include field="UnavailableMessageHTML"}</div-->
				<!--{if BuyButtonID}-->	
				<form method="post" action="cart/index.php?action=add_product" class="productform">
					<input type="hidden" name="products_id" value="<?php echo $listing->fields['products_id']; ?>"/>
					<input type="hidden" name="cart_quantity" value="1" maxlength="6" size="4">

					<table align="center" style="margin-left:auto; margin-right:auto;" width="100"><tr><td style="border:none; vertical-align:middle">					
							<span class="listprice">
								<?php
								if(specials_new_products_price)
									echo $listing->fields['was $' . number_format(specials_new_products_price , 2)]; ?>
							</span>
							<br />
							<span class="price">
								<?php if(!specials_new_products_price) echo 'now'; ?> $<?php echo number_format($listing->fields['products_price'] , 2); ?>
							</span>
						
					</td></tr><tr><td style="border:none; vertical-align:middle;">
					<!--{if !OptionSet}-->
					<input type="submit" class="buy" data-theme="e" value="Add to Cart" /><br/>
					<!--{/if}-->
						<a href="prod<?php echo $listing->fields['products_id']; ?>.htm" class="ui-link" style="color: #2489CE !important; text-shadow: none;">More info...</a>
					</td></tr></table>
				</form>
				<!--{/if}-->
		</td>
		</tr>
		</table>		
		</div>
	</li>
<?php
$listing->MoveNext();
}
?>

</ul>

<?php
} else {
	echo '<p>Your search has produced no results</p>';
};

?>

<?php



//$_GET['keyword'] = trim($_GET['keyword']);
//echo $_GET['keyword'];
//echo '<br /><br />';
//print_r ($result);

?>


<?php include 'footer.php'; ?>

