google.setOnLoadCallback(drawChart);

function drawChart() {
	console.log(disks);
	
	chartData = [[ 'File System', 'Available(MB)', 'Used(MB)' ]];
	
	$.each(disks, function(key, row) {
			if (row[0] == 'none') {
				return;
			}
			chartData.push([
			    row[0], 
			    parseInt(row[3].substring(0, row[3].length - 1)),
			    parseInt(row[2].substring(0, row[2].length - 1))
			    ]);
	});
	
	var data = google.visualization.arrayToDataTable(chartData);

	var options = {
		title : 'Performance',
		vAxis : {
			title : 'File Systems',
			titleTextStyle : {
				color : 'red'
			}
		},
		hAxis : {
			maxValue : 100
		}
	};

	var chart = new google.visualization.BarChart(document
			.getElementById('chart_div'));

	chart.draw(data, options);
}

// update process table every 3 second
$(function() {
	setInterval(function(){
		var url = 'processes/shell_commands_exec.php';
		var data = {command : 'top -n 1 -b'};
		performAjaxPost(url, data, function(data) {
			$('#process-table').text(data);
		});
	},3000);
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
 