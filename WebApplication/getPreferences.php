


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

include("header.html");
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    
    include "connection.php";   
	include "getDataFromDataBase.php"; 
	

	$error   = '';
	$success = '';
	$arrayLinguisticScale = getLinguisticScale($conn);
	$arrayQuestion		  = getAllQuestionsById($conn,$_SESSION['questionnaire_id']);
	
	
	
	$response = 1;
	if(isset($_POST['add_question'])){
			
			$last_user_id = $_SESSION['user_id'];			
			//dynamic insert
			$count = 1;
			$Domanda =  "q".(string)$count;
			$Risposta = "r".(string)$count;
			
			while (isset($_POST[$Domanda]) && isset($_POST[$Risposta])){
				$quest_id = $_SESSION['questionnaire_id'];
				$sql = "INSERT INTO question_linguistic_scale (questions_id, user, ling_scale_id, quest_id)
						VALUES ('$_POST[$Domanda]', $last_user_id , '$_POST[$Risposta]', $quest_id)";
					
				if ($conn->query($sql) === TRUE) {
					
				} else {
					$response = 0;
					$error =  $error ." <br> Error: " . $sql . "<br>" . $conn->error;
				}
					
				$count = $count+1;
				$Domanda =  "q".(string)$count;
				$Risposta = "r".(string)$count;
			}
			
			if($response == 1){
				$success = ' $count Record inseriti con successo';
				header("Location: getSuitability.php");
			}

	}
	
	
	
	

?>


<html lang="en">

<?php include("header.html");?>
  <body>
  

  <div class="container">
	  <?php 
	  $msg = 'Preferences Section';
	  include 'staticNavBar.php'; ?>


	<?php 
		if($error != ''){			
			echo "<div class='alert alert-danger fade in'>";
			echo "<h6>".$error."</h6>";
			echo "</div>";
		}
	?>

	<?php 
		if($success != ''){			
			echo "<div class='alert alert-success fade in'>";
			echo "<h6>".$success."</h6>";
			echo "</div>";
			sleep(2);
			header("Location: getSuitability.php");
		}
	?>



    <div class="jumbotron">
    
    
    
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Section</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Criteria</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Fuzzy conversion scale</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
	 		 		<p> <h5>
			 		 	<b></>Section 1: " Preferences " </b><br><br>
						In the first section the user is asked to express a preference about the given
						evaluation criteria.
						Each question asks to compare two criteria simultaneously (i.e. pairwise
						comparison) according to the fuzzy conversion scale.
					</h5></p>
    
    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
        
		  <div class="col-md-4">  		  		
			    <table class="table  table-condensed">
				    <tr class="alert alert-success" >		    
				    	<td>Id</td>
				    	<td>Criteria</td>
				    	<td>Description</td>		    
				    </tr>
				    <?php 
				   	    $criteriaArray = getAllCriteriaByQuestId($conn,$_SESSION['questionnaire_id']);
			    	    if (isset($criteriaArray))
			        		foreach ($criteriaArray as $cri){
			    				echo "<tr>
			    						  <td> $cri->id </td>
			    						  <td> $cri->name </td>
			    						  <td> $cri->description </td>
			    					 </tr>";	
			    			}		    
				    ?>
			    </table>   
		  </div>  


	</div>
	
    <div role="tabpanel" class="tab-pane" id="messages">
      <div class="col-md-4">         
	    <table class="table  table-condensed">
		    <tr class="alert alert-success" >
		    	<td>Fuzzy conversion scale</td><td> Symbol</td></tr>		    
		    <?php 
		   	    
	    	    if (isset($arrayLinguisticScale))
	        		foreach ($arrayLinguisticScale as $a)
	    				echo "<tr><td>". $a->description. "</td><td>". $a->simbol . " </td></tr>";	
	    					    
		    ?>
	    </table>
   </div>
    
    
    </div>
    
    



    <div class="row">
    <div class="col-md-12">
	<form class="form-horizontal" id = "quest_form" action="<?php $_PHP_SELF ?>" method="POST">
		<table class='table table-striped'>
			 <thead>
			 <tr class="alert alert-success" >
			    <td class="col-md-1"> Tag   </td>
			    <td> Question</td>
			    <?php 
		    	    if (isset($arrayLinguisticScale))
		        		foreach ($arrayLinguisticScale as $a){
		    				echo "<td class='col-md-1'> $a->simbol </td>";	
		    			}
			    ?>
			</thead>
			</tr>
		
			<?php 
			
				$count_quest = 1;			
				foreach ($arrayQuestion as $quest) {
					
					$q =  "q".(string)$count_quest;
					echo "<tr>";
					echo "	<td>  <input type='hidden'  name='$q'  value='$quest->id'  /> $quest->desc </td>";
					echo "	<td>".  $quest->descLabel." </td>";							
					foreach ($arrayLinguisticScale as $value) {
						$r =  "r".(string)$count_quest;
						echo "<td>  <input type='radio' class='btn btn-primary' required='required'  name='$r' value='$value->id'/>  </td>";
					}						
					echo "</tr>";
					$count_quest = $count_quest + 1;
				}
			?>

		</table>
		
		<div class="col-md-12">
				
		
		<button type="submit" name="add_question" class="btn btn-lg btn-primary btn-block">Next Section</button>
	
				
		</form>
		</div>

	</div>


  </div>

</div>

    




  </div>

	</div>
</div>
 </body>
        <div class="container">	
		<?php include 'footer.php'; ?>
    </div>
 </html>
