<style type="text/css">
	
	.reservation-requests-wrapper {
		max-width: 620px;
	}

	.margin-left-requests {
		margin-left: 10px;
	}

	.names-pull-left {
		margin-left: -5px;
	}

	.no-check-reserves {
		font-size: 90%;
		margin-top: 4px;
		margin-left: 35px;
	}

	.service-comment-entry {
		padding-left: 4px;
		margin-top: 3px;
	}

	.comment-entry {
		float: left;
	}

	.comment-entry {
		margin-bottom: 2px;
	}

	.q_open {
		width: 22px;
	}

	.q_close {
		width: 542px;
	}

</style>

<?php

if (!empty($vars['requests']) && is_array($vars['requests'])) {
	foreach ($vars['requests'] as $service_comment) {
		$poster = $service_comment -> getOwnerEntity();
		$user_icon = elgg_view_entity_icon($poster, 'small', array('use_hover' => 'true'));
		$service_comment_entry = $service_comment -> title;

		$q_open = elgg_view_icon('quote-left');
		$q_close = elgg_view_icon('quote-right');
		$make_public = elgg_view_icon('arrows') . '&nbsp;' . 'Make comment public';

		echo <<<HTML
		<div class="reservation-requests-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-1">$user_icon</div>
					<div class="col-md-11">
						<div class="service-comment-entry">
							<div class="comment-entry">
								<div class="comment-entry q_open">$q_open</div>
								<div class="comment-entry q_close">$service_comment_entry $q_close</div>
							</div>
							<div class="clearfix"> </div>
							<a href="#">$make_public</a>
							<br />
						</div>
					</div>
				</div>
			</div>
		</div>
HTML;
	}
} else {
	echo '<p class="no-check-reserves">' . elgg_echo('There are no reservation requests to display currently') . '</p>';
}