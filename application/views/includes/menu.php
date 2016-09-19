<style>
.navbar-brand{
	padding-left: 0px;
}
@media (min-width: 768px){
	.navbar>.container .navbar-brand, .navbar>.container-fluid .navbar-brand {
		margin-left: 0px; 
	}
}
</style>
<nav id="navbar2" class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button  type="button" style="margin-left:10px;" class="navbar-toggle collapsed pull-left " data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url(); ?>">Newsletter</a>
		</div>
		
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
			<ul class="nav navbar-nav">
				<li class="active"><a href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Setup <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url('mailer/groups') ?>">Groups</a></li>
						<li><a href="<?php echo site_url('mailer/members') ?>">Members</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mails <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url('mailer/draft_mail');?>">Draft Mail</a></li>
						<li><a href="<?php echo site_url('mailer/sent_mails');?>">Sent Mails</a></li>
						<li><a href="<?php echo site_url('mailer/reset_mailer');?>">Reset Mailer</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">Dummy link</a></li>
					</ul>
				</li>
			</ul>
			
			<!--form class="navbar-form navbar-left" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form-->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('LOGIN_NAME'); ?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url('employee/profile/edit/101'); ?>">Edit</a></li>
						<li role="separator" class="divider"></li>
						<li><a href='<?php echo site_url('login/logout')?>'>Logout</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>