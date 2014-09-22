define(['./module'], function(module) {
    'use strict';
    module.service('chartUnit', [function() {
            this.createDataSerie = function(y, x, tooltip) {
                return {
                    "x": x,
                    "y": y,
                    "tooltip": tooltip ? tooltip : x
                };
            }
            this.createBarChart = function(series) {
                return {
                    type: 'bar',
                    config: {
                        title: '',
                        tooltips: true,
                        labels: false,
                        mouseover: function() {
                        },
                        mouseout: function() {
                        },
                        click: function() {
                        },
                        legend: {
                            display: true,
                            //could be 'left, right'
                            position: 'right'
                        },
                        innerRadius: 0, // applicable on pieCharts, can be a percentage like '50%'
                        lineLegend: 'lineEnd' // can be also 'traditional'
                    },
                    data: {
                        "series": series ? series : [],
                        "data": []
                    }
                };

            }
            this.monthStr = function(date) {
                var year, month, dateStr;
                year = date.getFullYear().toString();
                month = date.getMonth() + 1;
                month = (month <= 9) ? '0' + month : month.toString();
                return year + '-' + month;
            }
        }]);
});