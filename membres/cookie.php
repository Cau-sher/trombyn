<?php
    //echo "--".$lekeyref."--".$valid."--".$err."--";
    setcookie("lekey", $lekeyref, mktime(0,0,0,1,1,2020));

    if ($lekeyref=='3') {
        header("location:../superadmin/indexsa.php?coordosbox=oui");
    } else {
        header("location:indexmf.php?coordosbox=oui");
    }
?>