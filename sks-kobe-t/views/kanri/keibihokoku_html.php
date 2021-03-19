<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">

  <!-- bootstrap-4.3.1 -->
  <link href="./../bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- 勤務複数検索 -->
  <link rel="stylesheet" href="./../multiple/multiple-select.min.css">
  <script src="./../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
  <script src="./../bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>
  <!-- 勤務複数検索 -->
  <script src="./../multiple/multiple-select.min.js"></script>

  <!-- fontawesome -->
  <link href="./../fontawesome-free-5.11.2-web/css/all.min.css" rel="stylesheet">
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>

  </head>

<script>
function confirm1(no,name) {
  if (!confirm(name + 'さんの項目を削除してもよろしいですか?')) return false;
    location.href = "kinmujokyosyousai.php?act=2&no=" + no;
//  location.href = "shift2.php?act=2&shift_id=" + no + "&shift_id2=" + no;
}

$(function(){
    //複数検索
    $('#genba_id').multipleSelect();
    
    $("input").on("keydown",function(ev){
      if ((ev.which && ev.which === 13) ||(ev.keyCode && ev.keyCode === 13)){
        return false;
      } else {
        return true;
      }
    });
    
    // 全選択ボタンの押下時
    $('#all-checked').on("click", function() {
      $('.teate-checked').prop("checked", $(this).prop("checked"));
    });
});
</script>

<style>
.ms-parent {
    padding:0;
}
.ms-choice {
    height:100%;
}
.td1{
    border:1px solid;
    background:#FFDCA5;
}
.td2{
    border:1px solid;
}
.td3{
    border:1px solid;
    background:#ffffa7;
}
.table1 td{
    padding:0;
    white-space: nowrap;
    text-align:center;
}
.table1 input{
    width:100%;
    text-align:center;
}
</style>

  <body>

<?php 
    $week = array("日", "月", "火", "水", "木", "金", "土");
?>

  <div class="container">
    <div class="page-header">
      <h4>警備報告一覧</h4>
    </div>

    <form name="frm" method="POST" action="keibihokoku.php">

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <table class="text-nowrap" border="1" style="font-size: 10pt; width:1100px" bgcolor="#d5d5d5">
            <tr>
              <td>
                <table class="text-nowrap" style="font-size: 10pt;">
                  <tr>
                    <td bgcolor="#d5d5d5">　日付　<input type="submit" name="prev" value="&lt;" ></td>
                    <td bgcolor="#d5d5d5"><input style="padding:0 0 0 5px; width: 155px"  type="date" size="8" class="form-control" name="startday" id="startday"
                        value="<?php print(substr($startday,0,4)."-".substr($startday,4,2)."-".substr($startday,6,2)); ?>"></td>
                    <td bgcolor="#d5d5d5">　～　</td>
                      <td bgcolor="#d5d5d5"><input style="padding:0 0 0 5px; width: 155px"  type="date" size="8" class="form-control" name="endday" id="endday"
                        value="<?php print(substr($endday,0,4)."-".substr($endday,4,2)."-".substr($endday,6,2)); ?>"></td>
                    <td bgcolor="#d5d5d5"><input type="submit" name="next" value="&gt;" >
                    　警備報告書　
                    </td>
                    <td bgcolor="#d5d5d5">
                      <select style="width: 170px"  id="genba_id" name="genba_id[]" class="form-control" multiple="multiple" size="1">
                        <?php for ($i=0;$i<count($reportname->oup_t_report_no);$i++) { ?>
                        <option value="<?php print($reportname->oup_t_report_no[$i]); ?>" 
<?php 
                        if ($genba_id) {
                            for ($j=0;$j<count($genba_id);$j++) {
                                if ($genba_id[$j]===$reportname->oup_t_report_no[$i]) {
                                    print("selected");
                                }
                            }
                        }
?>
                            ><?php print($reportname->oup_t_report_place[$i]." ".$reportname->oup_t_report_contract[$i]); ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td bgcolor="#d5d5d5" width="130">
                      <button type="submit" class="btn btn-info" role="button" name="search">検索</button>
                    </td>
                    <td bgcolor="#d5d5d5">
                      <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-12">
          <table>
            <tr>
              <td>チェックしたものを　<!-- <a href="#" class="btn btn-primary" role="button" aria-pressed="true">PDF出力</a> -->　</td>
              <td>Gチェック&nbsp;&#10004;&nbsp;　</td>
              <td>
                <select name="gchk1" class="form-control">
                  <option value="">
                  <option value="2">未
                  <option value="1">済
                </select>
              </td>
              <td>
                <button type="submit" class="btn btn-success btn-block" name="bundle">登録</button>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-12">
          <table class="text-nowrap" border="1" style="font-size: 10pt;" "width=1200" cellpadding="3" cellspacing="0">
              <tr class="text-center">
                <td width="30" bgcolor="FFDCA5">詳細</td>
                <td width="40" bgcolor="FFDCA5"><input type="checkbox" id="all-checked"></td>
                <td width="30" bgcolor="FFDCA5">G<br>&#10004;</td>
                <td width="80" bgcolor="FFDCA5">入力状態</td>
                <td width="50" bgcolor="FFDCA5">日付</td>
                <td width="30" bgcolor="FFDCA5">曜<br />日</td>
                <td width="155" bgcolor="FFDCA5">警備報告書</td>
                <td width="155" bgcolor="FFDCA5">勤務場所</td>
                <td width="155" bgcolor="FFDCA5">契約先</td>
                <td width="60" bgcolor="FFDCA5">PDF</td>
              </tr>
              <?php if (isset($report->oup_no)) { ?>
                  <?php for ($i=0;$i<count($report->oup_no);$i++) { ?>

                    <?php 
                        if ($i%2==0) {
                            $color = "bgcolor=\"e1f6fc\"";
                        } else {
                            $color = "";
                        }

                        $time = strtotime(date($report->oup_plan_date[$i]));
                        $w = date("w", $time);
                        $weekday = $week[$w];

                        if ($report->oup_gchk[$i]=="1") {
                            $gchk = "&#10004;";
                        } else {
                            $gchk = "";
                        }
                    ?>

                      <tr class="text-center">
                        <td <?php print($color); ?>><a href="report<?php print($report->oup_table[$i]); ?>.php?no=<?php echo $report->oup_no[$i]; ?>">
                            <i class="fas fa-pen"></i></a></td>
                        <td <?php print($color); ?>>
                          <input name="check_teate[<?php echo $i; ?>]" type="checkbox" class="teate-checked"
                            value="<?php echo $report->oup_no[$i]; ?>">
                        </td>
                        <td <?php print($color); ?>><?php print($gchk); ?></td>
                        <td <?php print($color); ?> align="left"><?php print($kbn[$report->oup_kbn[$i]]); ?></td>
                        <td <?php print($color); ?>><?php print(substr($report->oup_plan_date[$i],5,2)."/".substr($report->oup_plan_date[$i],8,2)); ?></td>
                        <td <?php print($color); ?>><?php print($weekday); ?></td>
                        <td <?php print($color); ?>></td>
                        <td <?php print($color); ?> align="left"><?php print($report_place[$report->oup_name_no[$i]]); ?></td>
                        <td <?php print($color); ?> align="left"><?php print($report_contract[$report->oup_name_no[$i]]); ?></td>
                        <td <?php print($color); ?>><a href="report<?php print($report->oup_table[$i]); ?>_pdf.php?no=<?php echo $report->oup_no[$i]; ?>" target="_blank"><i class="fas fa-file-pdf fa-2x"></i></a></td>
                      </tr>

                  <?php } ?>
              <?php } ?>
<!--
              <tr class="text-center">
                <td bgcolor="e1f6fc"><a href="report1.php">
                    <i class="fas fa-pen"></i></a></td>
                <td bgcolor="e1f6fc"><input name="check_teate[0]" type="checkbox" class="teate-checked"></td>
                <td bgcolor="e1f6fc">&#10004;</td>
                <td bgcolor="e1f6fc">02/16</td>
                <td bgcolor="e1f6fc">火</td>
                <td bgcolor="e1f6fc"></td>
                <td bgcolor="e1f6fc" align="left">PI・C-15.16.17　KICT</td>
                <td bgcolor="e1f6fc" align="left">商船港運株式会社</td>
                <td bgcolor="e1f6fc"><a href="../pdftest.php" target="_blank"><i class="fas fa-file-pdf fa-2x"></i></a></td>
              </tr>
              <tr class="text-center">
                <td><a href="report2.php">
                    <i class="fas fa-pen"></i></a></td>
                <td><input name="check_teate[1]" type="checkbox" class="teate-checked"></td>
                <td></td>
                <td>02/17</td>
                <td>水</td>
                <td></td>
                <td align="left">KFC</td>
                <td align="left">商船港運株式会社</td>
                <td><a href="../pdftest.php" target="_blank"><i class="fas fa-file-pdf fa-2x"></i></a></td>
              </tr>
              <tr class="text-center">
                <td bgcolor="e1f6fc"><a href="report3.php">
                    <i class="fas fa-pen"></i></a></td>
                <td bgcolor="e1f6fc"><input name="check_teate[2]" type="checkbox" class="teate-checked"></td>
                <td bgcolor="e1f6fc"></td>
                <td bgcolor="e1f6fc">02/18</td>
                <td bgcolor="e1f6fc">木</td>
                <td bgcolor="e1f6fc"></td>
                <td bgcolor="e1f6fc" align="left">L-6</td>
                <td bgcolor="e1f6fc" align="left">株式会社住友倉庫</td>
                <td bgcolor="e1f6fc"><a href="../pdftest.php" target="_blank"><i class="fas fa-file-pdf fa-2x"></i></a></td>
              </tr>
              <tr class="text-center">
                <td><a href="report5.php">
                    <i class="fas fa-pen"></i></a></td>
                <td><input name="check_teate[3]" type="checkbox" class="teate-checked"></td>
                <td></td>
                <td>02/18</td>
                <td>金</td>
                <td></td>
                <td align="left">RIC-4・C-5</td>
                <td align="left">三菱倉庫株式会社</td>
                <td><a href="../pdftest.php" target="_blank"><i class="fas fa-file-pdf fa-2x"></i></a></td>
              </tr>
-->
          </table>
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-12">
          <table>
            <tr>
              <td>チェックしたものを　<!-- <a href="#" class="btn btn-primary" role="button" aria-pressed="true">PDF出力</a> -->　</td>
              <td>Gチェック&nbsp;&#10004;&nbsp;　</td>
              <td>
                <select name="gchk2" class="form-control">
                  <option value="">
                  <option value="2">未
                  <option value="1">済
                </select>
              </td>
              <td>
                <button type="submit" class="btn btn-success btn-block" name="bundle">登録</button>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-12">
          <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
        </div>
      </div>

    </form>

  </div>

  </body>

</html>
