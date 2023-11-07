(function($) {
	
    const uploadNavImage = (el) => {
		
		// Create a new media frame
		frame = wp.media({
		
		  multiple: false  // Set to true to allow multiple files to be selected
		});
	
		// When an image is selected in the media frame...
		frame.on( 'select', function() {
		  
		  // Get media attachment details from the frame state
		  const attachment = frame.state().get('selection').first().toJSON();
		  console.log(attachment);
		  el.parent().parent().find('input').val(attachment.id);

		  let isImageExists = el.find("img");
		  if(isImageExists.length) {
			el.find("img").attr("src", attachment.sizes.full.url);
		  }
		  else {
			el.parent()
          .replaceWith(`<div class="kh-nav-icon-inner"><div class="kh-nav-image"><img src="${attachment.sizes.full.url}" /></div>
			<span class="kh-nav-close">		<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M6.46967 6.46967C6.76256 6.17678 7.23744 6.17678 7.53033 6.46967L14 12.9393L20.4697 6.46967C20.7626 6.17678 21.2374 6.17678 21.5303 6.46967C21.8232 6.76256 21.8232 7.23744 21.5303 7.53033L15.0607 14L21.5303 20.4697C21.8232 20.7626 21.8232 21.2374 21.5303 21.5303C21.2374 21.8232 20.7626 21.8232 20.4697 21.5303L14 15.0607L7.53033 21.5303C7.23744 21.8232 6.76256 21.8232 6.46967 21.5303C6.17678 21.2374 6.17678 20.7626 6.46967 20.4697L12.9393 14L6.46967 7.53033C6.17678 7.23744 6.17678 6.76256 6.46967 6.46967Z" fill="white"/>
		</svg></span></div>
		`);
		  }
	
		});
	
		// Finally, open the modal on click
		frame.open();
	  
	}

	const removeNavImage = (el) => {
		el.parent().parent().find('input').val('');
		el.parent().find('img').replaceWith('<span>+</span>');
		el.remove();
	}

	  $(document.body).on('click', '.kh-nav-image', function() {
		uploadNavImage($(this))
	  })

	  $(document.body).on('click', '.kh-nav-close', function() {
		removeNavImage($(this))
	  })
})(jQuery)