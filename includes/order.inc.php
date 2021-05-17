<?php
	session_start();
//ensuring user finds the page through the correct POST
if(isset($_POST['order-submit'])){

  //requires dbConnection PHP file
  require '../DbConnect.php';

  //creating registration variables from the users input
	$username = $_SESSION['userUid'];
	$phonenumber = $_SESSION['userPhone'];

	$db = new DbConnect;
	$conn = $db->connect();
	
  $stmt = $conn->prepare("SELECT emailUsers from users WHERE idUsers = ?");
  $stmt-> execute([$_SESSION['userId']]);
  $emailReturn = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach($emailReturn as $column){
      $email = $column;
  }
  
  var_dump($email);
  //select username from the product
  $stmt = $conn->prepare("SELECT name from products WHERE id = ?");
  $stmt-> execute([$_POST['products']]);
  $itemnameReturn = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach($itemnameReturn as $column){
      $itemname = $column;
  }

  $stmt = $conn->prepare("SELECT price from products WHERE id = ?");
  $stmt-> execute([$_POST['products']]);
  $itempriceReturn = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach($itempriceReturn as $column){
      $itemprice = $column;
  }
  
  $sql = "INSERT INTO orders (customerName, customerPhone, customerEmail, ordereditem, itemPrice) VALUES (?,?,?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$username, $phonenumber , $email['emailUsers'], $itemname['name'], $itemprice['price']]);
  header("Location: ../LoginIndex.php?order=success");
  exit();

}else{
	//transferring user if page found incorrectly
	header("Location: ../Register.php");
	exit();
}
