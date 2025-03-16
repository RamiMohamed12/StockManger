document.addEventListener('DOMContentLoaded', function() {
    const endpoint = document.getElementById('chartData').dataset.chartEndpoint;
    
    fetch(endpoint)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            initCharts(data);
        })
        .catch(error => {
            console.error('Error loading chart data:', error);
            document.querySelector('.reports-container').innerHTML += 
                '<div class="error-message">Failed to load chart data. Please try again later.</div>';
        });
});

function initCharts(data) {
    // Calculate inventory values (price * quantity)
    const inventoryValues = data.meatQuantities.map((qty, index) => 
        qty * data.meatPrices[index]);
    
    // Meat Inventory Distribution - Pie Chart
    const meatPieCtx = document.getElementById('meatPieChart').getContext('2d');
    const meatPieChart = new Chart(meatPieCtx, {
        type: 'pie',
        data: {
            labels: data.meatNames,
            datasets: [{
                label: 'Available KG',
                data: data.meatQuantities,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Meat Stock Distribution (KG)'
                }
            }
        }
    });

    // Meat Prices Comparison - Bar Chart
    const meatPriceCtx = document.getElementById('meatPriceChart').getContext('2d');
    const meatPriceChart = new Chart(meatPriceCtx, {
        type: 'bar',
        data: {
            labels: data.meatNames,
            datasets: [{
                label: 'Starting Price (₪)',
                data: data.meatPrices,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Price (₪)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Meat Type'
                    }
                }
            }
        }
    });

    // Inventory Value Chart - Bar Chart
    const inventoryValueCtx = document.getElementById('inventoryValueChart').getContext('2d');
    const inventoryValueChart = new Chart(inventoryValueCtx, {
        type: 'bar',
        data: {
            labels: data.meatNames,
            datasets: [{
                label: 'Total Value (₪)',
                data: inventoryValues,
                backgroundColor: 'rgba(255, 159, 64, 0.6)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Value (₪)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Meat Type'
                    }
                }
            }
        }
    });

    // Employee Chart - Doughnut
    const employeeCtx = document.getElementById('employeeChart').getContext('2d');
    const employeeChart = new Chart(employeeCtx, {
        type: 'doughnut',
        data: {
            labels: data.professions,
            datasets: [{
                label: 'Salary Distribution',
                data: data.salaryByProfession,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Salary Distribution by Profession'
                }
            }
        }
    });
}