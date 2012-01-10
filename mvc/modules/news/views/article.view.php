<?php $this->load->view('common/header.include.php'); ?>

	<article>
		<header>
			<h1><?php echo $article->title(); ?></h1>
		</header>
		<?php echo $article->content(); ?>
	</article>

<?php $this->load->view('common/footer.include.php'); ?>