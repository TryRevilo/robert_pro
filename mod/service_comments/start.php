<?php

elgg_register_event_handler('init', 'system', 'service_comment_init');

function service_comment_init() {

	elgg_register_page_handler('service_comment', 'service_comment_page_handler');
	elgg_register_entity_type('object', 'service_comment');

	elgg_register_action("service_comments/add_service_comment", __DIR__ . "/actions/service_comments/add_service_comment.php");

	elgg_extend_view('elgg.js', 'js/service_comments/add.js');

	elgg_register_plugin_hook_handler('register', 'menu:service_comments_options', 'service_comment_menu_setup', 400);

}

function service_comment_page_handler($segments) {}

function service_comment_menu_setup($hook, $type, $return, $params) {

	$entity = $params['entity'];
	/* @var ElggEntity $entity */
	$return[] = ElggMenuItem::factory(array(
		'href' => '#',
		'name' => 'upload_service_comment_media',
		'text' => elgg_view_icon('upload'),
		'is_action' => false,
		'is_trusted' => true,
		'class' => 'upload-media-update',
		'priority' => 1000,
		));

	$return[] = ElggMenuItem::factory(array(
		'href' => elgg_add_action_tokens_to_url("/action/service_comments/add_service_comment"),
		'name' => 'post_service_comment',
		'text' => elgg_view_icon('quote-left') . ' Submit ' . elgg_view_icon('quote-right'),
		'title' => elgg_echo('Submit Service Comment'),
		'class' => 'post-media-update',
		'priority' => 1002,
		'is_action' => true,
		'is_trusted' => true,
		));

	$return[] = ElggMenuItem::factory(array(
		'href' => '#',
		'name' => 'service_comment_char_count',
		'text' => '',
		'title' => 'Characters remaining',
		'class' => 'textarea-char-count',
		'priority' => 1001,
		));

	$return[] = ElggMenuItem::factory(array(
		'href' => '#',
		'name' => 'toggle-images-view',
		'text' => '',
		'title' => 'Toggle images view',
		'class' => 'toggle-images-view',
		'priority' => 1003,
		));

	$confirm = elgg_view('output/url', $params_confirm);

	return $return;
}