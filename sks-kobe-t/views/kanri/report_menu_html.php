<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">

<?php 
header("Cache-Control:no-cache,no-store,must-revalidate,max-age=0");
header("Cache-Control:pre-check=0,post-check=0,false");
header("Pragma:no-cache");
?>

  <!-- bootstrap-4.3.1 -->
  <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../fontawesome-free-5.11.2-web/css/all.min.css" rel="stylesheet">
  <script src="../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
  <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="../multiple/multiple-select.min.css">
  <script src="../multiple/multiple-select.min.js"></script>

  <title>勤怠管理システム</title>
</head>

<style>
.ms-parent{
  padding: 0 !important;
}
.ms-choice{
  height: 100% !important;
}
</style>

<body>
  <div class="container">
    <!-- ヘッダー -->
    <div class="page-header d-flex">
      <h4>警備報告書メニュー</h4>
      <h5>　(sks-system.com)</h5>
    </div>

    <!-- ログイン者情報 -->
    <div class="row">
      <div class="col-12">
        <div class="card" style="padding: 10px;">
          <div class="card-body">
            <?php print($common->html_display($staff->oup_m_staff_name[0])." さん　　　".date("m/d")."(".getWeek($today).")".$totime); ?>
          </div>
        </div>
      </div>
    </div>
    <br>

    <form action="report_menu.php" method="post">

    <div class="row bg-white head">
      <div class="col-5">
        <!-- <div class="pb-2">
          <span class="yestarday badge badge-secondary" style="cursor: pointer;">前日</span>
          <span class="today badge badge-secondary" style="cursor: pointer;">当日</span>
        </div> -->
        <div>
          <label for="">日付</label>
          <div class="d-inline-block">
            <input type="date" class="form-control" name="plan_start_date" value="<?php echo $plan_start_date;?>">
          </div>
          <label for="">～</label>
          <div class="d-inline-block">
            <input type="date" class="form-control" name="plan_end_date" value="<?php echo $plan_end_date;?>">
          </div>
        </div>
      </div>
      <div class="col-4">
        <!-- <div class="pb-2">&nbsp;</div> -->
        <select name="place[]" id="place" class="form-control" multiple="multiple">
          <!-- <option value=""></option> -->
          <?php for ($i=0;$i<count($report->oup_no);$i++) { ?>
          <option value="<?php echo $report->oup_table[$i];?>" <?php echo $place && in_array($report->oup_table[$i],$place) ? "selected" : "" ;?>><?php echo $report->oup_place[$i];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-1">
        <!-- <div class="pb-2">&nbsp;</div> -->
        <button type="button" class="search btn btn-success btn-block" role="button">検索</button>
      </div>
      <div class="col-2">
        <!-- <div class="pb-2">&nbsp;</div> -->
        <button type="button" class="btn btn-secondary btn-block" role="button" onclick="menuBack()">メニューに戻る</button>
      </div>
    </div>
    <br>

    <?php /* ?>
    <div class="row">
      <div class="col-3">
        <label><?php echo substr($plan_date,5,2)."月".substr($plan_date,8,2)."日分　(".getWeek($plan_date).")"; ?></label>
      </div>
      <!-- <div class="col-1">
        <button type="button" class="yesterday btn btn-secondary btn-block" role="button">前日</button>
      </div>
      <div class="col-1">
        <button type="button" class="today btn btn-secondary btn-block" role="button">当日</button>
      </div> -->
    </div>
    <br>
    <?php */ ?>

    <!-- メニュー -->
    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <thead>
            <tr class="table-secondary">
              <th class="head2 text-center" style="width:100px;">日付</th>
              <th class="head2" style="width:100px;">入力状態</th>
              <th class="head2 text-center" style="width:100px;">詳細</th>
              <th class="head2">勤務場所</th>
              <th class="head2">契約先</th>
              <th class="head2">PDF</th>
              <th class="head2 text-center" style="width:100px;">削除</th>
            </tr>
          </thead>
          <?php /*for ($i=0;$i<count($report->oup_no);$i++) { ?>
          <?php if (!$flg[$report->oup_no[$i]]) {continue;} ?>
          <tr>
            <td></td>
            <!-- <td class="text-center"><?php echo substr($plan_date,5,2)."/".substr($plan_date,8,2)."(".getWeek($plan_date).")"; ?></td> -->
            <td><?php echo $report_kbn[$report->oup_table[$i]] ? $report_kbn[$report->oup_table[$i]] : "未入力" ; ?></td>
            <td class="text-center">
              <a href="./report<?php echo $report->oup_table[$i]; ?>.php?plan_date=<?php echo $report_no[$report->oup_table[$i]] ? $plan_date."&no=".$report_no[$report->oup_table[$i]] : $plan_date ; ?>">
                <i class="fas fa-pen"></i>
              </a>
            </td>
            <td><?php echo $report->oup_place[$i]; ?></td>
            <td><?php echo $report->oup_contract[$i]; ?></td>
            <td>
            <?php if ($report_no[$report->oup_table[$i]]) { ?>
              <a href="report<?php echo $report->oup_table[$i] ; ?>_pdf.php?no=<?php echo $report_no[$report->oup_table[$i]]; ?>" target="_blank"><i class="fas fa-file-pdf fa-2x"></i></a>
            <?php } ?>
            </td>
            <td class="text-center">
              <?php if ($report_no[$report->oup_table[$i]]) { ?>
              <a href="#" onclick="conf(<?php echo $report_no[$report->oup_table[$i]].','.$report->oup_table[$i] ; ?>);">
                <i class="fa fa-times" style="color: red;"></i>
              </a>
              <?php } ?>
            </td>
          </tr>
          <?php }*/ ?>
          
          <?php for ($i=0;$i<count($report4->oup_no);$i++) { ?>
            <?php if ($place && !in_array($report4->oup_table[$i],$place)) {continue;} ?>
            <?php for ($j=$plan_start_date;$j<=$plan_end_date;$j=date("Y-m-d",strtotime($j."+1 day"))) { ?>
            <?php if (!$flg[str_replace("-","",$j).$report4->oup_table[$i]]) {continue;} ?>
            <tr>
              <td class="text-center"><?php echo substr($j,5,2)."/".substr($j,8,2)." (".getWeek($j).")";?></td>
              <td><?php echo $report_kbn[str_replace("-","",$j).$report4->oup_table[$i]] ? $report_kbn[str_replace("-","",$j).$report4->oup_table[$i]] : "未入力";?></td>
              <td class="text-center">
                <a href="./report<?php echo $report4->oup_table[$i]; ?>.php?plan_date=<?php echo $j; ?><?php echo $report_no[str_replace("-","",$j).$report4->oup_table[$i]] ? "&no=".$report_no[str_replace("-","",$j).$report4->oup_table[$i]] : "";?>">
                  <i class="fas fa-pen"></i>
                </a>
                <?php /*if (in_array(str_replace("-","",$j).$report4->oup_table[$i],$report5->oup_no)) { ?>
                true
                <?php } else { ?>
                false
                <?php }*/ ?>
              </td>
              <td><?php echo $report4->oup_place[$i]; ?></td>
              <td><?php echo $report4->oup_contract[$i]; ?></td>
              <td class="text-center">
                <?php if ($report_no[str_replace("-","",$j).$report4->oup_table[$i]]) { ?>
                <a href="report<?php echo $report4->oup_table[$i] ; ?>_pdf.php?no=<?php echo $report_no[str_replace("-","",$j).$report4->oup_table[$i]]; ?>" target="_blank"><i class="fas fa-file-pdf fa-2x"></i></a>
                <?php } ?>
              </td>
              <td class="text-center">
                <?php if ($report_no[str_replace("-","",$j).$report4->oup_table[$i]]) { ?>
                <a href="#" onclick="conf(<?php echo $report_no[str_replace('-','',$j).$report4->oup_table[$i]].','.$report4->oup_table[$i] ; ?>);">
                  <i class="fa fa-times" style="color: red;"></i>
                </a>
                <?php } ?>
              </td>
            </tr>
            <?php } ?>
          <?php } ?>
        </table>
      </div>
    </div>
    <br>

    <input type="hidden" name="no" value="">
    <input type="hidden" name="act" value="2">
    </form>

    <div class="row">
      <!-- メニューに戻る -->
      <div class="col-12 my-1">
        <button type="button" class="back btn btn-secondary btn-block" role="button" onclick="menuBack()">メニューに戻る</button>
      </div>
    </div>
    <br>

  </div>
</body>

</html>

<script type="text/javascript">
// var headHeight = $('.head').outerHeight()
// $('.head').css({
//   position: 'sticky',
//   top: '0',
// })
// $('.head2').css({
//   position: 'sticky',
//   top: headHeight+'px',
// })
// $('.head, .head2').css('z-index','100')

$('#place').multipleSelect()

$('.back, a').css('height','50px')

function menuBack() {
  location.href = '../menu.php'
}

/*
$('.yestarday, .today').click(function(){
  var todate = '<?php echo $todate; ?>'
  todate = todate.split('-')
  todate = new Date(todate[0],Number(todate[1])-1,Number(todate[2]))
  var year
  var month
  var day

  if ($(this).hasClass('yestarday')) {
    year = todate.getFullYear()
    todate.setDate(todate.getDate() - 1)
    month = todate.getMonth()+1
    day = todate.getDate()
    month = ('00'+month).slice(-2)
    day = ('00'+day).slice(-2)
    $('[name="plan_start_date"]').val(year+'-'+month+'-'+day)
    $('[name="plan_end_date"]').val(year+'-'+month+'-'+day)
  } else {
    year = todate.getFullYear()
    month = todate.getMonth()+1
    month = ('00'+month).slice(-2)
    day = todate.getDate()
    month = ('00'+month).slice(-2)
    day = ('00'+day).slice(-2)
    $('[name="plan_start_date"]').val(year+'-'+month+'-'+day)
    $('[name="plan_end_date"]').val(year+'-'+month+'-'+day)
  }
  $('.search').click()
})
*/

$('.search').click(function(){
  $('[name="act"]').val('1')
  $('form').submit()
})

function conf(no,table) {
  if (!confirm('警備報告書を削除します。よろしいですか？')) return false

  $('[name="no"]').val(no+','+table)
  $('form').submit()
}

// $('.report1').click(function(){
//   location.href = './report1.php'
// })
</script>