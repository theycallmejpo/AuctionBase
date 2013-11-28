<div class="well">
	<form class="search-form" role="form" method="POST" action="item.php?itemID=<?=$itemID?>">
	  <div class="form-group">
	    <label>UserID</label>
	    <input type="text" class="form-control" name="userID" placeholder="Enter ItemID" required>
	  </div>

	  <div class="form-group">
	    <label>Amount</label>
	    <input type="text" class="form-control" name="amount" placeholder="Enter an Amount" required>
	  </div>
	  
	  <button type="Bid" class="btn btn-primary">Bid</button>
	</form>
</div>