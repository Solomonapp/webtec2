<?php
//ensuring user finds the page through the correct POST
if(isset($_POST['submit'])){

	//requires dbConnection PHP file
	require 'dbh.inc.php';

	//creating registration variables from the users input
	$username = mysqli_real_escape_string($conn, strip_tags ($_POST['uid']));
	$email = mysqli_real_escape_string($conn, strip_tags ($_POST['mail']));
	$password = mysqli_real_escape_string($conn, strip_tags ($_POST['pwd']));
	$phonenumber = mysqli_real_escape_string($conn, strip_tags ($_POST['userPhone']));
	
	//ensuring no fields are empty
	if(empty($username) || empty($email) || empty($password) || empty($phonenumber)){
		header("Location: ../Register.php?error=emptyfields");
		exit();
	}
	//ensuring all entered data only contains certain keys using the regex
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z]*$/", $username) && !preg_match("/^[0-9]$/", $userPhone)){
		header("Location: ../Register.php?error=invalidregisterdata");
		exit();
	}
	//validating email
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		header("Location: ../Register.php?error=invalidemail");
		exit();
	}
	//ensure username doesn't contain unwanted characters
	elseif(!preg_match("/^[a-zA-Z]*$/", $username)){
		header("Location: ../Register.php?error=invalidusername");
		exit();
	}
	//ensure phone doesnt contain unwanted characters
	elseif(!preg_match("/^[0-9]*$/", $phonenumber)){
		header("Location: ../Register.php?error=invalidphonenumber");
		exit();
	}
	else{
		$sql = "SELECT uidUsers FROM users WHERE emailUsers=?";
		$sql2 = "SELECT uidUsers FROM users WHERE phoneUsers=?";
		$stmt = mysqli_stmt_init($conn);
		$stmt2 = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../Register.php?error=sqlerror");
			exit();
		}
		if(!mysqli_stmt_prepare($stmt2, $sql2)){
			header("Location: ../Register.php?error=sqlerror");
			exit();
		}
		else{
			//making email is unique through secure means
			mysqli_stmt_bind_param($stmt, "s", $email);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);

			//ensuring phone is unique through secure means
			mysqli_stmt_bind_param($stmt2, "s", $phonenumber);
			mysqli_stmt_execute($stmt2);
			mysqli_stmt_store_result($stmt2);
			$resultCheck2 = mysqli_stmt_num_rows($stmt2);

			if($resultCheck > 0){
				header("Location: ../Register.php?error=emailtaken");
				exit();
			}
			if($resultCheck2 > 0){
				header("Location: ../Register.php?error=phonetaken");
				exit();
			}
			else{
				//registering the user through secure means with wildcards and prepared statements
				$sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, phoneUsers) VALUES (?,?,?,?)";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: ../Register.php?error=sqlerror");
					exit();
				}
				else{
					// hashing password for security
					$hashedpwd = password_hash($password, PASSWORD_DEFAULT);

					//registration statement
					mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedpwd, $phonenumber);
					mysqli_stmt_execute($stmt);
					header("Location: ../Register.php?signup=success");
					exit();
				}
			}
		}
	}
	//closing connection and deleteing stored statement
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else{
	//sends user if page found incorrectly
	header("Location: ../Register.php");
	exit();
}
?>