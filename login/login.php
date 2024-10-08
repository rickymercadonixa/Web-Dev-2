<?php
	require 'connection.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body class="bg-dark">
	<div class="container">
<div  class="text-info">
<div class="login-form">
		<form method="post" class="form-group">
		<h2 class="display-5">SIGN IN</h2><br>

	<div class="for-group">
				<input type="text" name="user" class="form-control" placeholder="Username" require><br>

				<input type="password" name="pass" class="form-control" placeholder="Password" id="Input" require><br>


				<input type="checkbox" onclick="myFunction()"> Show Password<br><br>

				<button type="submit" name="submit" class="btn btn-success">LOGIN</button><br><br>
			</div>
		</form>
		<br><br>
		<div class="text-center"><br>
			<span class="small"></span><p>Not have an account? <a href="register.php" class="btn btn-outline-info">REGISTER</a></p><br>
		</div>
</div>
</div>
</div>

<script>
function myFunction() {
  var x = document.getElementById("Input");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>
	<?php


if(isset($_POST['submit'])){
    $user = $_POST['user'];
    $pass = $_POST['pass'];

if(empty($user) || empty($pass)){
    echo '<p class="text-danger" >Please enter username and password.</p>';
}else{
$sql = "SELECT * FROM `users` WHERE `username` = ? AND `password` = ?";
$stmt = $conn->prepare($sql);
$stmt -> bind_param("ss",$user,$pass);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

}
if ($pass != @$row['password'] && $user != @$row['username']) {
    
  echo '<p class="text-danger" >Incorrect Credentials, Please try again!</p>';
}else{
	header("Location:dashboard.php");
	exit();
}

header("Location:dashboard.php");
exit();
}

?>

</body>
</html>
<style>
	*{
		margin: 0;
		padding: 0;
		font-family: arial;
	}

	.login-form{
		text-align: center;
		width: auto;
		height: auto;
		padding: 7rem;
		transition: 0.7s;
		box-shadow: 5px 5px 15px 1px;
	}
	
	.for-group{
		height: 20svh;

	}

	input{
		font-size: 18px;
		border: none;
		border-radius: 3px;
		padding: 3px 5px 3px 5px;
		transition: 1s;
	}

	input:hover{
		box-shadow: 3px 3px 5px 3px black;
	}

	.container{
		height: 100svh;
		display: flex;
		align-items: center;
		justify-content: center;
	}
</style>