
<?php

	ob_start();
	include('index.php');
	ob_end_clean();
	
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	//var_dump($_SESSION);
	
	$usernName = " to G-Orbit ";
	$chatOutput = "";
	$loggedIn ="";
	
	if (isset($_SESSION['loggedIn'])) {
		$userName = $_SESSION['userName'];
		$passWord = $_SESSION['passWord'];
		$loggedIn = $_SESSION['loggedIn'];
		$chatOutput = $_SESSION['chatOutput'];
	}

	
	$finalResult = "";
				
		if (isset($_SESSION['loggedIn'])) {
			$sql = "select name, publisher, version from game G, buy B where G.game_code = B.game_code AND B.user_name = '$userName'";
		}
		else{
			$sql = "select name, publisher, version from game";
		}
	
		$table  = $conn -> query($sql);
		
		$rowValue = "";
		$finalResult .= "<form id =\"plaGameForm\" method=\"post\" action = \"goplay.php\" >";
		$finalResult .= " <input type=\"hidden\" value=\"\"  id = \"accounCancel\"	name = \"input1\">	</form> " ;	
		$finalResult .= "<table id=\"playTable\" >";		
		$finalResult .= "<tr> <td> Game </td>  <td> Publisher </td> <td> Version </td> <td> Play </td> </tr>";
		while( $rowValue = $table->fetch_assoc() ){
			
			$name= $rowValue['name'];
			$publisher = $rowValue['publisher'];
			$version = $rowValue['version'];

			$finalResult .= " <tr> <td> $name </td>  <td> $publisher </td> <td> $version </td> <td><button  onclick=\"playOwnedGame(this.name)\"   name=\"$name\" type=\"button\">Play Now!</button> </td> </tr> "  ;
			
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
		
			<?php include("include/loginRightTop.html")?>
			<br><br><br>
		</div>
		<?php include("include/mainBar.html")?>
		
		
		
		<hr class="spaceLine" >
		
		
		
		<div class="playGames">
		<h1>Games Owned </h1>
		
			<?php echo $finalResult ?> 
		
		</div>
		

			<div style="display:inline-block; border: 2px solid green; height:200px;" >
				<div style="border-radius:10px;background-color:#111f23;padding:5px;float:left;width:450px;">
					<h1 style="color:#d9f4fc;">Heading</h1>
					<p style="color:#ff7200;">This is a small introduction to the game!!! From database</p>
					<div style="display: inline-block; float: left; vertical-align: top; margin-left: 25px;";>
						<p style="float:left;margin-right:15px;color:#ff7200;">Comments: 150</p>
						<p style="color:#ff7200;">Rating: 3.4</p>
					</div>
					<br>
					<div style="float:left;"><button class="button1" type="button" style="margin-right:7px;">Comment</button><button class="button1" type="button">Rate</button></div>
				</div>
				
				<div style="float:right;border-radius:10px;height:200px;display:grid;border:2px solid red;text-align:center;">
					<button class="button1" type="button" style="height:40px;background-color:#111f23;text-align:center;vertical-align:bottom;">Play Now</button>
					<img src="Game_Pictures/game1.jpg" style="width:160px;margin-left:5px;vertical-align:top;" />
				</div>
			</div>

		
		<hr class="spaceLine" >
			
		
		<?php include("include/sourceModal.html")?>
		<?php include("include/accountModal.html")?>
		
		
		<form id ="logOutFormHidden" method="post" action ="index.php">
				<input id="logout" type="hidden" name="logout" value="ADSASD" >	 
		</form>
		
		
		<div class="chat_box">
			<div class="chat_head" onclick="hideChatBody()"> Chatt </div>
			<div class="chat_body" id="chat_body">
				<?php echo $chatOutput; ?>
			</div>
		</div>
		
		<form id ="playThisGame" method="post" action ="createSession.php">
				<input id="whatGame" type="hidden" name="whatGame" value="" >	 
		</form>
		
		
		
		<p class="footer"> Cs353 Project		Done by: xxx XXX , yyy YYY, zzz ZZZ </p>
		
		<br><br><br><br><br><br><br><br><br>

	
		<script  src="jumping.js"> </script>
			<script >	
			
			
			$modalll = " aaaabbb";
			
			loggedIn = <?php echo $loggedIn; ?>;
			
			console.log( '<?php echo $chatOutput; ?>');

		
			function playOwnedGame( name ){
				
				alert("trying to play: " + name );
				var game = document.getElementById("whatGame");
				game.value = name;
				document.getElementById("playThisGame").submit();
				
				//window.location.href = 'https://www.miniclip.com/games/8-ball-pool-multiplayer/en/#t-w-c-H';
				
			}

		
		
		</script>

	
	
	</body>
	
	
</html>
