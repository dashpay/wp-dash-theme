<?php
// Block: Events
// Renders event listing table with description

?>
<div class="row">
	<div class="col-lg-6">
		<div class="block-pad-v fade-in-left">
			<div class="container-xs">
				<div class="richtext">
					<?php echo get_sub_field('section_description') ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">

		<div class="events-table">
			<div class=""><div class="row header">
				<div class="col-4">
					<span><?php _e( 'Event', 'html5blank' ); ?></span>
				</div>
				<div class="col-3">
					<span><?php _e( 'Date', 'html5blank' ); ?></span>
				</div>
				<div class="col-3">
					<span><?php _e( 'Type', 'html5blank' ); ?></span>
				</div>
				<div class="col-2">
				</div>
			</div>

			<?php
			$events = get_sub_field('event_list');
			foreach ( $events as $event) { ?>
				<div class="events-item">
					<div class="row">
						<div class="col-4">
							<?php echo $event['event_name'] ?>
						</div>
						<div class="col-3">
							<?php echo $event['event_type'] ?>
						</div>
						<div class="col-3">
							<?php echo $event['event_date'] ?>
						</div>
						<div class="col-2">
							<a href="<?php echo $event['event_link'] ?>">
								<span class="icon-inline sm gray">
									<?php get_template_part('inc/calendar.svg'); ?>
								</span>
							</a>
						</div>
					</div>
				</div>
			<?php } ?>


		</div>
	</div>
</div>
