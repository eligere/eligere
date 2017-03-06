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
 ?>
 
 <?php
    require '../database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     

	 
    if ( null==$id ) {
        header("Location: update.php");
    }
     
    if ( !empty($_POST)) {
		
	
        // keep track validation errors
        $nameError = null;
        $descriptionError = null;        

         
        // keep track post values
        $name = $_POST['name'];
        $description = $_POST['description'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
		}
         
        if (empty($description)) {
            $descriptionError = 'Please enter description';
            $valid = false;
        }
         
		
		$dir = "../media/".$data['name']."/".$name;		
		$dir2 = "media/".$data['name']."/".$name;	
		try {
			mkdir($dir, 0777, true);
		} catch (Exception $e) {
			$msgUpload  =  "Caught exception: ".  $e->getMessage(). "\n";
			echo $msgUpload;
		}
		
		$uploadOk = 0;
		$target_file2 = $dir2 ."/". basename($_FILES["nameFile"]["name"]);
		$target_file = $dir ."/". basename($_FILES["nameFile"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		if (move_uploaded_file($_FILES['nameFile']['tmp_name'], $target_file)) {
			echo "File is valid, and was successfully uploaded.\n";
		} else {
			echo "Possibile attacco tramite file upload!\n";
		}
			 
         
        // update data
        if ($valid) {
		
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE questions  set description_long =? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($description, $id));			
            Database::disconnect();
            
			header("Location: ../insertQuestions.php");
        
		}
    } else {
	 
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM questions where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['description'];
        $description = $data['description_long'];
        Database::disconnect();
    }
?>
 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <link   href="../css/bootstrap.css" rel="stylesheet">
    <script src="../js/bootstrap.js"></script>
</head>
 
<body>
    <div class="container">
     	<div class="jumbotron">

                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update Question</h3>
                    </div>
            
					 
                    <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Label</label>
                        <div class="controls">
                            <input name="name" type="text" class="form-control" placeholder="Name" readonly = "true" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
                        <label class="control-label">Description (Editable)</label>
                        <div class="controls">
                            <input name="description" class="form-control" type="text" placeholder="Description" value="<?php echo !empty($description)?$description:'';?>">
                            <?php if (!empty($descriptionError)): ?>
                                <span class="help-inline"><?php echo $descriptionError;?></span>
                            <?php endif;?>
                        </div>
                      </div>					  
					  <br>
                      <div class="form-actions">
                          <button type="submit"  class="btn btn-success">Update</button>
                          <a class="btn" href="../insertQuestions.php">Back</a>
                        </div>
                    </form>
                </div>
            </div>     
    </div> <!-- /container -->
  </body>

</html>