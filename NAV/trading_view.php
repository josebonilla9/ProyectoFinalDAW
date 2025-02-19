<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>DailyTrading</title>
</head>
<body>

    <div class="livechart">

        <!-- TradingView Widget BEGIN -->

        <div class="charts">

            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script class="chart" type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
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

                <script class="chart" type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
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

                <script class="chart" type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
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

                <script class="chart" type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                {
                    "symbol": "CME_MINI:NQ1!",
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
        </div>

        <!-- TradingView Widget END -->
         
    </div>

</body>

</html>