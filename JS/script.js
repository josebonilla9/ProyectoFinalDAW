import { initChart, myChart } from './bar-chart.js';

window.onload = function () {
    chartExecution();
    initChart();
};

function chartExecution() {
    generateCalendar(currentMonth, currentYear);

    setTimeout(() => {
        const calendarDays = document.querySelectorAll('.calendar-day');

        calendarDays.forEach((daySquare, index) => {
            setTimeout(() => {
                daySquare.click();
                closeAddTaskModal();
            }, 50 * index);
        });
    }, 0);
}

let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
let selectedDate = null;

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

        let taskElement = document.createElement("div");
        taskElement.className = "task";
        daySquare.appendChild(taskElement);

        let tradesNumber = document.createElement("div");
        tradesNumber.className = "number-of-trades";
        daySquare.appendChild(tradesNumber);

        daySquare.id = `day-${day}`;
        daySquare.addEventListener('click', function () {
            selectedDate = new Date(year, month, day);
            todayDateElement.textContent = `${monthNames[selectedDate.getMonth()]} ${selectedDate.getDate()}, ${selectedDate.getFullYear()}`;

            showAddTaskModal();
            updateTradesTable();
            updateTotalPL();
            sendData();
        });
        calendar.appendChild(daySquare);
    }
}

document.querySelector('.prevMonth').addEventListener('click', prevMonth);
function prevMonth() {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    chartExecution();
}

document.querySelector('.nextMonth').addEventListener('click', nextMonth);
function nextMonth() {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    chartExecution();
}

function showAddTaskModal() {
    document.getElementById('addTaskModal').style.display = 'block';
}

document.querySelector('.close').addEventListener('click', closeAddTaskModal);
function closeAddTaskModal() {
    document.getElementById('addTaskModal').style.display = 'none';
}

document.querySelector('.input-button').addEventListener('click', sendData);
function sendData() {
    var userData = $('#add-trade-form').serialize();

    let date = new Date(selectedDate);
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
                updateTradesCalendar();
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
            updateTotalPL();
            updateTradesCalendar();
        },
    });
}

function renderTable() {
    var tbody = $('#trades-table-body');
    tbody.empty();
    var pageData = tradesData.slice();

    pageData.forEach(function(trade) {
        var commissions = parseFloat(trade.commissions);
        var trade_pl = parseFloat(trade.trade_pl);
        var totalTradeResult = totalResult(trade);

        var row = 
            '<tr>' +
                '<td>' + trade.instrument + '</td>' +
                '<td>' + trade.contracts + '</td>' +
                '<td>' + commissions.toFixed(2) + '</td>' +
                '<td>' + trade_pl.toFixed(2) + '</td>' +
                '<td>' + totalTradeResult.toFixed(2) + '</td>' +
                '<td><i class="bx bx-trash remove-trade" data-id="' + trade.trade_id + '"></i></td>' +
            '</tr>';
        tbody.append(row);
    });
}

function totalResult(trade){
    var commissions = parseFloat(trade.commissions);
    var trade_pl = parseFloat(trade.trade_pl);
    
    return (trade_pl - commissions);
}

function updateTotalPL() {
    var totalPL = 0.00;

    tradesData.forEach(function(trade) {
        totalPL += totalResult(trade);
    });

    document.getElementById('today_pl').textContent = `Total P&L: ${totalPL.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })} USD`;
    PLColorChange(totalPL, 'today_pl');
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('table').addEventListener('click', function(event) {
        const tradeId = event.target.getAttribute('data-id');
        removeTrade(tradeId);
    });
});

function removeTrade(id) {
    $.ajax({
        url: '../PHP/trades_delete.php',
        type: 'POST',
        data: { id: id },
        success: function(response) {
            if (response == "1") {
                alertify.warning("Trade deleted successfully");
                updateTradesTable();
            } else {
                alertify.error("Trade not deleted");
            }
        }
    });
}

var tradesPLData = [];

function updateTradesCalendar() {
    $.ajax({
        url: '../PHP/trades_pl_get.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            tradesPLData = response;
            addCalendarTrades();
            updateChartWithLastWeekData(tradesPLData);
        },
    });
}

function addCalendarTrades() {
    var selectedDateStr = selectedDate.getFullYear() + "-" + (selectedDate.getMonth() + 1).toString().padStart(2, '0') + "-" + selectedDate.getDate().toString().padStart(2, '0');
    const calendarDays = document.getElementById('calendar').children;
    let totalPL = 0.00, totalBalance = 0.00, positivePLSum = 0.00, negativePLSum = 0.00, monthlyPL = 0.00;
    let positivePLDays = 0, negativePLDays = 0, totalTrades = 0, totalDays = 0;
    let maxPL = -Infinity, minPL = Infinity;
    let dailyPLMap = {};
    let trades = 0;
    
    tradesPLData.forEach(function(trade) {
        const tradeDate = trade.trade_date.split(' ')[0];
        const tradePL = parseFloat(trade.trade_pl - trade.commissions);
        const tradeMonth = new Date(tradeDate).getMonth();
        const tradeYear = new Date(tradeDate).getFullYear();
        totalBalance += tradePL;

        if (tradeDate === selectedDateStr) {
            totalPL += tradePL;
            trades++;
        }

        if (!dailyPLMap[tradeDate]) {
            dailyPLMap[tradeDate] = 0;
        }
        dailyPLMap[tradeDate] += tradePL;

        if (tradeMonth === selectedDate.getMonth() && tradeYear === selectedDate.getFullYear()) {
            monthlyPL += parseFloat(trade.trade_pl - trade.commissions);
        }

        totalTrades++;
    });

    for (const date in dailyPLMap) {
        const dailyPL = dailyPLMap[date];
    
        if (dailyPL > maxPL) {
            maxPL = dailyPL;
        }
        if (dailyPL < minPL) {
            minPL = dailyPL;
        }

        if (dailyPL > 0) {
            positivePLSum += dailyPL;
            positivePLDays++;
        } else if (dailyPL < 0) {
            negativePLSum += dailyPL;
            negativePLDays++;
        }
    
        totalDays++;
    }

    document.getElementById('best-day').textContent = `${maxPL.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })} USD`;
    document.getElementById('worst-day').textContent = `${minPL.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })} USD`;

    let positivePLAverage = positivePLDays > 0 ? (positivePLSum / positivePLDays) : 0;
    let negativePLAverage = negativePLDays > 0 ? (negativePLSum / negativePLDays) : 0;
    let averagePL = totalTrades > 0 ? totalBalance / totalTrades : 0;
    let dayAverage = totalTrades > 0 ? totalBalance / totalDays : 0;

    document.getElementById('winning-average').textContent = `${positivePLAverage.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })} USD`;
    document.getElementById('losing-average').textContent = `${negativePLAverage.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })} USD`;

    document.getElementById('daily-average').textContent = `${dayAverage.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })} USD`;
    

    document.getElementById('monthly-pl').textContent = `${monthlyPL.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })} USD`;
    PLColorChange(monthlyPL, 'monthly-pl');

    for (let i = 0; i < calendarDays.length; i++) {
        let day = calendarDays[i];

        if (parseInt(day.textContent) === selectedDate.getDate()) {
            if (totalPL != 0) {
                let taskElement = day.querySelector('.task');
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
    }

    for (let i = 0; i < calendarDays.length; i++) {
        let day = calendarDays[i];

        if (parseInt(day.textContent) === selectedDate.getDate()) {
            if (trades != 0) {
                let tradesNumber = day.querySelector('.number-of-trades');
                tradesNumber.textContent = trades + ' trades';
            }
        }
    }

    getInitialBalance(totalBalance);

    document.getElementById('net-pl').textContent = `$${totalBalance.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
    PLColorChange(totalBalance, 'net-pl');
    document.getElementById('average-pl').textContent = `$${averagePL.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
    PLColorChange(averagePL, 'average-pl');
}

function updateChartWithLastWeekData(tradesPLData) {
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const lastWeek = new Date(today);
    lastWeek.setDate(today.getDate() - 6);

    let dailyPLMap = {
        'Sun': 0, 'Mon': 0, 'Tue': 0, 'Wed': 0, 'Thu': 0, 'Fri': 0, 'Sat': 0
    };

    tradesPLData.forEach(trade => {
        const tradeDate = new Date(trade.trade_date);
        tradeDate.setHours(0, 0, 0, 0);

        const dayOfWeek = tradeDate.toLocaleDateString('en-US', { weekday: 'short' });
        const tradePL = parseFloat(trade.trade_pl) - parseFloat(trade.commissions);

        if (tradeDate >= lastWeek && tradeDate <= today) {
            dailyPLMap[dayOfWeek] += tradePL;
        }
    });

    myChart.data.datasets[0].data = [
        dailyPLMap['Sun'],
        dailyPLMap['Mon'],
        dailyPLMap['Tue'],
        dailyPLMap['Wed'],
        dailyPLMap['Thu'],
        dailyPLMap['Fri'],
        dailyPLMap['Sat']
    ];
    
    myChart.update();
}

function formatPL(value) {
    if (Math.abs(value) >= 1000) {
        return (value / 1000).toFixed(2) + 'K';
    } else if (Math.abs(value) <= -1000) {
        return (value / 1000).toFixed(2) + 'K';
    }
    return value.toFixed(2);
}

function getInitialBalance(value) {
    let initialBalance = 0.00;
    let balance = 0.00;

    $.ajax({
        url: '../PHP/initial_balance_get.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            initialBalance = response[0].initial_balance;
            initialBalance = parseFloat(initialBalance);

            balance = initialBalance + value;

            document.getElementById('initial-balance').textContent = `$${balance.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
        },
    });
}

function PLColorChange(value, id_name) {
    if (value == 0) {
        document.getElementById(id_name).style.color = 'black';
    } else if (value > 0) {
        document.getElementById(id_name).style.color = 'green';
    } else {
        document.getElementById(id_name).style.color = 'red';
    }
}