<html>
	<head>
		<title>Hello</title>
	</head>
	<body>
		<h1>Begin</h1>

		<h2>Register</h2>
		<form action="registerDB.php" action="get" >
			<div>
				<label for="fname" >First name:</label>
				<input type="text" name="fname" id="fname" />
			</div> 		
		
			<div>
				<label for="sname" >Surname:</label>
				<input type="text" name="sname" id="sname" />
			</div> 		
			
			<div>
				<label for="email" >Email:</label>
				<input type="text" name="email" id="email" />
			</div> 		
			
			<div>			
				<label for="pass" >Password:</label>
				<input type="password" name="pass" id="pass" />
			</div> 	
			
			<div>			
				
				<input type="submit" value="Register!" />
			</div> 		
		</form>		
		
		

		<h2>Sign-in</h2>
		<form action="login.php" action="get" >
			<div>
				<label for="email" >Email:</label>
				<input type="text" name="email" id="email" />
			</div> 		
		
			<div>
				<label for="pass" >Password:</label>
				<input type="text" name="pass" id="pass" />
			</div> 
			
			<div>			
				
				<input type="submit" value="Login!" />
			</div> 		
		</form>	


	</body>
</html>