<div class="header-wrapper header-2">
					<div class="site-branding">
						<?php
						the_custom_logo();
						if ( is_front_page() && is_home() ) :
							?>
						<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
						<?php
					else :
						?>
						<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
						<?php
					endif;
					$bootstrap_elements_description = get_bloginfo( 'description', 'display' );
					if ( $bootstrap_elements_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $bootstrap_elements_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><!-- <?php esc_html_e( 'Primary Menu', 'bootstrap-photography' ); ?> -->
						<div id="nav-icon">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</div>
					</button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>