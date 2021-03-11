<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
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
            <table>
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

            <table class="test">
              <tr align="center">
                <td bgcolor="FFDCA5" rowspan="2" style="border: solid 1px;">氏名</td>
                <td bgcolor="FFDCA5" rowspan="2" style="border: solid 1px;">勤務</td>
                <td bgcolor="FFDCA5" rowspan="2" style="border: solid 1px;"><input type="checkbox" name="rd1" checked><br />通</td>
                <td bgcolor="FFDCA5" style="border: solid 1px;">シフト</td>
                <td rowspan="2"></td>
                <td bgcolor="FFDCA5" colspan="5" style="border: solid 1px;">時間外勤務（残業）</td>
                <td rowspan="2"></td>
                <td bgcolor="FFDCA5" rowspan="2" style="border: solid 1px;">交通費</td>
                <td bgcolor="FFDCA5" style="border: solid 1px;">ポスト</td>
                <td bgcolor="FFDCA5" style="border: solid 1px;">危険物</td>
              </tr>
              <tr align="center">
                <td bgcolor="FFDCA5" style="border: solid 1px;">当日上下番</td>
                <td bgcolor="FFDCA5" style="border: solid 1px;">早／残</td>
                <td bgcolor="FFDCA5" style="border: solid 1px;">昼残</td>
                <td bgcolor="FFDCA5" colspan="2" style="border: solid 1px;">深夜残業</td>
                <td bgcolor="FFDCA5" style="border: solid 1px;" >その他残業</td>
                <td bgcolor="FFDCA5" style="border: solid 1px;">車</td>
                <td bgcolor="FFDCA5" style="border: solid 1px;">その他</td>
              </tr>
              <tr align="center" bgcolor="lightyellow">
                <td rowspan="2" style="border-bottom: solid 1px; border-right: solid 1px;">山田　太郎</td>
                <td rowspan="2" style="border-bottom: solid 1px; ">日勤</td>
                <td style="border-bottom: solid 1px;"></td>
                <td style="border-bottom: solid 1px; border-right: solid 1px;">8:00 - 17:00</td>
                <td rowspan="2"></td>
                <td style="border-left: solid 1px; border-right: solid 1px;">1.0</td>
                <td align="left" style="border-right: solid 1px;"  ><input type="radio" checked>1.0</td>
                <td nowrap align="left" style="border-right: solid 1px;">1 <input type="time" id="name" value="22:00"  class="inputSample" > - <input type="time" id="name" value="22:15" class="inputSample"> 0.25</td>
                <td nowrap align="left" style="border-right: solid 1px;">2 <input type="time" id="name" value="22:30"  class="inputSample" > - <input type="time" id="name" value="22:45" class="inputSample"> 0.25</td>
                <td nowrap style="border-right: solid 1px;"><input type="time" id="name" value="21:00" class="inputSample"> - <input type="time" id="name" value="21:15" class="inputSample"> 0.25</td>
                <td></td>
                <td rowspan="2" style="border-left: solid 1px;border-right: solid 1px;border-bottom: solid 1px;">
                    <select name="blood">
                    <option value="A"></option>
                    <option value="B">500</option>
                    <option value="O">600</option>
                    <option value="AB">800</option>
                    </select>
                </td>
                <td style="border-right: solid 1px; border-bottom: solid 1px;"><input type="text" id="name" value="" size="4"></td>
                <td style="border-bottom: solid 1px;"><input type="text" id="name" value="" size="4"></td>
              </tr>
              <tr align="center" bgcolor="lightyellow">
                <td style="border-left: solid 1px;border-bottom: solid 1px; border-right: solid 1px;"><input type="checkbox" name="rd1" checked ></td>
                <td style="border-bottom: solid 1px;">7:00 - <input type="time" id="name" value="" class="inputSample"></td>
                <td style="border-bottom: solid 1px; border-right: solid 1px;">1.0</td>
                <td align="left" style="border-bottom: solid 1px; border-right: solid 1px;"><input type="radio">0.5</td>
                <td align="left" style="border-bottom: solid 1px; border-right: solid 1px;">3 <input type="time" id="name" value=""  class="inputSample" > - <input type="time" id="name" value="" class="inputSample"></td>
                <td align="left" style="border-bottom: solid 1px; border-right: solid 1px;">4 <input type="time" id="name" value=""  class="inputSample" > - <input type="time" id="name" value="" class="inputSample"></td>
                <td style="border-bottom: solid 1px; border-right: solid 1px;"></td>
                <td></td>
                <td style="border-right: solid 1px; border-bottom: solid 1px;"><input type="text" id="name" value="" size="4"></td>
                <td style="border-bottom: solid 1px;"><input type="text" id="name" value="" size="4"></td>
              </tr>

              <tr align="center">
                <td rowspan="2" style="border-bottom: solid 1px; border-right: solid 1px;">宮内</td>
                <td rowspan="2" style="border-bottom: solid 1px; ">日勤</td>
                <td style="border-bottom: solid 1px;"></td>
                <td style="border-bottom: solid 1px; border-right: solid 1px;">8:00 - 17:00</td>
                <td rowspan="2"></td>
                <td style="border-left: solid 1px; border-right: solid 1px;">1.0</td>
                <td align="left" style="border-right: solid 1px;"  ><input type="radio">1.0</td>
                <td nowrap align="left" style="border-right: solid 1px;">1 <input type="time" id="name" value=""  class="inputSample" > - <input type="time" id="name" value="" class="inputSample"></td>
                <td nowrap align="left" style="border-right: solid 1px;">2 <input type="time" id="name" value=""  class="inputSample" > - <input type="time" id="name" value="" class="inputSample"></td>
                <td nowrap style="border-right: solid 1px;"><input type="time" id="name" value="" class="inputSample"> - <input type="time" id="name" value="" class="inputSample"></td>
                <td></td>
                <td rowspan="2" style="border-left: solid 1px;border-right: solid 1px;border-bottom: solid 1px;">
                    <select name="blood">
                    <option value="A"></option>
                    <option value="B">500</option>
                    <option value="O">600</option>
                    <option value="AB">800</option>
                    </select>
                </td>
                <td style="border-right: solid 1px; border-bottom: solid 1px;"><input type="text" id="name" value="" size="4"></td>
                <td style="border-bottom: solid 1px;"><input type="text" id="name" value="" size="4"></td>
              </tr>
              <tr align="center">
                <td style="border-left: solid 1px;border-bottom: solid 1px; border-right: solid 1px;"><input type="checkbox" name="rd1" checked ></td>
                <td style="border-bottom: solid 1px;">7:00 - <input type="time" id="name" value="" class="inputSample"></td>
                <td style="border-bottom: solid 1px; border-right: solid 1px;">1.0</td>
                <td align="left" style="border-bottom: solid 1px; border-right: solid 1px;"><input type="radio" checked>0.5</td>
                <td align="left" style="border-bottom: solid 1px; border-right: solid 1px;">3 <input type="time" id="name" value=""  class="inputSample" > - <input type="time" id="name" value="" class="inputSample"></td>
                <td align="left" style="border-bottom: solid 1px; border-right: solid 1px;">4 <input type="time" id="name" value=""  class="inputSample" > - <input type="time" id="name" value="" class="inputSample"></td>
                <td style="border-bottom: solid 1px; border-right: solid 1px;"></td>
                <td></td>
                <td style="border-right: solid 1px; border-bottom: solid 1px;"><input type="text" id="name" value="" size="4"></td>
                <td style="border-bottom: solid 1px;"><input type="text" id="name" value="" size="4"></td>
              </tr>
            </table>




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
