<?php
// Block: Speed Table
// Renders speed comparison table with description and buttons

?>
<div class="row">
	<div class="col-lg-6">
		<div class="block-pad-v fade-in-left">
			<div class="container-xs">
				<div class="richtext">
					<?php echo get_sub_field('section_description') ?>
				</div>
				<?php
				 $links = get_sub_field('block_buttons');
				 if (isset($links[0])){ ?>
				 	<div class="container-xs">
						<div class="pt-md-5 pt-3 buttons">
							<?php foreach ( $links as $link) {
								$class = 'btn-ghost white';
							 ?>
							<a href="<?php echo $link['button_url']; ?>" class="btn <?php echo $class ?>"><?php echo $link['button_title']; ?></a>
					 		<?php } ?>
						</div>
					</div>
				 <?php } ?>
			</div>
		</div>
	</div>
	<div class="col-lg-6">

		<div class="speed-table">
			<div class="row header">
				<?php
				$headers = explode('/',get_sub_field('speed_table_headers'));
				$subheaders = explode('/',get_sub_field('speed_table_subheaders'));
				?>
				<div class="col-3"></div>
				<div class="col-3">
					<span><?php echo($headers[0]); ?></span>
					<small><?php echo($subheaders[0]); ?></small>
				</div>
				<div class="col-3">
					<span><?php echo($headers[1]); ?></span>
					<small><?php echo($subheaders[1]); ?></small>
				</div>
				<div class="col-3">
					<span><?php echo($headers[2]); ?></span>
					<small><?php echo($subheaders[2]); ?></small>
				</div>
			</div>
			<?php
			$links = get_sub_field('speed_table_rows');
			foreach ( $links as $row) {
				$values = explode('/',$row['table_row_value']);
				?>
			<div class="row <?php if($row['table_row_highlight']=='yes'){echo 'highlight';} ?>">
				<?php foreach ( $values as $val) { ?>
					<div class="col-3">
						<?php
							if ($val=='Dash'){ ?>
							<div class="icon-inline blue">
								<?php get_template_part('inc/dashlogo.svg'); ?>
							</div>
						<?php } else echo $val; ?>
					</div>
				<?php } ?>
			</div>
			<?php } ?>
		</div>

	</div>
</div>
