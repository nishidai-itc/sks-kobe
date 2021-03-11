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
        <h4>日別作業報告詳細</h4>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12">
        <pre><h4><?php print(substr($work_day,0,4)."/".substr($work_day,4,2)."/".substr($work_day,6,2)); ?> (<?php print($week[$w]); ?>)</h4></pre></div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12">
<?php for($i=0;$i<count($work->oup_t_work_no);$i++) { ?>
            <form name="frm" method="POST" action="../controllers/sagyohokokuhibetudetail.php">
            <button type="submit" class="btn btn-success btn-lg btn-block"><?php print($common->html_display($work->oup_t_work_user_name[$i])); ?>さん　<?php print(substr($work->oup_t_work_run_start_time[$i],0,2)); ?>:<?php print(substr($work->oup_t_work_run_start_time[$i],2,2)); ?> － <?php if ($work->oup_t_work_stop_kbn[$i]=="0") { ?><?php print("作業中"); ?><?php } elseif ($work->oup_t_work_stop_kbn[$i]=="1") { ?><?php print("作業中止"); ?><?php } elseif ($work->oup_t_work_stop_kbn[$i]=="2") { ?><?php print("休暇連絡"); ?><?php } else { ?><?php print(substr($work->oup_t_work_run_end_time[$i],0,2)); ?>:<?php print(substr($work->oup_t_work_run_end_time[$i],2,2)); ?><?php } ?></button>
        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="2">
        <INPUT type="hidden" name="work_no" value="<?php print($work->oup_t_work_no[$i]); ?>"><br />
            </form>
<?php } ?>
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='sagyohokokulist.php'">戻る</button>
        </div>
      </div>
  		<br />

    </div>
  </body>
</html>
