<?php 
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    include "connection.php";
    include "getCriteria.php";
    
    $error = '';
    $success = '';

	if(!isset($_SESSION['enableQuest'])){
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
		$elect_user = "SELECT * FROM user where first_name = '".$_POST['yourname']."' and email = '".$_POST['email']."'";
		$result = $conn->query($elect_user);
		if ($result->num_rows > 0) {		
			while($row = $result->fetch_assoc()) 		
				$_SESSION['user_id'] = $row['id'];
						 
		} else {			
			$sql_user = "INSERT INTO user (first_name, last_name, email,insert_date)
			VALUES ('$_SESSION[yourname_session]',' ','$_SESSION[email_session]','$today')";
			if ($conn->query($sql_user) === TRUE) {
				 $success =  "RECORD INSERITO CON SUCCESSO";
			} else {
				 $error =  "Error: " . $sql_user . "<br>" . $conn->error;
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
			if ($_SESSION['enableQuest']){							
				echo "<h3>Select the questionnaire</h3>";
				echo "<form class='form-inline' action='Q1.php'>
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
  
  </html>