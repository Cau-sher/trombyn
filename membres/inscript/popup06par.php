
<body bgcolor="#C0C0C0">
<b><font color=red>Inscription termin�e</font></b></a><br><br>

<?php
$Id = $HTTP_COOKIE_VARS['Id'];

if ($Id=='OKDAK') {

include ("../../aqua_haut.htm"); 
include ("../../conex.inc");
include ("fonctions.inc");
require ("../../config_log.inc");

$sexe = getHTTPVars("sexe", $HTTP_POST_VARS, $HTTP_GET_VARS);
$nom = getHTTPVars("nom", $HTTP_POST_VARS, $HTTP_GET_VARS);
$prenom = getHTTPVars("prenom", $HTTP_POST_VARS, $HTTP_GET_VARS);
$adresse = getHTTPVars("adresse", $HTTP_POST_VARS, $HTTP_GET_VARS);
$cp = getHTTPVars("cp", $HTTP_POST_VARS, $HTTP_GET_VARS);
$ville = getHTTPVars("ville", $HTTP_POST_VARS, $HTTP_GET_VARS);
$naiss = getHTTPVars("naiss", $HTTP_POST_VARS, $HTTP_GET_VARS);
$mail = getHTTPVars("mail", $HTTP_POST_VARS, $HTTP_GET_VARS);
$fone = getHTTPVars("fone", $HTTP_POST_VARS, $HTTP_GET_VARS);
$activ = getHTTPVars("activ", $HTTP_POST_VARS, $HTTP_GET_VARS);
$autre = getHTTPVars("autre", $HTTP_POST_VARS, $HTTP_GET_VARS);
$pass = getHTTPVars("pass", $HTTP_POST_VARS, $HTTP_GET_VARS);
$id_key_refinscript = getHTTPVars('id_key_refinscript', $HTTP_POST_VARS, $HTTP_GET_VARS);
$lefic = getHTTPVars('lefic', $HTTP_POST_VARS, $HTTP_GET_VARS);
$id_key_conjoint = getHTTPVars('id_key_conjoint', $HTTP_POST_VARS, $HTTP_GET_VARS);


	//INSERT dans la table coordonn�es
	$sqlInsert="INSERT INTO `coordonnees` (`sexe`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `fone`, `naiss`, `mail`, `pass`, `activ`, `autre`, `photo`) VALUES ('$sexe', '$nom', '$prenom', '$adresse', '$cp', '$ville', '$fone', '$naiss', '$mail', '$pass', '$activ', '$autre', '$lefic')";
	//echo $sqlInsert."<br><br>";
	
	$result = mysql_query($sqlInsert,$conexion);
	mysql_query($result);

	
	//r�cup�ration de la g�n�ration du ref_inscript
	$Sqllist="SELECT * FROM coordonnees AS coor, identifiant AS ident WHERE coor.id_key = ident.id_key_pere";

	$Resultlist = mysql_query($Sqllist,$conexion);
	mysql_query($Resultlist);
	while($Vallist=mysql_fetch_array($Resultlist)){
		$generation=$Vallist["generation"];
		$generation=$generation-1;
	}
	
		
	//r�cup�ration de l'Id_key pour avoir le m�me dans la table identifiant
	$sqlRecupId="SELECT * FROM coordonnees WHERE nom='$nom' AND prenom='$prenom'";
	//echo $sqlRecupId."<br><br>";

	$resultRecupId = mysql_query($sqlRecupId,$conexion);
	mysql_query($resultRecupId);
	while($valv=mysql_fetch_array($resultRecupId)){
		$id_key = $valv["id_key"];
	}
	
	

	
	//INSERT dans la table identifiant
	$sqlInsert1="insert into identifiant (id_key, id_key_pere, id_key_mere, statut_social, virtuel, generation, id_key_epoux) values ('$id_key', '', '', 'S', 'N', '$generation', '')";
	//echo $sqlInsert1."<br><br>";
	$result1 = mysql_query($sqlInsert1,$conexion);
	mysql_query($result1);

	//update du refinscript de l'idkeypere ou idkeymere
	if ($sexe=="M") {
		$sqlupdate="update identifiant SET id_key_pere='$id_key' WHERE id_key='$id_key_refinscript'";
		$resupdt = mysql_query($sqlupdate,$conexion);
		mysql_query($resupdt);
	}else{
		$sqlupdate="update identifiant SET id_key_mere='$id_key' WHERE id_key='$id_key_refinscript'";
		$resupdt = mysql_query($sqlupdate,$conexion);
		mysql_query($resupdt);
	}
	if ($id_key_conjoint<>"") {
		$sqlupdate="update identifiant SET id_key_epoux='$id_key',statut_social='C' WHERE id_key='$id_key_conjoint'";
		$resupdt = mysql_query($sqlupdate,$conexion);
		mysql_query($resupdt);		
		$sqlupdate="update identifiant SET id_key_epoux='$id_key_conjoint',statut_social='C' WHERE id_key='$id_key'";
		$resupdt = mysql_query($sqlupdate,$conexion);
		mysql_query($resupdt);		
	}

	

$n="Tr@mbyn";
$m="webmaster@webmaster.fr";
$nT=$nom;
$mT=$mail;
$sujet="Bienvenue%20sur%20la%20g�n�alogie";
$body="Vous venez de vous inscrire dans la g�n�alogie\nNom : ".$nom."\nPrenom : ".$prenom."\nMot de passe : ".$pass."\nMail : ".$mail."\nRappel : \nLogin du site : ".$loginmemb."\nMot de passe du site : ".$passmemb."\nadresse internet";

function sendMail($n,$m,$nT,$mT,$sujet,$body) {
   // l'�metteur
   if ($mT<>"") {   
	   $tete = "From: ".$n." <".$m.">\n";
	   $tete .= "Reply-To: ".$m."\n";
	   // et zou... false si erreur d'�mission
	   return mail($nT." <".$mT.">",$sujet,$body,$tete);
   }
}
   
	sendMail($n,$m,$nT,$mT,$sujet,$body);


?>
<H1><align=center><font color=red> Vous �tes bien enregistr�.... vous allez recevoir un mail de confirmation !<br><br><br>
<h4>Vous pouvez maintenant fermer cette fen�tre

	<?php 
include ("../../aqua_bas.htm"); 
}
?>