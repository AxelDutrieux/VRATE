<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <div class="header-wrapper">
        <header class="site-header">
        <?php
// Vérifiez si un logo a été ajouté via le personnalisateur
if (function_exists('the_custom_logo') && has_custom_logo()) : ?>
    <div class="logo-container">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link">
            <?php the_custom_logo(); ?>
        </a>
    </div>
<?php else : ?>
    <!-- Alternative: Si aucun logo n'est défini, affichez le titre du site -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title-link">
        <?php bloginfo('name'); ?>
    </a>
<?php endif; ?>

            <nav class="header-nav">
                <?php 
                // Affiche le menu de navigation
                wp_nav_menu(array(
                    'theme_location' => 'header-menu',
                    'container' => false,
                    'menu_class' => 'header-menu'
                )); 
                ?>
            </nav>
            <?php get_sidebar(); ?>
            

        </header>
    </div>
