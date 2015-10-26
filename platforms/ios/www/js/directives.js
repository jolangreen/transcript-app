angular.module('starter.directives', [])

module.directive('dynamicHeight', function() {
    return {
        require: ['ionSlideBox'],
        link: function(scope, elem, attrs, slider) {
            scope.$watch(function() {
                return slider[0].__slider.selected();
            }, function(val) {
                var newHeight = $('.slider-slide', elem).eq(val).innerHeight();
                if (newHeight) {
                    elem.animate({
                        height: newHeight + 'px'
                    }, 500);
                }
            });
        }
    };
});