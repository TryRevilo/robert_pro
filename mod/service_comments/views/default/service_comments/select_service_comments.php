<?php

$service_comments = elgg_get_entities([
	'type' => 'object',
	'subtype' => 'service_comment',
	'owner_guid' => elgg_get_logged_in_user_guid(),
	'limit' => 2,

    // enable owner preloading
	'preload_owners' => true,
	]);

$content = elgg_view('service_comments/custom_views/listings/select_service_comments', array(
	'requests' => $service_comments,
	));

echo $content;