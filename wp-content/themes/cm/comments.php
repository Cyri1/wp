<?php if (have_comments()) : ?>
	<div class="accordion my-3 " id="accordionExample">
		<div class="accordion-item">
			<h2 class="accordion-header" id="headingOne">
				<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					<?php comments_number(); ?>
				</button>
			</h2>
			<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
				<div class="accordion-body">
					<?php wp_list_comments(array('callback' => 'bootstrap_comment')); ?>
					<?php tm_comments_pagination() ?> </div>
			</div>
		</div>
	</div>


<?php
elseif (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) :
?>

	<p>
		<?= 'Les commentaires sont fermés.' ?>
	</p>

<?php endif; ?>

<?php

ob_start();
$commenter = wp_get_current_commenter();
$req = true;
$aria_req = ($req ? " aria-required='true'" : '');

$comments_arg = array(
	'form'	=> array(
		'class' => 'form-horizontal'
	),
	'fields' => apply_filters('comment_form_default_fields', array(
		'autor' 				=> '<div class="mb-3">' . '<label for="author">' . 'Nom' . '</label> ' . ($req ? '<span>*</span>' : '') .
			'<input id="author" name="author" class="form-control" type="text" value="" size="30"' . $aria_req . ' />' .
			'<p id="d1" class="text-danger"></p>' . '</div>',
		'email'					=> '<div class="mb-3">' . '<label for="email">' . 'Email' . '</label> ' . ($req ? '<span>*</span>' : '') .
			'<input id="email" name="email" class="form-control" type="text" value="" size="30"' . $aria_req . ' />' .
			'<p id="d2" class="text-danger"></p>' . '</div>',
		'url'					=> ''
	)),
	'comment_field'			=> '<div class="mb-3">' . '<label for="comment">' . 'Commentaire' . '</label><span>*</span>' .
		'<textarea id="comment" class="form-control" name="comment" rows="3" aria-required="true"></textarea><p id="d3" class="text-danger"></p>' . '</div>',
	'comment_notes_after' 	=> '',
	'class_submit'			=> 'btn btn-primary'
); ?>
<?php comment_form($comments_arg);
echo str_replace('class="comment-form"', 'class="comment-form" name="commentForm" onsubmit="return validateForm();"', ob_get_clean());
?>

<script>
	function validateForm() {
		var form = document.forms.commentForm,
			x = form.author.value,
			y = form.email.value,
			z = form.comment.value,
			flag = true,
			d1 = document.getElementById("d1"),
			d2 = document.getElementById("d2"),
			d3 = document.getElementById("d3");

		if (x === null || x === "") {
			d1.innerHTML = "<?= 'Veuillez remplir le nom.' ?>";
			flag = false;
		} else {
			d1.innerHTML = "";
		}

		if (y === null || y === "") {
			d2.innerHTML = "<?= 'Veuillez remplir l\'email.' ?>";
			flag = false;
		} else {
			d2.innerHTML = "";
		}

		if (z === null || z === "") {
			d3.innerHTML = "<?= 'Veuillez remplir le commentaire.' ?>";
			flag = false;
		} else {
			d3.innerHTML = "";
		}

		return flag;
	}
</script>


</div>