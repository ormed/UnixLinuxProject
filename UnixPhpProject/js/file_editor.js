
function performAjax(url, data) {
	$.ajax({//Process the form using $.ajax()
		type : 'POST',
		url : url,//proccess - server
		data : $data,
		dataType : 'json',
		success : function(data) {
			document.getElementById('respond').innerHTML = getResultFromJson(data);
		}
	});
}