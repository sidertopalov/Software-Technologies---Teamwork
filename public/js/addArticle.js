$("#addArticle").submit(function(e){
	var url = "/ajax/article";

	$.ajax({
		type: "POST",
		url: url,
		data: $("#addArticle").serialize(),
		dataType: "json",
		success: function(data){
			if (data.error == false ) {
				
				$('#successMessage').hide();
				$('#errorMessage').html( data.message ).fadeTo(1,1000);
			} else {
				$('#errorMessage').hide();
				$('#successMessage').html( data.message ).fadeTo(1,1000);
				
				setTimeout(function () {
  				window.location.href = data.redirectTo; // the redirect goes here

				},1000)
			  	
				// $('#contentArticle').val("");
				// $('#titleArticle').val("");
			}
		}
	});
	
	e.preventDefault();

});
	
	function changeBackgroundColor()
	{
		var editor = tinyMCE.get(0);
		editor.getBody().style.backgroundColor = "#f3f3f3";
	}

$( document ).ready(function() {

	tinymce.init({
	    selector: '#contentArticle',
	    theme: 'modern',
	    width: 788,
	    height: 333,
	    resize: false,
	    plugins: [
	      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
	      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
	      'save table contextmenu directionality emoticons template paste textcolor'
	    ],
	    content_css: 'css/content.css',
	    setup: function (editor) {
	        editor.on('change', function () {
	            tinymce.triggerSave();
	        });
    	},
	    // setup: function (ed) {
	    //     ed.on('init', function(args) {
	    //         changeBackgroundColor();
	    //     });
	    // },
	    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
	  });
});

