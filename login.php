<?php

session_start();

if( isset($_SESSION['user_id']) ){
	header("Location: /");
}

require 'database.php';

if(!empty($_POST['user']) && !empty($_POST['pass'])) {
	$records = $conn->prepare('SELECT user,pass FROM users WHERE user = :user');
	$records->bindParam(':user', $_POST['user']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
	
	$message = '';
	
	if ($results == true) {
		if(count($results) > 0 && password_verify($_POST['pass'], $results['pass']) ){
			$_SESSION['user_id'] = $results['user'];
			header("Location: /");
		} else {
			$message = 'Sorry, those credentials do not match.';
		}
	} else {
			$message = 'Sorry, that user does not exist.';
	}
} else {
	$message = '';
}
?>

<html>
	<head>
		<title> xterprises </title>
		<link href="style/login.css" rel="stylesheet" id="bootstrap-css">
		<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
	</head>
	<body>
		<div class="wrapper fadeInDown">
		  <div id="formContent">
			<p>Login to Xterprises</p>
			<form class="formFields" action="login.php" method="POST">
			  <input type="text" id="user" name="user" placeholder="username">
			  <input type="password" id="pass" name="pass" placeholder="password">
			  <input type="submit" value="Log In">
			</form>

			<?php if(!empty($message)): ?>
				<p><?= $message ?></p>
			<?php endif; ?>

			<div id="formFooter">
			  <a class="underlineHover" href="register">Create an Account</a>
			  <br/>
			  <a class="underlineHover" href="/">Back to homepage</a>
			</div>
		  </div>
		</div>
	</body>
</html>