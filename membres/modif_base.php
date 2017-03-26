<?php

function getHTTPVars($name, $POST, $GET) {
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

	$ModifPrenom= getHTTPVars("ModifPrenom", $_POST, $HTTP_GET_VARS);
	$ModifNom= getHTTPVars("ModifNom", $_POST, $HTTP_GET_VARS);
	$ModifAdresse= getHTTPVars("ModifAdresse", $_POST, $HTTP_GET_VARS);
	$ModifCP= getHTTPVars("ModifCP", $_POST, $HTTP_GET_VARS);
	$ModifVille= getHTTPVars("ModifVille", $_POST, $HTTP_GET_VARS);
	$ModifFone= getHTTPVars("ModifFone", $_POST, $HTTP_GET_VARS);
	$ModifNaiss= getHTTPVars("ModifNaiss", $_POST, $HTTP_GET_VARS);
	$ModifMail= getHTTPVars("ModifMail", $_POST, $HTTP_GET_VARS);
	$ModifAutre= getHTTPVars("ModifAutre", $_POST, $HTTP_GET_VARS);
	$ModifActiv= getHTTPVars("ModifActiv", $_POST, $HTTP_GET_VARS);
	$ModifPass= getHTTPVars("ModifPass", $_POST, $HTTP_GET_VARS);
	$DetailId= getHTTPVars("DetailId", $_POST, $HTTP_GET_VARS);

	
	$userfile = $_POST['userfile']['tmp_name'];
$userfile_name = $_POST['userfile']['name'];
$userfile_name = str_replace(" ","_",$userfile_name);


	//on vérifie que la photo comporte bien une extension jpg ou gif
	if(!ereg(".jpg$", $userfile_name) && !ereg(".gif$", $userfile_name))
	{
	    $userfile="";
	    $userfile_name="";
	    echo "<font color=green><b><i>Format de photo incorrecte, elle ne sera pas enregistrée !</i></b></font><br>";
	}

	//s'il y a photo on l'upload
	if ($userfile<>"") {		
		if (copy($userfile, "../trombi/images/mini/".$userfile_name)) {
			//echo "ok"; 
		} else {
			//echo "pas ok";
		}
	unlink($userfile);
	}
	
include ("../conex.inc");



	$query = "UPDATE coordonnees SET prenom='$ModifPrenom', nom='$ModifNom', adresse='$ModifAdresse',";
	$query=$query." cp='$ModifCP', fone='$ModifFone', ville='$ModifVille', naiss='$ModifNaiss', mail='$ModifMail',";
	$query=$query." autre='$ModifAutre', activ='$ModifActiv', pass='$ModifPass' ";
	if ($userfile_name<>"") {
		$query=$query.",photo='$userfile_name' ";
	}	
	$query=$query."WHERE id_key = '$DetailId'";
$result = mysql_query($query);


//header ('location:indexmf.php?trombibox=non&coordosbox=oui&inscripts=&listbox=');
?>

Vous pouvez maintenant fermer cette fenêtre<br><br>
<a href="javascript:window.close();">Fermer</a>