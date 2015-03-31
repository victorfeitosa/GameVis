<?php
/*

Template Name: Gallery Grid With Info

*/
get_header();
$bw_filter = get_option(wp_get_theme()->name . '_gallery_bw_filter');
?>
<div id="main-wrapper">
  <div class="home masonry" id="masonry">
    <div class="row">
		<article class="gallery-masonry isotope <?php if('yes' == $bw_filter[0]) { echo 'remove-bw-filter';} ?>">
		<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 0;

			if (get_query_var('paged')) {
    			$paged = get_query_var('paged');
			} elseif (get_query_var('page')) {
    			$paged = get_query_var('page');
			} else {
    			$paged = 1;
			}

			$categories_selected = get_post_meta($post->ID, 'tk_gallery_categories', true);
			$posts_per_page = get_option(wp_get_theme()->name . '_gallery_number_of_gallery_posts');
			if($posts_per_page == '') { $posts_per_page = 14; }

			$temp = $wp_query;
			$wp_query = null;
			
			if(!empty($categories_selected)){
				$args = array(
					'posts_per_page' => $posts_per_page, 
					'post_type' => 'gallery', 
					'post_status' => 'publish', 
					'paged' => $paged,
					'tax_query' => array( //(array) - use taxonomy parameters (available with Version 3.1).
						array(
							'taxonomy' => 'ct_gallery', //(string) - Taxonomy.
							'field' => 'id', //(string) - Select taxonomy term by ('id' or 'slug')
							'terms' => $categories_selected, //(int/string/array) - Taxonomy term(s).
							'include_children' => true, //(bool) - Whether or not to include children for hierarchical taxonomies. Defaults to true.
							'operator' => 'IN' //(string) - Operator to test. Possible values are 'IN', 'NOT IN', 'AND'.
						),
					)
				);
			}
			else{
				$args = array(
					'posts_per_page' => $posts_per_page, 
					'post_type' => 'gallery', 
					'post_status' => 'publish', 
					'paged' => $paged,
				);
			}


			$wp_query = new WP_Query($args);
			if($wp_query->have_posts()):
				while($wp_query->have_posts()) : $wp_query->the_post();
					get_template_part('/templates/parts/format-gallery', 'info');
				endwhile;
			endif; ?>
		</article>
    </div> <!-- /.row -->

    <!-- Pagination -->
	<div class="pagination">
		<?php previous_posts_link('&laquo; Newer') ?>
		<?php next_posts_link('Older &raquo;') ?>
	</div> <!-- /.pagination -->
	<?php $wp_query = null; $wp_query = $temp;  //Reset query ?>

	<!-- GALLERY CATEGORY FILTER -->
	<?php
		$args = array('include' => $categories_selected, 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => true);
		$categories = get_terms('ct_gallery', $args);
	?>
    <nav class="filter-wrapper">
      <ul class="nav-categories roboto" id="filters">
		<?php foreach ($categories as $category) {
			echo '<li class="category '.$category->slug.'-nav"><a href="#" data-filter=".'.$category->slug.'">'.$category->name.'</a></li>';
		} ?>
        <li class="category all"><a href="#" data-filter="*" class="selected"><?php _e('All', 'tkingdom') ?></a></li>
      </ul>
      <a href="#" class="filter-trigger roboto-bold"><?php _e('FILTER', 'tkingdom'); ?><i class="icon-drop-d"></i></a>
    </nav>
  </div>  <!-- /.home .masonry -->
</div>  <!-- /#main-wrapper -->

<input type="hidden" id="theme_url" data-theme_url="<?php echo get_template_directory_uri(); ?>" />

<!-- Add infinite scroll JS -->
<?php tk_infinite_scroll(); ?>

<?php
  get_footer();
?>