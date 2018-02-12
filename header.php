<?php 
	/*
	   This is the template for header

	   @package naturetheme
	*/    
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<title><?php bloginfo('name'); wp_title();?></title>
		<meta name="description" content="<?php bloginfo( 'description' );?>">
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>

	<div class="container-fluid">
		
		<div class="row">
			<div class="col-xs-12">
				<div class="header-container text-center" style="background-image: url(<?php header_image(); ?>);">
					<div class="header-content table">
						<div class="table-cell">
							<h1 class="site-title"><?php bloginfo('name'); ?></h1>
							<h1 class="site-discription"><?php bloginfo('description'); ?></h1>
						</div>
					</div>
					<div class="nav-container">
						<nav class="navbar navbar-default navbar-nature">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'primary',
									'container' => false,
									'menu_class' =>  'nav navbar-nav',
									'walker' => new Nature_Walker_Nav_Primary()
								) );
							?>
						</nav>	
					</div>

				</div>	
			</div>
		</div>

	</div>


