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

include "connection.php";
include "getDataFromDataBase.php";
include "socket_connection.php";


$error = '';
$success = '';
$criArray = array ();

if (! isset ( $_SESSION ['id_quest'] )) {
	$_SESSION ['id_quest'] = 0;
}

if ($_SESSION ['enableAdmin']) {
	// connessione al db
	if (isset ( $_POST ['nameQuestForCriteria'] )) {
		$_SESSION ['id_quest'] = $_POST ['nameQuestForCriteria'];

		$success = surveyElaboration($_SESSION ['id_quest']);
		sleep(5);	
		

	}
	
	$section1Array = getSection1 ( $conn, $_SESSION ['id_quest'] );
	$section2Array = getSection2 ( $conn, $_SESSION ['id_quest'] );
	$finalScoreArray = getFinalScore ( $conn, $_SESSION ['id_quest'] );
	$altArray = getAllAlternativeByQuestID($conn,$_SESSION['id_quest']);
}

?>



<html lang="en">
<?php include("header.html");?>
  
<script>
	
	$(document).ready(function(){
		
		$("#submit").click(function(){
			$("#myDiv").show();
		});
		
	});
	
</script>

  <body>

	<div class="container">
	  <?php
			$msg = "Results";
			include 'staticNavBar.php';
			?>

	<?php
	if ($error != '') {
		echo "<div class='alert alert-danger fade in'>";
		echo "<h6>" . $error . "</h6>";
		echo "</div>";
	}
	
	if ($success != '') {
		echo "<div class='alert alert-success fade in'>";
		echo "<h6>" . $success . "</h6>";
		echo "</div>";
	}
	?>

	

			
	<div class="alert alert-success"></div>
			<div class="row">
				<div class="col-xs-4">

					<form class="form-inline" id="q_criteria_form" method="post"
						action="<?php $_PHP_SELF ?>">
						<!-- insert questionnarie -->
						<div class="form-group">
							<label for="selectQuestId">Quest Name</label> <select
								name="nameQuestForCriteria" required="required"
								id="selectQuestId"
								class="form-control">
								<option value=""></option>			
				<?php
				$questArray = getAllQuest ( $conn );
				foreach ( $questArray as $q ) {
					if ($q->id == $_SESSION ['id_quest']) {
						echo "<option value='$q->id' selected> " . $q->name . "</option>";
					} else {
						echo "<option value='$q->id'>" . $q->name . "</option>";
					}
				}
				?>			
					</select>
						</div>
						<button id="submit" type="submit" hidden="true" name="select_q" 
							class="btn btn-default">Select</button>
					</form>

					
				</div>
				
				<div id ="myDiv" style="display:none"> Elaboration... <img id = "myImage" src = "images/ajax-loader.gif"></div>
				

				
				</nav>


		
			</div>
			<div class="alert alert-success">Final Score</div>
		
		<?php
		if (isset ( $finalScoreArray )) {
			echo "<div class='table-responsive'><table class='table table-striped'>
		    	 <thead><tr> <th>id</th>
		    	  			<th>image</th>
							<th>Description</th>
	    				    <th>alterantive</th>
	    					<th>value</th><th>quest_id</th><th>date</th>
	    		</tr></thead><tbody>";
			
			foreach ( $finalScoreArray as $q ) {
				    
					foreach ( $altArray as $alt ) {
					
						if($alt->id == $q->alternative){
					
						
						$php_array = array();
						$php_array[] = $q->value;
													
					
							echo "<tr>
							<td>" . $q->id . "</td>
							<td>" .
								"<img src='$alt->dir_path_file' alt='$alt->description' style='width:50px;height:50px;'>".
							"</td>".
							"<td>" . $alt->description . " </td>
							<td>" . $q->alternative . " </td>
							<td>" . $q->value . "</td>
							<td>" . $q->quest_id . "</td>
							<td>" . $q->date . "</td>					
							</tr>";
						}
					}
			}
		    			 
			
			echo "</tbody></table></div>";
		}else{
			
			echo "ERROR";
			
		}	
		?>

		
		<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

		</body>
		
		<div class="alert alert-success">Section 1: Preferences</div>
	
		<?php
		if (isset ( $section1Array )) {
			echo "<div class='table-responsive'><table class='table table-striped'>
		    	 <thead><tr> <th>id</th><th>criteria</th>
	    					<th>value</th><th>quest_id</th><th>date</th>
	    		</tr></thead><tbody>";
			
			foreach ( $section1Array as $q ) {
				echo "<tr>
						<td>" . $q->id . "</td>
						<td>" . $q->criteria . "</td>" . "
						<td>" . $q->value . "</td>
						<td>" . $q->quest_id . "</td>
						<td>" . $q->date . "</td>					
						</tr>";
			}
			echo "</tbody></table></div>";
		}
		?>
	
	
		<div class="alert alert-success">Section 2: Suitability</div>
		
		<?php
		if (isset ( $section2Array )) {
			echo "<div class='table-responsive'><table class='table table-striped'>
		    	 <thead><tr> <th>id</th>
	    				    <th>alterantive</th><th>criteria</th>
	    					<th>value</th><th>quest_id</th><th>date</th>
	    		</tr></thead><tbody>";
			
			foreach ( $section2Array as $q ) {
				echo "<tr>
						<td>" . $q->id . "</td>
					  	<td>" . $q->alternative . " </td>
						<td>" . $q->criteria . "</td>" . "
						<td>" . $q->value . "</td>
						<td>" . $q->quest_id . "</td>
						<td>" . $q->date . "</td>					
						</tr>";
			}
			
			
			
			echo "</tbody></table></div>";
		}
		?>


	</div>
</div>



</body>




    <div class="container">	
		<?php include 'footer.php'; ?>
    </div>

</html>
				<script type="text/javascript">
$(function () {
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'alternatives scores'
        },
        subtitle: {
            text: 'Source: ELIGERE.com'
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Percent (%)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Percent',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
			
        }]
    });
});


		
		</script>
