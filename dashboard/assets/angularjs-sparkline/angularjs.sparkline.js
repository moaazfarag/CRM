// Requires jQuery from http://jquery.com/
// and jQuerySparklines from http://omnipotent.net/jquery.sparkline
 
// AngularJS directives for jquery sparkline
angular.module('sparkline', []);
 
angular.module('sparkline')
    .directive('spark', [function () {
        'use strict';
        return {
            restrict: 'A',
            require: 'ngModel',
            link: function (scope, elem, attrs, ngModel) {
 
                scope.$watch(attrs.ngModel, function () {
                    render();
                });
                
                scope.$watch(attrs.opts, function(){
                  render();
                }
                  );
                var render = function () {
                    var model;
                    var opts;

                    if(/\{|\[/g.test(attrs.opts))
                        opts = angular.fromJson(attrs.opts);
                    else
                        opts = scope[attrs.opts];

                    // Trim trailing comma if we are a string
                    angular.isString(ngModel.$viewValue) ? model = ngModel.$viewValue.replace(/(^,)|(,$)/g, "") : model = ngModel.$viewValue;
                    var data;
                    // Make sure we have an array of numbers
                    angular.isArray(model) ? data = model : data = model.split(',');
                    if(typeof $.fn.conSparkline !== 'undefined') {
                        $(elem).conSparkline(data, opts);
                    } else {
                        $(elem).sparkline(data, opts);
                    }
                };
            }
        }
    }]);