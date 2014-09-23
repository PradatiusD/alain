<?php get_header();?>
<div class="container-fluid" ng-app='alain'>
  
  <section class="row">
  
    <div ng-controller="FacebookController" class="col-md-4 col-md-offset-4" ng-show="fbData">
        <div ng-repeat="post in fbData" ng-show="post.message">
          <h3>{{post.from.name}} <small class="text-muted">{{post.updated_time | date:'MMM d, y h:mm a'}}</small></h3>
          <p class="lead">{{post.message}}</p>
          <p class="text-muted">Likes {{post.likes.data.length}} | Comentarios {{post.comments.data.length}}</strong>
          <img ng-src="{{post.picture}}" class="img-responsive">
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
  $scope.fbData = fbData.data;
  console.log(fbData);
});
</script>

<?php get_footer();?>