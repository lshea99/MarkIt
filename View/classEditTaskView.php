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
		<a href="index.php?flag=classTasks"> Class Task List </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
        <a href="index.php?flag=classList"> Class List </a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
	</nav>

<?php

class viewTasks{
	
	function __construct ($allRows)	{

		foreach($allRows as $row)	{			
                    $id = $row["id"];
					$user = $row["user"];
					$name = $row["name"];
					$description = $row["description"];
                    $dueDate = $row["dueDate"];
                    ?>
					<h2>Edit Tasks</h2>
					<p>Please Enter the new details of your Task</p>
					<div class="listRow"><?php
					echo "<br><br><u><b>Current Information</b></u><br><br>";?>
					<li class="listEditTaskId"><?php
					echo "Id: $id";
					?></li><li class="listEditTaskUsername"><?php
					echo "Username: $user";
					?></li><br><li class="listEditTaskName"><?php
					echo "Task Name: $name";
					?></li><li class="listEditTaskdescription"><?php
					echo "Description: $description";
                    ?></li><li class="listEditTaskdueDate"><?php
					echo "Due Date: $dueDate";
					?></li><li class="">
					</li></div><br><br><?php
                    ?>
                    <form action="index.php" method="post">
					<div class="register">
					<input type="hidden" name="id" value="<?php echo $id?>">
					<input type="hidden" name="user" value="<?php echo $user?>">
					<input type="hidden" name="name" value="<?php echo $name?>">
					<input type="hidden" name="description" value="<?php echo $description?>">
					<input type="hidden" name="dueDate" value="<?php echo $dueDate?>">
                    Task Name: <input type="text" name="name"> <br><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Due Date: <input type=date name="dueDate"> <br><br> 
					Description: <input type="text" name="desc">
					</div><br><br>
					
					<input type="submit" name="flag" value="Delete Task">
                    <input type="submit" name="flag" value="Edit Task">
                    </form>
                    <?php
					
	    }
		
	}
}		

   ?>
   </body>
   </div>