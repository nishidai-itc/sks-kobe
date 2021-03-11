<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">

    <!-- bootstrap-4.3.1 -->
    <link href="./bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="./bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
    <script src="./bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>

    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script> -->

    <!-- <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css"> -->
    
    <title>勤怠管理システム</title>
  </head>

<script type="text/javascript">
function func() {
    document.frm.submit();
}
function func2(arg1) {
    document.frm.act.value='2';
    document.frm.work_day.value=arg1;
    document.frm.submit();
}

// $(function() {
//       $("#datepicker").datepicker();
// });

// -->
</script>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>祝日登録</h4>
      </div>

      <form name="frm" method="POST" action="holiday2.php" autocomplete="off">

        <div class="card" style="padding: 10px;">
          <div class="card-body">
            <?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん<br /><?php print(date('m/d')) ?>(<?php print($week[$w]); ?>) <?php print(date('h:i')) ?>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-6">
            <table class="table table-sm table-bordered">
              <tr class="text-center">
                <td bgcolor="FFDCA5">日付</td>
                <!-- <td><input type="text" name="holiday_date" class="form-control form-control-sm" value="<?php print($holiday->oup_date[0]); ?>" id="datepicker"></td> -->
                <td><input type="date" name="holiday_date" class="form-control form-control-sm" value="<?php print($holiday->oup_date[0]); ?>"></td>
              </tr>
          </div>
          <div class="col-6">

              <tr class="text-center">
                <td bgcolor="FFDCA5">祝日名</td>
                <td><input type="text" name="holiday_name" class="form-control form-control-sm" value="<?php print($holiday->oup_hol_name[0]); ?>"></td>
              </tr>
              </div>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <button type="button" onclick="submit();" class="btn btn-success btn-block" role="button">登録</button>
          </div>
          <div class="col-6">
            <a href="holiday1.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />

        <input type="hidden" name="act" value="1">
        <input type="hidden" name="holiday_no" value="<?php print($holiday->oup_id[0]); ?>">
        </form>

    </div>

      <div class="modal-footer">
          <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
      </div><!-- /footer -->

  </body>
</html>
