<?php get_header(); ?>

<div class="archive-match-banner" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/index_background.jpg');>
    <h1 class="archive-match-title">MATCHS</h1>
</div>

<div class="archive-match">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="match-card">
                <a href="<?php the_permalink(); ?>" class="match-card-link">
                    <h2 class="match-card-title">
                        <?php the_title(); ?>
                    </h2>
                    <div class="groupe5">
                        <hr class="white-line">
                        <div class="match-infos">
                            <?php
                            $equipe1 = get_field('equipe1');
                            if ($equipe1): ?>
                                <ul>
                                    <?php foreach ($equipe1 as $post):
                                        setup_postdata($post); ?>
                                        <?php $image = get_field('logo');
                                        if (!empty($image)): ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="match-logo 1" />
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                                <?php wp_reset_postdata(); ?>
                            <?php endif; ?>

                            <p class="match-score"><?php echo esc_html(get_field('score_equipe1')); ?> - <?php echo esc_html(get_field('score_equipe2')); ?></p>

                            <?php
                            $equipe2 = get_field('equipe2');
                            if ($equipe2): ?>
                                <ul>
                                    <?php foreach ($equipe2 as $post):
                                        setup_postdata($post); ?>
                                        <?php $image = get_field('logo');
                                        if (!empty($image)): ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="match-logo 2" />
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                                <?php wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </div>
                        <hr class="white-line">
                    </div>
                    <p class="projet-card-excerpt">
                        <?php the_excerpt(); ?>
                    </p>
                </a>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <p class="no-match-message">Aucun match à afficher.</p>
    <?php endif; ?>
</div>
<?php get_footer(); ?>
