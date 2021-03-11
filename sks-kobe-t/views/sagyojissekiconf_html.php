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

      <form name="frm" method="POST" action="../controllers/sagyojissekiconf.php">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <p><pre><h4><?php print($common->html_display($staff->oup_m_staff_name[0])); ?>　さん<br /><br /><?php print(date('Y/m/d')) ?> (<?php print($week[$w]); ?>) <?php print($run_end_time); ?><br /><br />訪問作業終了<br /><br />作業時刻　<?php print(substr($work->oup_t_work_run_start_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_run_start_time[0],2,2)); ?> － <?php print($run_end_time); ?><br />作業時間　<?php print(intval(substr($run_end_time,0,2)) * 60 + intval(substr($run_end_time,3,2)) - intval(substr($work->oup_t_work_run_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_run_start_time[0],2,2))); ?> 分<br /><br />
<?php if (count($work2->oup_t_work_plan_service_no) == 0) { ?>
<?php for($i=0;$i<count($worktype->oup_m_work_type_kbn);$i++) { ?><?php print($worktype->oup_m_work_type_content[$i]); ?>　<?php print($T[$i]); ?>分<br /><?php } ?><br />
<?php } else { ?>
<?php for($i=0;$i<count($work2->oup_t_work_plan_service_no);$i++) { ?><?php print($work2->oup_t_work_plan_content[$i]); ?>　<?php print($T[$i]); ?> 分<br /><?php } ?><?php } ?>
<?php if ($move_cost_yen != "") { ?>交通費　<?php print($move_cost_yen); ?> 円<br /><?php } ?><?php if ($move_cost_kilo != "") { ?>移動距離　<?php print($move_cost_kilo); ?> km<br /><?php } ?><?php if ($move_cost_etc != "") { ?>その他　<?php print($common->html_display($move_cost_etc)); ?><br /><br /><?php } ?><?php print($common->html_display($comment)); ?></h4></pre></p>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <pre><p class="text-info"><font size="+1">登録内容を確認してください</font></p></pre>
        </div>
      </div>
      <div class="row">
        <div class="col-md-9">
          <div class="col-xs-6 col-md-6"><button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='sagyojissekikomento.php'">戻る</button></div>
          <div class="col-xs-6 col-md-6"><button type="submit" class="btn btn-success btn-lg btn-block">登録します</button></div>
        </div>
      </div>
  		<br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">

      </form>

    </div>
  </body>
</html>
