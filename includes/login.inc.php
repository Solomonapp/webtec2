<?php
//ensuring user gets to this page through the correct channels
if(isset($_POST['login-submit'])){
	//requires connection to database
	require 'dbh.inc.php';
	//input user information
	$phoneuid = mysqli_real_escape_string($conn, strip_tags ($_POST['phoneuid']));
	$password = mysqli_real_escape_string($conn, strip_tags ($_POST['pwd']));

	//ensuring the fields aren't empty on POST
	if(empty($phoneuid) || empty($password)){
		header("Location: ../Login.php?error=loginfieldsempty");
		exit();
	}
	//ensuring the users inputs can be found in the database
	else{
		$sql = "SELECT * FROM users WHERE uidUsers=? OR phoneUsers=?;";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../Login.php?error=sqlerror");
			exit();
		}
		else{
			//ensuring the username and password match using secure methodology
			mysqli_stmt_bind_param($stmt, "ss", $phoneuid, $phoneuid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($row = mysqli_fetch_assoc($result)){
				$pwdCheck = password_verify($password, $row['pwdUsers']);
				if($pwdCheck == false){
					header("Location: ../Login.php?error=wronguserorpass");
					exit();
				}
				//successful login
				elseif($pwdCheck == true){
							//session is then created
							session_start();
							//assinging session variables
							$_SESSION['userId'] = $row['idUsers'];
							$_SESSION['userUid'] = $row['uidUsers'];
							//storing sensitive information in session variables.
							$_SESSION['userPhone'] = $row['phoneUsers'];
							$_SESSION['userPwd'] = $row['pwdUsers'];
							//Manager
							if($phoneuid == "0101010101"){
								header("Location: ../managersindex.php");
								exit();
							}else{
								header("Location: ../LoginIndex.php");
								exit();
							}
							}else{
								//incase wrong password established
								header("Location: ../Login.php?error=wronguserorpass");
								exit();
							}
						}
						else{
							//incase wrong email address used
							header("Location: ../Login.php?error=emailnotfound");
							exit();
					}
			}
	}
}
else{
	//if not found the user is redirected
	header("Location: ../Index.php");
	exit();
}
