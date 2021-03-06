
$("#changePass").submit(function(e){
	var url = "/ajax/changePass";

	$.ajax({
		type: "POST",
		url: url,
		data: $("#changePass").serialize(),
		dataType: "json",
		success: function(data){
			if (data.error == true ) {
				
				$('#successMessage').hide();
				$('#errorMessage').html( data.message ).fadeTo(1,1000);
			} else {
				$('#errorMessage').hide();
				$('#successMessage').html( data.message ).fadeTo(1,1000);
				
				setTimeout(function () {
  					window.location.href = data.redirectTo; // the redirect goes here

				},1000)
			}
		}
	});

	e.preventDefault();
});


//	passwordStrength.js
$("#newPass").passwordStrength({
    targetDiv:'passwordStrength',
    text:{
        year:'year|years',
    },
    minimumChars: 4,
});
