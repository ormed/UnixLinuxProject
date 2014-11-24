 $(function() {
	 $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" });
});

 $(function() {
setInterval(function(){
	var url = '/UnixLinuxProject/UnixPhpProject/processes/admin_commands_exec.php';
	var data = {page : 'date'};
	performAjaxPost(url, data, function(data) {
		$('#current-time').text(data.success);
	});
},1000);
 });
 
 $(document).ready(function() {
		$('.form-horizontal').submit(function(event) {
			var url = '/UnixLinuxProject/UnixPhpProject/processes/admin_commands_exec.php';
			var $data = $('.form-horizontal').serialize();
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
					}
				}
			});
			event.preventDefault();//prevent the default submit
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
 
 