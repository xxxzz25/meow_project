

<?php
try {
	require_once("../php/connectBD103G2.php");
	if(isset($_REQUEST["pdType"])){
		$sql = "select * from PRODUCT where PRODUCT_PART = :TYPE";
		$pdType = $_REQUEST["pdType"];
		$PRODUCT = $pdo->prepare($sql);
		$PRODUCT->bindValue(":TYPE",$pdType);
	}else{
		$text = $_REQUEST["searchValue"];
		$sql = "select * from PRODUCT where PRODUCT_NAME like '%$text%' ";
		$PRODUCT = $pdo->prepare($sql);

	}
	
	$PRODUCT->execute();
	$result = "";
	
	while ($PRODUCTROW = $PRODUCT->fetchObject()) {
	

		$PRODUCT_NO = $PRODUCTROW -> PRODUCT_NO;
		$PRODUCT_COVER = $PRODUCTROW -> PRODUCT_COVER;
		$PRODUCT_NAME = $PRODUCTROW -> PRODUCT_NAME;
		$PRODUCT_PRICE = $PRODUCTROW -> PRODUCT_PRICE;
		$PRODUCT_NEWNAME = explode(" ",$PRODUCT_NAME);
		$PRODUCT_EN = $PRODUCT_NEWNAME[0];
		$PRODUCT_CH = $PRODUCT_NEWNAME[1];

	$result.="<div class='product product2'>
		<a href='../html/Cat_ShoppingStore_product.php?PRODUCT_NO=$PRODUCT_NO'>
			<div class='pic  wow zoomIn'>
				<img src='$PRODUCT_COVER' alt='$PRODUCT_NAME'>
			</div>
		</a>

		<div class='text'>
			$PRODUCT_EN <br>
			$PRODUCT_CH
		</div>

		<div class='cost'>
			$$PRODUCT_PRICE
		</div>
		
	</div>";


	}
	echo $result;
} catch (PDOException $e) {
	echo "錯誤原因 : " , $e->getMessage() , "<br>";
	echo "錯誤行號 : " , $e->getLine() , "<br>";
}

?>
					