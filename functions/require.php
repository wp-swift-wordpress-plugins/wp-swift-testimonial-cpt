<?php
$show_testimonials=true;
if($show_testimonials) {
	require_once '_cpt-testimonial.php'; 
	require_once '_acf-field-group_testimonial-additonal-fields.php';
	require_once '_testimonial-title-placeholder.php';
	require_once '_posts-screen-columns-testimonial.php';
	require_once '_add-custom-admin-css.php';
}