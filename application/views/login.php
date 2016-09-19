<?php  
	if(!isset($error)){ $error=""; }  
	if(!isset($username)){ $username=""; }  
	if(!isset($password)){ $password=""; } 
	?>
<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Login </title>
        <meta name="description" content="Custom Login Form Styling with CSS3" />
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>loginForm/css/style.css" />
		<script src="<?php echo base_url();?>loginForm/js/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		<style>	
			@import url(http://fonts.googleapis.com/css?family=Raleway:400,700);
			body {
				background: #7f9b4e url(<?php echo base_url();?>loginForm/images/bg2.jpg) no-repeat center top;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
			}
			.container > header h1,
			.container > header h2 {
				color: #fff;
				text-shadow: 0 1px 1px rgba(0,0,0,0.7);
			}
		</style>
    </head>
    <body>
        <div class="container">
		
			
			<header>
			
				<h1><strong>Login</strong></h1>
				<center>
					<div style="padding-top: 21px;   margin-bottom: -35px;  width: 275px;">
						<?php if(isset($error)){echo $error;} ?>
					</div>
				</center>
				
				<div class="support-note">
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>
				
			</header>
			
			<section class="main">
		     <?php 
				$attribute=array('class'=>'form-4');
				echo form_open('login/chk_login',$attribute);
			 ?>
				    <p>
				        <label for="login">Username or email</label>
				        <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username or email" required>
				    </p>
				    <p>
				        <label for="password">Password</label>
				        <input type="password" name='password' value="<?php echo $password; ?>" placeholder="Password" required> 
				    </p>

				    <p>
				        <input type="submit" name="submit" value="Login">
				    </p>       
					<input type="hidden" name='dcode' value="admin" >
				<?php echo form_close(); ?>
			</section>
			
        </div>
    </body>
</html>