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
error_reporting(E_ALL & ~E_NOTICE  & ~E_WARNING);
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    //connessione al db
    
    include "connection.php";   
	include "getDataFromDataBase.php";
	$selectedQuest = 0;
	$success = '';
	$error = '';
	$msgUpload = '';
	$msgUploadError = '';

	if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
		$_SESSION['selectedQuest'] = $id;
    }
	
	
	$questID = $_SESSION['selectedQuest'];

?>

<html lang="en">

<?php include("header.html");?>
  
  <body>

	<div class="container">
	  <?php 
	  $msg = "Insert Alternative and Criteria";
	  include 'staticNavBar.php'; 
	  
	  ?>


	    <ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
		  <li class="breadcrumb-item "><a href="mainAdmin.php">Admin Panel</a></li>
		  <li class="breadcrumb-item "><a href="insertQuestionnarie.php">Questionnarie</a></li>
		  <li class="breadcrumb-item active">Alterative and Criteria</li>
		</ol>

	
		<div class="row">
			<h3>List of Alternative</h3>
		</div>
		<div class="row">
			
				<a href="alternative/create.php">
					<button class='btn btn-lg btn-primary btn-block' type='submit'>Create New Alternative</button>

				</a>
			
			<table class="table table-striped table-bordered">
			  <thead>
				<tr>
				  <th>Id</th>
				  <th>Name</th>
				  <th>Description</th>
				  <th>Quest</th>
				  <th>Image</th>
				</tr>
			  </thead>
			  <tbody>
			  <?php
			   include 'database.php';
			   $pdo = Database::connect();
			   $sql = 'SELECT * FROM alternative WHERE questionnaire_id = '.$_SESSION['selectedQuest'].' ORDER BY id DESC';
			   
			   foreach ($pdo->query($sql) as $row) {
					    $dir_path = $row['dir_path_file'];
						$desc     = $row['description'];
						echo '<tr>';
						echo '<td>'. $row['id'] . '</td>';
						echo '<td>'. $row['name'] . '</td>';
						echo '<td>'. $row['description'] . '</td>';  
						echo '<td>'. $row['questionnaire_id'] . '</td>';  
						echo "<td><img src='$dir_path' alt='$desc' style='width:50px;height:50px;'></td>";						
						echo '<td width=250>';
							echo '<a class="btn" href="alternative/read.php?id='.$row['id'].'">Read</a>';
							echo ' ';
							echo '<a class="btn btn-success" href="alternative/update.php?id='.$row['id'].'">Update</a>';
							echo ' ';
							echo '<a class="btn btn-danger" href="alternative/delete.php?id='.$row['id'].'">Delete</a>';
							echo '</td>';                            echo '</tr>';
			   }
			   Database::disconnect();
			   
			  ?>
			  </tbody>
		</table>
	</div>
	


	</div>
	
	<div class="container">	
		<?php include 'footer.php'; ?>
    </div>
	
 	</body>

  
 </html>
 
 
 
