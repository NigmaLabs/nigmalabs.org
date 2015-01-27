define(['./module'], function(controllers) {
    'use strict';

    var dateToStr, monthTimestamp;

    dateToStr = function(date) {
        var year, month, dateStr;
        year = date.getFullYear().toString();
        month = date.getMonth() + 1;
        month = (month <= 9) ? '0' + month : month.toString();
        dateStr = year + '-' + month;
    };

    controllers.controller('finance', ['$scope', '$http', 'dateUnit', 'chartUnit', function($scope, $http, dateUnit, chartUnit) {
            //finance controller
            var now, itrDate, mathFinance, decodeFinanceData, financeData,
                    exinChart, createCharts;
            now = new Date();
            itrDate = new Date(2012, 0, 1);

            //
            $scope.chart = chartUnit.createBarChart();

            //iterate date to today
            decodeFinanceData = function(financeData) {
                var data, yearKey, monthKey, monthData, i;
                monthData = {
                    balance: 0,
                    expenses: {},
                    expensesSum: 0,
                    influence: {},
                    influenceSum: 0
                };
                data = {};
                while (itrDate < now) {
                    monthData = {};
                    dateUnit.addMonths(itrDate, 1);
                    yearKey = itrDate.getFullYear();
                    if (data[yearKey] == null) {
                        data[yearKey] = {};
                    }
                    monthKey = dateUnit.monthStr(itrDate);
                    if (financeData[monthKey] == null) {
                        //no modified
                        data[yearKey][monthKey] = monthData;
                        continue;
                    }
                    //change & math new data
                    monthData = financeData[monthKey];
                    monthData.expensesSum = 0;
                    for (i in monthData.expenses) {
                        monthData.expensesSum += monthData.expenses[i];
                    }
                    monthData.influenceSum = 0;
                    for (i in monthData.influence) {
                        monthData.influenceSum += monthData.influence[i];
                    }
                    data[yearKey][monthKey] = monthData;
                }
                return data;
            }

            createCharts = function(financeData) {
                var i, i2, year, monthData, chart, chars, dataSerie, balance;
                chars = {};
                for (i in financeData) {
                    chars[i] = {};
                }
                //create expenses vs influence chart
                for (i in financeData) {
                    year = financeData[i]
                    chart = chartUnit.createBarChart([
                        "przychody",
                        "wydatki"
                    ]);
                    for (i2 in year) {
                        monthData = year[i2];
                        dataSerie = chartUnit.createDataSerie([
                            monthData.expensesSum,
                            monthData.influenceSum
                        ], i2);
                        chart.data.data.push(dataSerie);
                    }
                    chars[i].exinChart = chart;
                }
                //create measures chart
                balance = 0;
                for (i in financeData) {
                    year = financeData[i]
                    chart = chartUnit.createBarChart([
                        "stan konta"
                    ]);
                    for (i2 in year) {
                        monthData = year[i2];
                        balance = monthData.balance ? monthData.balance : balance;
                        dataSerie = chartUnit.createDataSerie([
                            balance
                        ], i2);
                        chart.data.data.push(dataSerie);
                    }
                    chars[i].balanceChart = chart;
                }
                return chars;
            }

            //math finance for current data
            mathFinance = function() {
                var promise;
                promise = $http({method: 'GET', url: 'resources/data/finance.json'});
                promise.success(function(data, status, headers, config) {
                    //response when ok
                    console.log(data);
                    financeData = decodeFinanceData(data);
                    $scope.financeData = financeData;
                    $scope.chars = createCharts(financeData);
                });
                promise.error(function(data, status, headers, config) {
                    //response when error
                });
            }
            //math
            mathFinance();
        }]);
});