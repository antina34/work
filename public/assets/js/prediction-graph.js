$(function() {

    let charts = document.getElementsByClassName('js-chart');

    for (chart of charts) {
        getDataFromDOM(chart.id)
    }

    function getDataFromDOM(id) {
        let historicalData, actualData, chartName, qty = 20;
        try {
            historicalData = JSON.parse(document.querySelector('#' + id).attributes['data-historical'].value);
            actualData = JSON.parse(document.querySelector('#' + id).attributes['data-actual'].value);
            qty = JSON.parse(document.querySelector('#' + id).attributes['data-quantity'].value);
            chartName = document.querySelector('#' + id).attributes['data-name'].value;

        } catch (error) {
            console.error(error)
        }
        let datesAndTimes = [], chartData = [], canLoadGraph = true;

        if (!historicalData || !actualData) {
            document.querySelector('#' + id).textContent = "You do not have connected the API";
            canLoadGraph = false;
        } else if (historicalData.length === 0 || actualData.length === 0) {
            document.querySelector('#' + id).textContent = "No data was fetched from the API";
            canLoadGraph = false;
        }
        if (canLoadGraph) {
            historicalData.forEach(function (data) {
                datesAndTimes.push(moment(data.date).format('DD/MM HH:mm'))
            });
            actualData.forEach(function (data) {
                let date = moment(data.date).format('DD/MM HH:mm');
                if (!datesAndTimes.includes(date)) {
                    datesAndTimes.push(date);
                }
            });
            datesAndTimes.sort();
            datesAndTimes.forEach(function (datum) {
                let actualPrice, historicalPrice;
                if (actualData.find(({ date }) => moment(date).format('DD/MM HH:mm') === datum)) {
                    // noinspection JSUnresolvedVariable
                    actualPrice = actualData.find(({ date }) =>
                        moment(date).format('DD/MM HH:mm') === datum).price.toFixed(2);
                }
                if (historicalData.find(({ date }) => moment(date).format('DD/MM HH:mm') === datum)) {
                    // noinspection JSUnresolvedVariable
                    historicalPrice = historicalData.find(({ date }) =>
                        moment(date).format('DD/MM HH:mm') === datum).price.toFixed(2);
                }

                let newData = {};
                newData.dateTime = datum;
                newData.historicalPrice = historicalPrice;
                newData.actualPrice = actualPrice;

                chartData.push(newData);
            });

            let historicalPrices = [], actualPrices = [];
            chartData.forEach(function (datum) {
                if (datum.historicalPrice) {
                    historicalPrices.push(datum.historicalPrice)
                } else {
                    historicalPrices.push(null)
                }
                if (datum.actualPrice) {
                    actualPrices.push(datum.actualPrice)
                } else {
                    actualPrices.push(null)
                }
            });

            renderGraph(
                chartData.map(a => a.dateTime),
                historicalPrices,
                chartData.map(a => a.dateTime),
                actualPrices,
                id,
                qty,
                chartName
            );
        }
    }

    function renderGraph(historicalDates, historicalPrices, actualDates, actualPrices, id, qty, chartName) {
        let options = {
            series: [
                {
                    name: "Predicted Prices",
                    data: historicalPrices
                },
                {
                    name: "Actual Prices",
                    data: actualPrices
                }
            ],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            colors: ['#FF1654', '#00e396'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: chartName + ' Price Prediction',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: historicalDates
            }
        };

        let chart = new ApexCharts(document.querySelector("#" + id), options);
        chart.render();
    }
});
