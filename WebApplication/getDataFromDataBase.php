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
include "connection.php";
class Result {
	public $id;
	public $criteria;
	public $alternative;
	public $date;
	public $quest_id;
	public $value;
}

class FinalScore{
	public $id;
	public $alternative;
	public $date;
	public $quest_id;
	public $value;
}



class LinguisticScaleQuestion {
	public $id;
	public $cr1;
	public $cr2;
	public $desc;
	public $quest_id;
	public $description;
	public $simbol_id;
	public $simbol_value;
}
class LinguisticScale {
	public $id;
	public $description;
	public $simbol;
}
class Quest {
	public $id;
	public $name;
	public $description;
	public $date;
	public $password;
	public $dir;
}
class Question {
	public $id;
	public $cr1;
	public $cr2;
	public $desc;
	public $quest_id;
	public $descLabel;
}
class Criteria {
	public $id;
	public $name;
	public $description;
	public $quest_id;
}
class Alternative {
	public $id;
	public $name;
	public $description;
	public $quest_id;
	public $dir_path;
	public $dir_path_file;
}
class CriteriaAlternative {
	public $id;
	public $id_cri;
	public $name_cri;
	public $description_cri;
	public $id_alt1;
	public $id_alt2;
	public $name_alt1;
	public $name_alt2;
	public $description_alt1;
	public $description_alt2;
	public $quest_id;
	public $dir_path;
	public $dir_path_file;
	public $linguistic_id;
	public $simbol;
}
class User {
	public $id;
	public $name;
}
function getLinguisticScale($conn) {
	$questArray = array ();
	$query = "SELECT * FROM linguistic_scale";
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		// output data of each row
		while ( $row = $result->fetch_assoc () ) {
			$objLinguisticScale = new LinguisticScale ();
			$objLinguisticScale->id = $row ['id'];
			$objLinguisticScale->simbol = $row ['simbol'];
			$objLinguisticScale->description = $row ['description'];
			array_push ( $questArray, $objLinguisticScale );
		}
	} else {
		//echo "0 results";
	}
	
	return $questArray;
}
function getQuestionsLinguisticScale($conn, $quest_id, $user_id) {
	$array = array ();
	$query = "SELECT qlc.id as id_qlc, qlc.ling_scale_id, q.id as id_questionnarie, q.description, lc.simbol as simbol
				  FROM questions as q, question_linguistic_scale as qlc,  linguistic_scale as lc
				  WHERE qlc.user = $user_id and qlc.questions_id = q.id and q.questionnaire = $quest_id and lc.id = qlc.ling_scale_id ";
	
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		// output data of each row
		while ( $row = $result->fetch_assoc () ) {
			$obj = new LinguisticScaleQuestion ();
			$obj->id = $row ['id_qlc'];
			$obj->simbol_id = $row ['ling_scale_id'];
			$obj->description = $row ['description'];
			$obj->quest_id = $row ['id_questionnarie'];
			$obj->simbol_value = $row ['simbol'];
			
			array_push ( $array, $obj );
		}
	} else {
		//echo "0 results";
	}
	return $array;
}
function getUsersByQuestID($conn, $quest_id) {
	$array = array ();
	$query = "SELECT u.id, u.first_name FROM user as u, questionnarie_user as qu where u.id = qu.user_id and qu.quest_id = $quest_id ";
	
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		// output data of each row
		while ( $row = $result->fetch_assoc () ) {
			$obj = new User ();
			$obj->id = $row ['id'];
			$obj->name = $row ['first_name'];
			array_push ( $array, $obj );
		}
	} else {
		//echo "0 results";
	}
	return $array;
}
function getQuestByPWD($conn, $pwd) {
	$questArray = array ();
	$query = "SELECT * FROM questionnaire where password = '$pwd' ";
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		// output data of each row
		while ( $row = $result->fetch_assoc () ) {
			$objQuest = new Quest ();
			$objQuest->id = $row ['id'];
			$objQuest->name = $row ['name'];
			$objQuest->description = $row ['description'];
			$objQuest->password = $row ['password'];
			array_push ( $questArray, $objQuest );
		}
	} else {
		//echo "0 results";
	}
	return $questArray;
}
function getAllQuest($conn) {
	$questArray = array ();
	$query = "SELECT * FROM questionnaire";
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		// output data of each row
		while ( $row = $result->fetch_assoc () ) {
			$objQuest = new Quest ();
			$objQuest->id = $row ['id'];
			$objQuest->name = $row ['name'];
			$objQuest->description = $row ['description'];
			$objQuest->password = $row ['password'];
			$objQuest->date = $row ['date'];
			$objQuest->dir = $row ['dir'];
			array_push ( $questArray, $objQuest );
		}
	} else {
		//echo "0 results";
	}
	
	return $questArray;
}
function getQuestById($conn, $quest_id) {
	$query = "SELECT * FROM questionnaire where id = $quest_id";
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		// output data of each row
		while ( $row = $result->fetch_assoc () ) {
			$objQuest = new Quest ();
			$objQuest->id = $row ['id'];
			$objQuest->name = $row ['name'];
			$objQuest->description = $row ['description'];
			$objQuest->password = $row ['password'];
		}
	} else {
		//echo "0 results";
	}
	
	return $objQuest;
}
function getAllCriteria($conn) {
	$query = "SELECT * FROM criteria";
	$result = $conn->query ( $query );
	$criteriaArray = array ();
	if ($result->num_rows > 0) {
		// output data of each row
		
		while ( $row = $result->fetch_assoc () ) {
			
			$objCriteria = new Criteria ();
			$objCriteria->id = $row ['id'];
			$objCriteria->name = $row ['name'];
			$objCriteria->description = $row ['description'];
			$objCriteria->quest_id = $row ['quest_id'];
			array_push ( $criteriaArray, $objCriteria );
		}
	} else {
	}
	
	return $criteriaArray;
}
function getAllCriteriaByQuestId($conn, $quest_id) {
	if (isset ( $quest_id ) && $quest_id > 0) {
		$query = "SELECT * FROM criteria where quest_id = " . $quest_id . "";
		$result = $conn->query ( $query );
		$criteriaArray = array ();
		
		if ($result->num_rows > 0) {
			// output data of each row
			
			while ( $row = $result->fetch_assoc () ) {
				
				$objCriteria = new Criteria ();
				$objCriteria->id = $row ['id'];
				$objCriteria->name = $row ['name'];
				$objCriteria->description = $row ['description'];
				$objCriteria->quest_id = $row ['quest_id'];
				array_push ( $criteriaArray, $objCriteria );
			}
		} else {
		}
		return $criteriaArray;
	} else {
		return new Criteria ();
	}
}
function getAllQuestionsById($conn, $quest_id) {
	if (isset ( $quest_id ) && $quest_id > 0) {
		$query = "SELECT * FROM questions where questionnaire = $quest_id";
		$result = $conn->query ( $query );
		$array = array ();
		if ($result->num_rows > 0) {
			// output data of each row
			
			while ( $row = $result->fetch_assoc () ) {
				$obj = new Question ();
				$obj->id = $row ['id'];
				$obj->cr1 = $row ['cr1'];
				$obj->cr2 = $row ['cr2'];
				$obj->quest_id = $row ['questionnaire'];
				
				$obj->descLabel = $row ['description_long'];
				
				$obj->desc = $row ['description'];
				array_push ( $array, $obj );
			}
		} else {
			echo "0 results";
		}
		
		return $array;
	} else {
		
		return new Question ();
	}
}
function getAllAlternative($conn) {
	$queryAltByQuestId = "SELECT * FROM alternative ";
	$resultAlt = $conn->query ( $queryAltByQuestId );
	$alternativeArray = array ();
	if ($resultAlt->num_rows > 0) {
		// output data of each row
		
		while ( $row = $resultAlt->fetch_assoc () ) {
			$objAlternative = new Alternative ();
			$objAlternative->id = $row ['id'];
			$objAlternative->name = $row ['name'];
			$objAlternative->description = $row ['description'];
			$objAlternative->quest_id = $row ['questionnaire_id'];
			$objAlternative->dir_path = $row ['dir_path'];
			
			array_push ( $alternativeArray, $objAlternative );
		}
	} else {
		echo "0 results";
	}
	
	return $alternativeArray;
}
function getAllAlternativeByQuestID($conn, $quest_id) {
	$queryAltByQuestId = "SELECT * FROM alternative where questionnaire_id = $quest_id";
	$resultAlt = $conn->query ( $queryAltByQuestId );
	$alternativeArray = array ();
	if ($resultAlt->num_rows > 0) {
		// output data of each row
		while ( $row = $resultAlt->fetch_assoc () ) {
			$objAlternative = new Alternative ();
			$objAlternative->id = $row ['id'];
			$objAlternative->name = $row ['name'];
			$objAlternative->description = $row ['description'];
			$objAlternative->quest_id = $row ['questionnaire_id'];
			$objAlternative->dir_path = $row ['dir_path'];
			$objAlternative->dir_path_file = $row ['dir_path_file'];
			array_push ( $alternativeArray, $objAlternative );
		}
	} else {
		echo "0 results";
	}
	
	return $alternativeArray;
}
function getCriteriaAlternative($conn, $quest_id, $user_id) {
	$array = array ();
	$query = "SELECT * FROM criteria_alternative  WHERE user_id = $user_id and  questionnaire_id = $quest_id ";
	
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		// output data of each row
		while ( $row = $result->fetch_assoc () ) {
			$obj = new CriteriaAlternative ();
			$obj->id_alt1 = $row ['alt1'];
			$obj->id_alt2 = $row ['alt2'];
			$obj->linguistic_id = $row ['linguistic_id'];
			$obj->id_cri = $row ['cri_id'];
			array_push ( $array, $obj );
		}
	} else {
		//echo "0 results";
	}
	return $array;
}
function getCriteriaAlternativeAll($conn, $quest_id, $user_id) {
	$array = array ();
	
	$query = "SELECT ca.id,
						 ca.alt1,
						 ca.alt2,
						 ca.linguistic_id,
						 ca.cri_id,
						 c.name as cri_name,
						 c.description as cri_desc,
						 ls.simbol as simbol
						 FROM criteria_alternative as ca, criteria as c,  linguistic_scale as ls
				WHERE 	 ca.user_id = $user_id and
						 ca.cri_id = c.id and 
						 ca.linguistic_id = ls.id and
						 ca.questionnaire_id = $quest_id";
	
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		// output data of each row
		while ( $row = $result->fetch_assoc () ) {
			$obj = new CriteriaAlternative ();
			$obj->id = $row ['id'];
			$obj->id_alt1 = $row ['alt1'];
			$obj->id_alt2 = $row ['alt2'];
			$obj->linguistic_id = $row ['linguistic_id'];
			$obj->id_cri = $row ['cri_id'];
			$obj->name_cri = $row ['cri_name'];
			$obj->description_cri = $row ['cri_desc'];
			$obj->simbol = $row ['simbol'];
			
			array_push ( $array, $obj );
		}
	} else {
		//echo "0 results";
	}
	return $array;
}
function getSection1($conn, $quest_id) {
	$array = array ();
	$query = "SELECT * FROM results_preferences where quest_id = $quest_id";
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		// output data of each row
		while ( $row = $result->fetch_assoc () ) {
			$obj = new Result ();
			$obj->id = $row ['id'];
			$obj->criteria = $row ['criteria'];
			$obj->date = $row ['date'];
			$obj->quest_id = $row ['quest_id'];
			$obj->value = $row ['value'];
			
			array_push ( $array, $obj );
		}
	} else {
		//echo "0 results $quest_id";
	}
	
	return $array;
}
function getSection2($conn, $quest_id) {
	$array = array ();
	$query = "SELECT * FROM results_suitability where quest_id = $quest_id";
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		// output data of each row
		while ( $row = $result->fetch_assoc () ) {
			$obj = new Result ();
			$obj->id = $row ['id'];
			$obj->criteria = $row ['criteria'];
			$obj->alternative = $row ['alternative'];
			$obj->date = $row ['date'];
			$obj->quest_id = $row ['quest_id'];
			$obj->value = $row ['value'];
			
			array_push ( $array, $obj );
		}
	} else {
		//echo "0 results ";
	}
	
	return $array;
}

function getFinalScore($conn, $quest_id) {
	$array = array ();
	$query = "SELECT * FROM final_score where quest_id = $quest_id";
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		// output data of each row
		while ( $row = $result->fetch_assoc () ) {
			$obj = new FinalScore ();
			$obj->id = $row ['id'];
			$obj->alternative = $row ['alternative'];
			$obj->date = $row ['date'];
			$obj->quest_id = $row ['quest_id'];
			$obj->value = $row ['value'];			
			array_push ( $array, $obj );
		}
	} else {
		echo "0 results ";
	}
	
	return $array;
}

?>
