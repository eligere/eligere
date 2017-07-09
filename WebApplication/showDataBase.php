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
	$criArray = array();
	
	if(!isset($_SESSION['id_quest'])){
		$_SESSION['id_quest'] = 0;
		
	}
	if(!isset($_SESSION['id_user'])){
		$_SESSION['id_user'] = 0;
	}
	
	if ($_SESSION['enableAdmin']){    
	    //connessione al db
		if(isset($_POST['nameQuestForCriteria'])){
			$_SESSION['id_quest'] = $_POST['nameQuestForCriteria'];
			$_SESSION['id_user'] = 0;
		}
		
		$userArray = getUsersByQuestID($conn,$_SESSION['id_quest']);
		
		if(isset($_POST['nameUsers'])){
			$_SESSION['id_user'] = $_POST['nameUsers'];
			$allAlternativeByQuest = getAllAlternativeByQuestID($conn,$_SESSION['id_quest']);
			
			$arrAlt = array();
			foreach ($allAlternativeByQuest as $a){
				$arrAlt = $arrAlt+ array($a->id => $a);
				
			}
						
			$criArray = getQuestionsLinguisticScale($conn,$_SESSION['id_quest'],$_SESSION['id_user']);			
			$arrayAlternative = getCriteriaAlternativeAll($conn,$_SESSION['id_quest'],$_SESSION['id_user']);	
			
			
		}
		
		if(isset($_POST['delete_user_data'])){
			
			$id_user  = $_SESSION['id_user'];
			$id_quest = $_SESSION['id_quest'];
			
			
			$sql_delete1 = "DELETE FROM  criteria_alternative WHERE user_id=$id_user and questionnaire_id=$id_quest";
			$sql_delete2 = "DELETE FROM question_linguistic_scale WHERE user=$id_user and quest_id=$id_quest";
		    $sql_delete3 = "DELETE FROM results_preferences WHERE quest_id=$id_quest";
		    $sql_delete4 = "DELETE FROM results_suitability WHERE quest_id=$id_quest";
			$sql_delete4 = "DELETE FROM final_score WHERE quest_id=$id_quest";			
			$sql_delete5 = "DELETE FROM questionnarie_user WHERE user_id=$id_user and quest_id=$id_quest";
			
			//change the complete filed
			$sql_update = "UPDATE questionnaire SET elaborated =0 WHERE id=$id_quest" ;

			
			
			
			if ($conn->query($sql_delete1) === TRUE) {	
				$success = "Success Delete.";
			} else {
				$error = "Error: " . $sql_delete1 . "<br>" . $conn->error;
			}
			if ($conn->query($sql_delete2) === TRUE) {	
				$success = "Success Delete.";
			} else {
				$error = "Error: " . $sql_delete2 . "<br>" . $conn->error;
			}
			if ($conn->query($sql_delete3) === TRUE) {	
				$success = "Success Delete.";
			} else {
				$error = "Error: " . $sql_delete3 . "<br>" . $conn->error;
			}
			if ($conn->query($sql_delete4) === TRUE) {	
				$success = "Success Delete.";
			} else {
				$error = "Error: " . $sql_delete4 . "<br>" . $conn->error;
			}
			if ($conn->query($sql_delete5) === TRUE) {	
				$success = "Success Delete.";
			} else {
				$error = "Error: " . $sql_delete5 . "<br>" . $conn->error;
			}
			
			if ($conn->query($sql_update) === TRUE) {	
				$success = "Success Update.";
			} else {
				$error = "Error: " . $sql_update . "<br>" . $conn->error;
			}
			
			
			//TODO question_linguistic_scale
			
			
			
			
		}
		
		
		
		
	}
	

	
	
?>



<html lang="en">

<?php include("header.html");?>
  
  <body>

	<div class="container">
	  <?php 
	  		$msg="Results"; 
	  		include 'staticNavBar.php'; 
	  ?>


	<?php 
		if($error != ''){			
			echo "<div class='alert alert-danger fade in'>";
			echo "<h6>".$error."</h6>";
			echo "</div>";
		}

		if($success != ''){			
			echo "<div class='alert alert-success fade in'>";
			echo "<h6>".$success."</h6>";
			echo "<h6>The survey must be  re-elaborated.</h6>";
			echo "</div>";
		}
	?>

	<div class="row">

	<div class="alert alert-success"> Quest Section </div>

<div class="row">
  <div class="col-xs-4">
	  
	   	<form class="form-inline" id = "q_criteria_form" method="post" action="<?php $_PHP_SELF ?>">					
		<!-- insert questionnarie -->	
		<div class="form-group">
			<label for="selectQuestId">Quest Name</label>
			<select name="nameQuestForCriteria" required="required" onchange="this.form.submit()" id="selectQuestId" class="form-control" >
			  	<option value=""></option>			
				<?php			
					$questArray = getAllQuest($conn);	
					foreach ($questArray as $q){
						if($q->id == $_SESSION['id_quest']){
							echo "<option value='$q->id' selected> ".$q->name."</option>";
						}else{
							echo "<option value='$q->id'>".$q->name."</option>";
						}
					}
				?>			
			</select>
		</div>   		
		<button type="submit" hidden="true" name="select_q" class="btn btn-default">Select</button>
	</form>
	
	</div>
	  <div class="col-xs-4">
 	<form class="form-inline" id = "user_form" method="post" action="<?php $_PHP_SELF ?>">					
		<!-- insert questionnarie -->	
		<div class="form-group">
			
			<label for="selectUserId">User Name</label>
			<select name="nameUsers" id="selectUserId" required="required" onchange="this.form.submit()" class="form-control" >
			  	<option value=""></option>			
				<?php																				
						foreach ($userArray as $u){
							if($u->id == $_SESSION['id_user']){
								echo "<option value='$u->id' selected> ".$u->name."</option>";
							}else{
								echo "<option value='$u->id'>".$u->name."</option>";
							}
						}
					
				?>			
			</select>
		</div>   		
		<button type="submit" name="select_user" class="btn btn-default">Select</button>
	</form>
	  </div>
	<form class="form-inline" id = "delete_user_form" method="post" action="<?php $_PHP_SELF ?>">			
		<button type="submit" name="delete_user_data" class="btn btn-default" > Delete Data </input>
	</form>
	  </div>
	  
	</nav>



	
	</div>

	
		<?php	
		if(isset($criArray)){
			echo "<div class='table-responsive'><table class='table table-striped'>
		    	 <thead><tr><th>ID</th><th>description</th><th>simbol_value</th><th>Quest ID</th></tr></thead><tbody>";
			
			foreach ($criArray as $q){				
				echo "<tr>
						<td>".$q->id. "</td>
					  	<td>".$q->description." </td>
						<td>".$q->simbol_value."</td>"."
						<td>".$q->quest_id."</td></tr>";
				
			}	
			echo "</tbody></table></div>";
		}
		?>
	
	
	
	
		<?php	
			if(isset($arrayAlternative)){
			echo "<div class='table-responsive'>
				 <table class='table table-striped'>
		    	 <thead><tr>
					<th>id</th>
					<th>id_alt1</th>
					<th>id_alt2</th>
					<th>simbol</th>
					<th>id_cri</th>
				 </tr></thead><tbody>";
			
			
			foreach ($arrayAlternative as $alt){		
				$tooltip1 = $arrAlt[$alt->id_alt1]->description;
				$tooltip2 = $arrAlt[$alt->id_alt2]->description;
						echo "<tr>
								<td>".$alt->id. "</td>
								<td data-toggle='tooltip' title='$tooltip1'>".$arrAlt[$alt->id_alt1]->name. "</td>
					  			<td data-toggle='tooltip' title='$tooltip2'>".$arrAlt[$alt->id_alt2]->name." </td>
								<td>".$alt->simbol."</td>"."
								<td data-toggle='tooltip' title='$alt->description_cri'>".$alt->name_cri."</td>
						</tr>";
					
				
			
			}
			echo "</tbody></table></div>";
			}
		?>




	</div>
	
	<div class="container">	
		<?php include 'footer.php'; ?>
    </div>
	
 </body>
  
 </html>

