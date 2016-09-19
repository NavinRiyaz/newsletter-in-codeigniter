<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link type="text/css" rel="stylesheet" href="<?php echo base_url()."assets/bootstrap_select/bootstrap-select.min.css"; ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url()."assets/css/bootstrap-theme.min.css"; ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url()."assets/css/bootstrap.min.css"; ?>" />
		
		<script src="<?php echo base_url()."assets/js/jquery.min.js"; ?>"></script>
		<script src="<?php echo base_url()."assets/js/bootstrap.min.js"; ?>"></script>
		<script src="<?php echo base_url()."assets/bootstrap_select/bootstrap-select.min.js"; ?>"></script>
		
		
		<style type='text/css'>
			body
			{
				font-family: Arial;
				font-size: 14px;
				background-color: ghostwhite;
			}
		</style>
		<?php /*
		<!-- --------------Chosen --------------- -->
		 <link rel="stylesheet" href="<?php echo base_url()."assets/chosen/chosen.min.css"; ?>" >
		 <script src="<?php echo base_url()."assets/chosen/chosen.jquery.min.js"; ?>" type="text/javascript"></script>
		 <script src="<?php echo base_url()."assets/chosen/chosen.proto.min.js"; ?>" type="text/javascript"></script>
		<script type="text/javascript">
		var config = {
		  '.chosen-select'           : {},
		  '.chosen-select-deselect'  : {allow_single_deselect:true},
		  '.chosen-select-no-single' : {disable_search_threshold:10},
		  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
		  '.chosen-select-width'     : {width:"95%"}
		}
		for (var selector in config) {
		  $(selector).chosen(config[selector]);
		}
	  </script>
	    */ ?>
	<?php	
	if(IS_MOBILE){
		$this->load->view('side_navigation_cssjs.php');
	} ?>
	</head>
	<body class="menu-slider">
		<div id="wrapper">
			<?php $this->load->view('includes/menu.php'); ?>  
			<div class="container-fluid">
				<?php $this->load->view($main_content); ?>
			</div>
		</div>
	</body>
</html>
