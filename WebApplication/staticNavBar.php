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

<script type="text/javascript"> 
var stile = "top=100, left=100, width=450, height=400, status=no, menubar=no, toolbar=no scrollbars=no"; 
function Popup(apri) 
{
  window.open(apri, "", stile);
}
</script>

<!-- header -->
<div id="top-nav" class="navbar navbar-default navbar-static-top">
	<img alt="create" src="logo.png">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><b>Home</b></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
						<i class="glyphicon glyphicon-user"></i> Admin <span class="caret"></span>
					</a>
                    <ul id="g-account-menu" class="dropdown-menu" role="menu">
                        <li><a href="adminLogin.php">Login</a></li>
                    </ul>
                </li>
                
				<li><a href="logout.php">
					<i class="glyphicon glyphicon-lock"></i> Logout</a>
				</li>
				
				

				
                <li><a href="#"><i class="glyphicon glyphicon-hourglass"></i>  
                	<?php 
                	$today = date("Y-m-d H:i:s");
                	echo  $today;
                	?></a></li>
                <li><a href="#"><i class="glyphicon glyphicon-user"></i>  
                	
                	<?php if (isset($_SESSION['yourname_session'])) echo $_SESSION['yourname_session'];?>
                	</a></li>
					
				<li><a href="javascript:Popup('info.html')"><i class="glyphicon glyphicon-info-sign"></i>  
                	Info
                	</a></li>	               
                
            </ul>
			
			


			
        </div>
    </div>
    <!-- /container -->
</div>
<!-- /Header -->

