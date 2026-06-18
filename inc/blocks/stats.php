<?php
// Block: Stats
// Renders animated counter statistics in a row

?>
<div class="row">
	<?php foreach ( get_sub_field('stats') as $stat) { ?>
		<div class="col-md-4">
			<div class="stat-item">
				<span class="label title-small"><?php echo $stat['stat_label'];?></span>
				<span class="value">
					<span data-countup="<?php echo $stat['stat_number'];?>"><?php echo $stat['stat_number'];?></span>
					<?php echo $stat['stat_unit'];?></span>
			</div>
		</div>
	<?php }?>
</div>
