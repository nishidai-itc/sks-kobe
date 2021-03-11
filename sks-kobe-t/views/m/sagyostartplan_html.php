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

      <?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん <br /><?php print(date('m/d')) ?> (<?php print($week[$w]); ?>) <b><?php print(substr($run_start_time,0,2)); ?>:<?php print(substr($run_start_time,3,2)); ?></b><br /><br /><b>作業準備中</b><br />
      利用者 <?php print($common->html_display($user->oup_m_user_name[0])); ?> 様<br /><br />予定 <?php print(substr($work->oup_t_work_plan_start_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_plan_start_time[0],2,2)); ?>-<?php print(substr($work->oup_t_work_plan_end_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_plan_end_time[0],2,2)); ?> (<?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?>分)<br /><br />
<?php print($work->oup_t_work_service_content[0]); ?> <?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?>分<br />
      <?php if($work->oup_t_work_staff_memo[0] != "") { ?><br />スタッフメモ<br /><?php print($work->oup_t_work_staff_memo[0]); ?><?php } ?><?php if($work->oup_t_work_admin_memo[0] != "") { ?><br /><br />管理者メモ<br /><?php print($work->oup_t_work_admin_memo[0]); ?><?php } ?><?php if($work->oup_t_work_instruction_memo[0] != "") { ?><br /><br /><font color="red">指示内容</font><br /><?php print($work->oup_t_work_instruction_memo[0]); ?><?php } ?>
      <br />

      <form name="frm" method="POST" action="sagyostartplan.php">
        <input type="submit" value="作業を開始します">
        <INPUT type="hidden" name="run_start_time" value="<?php print($run_start_time); ?>">
        <INPUT type="hidden" name="ido" value="">
        <INPUT type="hidden" name="keido" value="">
        <INPUT type="hidden" name="act" value="1">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>

      <form name="frm" method="POST" action="sagyostartplan.php">

        <p>利用者様の都合等で作業出来ない場合、理由を入れて中止を押してください</p>
        <p>理由</p>
        <textarea name="rest_reason" class="form-control" rows="3" placeholder="理由を入力してください" istyle="1" format="M" mode="hiragana"></textarea>
        <br />
        <br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="2">
        <INPUT type="hidden" name="run_start_time" value="<?php print($run_start_time); ?>">
        <INPUT type="hidden" name="ido" value="">
        <INPUT type="hidden" name="keido" value="">

        <input type="submit" value="中止">
  		<br />
  		<br />

      </form>

      <form name="frm2" method="POST" action="today_list.php">
        <input type="submit" value="戻る">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>
      <br />
      <br />
    </div>
  </body>
</html>
