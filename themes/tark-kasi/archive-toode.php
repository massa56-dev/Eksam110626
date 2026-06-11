<?php get_header(); ?>

<div class="page-banner">
    <div class="container">
        <h1>Meie tooted</h1>
        <p class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Avaleht</a> &rsaquo; Tooted</p>
    </div>
</div>

<div class="content-area">
    <div class="container">

        <?php if (have_posts()) : ?>
            <div class="products-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <?php
                    $hind = get_post_meta(get_the_ID(), 'hind', true);
                    if (function_exists('get_field')) {
                        $hind = get_field('hind') ?: $hind;
                    }
                    ?>
                    <article <?php post_class('product-card'); ?>>
                        <div class="product-card-body">
                            <?php if ($hind) : ?>
                                <p class="product-price"><?php echo esc_html($hind); ?></p>
                            <?php endif; ?>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p class="excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
                            <a href="<?php the_permalink(); ?>" class="read-more">Vaata lähemalt &rarr;</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div class="no-content">
                <h2>Tooteid pole veel lisatud</h2>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
