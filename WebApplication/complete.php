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
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FuzzyAHP</title>
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
   

  </head>



  <body>

	<div class="container">
	  <?php include 'staticNavBar.php'; ?>
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
      

	<?php 
	
	include "connection.php";   
	
	// Check connection
	if ($conn->connect_error) {
		
		die("Connection failed: " . $conn->connect_error);
	
	}else{
		
		
		//insert user
		
		$sql_user = "INSERT INTO user (first_name, last_name, email) VALUES ('$_SESSION[yourname_session]',' ','$_SESSION[email_session]')";
			
		if ($conn->query($sql_user) === TRUE) {		
			
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$last_user_id = $conn->insert_id;
		$_SESSION['user_id'] = $last_user_id;
		
		
		$Questionario =  $_SESSION["questionnaire"];					
		
		//dynamic insert
		$count = 1;
		$Domanda =  "q".(string)$count;
		$Risposta = "r".(string)$count;
		
		
		while (isset($_POST[$Domanda]) && isset($_POST[$Risposta])){
		
			$sql = "INSERT INTO questions 
					(Questionario, user, Domanda, Risposta)
					VALUES ('$Questionario', $last_user_id, '$_POST[$Domanda]', '$_POST[$Risposta]')";
			
			if ($conn->query($sql) === TRUE) {
				
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			
			$count = $count+1;
			$Domanda =  "q".(string)$count;
			$Risposta = "r".(string)$count;
		}
		
	
		
		
	}
	
		session_unset();
		// Infine , distrugge la sessione.
		session_destroy();
	
	?>  

      </div>

    </div>
    

</body>

</html>





