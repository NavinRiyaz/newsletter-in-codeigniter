<script>
	(function ($) {
		'use strict';
		// Toggle classes in body for syncing sliding animation with other elements
		$('#bs-example-navbar-collapse-2')
        .on('show.bs.collapse', function (e) {
            $('body').addClass('menu-slider');
		})
        .on('shown.bs.collapse', function (e) {
            $('body').addClass('in');
		})
        .on('hide.bs.collapse', function (e) {
            $('body').removeClass('menu-slider');
		})
        .on('hidden.bs.collapse', function (e) {
            $('body').removeClass('in');
		});
	})(jQuery);
</script>
<style>
	/* Reset responsive Bootstrap elements */
	#navbar2 .navbar-header {
		float: none;
	}
	
	#navbar2 .navbar-toggle {
		display: block;
	}
	
	#navbar2 .navbar-nav {
		float: none !important;
		margin: 7.5px -15px;
	}
	
	#navbar2 .navbar-nav .open .dropdown-menu {
		position: static;
		float: none;
		background-color: transparent;
		border: 0;
		box-shadow: none;
	}
	
	#navbar2 .navbar-form {
		float: none !important;
		padding: 0;
	}
	
	#navbar2 .navbar-nav>li {
		float: none;
	}
	
	/* Reposition elements affected by the sliding menu */
	#wrapper {
		position: relative;
		right: 0;
		transition: right 0.35s ease;
	}
	
	#navbar2 .navbar-collapse {
		position: fixed;
		top: 0;
		right: -50%;
		display: block;
		//width: 50%;
		height: 100% !important;
		/*max-height: 100%;*/
		margin: 0;
		background-color: #f8f8f8;
		transition: right 0.35s ease;
	}
	
	#navbar2 .navbar-collapse.collapsing {
		transition: right 0.35s ease;
	}
	
	#navbar2 .navbar-collapse.in {
		right: 0;
		z-index:99;
	}
	
	body.menu-slider.in {
		overflow: hidden;
	}
	
	body.menu-slider #wrapper {
		transition: right 0.35s ease;
	}
	
	body.menu-slider.in #wrapper {
		right: 30%;
	}
</style>