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
        <h4>作業実績交通費入力</h4>
      </div>
-->
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <p><pre><h4><?php print($common->html_display($staff->oup_m_staff_name[0])); ?>　さん<br /><br /><?php print(date('Y/m/d')) ?> (<?php print($week[$w]); ?>) <?php print($run_end_time); ?><br /><br />訪問作業終了<br /><br />作業時刻　<?php print(substr($work->oup_t_work_run_start_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_run_start_time[0],2,2)); ?> - <?php print($run_end_time); ?><br />作業時間　<?php print(intval(substr($run_end_time,0,2)) * 60 + intval(substr($run_end_time,3,2)) - intval(substr($work->oup_t_work_run_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_run_start_time[0],2,2))); ?> 分<br />
<?php if (count($work2->oup_t_work_plan_service_no) == 0) { ?>
<?php for($i=0;$i<count($worktype->oup_m_work_type_kbn);$i++) { ?><?php print($worktype->oup_m_work_type_content[$i]); ?>　<?php print($T[$i]); ?> 分<br /><?php } ?>
<?php } else { ?>
<?php for($i=0;$i<count($work2->oup_t_work_plan_service_no);$i++) { ?><?php print($work2->oup_t_work_plan_content[$i]); ?>　<?php print($T[$i]); ?> 分<br /><?php } ?><?php } ?>
</h4></pre></p>
        </div>
      </div>

      <form name="frm" method="POST" action="../controllers/sagyojissekikoutuhiinput.php">

        <?php if ($sagyojissekikoutuhi->errmsg != "") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger"><?php print($sagyojissekikoutuhi->errmsg); ?></p></pre></div>
            </div>
        <?php } ?>

        <table class="table">
          <tr>
            <td width="120"><font size="+1">交通費</font></td>
            <td width="120">
              <input type="tel" name="move_cost_yen" value="<?php print($move_cost_yen); ?>" class="form-control" placeholder="" style="font-size:16pt">
            </td>
            <td><font size="+1">円</font></td>
          </tr>
          <tr>
            <td><font size="+1">移動距離</font></td>
            <td>
              <input type="tel" name="move_cost_kilo" value="<?php print($move_cost_kilo); ?>" class="form-control" placeholder="" style="font-size:16pt">
            </td>
            <td><font size="+1">km</font></td>
          </tr>
          <tr>
            <td><font size="+1">その他</font></td>
            <td>
              <input type="text" name="move_cost_etc" value="<?php print($move_cost_etc); ?>" class="form-control" placeholder="" style="font-size:16pt">
            </td>
            <td>&nbsp;</td>
          </tr>
        </table>

      <div class="row">
        <div class="col-xs-12 col-md-12"><label class="checkbox"><input name="alert_kbn" value="1" type="checkbox"> 重要</label></div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12"><p>
          作業実績コメント
          <textarea name="t_work_comment" class="form-control" rows="3" placeholder="作業で気づいたことがあればコメントを入力してください。このコメントは管理者にメールで送られます"><?php print($work->oup_t_work_comment[0]); ?></textarea>
        </p></div>
      </div>

        <div class="row">
          <div class="col-md-9">
            <div class="col-xs-6 col-md-6">
              <button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='sagyojissekisyuruiinput.php'">戻る</button>
            </div>
            <div class="col-xs-6 col-md-6">
              <button type="submit" class="btn btn-success btn-lg btn-block">登録します</button>
            </div>
          </div>
        </div>
    		<br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">

      </form>

    </div>
  </body>
</html>
