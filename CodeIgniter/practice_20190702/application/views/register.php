<?php include("_site_header.php"); ?>

<?php  if (isset($errorMessage1)){?>
	<div class="alert alert-error">
        <?=$account?>
		<?=$errorMessage1?>
	</div>
<?php }?>


<?php  if (isset($errorMessage2)){?>
	<div class="alert alert-error">
        <?=$account?>
		<?=$errorMessage2?>
	</div>
<?php }?>

<?php  if (isset($errorMessage3)){?>
	<div class="alert alert-error">
        <?=$account?>
		<?=$errorMessage3?>
	</div>
<?php }?>



<div class="container home">
    <?php include("_content_nav.php"); ?>

    <!--<form action="<?=site_url("/user/registering")?>" method="get"  > --->
    <form action="<?=site_url("/user/registering")?>" method="post"  >
        <table class="table table-bordered">
            <tr>
                <td>
                    Account
                </td>
                <td>
                    <?php if(isset($account)){ ?>
                        <input type="text" name="account" value="<?=htmlspecialchars($account)?>" />
                    <?php }else{ ?>
                        <input type="text" name="account" />
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>
                    Password
                </td>
                <td>
                    <input type="password" name="password" />
                </td>
            </tr>
            <tr>
                <td>
                    Re-type Password
                </td>
                <td>
                    <input type="password" name="passwordrt" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="送出" class="btn" />
                </td>
            </tr>
        </table>
    </form>
</div>

<?php include("_site_footer.php"); ?>