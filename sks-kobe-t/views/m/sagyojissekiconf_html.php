<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
        <h2>作業報告詳細</h2>

        <?php print($common->html_display($staff->oup_m_staff_name[0])); ?>　さん<br /><br /><?php print(date('Y/m/d')) ?> (<?php print($common->html_display($week[$w])); ?>) <?php print($run_end_time); ?><br /><br />訪問作業終了<br /><br />
        作業時刻　<?php print(substr($work->oup_t_work_run_start_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_run_start_time[0],2,2)); ?> － <?php print($run_end_time); ?><br />
        作業時間　<?php print(intval(substr($run_end_time,0,2)) * 60 + intval(substr($run_end_time,3,2)) - intval(substr($work->oup_t_work_run_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_run_start_time[0],2,2))); ?> 分<br /><br /><br />
<?php if (count($work2->oup_t_work_plan_service_no) == 0) { ?>
        <?php for($i=0;$i<count($worktype->oup_m_work_type_kbn);$i++) { ?><?php print($common->html_display($worktype->oup_m_work_type_content[$i])); ?>　<?php print($T[$i]); ?>分<br /><?php } ?><br />
<?php } else { ?>
<?php for($i=0;$i<count($work2->oup_t_work_plan_service_no);$i++) { ?><?php print($work2->oup_t_work_plan_content[$i]); ?>　<?php print($T[$i]); ?> 分<br /><?php } ?><?php } ?>
        <?php if ($move_cost_yen != "") { ?>交通費　<?php print($move_cost_yen); ?> 円<br /><?php } ?><?php if ($move_cost_kilo != "") { ?>移動距離　<?php print($move_cost_kilo); ?> km<br /><?php } ?><?php if ($move_cost_etc != "") { ?>その他　<?php print($common->html_display($move_cost_etc)); ?><?php } ?><br /><br />
        <?php print($common->html_display($comment)); ?>
<br />
<br />
      <form name="frm" method="POST" action="sagyojissekiconf.php">
        <input type="submit" value="登録します">
        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>
<br />

      <form name="frm2" method="POST" action="sagyojissekikomento.php">
        <input type="submit" value="戻る">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>
    <br />

  </body>
</html>
