<?php include("_site_header.php"); ?>
<!--<?php print_r($_SESSION); ?>-->
<div class="container">
	<?php include("_content_nav.php") ?> 
	<div class="content">
		<form action="<?=site_url("user/logining")?>" method="post" > 

        

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

        <?php  if (isset($errorMessage4)){?>
            <div class="alert alert-error">
                <?=$account?>
                <?=$errorMessage4?>
            </div>
        <?php }?>



			<table>
				<tr>
					<td>帳號</td>
					<?php if(isset($account)){ ?>
						<td><input type="text" name="account" value="<?=htmlspecialchars($account)?>" /></td>
					<?php }else{ ?>
						<td><input type="text" name="account" /></td>
					<?php } ?>
				</tr>

				<tr>
					<td> 密碼 </td>
					<td><input type="password" name="password" /></td>
				</tr>

				<tr>
					<td colspan="2"> 
						<a href="<?=site_url("/")?>">取消</a>
						<input type="submit" class="btn" value="送出" />
					</td>
				</tr>

			</table>
		</form>
	</div>
</div>


<?php include("_site_footer.php"); ?>