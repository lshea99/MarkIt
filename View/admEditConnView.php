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

<h2>Edit Conn</h2>
<?php

class viewConns{
	
	function __construct ($allRows)	{

		foreach($allRows as $row)	{			
                    $id = $row["id"];
					$userList = $row["userList"];
                    $accountType = $row["accountType"];
					$userAdded = $row["userAdded"];
                    ?>
					<div class="listRow"><?php
					echo "<br><br><u><b>Current Information</b></u><br><br>";?>
					<li class="listEditConnId"><?php
					echo "Id: $id";
					?></li><li class="listEditConnUsername"><?php
					echo "Username: $userList";
					?></li><br><li class="listEditConnaccountType"><?php
					echo "Added User: $userAdded";
					?></li><li class="listEditConnAddedUser"><?php
					echo "Account Type: $accountType";
					?></li><li class="">
					</li></div><br><br><?php
                    ?>
                    <form action="index.php" method="post">
					<div class="register">
					<input type="hidden" name="id" value="<?php echo $id?>">
					<input type="hidden" name="userList" value="<?php echo $userList?>">
					<input type="hidden" name="userAdded" value="<?php echo $userAdded?>">
					<input type="hidden" name="accountType" value="<?php echo $accountType?>">
                    Username:
                    <input type="text" name="userList" placeholder="<?php echo $userList?>" autocomplete="off"><br><br>
                    Added User:
                    <input type="text" name="userAdded" placeholder="<?php echo $userAdded?>" autocomplete="off"><br><br>
					</div>
                    <label for="option">Account Type:</label>
                    <select name="accountType" id="option">
 						<option value="Standard">Standard</option>
						<option value="Teacher">Teacher</option>
						<option value="Student">Student</option>
						<option value="Employer">Employer</option>
						<option value="Employee">Employee</option>
					</select>
					<br><br>
					
					
					<input type="submit" name="flag" value="Delete Connection">
                    <input type="submit" name="flag" value="Edit Connection">
                    </form>
                    <?php
					
	    }
		
	}
}		

   ?>
   </body>
   </div>