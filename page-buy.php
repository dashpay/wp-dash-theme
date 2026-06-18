<?php
/* Template Name: Buy */
get_header(); ?>

<div id="<?php echo get_field('main_id'); ?>" class="page-halfbanner">
    <?php get_template_part('inc/halfbanner'); ?>

    <!-- Filter Tabs -->
    <div class="bg-light py-4 filter-bar">
        <div class="container-sm">
            <?php if (get_field('buy_tabs_title')): ?>
                <h3 class="mb-3 text-center"><?php the_field('buy_tabs_title'); ?></h3>
            <?php endif; ?>
            <ul class="buy-tabs" id="buyTabs">
                <li class="active" data-filter="exchange">Exchange</li>
                <li data-filter="onramp">Onramp</li>
                <li data-filter="dex">DEX</li>
                <li data-filter="swap">Swap</li>
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

    <!-- Vendor list -->
    <div class="buyspend-items container" id="buyVendors">
        <div class="buyspend-header d-none d-lg-flex font-weight-bold py-2 border-bottom">
            <div class="col-lg-3"></div>
            <div class="col-lg-3">Features</div>
            <div class="col-lg-2">Deposit time</div>
            <div class="col-lg-2">Trading pairs</div>
        </div>

        <?php if (have_rows('buy_vendors')): ?>
            <?php while (have_rows('buy_vendors')): the_row();
                $name = get_sub_field('vendor_name');
                $type = get_sub_field('vendor_type');
                $image = get_sub_field('vendor_image');
                $url = get_sub_field('vendor_url');
                $instantsend = get_sub_field('vendor_instantsend');
                $chainlocks = get_sub_field('vendor_chainlocks');
                $confirmations = intval(get_sub_field('vendor_confirmations'));
                $pairs = get_sub_field('vendor_trading_pairs');
                $deposit_time = $confirmations * 2.5;
            ?>
            <a class="buyspend-item row py-3 align-items-center border-bottom text-decoration-none text-dark"
               data-type="<?php echo esc_attr($type); ?>"
               href="<?php echo esc_url($url); ?>"
               target="_blank"
               rel="noopener">
                <div class="col-lg-3 d-flex align-items-center gap-2">
                    <?php if ($image): ?>
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($name); ?>" class="img-fluid" style="max-width:32px;">
                    <?php endif; ?>
                    <span class="font-weight-bold"><?php echo esc_html($name); ?></span>
                </div>
                <div class="col-lg-3">
                    <?php
                    $features = [];
                    if ($chainlocks) $features[] = 'ChainLocks';
                    if ($instantsend) $features[] = 'InstantSend';
                    echo esc_html(implode(' / ', $features));
                    ?>
                </div>
                <div class="col-lg-2">
                    <?php echo esc_html($deposit_time); ?> min
                </div>
                <div class="col-lg-2">
                    <?php echo esc_html($pairs); ?>
                </div>
            </a>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <?php get_template_part('inc/content_lg'); ?>
</div>
<?php get_footer(); ?>
