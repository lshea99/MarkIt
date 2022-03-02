<?php
?>
<head>
	<meta charset="utf-8">
	<title>Home Page</title>
	<script src="model.js" type="text/javascript"></script>
	<link href="home.css" type="text/css" rel="stylesheet" />
</head>
<div class="loggedIn">
	<p class="loggedinMain">Logged in as:
		<?=$_SESSION['name']?>
	</p>
</div>
<div class="navspacing">
		<nav class="navtop">
			<a href="index.php?flag=adminTool"> Admin Tool</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="index.php?flag=logout"> Logout</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="index.php?flag=homeView"> Home</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</nav>
	</div>
	<nav class="navbottom">

		<a href="index.php?flag=add"> Add Task </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
		<a href="index.php?flag=view"> View Tasks </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
		<a href="index.php?flag=completeView"> Task History </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
		<a href="index.php?flag=connectionsView"> Connections </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
	</nav>
<h2>Results</h2><br>

<?php
$f = 0;
class viewTasksId{
	
	function __construct ($allRows)	{
		
        ?>
        <p>Your selected task.</p><br>
        <div class="listRowTitle">
					<li class="listIdTaskView"><?php
					echo " <b>  ID</b>";
					?></li><li class="listNameTaskView"><?php
					echo " <b>  Task Name</b>";
					?></li><li class="listdescriptionTaskView"><?php
					echo " <b>  Description</b>";
					?></li><li class="listdueDateTaskView"><?php
					echo " <b>  Due Date</b>";
					?></li>
					<li class="listRadio"><?php
					echo "";
					?></li>
					</div><?php

		foreach($allRows as $row)	{			
					
					$idF = $row["id"];
					$name = $row["name"];
					$dueDate = $row["dueDate"];
					$description = $row["description"];
					
		            ?>
						<div class="listRow">
                    <input type="hidden" name="idTask" value="<?php echo $idF?>"><?php
                    global $f;
                    $f = $f + $idF;?>
					<li class="listIdTaskView"><?php
					echo " $idF";
					?></li><li class="listNameTaskView"><?php
					echo " $name";
					?></li><li class="listdescriptionTaskView"><?php
					echo " $description<br>";
					?></li><li class="listdueDateTaskView"><?php
					echo " $dueDate<br>";
					?></li><li class="">
					<form style = "display:inline"></li></form></div><br>
					   
<?php 
	    }
        ?><input type="hidden" name="idTask" value="<?php echo $idF?>"><?php
		
	}
		
}
			class viewList {
			
				function __construct ($allRows)	{
					?>
                    <br><br><br><br><br><br><br><br><br>
                    <h2>Add to Task</h2><br>
                    <p>Select a user to be added to your selected task.</p><br>
                    <div class="listRowTitle"><li class="listId"><?php
					echo " <b>  ID</b>";
					?></li><li class="listName"><?php
					echo " <b>  Username</b>";
					?></li><li class="listAccType"><?php
					echo " <b>  Acc Type</b>";
					?></li><li class="listAdded"><?php
					echo " <b>  Added Users</b>";?>
                    <li class="listRadio"><?php
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					?></li></div><?php
					
					foreach($allRows as $row)	{	

						$id = $row["id"];
						$userList = $row["userList"];
						$accountType = $row["accountType"];
						$userAdded = $row["userAdded"];?>
                        <form action="index.php" method="post">
                        <?php global $f;?>
                        <input type="hidden" name="idTask" value="<?php echo $f?>">
                        <input type="hidden" name="idUser" value="<?php echo $id?>">
						<div class="listRow"><li class="listId"><?php
						echo " $id";
						?></li><li class="listName"><?php
						echo " $userList";
						?></li><li class="listAccType"><?php
						echo " $accountType";
						?></li><li class="listAdded"><?php
						echo " $userAdded<br>";?></li>
                        <input type="submit" value="Select">
					    <input type ="hidden" name="flag" value="confirmAddToTask">
                        </div></form><?php
					
					}
                }
            }
					?></div>
    <?php
    ?>