const tasksChartCtx = document.getElementById('tasksChart');
if(tasksChartCtx){
    new Chart(tasksChartCtx, {
        type: 'pie',
        data: {
            labels: ['Completed','Pending'],
            datasets: [{
                label: 'Tasks Status',
                data: [2,1], 
                backgroundColor: ['#4CAF50','#F44336']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Tasks Status' }
            }
        }
    });
}
