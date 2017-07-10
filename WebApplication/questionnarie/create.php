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
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $descriptionError = null;
        $posswordError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $password = $_POST['password'];
        $description = $_POST['description'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }else{					
			try {
				$dir = "../media/".$name;
				$dir2 = "media/".$name;
				mkdir($dir, 0777, true);		
			} catch (Exception $e) {
				//echo 'Caught exception: ',  $e->getMessage(), "\n";
				//$valid = false;
			}
		}
         
        if (empty($description)) {
            $descriptionError = 'Please enter description';
            $valid = false;
        }
         
        if (empty($password)) {
            $posswordError = 'Please enter password';
            $valid = false;
        }

		
         
        // insert data
        if ($valid) {
			
			$now = date("Y-m-d H:i:s");
			$complete = 0;
			
			try{		
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO questionnaire (name, description, date, complete,dir,password) values(?, ?, ?, ?, ?, ?)";
				$q = $pdo->prepare($sql);
				$q->execute(array($name,$description,$now,$complete ,$dir2, $password));
				Database::disconnect();
				header("Location: ../insertQuestionnarie.php");

			} catch (Exception $e) {
				
				$nameError = $e->getMessage();

				//header("Location: create.php");
			}
			
        }
    }
?>

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
                        <h3>Create a Questionnarie</h3>
						</div>             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Insert the name of the questionnarie</label>
                        <div class="controls">
                            <input name="name" class="form-control" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
                        <label class="control-label">Insert the description of the questionnarie</label>
                        <div class="controls">
                            <input name="description" class="form-control" type="text" placeholder="Description" value="<?php echo !empty($description)?$description:'';?>">
                            <?php if (!empty($descriptionError)): ?>
                                <span class="help-inline"><?php echo $descriptionError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
                        <label class="control-label">Insert the password of the questionnarie</label>
                        <div class="controls">
                            <input name="password" class="form-control" type="text"  placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
                            <?php if (!empty($passwordError)): ?>
                                <span class="help-inline"><?php echo $passwordError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="../insertQuestionnarie.php">Back</a>
                        </div>
                    </form>
               </div> </div>
                 
    </div> <!-- /container -->
  </body>

</html>