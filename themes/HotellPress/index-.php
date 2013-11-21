<?php get_header('index');?>
<?php
global $wp_query, $sitepress;
//
//icl_sitepress_activate();
//icl_get_languages();
//$current = icl_get_languages();
//if ( method_exists ( $sitepress, 'get_current_language') )
//{
//	echo '<pre>';
//	print_r( $sitepress );
//	echo '</pre>';
//}

function test_func() {
	echo '<img title="gallery" class="wpGallery mceItem" _mce_src="http://localhost/wordpress/wp-includes/js/tinymce/plugins/wpgallery/img/t.gif" src="http://localhost/wordpress/wp-includes/js/tinymce/plugins/wpgallery/img/t.gif" _moz_resizing="true">';
}
add_shortcode('test', 'test_func');?>
	<div id="slideshow">
    		<div id="features"> 
				<ul id="feature-links"> 
				<li> 
					<a href="#feature-1" id="feature-link-1" title="Image 1" class="feature-link active"></a>				</li> 
				<li> 
					<a href="#feature-2" id="feature-link-2" title="Image 2" class="feature-link"></a>				</li> 
				<li> 
					<a href="#feature-3" id="feature-link-3" title="Image 3" class="feature-link"></a>				</li> 
				<li> 
					<a href="#feature-4" id="feature-link-4" title="Image 4" class="feature-link"></a>				</li> 
				<li> 
					<a href="#feature-5" id="feature-link-5" title="Image 5" class="feature-link"></a>				</li> 
				</ul> 
 
 			<!--  Get image -->
 			<?php 
 				$image = get_option('tgt_image_slider'); 			
 				if($image['i_1'] !='') { 
 			?>
			<div style="display: block;" id="feature-1" class="feature-story active"> 
				<img src="<?php echo TEMPLATE_URL.$image['i_1'];?>" alt="Image 1" title="Image 1" class="feature-photo"/>			</div> 
 			<?php }
 				if($image['i_2'] !='') {
 			?>
			<div style="display: none;" id="feature-2" class="feature-story"> 
				<img id="image_2" src="" alt="Image 2" title="Image 2" class="feature-photo"/>			</div> 
 			<?php }
 				if($image['i_3'] !='') {
 			?>
			<div style="display: none;" id="feature-3" class="feature-story"> 
				<img id="image_3" src="" alt="Image 3" title="Image 3" class="feature-photo"/>			</div> 
 			<?php }
 				if($image['i_4'] !='') {
 			?>
			<div style="display: none;" id="feature-4" class="feature-story"> 
				<img id="image_4" src="" alt="Image 4" title="Image 4" class="feature-photo"/>			</div> 
 			<?php }
 				if($image['i_5'] !='') {
 			?>
			<div style="display: none;" id="feature-5" class="feature-story"> 
				<img id="image_5" src="" alt="Image 5" title="Image 5" class="feature-photo"/>				</div> 
			</div> 
			<?php } ?>
   	  	</div>
				
				<div style="clear:both;"></div>
				<?php
				if(get_option('tgt_permit_reservations') == '1')
				{
				?>
				<div class="booking">	
					<div style="width:120px; float:left; margin:25px 0 0 30px;">
						<img style="float:left; margin:0; padding:0;" id="booking" src="<?php echo TEMPLATE_URL;?>/images/booking.jpg" alt="booking" />
						<p style="font:14px arial; font-weight:bold; color:#414141; float:left;">
						<a style="color:#414141;" href="#"><?php _e('BOOKING', 'hotel'); ?></a></p></div>
					<div style="width:695px; float:left;">
						<form  id="searchform_index" action="<?php echo tgt_get_page_link('search'); ?>" method="post"> 		   
							<div class="calendar">
								<input type="text" name="arrival_date" readonly="readonly" id="start-date" class="check datepicker"
								value="<?php echo date('m/d/Y');?>"/>
								<a id="calendar"><img src="<?php echo TEMPLATE_URL;?>/images/calendar.jpg" alt="calendar"/></a>		
							</div>
							<div class="calendar date-pick">
								<input type="text" name='departure_date' readonly="readonly" id="end-date" class="check datepicker" 
								value="<?php echo date('m/d/Y', strtotime('tomorrow'));?>"/>
								<a id="calendar"><img src="<?php echo TEMPLATE_URL;?>/images/calendar.jpg" alt="calendar" /></a>
							</div>
							
							<div class="select1">
								<select name="num_adults" style="width:65px; margin-top:5px; margin-left:8px; border:0px;" > 
										<option value="1"><?php _e('Adults', 'hotel'); ?></option>
										<?php
										$max_ppl = get_option('tgt_max_people_per_booking') ? get_option('tgt_max_people_per_booking') : 8;
										for ( $i = 1; $i <= $max_ppl; $i++ )
										{
											echo '<option value="' . $i . '">' . $i . '</option>';
										}
										?>
									</select>
							</div>
							
							<!--<div class="select1">-->
							<!--	<select name="num_kids" style="width:65px; margin-top:5px; margin-left:8px; border:0px;" > -->
							<!--		<option value="0"><?php _e('Kids','hotel'); ?></option>	-->
							<!--		<option value="1"><?php _e ('1', 'hotel');?></option>-->
							<!--		<option value="2"><?php _e ('2', 'hotel');?></option>-->
							<!--		<option value="3"><?php _e ('3', 'hotel');?></option>-->
							<!--		<option value="4"><?php _e ('4', 'hotel');?></option>-->
							<!--		<option value="5"><?php _e ('5', 'hotel');?></option>-->
							<!--	</select>-->
							<!--</div>-->
							
							<div class="select">
								<select name="num_rooms" class="rooms" style="width:112px; margin-top:5px; margin-left:8px; background: transparent; border:0px;"> 
										<option value="1"><?php _e('Number rooms','hotel'); ?></option>	
										<?php
										$max_rooms = get_option('tgt_max_rooms_per_booking') ? get_option('tgt_max_rooms_per_booking') : 8;
										for ( $i = 1; $i <= $max_rooms; $i++ )
										{
											echo '<option value="' . $i . '">' . $i . '</option>';
										}
										?>
								</select> 
							</div>
							
							<div class="button" style="margin-left: 109px;">  
								<div class="button_left"></div>        
								<div class="button_center">
									<input name="search" type="submit" value="<?php _e ('Search', 'hotel');?>" class="button" />
								</div>
								<div class="button_right"></div>
							</div>           
						</form> 
					</div>        		
					<a class="learn" href="<?php echo tgt_get_learn_more_link();?>"><?php echo get_post_field('post_title', tgt_get_learn_more_id());?></a>
				</div>
				<?php
				}
				?>
        	<?php
				if ( is_active_sidebar( 'bottom-widget-area' ) ) { ?>				                                       
				<?php dynamic_sidebar( 'bottom-widget-area' ); ?>                       
									
				<?php } ?>            
				
            <div style="clear:both;"></div>	
		
		<div class="bottom">
	
		</div>

    <!-- content end -->
<?php get_footer();?>
  