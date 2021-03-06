(function( $ ) {
	'use strict';

})( jQuery );

jQuery(document).ready(function($)
{
  $('body').on('click', '.dpc_upload_image_button', function(e)
  {
		e.preventDefault();

		var button = $(this),custom_uploader = wp.media(
		{
      title: 'Insert image',
      library :
      {
          type : 'image'
      },
      button:
      {
          text: 'Use this image'
      },
      multiple: false
    }).on('select', function()
    {
      var attachment = custom_uploader.state().get('selection').first().toJSON();

      $(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:35%;display:block;" />').next().val(attachment.id).next().show();
    }).open();
	});

  $('body').on('click', '.dpc_remove_image_button', function()
  {
    $(this).hide().prev().val('').prev().addClass('button').html('Upload image');
    return false;
  });	
});