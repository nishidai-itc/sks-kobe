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

      <form name="frm" method="POST" action="../controllers/work_conf.php">

      <div class="row">
        <div class="col-xs-12 col-md-12">
        <pre><h4>利用者　<?php print($common->html_display($user->oup_m_user_name[0])); ?> さん<br /><?php print($run_start_date_yy); ?>年<?php print($run_start_date_mm); ?>月<?php print($run_start_date_dd); ?>日 (<?php print($week[$w]); ?>)<br />作業時間　<?php print($run_start_time_hh); ?>:<?php print($run_start_time_mm); ?> － <?php print($run_end_time_hh); ?>:<?php print($run_end_time_mm); ?><br />時間数　<?php print($run_time); ?> 分<br /><br /><?php for($i=0;$i<count($worktype->oup_m_work_type_kbn);$i++) { ?><?php print($worktype->oup_m_work_type_content[$i]); ?>　<?php print($T[$i]); ?>分<br /><?php } ?><br /><br />交通費　<?php print($move_cost_yen); ?> 円<br />移動距離　<?php print($move_cost_kilo); ?> km<br />その他　<?php print($common->html_display($move_cost_etc)); ?><br /><br /><?php print($common->html_display($comment)); ?><br /><br /><?php print($common->html_display($rest_reason)); ?></h4></pre></div>
      </div>

      <div class="row">
        <div class="col-md-9">
        <div class="col-xs-6 col-md-6"><button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='<?php print($back); ?>'">戻る</button></div>
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
