<?php
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

	$userfile = $HTTP_POST_FILES['userfile']['tmp_name'];
	$userfile_name = $HTTP_POST_FILES['userfile']['name'];
	$userfile_name = str_replace(" ","_",$userfile_name);

	if(!ereg(".gif$", $userfile_name) && !ereg(".jpg$", $userfile_name))
	{
		$userfile="";
		$userfile_name="";
		echo "Format de photo incorrecte, elle ne sera pas enregistrée !";
	}

	$host = getHHTPVars('host', $HTTP_POST_VARS, $HTTP_GET_VARS);
	$nomuser = getHHTPVars("nomuser", $HTTP_POST_VARS, $HTTP_GET_VARS);
	//echo $userfile." no ".$userfile_name;
	$password = getHHTPVars("password", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$nombase = getHHTPVars("nombase", $HTTP_POST_VARS, $HTTP_GET_VARS);

	$loginadm = getHHTPVars("loginadm", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$passadm = getHHTPVars("passadm", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$loginmemb = getHHTPVars("loginmemb", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$passmemb = getHHTPVars("passmemb", $HTTP_POST_VARS, $HTTP_GET_VARS);

	$sexe = getHHTPVars("sexe", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$nom = getHHTPVars("nom", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$prenom = getHHTPVars("prenom", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$adresse = getHHTPVars("adresse", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$cp = getHHTPVars("cp", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$ville = getHHTPVars("ville", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$jnaiss = getHHTPVars("jnaiss", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$mnaiss = getHHTPVars("mnaiss", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$anaiss = getHHTPVars("anaiss", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$mail = getHHTPVars("mail", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$fone = getHHTPVars("fone", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$activ = getHHTPVars("activ", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$autre = getHHTPVars("autre", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$pass = getHHTPVars("pass", $HTTP_POST_VARS, $HTTP_GET_VARS);


	//s'il y a photo on l'upload
	if ($userfile<>"") {
		if (copy($userfile, "../trombi/images/mini/".$userfile_name)) {
			//echo "ok"; 
		} else {
			//echo "pas ok";
		}
		unlink($userfile);
	}

	include("../aqua_haut.htm");
?>

<font color=red><b>Installation de Tr@mbyn : Conexion & Inscription Administrateur</b></font><br /><br /><br />

<?php
	$chaine2 = "<font color=blue><size=2><b>"
		."host : ".$host."<br>"
		."user : ".$nomuser."<br>"
		."MdPass : ".$password."<br>"
		."nom base : ".$nombase."<br>";

		echo "<table width=50%><tr><td>".$chaine2."</td><td><b>";
		echo "<font color=red>Login Admin = ".$loginadm."<br>"
		."MdPass Admin = ".$passadm."<br>"
		."<font color=green>Login Membres = ".$loginmemb."<br>"
		."MdPass Membres = ".$passmemb."<br></b></font></td></tr></table>";

	$naiss=$anaiss."-".$mnaiss."-".$jnaiss;

	echo "<hr><table><tr><td ";
	if ($sexe=="M") { echo "bgcolor=6DB5FF"; } else { echo "color=FF6DB5"; }
	echo "><b>Administrateur</b><br><br>";
	
		$chaine = "Sexe : ".$sexe
		."<br><b>Nom : ".$nom
		."<br>Prenom : ".$prenom
		."</b><br>Adresse : ".$adresse
		."<br>Code Postal : ".$cp
		."<br>Ville : ".$ville
		."<br>Date de naissance : ".$naiss
		."<br>e_Mail : <a href=mailto:".$mail.">".$mail."</a>"
		."<br>téléphone : ".$fone
		."<br>Activité : ".$activ
		."<br>autre : ".$autre
		."<br>photo : ".$userfile_name." ".$infos
		."<i><b><br>m_de_pass : ".$pass."</b></i>";
	
	echo $chaine;

?>
		</td></tr></table>

		<form action="conex.php" method="post">	

		<input type="hidden" value="<?php echo $host; ?>" name="host">
		<input type="hidden" value="<?php echo $nomuser; ?>" name="nomuser">
		<input type="hidden" value="<?php echo $password; ?>" name="password">
		<input type="hidden" value="<?php echo $nombase; ?>" name="nombase">
		<input type="hidden" value="<?php echo $loginadm; ?>" name="loginadm">
		<input type="hidden" value="<?php echo $passadm; ?>" name="passadm">
		<input type="hidden" value="<?php echo $loginmemb; ?>" name="loginmemb">
		<input type="hidden" value="<?php echo $passmemb; ?>" name="passmemb">
		<input type="hidden" value="<?php echo $couple; ?>" name="couple">
		<input type="hidden" value="<?php echo $sexe; ?>" name="sexe">
		<input type="hidden" value="<?php echo $nom; ?>" name="nom">
		<input type="hidden" value="<?php echo $prenom; ?>" name="prenom">
		<input type="hidden" value="<?php echo $adresse; ?>" name="adresse">
		<input type="hidden" value="<?php echo $cp; ?>" name="cp">
		<input type="hidden" value="<?php echo $ville; ?>" name="ville">
		<input type="hidden" value="<?php echo $naiss; ?>" name="naiss">
		<input type="hidden" value="<?php echo $mail; ?>" name="mail">
		<input type="hidden" value="<?php echo $fone; ?>" name="fone">
		<input type="hidden" value="<?php echo $activ; ?>" name="activ">
		<input type="hidden" value="<?php echo $autre; ?>" name="autre">
		<input type="hidden" value="<?php echo $pass; ?>" name="pass">
		<input type="hidden" value="<?php echo $userfile_name; ?>" name="photo">

		<input type="submit" value="Confirmation">

		<?php include("../aqua_bas.htm"); ?>

	</body>
</html>