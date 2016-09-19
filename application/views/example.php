<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link type="text/css" rel="stylesheet" href="<?php echo base_url()."assets/css/bootstrap-theme.min.css"; ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url()."assets/css/bootstrap.min.css"; ?>" />
		<script src="<?php echo base_url()."assets/js/jquery.min.js"; ?>"></script>
		<script src="<?php echo base_url()."assets/js/bootstrap.min.js"; ?>"></script>
		<?php 
		foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
		
		<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
		<?php endforeach; ?>
		<style type='text/css'>
			body
			{
				font-family: Arial;
				font-size: 14px;
				background-color: ghostwhite;
			}
			<?php	
			if(IS_MOBILE){
				$this->load->view('includes/side_navigation_cssjs.php');
			} ?>
		</style>
	</head>
	<body class="menu-slider">
		<div id="wrapper">
			<?php $this->load->view('includes/menu.php'); ?> 
			<div class="container-fluid">
				<?php echo $output; ?>
			</div>
		</div>
	</body>
</html>
