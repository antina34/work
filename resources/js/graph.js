$(function() {

    var charts = document.getElementsByClassName('js-chart');

    for (chart of charts) {
        getDataFromDOM(chart.id);
    }

    function getDataFromDOM(id) {

        var historicalData, actualData, chartName, qty = 20;
        try {
            historicalData = JSON.parse(document.querySelector('#' + id).attributes['data-historical'].value);
            actualData = JSON.parse(document.querySelector('#' + id).attributes['data-actual'].value);
            qty = JSON.parse(document.querySelector('#' + id).attributes['data-quantity'].value);
            chartName = document.querySelector('#' + id).attributes['data-name'].value;

        } catch (error) {
            console.error(error)
        }
        var hdates = [], hprices = [], adates = [], aprices = [],
            canLoadGraph = true;

        if (!actualData) {
            document.querySelector('#' + id).textContent = "You do not have connected the API";
            canLoadGraph = false;
        } else if (actualData.length === 0) {
            document.querySelector('#' + id).textContent = "No data was fetched from the API";
            canLoadGraph = false;
        }

        if (canLoadGraph) {
            historicalData.forEach(function (data) {
                hdates.push(moment(data.date).format('DD/MM HH:mm'))
                hprices.push(data.price.toFixed(2))
            });
            actualData.forEach(function (data) {
                adates.push(moment(data.date).format('DD/MM HH:mm'))
                aprices.push(data.price.toFixed(2))
            });

            hdates = hdates.slice(0, qty).reverse();
            hprices = hprices.slice(0, qty).reverse();
            adates = adates.reverse().slice(0, qty).reverse();
            if (historicalData.length > 0) {
                aprices = aprices.reverse().slice(0, qty-1).reverse();
                aprices.push(null);
            } else {
                aprices = aprices.reverse().slice(0, qty).reverse();
            }
            // aprices = aprices.reverse().slice(0, qty-1).reverse();
            // aprices.push(null);
            var series = [],
                  categories;
            if (historicalData && historicalData.length > 0) {
                series = [
                    {
                        name: "Predicted Prices",
                        data: hprices.slice(0, qty)
                    },
                    {
                        name: "Actual Prices",
                        data: aprices.slice(0, qty)
                    }
                ]
                categories = hdates.slice(0, qty)
            } else {
                series = [
                    {
                        name: "Actual Prices",
                        data: aprices.slice(0, qty)
                    }
                ]
                categories = adates.slice(0, qty)
            }
            renderGraph(hdates, hprices, adates, aprices, id, qty, chartName, series, categories);
        }
    }

    function renderGraph(hdates, hprices, adates, aprices, id, qty, chartName, series, categories) {
        var options = {
            series: series,
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
                text: chartName,
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: categories,// hdates.slice(0, qty)
            }
        };

        var chart = new ApexCharts(document.querySelector("#" + id), options);
        chart.render();
    }

    //-----timer----------------------------------------------
    var timer = document.querySelector("#currentTime");
    if (timer) {
        setInterval(function () {
            var today = new Date();
            var dd = today.getUTCDate();
            var mm = today.getUTCMonth() + 1;
            var yyyy = today.getFullYear();
            var hh = today.getUTCHours();
            var m = today.getUTCMinutes();
            var ss = today.getUTCSeconds();
            if (ss < 10) {
                ss = '0' + ss;
            }
            document.querySelector("#currentTime").innerText = yyyy + '-' + mm + '-' + dd + ' ' + hh + ':' + m + ':' + ss;
        }, 300);
    }
    //-----/timer----------------------------------------------

    var chartTimeline = {
        init: function (id) {
            if (document.querySelector(id)) {
                var prices = JSON.parse(document.querySelector(id).attributes['data-prices'].value),
                    sign = document.querySelector(id).attributes['data-sign'].value;

                var pricesOptions = {
                    series: [{
                        name: "USD",
                        data: prices
                    }],
                    chart: {
                        type: 'area',
                        height: 160,
                        sparkline: {
                            enabled: true
                        },
                    },
                    stroke: {
                        curve: 'straight'
                    },
                    fill: {
                        opacity: 0.3
                    },
                    xaxis: {
                        crosshairs: {
                            width: 1
                        },
                    },
                    yaxis: {
                        min: Math.min(...prices)-500
                    },
                    title: {
                        text: parseFloat(document.querySelector("#chart-timeline").attributes['data-current'].value).toFixed(2),
                        offsetX: 0,
                        style: {
                            fontSize: '30px',
                        }
                    },
                    subtitle: {
                        text: parseFloat(document.querySelector("#chart-timeline").attributes['data-diff'].value).toFixed(2) + '%  ' + (sign == '+' ? '↑' : '↓'),
                        offsetX: 140,
                        offsetY: 5,
                        style: {
                            fontSize: '24px',
                            color: sign === '+' ? '#029666' : '#ee335e'
                        }
                    }
                };

                var chartPrices = new ApexCharts(document.querySelector(id), pricesOptions);
                chartPrices.render();
                this.update(id, chartPrices);
            }
        },
        update: function (id, chartPrices) {
            var url =   sign = document.querySelector(id).attributes['data-url'].value;
            setInterval(function () {
                $.ajax({
                    url: url
                }).done(function (result) {
                    var sign = document.querySelector(id).attributes['data-sign'].value;
                    document.querySelector(id).attributes['data-current'].value = result.currentPrice;
                    document.querySelector(id).attributes['data-diff'].value = Math.abs(result.btcChange);
                    document.querySelector(id).attributes['data-sign'].value = result.btcChange < 0 ? '-' : '+';

                    prices = result.series;
                    var pricesOptions = {
                        series: [{
                            name: "USD",
                            data: prices
                        }],
                        chart: {
                            type: 'area',
                            height: 160,
                            sparkline: {
                                enabled: true
                            },
                        },
                        stroke: {
                            curve: 'straight'
                        },
                        fill: {
                            opacity: 0.3
                        },
                        xaxis: {
                            crosshairs: {
                                width: 1
                            },
                        },
                        yaxis: {
                            min: Math.min(...prices) - 500
                        },
                        title: {
                            text: parseFloat(document.querySelector(id).attributes['data-current'].value).toFixed(2),
                            offsetX: 0,
                            style: {
                                fontSize: '30px',
                            }
                        },
                        subtitle: {
                            text: parseFloat(document.querySelector(id).attributes['data-diff'].value).toFixed(2) + '%  ' + (sign == '+' ? '↑' : '↓'),
                            offsetX: 140,
                            offsetY: 5,
                            style: {
                                fontSize: '24px',
                                color: sign === '+' ? '#029666' : '#ee335e'
                            }
                        }
                    };

                    chartPrices.updateOptions(pricesOptions);
                    chartPrices.updateSeries([{
                        name: "USD",
                        data: prices
                    }]);
                });
            }, 15000);
        }
    };

    chartTimeline.init('#chart-timeline');
});
