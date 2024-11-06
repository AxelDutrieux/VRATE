<?php get_header(); ?>
<div class="single-match-total">
    <div class="single-match-page">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h1 class="single-match-title"><?php the_title(); ?></h1>
                <div class="single-match-content">
                    <?php the_content(); ?>
                </div>
            <?php endwhile;
        else : ?>
            <p>Aucun projet à afficher.</p>
        <?php endif; ?>
        <div class="frame12">
            <h2 class="single-match-header2">SCORE</h2>
            <div class="single-match-score">
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
        </div>

        <div class="single-page-mvp">
            <h2 class="single-page-mvp-title">TOP PLAYER </h2>
            <div class="single-page-mvp-infos">
            <?php
            $user = get_field("mvp");
            if ($user): ?>
                <div class=" author-box">
                <img src="<?php echo esc_attr($user['user_avatar']); ?>" alt="author-avatar" />
                <h3><?php echo $user['display_name']; ?></h3>
                <?php if ($user['user_description']): ?>
                    <p><?php echo $user['user_description']; ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
            </div>
            
        </div>
    </div>
</div>




<?php get_footer(); ?>