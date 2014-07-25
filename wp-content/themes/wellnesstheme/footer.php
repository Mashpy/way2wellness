<?php
/**
 * Footer Template
 *
 * @package Mysitemyway
 * @subpackage Template
 */
?>

<?php mysite_after_main();

?><div class="clearboth"></div>

	</div><!-- #content_inner -->
</div><!-- #content -->

<?php mysite_before_footer();

?><div id="footer">
	<div class="multibg">
		<div class="multibg"></div>
	</div>
	<div id="footer_inner">
		<?php mysite_footer();
		
	?></div><!-- #footer_inner -->
	<?php mysite_after_footer_inner();
?></div><!-- #footer -->

<?php mysite_after_footer();

?></div><!-- #body_inner -->

<?php wp_footer(); ?>
<?php mysite_body_end(); ?>
<!-- HitTail Code -->
<script type="text/javascript">
         (function(){ var ht = document.createElement('script');ht.async = true;
           ht.type='text/javascript';ht.src = '//106266.hittail.com/mlt.js';
           var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ht, s);})();
</script>
</body>
</html>