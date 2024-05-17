<?php get_header(); ?>

<main>
	<?php 
		$taxo = get_the_terms('', 'categorie');
		$categorie = $taxo[0]->name;

		$taxo = get_the_terms('', 'format');
		$format = $taxo[0]->name;	
		
		$id_post = get_the_ID();
	?>

	<div class="container-info">
		<div class="info">
			<h2><?php the_title(); ?></h2>
		
			<p>Référence : <span id="ma-ref"><?php echo get_field('reference-photo');?></span></p>
			<p>Catégorie : <?php echo $categorie; ?></p>
			<p>Format : <?php echo $format; ?></p>
			<p>Type : <?php echo get_field('type-photo'); ?></p>
			<p>Année : <?php the_time('Y'); ?></p>
			<hr />
		</div>

			<div class="vignette-moyenne">
				<?php the_post_thumbnail('medium'); ?>
			</div>

	</div>

	<div class="container-info">
		<div class="interet">
			<p>Cette photo vous intéresse ?<button id="aime-photo">Contact</button></p>
		</div>

		<div class="aperçu">
			<?php 
				set_query_var( 'id_en_cours', $id_post); // On transmet la variable à notre template-part
				get_template_part( 'template-parts/avant-apres-post' ); 
			?>
			<span id="vignette-interactive"></span>
			
			<div class="navigation-aperçu">
				<div class="fleche-gauche-petite"></div>
				<div class="fleche-droite-petite"></div>
			</div>
		</div>
	</div>	

	<div class="separation">
		<hr/>
	</div>

	<div class="section-preference">
		<h3>Vous aimerez aussi</h3>
		
		<!-- on appelle le template-part photo_block -->
		<div class="container-preference">
			<?php 	
				set_query_var( 'cat', $categorie ); 
				set_query_var( 'id_banni', $id_post);
				get_template_part( 'template-parts/photo_block' ); 
			?>
		</div>
	</div>
</main>
<?php get_footer(); ?>