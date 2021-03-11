<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
      <form name="frm" method="POST" action="menu.php">
        <input type="submit" value="最初の画面に戻ります">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>
      <br />

        <?php print($common->html_display($stf->oup_m_staff_name[0])); ?>　さん<br /><br /><?php print(date('m/d')) ?> (<?php print($common->html_display($week[$w])); ?>) <b><?php print($run_end_time); ?></b><br /><br />
        作業時刻　<?php print(substr($work->oup_t_work_run_start_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_run_start_time[0],2,2)); ?>-<?php print($run_end_time); ?>
        (<?php print(intval(substr($run_end_time,0,2)) * 60 + intval(substr($run_end_time,3,2)) - intval(substr($work->oup_t_work_run_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_run_start_time[0],2,2))); ?> 分)<br />
<?php print($work->oup_t_work_service_content[0]); ?>　<?php print($T[0]); ?> 分<br />
        <?php if ($move_cost_yen != "") { ?>交通費　<?php print($move_cost_yen); ?> 円<br /><?php } ?><?php if ($move_cost_kilo != "") { ?>移動距離　<?php print($move_cost_kilo); ?> km<br /><?php } ?><?php if ($move_cost_etc != "") { ?>その他　<?php print($common->html_display($move_cost_etc)); ?><?php } ?><br />
        <?php print($common->html_display($comment)); ?>
<br />
      上記の内容で登録は正しく終了しました。<br />おつかれさまでした。
      <br />
      <br />

  </body>
</html>
