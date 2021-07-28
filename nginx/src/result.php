<?php
session_save_path('/data-ext/sessions');
ini_set('session.gc_probability', 1);
session_start();
include "a_HomePage.php";
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past


if (strlen ($auth_icon) <= 1) $auth_icon = "img/canary-french.png";

if ($auth_version == 1)
    echo '<div align="center"><img src="img/captain-america.png" id ="logo" width="200px" /></div>';
else
    echo '<a onclick="goto(\'error\')"><div align="center"><img src="'.$auth_icon.'" id="newlogo" width="200px"/></div></a>'; //new image

if (strlen($auth_message) > 1)
    echo '<div style="opacity: 0.5;background-color:#FFFFFF;font-size:+20px" align="center" id="error_message"><b>'.$auth_message.'</b></div>';
?>