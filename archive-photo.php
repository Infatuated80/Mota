<?php get_header(); ?>
<div class="contenaire-principal">

<main id="affichage-requete" class="affichage-requete">
<h1> <?php post_type_archive_title(); ?></h1>
<p>Mode archive</p>
<?php
/* Lecture des Posts */
while ( have_posts() ) :
	the_post();
	get_template_part( './template-parts/', 'photo-single' );
endwhile
?>
</div>
</main>

<?php get_footer(); ?>
