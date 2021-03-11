<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
        <h2>作業報告詳細</h2>

            利用者　<?php print($common->html_display($user->oup_m_user_name[0])); ?> 様<br />
            <?php print($common->html_display(substr($work->oup_t_work_run_start_date[0],0,10))) ?> (<?php print($common->html_display($week[$w])); ?>)<br />
            作業時間　<?php print(substr($work->oup_t_work_run_start_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_run_start_time[0],2,2)); ?> から<?php if ($work->oup_t_work_stop_kbn[0]=="0") { ?><?php print("作業中"); ?><?php } elseif ($work->oup_t_work_stop_kbn[0]=="1") { ?><?php print("作業中止"); ?><?php } elseif ($work->oup_t_work_stop_kbn[0]=="2") { ?><?php print("休暇連絡"); ?><?php } else { ?><?php print(substr($work->oup_t_work_run_end_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_run_end_time[0],2,2)); ?><?php } ?><br />
            <?php if ($company->oup_m_company_simple_kbn[0] != "1") { ?>時間数　<?php print($work->oup_t_work_run_time[0]) ?>分<br /><?php } ?><br />
            <?php print($common->html_display($work->oup_t_work_service_content[0])); ?>　<?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?>分<br /><br /><br />
            <?php if ($work->oup_t_work_move_cost_yen[0] != "") { ?>交通費　<?php print($work->oup_t_work_move_cost_yen[0]) ?> 円<br /><?php } ?>
            <?php if ($work->oup_t_work_move_cost_kilo[0] != "") { ?>移動距離　<?php print($work->oup_t_work_move_cost_kilo[0]); ?> km<br /><?php } ?>
            <?php if ($work->oup_t_work_move_cost_etc[0] != "") { ?>その他　<?php print($work->oup_t_work_move_cost_etc[0]); ?><br /><br /><?php } ?>
            <?php print($common->html_display($work->oup_t_work_comment[0])); ?>
<br />
<br />
        <form name="frm" method="POST" action="sagyohokokudetail.php">
<?php if ($common->html_display($company->oup_m_company_disp_work_modified[0]) == "1") { ?>
          <input type="submit" value="修正します">
<br />
<?php } ?>
<br />
        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />

        </form>
<br />
<br />
        <form name="frm1" method="POST" action="sagyohokokuhibetudetail.php">
          <input type="submit" value="戻る">
        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
        </form>
  </body>
</html>
