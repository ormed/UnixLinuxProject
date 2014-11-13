$(document).ready(function() {
	$('#admin-form').submit(function(event) {
		document.getElementById('respond').innerHTML = '';
		var url = 'processes/admin_commands_exec.php';
		var $data = $('#admin-form').serialize();
		$.ajax({//Process the form using $.ajax()
			type : 'POST',
			url : url,//proccess - server
			data : $data,
			dataType : 'json',
			success : function(data) {
				alert('success');
				//document.getElementById('respond').innerHTML = getResultFromJson(data);
			}
		});
		event.preventDefault();//prevent the default submit
	});
});

function getResultFromJson(data) {
	var $page = $('#page').val();
	var result;
	
	switch ($page) {
	case 'remove_user':
		result = '<pre>' + data + '</pre>';
		break;
		
	default:
		break;
	}
	
	return result;
}