<?php get_header();?>
<div class="container-fluid" ng-app='alain'>
  
  <section class="row">

    <aside ng-controller="FacebookController" class="col-md-4 col-md-offset-4" ng-show="feed">

        <h2>En Facebook</h2>
        <h5 class="lead">
          <strong>
            {{about.likes}}
          </strong> likes y <strong>{{about.talking_about_count}}</strong> hablando de <a href="{{post.link}}">Alain</a>
        </h5>
        <hr>

        <div ng-repeat="post in feed" ng-show="post.message">
  
          <h3>
            <a href="{{about.link}}">
              {{post.from.name}}
            </a>
            <small class="text-muted">
              {{post.updated_time | date:'MMM d, y h:mm a'}}
            </small>
          </h3>

          <p class="lead">{{post.message}}</p>

          <p class="text-muted text-right">
            <i class="fa fa-thumbs-up"></i> {{post.likes.data.length}}
            <a href="Javascript:;" ng-click="showComments = !showComments">
              <i class="fa fa fa-comments"></i> {{post.comments.data.length}}
            </a>
           </p>

          <a href="http://facebook.com/{{post.id}}" target="_blank">
            <img ng-src="{{post.picture}}" class="img-responsive" ng-show="moreData">
            <img ng-src="{{post.moreData.images[0].source}}" class="img-responsive" ng-hide="moreData">            
          </a>

          <ul ng-show="showComments" class="list-group">
          <li ng-repeat="comment in post.comments.data" class="list-group-item text-small">
            {{comment.message}}<br>
            <em class="text-small">–{{comment.from.name}}</em>
          </li>
          </ul>
          <hr>
  
        </div>
  
    </aside>

    <aside ng-controller="TwitterController" class="col-md-4" ng-show="feed">

      <h2>En Twitter</h2>
      <h5 class="lead">
        <strong>
          {{about.followers_count}}
        </strong> seguidores escuchando a <a href="http://twitter.com/{{about.screen_name}}" target="_blank">Alain</a>
      </h5>
      <hr>

      <div ng-repeat="post in feed">

        <div class="row">
          <div class="col-xs-2 text-center">
            <img ng-src="{{post.user.profile_image_url}}" style="display:inline;" class="img-rounded img-responsive">
          </div>
            
          <div class="col-xs-9">
            <h3 style="margin-top: 0;">
              <a href="http://twitter.com/{{user.screen_name}}" target="_blank">
                {{post.user.name}}
              </a>
              <small class="text-muted">@{{post.user.screen_name}}</small>              
            </h3>
            <p class="lead" style="margin-bottom:0;">
              <span ng-bind-html='post.text | linky'></span>
              <br>
            </p>
            <h3 class="text-muted" style="margin-top:0;"><small>{{formatDate(post.created_at)}}</small></h3>
          </div>
        </div>
        <hr>

      </div>

    </aside>
  
  </section>
</div>

<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular-sanitize.min.js"></script>
<script>
  var fbData = <?php echo fb_feed();?>;
</script>
<script>
  var twData = <?php echo twitter_feed();?>;
</script>

<script>
var App = angular.module('alain',['ngSanitize']);

App.controller('FacebookController', function($scope) {

  $scope.feed = fbData.feed.data;
  $scope.about = fbData.about;

  console.log(fbData);

});

App.controller('TwitterController', ['$scope','$filter', function($scope, $filter) {

  $scope.feed = twData;
  $scope.about = twData[0].user;

  $scope.formatDate = function (dateString){
    var date = Date.parse(dateString);
    date = $filter('date')(date, 'MMM d h:mm a');
    return date;
  };

  console.log($scope.feed);
}]);
</script>

<?php get_footer();?>