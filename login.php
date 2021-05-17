<!-- login check -->
<?php
session_start();
if (isset($_SESSION['userId'])) header("Location: LoginIndex.php");

?>
<!DOCTYPE html>
<html>

<head>
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
	<!-- React -->
	<script src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
	<script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
	<script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
	<!-- system title -->
	<title>Login</title>
</head>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
					<a class="navbar-brand" href="index.php">Electronics</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
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
						<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
						<li><a href="Register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</nav>


<div class="container">
	<div class="row">
		<div>
			<div id="loginDiv" class="container"></div>

			<?php
			if (isset($_SESSION['message'])) {
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			}
			?>
		</div>
	</div>
</div>

<body style="background-color:powderblue;">
	<script type="text/babel">
		class LoginForm extends React.Component {
           constructor(props) {
         	super(props);

         	this.handlePhoneChange = this.handlePhoneChange.bind(this);
           }
         
           //phone number only contains numbers using regex
           handlePhoneChange(e) {
         		document.getElementById("loginphoneError").innerHTML = "";
         		document.getElementById("login-submit").disabled = false;
         		var input = e.target.value;
         		var inputString = input.toString();
         		//this regex checks for anything that is not a number, including whitespace
         		if(!/^[0-9]*$/.test(inputString)) {
         			document.getElementById("loginphoneError").innerHTML = "<font color='red'>Your phone number must only contain numbers!</font>";
         			//disable the button if something is inputted wrong
         			document.getElementById("login-submit").disabled = true;
         		}
           }
         
           render() {
         	return (
         	<div class="well col-md-offset-3 col-md-6">
         	<h2> Login Here: </h2>
         	<div id="form-content">
         
         
         	 <form class="form-login" action="includes/login.inc.php" method="post">
         		<div class="form-group">
         
         			<label for="Phone">Phone Number</label>
					 <br/>
         			<input type="text" class="form-control" id="phoneInput" name="phoneuid" onChange={this.handlePhoneChange} maxlength = "10"required placeholder="Enter phone"/>
					 <div id="loginphoneError"></div>
					 <br/>
         			
         			<label for="passwordInput">Password</label>
					 <br/>
         			<input type="password" class="form-control"  name="pwd" placeholder="Enter Password" required />
         			<br/>
         			
         			</div>
         		
         		<button type="submit" class="btn btn-large btn-info btn-block" value="Login" id="login-submit" name="login-submit">Login</button>
         		<br/><br/>
				<a href="Register.php">Not registered? Create an account</a>

         		</form>
         	
         	
         	<?php
				//acquiring URL to find strings in
				$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

				// using the full URL scanning it for certain strings to know which error message to output
				if (strpos($fullUrl, "error=loginfieldsempty") == true) {
					echo "<h3 class=\"error\">Login fields empty</h3>";
				} elseif (strpos($fullUrl, "error=sqlerror") == true) {
					echo "<h3 class=\"error\">Login failed, SQL error</h3>";
				} elseif (strpos($fullUrl, "error=wronguserorpass") == true) {
					echo "<h3 class=\"error\">Login failed, wrong phone number or password</h3>";
				} elseif (strpos($fullUrl, "error=emailnotfound") == true) {
					echo "<h3 class=\"error\">Login failed, phone number or login not found</h3>";
				}
				?>
         </div>
         
         
         
         </div> 
               );
           }
         }
         
         ReactDOM.render(<LoginForm />, document.getElementById('loginDiv'));
      </script>

	<div class="footer">
		<p>©Copyright 2021 Electronics.com</p>
	</div>
</body>

</html>