<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" media="screen, projection" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>
  </head>

  <body>
  
<style>

input[type=button].button,
input[type=submit].button,
button.button {
  -webkit-appearance: none;
  -moz-appearance: none;
  border: none;
  font: inherit;
}

button[type=submit].button {
  background-color: #0b73da;
}

.button {
  display: inline-block;
  padding: .5em 1em;
  border-radius: 4px;
  text-align: center;
  color: #eff;
  background-color: #678;
  cursor: pointer;
}

.button:hover {
  background-color: #567;
}

.button:disabled {
  cursor: not-allowed;
  opacity: .6;
  color: #def;
}

.toggle-buttons {
  display: flex;
}

.toggle-buttons.vertical {
  flex-direction: column;
}

.toggle-buttons label {
  display: flex;
  position: relative;
}

.toggle-buttons [type=radio],
.toggle-buttons [type=checkbox] {
  -webkit-appearance: none;
  -moz-appearance: none;
  position: absolute;
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}

/* appearance: none for IE11 */
_:-ms-lang(x)::-ms-backdrop, .toggle-buttons [type=radio],
_:-ms-lang(x)::-ms-backdrop, .toggle-buttons [type=checkbox] {
  visibility: hidden;
}

.toggle-buttons .button {
  z-index: 1;
}

.toggle-buttons.vertical .button {
  width: 100%;
}

.toggle-buttons:not(.vertical) :not(:first-child) .button {
  border-left: 1px solid #567;
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}

.toggle-buttons:not(.vertical) :not(:last-child) .button {
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}

.toggle-buttons.vertical :not(:first-child) .button {
  border-top: 1px solid #567;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.toggle-buttons.vertical :not(:last-child) .button {
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}

.toggle-buttons :checked + .button {
  background-color: #345;
}

.toggle-buttons :disabled + .button {
  cursor: not-allowed;
  opacity: .6;
  color: #def;
}

</style>

  
  
<script language="JavaScript" type="text/javascript">
<!--
  // 「全て選択」チェックで全てにチェック付く
  function AllChecked(){
    var chked = document.getElementById('all').checked;

<?php for($i=0;$i<count($work_mem->oup_t_work_taiin_id);$i++) { ?>
    document.getElementById('in_normal<?php echo $i; ?>').checked = chked;
    document.getElementById('jtime<?php echo $i; ?>').value = document.getElementById('plan_time<?php echo $i; ?>').value;
<?php } ?> 
  }
// -->
</script>

    <div class="container">
      <div class="page-header">
        <h4>上番報告（リーダー用）</h4>
      </div>

      <form name="frm" method="POST" action="joban1.php" enctype="multipart/form-data">

        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table class="table table-bordered">
              <tr>
                <td bgcolor="FFDCA5" align="center">報告者</td>
                <td><?php echo $staff->oup_m_staff_name[0]; ?></td>
              </tr>
              <tr>
                <td bgcolor="FFDCA5" align="center">日付</td>
                <td><?php print(substr($work->oup_t_work_plan_date[0],0,4)."年".substr($work->oup_t_work_plan_date[0],5,2)."月".substr($work->oup_t_work_plan_date[0],8,2)."日"); ?>(<?php print($week[$w]); ?>)</td>
              </tr>
              <tr>
                <td bgcolor="FFDCA5" align="center">現場名</td>
                <td><?php echo $genba->oup_m_genba_name[0] ?></td>
              </tr>
            </table>
          </div>
        </div>




        <br />
        <div class="row">
          <div class="col-12">
            <table class="table table-bordered">
              <tr align="center">
                <td bgcolor="FFDCA5">氏名</td>
                <td bgcolor="FFDCA5">勤務</td>
                <td bgcolor="FFDCA5">所定<br />開始<br />終了</td>
                <td bgcolor="FFDCA5">上番</td>
                <td></td>
                <td bgcolor="FFDCA5">休<br />暇</td>
              </tr>
              <tr align="center">
                <td>福島</td>
                <td>日勤</td>
                <td>7:00<br />16:00</td>
                <td><input type="time" class="form-control" value="07:00"></td>
                <td></td>
                <td><div class="toggle-buttons"><label><input type="radio" name="rd1"><span class="button">休</span></label></div></td>
              </tr>
              <tr align="center">
                <td>井上</td>
                <td>日勤</td>
                <td>7:00<br />16:00</td>
                <td><input type="time" class="form-control" value="07:00"></td>
                <td></td>
                <td><div class="toggle-buttons"><label><input type="radio" name="rd2"><span class="button">休</span></label></div></td>
              </tr>
              <tr align="center">
                <td>山田</td>
                <td>日勤</td>
                <td>7:30<br />16:30</td>
                <td><input type="time" class="form-control" value="07:30"></td>
                <td></td>
                <td><div class="toggle-buttons"><label><input type="radio" name="rd3"><span class="button">休</span></label></div></td>
              </tr>
              <tr align="center">
                <td>徳田</td>
                <td>日勤</td>
                <td>7:30<br />16:30</td>
                <td><input type="time" class="form-control" value="07:30"></td>
                <td></td>
                <td><div class="toggle-buttons"><label><input type="radio" name="rd4"><span class="button">休</span></label></div></td>
              </tr>
              <tr align="center">
                <td>福島</td>
                <td>泊</td>
                <td>8:00<br />32:00</td>
                <td><input type="time" class="form-control" value="08:00"></td>
                <td></td>
                <td><div class="toggle-buttons"><label><input type="radio" name="rd5"><span class="button">休</span></label></div></td>
              </tr>
              <tr align="center">
                <td>山田</td>
                <td>泊</td>
                <td>8:00<br />32:00</td>
                <td><input type="time" class="form-control" value="08:00"></td>
                <td></td>
                <td><div class="toggle-buttons"><label><input type="radio" name="rd6"><span class="button">休</span></label></div></td>
              </tr>
              <tr align="center">
                <td>谷</td>
                <td>日勤</td>
                <td>8:00<br />17:00</td>
                <td><input type="time" class="form-control" value="08:00"></td>
                <td></td>
                <td><div class="toggle-buttons"><label><input type="radio" name="rd7"><span class="button">休</span></label></div></td>
              </tr>
              <tr align="center">
                <td>井上</td>
                <td>日勤</td>
                <td>8:00<br />17:00</td>
                <td><input type="time" class="form-control" value="08:00"></td>
                <td></td>
                <td><div class="toggle-buttons"><label><input type="radio" name="rd8"><span class="button">休</span></label></div></td>
              </tr>
              <tr align="center">
                <td>谷</td>
                <td>日勤</td>
                <td>8:00<br />17:00</td>
                <td><input type="time" class="form-control" value="08:00"></td>
                <td></td>
                <td><div class="toggle-buttons"><label><input type="radio" name="rd9"><span class="button">休</span></label></div></td>
              </tr>
              <tr align="center">
                <td>丹波</td>
                <td>日勤</td>
                <td>8:00<br />17:00</td>
                <td><input type="time" class="form-control" value="08:00"></td>
                <td></td>
                <td><div class="toggle-buttons"><label><input type="radio" name="rd10"><span class="button">休</span></label></div></td>
              </tr>
              <tr align="center">
                <td>寺尾</td>
                <td>日勤</td>
                <td>8:00<br />17:00</td>
                <td><input type="time" class="form-control" value="08:00"></td>
                <td></td>
                <td><div class="toggle-buttons"><label><input type="radio" name="rd11"><span class="button">休</span></label></div></td>
              </tr>
              <tr align="center">
                <td>徳田</td>
                <td>日勤</td>
                <td>8:00<br />17:00</td>
                <td><input type="time" class="form-control" value="08:00"></td>
                <td></td>
                <td><div class="toggle-buttons"><label><input type="radio" name="rd12"><span class="button">休</span></label></div></td>
              </tr>
              <tr align="center">
                <td>宮坂</td>
                <td>日勤</td>
                <td>8:00<br />17:00</td>
                <td><input type="time" class="form-control" value="08:00"></td>
                <td></td>
                <td><div class="toggle-buttons"><label><input type="radio" name="rd13"><span class="button">休</span></label></div></td>
              </tr>
              <tr align="center">
                <td>中村</td>
                <td>夜勤</td>
                <td>17:00<br />17:00</td>
                <td><input type="time" class="form-control" value="17:00"></td>
                <td></td>
                <td><div class="toggle-buttons"><label><input type="radio" name="rd14"><span class="button">休</span></label></div></td>
              </tr>
              <tr align="center">
                <td>岡本</td>
                <td>ＫＦＣ</td>
                <td>8:00<br />17:00</td>
                <td><input type="time" class="form-control" value="08:00"></td>
                <td></td>
                <td><div class="toggle-buttons"><label><input type="radio" name="rd15"><span class="button">休</span></label></div></td>
              </tr>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <a href="menu.php" class="btn btn-success btn-block" role="button" aria-pressed="true">上番報告</a>
          </div>
          <div class="col-6">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />

















<?php /* ?>
        <br />
        <div class="row">
          <div class="col-6">
            <a href="joban2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規</a>
          </div>
          <div class="col-6">
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
              <tr align="center" bgcolor="FFDCA5">
                <td width="40"><input type="checkbox" name="rd0" id='all' onClick="AllChecked();"><br />通<br />常</td>
                <td width="85">氏名</td>
                <td width="60">勤務</td>
                <td width="60">開始<br />終了</td>
                <td>早<br />出</td>
                <td>遅<br />刻</td>
                <td width="40">休<br />暇</td>
              </tr>
<?php for($i=0;$i<count($work_mem->oup_t_work_taiin_id);$i++) { 
          $checked1 = "";
          $checked2 = "";
          $checked3 = "";
          $checked4 = "";
          if ($work_mem->oup_t_work_joban_kbn[$i] == "1") {
              $checked1 = "checked";
          } else if ($work_mem->oup_t_work_joban_kbn[$i] == "2") {
              $checked2 = "checked";
          } else if ($work_mem->oup_t_work_joban_kbn[$i] == "3") {
              $checked3 = "checked";
          } else if ($work_mem->oup_t_work_joban_kbn[$i] == "4") {
              $checked4 = "checked";
          }
?>
              <tr align="center" <?php if ($work_mem->oup_t_work_plan_kbn[$i]=="3") { print("bgcolor=\"powderblue\""); } ?>>
                <td rowspan="2"><input type="radio" name="joban_kbn[<?php echo $i; ?>]" id="in_normal<?php echo $i; ?>" value="1" <?php echo $checked1; ?>></td>
                <td rowspan="2"><?php echo $staff_name[$i]; ?></td>
                <td rowspan="2"><?php echo $kinmu[$i]; ?></td>
                <td rowspan="2"><?php echo $p_joban_time[$i]; ?><br /><?php echo $p_kaban_time[$i]; ?></td>
                <td><input type="radio" name="joban_kbn[<?php echo $i; ?>]" value="2" <?php echo $checked2; ?>></td>
                <td><input type="radio" name="joban_kbn[<?php echo $i; ?>]" value="3" <?php echo $checked3; ?>></td>
                <td rowspan="2"><input type="radio" name="joban_kbn[<?php echo $i; ?>]" value="4" <?php echo $checked4; ?>></td>
              </tr>
              <tr align="center">
                <td colspan="2"><input type="time" name="jtime[<?php echo $i; ?>]" id="jtime<?php echo $i; ?>" class="form-control" value="<?php echo $joban_time[$i]; ?>"></td>
                <INPUT type="hidden" name="plan_time[<?php echo $i; ?>]" id="plan_time<?php echo $i; ?>" value="<?php echo $p_joban_time[$i]; ?>">
                <INPUT type="hidden" name="work_no[<?php echo $i; ?>]" value="<?php echo $work_mem->oup_t_work_no[$i]; ?>">
              </tr>
<?php } ?>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <button type="submit" class="btn btn-success btn-block" role="button" aria-pressed="true">上番報告</button>
          </div>
          <div class="col-6">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />
<?php */ ?>

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">

    </form>

    </div>
  </body>
</html>
