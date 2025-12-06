const tasksChartEl = document.getElementById('tasksChart');
if(tasksChartEl){
    const tasks = JSON.parse(tasksChartEl.dataset.tasks);
    const completed = tasks.filter(t => t.status === "Completed").length;
    const pending = tasks.filter(t => t.status === "Pending").length;

    new Chart(tasksChartEl, {
        type: 'pie',
        data: {
            labels: ['Completed', 'Pending'],
            datasets: [{
                label: 'Tasks Status',
                data: [completed, pending],
                backgroundColor: ['#28a745', '#ffc107']
            }]
        },
        options: { responsive: true }
    });
}
