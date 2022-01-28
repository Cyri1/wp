<?php
if (!function_exists('bootstrap_comment')) {
	function bootstrap_comment($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;
?>
		<?php if ($comment->comment_approved == '1') : ?>
			<li class="list-unstyled mt-2">
				<div class="d-flex">
					<?php echo get_avatar($comment, 30, 'mm'); ?>
					<div class="ms-3"><strong><?= $comment->comment_author ?></strong></div>
					<div class="ms-3"><?php edit_comment_link() ?></div>
				</div>
				<div class="d-flex flex-column">
					<time class="font-italic font-weight-light"><small><?php comment_date('d/m/y - H:i') ?></small></time>
					<?= get_comment_text() ?>
					<?= get_comment_reply_link(
						array_merge(
							$args,
							array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '<span class="comment-reply mb-2">',
								'after'     => '</span>',
							)
						)
					); ?>
				</div>
	<?php endif;
	}
}
	?>