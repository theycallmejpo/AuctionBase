
<?php /* currtime.php - show current time  */
  $pageTitle = 'Auction Base';
  include ('./header.php');
?>

<div class="jumbotron">
	<h1>AuctionBase.</h1>
	<p class="lead">
		In AuctionBase, you can change the current time, enter bids on open auctions on a plethora of items, 
		see past auction winners, browse auctions of your interest, and much more.
	</p>
 	<p><a class="btn btn-lg btn-success" href="./signup.php" role="button">Sign up today</a></p>
</div>

<div class="row marketing">
	<div class="col-lg-6">
		<h4><a href="./selecttime.php">Change Current Time</a></h4>
    <p>You can select the current time. Remember you can't select a time in the past.</p>

    <h4><a href="./searchauctions.php">Enter a Bid</a></h4>
   	<p>Enter a bid on a list of open Auctions. You might want to browse around first.</p>

   	<h4><a href="./searchauctions.php">See Past Winners</a></h4>
   	<p>You can take a look at previous auctions and their winners to have an idea of what you might bid on.</p>
	</div>

	<div class="col-lg-6">
		<h4><a href="./searchauctions.php">Find Aucions that Match You</a></h4>
    <p>Here you can find auctions based on what you like. Don't hesitate and give it a try.</p>

    <h4><a href="./searchauctions.php">Find an Auction by ID</a></h4>
   	<p>Already know what you are looking for? Well, this is your place</p>
   	<form class="form-inline" role="form" action="searchauctions.php" method="post">
  		<div class="form-group">
    		<label class="sr-only">Email address</label>
    		<input type="text" class="form-control" name="itemID" placeholder="Enter ItemID" />
  		</div>
 		 	<button type="submit" class="btn btn-default">Find</button>
		</form>

	</div>
</div>

<?php
	include ('./footer.html');
?>
