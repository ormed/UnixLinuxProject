var cpu_data;
var pertition_data;

//partition chart
google.setOnLoadCallback(drawChart);

//cpu chart setting
google.load("visualization", "1", {packages:["gauge"]});
google.setOnLoadCallback(drawCpuChart);

//update process table every 3 second
$(function() {
	setInterval(function(){
		var url = 'processes/shell_commands_exec.php';
		var data = {command : 'top -n 1 -b'};
		performAjaxPost(url, data, function(data) {
			$('#process-table').text(data);
		});
	},3000);
});

//draw partition chart
function drawChart() {
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
	
	var pertition_data = google.visualization.arrayToDataTable(chartData);

	var options = {
		title : 'Partitions usage',
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

	chart.draw(pertition_data, options);
}

// cpu charts
function drawCpuChart() {

  cpu_data = google.visualization.arrayToDataTable([
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

  chart.draw(cpu_data, options);
  // intervals for the memory chart
  setInterval(function() {
	  var url = 'processes/shell_commands_exec.php';
	  var data = {command : 'free -m | grep "Mem:"'};
	  performAjaxPost(url, data, function(returnedData) {
		  var resultArr = returnedData.split(/\s([0-9]+)/);
		  var result = (((parseFloat(resultArr[3]))*100) / (parseFloat(resultArr[1]))).toFixed(2); 
		  console.log(result);
		  cpu_data.setValue(0, 1, result);
		  chart.draw(cpu_data, options);
	  });
  }, 5000);
  
  // intervals update cpu chart from mpstat shell command
  setInterval(function() {
	  var url = 'processes/shell_commands_exec.php';
	  var data = {command : 'mpstat | grep "all"'};
	  performAjaxPost(url, data, function(returnedData) {
		  var resultArr = returnedData.split(/\s([0-9]+\.[0-9]+)/);
		  var result = (parseFloat(resultArr[1]) + parseFloat(resultArr[5])).toFixed(2); 
		  cpu_data.setValue(1, 1, result);
		  chart.draw(cpu_data, options);
	  });
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
 