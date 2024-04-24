// Function to fetch data for pie chart
function fetchChartData() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'chart_data.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);
                updatePieChart(data);
            } else {
                console.error('Failed to fetch chart data. Status: ' + xhr.status);
            }
        }
    };
    xhr.send();
}

// Function to update pie chart with fetched data
function updatePieChart(data) {
    if (data && typeof data === 'object' && 'income' in data && 'expenses' in data && 'totalAmount' in data) {
        var ctx = document.getElementById('pieChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Income', 'Expenses', 'Total Amount'],
                datasets: [{
                    data: [data.income, data.expenses, data.totalAmount],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                legend: {
                    position: 'right'
                }
            }
        });
    } else {
        console.error('Invalid chart data format.');
    }
}

// Initialize the page when DOM content is loaded
document.addEventListener('DOMContentLoaded', function () {
    fetchChartData(); // Fetch initial data and update pie chart
});
