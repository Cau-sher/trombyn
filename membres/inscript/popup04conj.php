<body bgcolor="#C0C0C0">
<b><font color=red>Inscription terminée</font></b></a><br><br>

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
$lefic = getHTTPVars("lefic", $HTTP_POST_VARS, $HTTP_GET_VARS);
$id_key_refinscript = getHTTPVars('id_key_refinscript', $HTTP_POST_VARS, $HTTP_GET_VARS);
$sex_refinscript = getHTTPVars('sex_refinscript', $HTTP_POST_VARS, $HTTP_GET_VARS);


	if ($sex_refinscript=="M") {
		$sexe="F";
	} else {
		$sexe="M";
	}


	//INSERT dans la table coordonnées
	$sqlInsert="INSERT INTO `coordonnees` (`sexe`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `fone`, `naiss`, `mail`, `pass`, `activ`, `autre`, `photo`) VALUES ('$sexe', '$nom', '$prenom', '$adresse', '$cp', '$ville', '$fone', '$naiss', '$mail', '$pass', '$activ', '$autre', '$lefic')";
	$result = mysql_query($sqlInsert,$conexion);
	mysql_query($result);

	
	//récupération de la génération du ref_inscript
	$Sqllist="SELECT * FROM coordonnees AS coor, identifiant AS ident WHERE coor.id_key = $id_key_refinscript";
	//echo $Sqllist."<br><br>";	

	$Resultlist = mysql_query($Sqllist,$conexion);
	mysql_query($Resultlist);
	while($Vallist=mysql_fetch_array($Resultlist)){
		$generation=$Vallist["generation"];
	}
	
		
	//récupération de l'Id_key pour avoir le même dans la table identifiant
	$sqlRecupId="SELECT * FROM coordonnees WHERE nom='$nom' AND prenom='$prenom'";
	//echo $sqlRecupId."<br><br>";
	$resultRecupId = mysql_query($sqlRecupId,$conexion);
	mysql_query($resultRecupId);
	while($valv=mysql_fetch_array($resultRecupId)){
		$id_key = $valv["id_key"];
	}
	
	
	//INSERT dans la table identifiant
	$sqlInsert1="insert into identifiant (id_key, id_key_pere, id_key_mere, statut_social, virtuel, generation, id_key_epoux) values ('$id_key', '', '', 'C', 'N', '$generation', '$id_key_refinscript')";
	//echo $sqlInsert1."<br><br>";
	$result1 = mysql_query($sqlInsert1,$conexion);
	mysql_query($result1);
	
	//update du ref_inscript pour id_key_epoux et statut_social
	$SqlUpdateRef = "UPDATE identifiant SET id_key_epoux='$id_key', statut_social='C' WHERE id_key='$id_key_refinscript'";
	//echo $SqlUpdateRef;
	$ResultUpdateRef = mysql_query($SqlUpdateRef,$conexion);
	mysql_query($ResultUpdateRef);



	
	
		


$n="Tr@mbyn";
$m="webmaster@webmaster.fr";
$nT=$nom;
$mT=$mail;
$sujet="Bienvenue%20sur%20la%20généalogie";
$body="Vous venez de vous inscrire dans la généalogie\nNom : ".$nom."\nPrenom : ".$prenom."\nMot de passe : ".$pass."\nMail : ".$mail."\nRappel : \nLogin du site : ".$loginmemb."\nMot de passe du site : ".$passmemb."\nadresse internet";

function sendMail($n,$m,$nT,$mT,$sujet,$body) {
   // l'émetteur
   $tete = "From: ".$n." <".$m.">\n";
   $tete .= "Reply-To: ".$m."\n";
   // et zou... false si erreur d'émission
   return mail($nT." <".$mT.">",$sujet,$body,$tete);
   }
   
sendMail($n,$m,$nT,$mT,$sujet,$body);

?>
<H1><align=center><font color=red> Vous êtes bien enregistré.... vous allez recevoir un mail de confirmation !<br><br><br>
<h4>Vous pouvez maintenant fermer cette fenêtre

	<?php 
include ("../../aqua_bas.htm");
}
?>