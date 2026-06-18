<?php
// Block: Proposals
// Renders Dash governance proposals table (Vue.js powered) with description and buttons

?>
<div class="row align-items-center">

	<div class="col-lg-6 col-right order-lg-2">
		<div class="container-xs">
			<div class="richtext">
				<?php echo get_sub_field('section_description') ?>
			</div>
		</div>
		<div class="container-xs">
			<div class="pt-md-5 pt-3 buttons">
				<?php
				 $links = get_sub_field('block_buttons');
				 if (isset($links[0])){ ?>
							<?php foreach ( $links as $link) {
								$class = 'btn-ghost blue';
								if ($link['button_style']=='solid') {
									$class = 'btn-blue';
								}
							 ?>
							<a href="<?php echo $link['button_url']; ?>" class="btn <?php echo $class ?>"><?php echo $link['button_title']; ?></a>
					 		<?php } ?>
				 	<?php } ?>
			</div>
		</div>
	</div>

	<div class="col-lg-6">

		<dash-proposals
		inline-template>
			<div v-cloak>
				<div class="link-table" id="proposals-table">
					<div class="row header">
						<div class="col-5">
							<?php _e( 'Latest Proposals', 'html5blank' ); ?>
						</div>
						<div class="col">
							<?php _e( 'Votes', 'html5blank' ); ?> (y/n)
						</div>
						<div class="col">
							<?php _e( 'Amount', 'html5blank' ); ?>
						</div>
						<div class="col">
							<?php _e( 'Funding', 'html5blank' ); ?>
						</div>
					</div>

					<div class="row link-table-item" v-for="proposal in proposals">
						<div class="col-5">
							<a :href="'https://' + proposal.url" class="text-gray" target="_blank">
							{{proposal.title.length>40 ? proposal.title.substring(0, 40) + "..." : proposal.title}}
							</a>
						</div>
						<div class="col">
							{{proposal.yes}}/{{proposal.no}}
						</div>
						<div class="col">
							<span class="icon-inline dashcurrency blue">
								<?php get_template_part('inc/dashicon.svg'); ?>
							</span>{{+proposal.monthly_amount.toFixed(1)}}
						</div>
						<div class="col">
							<span class="text-center py-2" v-if="!proposal.will_be_funded">
								-
							</span>

							<span class="icon-inline check" v-if="proposal.will_be_funded">
								<svg width="15px" height="12px" viewBox="0 0 15 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								        <g>
								            <path d="M13.1638664,0.317599984 L4.87097791,8.56637735 L1.84495584,5.52271084 C1.42148919,5.09924419 0.742178114,5.09924419 0.318711468,5.51388861 C-0.104755177,5.92853304 -0.104755177,6.61666634 0.309889246,7.04013298 L4.09462239,10.8513328 C4.30635571,11.0630661 4.57984459,11.1689328 4.86215569,11.1689328 C5.13564456,11.1689328 5.40913344,11.0630661 5.62086676,10.8513328 L14.6812885,1.84384435 C15.1047552,1.42037771 15.1047552,0.74106663 14.6901108,0.317599984 C14.2666441,-0.105866661 13.587333,-0.105866661 13.1638664,0.317599984 Z"></path>
								        </g>
								    </g>
								</svg>
							</span>

						</div>
					</div>

				</div>
			</div>
		</dash-proposals>

		<p><small class="text-gray"><?php _e( 'Updated every 2 hours', 'html5blank' ); ?></small></p>
	</div>


</div>
