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
            <a class="navbar-brand" href="index.php"><b>TEST SUITE</b></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> Admin <span class="caret"></span></a>
                    <ul id="g-account-menu" class="dropdown-menu" role="menu">
                        <li><a href="adminLogin.php">Login</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="glyphicon glyphicon-lock"></i> Logout</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-hourglass"></i>  
                	<?php 
                	$today = date("Y-m-d H:i:s");
                	echo  $today;
                	?></a></li>
                <li><a href="#"><i class="glyphicon glyphicon-user"></i>  
                	
                	<?php if (isset($_SESSION['yourname_session'])) echo $_SESSION['yourname_session'];?>
                	</a></li>
               
                
            </ul>
        </div>
    </div>
    <!-- /container -->
</div>
<!-- /Header -->

