<?php get_header();?>
<div class="container-fluid" ng-app='alain'>
  
  <!-- Slider -->
  <section class="homepage-slider">
    <?php
    if (function_exists('soliloquy')){
      soliloquy('homepage-slider','slug');
    }
    ?>
    
  </section>
  <!-- End Slider -->

  <!-- Begin showings -->
  <section class="row">
    <h2 class="text-center header">Escucha a Alain</h2>
    <hr>
    <?php
      $showings_query = new WP_Query(array('post_type' => 'showing'));

      if ($showings_query->have_posts()):
        while ( $showings_query->have_posts()):
          $showings_query->the_post();
          $custom = get_post_custom();
      ?>
          <article class="col-md-3">
            <h3><?php echo get_the_title();?></h3>
            <h5><?php echo $custom['wpcf-showing-time'][0];?> en <?php echo $custom['wpcf-location'][0];?></h5>
            <p class="lead">
              <?php echo $custom['wpcf-description'][0];?>
            </p> 
          </article>
      <?php
        endwhile;
      endif;
    ?>
    <aside class="col-md-6">
      <article class="book-sale row">
        <div class="col-sm-3">
          <img src="<?php echo get_stylesheet_directory_uri();?>/img/book.jpg" style="max-width:127px;">        
        </div>
        <div class="col-sm-9">
          <div class="book-description">
            <h3>El libro que explica su historia</h3>
            <p>Este cuento describe una conmovedora historia autobiográfica sobre las experiencias paranormales de Alain desde su nacimiento hasta su programa reciente de television "Alain Una Mano Amiga" y por sus impresionantes aciertos en programas de radio y televisión.</p>
            <a href="http://www.amazon.com/Alain-El-Clarividente-Spanish-Edition/dp/1502557983/ref=sr_1_1?ie=UTF8&qid=1414461322&sr=8-1&keywords=alain+pupo" target="_blank" class="btn btn-default btn-lg">
              Explora el libro
            </a>
          </div>          
        </div>
      </article>
    </aside>
  </section>

  <!-- End showings -->

  <section class="row feeds">

    <h2 class="text-center header">Conectate con Alain</h2>
    <hr>

    <aside ng-controller="YoutubeController" class="col-sm-4" ng-show="feed">

      <header class="text-center feed-header">
        <h2><i class="fa fa-youtube"></i></h2>
        <h5 class="lead">
          Sea Testigo de <a href="https://www.youtube.com/results?search_query=alain+pupo" target="_blank">Alain</a>
        </h5>
      </header>
      <hr>

      <article ng-repeat="video in feed" class="feed-body">
        <div class="row">
          <div class="col-md-12">
            <p class="lead">
              {{video.snippet.title}}
              <small class="text-muted">
                {{video.snippet.publishedAt | date:'MMM d, y h:mm a'}}
              </small>
            </p>
            <div fancybox></div>
          </div>          
        </div>
        <hr>
      </article>
      
    </aside>

    <aside ng-controller="FacebookController" class="col-sm-4" ng-show="feed">

        <header class="text-center feed-header">
          <h2><i class="fa fa-facebook"></i></h2>
          <h5 class="lead">
            <strong>
              {{about.likes}}
            </strong> likes y <strong>{{about.talking_about_count}}</strong> hablando de <a href="http://facebook.com/alain.pupo" target="_blank">Alain</a>
          </h5>
        </header>
        <hr>

        <article ng-repeat="post in feed" ng-show="post.message" class="feed-body">
  
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
  
        </article>
  
    </aside>

    <aside ng-controller="TwitterController" class="col-sm-4" ng-show="feed">

      <header class="text-center feed-header">
        <h2><i class="fa fa-twitter"></i></h2>
        <h5 class="lead">
          <strong>
            {{about.followers_count}}
          </strong> seguidores escuchando a <a href="http://twitter.com/{{about.screen_name}}" target="_blank">Alain</a>
        </h5>
      </header>
      <hr>

      <article ng-repeat="post in feed" class="feed-body">

        <div class="row">
          <div class="col-xs-2 text-center">
            <img ng-src="{{post.user.profile_image_url}}" style="display:inline;" class="img-rounded img-responsive">
          </div>
            
          <div class="col-xs-10">
            <h3 style="margin-top: 0;">
              <a href="http://twitter.com/{{user.screen_name}}" target="_blank">
                {{post.user.name}}
              </a>
              <small class="text-muted">@{{post.user.screen_name}}</small>
            </h3>
            <p class="lead" style="margin-bottom:0;">
              <span ng-bind-html="post.text | tweet"></span>
              <br>
            </p>
            <h3 class="text-muted" style="margin-top:0;"><small>{{formatDate(post.created_at)}}</small></h3>
          </div>
        </div>
        <hr>

      </article>

    </aside>
  
  </section>
</div>

<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular-sanitize.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/lib/homepage-dependencies.min.js';?>"></script>
<script>
  var fbData = <?php echo fb_feed();?>;
</script>
<script>
  var twData = <?php echo twitter_feed();?>;
</script>
<script>
  var ytData = <?php echo youtube_feed();?>;
</script>
<script src="<?php  echo get_stylesheet_directory_uri() . '/home_feeds.js';?>"></script>

<?php get_footer();?>