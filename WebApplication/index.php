
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