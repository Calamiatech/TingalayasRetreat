<?php 

/* Template Name: Reservations template */ 

?>
 
<?php get_header( 'custom' ); ?>

<?php if ( have_posts() ) : the_post(); ?>

<?php gravity_form_enqueue_scripts(2, true); ?>


<div id="content">
	<div id="main-content">
		<div class="page-content page-content-deco default-styles">
			<h1><?php the_title(); ?></h1>
			<form method="post" enctype="multipart/form-data" target="gform_ajax_frame_2" id="gform_2" action="/reservations/#gf_2">
			<div class="table-box">
				<table>
				    <!-- Table Header -->
					<tr>
						<th class="col-rates"></th>
						<th class="col-season">High Season<br /> <?php echo get( 'high_season' ); ?></th>
						<th class="col-season">Low Season<br /> <?php echo get( 'low_season' ); ?></th>
						<th class="col-book">Reserve This Suite</th> 
					</tr>
					<!-- End Table Header -->
					
				<?php // Loop through Bungalow Rooms ?>
				<?php 
				$rates 	= getGroupOrder( 'rates_bungalow', get_the_ID() ); // Get rates 
				$total	= count( $rates );
				$count	= 0;
				?>
					
				<?php foreach ( $rates as $rate ) : $count ++; ?>
					<tr<?php echo ( $count == $total ? ' class="total"' : '' ); ?>>
						
					<?php if (get( 'res_link', $rate ) !== "") : ?>
						<td class="col-rates">
							<a href="<?php echo get( 'res_link', $rate ); ?>&reservation=1" target="_blank" class="iframe details-button simplelink">
								<?php echo get( 'rates_bungalow', $rate ); ?>
							</a>
						</td>
					<?php else : ?>
						<td class="col-rates"><strong><?php echo get( 'rates_bungalow', $rate ); ?></strong></td>
					<?php endif; ?>
						
						<td class="col-season"><?php echo get( 'rates_high_season', $rate ); ?></td>
						<td class="col-season"><?php echo get( 'rates_low_season', $rate ); ?></td>

						<td class="col-book">
							<input name="input_15.<?php echo $count ?>" type="checkbox" value="<?php echo get( 'rates_bungalow', $rate ); ?>" id="choice_15_<?php echo $count ?>" tabindex="<?php echo $count ?>">
						</td> 
					
					</tr>
				<?php endforeach; ?>
				
				</table>
            </div><!-- .table-box -->
    		<p><em>* Rent the entire property for your large groups, family gatherings or wedding and let Tingalaya's Retreat be your perfect home in Negril.</em></p>

    		<div class="gf_browser_chrome gform_wrapper reservation_form" id="gform_wrapper_2">
    			<a id="gf_2" name="gf_2" class="gform_anchor"></a>
                <div class="gform_body">
                	<p> Hello, my name is 
                		<label for="input_2_9_3" class="top">First</label><input type="text" name="input_9.3" id="input_2_9_3" value="" tabindex="13">
                		<label for="input_2_9_6" class="top">Last</label><input type="text" name="input_9.6" id="input_2_9_6" value="" tabindex="14">. &nbsp;
                		I am interested in reserving the above selected rooms from
                		<label class="gfield_label row2" for="input_2_1">First Night<span class="gfield_required">*</span></label>
                		<span class="ginput_container">
                			<input name="input_1" id="input_2_1" type="text" value="" class="datepicker medium mdy datepicker_with_icon hasDatepicker" tabindex="10"> 
                		</span>
                		<input type="hidden" id="gforms_calendar_icon_input_2_1" class="gform_hidden" value="http://tingalayasretreat.metagrapher.com/wp-content/plugins/gravityforms/images/calendar.png">
                		to
                		<label class="gfield_label row2" for="input_2_2">Last Night<span class="gfield_required">*</span></label>
            			<span class="ginput_container">
            				<input name="input_2" id="input_2_2" type="text" value="" class="datepicker medium mdy datepicker_with_icon hasDatepicker" tabindex="11">
            			</span>
            			<input type="hidden" id="gforms_calendar_icon_input_2_2" class="gform_hidden" value="http://tingalayasretreat.metagrapher.com/wp-content/plugins/gravityforms/images/calendar.png">
                		<br>for a party of&nbsp;
                		<label class="gfield_label row3" for="input_2_6">Number of Guests</label>
            			<span class="ginput_container">
            				<input name="input_6" id="input_2_6" type="number" step="any" value="" class="small" tabindex="12">
            			</span>.&nbsp;
            			Please contact me at
            			<label class="gfield_label row3" for="input_2_10">Phone</label>
            			<span class="ginput_container"><input name="input_10" id="input_2_10" type="tel" value="" class="medium" tabindex="15"></span>
            			 or
            			<label class="gfield_label row3" for="input_2_11">Email</label>
            			<span class="ginput_container"><input name="input_11" id="input_2_11" type="email" value="" class="medium" tabindex="16"> </span>
            		</p>

                    <ul id="gform_fields_2" class="gform_fields top_label description_below">
                		<li id="field_2_12" class="gfield">
                		    <label class="gfield_label" for="input_2_12">Questions, Comments, or Special Requests?</label>
                		    <div class="ginput_container"><textarea name="input_12" id="input_2_12" class="textarea medium" tabindex="17" rows="10" cols="50"></textarea></div>
                		</li>
                		<li id="field_2_16" class="gfield    gform_validation_container">
                		    <label class="gfield_label" for="input_2_16">Email</label><div class="ginput_container"><input name="input_16" id="input_2_16" type="text" value="" autocomplete="off"></div><div class="gfield_description">This field is for validation purposes and should be left unchanged.</div></li>
                    </ul>
                </div> <!-- .gform_body -->
                <div class="gform_footer top_label"> 
                    <input type="submit" id="gform_submit_button_2" class="button gform_button" value="Submit" tabindex="18" onclick="if(window[&quot;gf_submitting_2&quot;]){return false;}  if( !jQuery(&quot;#gform_2&quot;)[0].checkValidity || jQuery(&quot;#gform_2&quot;)[0].checkValidity()){window[&quot;gf_submitting_2&quot;]=true;} "><input type="hidden" name="gform_ajax" value="form_id=2&amp;title=&amp;description=">
                    <input type="hidden" class="gform_hidden" name="is_submit_2" value="1">
                    <input type="hidden" class="gform_hidden" name="gform_submit" value="2">
                    <input type="hidden" class="gform_hidden" name="gform_unique_id" value="">
                    <input type="hidden" class="gform_hidden" name="state_2" value="WyJhOjA6e30iLCIyMTNmYTAyNDExODEzZGMxZGU3N2JmOTM5MjY5YzA0YiJd">
                    <input type="hidden" class="gform_hidden" name="gform_target_page_number_2" id="gform_target_page_number_2" value="0">
                    <input type="hidden" class="gform_hidden" name="gform_source_page_number_2" id="gform_source_page_number_2" value="1">
                    <input type="hidden" name="gform_field_values" value="">
    
                </div>
            </div> <!-- .gform_wrapper -->
            </form>
			
				<script type="text/javascript" src="<?php echo bloginfo( 'template_url' ); ?>/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
				
				<script type="text/javascript" src="<?php echo bloginfo( 'template_url' ); ?>/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

				<script type="text/javascript">
				
					//<![CDATA[
					
					jQuery( document ).ready( function () {
												   
						jQuery( '.details-button' ).fancybox( {
							width	: 560,
							height	: 600
						} );
					
					} );
					
					//]]>
				
				</script>
			
			<?php the_content(); ?>
			
			
			<br class="clear-fix" />
			
				
	
			<?php /* ?>
			<div class="sidebar">
		
		
				<?php require( TEMPLATEPATH . '/modules/book-online.php' ); ?>
		
		
				<div id="call-us" class="box box-center">
				
					<p><em>Or call us!</em><br /> <strong>202-439-7929</strong><br /> Lisa Rosenstein</p>
					
				</div><!-- #call-us .box -->


			</div><!-- .sidebar --><?php */ ?>
			
			
			<br class="clear-fix" />
			
		
		</div><!-- .page-content -->
		
		
		<div class="page-content default-styles">
		
		
			<div class="col-left">
			
				
				<h3>Policies:</h3>

				<?php 
				$policies 	= getFieldOrder( 'policies_item', 1, 9 ); // Get policies
				$per_col	= ceil( count( $policies ) / 2 );
				$count 		= 0;
				?>
				
				<ul class="col">
				
				<?php foreach ( $policies as $policy ) : $count ++ ?>
				
					<?php if ( get( 'policies_item', 1, $policy, 0, 9 ) != '' ) : ?>
					
					<li><?php echo get( 'policies_item', 1, $policy, 0, 9 ); ?></li>
					
					<?php endif; ?>
				
				<?php if ( $count == $per_col ) : ?>
				
				</ul>
				
				<ul class="col col-r">
				
				<?php endif; ?>
				
				<?php endforeach; ?>
				
				</ul>
				
				
				<br class="clear-fix" />
		
			
			</div><!-- .col-left -->
			
			
			<div class="sidebar">
			
			
				<div class="box box-center">
				
				
					<p>Visa and MasterCard accepted.</p>
				
					<p><img src="<?php echo bloginfo( 'template_url' ); ?>/media/cards.gif" alt="" /></p>
				
				
				</div><!-- .box -->
			
			
			</div><!-- .sidebar -->
		
			
			<br class="clear-fix" />
			
		
		</div><!-- .page-content -->

		
		<br class="clear-fix" />
	
	
		<span class="deco-shadow">&nbsp;</span>
	

	</div><!-- #main-content -->


	<?php require( TEMPLATEPATH . '/modules/social-networks.php' ); ?>


</div><!-- #content -->


<?php endif; ?>

<?php get_footer( 'custom' ); ?>