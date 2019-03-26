<?php
					 $links = get_sub_field('block_buttons');
					 if (count($links)){ ?>
					 	<div class="container-xs">
							<div class="pt-md-5">
								<?php foreach ( $links as $link) {
									$class = 'btn-ghost';
									if ( $darkbg ){ $class .= ' white'; }
									else { $class .= ' blue'; }
									if ($link['button_style']=='solid') {
										if ( $darkbg ){ $class = 'btn-white';}
										else { $class = 'btn-blue';}
									}
								 ?>
								<a href="<?php echo $link['button_url']; ?>" class="btn <?php echo $class ?>"><?php echo $link['button_title']; ?></a>
						 		<?php } ?>
							</div>
						</div>
					 <?php } ?>
