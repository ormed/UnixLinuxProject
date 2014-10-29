$(document).ready(function() {
	$('.form-horizontal').submit(function(event) {
		document.getElementById('command-respond').innerHTML = '';
		var url = 'processes/shell_commands.php';
		var $data = $('.form-horizontal').serialize();
		$.ajax({//Process the form using $.ajax()
			type : 'POST',
			url : url,//proccess - server
			data : $data,
			dataType : 'text',
			success : function(data) {
				console.log('hi');
				document.getElementById('command-respond').innerHTML = data;
			}
		});
		event.preventDefault();//prevent the default submit
	});
});