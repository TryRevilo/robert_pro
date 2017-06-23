require(['elgg/Ajax'], Ajax => {

	var ajax = new Ajax();

	$('.post-media-update').click(function(event) {
		event.preventDefault();
		var $elem = $(this);
		var guid = $elem.data('guid');

		ajax.action('service_comments/add_service_comment', {
         //data: $elem.data(),
         data: {
         	arg1: 1,
         	arg2: 2
         },
     }).then(body => {
     	if (jqXHR.AjaxData.status == -1) {
     		return;
     	}
     	alert(output.sum);
     	alert(output.product);
     })
     	return;
 });
});