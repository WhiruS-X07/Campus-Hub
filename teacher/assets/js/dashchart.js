// Initialize Chart.js
var ctx = document.getElementById('studentResultsChart').getContext('2d');
var studentResultsChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Jan-2022", "Dec-2022", "Jan-2023", "Dec-2023", "Jan-2024"],
        datasets: [{
            label: 'Passed',
            data: [480, 230, 470, 210, 330],
            backgroundColor: '#98BDFF',
            borderRadius: 5,
        },
        {
            label: 'Backlogs',
            data: [400, 340, 550, 480, 170],
            backgroundColor: '#4B49AC',
            borderRadius: 5,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        scales: {
            x: {
                border: {
                    display: false
                },
                grid: {
                    display: false,
                    drawTicks: true,
                    color: "rgba(0, 0, 0, 0)",
                },
                ticks: {
                    display: true,
                    color: "#6C7383",
                },
            },
            y: {
                border: {
                    display: false
                },
                grid: {
                    display: true,
                },
                ticks: {
                    color: "#6C7383",
                    min: 0,
                    max: 560,
                    autoSkip: true,
                    maxTicksLimit: 10,
                },
            }
        },
        plugins: {
            legend: {
                display: false, // Hide default legend
            }
        }
    },
    plugins: [{
        id: 'customLegend',
        afterDraw: function (chart) {
            const legendContainer = document.getElementById('studentResultsChart-legend');
            if (legendContainer) {
                legendContainer.innerHTML = ''; // Clear previous legend
                const ul = document.createElement('ul');
                ul.style.padding = 0; // Remove padding
                ul.style.margin = 0; // Remove margin
                ul.style.listStyle = 'none'; // Remove default list styling
                chart.data.datasets.forEach(dataset => {
                    ul.innerHTML += `
                      <li style="display: flex; align-items: center; padding: 0; margin: 0;">
                        <span style="display: inline-block; width: 25px; height: 5px; background-color: ${dataset.backgroundColor}; border-radius: 5px; margin-right: 8px;"></span>
                        ${dataset.label}
                      </li>
                    `;
                });
                legendContainer.appendChild(ul);
            }
        }
    }]
});

$(document).ready(function () {
    $('#calendar').fullCalendar({
        height: 'parent',
        contentHeight: 'auto',

        editable: true,
        events: [
            {
                title: 'School Event',
                start: '2024-09-20',
                end: '2024-09-22',
                color: '#1E90FF'
            },
            {
                title: 'Exam Week',
                start: '2024-09-25',
                end: '2024-09-30',
                color: '#00BFFF'
            }
        ]
    });
});