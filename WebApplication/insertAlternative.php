<?php 
error_reporting(E_ALL & ~E_NOTICE  & ~E_WARNING);
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    //connessione al db
    
    include "connection.php";   
	include "getCriteria.php";
	$selectedQuest = 0;
	$success = '';
	$error = '';
	$msgUpload = '';
	$msgUploadError = '';
	
	
	if(!isset($_SESSION['selectedQuest'])){		
		$_SESSION['selectedQuest'] = 0;	
	}
	
		
	if(isset($_POST['select_quest'])){	
		$_SESSION['selectedQuest'] = $_POST['nameQuest'];
	}	

	if(isset($_POST['add_alt']) && isset($_SESSION['selectedQuest']) && isset($_FILES['nameFile'])){

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}else{
			//insert user
			$today = date("Y-m-d H:i:s");
			$selectedQuest = $_SESSION['selectedQuest'];
			$quest = getQuestById($conn,$selectedQuest);
			
			$dir = "media/".$quest->name."/".$_POST['nameAlt'];	
			
			try {
				mkdir($dir, 0777, true);
			} catch (Exception $e) {
				$msgUpload  =  "Caught exception: ".  $e->getMessage(). "\n";
			}
			
			//
			$target_file = $dir ."/". basename($_FILES["nameFile"]["name"]);
			
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			try {
				$check = getimagesize($_FILES["nameFile"]["tmp_name"]);
				if($check !== false) {
					$msgUpload =  "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					$msgUploadError =   "File is not an image.";
					$uploadOk = 0;
				}
			} catch (Exception $e) {
				$msgUploadError =   "Problem with image size.";
				$uploadOk = 0;
			}

			
			if (file_exists($target_file)) {
				$msgUploadError= "Sorry, file already exists.";
				$uploadOk = 0;
			}
			
			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				
				// if everything is ok, try to upload file
			} else {
				
				if (move_uploaded_file($_FILES["nameFile"]["tmp_name"], $target_file)) {
					$msgUpload =   "The file ". basename( $_FILES["nameFile"]["name"]). " has been uploaded.";
				} else {
					$msgUploadError =   "Sorry, there was an error uploading your file.";
				}
				
				$sql_alt = "INSERT INTO alternative (name, description, date_insert, questionnaire_id, dir_path_file ,dir_path)
				VALUES ('$_POST[nameAlt]','$_POST[descAlt]','$today' , '$selectedQuest','$target_file','$dir')";
				if ($conn->query($sql_alt) === TRUE) {
					$success = "Insert Success";
				} else {
					$error = "Error: " . $sql_alt . "<br>" . $conn->error;
				}
				
			}
			
					
			

			
		}
	}


if(isset($_POST['add_criteria'])){

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else{
		//insert user
		$today = date("Y-m-d H:i:s");
		$selectedQuest = $_SESSION['selectedQuest'];
		$sql_cri = "INSERT INTO criteria (name, description, date_insert, quest_id)
		VALUES ('$_POST[nameCri]','$_POST[descCri]','$today' , $selectedQuest)";
		if ($conn->query($sql_cri) === TRUE) {
			$success = "Insert Success";
		} else {
			$error = "Error: " . $sql_cri . "<br>" . $conn->error;
		}
		
	}
}



?>

<html lang="en">

<?php include("header.html");?>
  
  <body>

	<div class="container">
	  <?php 
	  $msg = "Insert Alternative and Criteria";
	  include 'staticNavBar.php'; 
	  
	  ?>

	<?php 
	
		if($error != '' ){			
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




	<form class="form-inline" id = "select_quest_form" method="post" action="<?php $_PHP_SELF ?>">		
	
		<div class="form-group">
			<label for="selectQuestId">Name Quest</label>
			<select name="nameQuest" id="selectQuestId" class="form-control">
			  	<option value=""></option>			
				<?php			
					$questArray = getAllQuest($conn);	
					foreach ($questArray as $q){
						if($q->id == $_SESSION['selectedQuest']){
							echo "<option value='$q->id' selected> ".$q->name."</option>";
						}else{
							echo "<option value='$q->id'>".$q->name."</option>";
						}
					}
				?>			
			</select>
		</div>   
			
		<button type="submit" name="select_quest" class="btn btn-default">Select Quest</button>
		
	</form>

	
	
	<form class="form-inline" id = "alternative_form" method="post" action="<?php $_PHP_SELF ?>"
		  enctype="multipart/form-data">		
				
		<?php 		
			if($msgUploadError != ''){
		    echo "<div class='alert alert-danger' role='alert'>
			  <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
			  <span class='sr-only'>Error:</span>".$msgUploadError."</div>";	
			}
			if($msgUpload != ''){
				echo "<div class='alert alert-success' role='alert'>
			  <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
			  <span class='sr-only'>Error:</span>".$msgUpload."</div>";
			}
		?>
		
		<!-- insert questionnarie -->
			
	
		
		<p class="alert alert-success"> 
		<button type="submit"  name="" class="btn btn-default">
	 <span  aria-hidden="true"></span>
		<a href="insertData.php"> Prev. Section </a>
	</button>
		Alternative Section 
			<button type="submit"  name="" class="btn btn-default">
		 <span  aria-hidden="true"></span>
			<a href="insertQuestions.php"> Next Section </a>
		</button>
		</p> 
	    
	    <div class="form-group">
	 		<label for="nameAltInput">Name Alt</label>
			<input type="text" name="nameAlt" class="form-control" id="nameAltInput" placeholder="" required="required"/>	
		</div>
		<div class="form-group">
			<label for="descAltInput">Desc Alt</label>
			<input type="text" name="descAlt"  class="form-control" id="descAltInput" required="required" placeholder=""/>		
		</div>	
		
		<div class="form-group">
	 		<label for="fileUploadID">Select image to upload</label>
			<input type="file" name="nameFile" class="form-control" id="fileUploadID" 
				   placeholder="" />	
		</div>
		
		
		<button type="submit" name="add_alt" class="btn btn-default">Add Alt</button>
		
	</form>


	<div class="table-responsive">
	<?php	
	
		
		echo "<table class='table table-striped'>
	    	 <thead><tr><th>ID</th><th>Name</th>
						<th>Description</th>
						<th>Quest ID</th>
						<th>dir </th> 
			</tr></thead><tbody>";
			 $altArray = getAllAlternativeByQuestID($conn,$_SESSION['selectedQuest']);
			 foreach ($altArray as $q){				
				echo "<tr>
					  		<td>"  . $q->id. "</td>
					  		<td>"  . $q->name." </td>
							<td>"  .$q->description."</td>".
				 		    "<td>" .$q->quest_id."</td>".
							"<td>" .
								"<img src='$q->dir_path_file' alt='$q->description' style='width:50px;height:50px;'>".
							"</td>".
					  "</tr>";
			
				
				
		}	
		echo "</tbody></table>";
	?>
	</div>



	<p class="alert alert-success"> Criteria Section </p>
	<form class="form-inline" id = "criteria_form" method="post" 
			action="<?php $_PHP_SELF ?>">		
				
		<!-- insert questionnarie -->
		  
	    <div class="form-group">
	 		<label for="nameCriInput">Name Criteria</label>
			<input type="text" name="nameCri" class="form-control" id="nameCriInput" placeholder="" required="required"/>	
		</div>
		<div class="form-group">
			<label for="descCriInput">Desc Criteria</label>
			<input type="text" name="descCri"  class="form-control" id="descCriInput" required="required" placeholder=""/>		
		</div>	
		
		<button type="submit" name="add_criteria" class="btn btn-default">Add Alt</button>
		
		
		
	</form>

		<div class="table-responsive">
			<?php	
				echo "<table class='table table-striped'>
			    	 <thead><tr><th>ID</th><th>Name</th><th>Description</th><th>Quest ID</th></tr></thead><tbody>";
				$criArray = getAllCriteriaByQuestId($conn,$_SESSION['selectedQuest']);
				foreach ($criArray as $q){				
					echo "<tr><td>" . $q->id. "</td>
						  <td>" .$q->name." </td><td>".$q->description."</td>".
									      " </td><td>".$q->quest_id."</td></tr>";
					
				}	
				echo "</tbody></table>";
			?>
		</div>


	</div>
	
	
	
 	</body>
  
 </html>
 
 
 
