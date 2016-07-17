<?php 
/**********************************************************************************************************
 *  <ELIGERE: a Fuzzy AHP Distributed Software Platform for Group Decision Making in Engineering Design>  *
 *   Copyright (C) 2016  by Mateusz Gospodarczyk and Stanislao Grazioso                                   *
 *  																									  *
 *   ELIGERE is free software: you can redistribute it and/or modify									  *
 *   it under the terms of the GNU General Public License as 											  *
 *   published by the Free Software Foundation, either version 3 of the 								  *
 *   License, or (at your option) any later version.													  *
 *																										  *
 *   This program is distributed in the hope that it will be useful,									  *
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of										  *
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the										  *
 *   GNU General Public License for more details.														  *
 *																										  *
 *   You should have received a copy of the GNU General Public License									  *
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.								  *
 * 																										  *
 *   Contacts: mateusz.gospodarczyk@uniroma2.it and stanislao.grazioso@unina.it 						  *
 *********************************************************************************************************/
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