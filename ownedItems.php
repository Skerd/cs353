<?php

	ob_start();
	include('index.php');
	ob_end_clean();
	
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	//var_dump($_SESSION);
	
	$usernName =" to G-Orbit" ;
	$chatOutput = "";
	
	
	if (isset($_SESSION['loggedIn'])) {
		$userName = $_SESSION['userName'];
		$passWord = $_SESSION['passWord'];
		$loggedIn = $_SESSION['loggedIn'];
		$chatOutput = $_SESSION['chatOutput'];
	}

	
	
	$finalResult = "";
	
	if (isset($_SESSION['loggedIn'])) {
		$sql = "select game_code, name, number from purchase where user_name = '$userName'" ;
	}
	else{
		$sql = "select game_code, name from game_items" ;
	}
				
	
		$table  = $conn -> query($sql);
		
		$rowValue = "";
		$finalResult .= "<form id =\"plaGameForm\" method=\"post\" action = \"goplay.php\" >";
		$finalResult .= " <input type=\"hidden\" value=\"\"  id = \"accounCancel\"	name = \"input1\">	</form> " ;	
		$finalResult .= "<table id=\"playTable\" >";		
		$finalResult .= "<tr> <td> Game </td>  <td> Item </td> <td> Number </td> </tr>";
		while( $rowValue = $table->fetch_assoc() ){
			
			if (isset($_SESSION['loggedIn'])) {
				if($rowValue['number'] != Null && $rowValue['game_code'] != Null && $rowValue['name'] != Null){
					$gameName= $rowValue['game_code'];
					$item = $rowValue['name'];
					$number = $rowValue['number'];
				}
				else{
					$gameName = "NA";
					$item = "NA";
					$number = 0;
				}
			}
			else{
				$gameName= $rowValue['game_code'];
				$item = $rowValue['name'];
				$number = "NA";
			}		

			$finalResult .= " <tr> <td> $gameName </td>  <td> $item </td> <td> $number </td>  </tr> "  ;
			
		}
		
		$finalResult .= "</table> "  ;	
		
	$conn->close();
		
	session_write_close();

?>



<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="jquery-3.3.1.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel="stylesheet" type="text/css" href="cs353index.css">
<title>G-Orbit</title>
</head>

	<body  class="body" bgcolor="#000000"  >

		<body  class="body" bgcolor="#ffffff"  >

		<div class="topPart">
			<div class="koka"> Welcome <?php echo($usernName) ?> </div>
			
			<?php include("include/notification.html")?>
		
			<div class="login_right_top">
				<button class="button1" type="button" onclick="alerttt()" id="support"> Support </button> 
				<button class="button1" type="button" onclick="goAccount()" id="account"> Account </button> 
				
				<?php if (isset($_SESSION['loggedIn'])) { ?>
					<button class="button1" type="button" value="logout"  id="login_btn"> Sign out </button> 
				<?php } else { ?>
					<button class="button1" type="button" value="login"  id="login_btn"> Sign in / Join </button> 
				<?php } ?>
				
				<div id="put_Right">
					<button type="button" onclick="alertttSearch()">Ok</button>
				</div>
				<div id="put_Right">
					<form><input type="text" placeholder="Search.." name="search" id="search"></form>
				</div>
			</div>
			<br><br><br>
		</div>
		
		<nav  class="mainBar" >
		
			<! <img src="logo.jpg" alt="G-Orbit" class="barImg">
			
			<div class="dropdown">
				<button class="dropbtn" onclick="goHome()" >G-Orbit</button>
			</div>
			
			<div class="dropdown">
				<button class="dropbtn" onclick="playGame()" >Play</button>
			</div>
			
			<div class="dropdown">
				<button class="dropbtn">Games</button>
				<div class="dropdown-content">
					<a onclick="ownedGames()" >Owned Games</a>
					<a onclick="purchaseGames()" >Purchase Games</a>
				</div>
			</div>
			
			<div class="dropdown">
				<button class="dropbtn">Items</button>
				<div class="dropdown-content">
					<a onclick="ownedItems()">Owned Items</a>
					<a onclick="newGames()">New Games</a>
				</div>
			</div>
		
		
		</nav>
		
		
		
		<hr class="spaceLine" >
		
		
		
		<div class="playGames">
		<h1>Games Owned </h1>
		
			<?php echo $finalResult ?> 
		
		</div>
		
		
		
		<hr class="spaceLine" >
		
		
		<p class="footer"> Cs353 Project		Done by: xxx XXX , yyy YYY, zzz ZZZ </p>
		
		<br><br><br><br><br><br><br><br><br>
		
		
		<div id="myModal" class="modal">

			<!-- Modal content -->
			<div class="modal-content">
			<span class="close">&times;</span>
			<p><b>Log in to G-Orbit</b><br></p>
			
			<div class="credentials">
			<br><br><br>

				<form id= "login_Form" method="post" action="index.php">
				
					<label> Username:	    </label>
						<input id="uN" type="text" name="userName" placeholder="Username"><br>

					<label> Password:   	</label> 
						<input id = "pW" type="password" name="passWord" placeholder="Password"><br>
						
						<div class="showPass">
							<p id = "showP" > Show Password<br><br> </p>
						</div>
						
						<button onclick="getCredentials()" >Log In!</button>
						
				</form>
				
				<button onclick="createAccountPopUp()" class="button1" type="button" value="createLogin"  id="create_account"  class = "createAcc" > Create Account </button> 	
				
			
			<br><br><br>
			</div>
			</div>

		</div>
		
		
		
		
		<div id="accountModal" class="modal">


			<div class="modal-content">
			<span class="close">&times;</span>
			<p><b>Log in to G-Orbit</b><br></p>
				
				<div class="credentials">
				<br><br><br>

					<form id= "create_account_form" method="post" action="createAccount.php">
					
						<label> Username:	    </label>
							<input id="aUserName" type="text" name="userName" placeholder="Username" required><span class="tick">  </span><br>
						<label> Password:   	</label> 
							<input id = "aPassWord" type="password" name="passWord" placeholder="Password" required><span class="tick"> </span><br>
						<label> Confirm Password:   	</label> 
							<input id = "aConfirmPassWord" type="password" name="confirmPassWord" placeholder="Confirm Password" required><span class="tick"> </span><br>
						<label> Nationality:   	</label> 
							<input id = "aNationality" type="text" name="nationality" placeholder="Nationality" required><span class="tick"> </span><br>							
						<label> E-Mail: </label> <br>
							<input id = "aEMail" type="text" name="email" placeholder="E-Mail" required><span class="tick"> </span><br>						
							
					</form>
					
					<button class="button1" onclick="createAccount()" type="button" value="createLogin"  id="confirm_Account"  > Create Account </button> 	
					
				
				<br><br><br>
				</div>
			</div>

		</div>
		
		
		<form id ="logOutFormHidden" method="post" action ="index.php">
				<input id="logout" type="hidden" name="logout" value="ADSASD" >	 
		</form>
		
		<div class="chat_box">
			<div class="chat_head" onclick="hideChatBody()"> Chatt </div>
			<div class="chat_body" id="chat_body">
				<?php echo $chatOutput; ?>
			</div>
		</div>
		
	</body>
	
		<script  src="jumping.js"> </script>
		
		<script  language="javascript" type="text/javascript">
	

	
		</script>

	
	
	
	
	
</html>