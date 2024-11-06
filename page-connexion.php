<?php
/**
 * Template Name: Connexion personnalisée
 *
 * Ce modèle sera utilisé pour afficher le formulaire de connexion personnalisé.
 */

get_header(); // Appelle l'en-tête de votre thème
?>

<div class="login-page">
    <h2 class="login-title">Connexion</h2>

    <?php
    // Vérifie si l'utilisateur est déjà connecté
    if (is_user_logged_in()) {
        // Utilisation de home_url() pour rediriger après la déconnexion
        // Ici, wp_logout_url(home_url()) redirige l'utilisateur vers la page d'accueil après déconnexion
        $logout_url = wp_logout_url('http://localhost:8888/VRATE/');  // redirection vers la page d'accueil
        echo '<p>Vous êtes déjà connecté. <a href="' . esc_url($logout_url) . '">Cliquez ici pour vous déconnecter.</a></p>';
    } else {
        // Si l'utilisateur n'est pas connecté, afficher le formulaire de connexion
        ?>

        <form action="<?php echo wp_login_url(); ?>" method="post" class="login-form">
            <label class="login-label-username" for="username">Nom d'utilisateur :</label>
            <input class="login-input-username" type="text" name="log" id="username" required>

            <label class="login-label-password" for="password">Mot de passe :</label>
            <input class="login-input-password" type="password" name="pwd" id="password" required>

            <input class="login-input-submit" type="submit" value="Se connecter">
        </form>

        <a href="<?php echo wp_lostpassword_url(); ?>">Mot de passe oublié ?</a>

        <?php
    }
    ?>

</div>

<?php
get_footer(); // Appelle le pied de page de votre thème
?>
