var base_url = $('base').attr('data-base');
$(document).ready(function () {
    
    var percentages = window.percentages[0];
    setTimeout(function(){ drawLineGraphSliderPoll(percentages); }, 1000);
});

function drawLineGraphSliderPoll(percentages) {
	var one = [], two = [], three = [], four = [], five = [], six = [], seven = [], eight = [], nine = [], ten = [];
	var percentage_array = new Array();
	percentages.forEach(function(percentage) {
		if(parseInt(percentage.percentage)>=0 && parseInt(percentage.percentage)<11){
			one.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=11 && parseInt(percentage.percentage)<21){
			two.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=21 && parseInt(percentage.percentage)<31){
			three.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=31 && parseInt(percentage.percentage)<41){
			four.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=41 && parseInt(percentage.percentage)<51){
			five.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=51 && parseInt(percentage.percentage)<61){
			six.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=61 && parseInt(percentage.percentage)<71){
			seven.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=71 && parseInt(percentage.percentage)<81){
			eight.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=81 && parseInt(percentage.percentage)<91){
			nine.push(parseInt(percentage.percentage));
		}else if(parseInt(percentage.percentage)>=91 && parseInt(percentage.percentage)<=100){
			ten.push(parseInt(percentage.percentage));
		} 	

	});
	var points = new Array(100);
        for (var i = 0; i <= 100; i++) {
            points[i] = i + 1; 
        }
	var chartData = {
		node: "graph",
		dataset: [one.length,two.length,three.length,four.length,five.length,six.length,seven.length,eight.length,nine.length,ten.length],
		labels: [10,20,30,40,50,60,70,80,90,100],
		pathcolor: "#288ed4",
		fillcolor: "#8e8e8e",
		xPadding: 0,
		yPadding: 0,
		ybreakperiod: 50
	};
	drawlineChart(chartData);
}