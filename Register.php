<!-- login check -->
<?php
session_start();
if (isset($_SESSION['userId'])) header("Location: LoginIndex.php");

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

	<!-- React -->
	<script src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
	<script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
	<script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>

	<!-- https://www.w3schools.com/bootstrap/bootstrap_get_started.aspLatest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	<!-- linking the CSS -->
	<link href="css.css" rel="stylesheet" type="text/css">

	<!-- title -->
	<title>Registeration Page</title>

</head>

<!-- the navigation bar -->
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


<!-- Register Widget -->
<div class="container">
	<div class="row">
		<div>
			<div id="registerDiv" class="container"></div>
			<?php
			if (isset($_SESSION['messageRegistration'])) {
				echo $_SESSION['messageRegistration'];
				unset($_SESSION['messageRegistration']);
			}
			?>
		</div>
	</div>
</div>
<body style="background-color:powderblue;">
<script type="text/babel">
	class RegisterForm extends React.Component {
		  constructor(props) {
			super(props);
			
			this.handleNameChange = this.handleNameChange.bind(this);
			this.handlePhoneChange = this.handlePhoneChange.bind(this);
			this.handleEmailChange = this.handleEmailChange.bind(this);	
		  }
		  
			//name cannot contain numbers or special characters
			handleNameChange(e) {
				document.getElementById("nameError").innerHTML = "";
				document.getElementById("submit").disabled = false;
				var input = e.target.value;
				var inputString = input.toString();
				//this regex checks for anyhting that is not a letter or a whitespace between letters
				if(!/[A-Za-z]+$|^$|^\s$/.test(inputString)) {
					document.getElementById("nameError").innerHTML = "<font color='red'>Your name must not contain any numbers or special characters!</font>";
					//disable the button if something is inputted wrong
					document.getElementById("submit").disabled = true;
				}
		  }
			//phone number only contains numbers using regex
			  handlePhoneChange(e) {
				document.getElementById("phoneError").innerHTML = "";
				document.getElementById("submit").disabled = false;
				var input = e.target.value;
				var inputString = input.toString();
				//this regex checks for anything that is not a number, including whitespace
				if(!/^[0-9]*$/.test(inputString)) {
					document.getElementById("phoneError").innerHTML = "<font color='red'>Your phone number must only contain numbers!</font>";
					//disable the button if something is inputted wrong
					document.getElementById("submit").disabled = true;
				}
		  }
				//email must have an @ and a .com or other website
				handleEmailChange(e) {
				document.getElementById("emailError").innerHTML = "";
				document.getElementById("submit").disabled = false;
				var input = e.target.value;
				var inputString = input.toString();
				//this regex checks for correct email format
				if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(inputString)) {
					document.getElementById("emailError").innerHTML = "<font color='red'>Your email is not in the correct format! include @ . com</font>";
					//disable the button if something is inputted wrong
					document.getElementById("submit").disabled = true;
				}
		  }

		  render() {
			return (
				<div class="well col-md-offset-3 col-md-6">
				<h2>Register Here:</h2><br/>
				<div id="form-content">
                <form class="form-signup" action="includes/signup.inc.php" method="post">
				<div class="form-group">
				
                <label for="username">Name</label>
				<br/>
				<input type="text" class="form-control" name="uid" id="username" onChange={this.handleNameChange} required placeholder="John"/>
				<div id="nameError"></div>
				<br/>

                <label for="email">Email Address</label>
				<br/>
				<input type="email" class="form-control" id="mail" name="mail" onChange={this.handleEmailChange} required placeholder="John@gmail.com"/>
				<div id="emailError"></div>
				<br/>

                <label for="password">Password</label>
				<br/>
				<input type="password" class="form-control" id="password" name="pwd" onChange={this.handlePasswordChange} required placeholder="*******"/>
				<br/>

				<label for="Phone">Phone Number</label>
				<br/>
				<input type="text" class="form-control" id="Phone" name="userPhone" onChange={this.handlePhoneChange} maxlength = "10"required placeholder="0751234567"/>
				<div id="phoneError"></div>
				<br/>
                </div>
                <button type="submit" class="btn btn-large btn-info btn-block"  id = "submit" name="submit">Register </button>
				<a href="login.php">Already have an account</a>
				
                <br/>
			   </form>
			  <?php
				//using URL to find strings in
				$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

				// using the full URL scanning it for certain strings to know which error message to output
				if (strpos($fullUrl, "error=emptyfields") == true) {
					echo "<h3 class=\"error\">Registration fields empty</h3>";
				} elseif (strpos($fullUrl, "error=invalidregisterdata") == true) {
					echo "<h3 class=\"error\">Invald registration details</h3>";
				} elseif (strpos($fullUrl, "error=invalidemail") == true) {
					echo "<h3 class=\"error\">Invald registration email</h3>";
				} elseif (strpos($fullUrl, "error=invalidusername") == true) {
					echo "<h3 class=\"error\">Invald name</h3>";
				} elseif (strpos($fullUrl, "error=invalidphonenumber") == true) {
					echo "<h3 class=\"error\">Invald phonenumber</h3>";
				} elseif (strpos($fullUrl, "error=sqlerror") == true) {
					echo "<h3 class=\"error\">Registration failed, SQL Error</h3>";
				} elseif (strpos($fullUrl, "error=emailtaken") == true) {
					echo "<h3 class=\"error\">Registration failed, email already in use</h3>";
				} elseif (strpos($fullUrl, "error=phonetaken") == true) {
					echo "<h3 class=\"error\">Registration failed, phone already in use</h3>";
				} elseif (strpos($fullUrl, "signup=success") == true) {
					echo "<h3 class=\"error\">Registration successful</h3>";
				}
				?>
				
				</div>	
            </div>
			);
		  }
		}
 ReactDOM.render(<RegisterForm />, document.getElementById('registerDiv'));</script>
 
<div class="footer">
	<p>©Copyright 2021 Electronics.com</p>
</div>
</body>

</html>