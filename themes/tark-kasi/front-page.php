<?php get_header(); ?>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <h1>Tark Käsi OÜ</h1>
        <p class="lead">Käsitöölleib ja -saiakesed, küpsetatud traditsiooniliste retseptide järgi värskelt iga päev.</p>
        <a href="<?php echo esc_url(get_post_type_archive_link('toode')); ?>" class="btn">Meie tooted</a>
        <a href="<?php echo esc_url(get_permalink(get_page_by_path('kontakt'))); ?>" class="btn btn-outline">Võta ühendust</a>
    </div>
</section>

<!-- ABOUT / FEATURES -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Miks Tark Käsi?</h2>
        <p class="section-subtitle">Kolm põhjust, miks meie leib eristub</p>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🌾</div>
                <h3>Kohalik tooraine</h3>
                <p>Kasutame Eesti talunike kasvatatud teravilja ja looduslikke koostisosi.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⏱️</div>
                <h3>Aeglane käärimine</h3>
                <p>Meie hapuleib käärub üle 24 tunni – see annab sügavama maitse ja parema seeditavuse.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🤲</div>
                <h3>Käsitöö</h3>
                <p>Iga päts kujundatakse ja küpsetatakse käsitsi väikestes partiides.</p>
            </div>
        </div>
    </div>
</section>

<!-- LATEST NEWS -->
<section class="section section-alt">
    <div class="container">
        <h2 class="section-title">Viimased uudised</h2>
        <p class="section-subtitle">Mis meil toimub</p>

        <?php
        $news = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
        ]);
        ?>

        <?php if ($news->have_posts()) : ?>
            <div class="news-grid">
                <?php while ($news->have_posts()) : $news->the_post(); ?>
                    <article class="news-card">
                        <div class="news-card-body">
                            <p class="news-card-date"><?php echo esc_html(get_the_date('j. F Y')); ?></p>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p class="excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
                            <a href="<?php the_permalink(); ?>" class="read-more">Loe edasi &rarr;</a>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <div class="view-all-wrap">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn">Kõik uudised</a>
            </div>
        <?php else : ?>
            <p class="no-content">Uudiseid pole veel lisatud.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
