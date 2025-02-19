const ctx = document.querySelector('.activity-chart');

export let myChart;

export function initChart() {
    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            datasets: [{
                label: 'P&L',
                data: [0, 0, 0, 0, 0, 0, 0],
                backgroundColor: '#1e293b',
                borderWidth: 3,
                borderRadius: 6,
                hoverBackgroundColor: '#60a5fa'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    border: {
                        display: true
                    },
                    grid: {
                        display: true,
                        color: '#1e293b'
                    }
                },
                y: {
                    grid: {
                        color: (context) => context.tick.value === 0 ? '#1e293b' : 'transparent'
                    },
                    ticks: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuad',
            }
        }
    });
}