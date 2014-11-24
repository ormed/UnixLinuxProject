$(document).ready(function() {
	$('.form-horizontal').submit(function(event) {
		event.preventDefault();//prevent the default submit
		document.getElementById('respond').innerHTML = '';
		var url = '/UnixLinuxProject/UnixPhpProject/processes/perl_commands_exec.php';
		var $data = $('.form-horizontal').serialize();
		performAjax(url, $data);
		
	});
});

function performAjax(url, data) {
	$.ajax({//Process the form using $.ajax()
		type : 'POST',
		url : url,//proccess - server
		data : data,
		dataType : 'json',
		success : function(data) {
			document.getElementById('respond').innerHTML = getResultFromJson(data);
		}
	});
}

function getResultFromJson(data) {
	var $page = $('#page').val();
	var result;
	
	switch ($page) {
	case 'ls':
		result = getTableFromJson(data);
		break;
	case 'more':
		result = '<pre>' + data + '</pre>';
		break;
	case 'wc':
		result = "";
		$.each(data, function(key, line_value) {
			result += line_value + "\n";
		});
		result = '<pre>' + result + '</pre>';
		break;
	case 'rm':
		result = "";
		$.each(data, function(key, line_value) {
			result += line_value + "\n";
		});
		result = '<pre>' + result + '</pre>';
		break;
	case 'find':
		result = "";
		$.each(data, function(key, line_value) {
			result += line_value + "\n";
		});
		result = '<pre>' + result + '</pre>';
		break;
	default:
		break;
	}
	
	return result;
}


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