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
if (! isset ( $_SESSION )) {
	session_start ();
}
	if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
		$_SESSION['selectedQuest'] = $id;
    }


// connessione al db
include 'database.php';
//get the criteria list
$now = date("Y-m-d H:i:s");			
$pdo = Database::connect();
$criteriaArray = array ();
$sql = 'SELECT * FROM criteria WHERE quest_id = '.$_SESSION['selectedQuest'];
class Cri {
	public $id;
	public $name;
	public $description;
	public $quest_id;
}
foreach ($pdo->query($sql) as $row) {
		$objCriteria = new Cri ();
		$objCriteria->id = $row ['id'];
		$objCriteria->name = $row ['name'];
		$objCriteria->description = $row ['description'];
		$objCriteria->quest_id = $row ['quest_id'];
		array_push ( $criteriaArray, $objCriteria );
}

//insert
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
foreach ( $criteriaArray as $c1 ) {
	foreach ( $criteriaArray as $c2 ) {
		if ($c2->id > $c1->id) {
			try{
				$sql = "INSERT INTO questions (cr1, cr2, questionnaire, description, date, description_long) values(?, ?, ?, ?, ?, ?)";
				$q = $pdo->prepare($sql);
				$label = 'C1'.$c1->id.'C2'.$c2->id;
				$desc  = 'How important is the <b>'.$c1->description.'</b> of the system when it is compared to <b>'.$c2->description.'</b> implementation?'; 
				$q->execute(array($c1->id, $c2->id, $_SESSION['selectedQuest'],$label, '$now', $desc));				
			}catch(Exception $e){
				//echo "Error:".$c2->id."-".$c1->id." ERROR:".$e->getMessage()."<br>";
			}
		}

	}
}

Database::disconnect();


if (isset ( $_POST ['action'] ) && $_POST ['action'] == 'updateQuest') {
	$id1 = isset ( $_POST ['id1'] ) ? intval ( $_POST ['id1'] ) : 0;
	$id2 = isset ( $_POST ['id2'] ) ? intval ( $_POST ['id2'] ) : 0;
	
	$desc = isset ( $_POST ['desc'] ) ? ($_POST ['desc']) : ' ';
	$descL = isset ( $_POST ['descL'] ) ? ($_POST ['descL']) : ' ';
	$today = date ( "Y-m-d H:i:s" );
	
	if ($id1 > 0 && $id2 > 0) {
		
		// delete questions by cr1 and cr2 primary key
		$query_delete = "DELETE FROM questions WHERE cr1=" . $id1 . " and cr2 = " . $id2 . " LIMIT 1";
		$result = mysqli_query ( $conn, $query_delete );
		
		$sql_quest = "INSERT INTO questions (cr1, cr2, questionnaire, description,date, description_long)
			VALUES ($id1, $id2, $_SESSION[thisQuest], '$desc', '$today', '$descL')";
		if ($conn->query ( $sql_quest ) === TRUE) {
			echo 'ok';
		} else {
			echo 'err';
		}
	} else {
		echo 'err';
	}
	
	exit (); // finish execution since we only need the "ok" or "err" answers from the server.
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
		  <li class="breadcrumb-item "><a href="insertQuestionnarie.php">Questionnarie</a></li>
		  <li class="breadcrumb-item active">Criteria</li>
		</ol>
		<!--
		<br>
		<div class="list-group">
			<a href="#" class="list-group-item ">
				<h6 class="list-group-item-heading">Question Section. The number of
					question is equal to n!/(k!(n-k)!) (Binomial coefficient) where k =
					2 implied k <> 2 and n = number of criteria</h6>

			</a>
		</div>
		-->
	
		</p> 
		
		<div class="row">
			<h3>List of Criteria</h3>
		</div>
		<div class="row">
			
				<a href="criteria/create.php" >
				<button class='btn btn-lg btn-primary btn-block' type='submit'>Create New Criteria</button>
				</a>
			
			<table class="table table-striped table-bordered">
			  <thead>
				<tr>
				  <th>Id</th>
				  <th>Name</th>
				  <th>Description</th>
				  <th>Quest</th>
				</tr>
			  </thead>
			  <tbody>
			  <?php
			   
			   $pdo = Database::connect();
			   $sql = 'SELECT * FROM criteria WHERE quest_id = '.$_SESSION['selectedQuest'].' ORDER BY id DESC';
			   
			   foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td>'. $row['id'] . '</td>';
						echo '<td>'. $row['name'] . '</td>';
						echo '<td>'. $row['description'] . '</td>';  
						echo '<td>'. $row['quest_id'] . '</td>';   							
						echo '<td width=250>';
							echo '<a class="btn" href="criteria/read.php?id='.$row['id'].'">Read</a>';
							echo ' ';
							echo '<a class="btn btn-success" href="criteria/update.php?id='.$row['id'].'">Update</a>';
							echo ' ';
							echo '<a class="btn btn-danger" href="criteria/delete.php?id='.$row['id'].'">Delete</a>';
							echo '</td>';                            echo '</tr>';
			   }
			   Database::disconnect();
			  ?>
			  </tbody>
		</table>
	</div>
		
		
		
		<div class="row">
			<h3>List of Question (Automatic generation of the questions)</h3>
		</div>
		<div class="row">
			<table class="table table-striped table-bordered">
			  <thead>
				<tr>
				  <th>Id</th>
				  <th>CR1</th>
				  <th>CR2</th>
				  <th>Label</th>
				  <th>Description</th>
				  <th>Actions</th>
				</tr>
			  </thead>
			  <tbody>
			  <?php
			   
			   $pdo = Database::connect();
			   $sql = 'SELECT * FROM questions WHERE questionnaire = '.$_SESSION['selectedQuest'].' ORDER BY id DESC';
			   
			   foreach ($pdo->query($sql) as $row) {
				   
						$cr1Desc = '';
						$cr2Desc = '';
						$cr1Description = '';
						$cr2Description = '';
						foreach ( $criteriaArray as $c ) {
							if (isset ( $c )) {
								if ($c->id == $row['cr1']){
									$cr1Desc = $c->name;
									$cr1Description = $c->description;
								}
								if ($c->id == $row['cr2']){
									$cr2Desc = $c->name;
									$cr2Description = $c->description;
								}
							}
						}
				   
						echo '<tr>';
						echo '<td>'. $row['id'] . '</td>';
						echo "<td 'data-toggle='tooltip' data-placement='top' title='".$cr1Description."'>". $cr1Desc . '</td>';
						echo "<td 'data-toggle='tooltip' data-placement='top' title='".$cr2Description."'>". $cr2Desc . '</td>';  
						echo '<td>'. $row['description'] . '</td>'; 
						echo '<td>'. $row['description_long'] . '</td>';   						
						echo '<td width=250>';
							echo '<a class="btn" href="question/read.php?id='.$row['id'].'">Read</a>';
							echo ' ';
							echo '<a class="btn btn-success" href="question/update.php?id='.$row['id'].'">Update</a>';
							//echo ' ';
							//echo '<a class="btn btn-danger" href="question/delete.php?id='.$row['id'].'">Delete</a>';
							echo '</td>';                            
						echo '</tr>';
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

