<?php
/* Template Name: Team Page */
get_header(); ?>

<div id="<?php echo get_field('main_id'); ?>" class="page-halfbanner page-contact">

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

	<?php
	$team_members = get_field('team_members');
	$tags = array();

	if ( $team_members ) {
		// Collect all unique tags
		foreach ( $team_members as $member ) {
			if ( !empty( $member['tag'] ) ) {
				$member_tags = array_map( 'trim', explode( ',', strtoupper( $member['tag'] ) ) );
				foreach ( $member_tags as $t ) {
					if ( $t !== '' && !in_array( $t, $tags ) ) {
						$tags[] = $t;
					}
				}
			}
		}
	}
	?>

	<section class="block block-team">
		<div class="bg-blue py-4 filter-bar">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-auto"><?php _e( 'Select Team', 'html5blank' ); ?></div>
					<div class="col-md-4">
						<select id="teamFilter" name="tag_c">
							<option value=""><?php _e( 'Any', 'html5blank' ); ?></option>
							<?php foreach ( $tags as $tag ) : ?>
								<option value="<?php echo esc_attr( $tag ); ?>"><?php echo esc_html( $tag ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="container bg-white py-5">
			<div class="row">
				<?php if ( $team_members ) : foreach ( $team_members as $member ) :
					$member_tags = !empty( $member['tag'] ) ? array_map( 'trim', explode( ',', strtoupper( $member['tag'] ) ) ) : array();
					$data_tags = esc_attr( implode( ',', $member_tags ) );
				?>
					<div class="col-lg-3 col-md-6 team-member-item" data-tags="<?php echo $data_tags; ?>">
						<div class="team-item">
							<?php if ( !empty( $member['team_image'] ) ) : ?>
								<img src="<?php echo esc_url( $member['team_image'] ); ?>" class="img-fluid" alt="<?php echo esc_attr( $member['team_name'] ); ?>">
							<?php endif; ?>
							<div class="caption">
								<h3><?php echo esc_html( $member['team_name'] ); ?></h3>
								<span class="role"><?php echo esc_html( $member['team_role'] ); ?></span>
								<?php if ( !empty( $member['email'] ) ) : ?>
									<p><?php _e( 'Email', 'html5blank' ); ?>: <?php echo esc_html( $member['email'] ); ?></p>
								<?php endif; ?>
								<?php if ( !empty( $member['keybase'] ) ) : ?>
									<p>Keybase: <a href="https://keybase.io/<?php echo esc_attr( $member['keybase'] ); ?>" target="_blank"><?php echo esc_html( $member['keybase'] ); ?></a></p>
								<?php endif; ?>
								<?php if ( !empty( $member['dashforum'] ) ) : ?>
									<p>Dash Forum: <a href="https://www.dash.org/forum/members/<?php echo esc_attr( $member['dashforum'] ); ?>" target="_blank"><?php echo esc_html( $member['dashforum'] ); ?></a></p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; endif; ?>
			</div>
		</div>
	</section>

</div>

<?php get_footer(); ?>
