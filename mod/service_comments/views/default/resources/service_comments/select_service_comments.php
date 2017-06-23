<?php

// List Reservations
$content_array = array(
	'type' => 'object',
	'subtype' => 'service_comment',
	'full_view' => false,
    'item_view' => 'service_comments/select_service_comments',
	'limit' => 12,
	);

if (!elgg_is_admin_user($owner->guid)) {
	$content_array['container_guid'] = $owner->guid;
}

$content = elgg_list_entities($content_array);

if (!$content) {
	$content = elgg_echo("rooms:my_rental_listings_non");
}
$params['content'] = $content;
$params['sidebar'] = $sidebar;

$body = elgg_view_layout('content', $params);
echo elgg_view_page($title, $body);