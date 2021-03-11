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

<?php // var_dump($_SESSION); ?>

<script type="text/javascript">
<!--
function func() {
  <?php $sumvalue = NULL; ?>
  <?php $T= NULL; ?>
<?php if (count($work2->oup_t_work_plan_service_no) == 0) { ?>
    <?php for($i=0;$i<count($worktype->oup_m_work_type_kbn);$i++) { ?>
      var T<?php print($i); ?> = parseFloat(document.frm.T<?php print($i); ?>.value);
      if (isNaN(T<?php print($i); ?>)) { T<?php print($i); ?>=0 }
      <?php if ($i != 0) { $sumvalue .= "+"; } ?>
      <?php $sumvalue .= 'T'.$i; ?>
    <?php } ?>
<?php } else { ?>
    <?php for($i=0;$i<count($work2->oup_t_work_plan_service_no);$i++) { ?>
      var T<?php print($i); ?> = parseFloat(document.frm.T<?php print($i); ?>.value);
      if (isNaN(T<?php print($i); ?>)) { T<?php print($i); ?>=0 }
      <?php if ($i != 0) { $sumvalue .= "+"; } ?>
      <?php $sumvalue .= 'T'.$i; ?>
    <?php } ?>
<?php } ?>
  document.frm.sumvalue.value = <?php print($sumvalue); ?>
<?php
?>

}
// -->
</script>

  <body>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <p><pre><h4><?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん <?php print(date('m/d')) ?> (<?php print($week[$w]); ?>) <b><?php print($run_end_time); ?></b><br /><br /><b>訪問作業終了</b><br /><br />作業時間 <?php print(substr($work->oup_t_work_run_start_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_run_start_time[0],2,2)); ?> - <?php print($run_end_time); ?> (<?php print(intval(substr($run_end_time,0,2)) * 60 + intval(substr($run_end_time,3,2)) - intval(substr($work->oup_t_work_run_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_run_start_time[0],2,2))); ?> 分)</h4></pre></p>
        </div>
      </div>

        <?php if ($sagyojissekisyurui->errmsg != "") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger"><font size="+1"><?php print($sagyojissekisyurui->errmsg); ?></font></p></pre></div>
            </div>
        <?php } ?>

      <form name="frm" method="POST" action="sagyojissekisyuruiinput.php">

      <div class="row">
        <div class="col-xs-12 col-md-12"><pre><h4>利用者　<?php print($common->html_display($user->oup_m_user_name[0])); ?> 様
<?php if($work->oup_t_work_staff_memo[0] != "") { ?><br /><br />スタッフメモ<br /><?php print($work->oup_t_work_staff_memo[0]); ?><?php } ?>
<?php if($work->oup_t_work_admin_memo[0] != "") { ?><br /><br />管理者メモ<br /><?php print($work->oup_t_work_admin_memo[0]); ?><?php } ?>
<?php if($work->oup_t_work_instruction_memo[0] != "") { ?><br /><br /><font color="red">指示内容</font><br /><?php print($work->oup_t_work_instruction_memo[0]); ?><?php } ?><br /><br /><input type="checkbox" name="equal" value="1" style="width:20px;height:20px"> <b>作業は予定通りでした</b><br /><br />（予定） <?php print($work->oup_t_work_service_content[0]); ?>　<?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?> 分<br /></h4></pre></div>
      </div>

      <input type="hidden" name="T20" value="<?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?>">

        <table>
          <tbody>
          <tr>
            <td><font size="+1"><?php print($work->oup_t_work_service_content[0]); ?></font>
              <input type="tel" name="T0" onChange="func();" style="font-size:16pt" size="5"> 分
              </td>
          </tr>
          <tr>
            <td><font size="+1">合計<input type="tel" name="sumvalue" placeholder="" value="0" style="border-width:0px;border-style:None;font-size:16pt;text-align:right;" readonly size="5">分</font></td>
          </tr>
          </tbody>
        </table>
        <br />
        <br />

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
              <input type="tel" name="move_cost_etc" value="<?php print($move_cost_etc); ?>" class="form-control" placeholder="" style="font-size:16pt">
            </td>
            <td>&nbsp;</td>
          </tr>
        </table>

      <div class="row">
        <div class="col-xs-12 col-md-12"><p>
          <font size="+1">作業実績コメント</font><br />
          <label class="checkbox"><input name="alert_kbn" value="1" type="checkbox"><font size="+1"> 重要</font></label>
          <textarea name="t_work_comment" class="form-control" rows="3" placeholder="作業で気づいたことがあればコメントを入力してください。このコメントは重要にチェックを入れると管理者にメールで送られます"><?php print($work->oup_t_work_comment[0]); ?></textarea>
        </p></div>
      </div>

        <div class="row">
          <div class="col-md-9">
            <div class="col-xs-6 col-md-6">
              <button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='menu.php'">戻る</button>
            </div>
            <div class="col-xs-6 col-md-6">
<?php if($company->oup_m_company_kiroku_kbn[0] == "1") { ?>
              <button type="submit" class="btn btn-success btn-lg btn-block">実施記録へ</button>
<?php } else { ?>
              <button type="submit" class="btn btn-success btn-lg btn-block">登録します</button>
<?php } ?>
            </div>
          </div>
        </div>
        <br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
<?php if (count($work2->oup_t_work_plan_service_no) == 0) { ?>
        <INPUT type="hidden" name="syurui_cnt" value="<?php print(count($worktype->oup_m_work_type_kbn)); ?>">
<?php } else { ?>
        <INPUT type="hidden" name="syurui_cnt" value="<?php print(count($work2->oup_t_work_plan_service_no)); ?>">
        <INPUT type="hidden" name="ido" value="">
        <INPUT type="hidden" name="keido" value="">
        <INPUT type="hidden" name="run_end_time" value="<?php print($run_end_time); ?>">
<?php } ?>

      </form>

    </div>
  </body>
</html>
