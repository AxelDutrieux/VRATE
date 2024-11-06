<?php
/*
Template Name: Page Profil
*/

get_header();
?>

<div class="profil-page">
    <h1>Profil de l'utilisateur</h1>

    <?php
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $user_info = get_userdata($user_id);

        if ($user_info) {
            echo '<p><strong>Nom d\'utilisateur :</strong> ' . esc_html($user_info->user_login) . '</p>';
            echo '<p><strong>Email :</strong> ' . esc_html($user_info->user_email) . '</p>';
            echo '<p><strong>Prénom :</strong> ' . esc_html($user_info->first_name) . '</p>';
            echo '<p><strong>Nom :</strong> ' . esc_html($user_info->last_name) . '</p>';
            echo '<a href="' . esc_url(admin_url('profile.php')) . '">Modifier le profil</a>';
        } else {
            echo '<p>Erreur : utilisateur non trouvé.</p>';
        }
    } else {
        echo '<p>Vous devez être connecté pour voir cette page.</p>';
        echo '<a href="' . esc_url(wp_login_url()) . '">Connexion</a>';
    }
    ?>
</div>

<?php
get_footer();
?>
