<?php 
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    include "connection.php";
    include "getDataFromDataBase.php";
    	
   ?>



<html lang="en">

  
  <?php include("header.html");?>
  
  <body>

    <div class="container">
  	  <?php

	  	$msg="Admin Panel";
	  	include 'staticNavBar.php'; 
	  
	  ?>
	  
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">    
      
	 <div class="row">
	 
       
	  	<?php   	 		
			if ($_SESSION['enableAdmin']){
				//insert data
				echo  "<div class='row'>
	    				  <form class='form-inline' action='insertQuestionnarie.php'>
					     	<button type='submit' name='add_alt' class='btn btn-default'>Insert New Questionnarie</button>
					     </form> 
    				   </div>
					   <div class='row'> 
					     <form class='form-inline' action='showDataBase.php'>
					     	<button type='submit' name='add_alt' class='btn btn-default'>data to be processed</button>     
					     </form>
    				   </div>
					   <div class='row'> 
					     <form class='form-inline' action='showDataElaborated.php'>
					     	<button type='submit' name='add_alt' class='btn btn-default'>data eleborated</button>     
					     </form>
    				   </div>";
							
			}
	  	
		
		
		?>

	</div>

  </div>
</div>
</div>

   
  </body>
  
  </html>