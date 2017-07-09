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

    //get search term
    $searchTerm = $_GET['term'];
    $results = array();
    //get matched data from skills table
    $query = $conn->query("SELECT * FROM job_cat WHERE job_name LIKE '%".$searchTerm."%' ORDER BY job_id ASC");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['job_name'];
		array_push($results, array('id' => $row['job_id'], 'value' => $row['job_name']) );		
    }
    
    //return json data
    echo json_encode($results);

	
?>