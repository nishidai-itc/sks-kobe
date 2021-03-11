<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
        <h2>作業報告詳細</h2>

      <form name="frm" method="POST" action="../controllers/work_conf.php">

        利用者　<?php print($common->html_display($user->oup_m_user_name[0])); ?> さん<br /><br />
        <?php print($common->html_display($run_start_date_yy)); ?>年<?php print($common->html_display($run_start_date_mm)); ?>月<?php print($common->html_display($run_start_date_dd)); ?>日 (<?php print($common->html_display($week[$w])); ?>)<br />
        作業時間　<?php print($common->html_display($run_start_time_hh)); ?>:<?php print($common->html_display($run_start_time_mm)); ?> － <?php print($common->html_display($run_end_time_hh)); ?>:<?php print($common->html_display($run_end_time_mm)); ?><br />
        時間数　<?php print($common->html_display($run_time)); ?> 分<br /><br />
        <?php for($i=0;$i<count($worktype->oup_m_work_type_kbn);$i++) { ?><?php print($common->html_display($worktype->oup_m_work_type_content[$i])); ?>　<?php print($T[$i]); ?>分<br /><?php } ?><br /><br />
        交通費　<?php print($common->html_display($move_cost_yen)); ?> 円<br />
        移動距離　<?php print($common->html_display($move_cost_kilo)); ?> km<br />その他　<?php print($common->html_display($move_cost_etc)); ?><br /><br />
        <?php print($comment); ?>
<br />
<br />
<br />
          <input type="submit" value="登録します">
<br />
<br />
        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>

      <form name="frm" method="POST" action="<?php print($back); ?>">
          <input type="submit" value="戻る">
        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>
<br />
<br />

  </body>
</html>
