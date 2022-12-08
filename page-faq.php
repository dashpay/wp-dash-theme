<?php 
/* Template Name: Generic/FAQ Page */ 
get_header(); ?>


<?php $main = get_field('main_id'); ?>
<div id="main <?php echo $main; ?>" class="page-halfbanner">


	<?php get_template_part('inc/halfbanner'); ?>
	
	<?php if ( !empty( get_the_content() ) ){ ?>
	<section class="block block-text bg-white">
		<div class="container-sm block-pad-v">
			<div class="richtext text-lg-center">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	<?php }?>

	<?php if (have_rows('accordions')){?>
	<section class="block block-accordions bg-white">
		<div class="container block-pad-v">
			<div class="accordion" id="accordion1">

			<?php 
				$i = 0;
				while( have_rows('accordions') ): the_row(); 
				$i++;
			?>
			  <div class="card">
			  	<h4><?php echo get_sub_field('title_sections');?></h4>
			    <div class="card-header" id="heading<?php echo $i;?>">
			      <h5 class="mb-0">
			        <a class="" data-toggle="collapse" data-target="#panel<?php echo $i;?>" aria-expanded="false" aria-controls="panel<?php echo $i;?>">
			        	<?php echo get_sub_field('panel_title');?>
						<span class="icon-inline sm blue"><?php get_template_part('inc/caret.svg'); ?></span>
					</a>
			      </h5>
			    </div>

			    <div id="panel<?php echo $i;?>" class="collapse" aria-labelledby="heading<?php echo $i;?>" data-parent="#accordion1">
			      <div class="card-body">
			      	<div class="richtext text-sm">
				        <?php echo get_sub_field('panel_content')?>
				       </div>
			      </div>
			    </div>
			  </div>
			<?php endwhile; ?>
			  
			</div>
		</div>
	</section>
	<?php } ?>
	<?php get_template_part('inc/content_sm'); ?>

</div>

<?php get_footer(); ?>
