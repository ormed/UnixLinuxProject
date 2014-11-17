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

// cpu charts
google.load("visualization", "1", {packages:["gauge"]});
google.setOnLoadCallback(drawCpuChart);
function drawCpuChart() {

  var data = google.visualization.arrayToDataTable([
    ['Label', 'Value'],
    ['Memory', 0],
    ['CPU', 0],
  ]);

  var options = {
    width: 400, height: 120,
    redFrom: 90, redTo: 100,
    yellowFrom:75, yellowTo: 90,
    minorTicks: 5
  };

  var chart = new google.visualization.Gauge(document.getElementById('cpu_div'));

  chart.draw(data, options);

  setInterval(function() {
    data.setValue(0, 1, Math.round(60 * Math.random()));
    chart.draw(data, options);
  }, 1000);
  setInterval(function() {
    data.setValue(1, 1, Math.round(60 * Math.random()));
    chart.draw(data, options);
  }, 5000);
}

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
 