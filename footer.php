<!-- on appelle le template-part contact.php -->
<?php get_template_part( 'template-parts/contact' ); ?>

<!-- on appelle le template-part de la lightbox -->
<?php get_template_part( 'template-parts/lightbox' ); ?>

<?php wp_footer(); ?>
<footer>
    <!-- on appelle le menu localisé dans footer -->
    <?php wp_nav_menu(['theme_location' => 'footer']); ?>   
</footer>
</body>
</html>