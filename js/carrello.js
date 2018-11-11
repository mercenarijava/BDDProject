var charItems;
window.onload = function(){
    var sessionChartData = sessionStorage.getItem("chart_data");
    chartItems = sessionChartData == null? [] : sessionChartData;

    loadUI();

}

function loadUI() {

}
