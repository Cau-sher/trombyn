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

	$ModifPrenom= getHTTPVars("ModifPrenom", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$ModifNom= getHTTPVars("ModifNom", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$ModifAdresse= getHTTPVars("ModifAdresse", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$ModifCP= getHTTPVars("ModifCP", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$ModifVille= getHTTPVars("ModifVille", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$ModifFone= getHTTPVars("ModifFone", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$ModifNaiss= getHTTPVars("ModifNaiss", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$ModifMail= getHTTPVars("ModifMail", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$ModifAutre= getHTTPVars("ModifAutre", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$ModifActiv= getHTTPVars("ModifActiv", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$ModifPass= getHTTPVars("ModifPass", $HTTP_POST_VARS, $HTTP_GET_VARS);
	$DetailId= getHTTPVars("DetailId", $HTTP_POST_VARS, $HTTP_GET_VARS);

	
	$userfile = $HTTP_POST_FILES['userfile']['tmp_name'];
$userfile_name = $HTTP_POST_FILES['userfile']['name'];
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