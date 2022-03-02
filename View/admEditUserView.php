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

<h2>Edit User</h2>
<?php

class viewUsers{
	
	function __construct ($allRows)	{

		foreach($allRows as $row)	{			
                    $id = $row["id"];
					$username = $row["username"];
					$email = $row["email"];
					$passwordUser = $row["password"];
                    $accountType = $row["accountType"];
                    ?>
					<div class="listRow"><?php
					echo "<br><br><u><b>Current Information</b></u><br><br>";?>
					<li class="listEditUserId"><?php
					echo "Id: $id";
					?></li><li class="listEditUserUsername"><?php
					echo "Username: $username";
					?></li><br><li class="listEditUserEmail"><?php
					echo "Email: $email";
					?></li><li class="listEditUseraccountType"><?php
					echo "Account Type: $accountType";
					?></li><li class="">
					</li></div><br><br><?php
                    ?>
                    <form action="index.php" method="post">
					<div class="register">
					<input type="hidden" name="id" value="<?php echo $id?>">
					<input type="hidden" name="username" value="<?php echo $username?>">
					<input type="hidden" name="email" value="<?php echo $email?>">
					<input type="hidden" name="accountType" value="<?php echo $accountType?>">
                    Username:
                    <input type="text" name="username" placeholder="<?php echo $username?>" autocomplete="off"><br><br>
                    Email:
                    <input type="text" name="email" placeholder="<?php echo $email?>" autocomplete="off"><br><br>
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
					
					
					<input type="submit" name="flag" value="Delete User">
                    <input type="submit" name="flag" value="Confirm Edit">
                    </form>
                    <?php
					
	    }
		
	}
}		

   ?>
   </body>
   </div>