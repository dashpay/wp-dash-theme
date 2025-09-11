<?php 
/* Template Name: Downloads */ 
get_header(); ?>

<!-- <div id="<?php echo get_field('main_id'); ?>" class="page-halfbanner">
  <?php get_template_part('inc/halfbanner'); ?> -->

  <?php 
    $query = new WP_Query(array(
      'post_type' => 'downloadgroup',
      'post_status' => 'publish',
      'orderby' => 'menu_order',
      'order' => 'asc'
    ));
  ?>

  <section class="downloads-wrapper">
    <div class="container downloads-flex">

      <!-- LEFT COLUMN -->
      <div class="downloads-left block-nav">
        <div class="container-navigation">
          <div class="nav-icon-item"><a href="#mobile">Mobile</a></div>
          <div class="nav-icon-item"><a href="#desktop">Desktop</a></div>
          <div class="nav-icon-item"><a href="#hardware">Hardware</a></div>
          <div class="nav-icon-item"><a href="#web">Web</a></div>
          <div class="nav-icon-item"><a href="#paper">Paper</a></div>
        </div>
      </div>

      <!-- RIGHT COLUMN -->
      <div class="downloads-right">
        <?php while ($query->have_posts()) {
          $query->the_post();
          $post_id = get_the_ID(); 
          $section_id = get_field('section_id'); ?>

          <section class="block block-tabs block-download" <?php if ($section_id != '') echo "id=\"$section_id\""; ?>>
            <div class="container download-items">
              <h3><?php the_title(); ?></h3>
              <?php the_content(); ?>

              <?php if( count(get_field('download_panels')) > 1 ): ?>
                <nav>
                  <div class="nav nav-tabs" role="tablist">
                    <?php 
                    $panel = 0;
                    while( have_rows('download_panels') ): 
                      the_row(); 
                      $panel++;
                    ?>
                    <a 
                      class="nav-item nav-link <?php echo $panel == 1 ? 'active' : '' ?>"
                      id="group<?php echo $post_id ?>-label<?php echo $panel ?>" 
                      data-toggle="tab" 
                      href="#group<?php echo $post_id ?>-tab<?php echo $panel ?>" 
                      role="tab">
                      <?php the_sub_field('panel_name'); ?>
                    </a>
                    <?php endwhile; ?>
                  </div>
                </nav>
              <?php endif; ?>

              <div class="tab-content">
                <?php 
                $panel = 0;
                while( have_rows('download_panels') ): 
                  the_row(); 
                  $panel++;
                ?>
                <div 
                  class="tab-pane fade show <?php echo $panel == 1 ? 'active' : '' ?>" 
                  id="group<?php echo $post_id ?>-tab<?php echo $panel ?>" 
                  role="tabpanel" 
                  aria-labelledby="group<?php echo $post_id ?>-label<?php echo $panel ?>">
                  <div class="row py-4">
                    <?php 
                    $item = 0;
                    while( have_rows('panel_downloads') ): 
                      $item++;
                      the_row(); 
                    ?>
                    <div class="col-lg-4 col-md-6">
                      <div class="download-item <?php the_sub_field('class_item'); ?>">
                        <div class="top">
                          <div class="row align-items-center">
                            <div class="col-3">
                              <a href="#" class="download-modal-trigger" data-target=".group<?php echo $post_id ?>-label<?php echo $panel ?>-i<?php echo $item ?>">
                                <?php if (get_sub_field('download_logo')){ ?>
                                  <img src="<?php the_sub_field('download_logo'); ?>" class="image img-fluid" alt>
                                <?php } else { ?>
                                  <span class="icon-placeholder image"></span>
                                <?php } ?>
                              </a>
                            </div>
                            <div class="col-9">
                              <a href="#" class="download-modal-trigger" data-target=".group<?php echo $post_id ?>-label<?php echo $panel ?>-i<?php echo $item ?>"><h4><?php the_sub_field('download_name'); ?></h4></a>
                              <div class="text">
                                <?php the_sub_field('download_description'); ?>
                              </div>
                              <?php if (get_sub_field('download_file_1')){ ?>
                                <div class="link">
                                  <a href="<?php the_sub_field('download_file_1') ?>" target="_blank" class="btn btn-download" download>
                                    <i class="icon-el download"></i> <?php the_sub_field('download_file_1_name') ?>
                                  </a>
                                </div>
                              <?php } ?>
                              <?php if (get_sub_field('download_file_2')){ ?>
                                <div class="link">
                                  <a href="<?php the_sub_field('download_file_2') ?>" target="_blank" class="btn btn-download" download>
                                    <i class="icon-el download"></i> <?php the_sub_field('download_file_2_name') ?>
                                  </a>
                                </div>
                              <?php } ?>
                              <?php 
                              $links = ['download_link','download_link_2','download_link_3'];
                              foreach ($links as $key) {
                                if (get_sub_field($key)) { 
                                  $icon = 'offsite';
                                  if (strpos(get_sub_field($key),'.exe') !== false || strpos(get_sub_field($key),'.dmg') !== false || strpos(get_sub_field($key),'.zip') !== false || strpos(get_sub_field($key),'.tgz') !== false){
                                    $icon = 'download';
                                  }
                                  if (strpos(get_sub_field($key),'google') !== false){
                                    $icon = 'googleplay';
                                  }
                                  if (strpos(get_sub_field($key),'apple') !== false){
                                    $icon = 'iphone';
                                  }
                              ?>
                                <div class="link">
                                  <a href="<?php the_sub_field($key) ?>" target="_blank" class="btn btn-download">
                                    <i class="icon-el <?php echo $icon; ?>"></i> <?php the_sub_field($key.'_name') ?>
                                  </a>
                                </div>
                              <?php }} ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endwhile; ?>
                  </div>
                </div>
                <?php endwhile; ?>
              </div>
            </div>
          </section>
        <?php } ?>
      </div>
    </div>
  </section>

  <?php wp_reset_query(); ?>

  <?php if (!empty(get_the_content())): ?>
  <section class="block block-text bg-white">
    <div class="container-sm block-pad-v">
      <div class="richtext text-lg-center">
        <?php the_content(); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>
</div>

<?php get_footer(); ?>

