<?php 
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }    
    
    include "connection.php";
	include "getCriteria.php";
		
	$error   = '';
	$success = '';
	$arrayLinguisticScale = getLinguisticScale($conn);
	$criteriaArray        = getAllCriteriaByQuestId($conn,$_SESSION['questionnaire_id']);	
	$arrayAlternative     = getAllAlternativeByQuestID($conn,$_SESSION['questionnaire_id']);
	  
    
    if(isset($_POST['saveArray'])){   	   		
    		
    		//num criteria
    		$numCriteria    = count($criteriaArray);
    		$numAlternative = count($arrayAlternative); 
    		$today = date("Y-m-d H:i:s");
    		$quest_id  = $_SESSION['questionnaire_id'];
    		$user_id = $_SESSION['user_id'];
    		$f=1;
    		$more = true;
    		while ($more) {			
							
		    		
		    		$today = date("Y-m-d H:i:s");				    		
		    		$altA =  'AltA-'.(string)$f;
		    		$altB =  'AltB-'.(string)$f;			    		
		    		
		    		if(isset($_POST[$altA])){		    		
			    		$alt1_id  = $_POST[$altA];
			    		$alt2_id  = $_POST[$altB];			    						    				
			    		$counter = 1;
						foreach ($criteriaArray as $criteria) {							
							
							$q =  "q".(string)$counter;
							$cri    =  (string)$f.'-'.$q;
							$r =  "r".(string)$counter;
							$symbol =  (string)$f.'-'.$r;
							
							$cri_id    = $_POST[$cri];								
							$symbol_id = $_POST[$symbol];
																				
							$sql_quest = "INSERT INTO criteria_alternative (alt1, alt2, cri_id, 
										  questionnaire_id, user_id , date ,linguistic_id)
										  VALUES ($alt1_id,$alt2_id,$cri_id,$quest_id,$user_id,'$today',$symbol_id)";
							
							if ($conn->query($sql_quest) === TRUE) {
								$success = $success + "Record".$conn->insert_id." INSERITO CONSUCCESSO";
							} else {
								$error = $error + " <br> Error: " . $sql_quest . "<br>" . $conn->error;
							}
							
							
							$counter = $counter + 1;
							
						}
		    		}else{
		    			$more = false;
		    		}
										
					$f++;
					
	    		}
	    		
	    		if($error == '' && $success != ''){
	    			
	    			$quest_user_id = $_SESSION['quest_user_id'];
	    			$sql_quest_user = " UPDATE questionnarie_user SET complete = 1 WHERE id = $quest_user_id";
	    			if ($conn->query($sql_quest_user) === TRUE) {
	    				
	    			} else {
	    				$error = "Error: " . $sql_quest_user . "<br>" . $conn->error;
	    			}
	    			
	    			header("location: success.php");
	    			
	    		}
	    		
    		
    		}
    	

    
    
    
    
?>



<html lang="en">

  <?php 
  $msg = "Suitability";
  include("header.html");?>
  
  <body>

	<div class="container">
	    <?php include 'staticNavBar.php'; ?>

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
			}
		?>

		 
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
      
	  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Section</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Criteria</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Linguistic scale for importance</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
	 		 		<p> <h5>
			 		 	<b></>Section 2: " Suitability " </b><br>
						In this section it is asked to compare the candidate solutions under each of criteria separately. 
						Please answer according to the following rating scale.
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
		    	<td>Linguistic scale for importance</td><td> Simbol</td></tr>		    
		    <?php 
		   	    
	    	    if (isset($arrayLinguisticScale))
	        		foreach ($arrayLinguisticScale as $a)
	    				echo "<tr><td>". $a->description. "</td><td>". $a->simbol . " </td></tr>";	
	    					    
		    ?>
	    </table>
   </div>
   </div>
	 

	 
      
	<div class="row">

    <div class="row">
    
  	<div class="col-md-12">  		
  		
				
	<div class="container">
		
	    <form class='form-horizontal' id = 'alternative_form' action='<?php $_PHP_SELF ?>' method='POST'>
	    
	    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
	    <!-- Indicators -->
	    	    	    
	    <ol class="carousel-indicators">
	      
	      <?php 
	      	  
		      $indexCarousel = 0;
		      foreach ($arrayAlternative as $alt1) {
					foreach ($arrayAlternative as $alt2) {
						if( $alt2->id > $alt1->id){
						//if($indexCarousel == 0)
							//echo "<li data-target='#myCarousel' data-slide-to='$indexCarousel' class='active'></li>";
						//else 	
	      					//echo "<li data-target='#myCarousel' data-slide-to='$indexCarousel'></li>";
	      					//$indexCarousel=$indexCarousel+1;
						}
					}
		      }
		      
	      ?>
	      
	    </ol>
	
	    <!-- Wrapper for slides -->
	    <div class="carousel-inner" role="listbox">
	    	<?php 
				//WOW
	    	
				$num_alt = count($arrayAlternative);
				$counter = 1;
				$f=1;
				foreach ($arrayAlternative as $alt1) {					
					foreach ($arrayAlternative as $alt2) {
						if( $alt2->id > $alt1->id){
							
							try {
								$src1='';
								$src2='';
								$scanDirAlt1 = scandir($alt1->dir_path);
								$scanDirAlt2 = scandir($alt2->dir_path);
								$numAlt1 = count($scanDirAlt1);
								$numAlt2 = count($scanDirAlt2);
								if($numAlt1>2)
									$src1 = $alt1->dir_path."/".scandir($alt1->dir_path)[2];
							
							
								if($numAlt2>2)
									$src2 = $alt2->dir_path."/".scandir($alt2->dir_path)[2];
							} catch (Exception $e) {
								
								
							}
							
							
							if($counter == 1)
								echo "<div class='item active'>";
							else 
								echo "<div class='item'>";							
							echo "<table class='table table-hover text-center table-bordered' >";
							
							echo "<tr><td class='alert alert-success text-center'> ". $alt1->name."</td> 
    							  <td class='alert alert-success text-center'>  </td> 
    							  <td class='alert alert-success text-center'> ". $alt2->name."  </td></tr>";
							echo "<tr>
								  <td > 
    							 <img src='$src1' alt='$alt1->description' style='width:200px;height:200px;'>
    							 
    							 </td>";
    							 echo "<td> ";
    							 echo " <table class='table text-center table-hover  table-bordered' >";
    							 echo " <thead>
								   <tr class='alert alert-success' >
								   <td class='col-md-1'> Criteria   </td>";
    							 if (isset($arrayLinguisticScale))
    							 	foreach ($arrayLinguisticScale as $a){
    							 	echo "<td class='col-md-1'> $a->simbol </td>";
    							 }
    							 echo "</thead>";
    							 
    							 echo "   <input type='hidden'  name='AltA-$f'    value='$alt1->id'/>";
    							 echo "   <input type='hidden'  name='AltB-$f'    value='$alt2->id'/>";
    							 
    							 //perfetto
    							 $count_quest = 1;
    							 foreach ($criteriaArray as $cri) {
    							 	$q =  "q".(string)$count_quest;
    							 	echo "<tr>";
    							 	echo "	 <input type='hidden'  name='$f-$q'   value='$cri->id' />";
    							 	echo "	<td>  $cri->name </td>";
    							 
    							 	foreach ($arrayLinguisticScale as $value) {
    							 		$r =  "r".(string)$count_quest;
    							 		echo "<td>  <input type='radio' class='btn btn-primary'
    							 		required='required' name='$f-$r'
    							 		value='$value->id'/>
    							 		</td>";
    							 	}
    							 	echo "</tr>";
    							 
    							 	$count_quest = $count_quest + 1;
    							 }
    							 
    							 echo "</table>";
    							 echo "<a class='left' href='#myCarousel' role='button' data-slide='prev'>
    						<button type='submit'  >
    						<span class='glyphicon glyphicon-chevron-left'> </span>Prev alternative </button>
    						</a>";
    							 echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$counter."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    							 echo "<a class='right' href='#myCarousel' role='button' data-slide='next'>
    						<button type='submit'  >
    						Next alternative<span class='glyphicon glyphicon-chevron-right'> </span> </button>
    						</a>";
    							 echo "</td>";
    							 
    						echo "<td > 
    							 <img src='$src2' alt='$alt2->description' style='width:200px;height:200px;'> 
    				             </td></tr>";
							
    						
    						echo " </table>";							
    						
    						
    						
							
							
							
    						
    							
    						echo "</div>";
							
							
							$counter = $counter+1;
							
							$f++;
						}
												
					}
					
				}
				?>
					    		
	
	    </div>

					    
	  </div>
	  
	  <input type='submit' name="saveArray" class='btn btn-lg btn-primary btn-block' value='Save ' />
	  
	  </form>
	   
	  	  
	</div>
	
	   
  	</div>
  	
  	
    
    
    
    
    
    
    
  </div>
 
 

  
  

	</div>

  </div>
</div>
   
   
   
  </body>
  
  </html>