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
	</nav>


<?php

class viewClasses{
	
	function __construct ($allRows)	{
		
		?>
		
		<h2>Class List</h2>

		<?php

		foreach($allRows as $row)	{			
                    $classkey = $row["classkey"];
                    echo "$classkey" 
                    ?><br><br>
					<?php
					
	    }
		
	}
}		

   ?>
   </body>
   </div>