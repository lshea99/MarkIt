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
            <a href="index.php?flag=adminView"> Admin Tool</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="index.php?flag=logout"> Logout</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="index.php?flag=homeView"> Home</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</nav>
	</div>
	<nav class="navbottom">
		<a href="index.php?flag=adminUsers"> User List </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
		<a href="index.php?flag=adminTasks"> Task List </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
		<a href="index.php?flag=adminConn"> Connections List </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
		<a href="index.php?flag=addClassKey"> Add Class </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
	</nav>

<?php

class viewConns{
	
	function __construct ($allRows)	{
		
		?>
		
		<h2>Connections List</h2>

		<div class="listRowTitle">
					<li class="listIdConn"><?php
					echo " <b>  ID</b>";
					?></li><li class="listUsernameConn"><?php
					echo " <b>  Username</b>";
					?></li><li class="listAccountTypeConn"><?php
					echo " <b>  AccountType</b>";
					?></li><li class="listUserAddedConn"><?php
					echo " <b>  Added User</b>";
					?></li>
					<li class="listRadio"><?php
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					?></li>
					</div><?php

		foreach($allRows as $row)	{			
                    $id = $row["id"];
					$userList = $row["userList"];
					$accountType = $row["accountType"];
					$userAdded = $row["userAdded"];
                    ?>
					<form action="index.php" method="post">
					<div class="listRow">
					<li class="listIdConn">
					<input type="hidden" name="id" value="<?php echo $id?>"><?php
					echo " $id";
					?></li><li class="listUsernameConn"><?php
					echo " $userList";
					?></li><li class="listAccountTypeConn"><?php
					echo " $accountType";
					?></li><li class="listUserAddedConn"><?php
					echo " $userAdded<br>";
					?></li><li class="">
					<input type="submit" value="Edit">
					<input type="hidden" name="flag" value="editConnAdmin">
					</li></div></form><?php
					
	    }
		
	}
}		

   ?>