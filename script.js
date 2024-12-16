const ctx = document.querySelector('.activity-chart');
const ctx2 = document.querySelector('.prog-chart');

window.onload = function () {
    generateCalendar();
};

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
        datasets: [{
            label: 'P&L',
            data: [200, 225, 370, -190, 270, 0, 0],
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

new Chart(ctx2, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
            label: 'Class GPA',
            data: [6, 10, 8, 14, 6, 7, 4],
            borderColor: '#0891b2',
            tension: 0.4
        },
        {
            label: 'Aver GPA',
            data: [8, 6, 7, 6, 11, 8, 10],
            borderColor: '#ca8a04',
            tension: 0.4
        }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        scales: {
            x: {
                grid: {
                    display: false,
                }
            },
            y: {
                ticks: {
                    display: false
                },
                border: {
                    display: false,
                    dash: [5, 5]
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

// Function to generate the calendar
function generateCalendar() {
    const calendar = document.getElementById('calendar');

    // Create a new Date object to get the current date, month, and year
    const currentDate = new Date();
    const month = currentDate.getMonth();
    const year = currentDate.getFullYear();

    // Calculate the first and last day of the month
    const firstDayOfMonth = new Date(year, month, 0);
    const lastDayOfMonth = new Date(year, month + 1, 0);

    // Calculate the day of the week of the first day of the month
    const firstDayOfWeek = firstDayOfMonth.getDay();
    const totalDays = lastDayOfMonth.getDate();

    // Add blank div elements for the days before the first day of the month
    for (let i = 0; i < firstDayOfWeek; i++) {
        let blankDay = document.createElement("div");
        calendar.appendChild(blankDay);
    }

    // Add div elements for each day of the month
    for (let day = 1; day <= totalDays; day++) {
        let daySquare = document.createElement("div");
        daySquare.className = "calendar-day";
        daySquare.textContent = day;
        daySquare.id = `day-${day}`;
        calendar.appendChild(daySquare);
    }
}

// Function to show the add task modal
function showAddTaskModal() {
    document.getElementById('addTaskModal').style.display = 'block';
}

// Function to close the add task modal
function closeAddTaskModal() {
    document.getElementById('addTaskModal').style.display = 'none';
}

// Function to add a task
function addTrade() {
    // Get task date and description from input fields
    const taskDate = new Date(document.getElementById('task-date').value);
    const taskDesc = document.getElementById('task-desc').value.trim();

    // Validate task date and description
    if (taskDesc && !isNaN(taskDate.getDate())) {
        // Get calendar days
        const calendarDays = document.getElementById('calendar').children;
        // Iterate through calendar days
        for (let i = 0; i < calendarDays.length; i++) {
            const day = calendarDays[i];
            // Check if day matches task date
            if (parseInt(day.textContent) === taskDate.getDate()) {
                // Create task element
                const taskElement = document.createElement("div");
                taskElement.className = "task";
                taskElement.textContent = taskDesc;

                // Append task element to day element
                day.appendChild(taskElement);
                break;
            }
        }
        closeAddTaskModal(); // Close add task modal
    } else {
        // Alert if invalid date or task description
        alert("Please enter a valid date and task description!");
    }
}

function editDay() {
    // Get task date and description from input fields
    const taskDate = new Date(document.getElementById('task-date').value);
    const taskDesc = document.getElementById('task-desc').value.trim();

    // Validate task date and description
    if (taskDesc && !isNaN(taskDate.getDate())) {
        // Get calendar days
        const calendarDays = document.getElementById('calendar').children;
        // Iterate through calendar days
        for (let i = 0; i < calendarDays.length; i++) {
            const day = calendarDays[i];
            // Check if day matches task date
            if (parseInt(day.textContent) === taskDate.getDate()) {
                // Create task element
                const taskElement = document.createElement("div");
                taskElement.className = "task";
                taskElement.textContent = taskDesc;

                // Add event listener for right-click to delete task
                taskElement.addEventListener("contextmenu", function (event) {
                    event.preventDefault(); // Prevent default context menu
                    deleteTask(taskElement); // Call deleteTask function
                });

                // Add event listener for regular click to edit task
                taskElement.addEventListener('click', function () {
                    editTask(taskElement); // Call editTask function
                });

                // Append task element to day element
                day.appendChild(taskElement);
                break;
            }
        }
        closeAddTaskModal(); // Close add task modal
    } else {
        // Alert if invalid date or task description
        alert("Please enter a valid date and task description!");
    }
}