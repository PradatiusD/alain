<?php get_header();?>
<div class="container-fluid" ng-app='alain'>
  
  <section class="row">

    <div ng-controller="FacebookController" class="col-md-4 col-md-offset-4" ng-show="feed">

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
  
    </div>
  
  </section>
</div>

<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
<script>
  var fbData = <?php echo fb_feed();?>;
</script>

<script>
var App = angular.module('alain',[]);

App.controller('FacebookController', function($scope) {

  $scope.feed = fbData.feed.data;
  $scope.about = fbData.about;

  console.log(fbData);

});
</script>

<?php get_footer();?>