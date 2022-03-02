<?php

session_start();



include "View/siteMenuView.php";


class cntrMarkIt {

    public $model, $view;

	function __construct() {	
	}
	
	function viewMenu(){		
		
		$this->view = new siteMenu();
	}	
	
	
	function actions($flag) {	
	
	    $this->viewMenu();		
		
		include "Model/modelTask.php";
		$this->model = new modelTask();
		
		
		if($flag=="register"){
			include "View/registerView.html";
		 }  
		if($flag=="registerUser"){		  		  
		  		  
			$this->model->registerUser ($_REQUEST['username'], $_REQUEST['password'], $_REQUEST['email'], $_REQUEST['accountType']);		  
		  }
		if($flag=="login"){
			include "View/loginView.html";
		 } 
		if($flag=="homeView"){
			include "View/homeView.html";
		 } 
		if($flag=="add"){
			include "View/addTaskView.html";
		 }   
		 if($flag=="connectionsView"){
			$this->model->connList($_SESSION['name']);
		 }   
		 if($flag=="forgot"){
			include "View/forgotPassword.html";
		 } 
		if($flag=="recover"){
			$this->model->emailRecovery ($_REQUEST['email']);
		 }      
		if($flag=="resetPass"){
			include "View/resetPassword.html";
		 }     
		if($flag=="reset"){
			$this->model->passwordReset ($_REQUEST['email'],$_REQUEST['password']);
		 }   
		if($flag=="insertTask"){		  		  
		  		  
			$this->model->insertTask ($_REQUEST['name'], $_REQUEST['dueDate'], $_REQUEST['desc'], $_SESSION['name']);		  
		  }
		if($flag=="view"){ // model communicating with view		 
			$this->model->viewTaskInfo($_SESSION['name']);
			$this->model->taskListView($_SESSION['name']);
		}
		if($flag=="Mark Complete"){ // model communicating with view		 
			
			$this->model->complete($_REQUEST['id']);
		}
		
		if($flag=="editTask"){ // model communicating with view		 
			
			$this->model->editTask($_REQUEST['id']);
			
		}
		if($flag=="teacherLogin"){ // model communicating with view		 
			
			include "View/teacherLoginView.html";
			
		}
		if($flag=="studentLogin"){ // model communicating with view		 
			
			include "View/studentLoginView.html";
			
		}
		if($flag=="edit"){ // model communicating with view		 
			
			$this->model->edit($_REQUEST['id'], $_REQUEST['name'], $_REQUEST['dueDate'], $_REQUEST['desc'], $_SESSION['name']);
			
		}
		// if($flag=="editTask"){ // model communicating with view		 
			
		// 	$this->model->edit($_REQUEST['id']);
		// }
		if($flag=="contactSupport"){
			include "View/contactSupportView.html";
		 } 
		 if($flag=="aboutUs"){
			include "View/aboutUsView.html";
		 }

		 if($flag=="completeView"){
			$this->model->viewTaskHistory($_SESSION['name']);
		 }
		
		if($flag=="search"){
			$this->model->connSearch($_REQUEST['username']);
		}

		if($flag=="addUser"){
			$this->model->connAdd($_REQUEST['id']);
		}

		if($flag=="prev"){
			$this->model->calendarPrev();
		}
		if($flag=="next"){
			$this->model->calendarNext();
		}
		if($flag=="adminTool"){
			include "View/adminLoginView.html";
		 }
		 if($flag=="addClassKey"){
			include "View/addClassKeyView.html";
		}
	
		
		if($flag=="adminView"){
			include "View/adminView.html";
		}
		if($flag=="classView"){
			include "View/classView.html";
		}
		if($flag=="studentView"){
			include "View/studentView.html";
		}
		if($flag=="classList"){
			$this->model->classList($_SESSION['name']);
		}
		if($flag=="editUserAdmin"){
			$this->model->editUserAdmin($_REQUEST['id']);
		}
		if($flag=="editStudent"){
			$this->model->editStudent($_REQUEST['id']);
		}
		if($flag=="editTaskAdmin"){
			$this->model->editTaskAdmin($_REQUEST['id']);
		}
		if($flag=="editTaskClass"){
			$this->model->editTaskClass($_REQUEST['id']);
		}
		if($flag=="editConnAdmin"){
			$this->model->editConnAdmin($_REQUEST['id']);
		}
		if($flag=="insertClassKey"){
			$this->model->insertClassKey($_REQUEST['classKey'],$_REQUEST['user']);
		}

		if($flag=="studentClassLogin"){
			$this->model->studentClassLogin($_REQUEST['class']);
		}

		if($flag=="classLogin"){
			//$this->model->adminLogin($_SESSION['username'], $_POST['adminKeyUser']);
			$DATABASE_HOST = 'localhost';
		$DATABASE_USER = 'root';
		$DATABASE_PASS = '';
		$DATABASE_NAME = 'markit';

		$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
			if ( !isset($_POST['classkey']) ) {
				// Display error if fields are incomplete
				echo 'classKeyUser';
				exit('Please fill in the class code field!');
			}
			if ($stmt = $con->prepare('SELECT classKey FROM classkeytable WHERE classKey =?')) {
				$stmt->bind_param('s', $_POST['classkey']);
				$stmt->execute();
				$stmt->store_result();
				if ($stmt->num_rows > 0) {
					$stmt->bind_result($classKey);
					echo $classKey;
					$stmt->fetch();
					if ($_POST['classkey'] === $classKey) {
						echo "Logged in as teacher";
						header('Location: index.php?flag=classView');
					} 
				} 
				else {
					// Incorrect username
					echo 'Incorrect admin key!';
				}
	
				$stmt->close();
			}
		}
		if($flag=="adminLogin"){
			//$this->model->adminLogin($_SESSION['username'], $_POST['adminKeyUser']);
			$DATABASE_HOST = 'localhost';
		$DATABASE_USER = 'root';
		$DATABASE_PASS = '';
		$DATABASE_NAME = 'markit';

		$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
			if ( !isset($_POST['adminkey']) ) {
				// Display error if fields are incomplete
				echo 'adminKeyUser';
				exit('Please fill in the admin key field!');
			}
			if ($stmt = $con->prepare('SELECT adminKey FROM adminkeytable WHERE adminKey =?')) {
				$stmt->bind_param('s', $_POST['adminkey']);
				$stmt->execute();
				$stmt->store_result();
				if ($stmt->num_rows > 0) {
					$stmt->bind_result($adminKey);
					echo $adminKey;
					$stmt->fetch();
					if ($_POST['adminkey'] === $adminKey) {
						echo "Logged in as admin";
						header('Location: index.php?flag=adminView');
					} 
				} 
				else {
					// Incorrect username
					echo 'Incorrect admin key!';
				}
	
				$stmt->close();
			}
		}

		if($flag=="authenticate"){ 		 
			/*session_start();*/
		$DATABASE_HOST = 'localhost';
		$DATABASE_USER = 'root';
		$DATABASE_PASS = '';
		$DATABASE_NAME = 'markit';

		$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
		if ( mysqli_connect_errno() ) {
			// Display error if connection is not established
			exit('Failed to connect to MySQL: ' . mysqli_connect_error());
		}
		if ( !isset($_POST['username'], $_POST['password']) ) {
			// Display error if fields are incomplete
			exit('Please fill both the username and password fields!');
		}
		if ($stmt = $con->prepare('SELECT id, password FROM users WHERE username = ?')) {
			$stmt->bind_param('s', $_POST['username']);
			$stmt->execute();
			$stmt->store_result();
			if ($stmt->num_rows > 0) {
				$stmt->bind_result($id, $password);
				$stmt->fetch();
				$verify = password_verify($_POST['password'], $password);
				if ($verify) {
					session_regenerate_id();
						$_SESSION['loggedin'] = TRUE;
						$_SESSION['name'] = $_POST['username'];
						$_SESSION['id'] = $id;
						header('Location: index.php?flag=homeView');	
				}
				else {
					// Incorrect username
					echo 'Incorrect username and/or password!';
				}
			} 
			

			$stmt->close();
			
		}	 
		if($flag=="logout"){ 		 
			session_start();
			session_destroy();
			// Redirect to the home page:
			header('URL=index.php');
		}	 
		
	}
	
		if($flag=="adminUsers"){
			$this->model->usersList();
		}
		if($flag=="studentUsers"){
			$this->model->studentList();
		}
		if($flag=="adminTasks"){
			$this->model->tasksList();
		}
		if($flag=="classTasks"){
			$this->model->classTaskList();
		}
		if($flag=="adminConn"){
			$this->model->connsList();
		}
		if($flag=="addToTask"){ // model communicating with view		 
			$this->model->viewTaskHistoryId($_REQUEST['id']);
			$this->model->connTaskList($_SESSION['name']);
			
		}
		if($flag=="confirmAddToTask"){
			$this->model->confirmAddToTask($_REQUEST['idTask'], $_REQUEST['idUser']);
		}
		if($flag=="Delete User"){
			$this->model->deleteUser($_REQUEST['id']);
		}
		if($flag=="Confirm Edit"){
			$this->model->confirmEditUser($_REQUEST['id'], $_REQUEST['username'], $_REQUEST['email'], 
			$_REQUEST['accountType']);
		}
		if($flag=="Delete Connection"){
			$this->model->deleteConn($_REQUEST['id']);
		}
		if($flag=="Edit Connection"){
			$this->model->confirmEditConn($_REQUEST['id'], $_REQUEST['userList'], $_REQUEST['userAdded'], $_REQUEST['accountType']);
		}
		if($flag=="Delete Task"){
			$this->model->deleteTask($_REQUEST['id']);
		}
		if($flag=="Edit Task"){
			$this->model->confirmEditTask($_REQUEST['id'], $_REQUEST['user'], $_REQUEST['name'], $_REQUEST['description'], 
			$_REQUEST['dueDate']);
		}
		if($flag=="logout"){
			$this->model->logout();
		}
	}
}	
