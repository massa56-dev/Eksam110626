<?php get_header(); ?>

<div class="page-banner">
    <div class="container">
        <h1>Uudised</h1>
        <p class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Avaleht</a> &rsaquo; Uudised</p>
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

            <div class="pagination">
                <?php
                echo paginate_links([
                    'prev_text' => '&larr; Eelmine',
                    'next_text' => 'Järgmine &rarr;',
                ]);
                ?>
            </div>

        <?php else : ?>
            <div class="no-content">
                <h2>Uudiseid pole veel lisatud</h2>
                <p>Tulge hiljem tagasi!</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
