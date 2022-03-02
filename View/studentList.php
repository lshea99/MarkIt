<?php
?>
<head>
	<meta charset="utf-8">
	<title>Admin Page</title>
	<script src="model.js" type="text/javascript"></script>
	<link href="home.css" type="text/css" rel="stylesheet" />
</head>
<div class="loggedIn">
	<p class="loggedinMain">Logged in as:
		<?=$_SESSION['name']?>
	</p>
</div>


<body class="loggedin">
	<div class="navspacing">
    <nav class="navtop">
			<a href="index.php?flag=logout"> Logout</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="index.php?flag=homeView"> Home</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</nav>
	</div>
	<nav class="navbottom">
		<a href="index.php?flag=classTasks"> Class Task List </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
		<a href="index.php?flag=classList"> Class List </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp

	</nav>


<?php

class viewUsers{
	
	function __construct ($allRows)	{
		
		?>
		
		<h2>User List</h2>

		<div class="listRowTitle">
					<li class="listIdUser"><?php
					echo " <b>  ID</b>";
					?></li><li class="listUsername"><?php
					echo " <b>  Username</b>";
					?></li><li class="listEmail"><?php
					echo " <b>  Email</b>";
					?></li><li class="listAccountType"><?php
					echo " <b>  Account Type</b>";
					?></li>
					<li class="listRadio"><?php
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					?></li>
					</div><?php

		foreach($allRows as $row)	{			
                    $id = $row["id"];
					$username = $row["username"];
					$email = $row["email"];
					$passwordUser = $row["password"];
                    $accountType = $row["accountType"];
                    ?>
					<form action="index.php" method="post">
					<div class="listRow">
					<input type="hidden" name="id" value="<?php echo $id?>">
					<li class="listIdUser"><?php
					echo " $id";
					?></li><li class="listUsername"><?php
					echo " $username";
					?></li><li class="listEmail"><?php
					echo " $email";
					?></li><li class="listAccountType"><?php
					echo " $accountType<br>";
					?></li><li class="">
					<input type="submit" value="Edit">
					<input type="hidden" name="flag" value="editStudent">
					</li></form></div><?php
					
	    }
		
	}
}		

   ?>
   </body>
   </div>