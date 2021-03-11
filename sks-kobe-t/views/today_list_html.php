<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen, projection" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>　
    <title>かんたんヘルパーさん</title>
  </head>
  <body>
    <div class="container">
<!--
      <div class="page-header">
        <h4>本日の予定</h4>
      </div>
-->
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <pre><h4><?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん <br /><?php print(date('m/d')); ?>(<?php print($week[$w]); ?>) <b><?php print(date('H:i')); ?></b><br /><?php if ($company->oup_m_company_simple_kbn[0] != "1") { ?><br /><b>作業準備中</b><?php } ?></h4></pre>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <pre><p class="text-info"><font size="+1">作業予定を選択してください</font></p></pre>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12">

	<?php if(!($confirmflg)) { ?>
    <br />
          <form name="frm4" method="POST" action="today_list.php">
            <button type="submit" class="btn btn-primary btn-lg btn-block">本日 全て訪問OK </button>
            <?php /* アクションフラグ */ ?>
            <INPUT type="hidden" name="act" value="4">
          </form>
          <br />
	<?php } else { ?>
    <br />
          <pre><font size="+1">本日 全て訪問OK 連絡済</font></pre>
	<?php } ?>

<?php for($i=0;$i<count($work->oup_t_work_no);$i++) { ?>
<?php
    $user     = new User;       // 利用者クラス
    // 利用者マスタ 取得 に必要な情報をセット
    $user->inp_m_user_id = $work->oup_t_work_user_id[$i];
    $user->getUser();
?>
          <button class="btn btn-success btn-lg btn-block" onclick="location.href='sagyostartplan.php?work_no=<?php print($work->oup_t_work_no[$i]); ?>'"><?php print(substr($work->oup_t_work_plan_start_time[$i],0,2).":".substr($work->oup_t_work_plan_start_time[$i],2,2)); ?> - <?php print(substr($work->oup_t_work_plan_end_time[$i],0,2).":".substr($work->oup_t_work_plan_end_time[$i],2,2)); ?> <?php print($common->html_display($user->oup_m_user_name[0])); ?> 様</button>
<?php } ?>

        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <button class="btn btn-default btn-block" onclick="location.href='../controllers/menu.php'">戻る</button>
        </div>
      </div>
      <br />

    </div>
  </body>
</html>
