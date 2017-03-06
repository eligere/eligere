<<<<<<< HEAD
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

=======
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
	    
	if ($_SESSION['enableAdmin']){    
	    //connessione al db
	    
	    include "connection.php";   
		include "getDataFromDataBase.php";
		$selectedQuest = 0;
		$success = '';
		$error = '';
		if(!isset($descQuest))
			$descQuest = '';
		if(!isset($nameQuest))
			$nameQuest = '';
	    
	if(isset($_POST['add_quest'])){
		
		if ($conn->connect_error) {	
			die("Connection failed: " . $conn->connect_error);	
		}else{	
			
			$descQuest = $_POST['descQuest'];
			$nameQuest = $_POST['nameQuest'];
			
			//insert user	
			$today = date("Y-m-d H:i:s");
			$complete = 0;
			$dir = "media/".$_POST['nameQuest'];
			
			try {
				mkdir($dir, 0777, true);
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
			
			$sql_quest = "INSERT INTO questionnaire (name, description, date, complete,dir,password) 
						  VALUES ('$nameQuest','$descQuest','$today',$complete,'$dir','$_POST[password]')";
			if ($conn->query($sql_quest) === TRUE) {	
				$success = "Insert Success.";
			} else {
				$error = "Error: " . $sql_quest . "<br>" . $conn->error;
			}
			$last_quest_id = $conn->insert_id;
		}
	}
	if (isset($_POST['action']) && $_POST['action'] == 'deleteQuestionnaire') {
	
		$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
		if ($id > 0) {
			
			/*
			$query = "SELECT * FROM questionnaire where WHERE id=".$id." and elaborated = 0 ";									
			if ($result=mysqli_query($con,$query))
			{
				// Return the number of rows in result set
				$rowcount=mysqli_num_rows($result);
				printf("Result set has %d rows.\n",$rowcount);
				// Free result set
				mysqli_free_result($result);
			}
			*/
			
			
			$query = "DELETE FROM questionnaire WHERE id=".$id." and elaborated = 0 LIMIT 1";
			$result = mysqli_query($conn, $query);
			
			echo 'ok';
		} else {
			echo 'err';
		}
		exit; // finish execution since we only need the "ok" or "err" answers from the server.
	}

}
?>



<html lang="en">

<?php include("header.html");?>
  
  <body>

	<div class="container">
	  <?php 
	  $msg = "insert quest";
	  include 'staticNavBar.php'; ?>


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



	<div class="alert alert-success"> 
	<button type="submit"  name="" class="btn btn-default">
	 <span  aria-hidden="true"></span>
		<a href="mainAdmin.php"> Prev. Section </a>
	</button>
		Quest Section 
	<button type="submit"  name="" class="btn btn-default">
	 <span  aria-hidden="true"></span>
		<a href="insertAlternativeAndCriteria.php"> Next Section </a>
	</button>
	</div>



		<form class="form-inline " id = "quest_form" method="post" action="<?php $_PHP_SELF ?>">		
							
			<!-- insert questionnarie -->
			
			
			<div class="form-group">				
					<label for="nameQuestInput">Name Quest</label>		
					<input type="text" name="nameQuest" value="<?php echo $nameQuest;?>" class="form-control" id="nameQuestInput" placeholder="" required="required"/>	
					
			</div>
			<div class="form-group">
				<label for="descQuestInput">Desc Quest</label>		
				<input type="text" name="descQuest"  value="<?php echo $descQuest;?>" class="form-control" id="descQuestInput" required="required" placeholder=""/>		
				
			</div>
			<div class="form-group">
				<label for="passwordId">Pwd</label>
				<input type="text" name="password"  class="form-control" id="passwordId" required="required" placeholder=""/>		
			</div>	
			
			<button type="submit" name="add_quest" class="btn btn-default">
			 <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				Add Quest
			</button>
			
				
			
		</form>

		<div class="table-responsive">
			<?php 
				echo "<table class='table table-striped'>
					  <thead>
						<tr>
							 <th>ID</th>
							 <th>Name</th>
							 <th>Description</th>
							 <th>Password</th>
							 <th>Date</th>
							 <th>Delete</th>
						</tr>
					  </thead>";
				
				$queryQuest = getAllQuest($conn);	
				foreach ($queryQuest as $q){
						echo '<tr><td>' . $q->id. '</td>
							 	  <td>' . $q -> name. '</td>
								  <td>' . $q -> description. '</td>
								  <td>' . $q -> password. '</td>
								  <td>' . $q -> date. '</td>
								  <td>' . $q -> dir. ' </td>
								  <td>' .'<button class="delete_questionnaire" data-id="' . $q->id . '"> Delete </button></td>
						</tr>';
			
				
				}
				
				echo "</table>";
			?>
			</div>


	</div>
	      <div class="container">	
		<?php include 'footer.php'; ?>
    </div>
 </body>
    <script>
var currentRow, id;
$(document).on('click','.delete_questionnaire',function(){
    id = $(this).attr('data-id'); 				// Get the clicked id for deletion 
    currentRow = $(this).closest('tr'); 		// Get a reference to the row that has the button we clicked
    $.ajax({
        type:'post',
        url:location.pathname, 					// sending the request to the same page we're on right now
        data:{'action':'deleteQuestionnaire','id':id},
        success:function(response){
            if (response == 'ok') {
                // Hide the row nicely and remove it from the DOM once the animation is finished.
                currentRow.slideUp(500,function(){
                    currentRow.remove();
                })
            } else {
                // throw an error modally to let the user know there was an error
            }
        }
    })
})
</script>
 </html>

>>>>>>> origin/master
