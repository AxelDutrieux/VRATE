<?php
get_header();
?>
<div class="index">
<div class="index-home">
    <div class="index-home-multiply">
    <style>
        .index-home {
            background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/index_background.jpg');
        }
    </style>
     </div> 
    <h1 class="index-title">Rejoignez la communauté !</h1>
    <button class="index-button index-button-text">Inscription</button>
   
</div>

<div class="index-intro">
            <p class="index-intro-title">Rejoins le tournoi !</p>
            <p class="index-intro-h2">Crée ton compte</p>
            <p class="index-intro-body">
            Clique sur le bouton "Inscription" et entre les informations demandées : nom, prénom, pseudo et adresse e-mail. En quelques instants, tu auras ton compte prêt pour l'aventure !
            </p>
            <p class="index-intro-h2">Forme ton équipe</p>
            <p class="index-intro-body">
            Une fois inscrit, crée une page dédiée à ton équipe. Ajoute-y les détails essentiels : effectif, nom de l’équipe, logo, et bannière pour afficher fièrement vos couleurs.
            </p>
            <p class="index-intro-h2">Validation par l'Organisateur</p>
            <p class="index-intro-body">
            Une fois les informations complètes, il te suffit d’attendre la validation de l’organisateur. Dès que c’est approuvé, ton équipe est prête pour la compétition !
            </p>
        </div>
</div>
<?php
get_footer();
?>