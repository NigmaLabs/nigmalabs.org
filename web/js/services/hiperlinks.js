define(['./module'], function(module) {
    'use strict';

    module.service('dateUnit', [function() {
            this.addMonths = function(dateObj, num) {
                var currentMonth = dateObj.getMonth() + dateObj.getFullYear() * 12;
                dateObj.setMonth(dateObj.getMonth() + num);
                var diff = dateObj.getMonth() + dateObj.getFullYear() * 12 - currentMonth;
                if (diff != num) {
                    dateObj.setDate(0);
                }
                return dateObj;
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