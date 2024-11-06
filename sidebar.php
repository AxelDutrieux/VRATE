<?php if (is_active_sidebar('zone_connexion')) : ?>
    <aside id="sidebar" class="widget-area zone-connexion-widget">
        <?php dynamic_sidebar('zone_connexion'); ?>
    </aside>
<?php else : ?>
    <p>Ajoutez des widgets à la zone de connexion depuis le menu Apparence > Widgets.</p>
<?php endif; ?>

<?php
if (!is_user_logged_in()) {
    ?>
    <a href="<?php echo get_permalink(get_page_by_title('Connexion')); ?>" class="login-link">Se connecter</a>
    <?php
} else {
    echo '<a href="' . wp_logout_url() . '" class="logout-link">Déconnexion</a>';
}
?>
