<?php /* searchauctions.php - let's you choose a new time */
    $pageTitle = 'Search Auctions';
    include ('./header.php');
    include ('./sqlitedb.php');
?>

<h2>Find Auctions</h2>
<p>Use the form below to find auctions of your preference</p>

<br />

<div class="well">
	<form class="search-form" role="form" method="POST" action="searchauctions.php">
	  <div class="form-group">
	    <label>ItemID</label>
	    <input type="text" class="form-control" name="itemID" placeholder="Enter ItemID">
	  </div>

	  <div class="form-group">
	    <label>Category</label>
	    <input type="text" class="form-control" name="categorySubstring" placeholder="Enter a Category">
	  </div>

	  <div class="form-group">
	    <label>Minimum Price</label>
	    <input type="text" class="form-control" name="minimumPrice" placeholder="Enter price">
	  </div>

	  <div class="form-group">
	  	<label>Availability</label>
		  <select class="form-control" name="openOrClosed">
			  <option value="open">Open auctions only</option>
			  <option value="closed">Closed auctions only</option>
			  <option value="both">Both open and closed</option>
			</select>
		</div>
	  
	  <button type="submit" class="btn btn-primary">Search</button>
	</form>
</div>


<?php
	$itemID = $_POST["itemID"];
  $categorySubstring = htmlspecialchars($_POST["categorySubstring"]);
  $minimumPrice = $_POST["minimumPrice"];
  $openOrClosed = $_POST["openOrClosed"];
  
  if($_POST["categorySubstring"] || $_POST["minimumPrice"] || $_POST["openOrClosed"] || $_POST["itemID"]) {
  	echo "<h2>Results</h2>";
    echo "<p> Showing results for ItemID <em>'".$itemID."'</em> Category <em>'".$categorySubstring."'</em>, Minimum Price <em>'".$minimumPrice."'</em> and on <em>'".$openOrClosed."'</em> auctions.";
  
  	include ('./tableHeader.html');

  	if ( !$_POST["categorySubstring"] ) $categorySubstring = '';
  	if ( !$_POST["minimumPrice"] )  $minimumPrice = 0.0;

	  try {
	 
			#Run command
			if ( $_POST["itemID"] ) {
				$query = "select distinct Item.ItemID, Name, Currently, Buy_Price, UserID from Item natural join Sells where Item.ItemID = ".$itemID.";";
			} else if ( $openOrClosed == "open") {
				$query = "select distinct Item.ItemID, Name, Currently, Buy_Price, UserID from Category natural join Item natural join Sells where Category like '%".$categorySubstring."%' and Currently >= ".$minimumPrice." and Item.ItemID in (select * from openAuctions);";
			} else if ( $openOrClosed == "closed" ) {
				$query = "select distinct Item.ItemID, Name, Currently, Buy_Price, UserID from Category natural join Item natural join Sells where Category like '%".$categorySubstring."%' and Currently >= ".$minimumPrice." and Item.ItemID not in (select * from openAuctions);";
			} else {
				$query = "select distinct Item.ItemID, Name, Currently, Buy_Price, UserID from Category natural join Item natural join Sells where Category like '%".$categorySubstring."%' and Currently >= ".$minimumPrice.";";
			}
	  	
			$result = $db->query($query);

			while ( $row = $result->fetch() ) {

				echo "<tr>
							<td><a href='item.php?itemID=".htmlspecialchars($row["ItemID"])."'>".htmlspecialchars($row["ItemID"])."</a></td>
							<td>".htmlspecialchars($row["Name"])."</td>
							<td>".htmlspecialchars($row["Currently"])."</td>
							<td>".htmlspecialchars($row["Buy_Price"])."</td>
							<td>".htmlspecialchars($row["UserID"])."</td>
							</tr>";
			}

	  } catch (PDOException $e) {
			echo "Select search query: " . $e->getMessage();
	  }

		$db = null;

		echo '</table>';
	
	}
?>

<?php
	include ('footer.html');
?>

