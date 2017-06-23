<style type="text/css">

	.service-comments {
		margin-top: 0;
		margin-left: -11px;
		padding-top: 11px;
		width: 679px;
		background-color: #FFF;
		display: block;
		position: fixed;
		z-index: 550;
	}

	.textarea-char-count {
		font-size: 90%;
		color: #666;
		padding: 4px 10px;
		margin-left: 12px;
		margin-right: 12px;
		border: 1px solid #dff0d8;
		border-top: none;
	}

	.post-media-update {
		font: 11px;
		padding: 4px 10px;
		margin-left: 7px;
		margin-right: 12px;
		border: 1px solid #dff0d8;
		border-top: none;
	}

	.update-options {
		padding-bottom: 0;
		margin-top: 0;
		background-color: #FFF;
	}

	#textarea {
		font-size: 125% !important;
		padding-left: 25px; 
		border-top: none !important;
		margin-right: -5px !important;
		border-right: none !important;
		border-left: none !important;
	}

	#textarea:focus {
		background-color: #FFF !important;
	}

	.upload-media-update {
		padding: 4px 10px;
		margin-left: 12px;
		margin-right: 0;
		border: 1px solid #dff0d8;
		border-top: none;
	}

	/** Customs **/

	.more-details {
		padding: 10px;
		padding-left: 0;
	}


	/** Picture upload preview **/

	.preview-area {
		max-width: 100%;
	}

	.file-drop-zone .file-preview-frame .image-preview {
		position: relative;
		display: table;
		margin: 8px;
		max-width: 100px !important;
		border: 1px solid #ddd;
		box-shadow: 1px 1px 5px 0 #a2958a;
		padding: 6px;
	}

	.file-drop-zone .file-preview-frame {
		text-align: center;
		vertical-align: middle;
		position: relative;
		display: table;
		margin: 8px;
		margin-bottom: 12px !important;
		border: 1px solid #ddd;
		box-shadow: 1px 1px 5px 0 #a2958a;
		padding: 6px;
		float: left;
		overflow: hidden;
		max-width: 200px !important;
	}

	.file-footer-caption {
		max-width: 160px !important;
		word-wrap: break-word; 
	}

	.file-drop-zone {
		border-radius: 0;
		text-align: center;
		vertical-align: middle;
		margin: 0 !important;
		margin-right: 0 !important;
		padding: 0;
		padding-left: 12px;
	}

	.file-preview-frame:not(.file-preview-error):hover {
		box-shadow: 3px 3px 5px 0 #333;
	}

	.modal-content {
		border: none !important;
		margin: 0 !important;
		padding: 0 !important;
		border-radius: 0 !important;
		display: block;
		overflow: auto;
		box-shadow: none;
	}

	.pics-wrapper {
		margin-top: 0;
		background-color: #FFF;
		display: flex;
		flex-direction: column;
		z-index: 655;
	}

	.select-service-comments {
		padding-bottom: 12px;
		padding-left: 12px;
		margin-top: 125px;
		margin-left: -11px;
		width: 679px;
		background-color: #FFF;
		z-index: 550;
		border-bottom: 1px solid #dff0d8;
	}

	.btn-group-xs>.btn, .btn-xs {
		padding: 5px;
		font-size: 100% !important;
		line-height: 1.5;
		margin: 0 auto !important;
		border-radius: 3px;
	}

	.images-hide-toggle {
		font-style: italic;
	}

	.warning-images {
		color: #FF7355;
		padding-left: 12px;
		padding-bottom: 8px;
	}

</style>

<?php



/*

$params_save_service_description = array(
	'href' => '#',
	'text' => elgg_view_icon('quote-left') . ' Submit ' . elgg_view_icon('quote-right'),
	'onclick' => "myajax_function()",
	'class' => 'post-media-update',
	);

$save_service_description = elgg_view('output/url', $params_save_service_description);

*/
$service_comments_options = elgg_view_menu('service_comments_options', array(
	'entity' => elgg_get_page_owner_entity(),
	'class' => 'elgg-menu-hz',
	'sort_by' => 'priority',
	));

	?>

	<div class="service-comments">
		<textarea name="comment" id="textarea" class="fa fa-search status form-control animated tatus form-control custom-control" placeholder='&#xf044; Post a service comment' maxlength="255" style="resize:none"></textarea>

		<div class="update-options">

			<?= $service_comments_options ?>

			<?= elgg_view("input/multi_file_hidden", array("name" => "images[]")); ?>

			<?= $save_service_description; ?>
		</div>

		<div class="pics-wrapper">
			<div class="modal-content">
				<div class="warning-images"></div>
				<div class="file-drop-zone"></div>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="select-service-comments"><?= elgg_view('service_comments/select_service_comments'); ?></div>

	<script>
		$(function(){
			$('.normal').autosize();
			$('.animated').autosize({append: "\n"});
		});

		$(function(){
			var text_max = 255;
			$('.textarea-char-count').html(text_max + ' characters remaining');

			$('.status').keyup(function() {
				var text_length = $('#textarea').val().length;
				var text_remaining = text_max - text_length;

				$('.textarea-char-count').html(text_remaining + ' characters remaining');
			});
		});

		$(document).ready(function(){
			$(".upload-media-update").click(function(){
				$('input[type="file"]').trigger("click");
			});
		});
	</script>

	<script type="text/javascript">

		var imagesCount = 0;
		var fileNames = [];
		var totalFileSize = 0;

		var inputLocalFont = document.getElementById("hidden-multi");
		inputLocalFont.addEventListener("change", previewImages, false);

		function previewImages(){
			var fileList = this.files;
			var objectUrl;

			var anyWindow = window.URL || window.webkitURL;

			for(var i = 0; i < fileList.length; i++) {

				var name = inputLocalFont.files.item(i).name;
				$('.warning-images').html('');

				if(jQuery.inArray(name, fileNames) !== -1) {
					$('.warning-images').append('You have already selected ' + name);
				}
				else if(imagesCount >= 5) {
					$('.warning-images').html('You cannot add more than ' + (imagesCount) + ' images');
					return;
				}
				else if(fileList.length > 5) {
					$('.warning-images').append('You cannot select more than ' + (5) + ' images');
					return;
				}
				else if((jQuery.inArray(name, fileNames) == -1) && (imagesCount < 5)){
					imagesCount++;

					objectUrl = anyWindow.createObjectURL(fileList[i]);
					fileNames.push(name);
					var imageSize = bytesToSize(fileList[i].size);
					totalFileSize += (fileList[i].size);

					var img = '<img class="image-preview" src="' + objectUrl + '" />';

					var html = `
					<div class="file-preview-frame">
						${img}
						<div class="file-thumbnail-footer">
							<div class="file-footer-caption" title="${name}">
								<span class="file-name">${name}</span>
								<br>
								<samp>(${imageSize})</samp>
							</div>
							<div class="file-thumb-progress hide"><div class="progress">
								<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
									0%
								</div>
							</div></div> <div class="file-actions">
							<div class="file-footer-buttons">
								<button type="button" class="kv-file-remove remove${i} btn btn-xs btn-default" title="Remove file">
									<i class="glyphicon glyphicon-trash text-danger"></i>
								</button>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				`;
				$('.file-drop-zone').append(html);
				window.URL.revokeObjectURL(fileList[i]);

				var myDiv = $('.file-name');
				myDiv.text(myDiv.text().substring(0, 12) + '...')

			}
		}

		if (fileList.length > 0) {
			$('.toggle-images-view').html('<span>' + imagesCount + ' (' + bytesToSize(totalFileSize) + ') images selected <a href="#">Toggle</a></span>');
		}

		$( ".toggle-images-view" ).click(function() {
			$( ".pics-wrapper" ).slideToggle( "slow" );
			$('.warning-images').html('');
		});

		return;
	}

	function bytesToSize(bytes) {
		var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
		if (bytes == 0) return '0 Byte';
		var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
		return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
	};

</script>