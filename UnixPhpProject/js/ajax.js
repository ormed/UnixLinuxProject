$(document).ready(function() {
	$('.form-horizontal').submit(function(event) {
		document.getElementById('ls_respond').innerHTML = '';
		var url = 'processes/ls_commands.php';
		var $data = $('.form-horizontal').serialize();
		$.ajax({//Process the form using $.ajax()
			type : 'POST',
			url : url,//proccess - server
			data : $data,
			dataType : 'json',
			success : function(data) {
				$.each( data, function(key, value) {
					console.log(value);
					document.getElementById('ls_respond').innerHTML = document.getElementById('ls_respond').innerHTML + value + '&nbsp;&nbsp;&nbsp;&nbsp;';
				});
				
				
			}
		});
		event.preventDefault();//prevent the default submit
	});
});