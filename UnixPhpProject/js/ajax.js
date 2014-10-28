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
				document.getElementById('ls_respond').innerHTML = getTableFromJson(data);
			}
		});
		event.preventDefault();//prevent the default submit
	});
});

function getTableFromJson(data) {
	var table = '<table class="table">';
	table += '<tbody>';
	$.each(data, function(key, value) {
		table += '<tr>';
		var line = value.split(",");
		$.each(line, function(key, line_value) {
			table += '<td>' + line_value + '</td>';
		});
		table += '</tr>';
	});
	
	table += '</tbody></table>';
	
	return table;
}