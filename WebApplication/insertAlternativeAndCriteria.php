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
error_reporting(E_ALL & ~E_NOTICE  & ~E_WARNING);
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    //connessione al db
    
    include "connection.php";   
	include "getDataFromDataBase.php";
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

	if(isset($_POST['add_alt']) && isset($_SESSION['selectedQuest']) ){

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
				echo $msgUpload;
			}
			
			//
			$uploadOk = 0;
			$target_file = '';
			

				
					
					
				$uploadOk = 1;
				$target_file = $dir ."/". basename($_FILES["nameFile"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				
				try {
					$check = getimagesize($_FILES["nameFile"]["tmp_name"]);
					if($check !== false) {
						$msgUpload =  "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						$msgUploadError =   "File is not an image.";
						$uploadOk = -1;
					}
				} catch (Exception $e) {
					$msgUploadError =   "Problem with image size.";
					$uploadOk = -1;
				}
				
				if (file_exists($target_file)) {
					$msgUploadError= "Sorry, file already exists.";
					$uploadOk = -1;
				}
				
			
			
			print("dir:".$dir."target_file:".$target_file);
			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == -1) {
				
				// if everything is ok, try to upload file
			} else {
				
				if($uploadOk == 1){
					if (move_uploaded_file($_FILES["nameFile"]["tmp_name"], $target_file)) {
						$msgUpload =   "The file ". basename( $_FILES["nameFile"]["name"]). " has been uploaded.";
					} else {
						$msgUploadError =   "Sorry, there was an error uploading your file.";
					}
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

if (isset($_POST['action']) && $_POST['action'] == 'deleteCri') {
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	if ($id > 0) {
		$query = "DELETE FROM criteria WHERE id=".$id." LIMIT 1";
		$result = mysqli_query($conn, $query);
		echo 'ok';
	} else {
		echo 'err';
	}
	exit; // finish execution since we only need the "ok" or "err" answers from the server.
}
if (isset($_POST['action']) && $_POST['action'] == 'deleteAlt') {
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	if ($id > 0) {
		$query = "DELETE FROM alternative WHERE id=".$id." LIMIT 1";
		$result = mysqli_query($conn, $query);
		echo 'ok';
	} else {
		echo 'err';
	}
	exit; // finish execution since we only need the "ok" or "err" answers from the server.
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
			<a href="insertQuestionnarie.php"> Prev. Section </a>
		</button>
	
		Alternative Section 
		<button type="submit"  name="" class="btn btn-default">
		 <span  aria-hidden="true"></span>
			<a href="insertQuestions.php"> Next Section </a>
		</button>
		</p> 
	    
		
	    <div class="form-group">
	 		<label for="nameAltInput">Tag Alt.</label>
			<input type="text" name="nameAlt" class="form-control" id="nameAltInput" placeholder="" required="required"/>	
		</div>
		<div class="form-group">
			<label for="descAltInput">Desc. Alt</label>
			<input type="text" name="descAlt"  class="form-control" id="descAltInput" required="required" placeholder=""/>		
		</div>	
		
		<div class="form-group">
	 		<label for="fileUploadID">Upload media file</label>
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
						<th>Path </th>
						<th>Delete </th> 
			</tr></thead><tbody>";
			 $altArray = getAllAlternativeByQuestID($conn,$_SESSION['selectedQuest']);
			 foreach ($altArray as $q){		
			 	
			 	echo '<tr>
				    <td class="tdate">' . $q->id . '</td>
				    <td class="player">' .$q->name. '</td>
				    <td class="tinfo">' . $q->description . '</td>
				    <td class="stake">' . $q->quest_id . '</td> <td>';
			 	echo "<img src='$q->dir_path_file' alt='$q->description' style='width:50px;height:50px;'>";
			 	echo '</td> <td><button class="delete_alt" data-id="' . $q->id . '"> Delete </button></td>
		  		</tr>';
			 
			
				
				
		}	
		echo "</tbody></table>";
	?>
	</div>



	<p class="alert alert-success"> Criteria Section </p>
	<form class="form-inline" id = "criteria_form" method="post" 
			action="<?php $_PHP_SELF ?>">		
				
		<!-- insert questionnarie -->
		  
	    <div class="form-group">
	 		<label for="nameCriInput">Tag Criteria</label>
			<input type="text" name="nameCri" class="form-control" id="nameCriInput" placeholder="" required="required"/>	
		</div>
		<div class="form-group">
			<label for="descCriInput">Desc. Criteria</label>
			<input type="text" name="descCri"  class="form-control" id="descCriInput" required="required" placeholder=""/>		
		</div>	
		
		<button type="submit" name="add_criteria" class="btn btn-default">Add Alt</button>
		
		
		
	</form>

		<div class="table-responsive">
			<?php	
				echo "<table class='table table-striped'>
			    	 <thead><tr><th>ID</th><th>Name</th><th>Description</th><th>Quest ID</th><th>Delete</th></tr></thead><tbody>";
				$criArray = getAllCriteriaByQuestId($conn,$_SESSION['selectedQuest']);
				foreach ($criArray as $q){			
					echo '<tr><td>' . $q->id .   '</td>
						  <td>' . $q->name . '</td>
						  <td>' . $q->description . '</td>
		 				  <td>' . $q->quest_id . '</td>
		    			  <td>' . '<button class="delete_cri" data-id="' . $q->id . '"> Delete </button></td>
					</tr>';

					
				}	
				echo "</tbody></table>";
			?>
		</div>


	</div>
	
	      <div class="container">	
		<?php include 'footer.php'; ?>
    </div>
	
 	</body>
	<script>
var currentRow, id;
$(document).on('click','.delete_cri',function(){
    id = $(this).attr('data-id'); 				// Get the clicked id for deletion 
    currentRow = $(this).closest('tr'); 		// Get a reference to the row that has the button we clicked
    $.ajax({
        type:'post',
        url:location.pathname, 					// sending the request to the same page we're on right now
        data:{'action':'deleteCri','id':id},
        success:function(response){
            if (response == 'ok') {
                // Hide the row nicely and remove it from the DOM once the animation is finished.
                currentRow.slideUp(500,function(){
                    currentRow.remove();
                })
            } else {
                // throw an error modally to let the user know there was an error
            }
        }
    })
})

$(document).on('click','.delete_alt',function(){
    id = $(this).attr('data-id'); 				// Get the clicked id for deletion 
    currentRow = $(this).closest('tr'); 		// Get a reference to the row that has the button we clicked
    $.ajax({
        type:'post',
        url:location.pathname, 					// sending the request to the same page we're on right now
        data:{'action':'deleteAlt','id':id},
        success:function(response){
            if (response == 'ok') {
                // Hide the row nicely and remove it from the DOM once the animation is finished.
                currentRow.slideUp(500,function(){
                    currentRow.remove();
                })
            } else {
                // throw an error modally to let the user know there was an error
            }
        }
    })
})

</script>
  
 </html>
 
 
 
