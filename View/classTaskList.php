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
		<a href="index.php?flag=studentUsers"> Student List </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
        <a href="index.php?flag=classList"> Class List </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
       
		
	</nav>

<?php

class viewTasks{
	
	function __construct ($allRows)	{
		
		?>
		
		<h2>Task List</h2>

		<div class="listRowTitle">
					<li class="listIdTask"><?php
					echo " <b>  ID</b>";
					?></li><li class="listUsernameTask"><?php
					echo " <b>  Username</b>";
					?></li><li class="listNameTask"><?php
					echo " <b>  Task Name</b>";
					?></li><li class="listdescriptionTask"><?php
					echo " <b>  Description</b>";
					?></li><li class="listdueDateTask"><?php
					echo " <b>  Due Date</b>";
					?></li>
					<li class="listRadio"><?php
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					?></li>
					</div><?php

		foreach($allRows as $row)	{			
                    $name = $row["name"];
					$dueDate = $row["dueDate"];
					$description = $row["description"];
					$user = $row["user"];
                    $id = $row["id"];
                    ?>
					<form action="index.php" method="post">
					<div class="listRow">
					<li class="listIdTask">
					<input type="hidden" name="id" value="<?php echo $id?>"><?php
					echo " $id";
					?></li><li class="listUsernameTask"><?php
					echo " $user";
					?></li><li class="listNameTask"><?php
					echo " $name";
					?></li><li class="listdescriptionTask"><?php
					echo " $description<br>";
					?></li><li class="listdueDateTask"><?php
					echo " $dueDate<br>";
					?></li><li class="">
					<input type="submit" value="Edit">
					<input type="hidden" name="flag" value="editTaskClass">
					</li></div></form><?php
					
	    }
		
	}
}		

   ?>