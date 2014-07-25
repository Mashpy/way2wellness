<?php
/**
 * Single Template
 *
 * @package Mysitemyway
 * @subpackage Template
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div class="single_post_module">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<?php mysite_before_post( array( 'post_id' => get_the_ID() ) ); ?>
			
			<div class="single_post_content">
				
				<?php mysite_before_entry(); ?>
				
				<div class="entry">
					<?php the_content(); ?>
					
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- large-rectangle -->
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-3319855172961488"
     data-ad-slot="2338536855"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>


<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- large-rectangle -->
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-3319855172961488"
     data-ad-slot="2338536855"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

					<div class="clearboth"></div>
					
					<?php wp_link_pages( array( 'before' => '<div class="page_link">' . __( 'Pages:', MYSITE_TEXTDOMAIN ), 'after' => '</div>' ) ); ?>



					<?php edit_post_link( __( 'Edit', MYSITE_TEXTDOMAIN ), '<div class="edit_link">', '</div>' ); ?>
					
				</div><!-- .entry -->
				
				<?php mysite_after_entry(); ?>


				
			</div><!-- .single_post_content -->
			
		<?php mysite_after_post(); ?>



			</div><!-- #post-## -->
		</div><!-- .single_post_module -->
		

		
		<?php comments_template( '', true ); ?>
	
<?php endwhile; # end of the loop. ?>

<?php mysite_after_page_content(); ?>

		<div class="clearboth"></div>
	</div><!-- #main_inner -->
</div><!-- #main -->

<?php get_footer(); ?>