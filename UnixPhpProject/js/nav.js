$(function() {
setInterval(function(){
	var url = 'processes/admin_commands_exec.php';
	var data = {page : 'date'};
	performAjaxPost(url, data, function(data) {
		$('#system-time').text(data.success);
	});
},1000);
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