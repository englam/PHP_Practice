<?php include("_site_header.php"); ?>

<div class="container home">

    <?php include("_content_nav.php"); ?>

	<div class="alert alert-success">
		恭喜你 （<?=$account?>），你已經完成註冊，
		接下來馬上到登入頁面去試試看吧！
		<a href="<?=site_url("user/login")?>">登入</a>
	</div>
</div>

<?php include("_site_footer.php"); ?>