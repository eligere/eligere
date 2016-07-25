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
	    
	if ($_SESSION['enableAdmin']){    
	    //connessione al db
	    
	    include "connection.php";   
		include "getDataFromDataBase.php";
	}
?>



<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FuzzyAHP </title>
    
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" />
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
   
  </head>
  
  <body>

	<div class="container">
	  <?php include 'staticNavBar.php'; ?>


	<?php 
		if($error != ''){			
			echo "<div class='alert alert-danger fade in'>";
			echo "<h6>".$error."</h6>";
			echo "</div>";
		}

		if($success != ''){			
			echo "<div class='alert alert-success fade in'>";
			echo "<h6>".$success."</h6>";
			echo "</div>";
		}
	?>



	<div class="alert alert-success"> Quest Section </div>

	<form class="form-inline" id = "q_criteria_form" method="post" action="<?php $_PHP_SELF ?>">					
		<!-- insert questionnarie -->	
		<div class="form-group">
			<label for="selectQuestId">Name Quest</label>
			<select name="nameQuestForCriteria" id="selectQuestId" class="form-control" >
			  	<option value=""></option>			
				<?php			
					$questArray = getAllQuest($conn);	
					foreach ($questArray as $q){
						if($q->id == $selectedQuest){
							echo "<option value='$q->id' selected> ".$q->name."</option>";
						}else{
							echo "<option value='$q->id'>".$q->name."</option>";
						}
					}
				?>			
			</select>
		</div>   		
		<button type="submit" name="select_q" class="btn btn-default">Select</button>
	</form>



	</div>
 </body>
 <div class="container">	
	<?php include 'footer.php'; ?>
 </div> 
 </html>

