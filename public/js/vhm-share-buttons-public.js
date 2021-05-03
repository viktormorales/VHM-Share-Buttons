(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	jQuery(function() {

		/* If the userAgent is iPhone or Android
		 * change the HREF link with the whatsapp
	     */
		if (navigator.userAgent.match(/iPhone|Android/i)) 
		{
			let link = jQuery("#vhm-share-buttons-whatsapp");
			link.attr("href","whatsapp://send?text=" + link.data('text'));
	   	}
	   	
	   	/*
	   	 * If the userAgent is Android, activate the Web Share API
	   	 */
	   	if (navigator.userAgent.match(/Android/i)) 
		{
			//let title_btn = jQuery("#vhm-share-buttons strong");
			let android_btn = jQuery("#vhm-share-buttons-android");
			let list_btn = jQuery(".vhm-share-buttons-title, #vhm-share-buttons-list");

			android_btn.css('display', 'block');
			list_btn.hide();
			
			android_btn.click(function(e) {
				e.preventDefault();
				navigator.share({title: jQuery(this).data('title'), url: jQuery(this).data('url')}).then(console.log('Share successful'));
			});
	   	}

	   	jQuery("#vhm-share-buttons-link").click(function(e)
	   	{
	   		e.preventDefault();

	   		let $temp = jQuery("<input>");
			jQuery("body").append($temp);
			$temp.val(jQuery(this).attr("href")).select();
			document.execCommand("copy");
			$temp.remove();

	   		alert("Copied to clipboard");
	   	});
	   	
   });

})( jQuery );
