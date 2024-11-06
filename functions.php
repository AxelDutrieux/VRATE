<?php
//ajouter une nouvelle zone de menu à mon thème
function register_my_menu(){
register_nav_menus( array(
'header-menu' => __( 'Menu De Tete'),
'footer-menu' => __( 'Menu De Pied'),
) );
}
add_action( 'init', 'register_my_menu', 0 );
?>

<?php
// Autorise les fichiers SVG dans la médiathèque de WordPress
function autoriser_svg($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'autoriser_svg');
?>

<?php
// Fonction pour créer le formulaire d'inscription avec vérification du mot de passe
function mon_formulaire_inscription() {
    ob_start(); // Capture l'output du formulaire
    ?>
    <form method="post" action="" class="formulaire-inscription">
        
        <div class="form-group">
            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" name="prenom" id="prenom" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" name="nom" id="nom" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="username" class="form-label">Nom d'utilisateur :</label>
            <input type="text" name="username" id="username" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">E-mail :</label>
            <input type="email" name="email" id="email" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="mot_de_passe" class="form-label">Mot de passe :</label>
            <input type="password" name="mot_de_passe" id="mot_de_passe" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="confirmation_mot_de_passe" class="form-label">Confirmer le mot de passe :</label>
            <input type="password" name="confirmation_mot_de_passe" id="confirmation_mot_de_passe" class="form-input" required>
        </div>

        <div class="form-group">
            <input type="submit" name="inscription" value="Créer un compte" class="form-submit">
        </div>

        <?php if (isset($_POST['inscription'])): ?>
            <div id="form-message" class="form-message">
                <?php mon_traitement_inscription(); ?>
            </div>
        <?php endif; ?>
    </form>
    <?php

    return ob_get_clean(); // Retourne le formulaire généré
}
add_shortcode('formulaire_inscription', 'mon_formulaire_inscription');

// Fonction pour traiter les données du formulaire d'inscription avec vérification du mot de passe
function mon_traitement_inscription() {
    // Validation et nettoyage des données
    $prenom = sanitize_text_field($_POST['prenom']);
    $nom = sanitize_text_field($_POST['nom']);
    $username = sanitize_user($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];
    $confirmation_mot_de_passe = $_POST['confirmation_mot_de_passe'];

    // Vérifie si les mots de passe correspondent
    if ($mot_de_passe !== $confirmation_mot_de_passe) {
        echo '<p style="color: red;">Les mots de passe ne correspondent pas. Veuillez réessayer.</p>';
        return;
    }

    // Vérifie si l'e-mail est valide et unique
    if (!is_email($email) || email_exists($email)) {
        echo '<p style="color: red;">L\'adresse e-mail est invalide ou déjà utilisée.</p>';
        return;
    }

    // Vérifie si le nom d'utilisateur est valide et unique
    if (empty($username) || username_exists($username)) {
        echo '<p style="color: red;">Le nom d\'utilisateur est invalide ou déjà utilisé.</p>';
        return;
    }

    // Crée un nouvel utilisateur
    $user_id = wp_create_user($username, $mot_de_passe, $email);

    // Vérifie s'il y a des erreurs lors de la création de l'utilisateur
    if (is_wp_error($user_id)) {
        echo '<p style="color: red;">Une erreur est survenue lors de l\'inscription. Veuillez réessayer.</p>';
        return;
    }

    // Mise à jour du profil utilisateur avec le prénom et le nom
    wp_update_user(array(
        'ID' => $user_id,
        'first_name' => $prenom,
        'last_name' => $nom,
    ));

    echo '<p style="color: green;">Inscription réussie ! Vous pouvez maintenant vous connecter.</p>';

    // Optionnel : Envoyer un e-mail de bienvenue à l'utilisateur
    $to = $email;
    $subject = 'Bienvenue sur notre site';
    $message = 'Bonjour ' . $prenom . ",\n\nMerci de vous être inscrit sur notre site.\n\nCordialement,\nL'équipe.";
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    wp_mail($to, $subject, $message, $headers);
}
?>

<?php  
// Shortcode pour afficher un formulaire de connexion
function mon_shortcode_connexion($atts, $content = null) {
    // Si l'utilisateur est déjà connecté, afficher un message de bienvenue
    if (is_user_logged_in()) {
        return '<p>Vous êtes déjà connecté.</p>';
    }

    // Paramètres de redirection après connexion
    $redirect_url = home_url(); // Vous pouvez changer cette URL si vous souhaitez rediriger vers une autre page

    // Paramètres du formulaire de connexion
    $args = array(
        'echo'           => false,
        'redirect'       => $redirect_url,
        'form_id'        => 'loginform-custom',
        'label_username' => __('Nom d’utilisateur'),
        'label_password' => __('Mot de passe'),
        'label_remember' => __('Se souvenir de moi'),
        'label_log_in'   => __('Se connecter'),
        'remember'       => true
    );

    // Génération du formulaire de connexion
    return wp_login_form($args);
}
add_shortcode('formulaire_connexion', 'mon_shortcode_connexion');
?>

<?php
function mon_theme_support_logo() {
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 100,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'mon_theme_support_logo');
?>

<?php
function widgets_connexion() {
    register_sidebar(array(
        'name' => 'Zone de Connexion',
        'id' => 'zone_connexion',
        'before_widget' => '<div class="widget zone-connexion">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'widgets_connexion');
?>

<?php
// Crée un widget de connexion
class Login_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'login_widget',  // ID du widget
            'Formulaire de connexion',  // Nom du widget
            array('description' => 'Un widget pour afficher un formulaire de connexion')
        );
    }

    // Affichage du widget
    public function widget($args, $instance) {
        if (!is_user_logged_in()) {
            ?>
            <form action="<?php echo wp_login_url(); ?>" method="post">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" name="log" id="username" required>
                
                <label for="password">Mot de passe :</label>
                <input type="password" name="pwd" id="password" required>
                
                <input type="submit" value="Se connecter">
            </form>
            <a href="<?php echo wp_lostpassword_url(); ?>">Mot de passe oublié ?</a>
            <?php
        } else {
            echo '<p>Vous êtes déjà connecté.</p>';
        }
    }
}

// Enregistrer le widget
function register_login_widget() {
    register_widget('Login_Widget');
}
add_action('widgets_init', 'register_login_widget');
?>

<?php
add_image_size('single-equipe-size', 1280, 488, true); // Largeur : 800px, Hauteur : 400px, Recadrage : activé
?>

