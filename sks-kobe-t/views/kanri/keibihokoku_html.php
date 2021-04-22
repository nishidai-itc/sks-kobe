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

  <script src="../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
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
        <div class="col-6">
          <label>チェックしたものを　</label>
          <label>Gチェック&nbsp;&#10004;&nbsp;　</label>
          <div class="d-inline-block">
            <select name="gchk1" class="form-control">
              <option value="">
              <option value="2">未
              <option value="1">済
            </select>
          </div>
          <div class="d-inline-block"><button type="submit" class="btn btn-success btn-block" name="bundle">登録</button></div>
        </div>
        <div class="col-3">
          <div class="d-inline-block"><button type="button" class="mail_send btn btn-success btn-block">全件メール送信</button></div>
        </div>
        
        <?php /* ?>
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
        <?php */ ?>
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
                <td width="155" bgcolor="FFDCA5">勤務場所</td>
                <td width="155" bgcolor="FFDCA5">契約先</td>
                <td width="60" bgcolor="FFDCA5">PDF</td>
                <td class="px-3" bgcolor="FFDCA5">メール送信</td>
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
                        <td <?php print($color); ?> align="left"><?php print($report_place[$report->oup_name_no[$i]]); ?></td>
                        <td <?php print($color); ?> align="left"><?php print($report_contract[$report->oup_name_no[$i]]); ?></td>
                        <td <?php print($color); ?>><a href="report<?php print($report->oup_table[$i]); ?>_pdf.php?no=<?php echo $report->oup_no[$i]; ?>" target="_blank"><i class="fas fa-file-pdf fa-2x"></i></a></td>
                        <td <?php print($color); ?>>
                          <?php /* ?>
                          <span class="mail badge badge-primary p-1" style="cursor: pointer;"><font size="2em;">送信</font></span>
                          <input type="hidden" name="" value="<?php echo $report->oup_no[$i].','.$report->oup_table[$i];?>">
                          <input type="hidden" value="<?php echo substr($report->oup_plan_date[$i],5,2).'/'.substr($report->oup_plan_date[$i],8,2).','.$report_place[$report->oup_name_no[$i]];?>">
                          <?php */ ?>
                          <?php echo $reportMail->oup_t_report_kanri_no && in_array($report->oup_no[$i],$reportMail->oup_t_report_kanri_no) ? "<font color='blue'>済</font>" : "未"; ?>
                        </td>
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
<script type="text/javascript">
  /*
  $('.mail').click(function(){
    var name = $(this).next().next().val()
    name = name.split(',')

    if (!confirm(name[1]+'を送信します。よろしいですか？')) return false
    
    var no = $(this).next().val()
    no = no.split(',')

    if (no[1] != '1') return false

    $.ajax({
      type: 'get',
      url: 'report'+no[1]+'_pdf.php',
      data: {
        act: 'mail',
        no: no[0],
      },
      dataType: 'json'
    }).done(function(data){
      console.log(data)
      if (data) {
        alert('メール送信完了しました。')
      }
    }).fail(function(data){
      alert('通信エラー')
    })
    // console.log(no)
  })
  */

  var dataList = {
    act: 'reportGchk',
    startdate: $('[name="startday"]').val(),
    enddate: $('[name="endday"]').val(),
  }

  $('.mail_send').click(async function(){
    if (!confirm('警備報告書をメール送信します。よろしいですか？')) return false
    
    // 順番に処理
    reAjax(dataList)
    .then(async function(data){
      // console.log(data)
      if (!data || data == 'mail') {
        return new Promise(() => {
          throw data == 'mail' ? '既に送信済です。' : '警備報告書がないかGチェック済のものがありません。'
        })
      } else {
        return data
      }
    })
    .then(async function(data){
      const reportList = data
      var datas = []
      var flg = []
      for (report in reportList) {
        for (report2 of reportList[report]) {
          var report2 = report2.split(',')
          // if (Number(report2[1]) !== 1) {continue}
          datas.push(report2[0]+','+report2[1])
          if (Number(report2[1]) === 8 || Number(report2[1]) === 9 || Number(report2[1]) === 10) {
            flg.push(report2[0].substr(0,8))
            continue
          }
          await reportSend(report2[1],{act: 'mail',no: report2[0]})
        }
      }

      // 警備報告書（A.B.誘導）
      if (flg.length) {
        flg = Array.from(new Set(flg))    // 重複削除
        for (report of flg) {
          await ajaxController({act: 'reportSend',date: report})
        }
      }

      await ajaxController({act: 'addUpReportMail',no: datas})
      return data

      /*
      const reportList = data
      for (report of reportList) {
        var report = report.split(',')
        if (Number(report[1]) !== 1) {continue;}    // とりあえずKICTのみ
        await reportSend(report[1],{act: 'mail',no: report[0]})
      }
      await ajaxController({act: 'addUpReportMail',no: data})
      */
    })
    // メール送信
    .then(async function(data){
      for (list in data) {
        await ajaxController({act: 'mailSend',dataList: {id: list ,data: data[list]}})
      }

      return '送信完了しました。'
    })
    // 完了をアラート
    .then(async function(data){
      await alertMsg(data)
    })
    .then(async function(data){
      $('form').submit()
    })
    // エラーがあればアラート表示
    .catch(async function(data){
      await alertMsg(data)
    })
    
    
    /*await $.ajax({
      type: 'post',
      url: './ajaxController.php',
      data: {
        act: 'reportGchk',
        startdate: $('[name="startday"]').val(),
        enddate: $('[name="endday"]').val(),
      },
      dataType: 'json'
    }).done(async function(data){
      // console.log(data)
      if (!data) {
        alert('警備報告書がないかGチェック済のものがありません。')
        return
      }

      const reportList = data
      for (report of reportList) {
        var report = report.split(',')

        if (Number(report[1]) !== 1) {continue;}

        await reportSend(report[1],{act: 'mail',no: report[0]})
      }

      await ajaxController({act: 'addUpReportMail',no: data})

      alert('送信完了しました。')

    }).fail(async function(data){
      alert('通信エラー')
    })
    */

  })

  async function reportSend(urlNo,dataList) {
    $.ajax({
      type: 'get',
      url: 'report'+urlNo+'_pdf.php',
      data: dataList,
      dataType: 'json'
    }).done(function(data){
    })
  }

  async function ajaxController(dataList) {
    $.ajax({
      type: 'post',
      url: 'ajaxController.php',
      data: dataList,
      dataType: 'json'
    }).done(function(data){
      // console.log(data)
    })
  }

  async function reAjax(dataList) {
    return $.ajax({
      type: 'post',
      url: 'ajaxController.php',
      data: dataList,
      dataType: 'json'
    }).done(function(data){
    })
  }

  async function alertMsg(msg) {
    alert(msg)
  }
</script>