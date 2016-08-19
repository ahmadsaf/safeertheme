<?php


 //Reference: Lecture Slides 
 
 //Sited https://codex.wordpress.org/Function_Reference/the_permalink
get_header (); ?> 
	<div id="grid" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php the_content (); ?>
		<?php 
		$args = array('showposts' => 10, 'cat' => 'food-recipes');
		$my_query = new WP_Query($args);
		?>
		<?php if($my_query->have_posts()): while ($my_query->have_posts()): $my_query->the_post(); ?>
		<article id ="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute (); ?>">
		<div class ="gridlayout"> 
		<?php the_post_thumbnail ('thumbnail'); ?> </a> 
		</div>
		</article>
		<?php endwhile; ?>
		<div class="nav-previous"><?php next_posts_link(__( '&larr; Back Posts', 'codediva' ) ); ?></div>
			
			
			<div class="nav-next"><?php previous_posts_link( __( 'Front Posts &rarr;', 'codediva' )  ); ?></div>
		
		<?php 
		endif; ?>
		</main><!-- #main -->
		<?php if ( wp_is_mobile() ){ 
        echo '       
               <div class="responsivemobie"> Safeer Ahmad CCT460
        </div>'; } ?>
	</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
