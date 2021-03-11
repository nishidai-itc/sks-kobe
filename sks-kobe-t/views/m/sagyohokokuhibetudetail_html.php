<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
      <h2>日別作業報告詳細</h2>

          <?php print(substr($work_day,0,4)."/".substr($work_day,4,2)."/".substr($work_day,6,2)); ?> (<?php print($common->html_display($week[$w])); ?>)
<br />
<br />

<?php for($i=0;$i<count($work->oup_t_work_no);$i++) { ?>
      <form name="frm" method="POST" action="sagyohokokuhibetudetail.php">
          <input type="submit" value="<?php print($common->html_display($work->oup_t_work_user_name[$i])); ?> さん <?php print(substr($work->oup_t_work_run_start_time[$i],0,2)); ?>:<?php print(substr($work->oup_t_work_run_start_time[$i],2,2)); ?> － <?php if ($work->oup_t_work_stop_kbn[$i]=="0") { ?><?php print("作業中"); ?><?php } elseif ($work->oup_t_work_stop_kbn[$i]=="1") { ?><?php print("作業中止"); ?><?php } elseif ($work->oup_t_work_stop_kbn[$i]=="2") { ?><?php print("休暇連絡"); ?><?php } else { ?><?php print(substr($work->oup_t_work_run_end_time[$i],0,2)); ?>:<?php print(substr($work->oup_t_work_run_end_time[$i],2,2)); ?><?php } ?>">
        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="2">
        <INPUT type="hidden" name="work_no" value="<?php print($work->oup_t_work_no[$i]); ?>">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>
<?php } ?>
      <br />

      <form name="frm" method="POST" action="sagyohokokulist.php">
        <input type="submit" value="戻る">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>
<br />
<br />

  </body>
</html>
