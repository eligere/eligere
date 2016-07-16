<?php 

if (!isset($_SERVER["PHP_AUTH_USER"])) {
	header("WWW-Authenticate: Basic realm=\"Inserisci le tue credenziali di accesso per Ginho!\"");
	header("HTTP/1.0 401 Unauthorized");
	die("Login rifuitato!");
} 

$username = "admin";
$password = "admin";

if (($_SERVER["PHP_AUTH_USER"] == $username) && ($_SERVER["PHP_AUTH_PW"] == $password)) {
	//Accesso all'area amministrativa con un require 
	if(!isset($_SESSION))
	{
		session_start();
	}
	$_SESSION['enableAdmin'] = true;
	header("location: mainAdmin.php"); 
	//header("WWW-Authenticate: Basic realm=\"Inserisci le tue credenziali di accesso per Ginho!\"");
	//header("HTTP/1.0 401 Unauthorized");
} else {
	header("WWW-Authenticate: Basic realm=\"Credenziali non corrette!\"");
	header("HTTP/1.0 401 Unauthorized");
}

?>