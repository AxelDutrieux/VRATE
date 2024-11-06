<?php get_header(); ?>

<div class="archive-equipe-container">
    <div class="archive-equipe-page">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="archive-equipe-link"> <!-- Lien enveloppant -->
                    <div class="archive-equipe-banniere" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>'); background-size: cover; background-position: center;">
                        <div class="archive-equipe-content">
                            <?php
                            $image = get_field('logo');
                            if (!empty($image)): ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="archive-equipe-logo" />
                            <?php endif; ?>
                            <h2 class="equipe-card-title"><?php the_title(); ?></h2>
                        </div>
                    </div>
                </a>
                <p class="equipe-card-excerpt">
                    <?php the_excerpt(); ?>
                </p>
            <?php endwhile; ?>
        <?php else : ?>
            <p class="no-equipe-message">Aucune equipe à afficher.</p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
