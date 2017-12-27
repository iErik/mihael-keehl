<?php use Roots\Sage\Titles; ?>

<?php if (post_password_required()) { return; } ?>

<div id="comments" class="comments-area">
  <div class="comments-heading">
    <h2 class="heading"><?php Titles\comments_title(); ?></h2>
  </div>

  <?php if ( have_comments() ): ?>
    <ul class="comment-list">
      <?php wp_list_comments([ 'avatar_size' => 45 ]); ?>
    </ul>
  <?php endif ?>

  <?php comment_form(); ?>
</div>
