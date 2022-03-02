<?php
?>
<div class="loggedIn">
		<p class="loggedinMain">Logged in as: <?=$_SESSION['name']?></p>
	</div>
<div class="navspacing">
<nav class="navtop">	
	<a href="index.php?flag=logout"> Logout</a> 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	<a href="index.php?flag=homeView"> Home</a> 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </nav>
</div>
<div>
<nav class="navbottom">

	<a href="index.php?flag=add"> Add Task </a> 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
	<a href="index.php?flag=completeView"> Task History </a> 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
	<a href="index.php?flag=connectionsView"> Connections </a> 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
</nav>

</div>
<!-- <form action="index.php" method="get">
Task ID to be Deleted: <input type="text" name="id"> 
<input type="hidden" name="flag" value="delete">
    <input type="submit" value="Delete"> <br><br>
</form>

<form action="index.php" method="get">
Task ID to be Marked Complete: <input type="text" name="id"> 
<input type="hidden" name="flag" value="complete">
    <input type="submit" value="Complete"> <br><br>
</form> 

<form action="index.php" method="get">
Task ID to be Edited: <input type="text" name="id">
New Name: <input type="text" name="name"> 
New Due Date: <input type="date" name="dueDate"><br><br>
New Description: <input type="text" name="desc">
<input type="hidden" name="flag" value="edit">
    <input type="submit" value="Edit"> <br><br>
</form> -->

					<h2>Edit Tasks</h2><br>

					<!-- <form action="index.php" method="get">
					Task ID to be Changed: <input type="text" name="id" size = "1">
					<label for="option">Select an option:</label>
					<select name="flag" id="option">
 					<option value="complete">Complete</option>
					<option value="delete">Delete</option> 
					<input type="submit">
					</select>
					</form> -->
					

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
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					?></li>
					</div>
<?php

class viewTasks{
	
	function __construct ($allRows)	{

		// echo " <b>  Task ID &nbsp;&nbsp; Task Name &nbsp;&nbsp; Due Date &nbsp;&nbsp;Description &nbsp;&nbsp </b><br><br>";
		
		foreach($allRows as $row)	{			
					
					$id = $row["id"];
					$name = $row["name"];
					$dueDate = $row["dueDate"];
					$description = $row["description"];
					
					
				
					
					//echo " $id &nbsp;&nbsp; $name &nbsp;&nbsp; $dueDate &nbsp;&nbsp; $description &nbsp;&nbsp;";
		            ?><form action="index.php" method="post">
						<input type="hidden" name="id" value="<?php echo $id?>">
						<div class="listRow">
					
					<li class="listIdTaskView"><?php
					echo " $id";
					?></li><li class="listNameTaskView"><?php
					echo " $name";
					?></li><li class="listdescriptionTaskView"><?php
					echo " $description<br>";
					?></li><li class="listdueDateTaskView"><?php
					echo " $dueDate<br>";
					?></li><li class="">
					<input type="submit" value="Edit">
					<input type ="hidden" name="flag" value="editTask"></li></form></div><br>
					
					
					    
		
					   
<?php 
	    }
		
	}
		
}

class viewTasksList{
	
	function __construct ($allRows)	{

		?><br><br><br><br><h2>Add Person to a Task</h2><br>
		<p>Select a task you would like to share with another person on your Connections List.</p><br>
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
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					?></li>
					</div><?php
		
		foreach($allRows as $row)	{			
					
					$id = $row["id"];
					$name = $row["name"];
					$dueDate = $row["dueDate"];
					$description = $row["description"];
			
		            ?>
					<form action="index.php" method="post">
					<div class="listRow">
					<input type="hidden" name="id" value="<?php echo $id?>">
					<li class="listIdTaskView"><?php
					echo " $id";
					?></li><li class="listNameTaskView"><?php
					echo " $name";
					?></li><li class="listdescriptionTaskView"><?php
					echo " $description<br>";
					?></li><li class="listdueDateTaskView"><?php
					echo " $dueDate<br>";
					?></li><li class="">
					<input type="submit" value="Select">
					<input type ="hidden" name="flag" value="addToTask">
					</li></div></form>
					
					
					    
		
					   
<?php 
	    }
		
	}
		
}
?>
