<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>
  <body>
        <h2>作業実績入力</h2>

<?php // var_dump($_SESSION); ?>

      <form name="frm" method="POST" action="../controllers/sagyojissekiinput.php">
          <?php print($common->html_display($staff->oup_m_staff_name[0])); ?>　さん<br /><br /><?php print(date('Y/m/d')) ?> (<?php print($week[$w]); ?>) <?php print(date('H:i')); ?><br /><br />作業終了
<br />
<br />
      作業時刻　<?php print(substr($work->oup_t_work_run_start_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_run_start_time[0],2,2)); ?> － <?php print($run_end_time); ?><br />作業時間　<?php print(intval(substr($run_end_time,0,2)) * 60 + intval(substr($run_end_time,3,2)) - intval(substr($work->oup_t_work_run_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_run_start_time[0],2,2))); ?> 分
<br />
<br />

        <input type="submit" value="作業入力に進みます">
        <br />
        <br />
        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <INPUT type="hidden" name="run_end_time" value="<?php print(date('H:i')); ?>">
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

      <form name="frm2" method="POST" action="menu.php">
        <input type="submit" value="戻る">
        <br />
        <br />
        <INPUT type="hidden" name="run_end_time" value="<?php print(date('H:i')); ?>">
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

  </body>
</html>
