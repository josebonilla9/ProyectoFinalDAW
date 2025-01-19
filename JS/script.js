const ctx = document.querySelector('.activity-chart');
const ctx2 = document.querySelector('.prog-chart');

window.onload = function () {
    generateCalendar(currentMonth, currentYear);
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

let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
let selectedDate = null;

window.onload = function () {
    generateCalendar(currentMonth, currentYear);
};

function generateCalendar(month, year) {
    const calendar = document.getElementById('calendar');
    calendar.innerHTML = '';

    const monthYearDisplay = document.getElementById('calendar-month-year');
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    monthYearDisplay.textContent = `${monthNames[month]} ${year}`;

    const firstDayOfMonth = new Date(year, month, 1).getDay();
    const totalDays = new Date(year, month + 1, 0).getDate();

    for (let i = 0; i < firstDayOfMonth; i++) {
        let blankDay = document.createElement("div");
        calendar.appendChild(blankDay);
    }

    for (let day = 1; day <= totalDays; day++) {
        let daySquare = document.createElement("div");
        const todayDateElement = document.getElementById('today-date');
        daySquare.className = "calendar-day";
        daySquare.textContent = day;
        daySquare.id = `day-${day}`;
        daySquare.addEventListener('click', function () {
            selectedDate = new Date(year, month, day);
            showAddTaskModal();
            updateTradesTable();
            todayDateElement.textContent = `${monthNames[selectedDate.getMonth()]} ${selectedDate.getDate()}, ${selectedDate.getFullYear()}`;
        });
        calendar.appendChild(daySquare);
    }
}

function prevMonth() {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    generateCalendar(currentMonth, currentYear);
}

function nextMonth() {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    generateCalendar(currentMonth, currentYear);
}

function showAddTaskModal() {
    document.getElementById('addTaskModal').style.display = 'block';
}

function closeAddTaskModal() {
    document.getElementById('addTaskModal').style.display = 'none';
}

let totalPL = 0;

function sendData() {
    const instrument = document.getElementById('instrument').value.trim();
    const contractsTraded = document.getElementById('contracts-traded').value.trim();
    const commissionsString = document.getElementById('commissions').value.trim();
    const tradePLString = document.getElementById('trade-pl').value.trim();
    
    const commissions = parseFloat(commissionsString).toFixed(2);
    const tradePL = parseFloat(tradePLString).toFixed(2);

    if (isNaN(contractsTraded) || isNaN(commissions) || isNaN(tradePL)) {
        alert("Please enter valid numbers for Contracts Traded, Commissions, and Trade P&L!");
        return;
    }

    if (instrument && contractsTraded && commissions && tradePL && selectedDate) {
        const tradesTable = document.getElementById('trades-table').getElementsByTagName('tbody')[0];
        const newRow = tradesTable.insertRow();
        newRow.insertCell(0).textContent = instrument;
        newRow.insertCell(1).textContent = contractsTraded;
        newRow.insertCell(2).textContent = `$` + commissions;
        newRow.insertCell(3).textContent = `$` + tradePL;
        newRow.insertCell(4).innerHTML = `<i class='bx bx-trash'></i>`;

        totalPL += parseFloat(tradePLString);
        monthlyPL += parseFloat(tradePLString);

        document.getElementById('instrument').value = '';
        document.getElementById('contracts-traded').value = '';
        document.getElementById('commissions').value = '';
        document.getElementById('trade-pl').value = '';

        const calendarDays = document.getElementById('calendar').children;
        for (let i = 0; i < calendarDays.length; i++) {
            const day = calendarDays[i];
            if (parseInt(day.textContent) === selectedDate.getDate()) {
                let taskElement = day.querySelector('.task');
                if (!taskElement) {
                    taskElement = document.createElement("div");
                    taskElement.className = "task";
                    day.appendChild(taskElement);
                }
                taskElement.textContent = `$${formatPL(totalPL)}`;

                day.classList.remove('positive-pl', 'negative-pl');
                if (totalPL > 0) {
                    day.classList.add('positive-pl');
                } else if (totalPL < 0) {
                    day.classList.add('negative-pl');
                }

                break;
            }
        }
        updateTotalPL();
    } else {
        alert("Please fill in all fields!");
    }
}

function updateTotalPL() {
    document.getElementById('today-pl').textContent = `Total P&L: ${totalPL.toFixed(2)} USD`;
}

function formatPL(value) {
    if (Math.abs(value) >= 1000) {
        return (value / 1000).toFixed(2) + 'K';
    }
    return value.toFixed(2);
}

function sendData() {
    var userData = $('#add-trade-form').serialize();

    date = new Date(selectedDate);
    date = date.getFullYear() + "-" + (date.getMonth() + 1).toString().padStart(2, '0') + "-" + date.getDate().toString().padStart(2, '0');

    userData += "&trade_date=" + date;

    $.ajax({
        url: '../PHP/trades_add.php',
        type: 'POST',
        data: userData,

        success: function(response) {

            if (response == "1") {
                alertify.success("Trade added successfully");
                updateTradesTable();
                clearForm();

                return;
            } else if (response == "2") {
                alertify.error("Trade not added");
                clearForm();
            }
        }
    })
}

function clearForm() {
    document.getElementById("instrument").value = "";
    document.getElementById("contracts-traded").value = "";
    document.getElementById("commissions").value = "";
    document.getElementById("trade-pl").value = "";
}

var currentPage = 1;
var recordsPerPage = 10;
var tradesData = [];

function updateTradesTable() {

    var date = new Date(selectedDate);
    var formattedDate = date.getFullYear() + "-" + (date.getMonth() + 1).toString().padStart(2, '0') + "-" + date.getDate().toString().padStart(2, '0');

    $.ajax({
        url: '../PHP/trades_get.php',
        type: 'GET',
        data: { trade_date: formattedDate },
        dataType: 'json',
        success: function(response) {
            tradesData = response;
            renderTable();
            renderPagination();
        },
    });
}

function renderTable() {
    var tbody = $('#trades-table-body');
    tbody.empty();
    var start = (currentPage - 1) * recordsPerPage;
    var end = start + recordsPerPage;
    var pageData = tradesData.slice(start, end);

    pageData.forEach(function(trade) {
        var row = '<tr>' +
            '<td>' + trade.instrument + '</td>' +
            '<td>' + trade.contracts + '</td>' +
            '<td>' + trade.commissions + '</td>' +
            '<td>' + trade.trade_pl + '</td>' +
            '<td><i class="bx bx-trash"></i></td>' +
            '</tr>';
        tbody.append(row);
    });
}

function renderPagination() {
    var pagination = $('#pagination');
    pagination.empty();
    var totalPages = Math.ceil(tradesData.length / recordsPerPage);

    if (currentPage > 1) {
        pagination.append('<button class="pagination-button" onclick="prevPage()">&#9664;</button>');
    }

    if (currentPage < totalPages) {
        pagination.append('<button class="pagination-button" onclick="nextPage()">&#9654</button>');
    }
}

function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        renderTable();
        renderPagination();
    }
}

function nextPage() {
    var totalPages = Math.ceil(tradesData.length / recordsPerPage);
    if (currentPage < totalPages) {
        currentPage++;
        renderTable();
        renderPagination();
    }
}

$(document).ready(function() {
    updateTradesTable();
});