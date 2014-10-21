<section class="row">
  <div class="col-md-8">
    <p class="lead">
      <?php echo types_render_field('interview-date',array());?>    
      <h4>
        Mas información: <?php echo types_render_field('link',array());?>
      </h4>

      <h4>
       Video:<?php echo types_render_field('youtube-video',array());?>
      </h4>

    </p>
  </div>
  <div class="col-md-4">
    <?php 
      if (has_post_thumbnail()) {
        the_post_thumbnail('full',array('class' => 'img-responsive','style'=>'width:100%'));
      }
    ?>
    <?php 
      echo types_render_field( "audio", array(
        "autoplay" => "on",
        "preload" => "on"
      ));
    ?>
  </div>
</section>
<div class="row">
  <section class="interview-body col-md-12">
    <br>
    <?php the_content('Read more...'); ?>
  </section>  
</div>
