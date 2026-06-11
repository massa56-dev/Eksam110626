<?php
/* Fallback template — should not normally be reached.
   front-page.php handles the front page, archive.php handles post lists. */
get_header(); ?>

<div class="page-banner">
    <div class="container">
        <h1><?php wp_title('', true); ?></h1>
    </div>
</div>

<div class="content-area">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="posts-list">
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('post-card'); ?>>
                        <p class="post-meta"><?php echo esc_html(get_the_date('j. F Y')); ?></p>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p class="post-excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
                        <a href="<?php the_permalink(); ?>" class="read-more">Loe edasi &rarr;</a>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div class="no-content">
                <h2>Sisu pole veel lisatud</h2>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
