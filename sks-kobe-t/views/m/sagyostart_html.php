<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
        <h2>利用者名確認</h2>

          <?php print($common->html_display($staff->oup_m_staff_name[0])); ?>　さん<br /><br /><?php print(date('Y/m/d')) ?> (<?php print($week[$w]); ?>)  <?php print(date('H:i')); ?><br /><br />作業準備中<br />
<br />

      <form name="frm1" method="POST" action="sagyostart.php">
        <input type="submit" value="作業を開始します">
        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <INPUT type="hidden" name="rest_reason" value="">
        <INPUT type="hidden" name="run_start_time" value="<?php print($run_start_time); ?>">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
<?php /* ?>
    <?php if ($common->career == "docomo") { ?>
        <INPUT type="hidden" name="ido" value="<?php print($common->dms2Deg($_REQUEST['lat'],$common->career)); ?>">
        <INPUT type="hidden" name="keido" value="<?php print($common->dms2Deg($_REQUEST['lon'],$common->career)); ?>">
    <?php } elseif ($common->career == "softbank") { ?>
		<?php preg_match("/N([\d\.]+)E([\d\.]+)$/", $_REQUEST['pos'], $m); ?>
        <INPUT type="hidden" name="ido" value="<?php print($common->localdeg($m[1])); ?>">
        <INPUT type="hidden" name="keido" value="<?php print($common->localdeg($m[2])); ?>">
    <?php } else { ?>
<?php */ ?>
        <INPUT type="hidden" name="ido" value="">
        <INPUT type="hidden" name="keido" value="">
<?php /* ?>
    <?php } ?>
<?php */ ?>
      </form>
<br />
<br />

      利用者様の都合等で作業出来ない場合、理由を入れて中止を押してください
<br />
<br />

      <form name="frm2" method="POST" action="sagyostart.php">
          理由
        <br />
          <textarea name="rest_reason" rows="3" istyle="1" format="M" mode="hiragana"></textarea>
        <br />
        <br />
      <?php /* アクションフラグ */ ?>
      <INPUT type="hidden" name="act" value="2">
        <INPUT type="hidden" name="run_start_time" value="<?php print($run_start_time); ?>">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
<?php /* ?>
    <?php if ($common->career == "docomo") { ?>
        <INPUT type="hidden" name="ido" value="<?php print($common->dms2Deg($_REQUEST['lat'],$common->career)); ?>">
        <INPUT type="hidden" name="keido" value="<?php print($common->dms2Deg($_REQUEST['lon'],$common->career)); ?>">
    <?php } elseif ($common->career == "softbank") { ?>
		<?php preg_match("/N([\d\.]+)E([\d\.]+)$/", $_REQUEST['pos'], $m); ?>
        <INPUT type="hidden" name="ido" value="<?php print($common->localdeg($m[1])); ?>">
        <INPUT type="hidden" name="keido" value="<?php print($common->localdeg($m[2])); ?>">
    <?php } else { ?>
<?php */ ?>
        <INPUT type="hidden" name="ido" value="">
        <INPUT type="hidden" name="keido" value="">
<?php /* ?>
    <?php } ?>
<?php */ ?>

        <input type="submit" value="中止">
      </form>

<br />
<br />
      <form name="frm3" method="POST" action="user_list.php">
        <input type="submit" value="戻る">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>
    <br />
    <br />

  </body>
</html>
