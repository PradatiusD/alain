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

      $query_args = array(
        'post_type' => 'showing',
        'paged' => 1,
        'posts_per_page' => 2
      );

      $showings_query = new WP_Query($query_args);

      if ($showings_query->have_posts()):
        while ( $showings_query->have_posts()):
          $showings_query->the_post();
          $custom = get_post_custom();
      ?>
          <article class="col-md-3">
            <h3><?php the_title();?></h3>
            <h5><?php echo types_render_field('showing-time', array()).' en '.types_render_field('location', array()); ?></h5>
            <p class="lead">
              <?php echo types_render_field('description', array());?>
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
            <p>Este libro recoge las primeras premoniciones del autor que se sirve de sus dones de clarividencia de manera constructiva poniendo en práctica sus extraordinarios poderes en funcion de quine lo necesite</p>
            <a href="http://www.amazon.com/Alain-El-Clarividente-Spanish-Edition/dp/1502557983/ref=sr_1_1?ie=UTF8&qid=1414461322&sr=8-1&keywords=alain+pupo" target="_blank" class="btn btn-default btn-lg">
              Explore el libro
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

      <section class="feed-body">
        <article ng-repeat="video in feed">
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
      </section>
      
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

        <section class="feed-body">
          <article ng-repeat="post in feed" ng-show="post.message">
    
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
        </section>

  
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

      <section class="feed-body">
        <article ng-repeat="post in feed">

          <div class="row">
            <aside class="col-xs-2 text-center">
              <img ng-src="{{post.user.profile_image_url}}" style="display:inline;" class="img-rounded img-responsive">
            </aside>
              
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
      </section>

    </aside>
  
  </section> <!-- End Feeds -->
</div>
<!-- Mailchimp form -->
<section class="container">
  <hr>
  <div class="row text-center">
    <div class="col-md-offset-2 col-md-8">

<!-- Begin MailChimp Signup Form -->
      <div id="mc_embed_signup">
        <form action="//alainpupo.us4.list-manage.com/subscribe/post?u=05bb174eec07042092be8b45f&amp;id=d130cabda6" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
          <div id="mc_embed_signup_scroll">
            <h1>Mantente al tanto de Alain</h1>
            <p>Adiciona tu correo elecronico a nuestra lista para que peudas mantenrete informado con anuncios de Alain.</p>

            <!-- <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
            <div class="mc-field-group">
              <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
              </label>
            </div> -->
            <div id="mce-responses" class="clear">
              <div class="response" id="mce-error-response" style="display:none"></div>
              <div class="response" id="mce-success-response" style="display:none"></div>
            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;"><input type="text" name="b_05bb174eec07042092be8b45f_d130cabda6" tabindex="-1" value=""></div>
            <div class="input-group">
              <input type="email" value="" name="EMAIL" class="required email form-control input-lg" id="mce-EMAIL">
              <span class="input-group-btn">
                <input type="submit" value="Añadir mi correo" name="subscribe" id="mc-embedded-subscribe" class="btn btn-lg btn-primary">
              </span>
            </div>
          </div>
        </form>
      </div>
<!--End mc_embed_signup-->
  <br><br>
  </div>
</section>
<!-- End mailchimp form -->

<script>
  var fbData = <?php echo fb_feed();?>;
</script>
<script>
  var twData = <?php echo twitter_feed();?>;
</script>
<script>
  var ytData = <?php echo youtube_feed();?>;
</script>

<?php get_footer();?>