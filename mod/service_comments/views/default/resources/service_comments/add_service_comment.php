<?php
// make sure only logged in users can see this page
gatekeeper();

echo elgg_view_form('service_comments/add_service_comment');