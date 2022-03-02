<?php

?>

<html>
	<head>
		<head>
			<link href="home.css" type="text/css" rel="stylesheet"/>
		</head>
		<meta charset="utf-8">
		<title>Connections</title>
	</head>
	<div class="pagewrapper">
	<body>
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
				<a href="index.php?flag=view"> View Tasks </a> 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
				<a href="index.php?flag=completeView"> Task History </a> 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</nav>
		</div>
		<h2 class="">Connections</h2>
		<div class="connections">
			<p class="connMessage">Welcome to the connections tool! Here, you can search for for other registered MarkIt users by username and add them to your 
			Connections list. <!--If the person you are looking for is not registered through MarkIt, you can add them through email.--></p>
			<div class="connSearch">
			<form action="index.php" method="post">	
				<p class="userConn">Search by</p>
				<label for="username">
				</label>
				<div class="userConn">
				<input type="text" name="username" placeholder="Username" id="username" autocomplete="off" required/>
				</div>
				<!--<p>or</p>
				<label for="email">
				</label>
				<div class="emailConn">
				<input type="text" name="email" placeholder="Email" id="email">
				</div> -->
				<div class="enterConn">
				<input type="submit" value="Enter">
				<input type="hidden" name="flag" value="search"> <br><br>
				</div>
				</div>
			</form>
		</div>
		<h2 class="">Your List</h2>
		<div class="connList">
			<?php
			class viewList {
			
				function __construct ($allRows)	{
					?><div class="listRowTitle"><li class="listId"><?php
					echo " <b>  ID</b>";
					?></li><li class="listName"><?php
					echo " <b>  Username</b>";
					?></li><li class="listAccType"><?php
					echo " <b>  Acc Type</b>";
					?></li><li class="listAdded"><?php
					echo " <b>  Added Users</b>";
					?></li></div><?php
					
					foreach($allRows as $row)	{	

						$id = $row["id"];
						$userList = $row["userList"];
						$accountType = $row["accountType"];
						$userAdded = $row["userAdded"];
						?><div class="listRow"><li class="listId"><?php
						echo " $id";
						?></li><li class="listName"><?php
						echo " $userList";
						?></li><li class="listAccType"><?php
						echo " $accountType";
						?></li><li class="listAdded"><?php
						echo " $userAdded<br>";
						?></li></div><?php
					
					}
					?></div>
	</div>
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
					
				}
			}	

			

   ?>
</html>

<?php

?>