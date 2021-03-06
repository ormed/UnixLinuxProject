$(document).ready(function() {
	$('#admin-form').submit(function(event) {
		var url = '/UnixLinuxProject/UnixPhpProject/processes/admin_commands_exec.php';
		var $data = $('#admin-form').serialize();
		$.ajax({//Process the form using $.ajax()
			type : 'POST',
			url : url,//proccess - server
			data : $data,
			dataType : 'json',
			success : function(data) {
				if (data.error) {
					$('#error span').text(data.error);
					$('#error').removeClass('hide').addClass('show');
				} else {
					alert(data.success);
					location.reload();
				}
			}
		});
		event.preventDefault();//prevent the default submit
	});
});
