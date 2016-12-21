$("#categoryDelete").submit(function(e){
	var url = "/ajax/categoryDelete";

	$.ajax({
		type: "POST",
		url: url,
		data: $("#categoryDelete").serialize(),
		dataType: "json",
		success: function(data){
			if (data.error == true ) {
				
				$('#successMessage').hide();
				$('#errorMessage').html( data.message ).fadeTo(1,1000);
			} else {
				$('#errorMessage').hide();
				$('#successMessage').html( data.message ).fadeTo(1,1000);

				setTimeout(function () {
  					window.location.href = "categoryList"; // the redirect goes here

				},1000)
			}
		}
	});
	
	e.preventDefault();

});