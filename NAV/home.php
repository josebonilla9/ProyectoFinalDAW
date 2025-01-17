<?php
    session_start();
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../CSS/style.css">
    <title>DailyTrading</title>
</head>

<body>

    <div class="top-container">

        <div class="nav">
            <div class="logo">
                <i class='bx bx-candles'></i>
                <a href="#">DailyTrading</a>
            </div>

            <div class="nav-links">
                <a href="#">Dashboard</a>
                <a href="#">Statistics</a>
                <a href="#">Blog</a>
                <a href="#">Live</a>
            </div>

            <div class="right-section">
                <i class='bx bx-bell'></i>

                <div class="profile">
                    <div class="info">
                        <!-- <img src="../assets/profile.png"> -->
                        <div class="user-button">
                            <a href="#"><?php echo $_SESSION['user_name'] ?></a>
                            <!-- <p>Premium</p> -->
                        </div>
                    </div>
                    <i class='bx bx-chevron-down'></i>
                </div>
            </div>
        </div>

        <div class="status">
            <div class="header">
                <h4 id="big"></h4>
                <h4 id="small">Weekly Activity</h4>
            </div>

            <div class="items-list">
                <div class="item">
                    <div class="info">
                        <div>
                            <h5>Balance</h5>
                            <p>$ 5,733.20</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <div>
                            <h5>Net P&L</h5>
                            <p>$ 3,976.85</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <div class="info-text">
                            <h5>Weekly P&L</h5>
                            <p>$ (875.00)</p>
                        </div>
                        
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <div class="titles">
                            <p>Best Day</p>
                            <p>Worst Day</p>
                            <p>Avg. Winning Day</p>
                            <p>Avg. Losing Day</p>
                        </div>

                        <div class="results">
                            <p>$876.44</p>
                            <p>-$1,588.50</p>
                            <p>$498.32</p>
                            <p>-$233.09</p>
                        </div>
                    </div>
                </div>
                
                <div class="item">
                    <canvas class="activity-chart"></canvas>
                </div>
            </div>
        </div>

    </div>

    <div class="bottom-container">

        <div class="planner">
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
    
        <div id="addTaskModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeAddTaskModal()">&times;</span>
                <div class="modal-title">
                    <span id="today-date"></span>
                </div>
                <div class="modal-inputs">
                    <input type="text" class="modal-placeholder" id="instrument" placeholder="Instrument">
                    <input type="text" class="modal-placeholder" id="contracts-traded" placeholder="Contracts Traded">
                    <input type="text" class="modal-placeholder" id="commissions" placeholder="Commissions">
                    <input type="text" class="modal-placeholder" id="trade-pl" placeholder="Trade P&L">
                </div>

                <button onclick="addTrade()">Add Trade</button>

                <table class="modal-table" id="trades-table">
                    <thead>
                        <tr>
                            <th>Instrument</th>
                            <th>Contracts Traded</th>
                            <th>Commissions</th>
                            <th>Trade P&L</th>
                            <th class="trash"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Las filas se añadirán aquí -->
                    </tbody>
                </table>
                <div class="modal-pl">
                    <span id="today-pl"></span>
                </div>
            </div>
        </div>

<!--

        <div class="prog-status">
            <div class="header">
                <h4>Learning Progress</h4>
                <div class="tabs">
                    <a href="#" class="active">1Y</a>
                    <a href="#">6M</a>
                    <a href="#">3M</a>
                </div>
            </div>

            <div class="details">
                <div class="item">
                    <h2>3.45</h2>
                    <p>Current GPA</p>
                </div>
                <div class="separator"></div>
                <div class="item">
                    <h2>4.78</h2>
                    <p>Class Average GPA</p>
                </div>
            </div>

            <canvas class="prog-chart"></canvas>

        </div>

    -->

        <div class="livechart">
            <div class="charts">
                <!-- TradingView Widget BEGIN -->

                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                    {
                    "symbol": "NASDAQ:AAPL",
                    "width": "100%",
                    "height": "100%",
                    "locale": "en",
                    "dateRange": "12M",
                    "colorTheme": "light",
                    "isTransparent": true,
                    "autosize": true,
                    "largeChartUrl": ""
                }
                    </script>
                </div>
            </div>

            <div class="charts">
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                    {
                    "symbol": "COINBASE:BTCUSD",
                    "width": "100%",
                    "height": "100%",
                    "locale": "en",
                    "dateRange": "12M",
                    "colorTheme": "light",
                    "isTransparent": true,
                    "autosize": true,
                    "largeChartUrl": ""
                }
                    </script>
                </div>
            </div>

            <div class="charts">
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                    {
                    "symbol": "NASDAQ:TSLA",
                    "width": "100%",
                    "height": "100%",
                    "locale": "en",
                    "dateRange": "12M",
                    "colorTheme": "light",
                    "isTransparent": true,
                    "autosize": true,
                    "largeChartUrl": ""
                }
                    </script>
                </div>
            </div>

            <div class="charts">
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                    {
                    "symbol": "OANDA:XAUUSD",
                    "width": "100%",
                    "height": "100%",
                    "locale": "en",
                    "dateRange": "12M",
                    "colorTheme": "light",
                    "isTransparent": true,
                    "autosize": true,
                    "largeChartUrl": ""
                }
                    </script>
                
                </div>
                
            </div>
            <div class="tradingview-widget-copyright">
                <a href="https://www.tradingview.com/" target="_blank">Track all markets on TradingView</a>
                
                <!-- TradingView Widget END -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../JS/script.js"></script>

</body>

</html>