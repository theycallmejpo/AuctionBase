<?php /* item.php */
  $pageTitle = 'Item Information';
 	include ('./header.php');
 	include ('./sqlitedb.php');
?>

<?php
	$itemID = $_GET["itemID"];
	$userID = $_POST["userID"];
	$amount = $_POST["amount"];
	$time = htmlspecialchars($row["current_datetime"]);
	
	if($_POST["userID"]) {
	
	  try {
	  
	  	$db->exec("PRAGMA foreign_keys = ON;");
	  	$db->beginTransaction();

		#Run command
	  	$query = "insert into Bid values ('".$itemID."', '".$userID."', '".$time."', ".$amount.");";
			$result = $db->query($query);
			$db->commit();

			echo '<div class="alert alert-success"><strong>Well Done!</strong> Your bid has been added.</div>';

	  } catch (PDOException $e) {
	  	try {
	  		$db->rollBack();
		} catch (PDOException $pe) {}
			echo '<div class="alert alert-danger"><strong>Transaction failed: </strong>'.$e->getMessage().'.</div>';
	  }
	}

?>

<?php

	$openCloseQuery = "select * from openAuctions where ItemID = ".$itemID.";";
	$openCloseResult = $db->query($openCloseQuery);

	if( $openCloseResult->fetch() ) {
		$openOrClosed = "open";
	} else {
		$openOrClosed = "closed";
	}
	
	$itemQuery = "select * from Item where ItemID = ".$itemID.";";
	$sellerQuery = "select User.UserID, Rating, Location, Country from Sells natural join User where ItemID = ".$itemID.";";
	$categoryQuery = "select distinct Category from Category where ItemID = ".$itemID.";";
	$bidQuery = "select * from Bid where ItemID = ".$itemID." order by Amount DESC;";
  
  try {
    $itemResult = $db->query($itemQuery);
    $sellerResult = $db->query($sellerQuery);
    $categoryResult = $db->query($categoryQuery);
    $bidResult = $db->query($bidQuery);

    $sellerRow = $sellerResult->fetch();
    $itemRow = $itemResult->fetch();
    $categories = '';

    while( $categoryRow = $categoryResult->fetch() ) {
    	$categories = $categories.htmlspecialchars($categoryRow["Category"]).'. ';
    }



    include ('./itemTableHeader.html');

    echo '<tr>
    				<td>ItemID</td>
    				<td>'.htmlspecialchars($itemRow["ItemID"]).'</td>
    			</tr>
    			<tr>
    				<td>Name</td>
    				<td>'.htmlspecialchars($itemRow["Name"]).'</td>
    			</tr>
    			<tr>
    				<td>Currently</td>
    				<td>'.htmlspecialchars($itemRow["Currently"]).'</td>
    			</tr>
    			<tr>
						<td>Buy Price</td>
						<td>'.htmlspecialchars($itemRow["Buy_Price"]).'</td>
					</tr>
					<tr>
						<td>First Bid</td>
						<td>'.htmlspecialchars($itemRow["First_Bid"]).'</td>
					</tr>
					<tr>
						<td>Started</td>
						<td>'.htmlspecialchars($itemRow["Started"]).'</td>
					</tr>
					<tr>
						<td>Ends</td>
						<td>'.htmlspecialchars($itemRow["Ends"]).'</td>
					</tr>
					<tr>
						<td>Categories</td>
						<td>'.$categories.'</td>
					</tr>
					<tr>
						<td>Description</td>
						<td>'.$itemRow["Description"].'</td>
					</tr>
					<tr>
						<td>Seller</td>
						<td>'.htmlspecialchars($sellerRow["UserID"]).'</td>
					</tr>
					<tr>
						<td>Rating</td>
						<td>'.htmlspecialchars($sellerRow["Rating"]).'</td>
					</tr>
					<tr>
						<td>Location</td>
						<td>'.htmlspecialchars($sellerRow["Location"]).'</td>
					</tr>
					<tr>
						<td>Country</td>
						<td>'.htmlspecialchars($sellerRow["Country"]).'</td>
    			</tr>';

    echo '</table>';

    if ($openOrClosed == "open") {
    	echo '<h2>Previous Bids <span class="glyphicon glyphicon-time"></span> </h2>';
	    echo '<table class="table">';

	    while( $bidRow = $bidResult->fetch() ) {
	    	echo "<tr>
								<td>".htmlspecialchars($bidRow["UserID"])."</td>
								<td>".htmlspecialchars($bidRow["Time"])."</td>
								<td>".htmlspecialchars($bidRow["Amount"])."</td>
								</tr>";
	    }

	    echo '</table>';

	    // add funcitonality to enter bid
	    include ('./enterBid.php');

    } else {
    	echo '<div class="bs-callout bs-callout-warning"><h4>This is a closed auction</h4></div>';
    	echo '<h2>Auction Winner <span class="glyphicon glyphicon-star"></span> </h2>';
    	if ( $bidRow = $bidResult->fetch() ) {
    		echo '<div class="well"> User "'.$bidRow["UserID"].'" won the Auction with the last bid of '.$bidRow["Amount"].' dollars.</div>';
    	} else {
    		echo '<div class="well">There are no winners for this auction.</div>';
    	}
    }
    
  
  } catch (PDOException $e) {
    echo '<div class="alert alert-danger"><strong>Transaction failed:</strong>'.$e->getMessage().'.</div>';
  }
  
  $db = null;


?>

<?php
	include ('./footer.html');
?>

