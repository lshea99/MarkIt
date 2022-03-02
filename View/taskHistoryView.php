<?php
?>
<div class="loggedIn">
		<p class="loggedinMain">Logged in as: <?=$_SESSION['name']?></p>
	</div>
<div class="navspacing">
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

	<a href="index.php?flag=view"> View Tasks </a> 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
	<a href="index.php?flag=completeView"> Task History </a> 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
	<a href="index.php?flag=connectionsView"> Connections </a> 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
</nav>
</div>

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
		
		
		
		foreach($allRows as $row)	{			
                    $id = $row["id"];
					$name = $row["name"];
					$dueDate = $row["dueDate"];
					$description = $row["description"];
					?>
						<div class="listRow">
					
					<li class="listIdTaskView"><?php
					echo " $id";
					?></li><li class="listNameTaskView"><?php
					echo " $name";
					?></li><li class="listdescriptionTaskView"><?php
					echo " $description<br>";
					?></li><li class="listdueDateTaskView"><?php
					echo " $dueDate<br>";
					?></li></div><br><?php
                        
	    }
		
	}
}		

   ?>