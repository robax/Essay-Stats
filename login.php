<?php 
require_once("./config.php"); 
if (isset($_SESSION["register"])) {
	echo $_SESSION["register"];
	unset($_SESSION["register"]);
}
if (isset($_SESSION["login"])) {
	echo $_SESSION["login"];
	unset($_SESSION["login"]);
}
if (isset($_POST["login"])) {
	$verified = new config();
	$username = trim(htmlspecialchars($_POST["username"]));
	$password = htmlspecialchars($_POST["password"]);
	if ($verified->verified($username,$password)) {
		if (!isset($_SESSION["username"])) {
			$_SESSION["username"] = $verified->getUsername($username);
			//$_SESSION["uploads"] = retrieveArray();
			echo '<script type="text/javascript">window.location="index.php";</script>';
		} else {
			$_SESSION["login"] = '<div id="errorConfirm">Already logged in!<div>';
			echo '<script type="text/javascript">window.location="index.php?mode=login";</script>';
		}
	} else {
		$_SESSION["login"] = '<div id="errorConfirm">Incorrect username or password!</div>';
		echo '<script type="text/javascript">window.location="index.php?mode=login";</script>';
	}
}

?>
<div id="formContainer">
	<form action="" method="post">
	<div class="input">
		<div class="formLabel">Username</div>
		<div class="inputField"><input type="text" name="username" value="" maxlength="20"></div>
	</div>
	<div class="input">
		<div class="formLabel">Password</div>
		<div class="inputField"><input type="password" name="password" value=""></div>
	</div>
	<div class="formSubmit">
		<input type="submit" value="Login" name="login">
	</div>
	</form>
</div>
<div class="formMessage">New member? Register <a href="./index.php?mode=register">now</a>!</div>