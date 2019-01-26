<?php $name = "market"?>
<?php require_once("includes/core.inc.php");?>
<?php require_once("includes/header.php");?>
<div class = "container">
	<div class = "row px20top" >
		<div class = "col-lg-12 center">
			<h1>Mkulima Poa market</h1>
			<h4>One nation, one market</h4>
			<h4>You can now search for products you would like to review and buy</h4>
		</div>
	</div>
	<div class = "row px20top dark-light radius">
		<div style = "width:90%; margin:0 5%;">
			<div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class = "space">
					<form action = "search.php" method = "get" style = "width:80%; margin:0 10%;">
						<input type = "text" class = "form-control" style = "width:80%;float:left;" name = "search" required placeholder = "product" />
						<span class="input-group-btn">
							<button class = "btn btn-default" type = "submit"> <span class = "glyphicon glyphicon-search"></span> </button>
						</span>
					</form>
					
				</div>
				<h4 class = "center" style = "text-shadow:none;"><a href = "search.php?search=all">Show all products</a></h4>
			</div>
		</div>
	</div>
</div>
<?php require_once("includes/plain-footer.php");?>