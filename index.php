<?php

	require ("config_log.inc");

	function getHHTPVars($name, $POST, $GET)
	{
		$value='';    
		 if (isset($POST[$name])) {
			$value = $POST[$name];
		 } elseif (isset($GET[$name])) {
			$value = $GET[$name];
		 } else {
			$value = '';
		 }
		 return $value;
	}

	$login = getHHTPVars('login', $_POST, $_GET);
	$pass = getHHTPVars('pass', $_POST, $_GET);

	//if(isset($HTTP_COOKIE_VAR['Id'])) {
		$Id = $_COOKIE['Id'];
	//}

	//echo $loginadm;
	//echo $passadm;
	//echo $Id;

	if ($Id=='OKDAK') {
		header("location:membres/indexmf.php?trombibox=oui");

		} else if ($Id=='ADMIN') {
		header("location:admin/indexsa.php?coordosbox=oui");
		
		} else if ($login==$loginmemb and $pass==$passmemb) {
		$pass='';
		setcookie('Id', 'OKDAK', mktime(0,0,0,1,1,2010));
		header("location:index.php");

		} else if ($login==$loginadm and $pass==$passadm) {
		$pass='';
		setcookie('Id', 'ADMIN', mktime(0,0,0,1,1,2010));
		header("location:index.php");
		
		} else {
?>

<html>
	<head>
		<title>Trombyn</title>
	</head>
	<body bgcolor="#C0C0C0">
		<img src="images/logotrombyn.gif">
		<?php include("aqua_haut.htm"); ?>

					<b>Ouvrir une généalogie</b><br>
		
					<form method="POST" action="index.php">
						<font size="2" color="red"><br />
                            Login<br />
						<input type="text" size="10" value="" name="login" /><br />
						Mot de passe<br />
						<input type="password" value="" size="10" name="pass" /></font><br /><br />
						<input type="submit" value="Connexion" name="entrer" /></p>
					</form>
		<?php include("aqua_bas.htm"); ?>
	</body>
</html>

<?php } ?>