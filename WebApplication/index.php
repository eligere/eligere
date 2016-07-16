<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
        session_unset();
        // Infine , distrugge la sessione.
        session_destroy();
    }else{
    	session_unset();
    	// Infine , distrugge la sessione.
    	session_destroy();
    }
        	 
?>


<html lang="en">

<?php include("header.html");?>

  
<body>



    <div class="container">	
	  <?php 
	  $msg =  "";
	  include 'staticNavBar.php'; ?>
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
      
      	<?php 
      	if(isset($_GET['errorLogin']))
			if($_GET['errorLogin'] != ''){			
				echo "<div class='alert alert-danger fade in'>";
				echo "<h6>".$_GET['errorLogin']."</h6>";
				echo "</div>";
			}
		?>
      <div class="row">
	      <div class="col-md-4">
		      <form class="form-signin" id = "login_form" action="main.php" method="POST">
		        	<input type="text" name="yourname" class="form-control" required="required"  placeholder="Name">
		        	<input type="email" name="email" required="required"  class="form-control" id="email" placeholder="Email address">        	       
		        	<input type="password" id="inputPassword" name="passwordValue" class="form-control" placeholder="Password" required=""> 
		        	
		        	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>		      	
		      </form>
	      </div>
	      <div class="col-md-8">
	      		 		 		<p> <h5>
			 		 	Analytical Hirarchy Process (AHP) Test Suite <br>
			 		 	AHP is a multi-criteria decision method that uses hierarchical structures to rapresents a problem
			 		 	and then  develop priorities for alternatives based on the judgment of the user (Satty, 1980).
						
					</h5></p>
	      </div>
      </div>

      </div>

    </div>





</body>

</html>