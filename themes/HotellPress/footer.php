      </div>
      
      <div style="clear:both;"></div>
    <!-- footer start -->
        <div id="footer">
                <img id="left" src="<?php echo TEMPLATE_URL;?>/images/footer-left.png" alt="footer"/>
            <h6>Copyright &copy; 2010. All rights reserved.</h6>
            <div class="privacy">					
					<?php					
						wp_nav_menu( array( 'container_class' => 'menu-nav-footer','menu_class' => '',  'theme_location' => 'footermenu', 'menu' => 'footer_menu') );
					?>
            </div>
                   <img id="right" src="<?php echo TEMPLATE_URL;?>/images/footer-right.png" alt="footer" />
            <div class="right">
            	<a href="http://www.dailywp.com/" title="Premium Wordpress Themes">Premium Wordpress Themes</a>
            </div>
            	
         </div>
	<div id="search_box">
		<div class="dialog_box">
			<div class="dialog-header">
				<a href="#close" class="close"><img src="<?php echo TEMPLATE_URL;?>/images/modal-close.jpg" alt="<?php _e('close','hotel'); ?>" /></a>
				<h3><?php _e('Search for available rooms','hotel') ?></h3>
			</div>
			<?php get_search_form();?>		
		</div>
	</div>
    <!-- footer end -->
<?php do_action('wp_footer');?>
</body>
</html>
