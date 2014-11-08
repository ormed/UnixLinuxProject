$(document).ready(function() {
	$('#admin-form').submit(function(event) {
		document.getElementById('respond').innerHTML = '';
		var url = 'processes/perl_commands_exec.php';
		var $data = $('#admin-form').serialize();
		$.ajax({//Process the form using $.ajax()
			type : 'POST',
			url : url,//proccess - server
			data : $data,
			dataType : 'json',
			success : function(data) {
				document.getElementById('respond').innerHTML = data;
			}
		});
		event.preventDefault();//prevent the default submit
	});
});