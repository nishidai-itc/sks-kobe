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

<script type="text/javascript">
<!--
function func() {
  <?php $sumvalue = NULL; ?>
  <?php $T= NULL; ?>
<?php for($i=0;$i<count($worktype->oup_m_work_type_kbn);$i++) { ?>
  var T<?php print($i); ?> = parseFloat(document.frm.T<?php print($i); ?>.value);
  if (isNaN(T<?php print($i); ?>)) { T<?php print($i); ?>=0 }
  <?php if ($i != 0) { $sumvalue .= "+"; } ?>
  <?php $sumvalue .= 'T'.$i; ?>
<?php } ?>
  document.frm.sumvalue.value = <?php print($sumvalue); ?>
<?php
?>
}
// -->
</script>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>作業報告修正</h4>
      </div>

      <form name="frm" method="POST" action="../controllers/work_modify.php">
        <?php if ($workregist->errmsg != "") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger"><?php print($workregist->errmsg); ?></p></pre></div>
            </div>
        <?php } ?>

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <label>利用者</label>
          <select name="user_id" class="form-control">
            <option value=""></option>
<?php for($i=0;$i<count($user->oup_m_user_id);$i++) { ?>
            <option value="<?php print($user->oup_m_user_id[$i]); ?>" <?php if($user->oup_m_user_id[$i] == $user_id) { print("selected"); } ?>><?php print($user->oup_m_user_name[$i]); ?> さん(<?php print((int) ((date('Ymd')-(substr($user->oup_m_user_birth_date[$i],0,4).substr($user->oup_m_user_birth_date[$i],5,2).substr($user->oup_m_user_birth_date[$i],8,2)))/10000)); ?>)</option>
<?php } ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <label>作業日（YYYY/MM/DD）</label>
          <input type="date" name="run_start_date" class="form-control" placeholder="" value="<?php print(substr($run_start_date,0,10)); ?>">
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12">
            <label>作業時間</label>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div class="col-xs-4 col-md-4">
            <select name="run_start_time_hh" class="form-control">
              <option value=""></option>
<?php for ($i=0;$i<=23;$i++) { ?>
                <option value="<?php print(sprintf("%02d", $i)); ?>" <?php if(sprintf("%02d", $i) == substr($run_start_time,0,2)) { print("selected"); } ?>><?php print(sprintf("%02d", $i)); ?></option>
<?php } ?>
            </select>
          </div>
          <div class="col-xs-1 col-md-1">
            <label>時</label>
          </div>
          <div class="col-xs-4 col-md-4">
            <select name="run_start_time_mm" class="form-control">
              <option value=""></option>
<?php for ($i=0;$i<=59;$i++) { ?>
                <option value="<?php print(sprintf("%02d", $i)); ?>" <?php if(sprintf("%02d", $i) == substr($run_start_time,2,2)) { print("selected"); } ?>><?php print(sprintf("%02d", $i)); ?></option>
<?php } ?>
            </select>
          </div>
          <div class="col-xs-2 col-md-2">
            <label>分</label>
          </div>
        </div>
      </div>
      から
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div class="col-xs-4 col-md-4">
            <select name="run_end_time_hh" class="form-control">
              <option value=""></option>
<?php for ($i=0;$i<=23;$i++) { ?>
                <option value="<?php print(sprintf("%02d", $i)); ?>" <?php if($i == substr($run_end_time,0,2)) { print("selected"); } ?>><?php print(sprintf("%02d", $i)); ?></option>
<?php } ?>
            </select>
          </div>
          <div class="col-xs-1 col-md-1">
            <label>時</label>
          </div>
          <div class="col-xs-4 col-md-4">
            <select name="run_end_time_mm" class="form-control">
              <option value=""></option>
<?php for ($i=0;$i<=59;$i++) { ?>
                <option value="<?php print(sprintf("%02d", $i)); ?>" <?php if($i == substr($run_end_time,2,2)) { print("selected"); } ?>><?php print(sprintf("%02d", $i)); ?></option>
<?php } ?>
            </select>
          </div>
          <div class="col-xs-1 col-md-1">
            <label>分</label>
          </div>
        </div>
      </div>
      <br />

        <table>
          <tbody>
<?php for($i=0;$i<count($worktype->oup_m_work_type_kbn);$i++) { ?>
          <tr>
            <td width="120"><font size="+1"><?php print($worktype->oup_m_work_type_content[$i]); ?></font></td>
            <td width="120">
              <select class="form-control" name="T<?php print($i); ?>" onClick="func();" style="font-size:12pt">
                <option value="0" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 0) { print("selected"); } ?>></option>
                <option value="30" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 30) { print("selected"); } ?>>30</option>
                <option value="40" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 40) { print("selected"); } ?>>40</option>
                <option value="45" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 45) { print("selected"); } ?>>45</option>
                <option value="50" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 50) { print("selected"); } ?>>50</option>
                <option value="60" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 60) { print("selected"); } ?>>60</option>
                <option value="90" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 90) { print("selected"); } ?>>90</option>
                <option value="120" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 120) { print("selected"); } ?>>120</option>
                <option value="150" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 150) { print("selected"); } ?>>150</option>
                <option value="180" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 180) { print("selected"); } ?>>180</option>
                <option value="210" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 210) { print("selected"); } ?>>210</option>
                <option value="240" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 240) { print("selected"); } ?>>240</option>
              </select>
            </td>
            <td><font size="+1">分</font></td>
          </tr>
<?php } ?>
          <tr>
            <td><font size="+1">合計</font></td>
            <td><input type="tel" name="sumvalue" class="form-control" placeholder="" value="0" style="font-size:16pt" readonly></td>
            <td><font size="+1">分</font></td>
          </tr>
          </tbody>
        </table>
      <br />

        <table class="table">
          <tr>
            <td width="120"><font size="+1">交通費</font></td>
            <td width="120"><input type="tel" name="move_cost_yen" class="form-control" placeholder="" style="font-size:16pt" value="<?php print($move_cost_yen); ?>"></td>
            <td><font size="+1">円</font></td>
          </tr>
          <tr>
            <td><font size="+1">移動距離</font></td>
            <td><input type="tel" name="move_cost_kilo" class="form-control" placeholder="" style="font-size:16pt" value="<?php print($move_cost_kilo); ?>"></td>
            <td><font size="+1">km</font></td>
          </tr>
          <tr>
            <td><font size="+1">その他</font></td>
            <td><input type="text" name="move_cost_etc" class="form-control" placeholder="" style="font-size:16pt" value="<?php print($move_cost_etc); ?>"></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      <br />

      <div class="row">
        <div class="col-xs-12 col-md-12"><pre><p class="text-info">作業で気づいたことがあればコメントを入力してください<br />このコメントは管理者にメールで送られます</p></pre></div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12"><label class="checkbox"><input type="checkbox" name="alert_kbn" value="1"> 重要</label></div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12"><p>
          作業実績コメント
          <textarea name="comment" class="form-control" rows="3" placeholder="作業実績のコメントを入力してください"><?php print($comment); ?></textarea>
        </p></div>
      </div>
      <br />

      <div class="row">
        <div class="col-md-9">
          <div class="col-xs-6 col-md-6"><button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='sagyohokokudetail.php'">戻る</button></div>
          <div class="col-xs-6 col-md-6"><button type="submit" class="btn btn-success btn-lg btn-block">確認へ</button></div>
        </div>
      </div>
  		<br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <INPUT type="hidden" name="syurui_cnt" value="<?php print(count($worktype->oup_m_work_type_kbn)); ?>">
        <INPUT type="hidden" name="run_start_date_yy" value="<?php print($run_start_date_yy); ?>">
        <INPUT type="hidden" name="run_start_date_mm" value="<?php print($run_start_date_mm); ?>">
        <INPUT type="hidden" name="run_start_date_dd" value="<?php print($run_start_date_dd); ?>">

      </form>
    </div>
  </body>

</html>
