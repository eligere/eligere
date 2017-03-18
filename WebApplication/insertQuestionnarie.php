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
	    
?>



<html lang="en">

<?php include("header.html");?>
  
  <body>

	<div class="container">
	  <?php 
	  $msg = "insert quest";
	  include 'staticNavBar.php'; ?>
	  
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
		  <li class="breadcrumb-item "><a href="mainAdmin.php">Admin Panel</a></li>
		  <li class="breadcrumb-item active">Questionnarie</li>
		</ol>
	  

	
		
            <div class="row">
                <h3>List of Questionnarie</h3>
            </div>
            <div class="row">				
				<a href="questionnarie/create.php" >
					<button class='btn btn-lg btn-primary btn-block' type='submit'>Create New Questionnarie</button>
				</a>                
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Label</th>
                      <th>Description</th>
					  <th>Password</th>
					  <th>Date</th>
					  <th>Folder Path</th>
					  <th>Elaborated</th>
					  <th>Action</th>
					  <th>Insert</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM questionnaire ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['name'] . '</td>';
                            echo '<td>'. $row['description'] . '</td>';
							echo '<td>'. $row['password'] . '</td>'; 
                            echo '<td>'. $row['date'] . '</td>';
							echo '<td>'. $row['dir'] . '</td>'; 
							echo '<td>'. $row['elaborated'] . '</td>'; 							
							echo '<td width=230>';
                                echo '<a class="btn btn-primary" href="questionnarie/read.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="questionnarie/update.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
								if($row['elaborated'] == 0)
									echo '<a class="btn btn-danger" href="questionnarie/delete.php?id='.$row['id'].'">Delete</a>';
								

                           echo '</td>'; 
						   echo '<td width=200>';
                                echo '<a class="btn btn-primary" href="insertAlternativeAndCriteria.php?id='.$row['id'].'">Alternative</a>';
								echo ' ';
                                echo '<a class="btn btn-success" href="insertQuestions.php?id='.$row['id'].'">Criteria</a>';
                           echo '</td>';                            
						   echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div>
	
	</body>
	<div class="container">	
		<?php include 'footer.php'; ?>
    </div>
 </html>

