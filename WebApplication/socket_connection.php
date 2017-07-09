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
 
function surveyElaboration($idQuest){ 



		$fp = fsockopen("127.0.0.1", 8086, $errno, $errstr, 10);

		$vars = array(
			'id_quest' => $idQuest
		);
		$content = http_build_query($vars);


		fwrite($fp, $content);

		if (!$fp) {
			return "$errstr ($errno)<br />\n";
		} else {
			
			while (!feof($fp)) {
				return fgets($fp, 1024);
			}
			fclose($fp);
		}
		
		return "";


}


function chkServer($host, $port) 
{   

	$connection_ok = 0;
    $hostip = @gethostbyname($host); // resloves IP from Hostname returns hostname on failure 
    
    if ($hostip == $host) // if the IP is not resloved 
    { 
        echo "Fuzzy ahp engine server is down"; 
    } 
    else 
    { 
        if (!$x = @fsockopen($hostip, $port, $errno, $errstr, 5)) // attempt to connect 
        { 
            echo "Fuzzy ahp engine server is down"; 
        } 
        else 
        { 
			$connection_ok = 1;
            echo "Fuzzy ahp engine server is up"; 
            if ($x) 
            { 
                @fclose($x); //close connection 
            } 
        }  
    }
	return $connection_ok;
	
} 



?>
