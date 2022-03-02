<div class="pagewrapper">
<body>
<div class="loggedIn">
		<p class="loggedinMain">Logged in as: <?=$_SESSION['name']?></p>
	</div>

<?php

class viewConnSearch{
	
	function __construct ($allRows)	{

		?>

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

			<a href="index.php?flag=add"> Add Tasks </a> 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
			<a href="index.php?flag=view"> View Tasks </a> 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
			<a href="index.php?flag=connectionsView"> Connections </a> 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
		</nav>
		</div>

		<h2>Results</h2>
		<div class="listRowTitle">
					<li class="listIdConnAddView"><?php
					echo " <b>  ID</b>";
					?></li><li class="listUsernameConnAddView"><?php
					echo " <b>  Username</b>";
					?></li><li class="listEmailConnAddView"><?php
					echo " <b>  Email</b>";
					?></li>
					<li class="listRadio"><?php
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					?></li>
					</div>
        <?php
		foreach($allRows as $row)	{		
					?><form action="index.php" method="post"><?php
					$id = $row["id"];
					?>
					<input type="hidden" name="id" value="<?php echo $id;?>">
					<?php
					$name = $row["username"];
					$email = $row["email"];
					?><div class="listRow">
					<li class="listIdConnAddView"><?php
					echo " $id";
					?></li><li class="listUsernameConnAddView"><?php
					echo " $name";
					?></li><li class="listEmailConnAddView"><?php
					echo " $email";
					?></li><li class="">
					<input type="submit" value="Add">
					<input type="hidden" name="flag" value="addUser">
					</li></div></form>










				<?php  
	    }
?>
	</body>
	</div>
	<div class="footerDiv">
	<footer>
		<ul>
			<li><a href="index.php?flag=aboutUs"> About Us </a></li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp
			<li><a href="index.php?flag=contactSupport"> Contact Support </a></li>
		</ul>
	</footer>
</div>
        <?php
	// function calendarMonth(){

	// 	$todayDay = idate('d');
	// 	$todayMonth = idate('m');
	// 	$todayYear = idate('Y');

	// 	if (==){
	// 		return 
	// 	}
	// 	else {

	// 	}
	// }	

    }

}

