<!DOCTYPE html>
<html >
<head>
	<meta charset="utf-8">
	<title>發文系統 - 會員註冊</title>
    <link rel="stylesheet" href="<?=base_url("/css/bootstrap.min.css")?>">
    <link rel="stylesheet" href="<?=base_url("/css/bootstrap-responsive.min.css")?>">
</head>
<body>



<div class="container">
    <form action="<?=site_url("/user/registering")?>" method="post"  >
        <?php  if (isset($errorMessage)){?>

            <div class="alert alert-error">
                <?= $errorMessage ?>
            </div>

		<?php }?>

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

</body>
</html>