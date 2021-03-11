<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen, projection" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>　
    <title>かんたんヘルパーさん</title>
  </head>
<?php // var_dump($_SESSION); ?>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>作業報告詳細</h4>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <pre><h4>利用者　<?php print($common->html_display($user->oup_m_user_name[0])); ?> 様<br />
<?php print(substr($work->oup_t_work_run_start_date[0],0,10)) ?> (<?php print($week[$w]); ?>)<br />
作業時間　<?php print(substr($work->oup_t_work_run_start_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_run_start_time[0],2,2)); ?> から<?php print(substr($work->oup_t_work_run_end_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_run_end_time[0],2,2)); ?><br />
<?php if ($company->oup_m_company_simple_kbn[0] != "1") { ?>時間数　<?php print($work->oup_t_work_run_time[0]) ?>分<br /><?php } ?><br />
<?php print($work->oup_t_work_service_content[0]); ?>　<?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?>分<br />
<br /><br />
<?php if ($work->oup_t_work_move_cost_yen[0] != "") { ?>
交通費　<?php print($work->oup_t_work_move_cost_yen[0]) ?> 円<br /><?php } ?><?php if ($work->oup_t_work_move_cost_kilo[0] != "") { ?>移動距離　<?php print($work->oup_t_work_move_cost_kilo[0]); ?> km<br /><?php } ?><?php if ($work->oup_t_work_move_cost_etc[0] != "") { ?>その他　<?php print($common->html_display($work->oup_t_work_move_cost_etc[0])); ?><br /><?php } ?>
<?php print($common->html_display($work->oup_t_work_comment[0])); ?></h4></pre></div>
      </div>

        <form name="frm" method="POST" action="../controllers/sagyohokokudetail.php">

      <div class="row">
<?php if ($company->oup_m_company_disp_work_modified[0] == "1") { ?>
        <div class="col-md-9">
          <div class="col-xs-6 col-md-6"><button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='sagyohokokuhibetudetail.php'">戻る</button></div>
          <div class="col-xs-6 col-md-6"><button type="submit" class="btn btn-success btn-lg btn-block">修正します</button></div>
        </div>
<?php } else { ?>
          <div class="col-xs-12 col-md-12"><button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='sagyohokokuhibetudetail.php'">戻る</button></div>
<?php } ?>
      </div>
  		<br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">

        </form>
    </div>
  </body>
</html>
