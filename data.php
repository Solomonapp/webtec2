<?php
//accessing the database
	require 'DbConnect.php';

	//acquiring all category names for drop down boxes
	if(isset($_POST['cid'])) {
		//connection
		$db = new DbConnect;
		$conn = $db->connect();

		//statement to get all products from relevent categoryID using prepared statments for security
		$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = " . $_POST['cid']);
		$stmt->execute();
		$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($products);
	}

	if(isset($_POST['pid'])){
		//connection
		$db = new DbConnect;
		$conn = $db->connect();

		//retrieving image from database relating to the product selected
		$stmt = $conn->prepare("SELECT * FROM products WHERE id = " . $_POST['pid']);
		$stmt->execute();
		$image = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//returning the selected image
		echo json_encode($image[0]);
	}


	//loads categorys
	function loadCategorys() {
		//connection
		$db = new DbConnect;
		$conn = $db->connect();

		//outputting all categorys available
		$stmt = $conn->prepare("SELECT * FROM categorys");
		$stmt->execute();
		$categorys = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $categorys;
	}

?>
