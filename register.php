<?php
//testUSER!!!!999999999991人🍛🍣🍦🍜🥠
function chkLen($p) {
	return mb_strlen($p) < 8 || mb_strlen($p) > 40;
}
function chkNumCnt($p) {
	$nc = mb_strlen(preg_replace('/[^0-9]/', '', $p));
	return $nc < 2 || $nc > 16;
}
function chkChrCnt($p) {
	return mb_strlen($p) % 5 != 0;
}
function chkScrCnt($p) {
	return strlen(preg_replace('/^[\w&.\-]+$/', '', $p)) < 3;
}
function chkCase($p) {
	return strlen(preg_replace('/[^a-z]/', '', $p)) != strlen(preg_replace('/[^A-Z]/', '', $p));
}
function chkNumVal($p) {
	$ca = unpack('C*', preg_replace('/[0-9]/', '', $p));
	$sum = array_sum(array_map(function($i) { return $i - 48; }, $ca));
	return $sum == 100;
}
function chkKanji($p) {
	$tskanji = array('丁', '七', '九', '了', '二', '人', '入', '八', '刀', '力', '十', '又', '乃');
	foreach ($tskanji as $k) {
		if (strpos($p, $k) !== false) {
			return false;
		}
	}
	return true;
}
function chkTextVal($p) {
	$ca = unpack('C*', preg_replace('/[a-zA-Z]/', '', $p));
	$sum = array_sum(array_map(function($i) { return $i; }, $ca));
	return $sum == 1000;
}
function chkEmoji($p) {
	$femoji = array('🍇', '🍈', '🍉', '🍊', '🍋', '🍌', '🍍', '🥭', '🍎', '🍏', '🍐', '🍑', '🍒', '🍓', '🥝', '🍅', '🥥', '🥑', '🍆', '🥔', '🥕', '🌽', '🌶', '🥒', '🥬', '🥦', '🍄', '🥜', '🌰', '🍞', '🥐', '🥖', '🥨', '🥯', '🥞', '🧀', '🍖', '🍗', '🥩', '🥓', '🍔', '🍟', '🍕', '🌭', '🥪', '🌮', '🌯', '🥙', '🍳', '🥘', '🍲', '🥣', '🥗', '🍿', '🧂', '🥫', '🍱', '🍘', '🍙', '🍚', '🍛', '🍜', '🍝', '🍠', '🍢', '🍣', '🍤', '🍥', '🥮', '🍡', '🥟', '🥠', '🥡', '🍦', '🍧', '🍨', '🍩', '🍪', '🎂', '🍰', '🧁', '🥧', '🍫', '🍬', '🍭', '🍮', '🍯', '🍼', '🥛', '☕', '🍵', '🍶', '🍾', '🍷', '🍸', '🍹', '🍺', '🍻', '🥂', '🥃', '🥤');
	$tot = 0;
	foreach ($femoji as $k) {
		if (strpos($p, $k) !== false) {
			$tot++;
		}
	}
	return $tot < 5;
}

session_start();

if( isset($_SESSION['user_id']) ){
	header("Location: /");
}

require 'database.php';

$message = '';

if(!empty($_POST['user']) && !empty($_POST['pass'])) {
	
	$p = $_POST['pass'];
	
	if (chkLen($p)) {
		$message = 'The password must be between 8 and 40 characters characters.';
		goto ex;
	}
	if (chkNumCnt($p)) {
		$message = 'The password must contain at least 2 to 16 numbers.';
		goto ex;
	}
	if (chkChrCnt($p)) {
		$message = 'The password length must be divisible by 5.';
		goto ex;
	}
	if (chkScrCnt($p)) {
		$message = 'The password must contain at least three special characters.';
		goto ex;
	}
	if (chkCase($p)) {
		$message = 'The password must contain equal number of lower and uppercase characters.';
		goto ex;
	}
	if (chkNumVal($p)) {
		$message = 'The numbers in the password must all add up to exactly 100.';
		goto ex;
	}
	if (chkKanji($p)) {
		$message = 'The password must contain at least one two stroke kanji.';
		goto ex;
	}
	if (chkTextVal($p)) {
		$message = 'The ascii values of all of the letters in the password must add up to exactly 1000.';
		goto ex;
	}
	if (chkEmoji($p)) {
		$message = 'The password must contain at least five different food emoji.';
		goto ex;
	}
	
	$chk = $conn->prepare('SELECT user FROM users WHERE user = :user');
	$chk->bindParam(':user', $_POST['user']);
	$chk->execute();
	$results = $chk->fetch(PDO::FETCH_ASSOC);
	
	if ($results == false) {
		$stmt = $conn->prepare('INSERT INTO users (user, pass) VALUES (:user, :pass)');

		$pshs = password_hash($_POST['pass'], PASSWORD_BCRYPT);
		$stmt->bindParam(':user', $_POST['user']);
		$stmt->bindParam(':pass', $pshs);

		if( $stmt->execute() ) {
			$message = 'Successfully registered!';
		} else {
			$message = 'Sorry, there was an issue creating that account.';
		}
	} else {
		$message = 'Sorry, that user already exists.';
	}
	ex:
}

?>

<html>
	<head>
		<title> xterprises </title>
		<link href="style/login.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> 
	</head>
	<body>
		<div class="wrapper fadeInDown">
			<div id="formContent">
				<p>Register on Xterprises</p>
				<form class="formFields" action="register.php" method="POST">
					<input type="text" id="user" name="user" placeholder="username">
					<input type="password" id="pass" name="pass" placeholder="password">
					<input type="submit" value="Register">
					<br/>
					<label><input type="checkbox" onclick="visiblePass(this)"> Password Visible</label>
				</form>
		
				<?php if(!empty($message)): ?>
					<p><?= $message ?></p>
				<?php endif; ?>
		
				<div id="formFooter">
				<a class="underlineHover" href="login">Back to Login page</a>
				</div>
			</div>
		</div>
		<script>
		function visiblePass(v) {
			var u = document.getElementById("pass");
			if (v.checked) {
				u.type = "text";
			} else {
				u.type = "password";
			}
		}
		</script>
	</body>
</html>