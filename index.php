<?php
//landing home page

 include "Controller/cntrMarkIt.php";

 $book = new cntrMarkIt();
 
 
 
 if(!isset($_REQUEST['flag'])){// first time landing page or Home button
	 
      $book->viewMenu();//show header menu

          ?>

     <html>
          <head>
               
               <link href="home.css" type="text/css" rel="stylesheet"/>
          </head>
          <div class="pagewrapper">
          <body>
          <div class="loggedIn">
			<p class="loggedinMain">Currently not logged in.</p>
		</div>	    
			<div class="navspacing">
                    <nav class="navMain"> 
                         <a href="index.php?flag=register"> Register</a> 
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                         <a href="index.php?flag=login"> Login</a> 
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </nav>
	   		</div>
               <div class="indexP">
                    <p>Welcome to MarkIt scheduling program! In order to start scheduling,
                    you must first register an account. If you are already registered, please
                    login.</p>

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
     </html>

<?php

 }
 
 else{
	 
	 $book->actions($_REQUEST['flag']);
 }

?> 