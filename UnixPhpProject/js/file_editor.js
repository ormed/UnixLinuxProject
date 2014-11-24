$(document).ready(function() {
	$('#save-edit').submit(function(event) {
		event.preventDefault();//prevent the default submit
		var url = 'processes/file_editor_exec.php';
		var $data = $('#save-edit').serialize();
		performAjaxPost(url, $data, function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				alert(data.success);
			}
		});
	});
});

$(document).ready(function() {
	$('#search-form').submit(function(event) {
		event.preventDefault();//prevent the default submit
		var url = 'processes/file_editor_exec.php';
		var $data = $('#search-form').serialize();
		performAjaxPost(url, $data, function(data) {
			$('#grep-result').removeClass('show').addClass('hide');
			if (data.error) {
				alert(data.error);
			} else {
				$('#grep-result pre').text(data.success);
				$('#grep-result').removeClass('hide').addClass('show');
				
			}
		});
	});
});

$(document).ready(function() {
	$('.sed').submit(function(event) {
		event.preventDefault();//prevent the default submit
		var url = 'processes/file_editor_exec.php';
		var $data = $(this).serialize();
		performAjaxPost(url, $data, function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				$('#respond label').text('Result:');
				$('#respond pre').text(data.success);
			}
		});
	});
});


//Help function
function performAjaxPost(url, data, callBackFunc) {
	$.ajax({
		type : 'POST',
		url : url,//proccess - server
		data : data,
		dataType : 'json',
		success : callBackFunc 
	});
}
