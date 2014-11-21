$(document).ready(function() {
	$('.form-horizontal').submit(function(event) {
		document.getElementById('command-respond').innerHTML = '';
		var url = 'processes/shell_commands_exec.php';
		var $data = $('.form-horizontal').serialize();
		$.ajax({//Process the form using $.ajax()
			type : 'POST',
			url : url,//proccess - server
			data : $data,
			dataType : 'json',
			success : function(data) {
				document.getElementById('command-respond').innerHTML = data;
			}
		});
		event.preventDefault();//prevent the default submit
	});
});