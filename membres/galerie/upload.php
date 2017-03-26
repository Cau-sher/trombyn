<?php

	require ("../fonctions.inc");

$Id = $HTTP_COOKIE_VARS['Id'];
	
if ($Id=='OKDAK') {

include ("../../conex.inc");


$categ = $HTTP_POST_VARS["categ"];
$descript = $HTTP_POST_VARS["descript"];
$userfile = $HTTP_POST_FILES['userfile']['tmp_name'];
$userfile_name = $HTTP_POST_FILES['userfile']['name'];
$userfile_name = str_replace(" ","_",$userfile_name);

	//on vérifie que la photo comporte bien une extension jpg ou gif
	if(!ereg(".gif$", $userfile_name) && !ereg(".jpg$", $userfile_name))
	{
	    $userfile="";
	    echo "<font color=red>Format de photo incorrecte, elle ne sera pas enregistrée !<br><a href=../indexmf.php?photos=oui>retour</a>";
	}

	if ($userfile<>"") {
		if (copy($userfile, "uploadimg/".$userfile_name)) {
			

		} else {
			//echo "pas ok";
		}
		unlink($userfile);
	$query = "INSERT INTO foto(url,categorie,description)";
   $query .= " VALUES('$userfile_name','$categ','$descript')"; 
   $result = mysql_query($query);
   header("Location: minicrea.php?photos=oui&nomfoto=".$userfile_name); 

	}


   

}
?>