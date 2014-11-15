$(document).ready(function() {
	$('#save-edit').submit(function(event) {
		event.preventDefault();//prevent the default submit
		var url = 'processes/file_editor_exec.php';
		var $data = $('#save-edit').serialize();
		performAjaxPost(url, $data, function() {
			alert('File updated successfuly.');
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
