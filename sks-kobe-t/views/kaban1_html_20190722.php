<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" media="screen, projection" />
    <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery.balloon.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>
  </head>

<script language="JavaScript" type="text/javascript">
<!--
  // 「全て選択」チェックで全てにチェック付く
  function AllChecked(){
    var chked = document.getElementById('all').checked;

<?php for($i=0;$i<count($work_mem->oup_t_work_taiin_id);$i++) { ?>
    document.getElementById('in_normal<?php echo $i; ?>').checked = chked;
//    document.getElementById('jtime<?php echo $i; ?>').value = document.getElementById('plan_time<?php echo $i; ?>').value;
<?php } ?> 
  }
// -->
</script>

<style>
table.test {
  border-collapse: collapse;
  border: solid 2px black;/*表全体を線で囲う*/
}
table.test th, table.test td {
//  border: solid 1px black;/**/
  text-align:center;
  /*破線 1px オレンジ*/
  padding : 1px ;
}
.inputSample {
    width:78px;
    font-size: 11pt;
    padding: 5px;
//    background-color: #ccffff;
//    border: 1px inset #00ccff;
}
</style>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>下番報告（リーダー用）</h4>
      </div>

      <form name="frm" method="POST" action="login.php">

        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table class="table table-bordered">
              <tr>
                <td bgcolor="FFDCA5" align="center">勤務者</td>
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
                <td bgcolor="FFDCA5" rowspan="3">氏名</td>
                <td bgcolor="FFDCA5" rowspan="3">勤務</td>
                <td bgcolor="FFDCA5" rowspan="3">開始<br />終了</td>
                <td bgcolor="FFDCA5" rowspan="3">上番<br />時刻</td>
                <td bgcolor="92D050" rowspan="2" colspan="2"><label class="btn btn-info btn-block" role="button" aria-pressed="true" style="width:60px">通</label></td>
                <td rowspan="33"></td>
                <td bgcolor="FFC000" rowspan="3">昼残</td>
                <td bgcolor="FFC000" rowspan="3">時間外</td>
                <td bgcolor="FFC000" rowspan="3">深夜</td>
                <td bgcolor="FFC000" rowspan="3">ﾎﾟｽﾄ手当</td>
              </tr>
              <tr align="center">
                <td bgcolor="FFC000" rowspan="2">交通費</td>
                <td bgcolor="FFC000" rowspan="2">その他</td>
              </tr>
              <tr align="center">
                <td bgcolor="92D050" colspan="2">下番</td>
              </tr>
              <tr align="center">
                <td>福島</td>
                <td>日勤</td>
                <td>8:00<br />18:00</td>
                <td>7:30</td>
                <td><input type="checkbox" name="rd1" checked></td>
                <td>19:00</td>
                <td><input type="time" class="inputSample" ><br /><input type="time" class="inputSample" ></td>
                <td><input type="time" class="inputSample" ><br /><input type="time" class="inputSample" ></td>
                <td><table><tr><td style="border: none;"><input type="time" class="inputSample" ></td><td style="border: none;">～</td><td style="border: none;"><input type="time" class="inputSample" ></td></tr><tr><td style="border: none;"><input type="time" class="inputSample" ></td><td style="border: none;">～</td><td style="border: none;"><input type="time" class="inputSample" ></td></tr><tr><td style="border: none;"><input type="time" class="inputSample" ></td><td style="border: none;">～</td><td style="border: none;"><input type="time" class="inputSample" ></td></tr><tr><td style="border: none;"><input type="time" class="inputSample" ></td><td style="border: none;">～</td><td style="border: none;"><input type="time" class="inputSample" ></td></tr></table></td>
                <td>500</td>
                <td>1280</td>
                <td><input type="text" class="inputSample" ><br /><input type="text" class="inputSample" ><br /><input type="text" class="inputSample" ></td>
              </tr>
              <tr align="center">
                <td>井上</td>
                <td>日勤</td>
                <td>8:00<br />18:00</td>
                <td>7:00</td>
                <td><input type="checkbox" name="rd1" checked></td>
                <td>17:00</td>
                <td><input type="time" class="inputSample" ><br /><input type="time" class="inputSample" ></td>
                <td><input type="time" class="inputSample" ><br /><input type="time" class="inputSample" ></td>
                <td><table><tr><td style="border: none;"><input type="time" class="inputSample" ></td><td style="border: none;">～</td><td style="border: none;"><input type="time" class="inputSample" ></td></tr><tr><td style="border: none;"><input type="time" class="inputSample" ></td><td style="border: none;">～</td><td style="border: none;"><input type="time" class="inputSample" ></td></tr><tr><td style="border: none;"><input type="time" class="inputSample" ></td><td style="border: none;">～</td><td style="border: none;"><input type="time" class="inputSample" ></td></tr><tr><td style="border: none;"><input type="time" class="inputSample" ></td><td style="border: none;">～</td><td style="border: none;"><input type="time" class="inputSample" ></td></tr></table></td>
                <td>500</td>
                <td>1280</td>
                <td><input type="text" class="inputSample" ><br /><input type="text" class="inputSample" ><br /><input type="text" class="inputSample" ></td>
              </tr>
              <tr align="center">
                <td>山田</td>
                <td>日勤</td>
                <td>8:00<br />18:00</td>
                <td>7:30</td>
                <td><input type="checkbox" name="rd1" checked></td>
                <td>19:00</td>
                <td><input type="time" class="inputSample" ><br /><input type="time" class="inputSample" ></td>
                <td><input type="time" class="inputSample" ><br /><input type="time" class="inputSample" ></td>
                <td><table><tr><td style="border: none;"><input type="time" class="inputSample" ></td><td style="border: none;">～</td><td style="border: none;"><input type="time" class="inputSample" ></td></tr><tr><td style="border: none;"><input type="time" class="inputSample" ></td><td style="border: none;">～</td><td style="border: none;"><input type="time" class="inputSample" ></td></tr><tr><td style="border: none;"><input type="time" class="inputSample" ></td><td style="border: none;">～</td><td style="border: none;"><input type="time" class="inputSample" ></td></tr><tr><td style="border: none;"><input type="time" class="inputSample" ></td><td style="border: none;">～</td><td style="border: none;"><input type="time" class="inputSample" ></td></tr></table></td>
                <td>500</td>
                <td>1280</td>
                <td><input type="text" class="inputSample" ><br /><input type="text" class="inputSample" ><br /><input type="text" class="inputSample" ></td>
              </tr>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <a href="menu.php" class="btn btn-success btn-block btn-lg" role="button" aria-pressed="true">下番報告</a>
          </div>
          <div class="col-6">
            <a href="menu.php" class="btn btn-secondary btn-block btn-lg" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />



<?php /* ?>
        <br />
        <div class="row">
          <div class="col-6">
            <a href="kaban2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規</a>
          </div>
          <div class="col-6">
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
              <tr align="center">
                <td width="40" bgcolor="FFDCA5"><input type="checkbox" name="rd0" id='all' onClick="AllChecked();"><br />通<br />常</td>
                <td width="85" bgcolor="FFDCA5">氏名</td>
                <td width="60" bgcolor="FFDCA5">勤務</td>
                <td width="60" bgcolor="FFDCA5">上番<br />時刻</td>
                <td width="60" bgcolor="FFDCA5">開始<br />終了</td>
                <td width="50" bgcolor="FFDCA5">早退<br />残有</td>
              </tr>

<?php for($i=0;$i<count($work_mem->oup_t_work_taiin_id);$i++) { ?>

              <tr align="center" <?php if ($work_mem->oup_t_work_plan_kbn[$i]=="3") { print("bgcolor=\"powderblue\""); } ?>>
                <td><input type="radio" name="kaban_kbn[<?php echo $i; ?>]" id="in_normal<?php echo $i; ?>" value="1" <?php echo $checked1; ?>></td>
                <td><?php echo $staff_name[$i]; ?></td>
                <td><?php echo $kinmu[$i]; ?></td>
                <td><?php echo $joban_time[$i]; ?></td>
                <td><?php echo $p_joban_time[$i]; ?><br /><?php echo $p_kaban_time[$i]; ?></td>
                <td bgcolor="FFDCA5"><a href="kaban2.php?id=<?php print($work_mem->oup_t_work_taiin_id[$i]); ?>">詳</a></td>
              </tr>

<?php } ?>

            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <a href="kaban1.php" class="btn btn-success btn-block" role="button" aria-pressed="true">下番報告</a>
          </div>
          <div class="col-6">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />
<?php */ ?>

      </form>

    </div>

      <div class="modal-footer">
          <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
      </div><!-- /footer -->

  </body>

</html>
