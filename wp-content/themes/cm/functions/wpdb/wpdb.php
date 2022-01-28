<?php 
global $wpdb;
$tag = "test-taxonomy-1";
$query = $wpdb->prepare("SELECT * FROM {$wpdb->terms} WHERE slug=%s", [$tag]);
$results = $wpdb->get_results($query, ARRAY_A);

?>