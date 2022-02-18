<?php get_header(); ?>

<form class="row g-3 align-items-center">
  <div class="col-auto">
    <label class="sr-only col-form-label" for="tm_search">Rechercher :</label>
  </div>
  <div class="col-auto">
    <input type="search" name="s" id="tm_search" class="form-control mb-2 mr-sm-2" value="<?= get_search_query() ?>" placeholder="Votre recherche">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-2">Chercher</button>
  </div>
</form>


<h3 class="mb-4">Résultat de votre recherche : "<?= get_search_query() ?>"</h3>
<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('parts/card', 'post') ?>
  <?php endwhile; ?>
  <?php tm_pagination() ?>
<?php else : ?>
  <h3>Aucun article trouvé</h3>
<?php endif; ?>
<?php get_footer(); ?>