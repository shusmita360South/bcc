<?php
/**
 * Displays the post header
 *
 * @package WordPress
 * @subpackage Comfort_Sleep
 * @since 1.0.0
 */

$queried_object = get_queried_object();
$taxonomy = "";
$taxonomies = "";
if(isset($queried_object->taxonomy)) {
	$taxonomy = $queried_object->taxonomy;
	$queried_object->ID = $queried_object->taxonomy == 'category' ? get_option('page_for_posts') : $queried_object->ID;
}
if(isset($queried_object->taxonomies)) {
	$taxonomies = $queried_object->taxonomies;
	$taxonomies = $taxonomies[0];
}
$term_id = "";
if (is_archive()) {
	$slug = $queried_object->name;
	$cat = get_category_by_slug($slug); 

	if (isset($cat->term_id)) {
		$term_id = $cat->term_id;
	}
	
}
$eventHeaderImage = get_option('event_header_image');

?>

<section class="page-banner">	
	<div class="page-banner-image">				
	
		<?php if (has_post_thumbnail() && !is_archive()) : ?>
			<?php the_post_thumbnail( '1920x420' ); ?>	
		<?php elseif (is_category()||is_archive()):?>
			
			<?php $taxonomy_image_url = z_taxonomy_image_url($term_id);?>
				<figure>
					<img src="<?php echo $taxonomy_image_url;?>" alt="<?php the_title() ?>">
				</figure>
			<?php if(z_taxonomy_image_url($term_id) == "") :?>
				<figure>
					<img src="/img/banner_default_1920x350.png" alt="<?php the_title() ?>">
				</figure>
			<?php endif; ?>
		<?php else:?>
			<figure>
				<img src="/img/banner_default_1920x350.png" alt="<?php the_title() ?>">
			</figure>	
		<?php endif; ?>
	</div>
	<div class="page-banner-content">	
		<?php if (is_author()) : ?>
			<h1 class="line"><?php the_author() ?></h1>
		<?php elseif ($taxonomy == 'category') : ?>
			<h1 class="line"><?php echo $queried_object->name ?></h1>
		<?php elseif ($taxonomies == 'category') : ?>
			<h1 class="line"><?php echo $queried_object->label ?></h1>
		<?php else : ?>
			<h1 class="line"><?php the_title() ?></h1>
		<?php endif; ?>

	</div>
	

</section>