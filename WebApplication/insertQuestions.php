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
    //connessione al db
    
    include "connection.php";   
	include "getDataFromDataBase.php";
	
	if(!isset($_SESSION['thisQuest'])){
		$_SESSION['thisQuest'] = 0;	
		$selectedQuest = 0;
	}
	
	$success = '';
	$error = '';
	$successDelete = '';
	$errorDelete = '';
    
	$arrayCriteriaByQuestId = array();	
	if(isset($_POST['nameQuestForCriteria'])){	
		$_SESSION['thisQuest'] = $_POST['nameQuestForCriteria'];
		$selectedQuest = $_SESSION['thisQuest'];
		$arrayCriteriaByQuestId = getAllCriteriaByQuestId($conn, $_POST['nameQuestForCriteria']);	
		
		$questions = getAllQuestionsById($conn,$selectedQuest);
	}	
	
	
	if(isset($_POST['add_questions'])){
		
		$selectedQuest = $_SESSION['thisQuest'];
		
		$today = date("Y-m-d H:i:s");

	
				
		if ($conn->connect_error) {	
			die("Connection failed: " . $conn->connect_error);	
		}else{	
			//insert user	
			$today = date("Y-m-d H:i:s");		
			
			for($i = 0; $i < count($_POST['nameCri1']); $i++) {
				// verify if all fields are completed
				$cr1 = $_POST['nameCri1'][$i];
				$cr2 = $_POST['nameCri2'][$i];
				$d   = $_POST['desc'][$i];
				$dLong   = $_POST['descLong'][$i];
				if(empty($cr1 ||$cr2 || $d || $selectedQuest)) { // all fields here
					$error = "Error: " . "ERRORE" . "<br>";
				} else {
					
					$sql_quest = "INSERT INTO questions (cr1, cr2, questionnaire, description,date, description_long) 
						  VALUES ($cr1,$cr2,$_SESSION[thisQuest],'$d','$today','$dLong')";
					if ($conn->query($sql_quest) === TRUE) {	
						$success = "Insert Success.";
					} else {
						$error = "Error: " . $sql_quest . "<br>" . $conn->error;
					}
					
				}
			}

		}
		
		
		
	}

?>



<html lang="en">

<?php include("header.html");?>
  
  <body>

	<div class="container">
	  <?php 
	  
	  $msg=" Quest Section ";
	  include 'staticNavBar.php'; 	  

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
		
		if($errorDelete != ''){
			echo "<div class='alert alert-danger fade in'>";
			echo "<h6>".$errorDelete."</h6>";
			echo "</div>";
		}
		
			if($successDelete != ''){
				echo "<div class='alert alert-success fade in'>";
				echo "<h6>".$successDelete."</h6>";
				echo "</div>";
			}
	?>



	<div class="bs-example" data-example-id="list-group-variants">
    <div class="row">
      <div class="col-sm-6">
			<button type="submit"  name="" class="btn btn-default">
			<span  aria-hidden="true"></span>
				<a href="insertAlternativeAndCriteria.php"> Prev Section </a>
			</button>
      </div>
      <div class="col-sm-6">
		 <button type="submit"  name="" class="btn btn-default">
		 <span  aria-hidden="true"></span>
			<a href="mainAdmin.php"> Menu </a>
		 </button>
      </div>
    </div>
  </div>
<br>
	<div class="list-group">
	  <a href="#" class="list-group-item ">
	    <h6 class="list-group-item-heading">Question Section. The number of question is equal to n!/(k!(n-k)!) (Binomial coefficient) 
		where k = 2 --> k! = 2 and n = number of criteria</h6>
	    
	  </a>
	</div>


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

	<hr>

	<form class="form-inline" id = "criteria_form" method="post" action="<?php $_PHP_SELF ?>">	
			
	<!-- insert questionnarie -->	
	<div class="form-group">
	<?php 		
		//in this way you can only insert the description		
		
		$numArray = count($arrayCriteriaByQuestId);	
		if($numArray>0)
		foreach ($arrayCriteriaByQuestId as $a1) {
			foreach ($arrayCriteriaByQuestId as $a2) {
				if( $a2 > $a1){		
					echo " 
						<div class='row'> <div class='form-group'>
					 		<label for='nameCriInput1'>Criteria a</label>
							<input type='hidden' name='nameCri1[]' value='$a1->id'/>					 		
							<input type='text' name='' value='$a1->name' class='form-control' id='nameCriInput1' placeholder='' readonly='readonly' />
							
						</div>
						<div class='form-group'>
							<label for='nameCriInput2'>Criteria b</label>
							<input type='hidden' name='nameCri2[]' value='$a2->id'/>
							<input type='text' name='' value='$a2->name'  class='form-control' id='nameCriInput2' required='' readonly='readonly' />
												
							
						</div>
						<div class='form-group'>
						
							<label for='descId'>Desc Label</label>							
							<input type='text' name='desc[]' value='' class='form-control' id='descId' required='required' placeholder=''/>		
						</div>
						<div class='form-group'>
							<label for='descLongId'>Desc Question</label>							
							<input type='text' name='descLong[]' value='' class='form-control' id='descLongId' required='required' placeholder=''/>		
						</div>
					
						</div>";			
		
				}
			}
		}
		
	?>
	</div>		
	<button type="submit" name="add_questions" class="btn btn-default">Add Question</button>
	
	</form>
	
	
	
	
		<table class='table table-striped'>
			<thead>
			<tr>
			<th data-field='id'>Item ID</th>
			<th data-field='name'>Item CR1</th>
			<th data-field='price'>Desc Label </th>
			<th data-field='desc'>Description</th>
			</tr>
			</thead>
			<tbody>
				<?php 				
					if(isset($questions))
						if(count($questions)>0){
							foreach ($questions as $q){	
								if(isset($q)){
								$cr1Desc = '';
								$cr2Desc = '';			
								foreach ($arrayCriteriaByQuestId as $a){
									if(isset($a)){
									if($a->id == $q->cr1)
										$cr1Desc = $a->name;									
									if($a->id == $q->cr2)
										$cr2Desc = $a->name;
									}
								}
							echo"<tr>
							<th data-field='id'>$cr1Desc</th>
							<th data-field='name'>$cr2Desc</th>
							<th data-field='price'>$q->desc</th>
							<th data-field='desc'>$q->descLabel</th>
							</tr>";
								}
							}
					}
				?>
			</tbody>
		</table>
	


	</div>
 </body>
  
 </html>

