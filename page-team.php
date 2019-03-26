<?php 
/* Template Name: Team Page */ 
get_header(); ?>

<div id="main" class="page-halfbanner page-contact">


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


	<dash-team 
	team='<?php echo json_encode(get_field( "team_members" ))?>'
		inline-template>
		<div v-cloak>

			<section class="block block-team">
				<div class="bg-blue py-4 filter-bar">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-md-auto"><?php _e( 'Select Team', 'html5blank' ); ?></div>
							<div class="col-md-4">
								<select name="tag_c">
									<option v-for="opt in tags" :value="opt">{{opt.length?opt:'Any'}}</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="container bg-white py-5">
			
					<div class="row">
						<div class="col-lg-3 col-md-6" v-for="person in people" v-show="person.show">
							<div class="team-item">
								<img :src="person.team_image" class="img-fluid" v-if="person.team_image.length">
								<div class="caption">
									<h3>{{person.team_name}}</h3>
									<span class="role">{{person.team_role}}</span>

									<p v-if="person.email.length"><?php _e( 'Email', 'html5blank' ); ?>: {{person.email}}</p>
									<p v-if="person.keybase.length">Keybase: <a :href="'https://keybase.io/'+person.keybase" target="_blank">{{person.keybase}}</a></p>
									<p v-if="person.dashforum.length">Dashforum: <a :href="'https://www.dash.org/forum/members/'+person.dashforum" target="_blank">{{person.dashforum}}</a></p>
								</div>
							</div>							
						</div>
					</div>
				</div>
			</section>

		</div>
	</dash-team>

</div>



<?php get_footer(); ?>
<?php 
/* Template Name: Team Page */ 
get_header(); ?>
