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

    include "connection.php";
    include "getDataFromDataBase.php";
    
    $error = '';
    $success = '';

	if(!isset($_SESSION['enableQuest'])){
		
		$job_cat = $_POST['job_hidden_name'];
		$age = $_POST['age'];
		
		
		
		if(isset($_POST['email']))
			$_SESSION['email_session']      = $_POST['email'];
		if(isset($_POST['yourname']))
			$_SESSION['yourname_session']   = $_POST["yourname"];
		
			$_SESSION['enableQuest'] = false;
		
		$array = getQuestByPWD($conn,$_POST['passwordValue']);	
		foreach ($array as $a){		
			$_SESSION['questionnaire']    = $a->description;
			$_SESSION['questionnaire_id'] = $a->id;
			$_SESSION['enableQuest'] = true;				
		}
		$today = date("Y-m-d H:i:s");
		
		//
		$elect_user = "SELECT * FROM user where email = '".$_POST['email']."'";
		$result = $conn->query($elect_user);
		if ($result->num_rows > 0) {		
			
			while($row = $result->fetch_assoc()) 		
				$_SESSION['user_id'] = $row['id'];
						 
		} else {			
		
			
			
			$nameSession = $_SESSION[yourname_session];
			$mailSession = $_SESSION[email_session];		
			
			$sql_user = "INSERT INTO user (first_name, email, insert_date, field_expert, age)
			VALUES ('$nameSession','$mailSession','$today', $job_cat, $age )";
			
			if ($conn->query($sql_user) === TRUE) {
				 $success =  "RECORD INSERITO CON SUCCESSO";
			} else {
				 $error =  "Error: " . $sql_user . "<br>" . $conn->error;
				 printf('error insert'.$conn->error);
			}
			$_SESSION['user_id'] = $conn->insert_id;
		
		}
		
		
		
		$elect_user = "SELECT * FROM questionnarie_user 
					   WHERE quest_id = ".$_SESSION['questionnaire_id']."
					   and user_id = ".$_SESSION['user_id']."";		
		$result = $conn->query($elect_user);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc())
				$_SESSION['quest_user_id'] = $row['id'];
		} else {			
			
			$sql_quest_user = " INSERT INTO questionnarie_user (quest_id, user_id, date)
			VALUES ('$_SESSION[questionnaire_id]','$_SESSION[user_id]' , '$today') ";
			if ($conn->query($sql_quest_user) === TRUE) {
				$_SESSION['quest_user_id'] = $conn->insert_id;
			} else {
				 $error = "Error: " . $sql_quest_user . "<br>" . $conn->error;
			}		
		}
		

			
	}



   
?>



<html lang="en">

  
  <?php include("header.html");?>
  
  <body>

    <div class="container">
  	  <?php	  	  
	  	  $msg =  'questionnaires';
		  include 'staticNavBar.php'; 
		  $q = $_SESSION['questionnaire'];
    		
		  if($error != ''){
		  	echo "<div class='alert alert-danger fade in'>";
		  	echo "<h6>".$error."</h6>";
		  	echo "</div>";
		  }

		  		  
	  ?>
	  
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">    
      
      
      
      
	 <div class="row">
        
	  	<?php   	 			
			// TODO - FIX DATA 
			if ($_SESSION['enableQuest']){							
				echo "<h3>Select the questionnaire</h3>";
				echo "<form class='form-inline' action='getPreferences.php'>
				      		<button type='submit' name='add_alt' class='btn btn-default'> $q </button>
					  </form>";
				
				
			}else{		
				
				header("location: index.php?errorLogin=unauthorizedUser");	
				
			}
		
		
		?>

	</div>

  </div>
</div>
</div>

   
  </body>
      <div class="container">	
		<?php include 'footer.php'; ?>
    </div>
  </html>