<?php
/* Template Name: Spend */
get_header(); ?>

<div id="<?php echo get_field('main_id'); ?>" class="page-halfbanner">
    <?php get_template_part('inc/halfbanner'); ?>

    <?php
    $vendors = get_field('spend_vendors');
    $categories = [];
    if ($vendors) {
        foreach ($vendors as $v) {
            $cats = array_map('trim', explode(',', $v['vendor_category']));
            foreach ($cats as $cat) {
                if ($cat && !in_array($cat, $categories)) {
                    $categories[] = $cat;
                }
            }
        }
        sort($categories);
    }
    ?>

    <!-- Category Tabs -->
    <div class="bg-light py-4 filter-bar">
        <div class="container py-5 spend">
            <ul class="buy-tabs" id="spendTabs">
                <li class="active" data-filter="">All</li>
                <?php foreach ($categories as $cat): ?>
                    <li data-filter="<?php echo esc_attr($cat); ?>"><?php echo esc_html($cat); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <?php if ( !empty( get_the_content() ) ): ?>
    <section class="block block-text bg-white">
        <div class="container-sm block-pad-v">
            <div class="richtext text-lg-center">
                <?php the_content(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Vendor grid -->
    <div class="container py-5" id="spendVendors">
        <div class="row text-center">
            <?php if ($vendors): ?>
                <?php foreach ($vendors as $v): ?>
                    <div class="col-6 col-md-4 col-lg-2 mb-4 spend-vendor-item" data-category="<?php echo esc_attr(trim($v['vendor_category'])); ?>">
                        <a href="<?php echo esc_url($v['vendor_website']); ?>" target="_blank" rel="noopener" class="d-block text-decoration-none text-dark">
                            <?php if ($v['vendor_logo']): ?>
                                <img src="<?php echo esc_url($v['vendor_logo']); ?>" alt="" class="img-fluid mb-2" style="max-height:40px; object-fit:contain;">
                            <?php endif; ?>
                            <div class="font-weight-bold small"><?php echo esc_html($v['vendor_name']); ?></div>
                            <div class="text-muted small"><?php echo esc_html($v['vendor_category']); ?></div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- CTA Blocks -->
    <?php if (have_rows('spend_cta_blocks')): ?>
    <section class="block block-2col-card bg-white">
        <div class="container py-5 spend-container">
            <?php while( have_rows('spend_cta_blocks') ): the_row(); ?>
                <div class="row align-items-center mb-5">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <?php if ( get_sub_field('title') ): ?>
                            <h3 class="mb-3"><strong><?php the_sub_field('title'); ?></strong></h3>
                        <?php endif; ?>
                        <?php if ( get_sub_field('description') ): ?>
                            <div class="mb-3 richtext">
                                <?php the_sub_field('description'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="buttons">
                            <?php if( have_rows('buttons') ): ?>
                                <?php while( have_rows('buttons') ): the_row();
                                    $btn_class = (get_sub_field('style') == 'solid') ? 'btn-blue' : 'btn-ghost blue'; ?>
                                    <a href="<?php the_sub_field('url'); ?>"
                                       class="btn <?php echo $btn_class; ?>"
                                       target="_blank"
                                       rel="noopener">
                                       <?php the_sub_field('text'); ?>
                                    </a>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <?php
                        $media_type = strtolower(get_sub_field('media_type'));
                        if ($media_type === 'image') {
                            $img = get_sub_field('image');
                            if (!empty($img)) { ?>
                                <img src="<?php echo esc_url($img['url']); ?>"
                                     alt="<?php echo esc_attr($img['alt']); ?>"
                                     class="img-fluid">
                            <?php }
                        } elseif ($media_type === 'video') {
                            $video = get_sub_field('video_iframe');
                            if (!empty($video)) { ?>
                                <div class="video-wrapper">
                                    <?php echo $video; ?>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php if (get_field('view_more_link') != ''): ?>
    <div class="container py-5">
        <a href="<?php echo esc_url(get_field('view_more_link')); ?>" target="_blank" rel="noopener" class="btn btn-blue"><?php _e( 'View more', 'html5blank' ); ?></a>
    </div>
    <?php endif; ?>

    <?php get_template_part('inc/content_lg'); ?>
</div>
<?php get_footer(); ?>
