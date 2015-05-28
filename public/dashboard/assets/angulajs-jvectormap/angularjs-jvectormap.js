angular.module('angular-jvectormap', []).directive('jvmap', function() {
  return {
    restrict: 'EA',
    template: '<div></div>',
    scope: {
      options: '='
    },
    link: function(scope, element, attrs) {
      var chart = null;

      scope.$watch("options" , function(n,o) {
        if(!chart){
          chart = $(element).vectorMap(scope.options);
        }
      });

      // destroy map
      element.on('$destroy', function () {
        if(chart){
          chart.vectorMap('get', 'mapObject').remove();
        }
      });  
    }
  };
});