<?php include("../PHP/conection.php") ?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../CSS/style.css">
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
    <title>DailyTrading</title>
</head>
<body>

    <div class="top-container">

        <?php include("../PHP/validation.php") ?>

        <div class="status">

            <div class="items-list">
                <div class="item">
                    <div class="info">
                        <div>
                            <h5>Balance</h5>
                            <p id="initial-balance"></p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <div>
                            <h5>Net P&L</h5>
                            <p id="net-pl"></p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <div class="info-text">
                            <h5>Average Trade P&L</h5>
                            <p id="average-pl"></p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <div class="titles">
                            <p>Average Day P&L</p>
                            <p>Best Day</p>
                            <p>Worst Day</p>
                            <p>Avg. Winning Day</p>
                            <p>Avg. Losing Day</p>
                        </div>

                        <div class="results">
                            <p id="daily-average">$1,234.56</p>
                            <p id="best-day">$876.44</p>
                            <p id="worst-day">-$1,588.50</p>
                            <p id="winning-average">$498.32</p>
                            <p id="losing-average">-$233.09</p>
                        </div>
                    </div>
                </div>
                

                <div class="item">
                    <h4 class="weekly-title">Weekly Activity</h4>
                    <div class="weekly-chart">
                        <canvas class="activity-chart"></canvas>
                    </div>
                </div>
                
            </div>
        </div>

    </div>

    <div class="bottom-container">

        <div class="planner" id="planner">
            <div class="header-container">
                <h1>Trading Calendar</h1>
                <div class="calendar-nav">
                    <button onclick="prevMonth()">&#9664;</button>
                    <span id="calendar-month-year"></span>
                    <button onclick="nextMonth()">&#9654;</button>
                </div>
            </div>

            <div class="monthly-stats">
                <p>Monthly Stats: <span id="monthly-pl"></span></p>
            </div>
            
            <div id="calendar" class="calendar-grid"></div>
        </div>

        <div id="addTaskModal" class="home-modal">
            <div class="home-modal-content">
                <div class="home-modal-title">
                    <span id="today-date" class="today-date"></span>
                    <span id="today_pl" class="today-pl">Total P&L: 0.00 USD</span>
                    <span class="close" onclick="closeAddTaskModal()">&times;</span>
                </div>
                <div>
                    <form class="home-modal-inputs" id="add-trade-form">
                        <input type="text" class="home-modal-placeholder" id="instrument" placeholder="Instrument" name="trade_instrument">
                        <input type="text" class="home-modal-placeholder" id="contracts-traded" placeholder="Contracts Traded" name="trade_contracts">
                        <input type="text" class="home-modal-placeholder" id="commissions" placeholder="Commissions" name="trade_commissions">
                        <input type="text" class="home-modal-placeholder" id="trade-pl" placeholder="Trade P&L" name="trade_pl">
                    </form>
                    <button type="button" class="input-button" id="input-button" onclick="sendData()">Add Trade</button>
                </div>

                <table class="home-modal-table" id="trades-table">
                    <thead>
                        <tr>
                            <th>Instrument</th>
                            <th title="Contracts Traded">Contracts Traded</th>
                            <th title="Commissions">Commissions</th>
                            <th>Trade P&L</th>
                            <th>Total</th>
                            <th class="trash"></th>
                        </tr>
                    </thead>
                    <tbody id="trades-table-body"></tbody>
                </table>

                <div id="pagination"></div>
        
            </div>
        </div>

        <?php include("trading_view.php") ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../JS/script.js"></script>

</body>

</html>