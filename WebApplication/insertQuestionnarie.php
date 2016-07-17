<?php 

	if(!isset($_SESSION)) 
	    { 
	        session_start(); 
	    }
	    
	if ($_SESSION['enableAdmin']){    
	    //connessione al db
	    
	    include "connection.php";   
		include "getDataFromDataBase.php";
		$selectedQuest = 0;
		$success = '';
		$error = '';
		if(!isset($descQuest))
			$descQuest = '';
		if(!isset($nameQuest))
			$nameQuest = '';
	    
	if(isset($_POST['add_quest'])){
		
		if ($conn->connect_error) {	
			die("Connection failed: " . $conn->connect_error);	
		}else{	
			
			$descQuest = $_POST['descQuest'];
			$nameQuest = $_POST['nameQuest'];
			
			//insert user	
			$today = date("Y-m-d H:i:s");
			$complete = 0;
			$dir = "media/".$_POST['nameQuest'];
			
			try {
				mkdir($dir, 0777, true);
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
			
			$sql_quest = "INSERT INTO questionnaire (name, description, date, complete,dir,password) 
						  VALUES ('$nameQuest','$descQuest','$today',$complete,'$dir','$_POST[password]')";
			if ($conn->query($sql_quest) === TRUE) {	
				$success = "Insert Success.";
			} else {
				$error = "Error: " . $sql_quest . "<br>" . $conn->error;
			}
			$last_quest_id = $conn->insert_id;
		}
	}

}
?>



<html lang="en">

<?php include("header.html");?>
  
  <body>

	<div class="container">
	  <?php 
	  $msg = "insert quest";
	  include 'staticNavBar.php'; ?>


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



	<div class="alert alert-success"> 
	<button type="submit"  name="" class="btn btn-default">
	 <span  aria-hidden="true"></span>
		<a href="mainAdmin.php"> Prev. Section </a>
	</button>
		Quest Section 
	<button type="submit"  name="" class="btn btn-default">
	 <span  aria-hidden="true"></span>
		<a href="insertAlternativeAndCriteria.php"> Next Section </a>
	</button>
	</div>



		<form class="form-inline " id = "quest_form" method="post" action="<?php $_PHP_SELF ?>">		
							
			<!-- insert questionnarie -->
			
			
			<div class="form-group">				
					<label for="nameQuestInput">Name Quest</label>		
					<input type="text" name="nameQuest" value="<?php echo $nameQuest;?>" class="form-control" id="nameQuestInput" placeholder="" required="required"/>	
					
			</div>
			<div class="form-group">
				<label for="descQuestInput">Desc Quest</label>		
				<input type="text" name="descQuest"  value="<?php echo $descQuest;?>" class="form-control" id="descQuestInput" required="required" placeholder=""/>		
				
			</div>
			<div class="form-group">
				<label for="passwordId">Pwd</label>
				<input type="text" name="password"  class="form-control" id="passwordId" required="required" placeholder=""/>		
			</div>	
			
			<button type="submit" name="add_quest" class="btn btn-default">
			 <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				Add Quest
			</button>
			
				
			
		</form>

		<div class="table-responsive">
			<?php 
				echo "<table class='table table-striped'>
					  <thead>
						<tr>
							 <th>ID</th>
							 <th>Name</th>
							 <th>Description</th>
							 <th>Password</th>
							 <th>Date</th>
						</tr>
					  </thead>";
				
				$queryQuest = getAllQuest($conn);	
				foreach ($queryQuest as $q){
					echo "<tr><td>" . $q->id. "</td>
							 	  <td>" . $q -> name. " </td>
								  <td>" . $q -> description. "</td>
								  <td>" . $q -> password. "</td>
								  <td>" .$q -> date. "</td>
								  <td>" . $q -> dir. " </td></tr>";
					
				}
				echo "</table>";
			?>
			</div>


	</div>
 </body>
  
 </html>

