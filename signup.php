<?php /* signup.php */
  $pageTitle = 'Item Information';
 	include ('./header.php');
 	include ('./sqlitedb.php');
?>

<?php
	$userID = $_POST["userID"];
	$rating = $_POST["rating"];
	$location = $_POST["location"];
	$country = $_POST["country"];

	if($_POST["userID"]) {
	
	
	  try {
	  
	  	$db->exec("PRAGMA foreign_keys = ON;");
	  	$db->beginTransaction();

		#Run command
	  	$query = "insert into User values ('".$userID."', ".$rating.", '".$location."', '".$country."');";
			$result = $db->query($query);
			$db->commit();

			echo '<div class="alert alert-success"><strong>Well Done!</strong> Your account has been added.</div>';

	  } catch (PDOException $e) {
	  	try {
	  		$db->rollBack();
		} catch (PDOException $pe) {}
			echo '<div class="alert alert-danger"><strong>Transaction failed: </strong>'.$e->getMessage().'. User could not be added. Try again.</div>';
	  }
	}

?>

<h3>Add a new user</h3>
<p>Fill out the form below to be able to make bids on existing items</p>
<div class="well">
	<form class="search-form" role="form" method="POST" action="signup.php">
	  <div class="form-group">
	    <label>UserID</label>
	    <input type="text" class="form-control" name="userID" placeholder="Enter ItemID" required>
	  </div>

	  <div class="form-group">
	    <label>Rating</label>
	    <input type="text" class="form-control" name="rating" placeholder="Enter an Amount" required>
	  </div>

	  <div class="form-group">
	    <label>Location</label>
	    <input type="text" class="form-control" name="location" placeholder="Enter a Location" required>
	  </div>

	  <div class="form-group">
	    <label>Country</label>
	    <input type="text" class="form-control" name="country" placeholder="Enter a Country" required>
	  </div>
	  
	  <button type="Bid" class="btn btn-success">Create User</button>
	</form>
</div>

<?php
	include ('./footer.html');
?>