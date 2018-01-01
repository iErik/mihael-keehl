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

  <?php if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>
    <div class="pagination comments-pagination">
      <?php previous_comments_link( __('Older Comments', 'mihael-keehl') ); ?>
      <?php next_comments_link( __('Newer Comments', 'mihael-keehl') ); ?>
    </div>
  <?php endif; ?>

  <?php comment_form(); ?>
</div>
