<?php
/*
Template Name: Page Inscription
*/
get_header();
?>

<div class="page-inscription">
    <h1 class="inscription-title">INSCRIPTION</h1>
    
    <div class="inscription-form">
        <?php echo do_shortcode('[formulaire_inscription]'); ?>
    </div>
</div>

<?php get_footer(); ?>
