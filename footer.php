
<!-- on appelle le template-part contact.php -->
<?php get_template_part( 'template-parts/contact' ); ?>

<?php wp_footer(); ?>
<footer>
    <!-- on appelle le menu localisé dans footer -->
    <?php wp_nav_menu(['theme_location' => 'footer']) ?>   
</footer>
</body>
</html>