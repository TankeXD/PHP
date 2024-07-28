<?php
// include language configuration file based on selected language
$lng = "es";
if (isset($_GET['lang'])) {
    $lng = $_GET['lang'];
    $_SESSION['lang'] = $lng;
}
if( isset( $_SESSION['lang'] ) ) {
    $lng = $_SESSION['lang'];
}else {
    $lng = "es";
}
require_once ("./assets/lang-php/" . $lng . ".php");
?>