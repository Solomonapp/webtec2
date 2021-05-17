<!-- login check -->
<?php
session_start();
if (!isset($_SESSION['userId'])) header("Location: Login.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!--Metags-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Great electronics for sale, Quality electronics">
  <meta name="keywords" content="Mobile phone, Laptop, Dell, HP, Lenovo, Samsung, iPhone, Huawei">
  <meta name="author" content="Keele">

  <!-- bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- JavaScript link -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <!-- the CSS -->
  <link href="css.css" rel="stylesheet" type="text/css">

  <!--Title-->
  <title>Managers Page</title>
</head>

<!-- the navigation bar -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
          <a class="navbar-brand" href="managersindex.php">Electronics</a>
        </div>

        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="managersindex.php"><span class="glyphicon glyphicon-briefcase"></span> Admin</a></li>
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
            <li><a href="managersindex.php"><span class="glyphicon glyphicon-user"></span> Manager Portal</a></li>
            <li><a href="includes/logout.inc.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>



<body style="background-color:powderblue;">

  <div class="container">
    <!--form for the order api-->
    <div class="row" id="orderContent">
      <h2>Users Orders</h2>
      <form method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        Enter order ID:<br />
        <input type="text" name="id" placeholder="Enter orderNumber" />
        <br /><br />
        <input type="submit" value="submit" /><br />
      </form>

      <!--creates table for order to be filled in-->
      <table class="table">
        <thead class="thead-dark">
          <th>Order#</th>
          <th>Name</th>
          <th>Phone Number</th>
          <th>Email</th>
          <th>Order</th>
          <th>Price £</th>
          </tr>
        </thead>
    </div>
    
    <div class="footer">
      <p>©Copyright 2021 Electronics.com</p>
    </div>
  </div>

</body>

<?php
require 'DbConnect.php';

$conn = mysqli_connect("localhost", "root", "", "db1");

if (isset($_GET['id'])) {

  $order = $_GET['id'];

  $query = "SELECT * FROM orders WHERE orderNumber = '$order' LIMIT 1";


  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_num_rows($result) > 0) {

    $response["orders"] = array();

    while ($row = mysqli_fetch_array($result)) {
      $order = array();

      array_push($response["orders"], $order);

      echo '<tr> ';
      echo '<td>' . $row["orderNumber"] . '</td>';
      echo '<td>' . $row["customerName"] . '</td>';
      echo '<td>' . $row["customerPhone"] . '</td>';
      echo '<td>' . $row["customerEmail"] . '</td>';
      echo '<td>' . $row["ordereditem"] . '</td>';
      echo '<td>' . $row["itemPrice"] . '</td>';
      echo '</tr>';
    }
    // prints the oder when found


  }
}
$conn->close();
exit;
?>

</html>