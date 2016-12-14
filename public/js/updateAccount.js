$("#updateAccount").submit(function(e){
	var url = "/ajax/updateAccount";

	$.ajax({
		type: "POST",
		url: url,
		data: $("#updateAccount").serialize(),
		dataType: "json",
		success: function(data){
			if (data.error == false ) {
				
				$('#successMessage').hide();
				$('#errorMessage').html( data.message ).fadeTo(1,1000);
			} else {
				$('#errorMessage').hide();
				$('#successMessage').html( data.message ).fadeTo(1,1000);
			}
		}
	});

	e.preventDefault();
});



$("#btnEdit").click(function(e){

	$("#firstName").attr("disabled", false);
	$("#lastName").attr("disabled", false);

	$("#btnSaveChanges").show();
	$("#btnDone").show();
	
	$("#changePass").hide();
	$(this).hide();

	e.preventDefault();
});

$("#btnDone").click(function(e){

	$("#firstName").attr("disabled", true);
	$("#lastName").attr("disabled", true);

	$("#btnSaveChanges").hide();
	$("#successMessage").hide();
	$("#errorMessage").hide();

	$("#changePass").show();
	$("#btnEdit").show();
	
	$(this).hide();

	e.preventDefault();
});