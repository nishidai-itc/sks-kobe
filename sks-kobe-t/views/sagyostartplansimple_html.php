<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen, projection" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>　
    <script type="text/javascript" src="../js/jquery-1.8.0.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="../js/geoloc.js" charset="utf-8"></script>
    <script type="text/javascript" src="../js/sock.js" charset="utf-8"></script>
    <title>かんたんヘルパーさん</title>
  </head>

  <script type="text/javascript">
  <!--
  function confrim(act){
      document.frm.act.value=act;
      document.frm.submit();
  }
  // -->
  </script>

  <body>
    <div class="container">
      <form name="frm" method="POST" action="sagyostartplan.php">

        <?php if ($sagyostart->errmsg != "") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger"><font size="+1"><?php print($sagyostart->errmsg); ?></font></p></pre></div>
            </div>
        <?php } ?>

      <div class="row">
        <div class="col-xs-12 col-md-12">
            <pre><h4><?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん <br /><?php print(date('m/d')) ?> (<?php print($week[$w]); ?>) <b><?php print(substr($run_start_time,0,2)); ?>:<?php print(substr($run_start_time,3,2)); ?></b></h4></pre>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-12"><pre><h4>利用者　<?php print($common->html_display($user->oup_m_user_name[0])); ?> 様<br /><br />予定 <?php print(substr($work->oup_t_work_plan_start_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_plan_start_time[0],2,2)); ?> - <?php print(substr($work->oup_t_work_plan_end_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_plan_end_time[0],2,2)); ?> (<?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?> 分)<br />
<?php print($work->oup_t_work_service_content[0]); ?>　<?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?>分
<?php if($work->oup_t_work_staff_memo[0] != "") { ?><br /><br />スタッフメモ<br /><?php print($work->oup_t_work_staff_memo[0]); ?><?php } ?>
<?php if($work->oup_t_work_admin_memo[0] != "") { ?><br /><br />管理者メモ<br /><?php print($work->oup_t_work_admin_memo[0]); ?><?php } ?>
<?php if($work->oup_t_work_instruction_memo[0] != "") { ?><br /><br /><font color="red">指示内容</font><br /><?php print($work->oup_t_work_instruction_memo[0]); ?><?php } ?></h4></pre></div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12"><p>
          <font size="+1">報告内容</font><br />
          <label class="checkbox"><input name="alert_kbn" value="1" type="checkbox"><font size="+1"> 重要</font></label>
          <textarea name="rest_reason" class="form-control" rows="3" placeholder="作業で気づいたことがあれば報告内容を入力してください。この報告内容は重要にチェックを入れると管理者にメールで送られます"><?php print($work->oup_t_work_comment[0]); ?></textarea>
        </p></div>
      </div>

      <div class="row">
        <div class="col-md-9">
          <div class="col-xs-6 col-md-6">
            <button type="button" class="btn btn-primary btn-lg btn-block" onclick="confrim(4)">一時保存(戻る)</button>
          </div>
          <div class="col-xs-6 col-md-6">
<?php if($company->oup_m_company_kiroku_kbn[0] == "1") { ?>
            <button type="button" class="btn btn-success btn-lg btn-block" onclick="confrim(3)">実施記録へ</button>
<?php } else { ?>
            <button type="button" class="btn btn-success btn-lg btn-block" onclick="confrim(3)">送信します</button>
<?php } ?>
          </div>
        </div>
      </div>
  		<br />

      <?php /* アクションフラグ */ ?>
      <INPUT type="hidden" name="act" value="">
        <INPUT type="hidden" name="run_start_time" value="<?php print($run_start_time); ?>">
        <INPUT type="hidden" name="ido" value="">
        <INPUT type="hidden" name="keido" value="">

      </form>

    </div>
  </body>
</html>