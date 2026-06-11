<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

<?php
// Fetch ACF fields if available, fall back to raw post meta
$hind            = function_exists('get_field') ? get_field('hind')            : get_post_meta(get_the_ID(), 'hind', true);
$koostisosad     = function_exists('get_field') ? get_field('koostisosad')      : get_post_meta(get_the_ID(), 'koostisosad', true);
$valmistamisaeg  = function_exists('get_field') ? get_field('valmistamisaeg')   : get_post_meta(get_the_ID(), 'valmistamisaeg', true);
?>

<div class="page-banner">
    <div class="container">
        <p class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Avaleht</a> &rsaquo;
            <a href="<?php echo esc_url(get_post_type_archive_link('toode')); ?>">Tooted</a> &rsaquo;
            <?php the_title(); ?>
        </p>
    </div>
</div>

<div class="content-area">
    <div class="container">
        <article <?php post_class('single-wrap'); ?>>
            <header class="single-header">
                <?php if ($hind) : ?>
                    <p class="product-price" style="font-size:1.6rem;color:#c17f4b;font-family:Arial,sans-serif;margin-bottom:.5rem;">
                        <?php echo esc_html($hind); ?>
                    </p>
                <?php endif; ?>
                <h1 class="post-title"><?php the_title(); ?></h1>
            </header>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <?php if ($hind || $koostisosad || $valmistamisaeg) : ?>
                <div class="product-meta-box">
                    <h3>Toote andmed</h3>
                    <?php if ($hind) : ?>
                        <div class="product-meta-item">
                            <strong>Hind:</strong>
                            <span><?php echo esc_html($hind); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ($valmistamisaeg) : ?>
                        <div class="product-meta-item">
                            <strong>Valmistamisaeg:</strong>
                            <span><?php echo esc_html($valmistamisaeg); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ($koostisosad) : ?>
                        <div class="product-meta-item">
                            <strong>Koostisosad:</strong>
                            <span><?php echo esc_html($koostisosad); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <a href="<?php echo esc_url(get_post_type_archive_link('toode')); ?>" class="back-link">
                &larr; Tagasi toodete juurde
            </a>
        </article>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
