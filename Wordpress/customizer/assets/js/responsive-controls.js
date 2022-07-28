jQuery(document).ready(function ($) {

	// Let's use the API.
	var api = wp.customize;

	syncPreviewButtons();

	/**
	 * Sync device preview button from WordPress to TheThemeName and vice versa.
	 */
	function syncPreviewButtons() {
		// Bind device changes from WordPress default.
		api.previewedDevice.bind(function (newDevice) {
			ResponsivePreview(newDevice);
		});
	}

	/**
	 * Setup TheThemeName device preview.
	 *
	 * @param string device The device (mobile, tablet, or desktop).
	 * @param bool modifyOverlay Whether or not to modify the wp-full-overlay.
	 */
	function ResponsivePreview(device) {
		$('.responsive-options button').removeClass('active');
		$('.responsive-options .preview-' + device).addClass('active');
		$('.control-device').removeClass('active');
		$('.control-' + device).addClass('active');
	}

	// Display desktop control by default.
	$('.control-desktop').addClass('active');

	// Loop through TheThemeName device buttons and assign the event.
	$('.responsive-options button').on('click', function (e) {
		var device = this.getAttribute('data-device');

		ResponsivePreview(device);
		// Trigger WordPress device event.
		api.previewedDevice.set(device);
	});

});
