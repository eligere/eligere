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
				
				echo "<a href='insertQuestionnarie.php'>"; 
				echo "<button class='btn btn-lg btn-primary btn-block' type='submit'>Insert New Survey</button>";
				echo "</a><br>";
				
				echo "<a href='showDataBase.php'>"; 
				echo "<button class='btn btn-lg btn-primary btn-block' type='submit'>Show Survey Data</button>";
				echo "</a><br>";
				
				echo "<a href='showDataElaborated.php'>"; 
				echo "<button class='btn btn-lg btn-primary btn-block' type='submit'>Show Survey Result</button>";
				echo "</a><br>";
				
						
			}
	  	
		
		
		?>

	</div>

  </div>
</div>
</div>

   
  </body>
  
    <div class="container">	
		<?php include 'footer.php'; ?>
    </div>

  
  
  </html>