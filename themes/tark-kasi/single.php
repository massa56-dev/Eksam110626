<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

<div class="page-banner">
    <div class="container">
        <p class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Avaleht</a> &rsaquo;
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">Uudised</a> &rsaquo;
            <?php the_title(); ?>
        </p>
    </div>
</div>

<div class="content-area">
    <div class="container">
        <article <?php post_class('single-wrap'); ?>>
            <header class="single-header">
                <h1 class="post-title"><?php the_title(); ?></h1>
                <p class="post-info">
                    Avaldatud: <?php echo esc_html(get_the_date('j. F Y')); ?>
                </p>
            </header>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="back-link">
                &larr; Tagasi uudiste juurde
            </a>
        </article>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
