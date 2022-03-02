<?php
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
 
require 'PHPMailer/Exception.php'; 
require 'PHPMailer/PHPMailer.php'; 
require 'PHPMailer/SMTP.php';



Class modelTask {
	
	public $conn;
	
	function __construct(){	
	
		$this->conn = new mysqli("localhost", "root", "", "markit");	
		
	}

	function registerUser ($username, $password, $email, $accountType) {
		
		$hash = password_hash($password, PASSWORD_DEFAULT);
		
		$sql = "INSERT INTO users (username, password, email, accountType)
        VALUES ('$username', '$hash', '$email', '$accountType')"; 
		
			
		if ($this->conn->query($sql) === TRUE) {
		echo "New User created successfully";
		} else {
		echo "Error: User couldn’t be inserted";
		}
		$this->conn->close(); // close DB connection		
		header('Refresh: 1; URL=index.php?');
	}

	function insertTask ($name, $dueDate, $desc, $user) {
			
		$sql = "INSERT INTO task (name, dueDate, description, user)
        VALUES ('$name', '$dueDate', '$desc', '$user')"; 	
			
		if ($this->conn->query($sql) === TRUE) {
		echo "New record created successfully, redirecting home";
		header('Refresh: 1; URL=index.php?flag=homeView');
		} 

		else {
		echo "Error: record couldn’t be inserted";
		}
		$this->conn->close(); // close DB connection		
		
	}
	function complete ($id) {
		
		$sql = "INSERT INTO taskhistory (name,dueDate,description,user) 
				SELECT name,dueDate,description,user FROM task WHERE id='$id'";			
		if ($this->conn->query($sql) === TRUE) {
		echo "New task history item added successfully; deleting from task list...";
		$this->deleteTask($id);

		} 

		else {
		echo "Error: record couldn’t be completed";
		}
		
	}
	function delete ($id) {
		$sql = "DELETE FROM task WHERE id = $id";
		if ($this->conn->query($sql) === TRUE) {
		echo "Record Deleted; Returning to Task List";

		} 

		else {
		echo "Error: record couldn’t be deleted";
		}
		//$this->conn->close(); // close DB connection		
		header('Refresh: 5; URL=index.php?flag=homeView');
	}
	function edit ($id, $name, $dueDate, $desc, $user) {
		$sql = "UPDATE task SET name='$name',dueDate='$dueDate', description='$desc',user='$user' WHERE id=$id";
			
		if ($this->conn->query($sql) === TRUE) {
		echo "Task item edited; returning to Task List";
		$this->conn->close(); // close DB connection		


		} 

		else {
		echo "Error: record couldn’t be completed";
		}
				
		header('Refresh: 1; URL=index.php?flag=homeView');
		
	}
	function viewTaskHistory($name){
		$sql = "SELECT name,dueDate,description,id FROM taskhistory WHERE user='$name' order by ID desc";
		$result = $this->conn->query($sql);

		 $allRows =  array();
		  while($row = $result->fetch_assoc()) {
			  
			  $allRows [] = $row;
			
			}				
			include "View/taskHistoryView.php";
			new viewTasks($allRows);
		}
	
	function emailRecovery($email){
		// $sql = "SELECT email FROM users WHERE email='$email'";
		// if ($this->conn->query($sql) === TRUE) {
				$mail = new PHPMailer; 
 
				$mail->isSMTP();                      // Set mailer to use SMTP 
				$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
				$mail->SMTPAuth = true;               // Enable SMTP authentication 
				$mail->Username = 'lsjg.markit@gmail.com';   // SMTP username 
				$mail->Password = 'markit123';   // SMTP password 
				$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
				$mail->Port = 587;                    // TCP port to connect to 

				$mail->setFrom('lsjg.markit@gmail.com', 'MarkIt'); 
				$mail->addReplyTo('lsjg.markit@gmail.com', 'MarkIt');
				$mail->addAddress($email); 
				$mail->isHTML(true);
				$mail->Subject = 'Forgot your MarkIt Password?';
				$bodyContent = '<h1>You have requested to change your password</h1>'; 
				$bodyContent .= '<p>Please proceed to the following link to reset your password:
				     <a href="http://localhost/webservices/markitgithub/MarkIt/index.php?flag=resetPass">Reset Password</a></b></p>'; 
				$mail->Body    = $bodyContent;  
		
				if(!$mail->send()) { 
					echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
				} else { 
					echo 'Message has been sent.'; 
					$this->conn->close(); // close DB connection
				} 
		
				//} 
		
				//  else {
				//  echo "Error: Recovery Email couldnt be sent";
				//  }
				header('Refresh: 1; URL=index.php');

			}
	function passwordReset ($email, $password) {
		
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$sql = "UPDATE users SET password='$hash' WHERE email='$email'";

		if ($this->conn->query($sql) === TRUE) {
		echo "New Password created successfully";
		header('Refresh: 1; URL=index.php');
		} else {
		echo "Error: Password couldn’t be reset";
		}
		$this->conn->close(); // close DB connection		
		
	}		
	function viewTaskInfo($name){
		$sql = "SELECT name,dueDate,description,id FROM task WHERE user='$name' order by ID desc";

		$result = $this->conn->query($sql);


		if ($result->num_rows > 0) {
		// output data of each row
		
		 $allRows =  array();
		  while($row = $result->fetch_assoc()) {
			  
			  $allRows [] = $row;
			
			}				
			include "View/allTasksView.php";
			new viewTasks($allRows);
			
			
		} else {
			?>
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
					<a href="index.php?flag=completeView"> Task History </a> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
					<a href="index.php?flag=connectionsView"> Connections </a> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
				</nav>
				</div>
			<?php
			echo "0 results found";
			?>
			</body>
		</div>
			<?php
		}
		
	}
	
	function connSearch($name) {

		$sql = "SELECT id,username,email FROM users WHERE username='$name' order by ID desc";

		$result = $this->conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				
				}				
				include "View/connAddView.php";
				new viewConnSearch($allRows);
				
			}

		else {
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
			<?php
			echo "0 results found";
		}
	}

	function connAdd ($id) {
		$sql = "SELECT username,accountType FROM users WHERE id ='$id'";
		$result = $this->conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				  $userAdd = $row['username'];
				  $username = $_SESSION['name'];
				  $accType = $row['accountType'];

				$sql = "INSERT INTO connections (userList, accountType, userAdded)
				VALUES ('$username', '$accType', '$userAdd')"; 
				?>
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
					<a href="index.php?flag=completeView"> Task History </a> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
					<a href="index.php?flag=connectionsView"> Connections </a> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
				</nav>
				</div>
			<?php
					
				if ($this->conn->query($sql) === TRUE) {
				echo "<br>$userAdd was added to your connections list.";
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
				} else {
				echo "Error: $userAdd couldn’t be added. Try again later.";
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
				}
				$this->conn->close(); // close DB connection		

				}				
				
				
			}

		else {
			?>
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
					<a href="index.php?flag=completeView"> Task History </a> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
					<a href="index.php?flag=connectionsView"> Connections </a> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
				</nav>
				</div>
			<?php
			echo "0 results found";
			?></body>
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

	function connList($name) {
		$sql = "SELECT id, userList, accountType, userAdded FROM connections WHERE userList ='$name'";
		$result = $this->conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				
				}				
				include "View/connectionsView.php";
				new viewList($allRows);
				
			}
		else {
			?>
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
				<p>When you add other users to your Connections List, 
					they will show up here.</p>
					
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

	function adminLogin($username, $adminKeyUser){
		$sql = "SELECT adminKey FROM adminkeytable WHERE adminKey ='$adminKeyUser'";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			 $allRows =  array();
			 while($row = $result->fetch_assoc()) {
			  
				$allRows [] = $row;
			  
			  }				
			  include "View/taskHistoryView.php";
			  new viewTasks($allRows);
			}
			
		else {

		}
	}

	function usersList(){
		$sql = "SELECT * FROM users order by ID desc";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				}			
				include "View/admUserList.php";
				new viewUsers($allRows);	
				
			}
		else {

		}
	}
	function classList($name){
		$sql = "SELECT classkey FROM classkeytable WHERE user = '$name'";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				}			
				include "View/classList.php";
				new viewClasses($allRows);	
				
			}
		else {

		}
	}
	function studentList(){
		$sql = "SELECT * FROM users WHERE accountType = 'Student' order by ID desc";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				}			
				include "View/studentList.php";
				new viewUsers($allRows);	
				
			}
		else {

		}
	}

	function tasksList(){
		$sql = "SELECT * FROM task order by ID desc";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			$allRows =  array();
			while($row = $result->fetch_assoc()) {
				
				$allRows [] = $row;
			  }			
			  include "View/admTaskList.php";
			  new viewTasks($allRows);
			}
		else {

		}
	}
	function studentClassLogin($class){
		$sql = "SELECT * FROM task WHERE description = '$class' AND user = (SELECT username FROM users WHERE accountType = 'Teacher') order by ID desc";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			$allRows =  array();
			while($row = $result->fetch_assoc()) {
				
				$allRows [] = $row;
			  }			
			  include "View/studentView.php";
			  new viewTasks($allRows);
			}
		else {
			echo "no results found";
		}
	}
	function classTaskList(){
		$sql = "SELECT * FROM task WHERE user = (SELECT username FROM users WHERE accountType = 'Teacher') order by ID desc";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			$allRows =  array();
			while($row = $result->fetch_assoc()) {
				
				$allRows [] = $row;
			  }			
			  include "View/classTaskList.php";
			  new viewTasks($allRows);
			}
		else {
			echo "no results found";
		}
	}
	function insertClassKey($classKey, $user){
		$sql = "INSERT INTO classkeytable (user, classkey) VALUES ('$user','$classKey')";			
		if ($this->conn->query($sql) === TRUE) {
			echo "Class Successfully Added to Database";
			header('Refresh: 1; URL=index.php?flag=adminView');
		} 

		else {
		echo "Error: Record couldn’t be added";
		
		}
		
	}
	

	function connsList(){
		$sql = "SELECT * FROM connections order by ID desc";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			$allRows =  array();
			while($row = $result->fetch_assoc()) {
				
				$allRows [] = $row;
			  }			
			  include "View/admConnList.php";
			  new viewConns($allRows);	
			}
		else {

		}
	}
	function editStudent($id){
		$sql = "SELECT * FROM users WHERE id ='$id'";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				}			
				include "View/editStudentView.php";
				new viewUsers($allRows);
			}
		else {

		}
	}
	function editUserAdmin($id){
		$sql = "SELECT * FROM users WHERE id ='$id'";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				}			
				include "View/admEditUserView.php";
				new viewUsers($allRows);
			}
		else {

		}
	}

	function editTaskAdmin($id){
		$sql = "SELECT * FROM task WHERE id ='$id'";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				}			
				include "View/admEditTaskView.php";
				new viewTasks($allRows);
			}
		else {

		}
	}
	function editTaskClass($id){
		$sql = "SELECT * FROM task WHERE id ='$id'";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				}			
				include "View/classEditTaskView.php";
				new viewTasks($allRows);
			}
		else {

		}
	}

	function editConnAdmin($id){
		$sql = "SELECT * FROM connections WHERE id ='$id'";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				}			
				include "View/admEditConnView.php";
				new viewConns($allRows);
			}
		else {

		}
	}

	function taskListView($name) {
		$sql = "SELECT name,dueDate,description,id FROM task WHERE user='$name' order by ID desc";
		$result = $this->conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				
				}
				new viewTasksList($allRows);
				
			}
		else {
			?>
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
				<p>When you add other users to your Connections List, 
					they will show up here.</p>
					
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

	function connTaskList($name) {
		$sql = "SELECT id, userList, accountType, userAdded FROM connections WHERE userList ='$name'";
		$result = $this->conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				
				}
				new viewList($allRows);
				
			}
		else {
		}
	}

	function viewTaskHistoryId($id){
		$sql = "SELECT name,dueDate,description,id FROM task WHERE id='$id'";
		$result = $this->conn->query($sql);

		 $allRows =  array();
		  while($row = $result->fetch_assoc()) {
			  
			  $allRows [] = $row;
			
			}				
			include "View/connAddUserView.php";
			new viewTasksId($allRows);
		}

	function confirmAddToTask($idTask, $idUser){
		$sql = "SELECT name,dueDate,description,id FROM task WHERE id='$idTask'";
		$result = $this->conn->query($sql);

		if ($result->num_rows > 0) {
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				  $name = $row['name'];
				  $dueDate = $row['dueDate'];
				  $description = $row['description'];
				  $id = $row['id'];
			  }
			}

		$sql = "SELECT id, userList, accountType, userAdded FROM connections WHERE id ='$idUser'";
		$result = $this->conn->query($sql);

		if ($result->num_rows > 0) {
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				  $userAdded = $row['userAdded'];
			  }
			}
		// insert into task using variables

		$sql = "INSERT INTO task (name, dueDate, description, user)
				VALUES ('$name', '$dueDate', '$description', '$userAdded')";

		if ($this->conn->query($sql) === TRUE) {
			echo "New User created successfully, redirecting home";
			header('Refresh: 1; URL=index.php?flag=homeView');
			} else {
			echo "Error: User couldn’t be inserted, redirecting home";
			header('Refresh: 1; URL=index.php?flag=homeView');
			}
			$this->conn->close(); // close DB connection

	}

	function deleteUser($id) {
		$sql = "DELETE FROM users WHERE id = $id";
		if ($this->conn->query($sql) === TRUE) {
		echo "User Deleted; Returning to User List";

		} 

		else {
		echo "Error: record couldn’t be deleted";
		}
		$this->conn->close(); // close DB connection		
	}

	function confirmEditUser($id, $username, $email, $accountType){

		$sql = "UPDATE users SET username='$username', email='$email', accountType='$accountType' WHERE id = $id";

		if ($this->conn->query($sql) === TRUE) {
			echo "Changes have been confirmed, returning to admin users page";
			header('Refresh: 1; URL=index.php?flag=adminUsers');
			} 
		else {
			echo "Error: Failed to edit user, returning to admin users page";
			header('Refresh: 1; URL=index.php?flag=adminUsers');
		}
		$this->conn->close(); // close DB connection
	}

	function deleteConn($id) {
		$sql = "DELETE FROM connections WHERE id = $id";
		if ($this->conn->query($sql) === TRUE) {
		echo "Connection Deleted; Returning to Conn List";
		header('Refresh: 1; URL=index.php?flag=adminConn');

		} 

		else {
		echo "Error: record couldn’t be deleted";
		header('Refresh: 1; URL=index.php?flag=adminConn');
		}
		$this->conn->close(); // close DB connection		
	}

	function confirmEditConn($id, $userList, $userAdded, $accountType){

		$sql = "UPDATE connections SET userList='$userList', userAdded='$userAdded', accountType='$accountType' WHERE id = $id";

		if ($this->conn->query($sql) === TRUE) {
			echo "Changes have been confirmed, returning to admin connections page";
			header('Refresh: 1; URL=index.php?flag=adminConn');
			} 
		else {
			echo "Error: Failed to edit connection, returning to admin connections page";
			header('Refresh: 1; URL=index.php?flag=adminConn');
		}
		$this->conn->close(); // close DB connection
	}

	function deleteTask($id) {
		$sql = "DELETE FROM task WHERE id = $id";
		if ($this->conn->query($sql) === TRUE) {
		echo "Task Deleted; Returning to Task List";
		header('Refresh: 1; URL=index.php?flag=homeView');
		} 

		else {
		echo "Error: record couldn’t be deleted";
		header('Refresh: 1; URL=index.php?flag=homeView');
		}
		$this->conn->close(); // close DB connection		
	}

	function confirmEditTask($id, $user, $name, $description, $dueDate){

		$sql = "UPDATE task SET user='$user', name='$name', description='$description', dueDate='$dueDate' WHERE id = $id";

		if ($this->conn->query($sql) === TRUE) {
			echo "Changes have been confirmed, returning to admin tasks page";
			header('Refresh: 1; URL=index.php?flag=homeView');
			} 
		else {
			echo "Error: Failed to edit connection, returning to admin tasks page";
			header('Refresh: 1; URL=index.php?flag=homeView');
		}
		$this->conn->close(); // close DB connection
	}

	function logout(){
		echo "Logging out...";
		header('Refresh: 1; URL=index.php');
	}

	function editTask($id){
		$sql = "SELECT * FROM task WHERE id ='$id'";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			 $allRows =  array();
			  while($row = $result->fetch_assoc()) {
				  
				  $allRows [] = $row;
				}			
				include "View/editTask.php";
				new viewTasks($allRows);
			}
		else {

		}
	}

	

}