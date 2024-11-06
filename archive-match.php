<?php get_header(); ?>

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
                            // Récupérer la taxonomie 'etat' pour déterminer l'affichage
                            $etat_terms = get_the_terms(get_the_ID(), 'etat_match');
                            $is_joue = false;
                            if ($etat_terms) {
                                foreach ($etat_terms as $term) {
                                    if ($term->slug == 'joue') {
                                        $is_joue = true;
                                        break;
                                    }
                                }
                            }
                            
                            // Afficher les logos des équipes
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

                            <?php if ($is_joue): ?>
                                <!-- Afficher le score si 'etat' est 'joue' -->
                                <p class="match-score"><?php echo esc_html(get_field('score_equipe1')); ?> - <?php echo esc_html(get_field('score_equipe2')); ?></p>
                            <?php else: ?>
                                <!-- Afficher la date si 'etat' est 'prevu' -->
                                <p class="match-date">Date : <?php echo esc_html(get_field('date_du_match')); ?></p>
                            <?php endif; ?>

                            <?php
                            // Afficher le logo de la deuxième équipe
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
