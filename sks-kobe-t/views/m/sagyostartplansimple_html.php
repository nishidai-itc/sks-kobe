<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>
  <body><br />
      <?php if ($sagyostart->errmsg != "") { ?>
          <p><font color="red"><?php print($sagyostart->errmsg); ?></font></p>
      <?php } ?>

      <?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん <br /><?php print(date('m/d')) ?> (<?php print($week[$w]); ?>) <b><?php print(substr($run_start_time,0,2)); ?>:<?php print(substr($run_start_time,3,2)); ?></b><br /><br />
      利用者 <?php print($common->html_display($user->oup_m_user_name[0])); ?> 様<br /><br />予定 <?php print(substr($work->oup_t_work_plan_start_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_plan_start_time[0],2,2)); ?>-<?php print(substr($work->oup_t_work_plan_end_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_plan_end_time[0],2,2)); ?> (<?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?>分)<br /><br />
<?php print($work->oup_t_work_service_content[0]); ?> <?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?>分<br />
      <?php if($work->oup_t_work_staff_memo[0] != "") { ?><br />スタッフメモ<br /><?php print($work->oup_t_work_staff_memo[0]); ?><?php } ?><?php if($work->oup_t_work_admin_memo[0] != "") { ?><br /><br />管理者メモ<br /><?php print($work->oup_t_work_admin_memo[0]); ?><?php } ?><?php if($work->oup_t_work_instruction_memo[0] != "") { ?><br /><br /><font color="red">指示内容</font><br /><?php print($work->oup_t_work_instruction_memo[0]); ?><?php } ?>
      <br />

      <form name="frm" method="POST" action="sagyostartplan.php">

        作業で気づいたことがあれば報告内容を入力してください<br />この報告内容は重要にﾁｪｯｸを入れると管理者にﾒｰﾙで送られます<br />
        <br />

        報告内容<label><input type="checkbox" name="alert_kbn" value="1"> 重要</label>
        <textarea name="rest_reason" rows="3"><?php print($work->oup_t_work_comment[0]); ?></textarea>
        <br />
        <br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="run_start_time" value="<?php print($run_start_time); ?>">
        <INPUT type="hidden" name="ido" value="">
        <INPUT type="hidden" name="keido" value="">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />

<?php if($company->oup_m_company_kiroku_kbn[0] == "1") { ?>
        <input type="submit" name="act" value="実施記録へ">
<?php } else { ?>
        <input type="submit" name="act" value="送信します">
<?php } ?>
  		<br />
  		<br />
        <input type="submit" name="act" value="一時保存">

      </form>

      <br />
      <br />
    </div>
  </body>
</html>
