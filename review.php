
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
			<div class="koka"> Welcome Dumbeldor </div>
			
			<?php include("include/notification.html")?>
		
			<?php include("include/loginRightTop.html")?>
			<br><br><br>
		</div>
		<?php include("include/mainBar.html")?>
		
		
		
		<hr class="spaceLine" >
		
		
		
		<div class="playGames">
		
		<h1 class="koka">Add a review for:  Forza Horizon 3 </h1><br><br><br>
		
			<textarea rows="15" placeholder="Add a review, max 500 characters.." class="aaa">  </textarea>
			<br><button class="button1" > Submit Review </button>
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