<?php /* Template Name: Reservations template */ ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : the_post(); ?>


<div id="content">


	<div id="main-content">
	
	
		<div class="page-content page-content-deco default-styles">
		
			
			<h1><?php the_title(); ?></h1>
			
			
			<div class="col-left">
			
	
				<div class="table-box">
				
					<table>
					
						<tr>
						
							<th class="col-rates">Rates:</th>
							
							<th class="col-season">High Season<br /> <?php echo get( 'high_season' ); ?></th>
							
							<th class="col-season">Low Season<br /> <?php echo get( 'low_season' ); ?></th>
						
						</tr>

						<?php 
						$rates 	= getGroupOrder( 'rates_bungalow', get_the_ID() ); // Get rates 
						$total	= count( $rates );
						$count	= 0;
						?>
						
						<?php foreach ( $rates as $rate ) : $count ++; ?>
				
						<tr<?php echo ( $count == $total ? ' class="total"' : '' ); ?>>
						
							<td class="col-rates"><?php echo get( 'rates_bungalow', $rate ); ?></td>
							
							<td class="col-season"><?php echo get( 'rates_high_season', $rate ); ?></td>
							
							<td class="col-season"><?php echo get( 'rates_low_season', $rate ); ?></td>
						
						</tr>
						
						<?php endforeach; ?>
					
					</table>
				
				</div><!-- .table-box -->
								
				
				<?php the_content(); ?>
				
				
				<br class="clear-fix" />
				
				
			</div><!-- .col-left -->
	
			
			<div class="sidebar">
		
		
				<?php require( TEMPLATEPATH . '/modules/book-online.php' ); ?>
		
		
				<div id="call-us" class="box box-center">
				
					<p><em>Or call us!</em><br /> <strong>202-439-7929</strong><br /> Lisa and David Rosenstein</p>
					
				</div><!-- #call-us .box -->


			</div><!-- .sidebar -->
			
			
			<br class="clear-fix" />
			
		
		</div><!-- .page-content -->
		
		
		<div class="page-content default-styles">
		
		
			<div class="col-left">
			
				
				<h3>Policies:</h3>

				<?php 
				$policies 	= getFieldOrder( 'policies_item' ); // Get policies
				$per_col	= ceil( count( $policies ) / 2 );
				$count 		= 0;
				?>
				
				<ul class="col">
				
				<?php foreach ( $policies as $policy ) : $count ++ ?>
				
				<li><?php echo get( 'policies_item', 1, $policy ); ?></li>
				
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
				
				
					<p>Mastercard, Visa, checks<br /> and cash are accepted.</p>
				
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

<?php get_footer(); ?>