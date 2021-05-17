<!-- login check -->
<?php
session_start();
if (!isset($_SESSION['userId'])) header("Location: Login.php");

?>

<!DOCTYPE html>

<html lang="en">

<head>
	
	<!-- meta tags -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Great electronics for sale, Quality electronics">
	<meta name="keywords" content="Mobile phone, Laptop, Dell, HP, Lenovo, Samsung, iPhone, Huawei">
	<meta name="author" content="Keele">

	<!-- https://www.w3schools.com/bootstrap/bootstrap_get_started.aspLatest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	<!-- linking the CSS -->
	<link href="css.css" rel="stylesheet" type="text/css">

	<!-- the title -->
	<title>EletronicSite</title>

</head>

<!-- the navigation bar -->
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
					<a class="navbar-brand" href="LoginIndex.php">Electronics</a>
				</div>

				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li><a href="LoginIndex.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<form action="" class="navbar-form">

								<div class="input-group">
									<input type="search" name="search" id="" placeholder="Search Anything Here..." class="form-control">
									<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
								</div>

							</form>
						</li>
						<li><a href="includes/logout.inc.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>

					</ul>
				</div>
			</div>
		</div>
	</div>
</nav>


<div class="container">
	<!-- javascript to connect the chained dropdown boxes -->
	<script type="text/javascript">
		//function only runs when the document is ready
		$(document).ready(function() {
			//function runs when the categorys form is changed
			$("#categorys").change(function() {
				//creating post var
				var cid = $("#categorys").val();
				//assigning ajax variables
				$.ajax({
					url: 'data.php',
					method: 'post',
					data: 'cid=' + cid
					//when done run function
				}).done(function(products) {
					console.log(products);
					//parse product data
					products = JSON.parse(products);
					//empty form
					$('#products').empty();
					//populate form with each product name
					products.forEach(function(product) {
						$('#products').append('<option value=' + product.id + '>' + product.name + '</option>');
					})
					$("#products").trigger('change');
				})
			})

			$("#products").change(function() {
				var pid = $("#products").val();
				$.ajax({
					url: 'data.php',
					method: 'post',
					data: 'pid=' + pid
				}).done(function(response) {
					response = JSON.parse(response);

					$("#selectedCategoryLeft").html('<img src="' + response.image + '" alt="Image of selected category" width="500" height="280">');
					$("#selectedCategoryTitle").html('<H2>' + response.name + '</H2>');
					$("#selectedCategoryDesc").html('<H2>' + response.description + '</H2>');
					$("#selectedCategoryPrice").html('<H2> &pound;' + response.price + '</H2>');
				})
			})

		})
	</script>



	<body style="background-color:powderblue;">
			<!-- form -->
		<form action="includes/order.inc.php" method="post" style='display: inline'>
			<!-- category selection system -->
			<div class="row">
				<div class="col-md-12" id="productSelectionText">
					<H2>You have  successfully logged in please choose the products you want</H2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="categorys">
							<H2>Categories</H2>
						</label>
						<!-- form to select category -->
						<select class="form-control" id="categorys" name="categorys">
							<option selected="" disabled=""> Select category </option>
							<!-- populating the category selection form -->
							<?php
							require 'data.php';
							$categorys = loadcategorys();
							foreach ($categorys as $category) {
								echo "<option id='" . $category['id'] . "' value='" . $category['id'] . "'>" . $category['category'] . "</option>";
							}
							?>
						</select>
					</div> <!-- closes dropdown bar -->
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="products">
							<H2>Products</H2>
						</label>
						<!-- form to select product -->
						<select class="form-control" id="products" name="products">

						</select>
					</div> <!-- closes dropdown bar -->
				</div>
			</div>

			<!-- displaying selected categorys information -->
			<div class="row">
				<div class="col-md-12">

					<div class="col-md-6" id="selectedCategoryLeft" name="selectedCategoryLeft"></div>
					<div class="col-md-6" id="selectedCategoryRight" name="selectedCategoryRight">
						<div class="col-md-12" id="selectedCategoryTitle" name="selectedCategoryTitle"></div>
						<div class="col-md-12" id="selectedCategoryPrice" name="selectedCategoryPrice"></div>
						<div class="col-md-12" id="selectedCategoryDesc" name="selectedCategoryDesc"></div>
					</div>
				</div>
			</div>

			<div class="row" id="orderButtonRow">
				<div class="col-md-12" id="orderButton" style="text-align:center">
					<button type="submit" class="btn btn-primary" name="order-submit">Order</button>
				</div>
			</div>
		</form>

</div>
</div>


<div class="footer">
	<p>©Copyright 2021 Electronics.com</p>
</div>
</body>

</html>