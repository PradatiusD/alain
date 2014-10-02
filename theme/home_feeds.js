var App = angular.module('alain',['ngSanitize','twitterFilters']);

App.controller('FacebookController', function($scope) {

  $scope.feed = fbData.feed.data;
  $scope.about = fbData.about;

  console.log({'facebook':fbData});

});

App.controller('TwitterController', ['$scope','$filter', function($scope, $filter) {

  $scope.feed = twData;
  $scope.about = twData[0].user;

  $scope.formatDate = function (dateString){
    var date = Date.parse(dateString);
    date = $filter('date')(date, 'MMM d h:mm a');
    return date;
  };

  console.log({'twitter': twData});
}]);

App.controller('YoutubeController', function($scope, $sce) {

  $scope.feed = ytData;

  $scope.videoURL = function(src) {
    return $sce.trustAsResourceUrl('//www.youtube.com/embed/'+src);
  };

  console.log({'youtube':ytData});

});

App.directive('fancybox', function() {
  return {
    template: '<a href="//www.youtube.com/embed/{{video.id.videoId}}?autoplay=1" data-fancybox-type="iframe" class="imgHolder">'+
                '<img ng-src="{{video.snippet.thumbnails.high.url}}" class="img-responsive">'+
                '<i class="fa fa-play fa-3x"></i>'+
              '</a>',
    link: function (scope, element) {
      var $ = jQuery;
      $(element).find('a').fancybox();
    }
  };
});