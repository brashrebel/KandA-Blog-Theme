<?php

// Google Analytics
function kanda_tracking() { ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-26555312-2', 'auto');
  ga('send', 'pageview');

</script>
<?php }
add_action( 'wp_head', 'kanda_tracking', 11 );

// Woocommerce content
function woocommerce_content() {

	if ( is_singular( 'product' ) ) {

		while ( have_posts() ) : the_post();

			woocommerce_get_template_part( 'content', 'single-product' );

		endwhile;

	} else { ?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<div class="post-header">
			<h1 class="page-title post-title"><?php woocommerce_page_title(); ?></h1>
		</div>
		<?php endif; ?>
<div class="post-content">
		<?php do_action( 'woocommerce_archive_description' ); ?>
</div>
		<?php if ( have_posts() ) : ?>
			
			<?php do_action('woocommerce_before_shop_loop'); ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php woocommerce_get_template_part( 'content', 'product' ); ?>
				
				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php do_action('woocommerce_after_shop_loop'); ?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>
			
		<?php endif;
	}
}

// Product thumbnails
add_action( 'init', 'kanda_product_thumbs' );
function kanda_product_thumbs() {
	add_theme_support( 'post-thumbnails' );
	add_post_type_support( 'product', 'thumbnail' );
}