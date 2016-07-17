<?php 

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
  
 </html>

