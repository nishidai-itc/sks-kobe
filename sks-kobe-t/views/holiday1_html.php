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

  <!-- fontawesome -->
  <link href="./fontawesome-free-5.11.2-web/css/all.min.css" rel="stylesheet">

  <title>勤怠管理システム</title>
</head>

<script>

function confirm1(no) {
  if (!confirm('この項目を削除してもよろしいですか?')) return false;
  location.href = "holiday2.php?act=2&holiday_no=" + no;
}

</script>

<body>
  <div class="container">
    <div class="page-header">
      <h4>祝日登録</h4>
    </div>

    <form name="frm" method="POST" action="login.php">

      <div class="card" style="padding: 10px;">
        <div class="card-body">
          <?php print($common->html_display($staff->oup_m_staff_name[0])); ?>
          さん<br /><?php print(date('m/d')) ?>(<?php print($week[$w]); ?>) <?php print(date('h:i')) ?>
        </div>
      </div>
      <br />
      <div class="row">
        <div class="col-6">
          <a href="holiday2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規登録</a>
        </div>
        <div class="col-6">
          <a href="kanri/menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
        </div>
      </div>
      <br />
      <div class="row">
        <div class="col-12">
          <table class="table table-sm table-bordered">
            <tr class="text-center">
              <td bgcolor="FFDCA5">&nbsp;</td>
              <td bgcolor="FFDCA5">日付</td>
              <td bgcolor="FFDCA5">祝日名</td>
              <!-- <td bgcolor="FFDCA5">出発</td>
              <td bgcolor="FFDCA5">到着</td>
              <td bgcolor="FFDCA5">金額</td> -->
              <td bgcolor="FFDCA5">&nbsp;</td>
            </tr>
            <?php if ($holiday->oup_id) { ?>
            <?php for ($i=0;$i<count($holiday->oup_id);$i++) { ?>
            <tr class="text-center">
              <td>
                <a href="holiday2.php?no=<?php print($holiday->oup_id[$i]); ?>">
                  <i class="fas fa-pen"></i>
                </a>
              </td>
              <td><?php print($holiday->oup_date[$i]); ?></td>
              <td><?php print($holiday->oup_hol_name[$i]); ?></td>
              <!-- <td><?php print($kotuhi->oup_m_kotuhi_from[$i]); ?></td>
              <td><?php print($kotuhi->oup_m_kotuhi_to[$i]); ?></td>
              <td><?php print($kotuhi->oup_m_kotuhi_cost[$i]); ?></td> -->
              <td>
                <a href="#" onClick="confirm1(<?php print($holiday->oup_id[$i]); ?>);"><i
                    class="fas fa-trash-alt"></i>
                </a>
              </td>
            </tr>
            <?php } ?>
            <?php } ?>
          </table>
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-6">
          <a href="holiday2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規登録</a>
        </div>
        <div class="col-6">
          <a href="kanri/menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
        </div>
      </div>
      <br />

    </form>

  </div>

  <div class="modal-footer">
    <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
  </div><!-- /footer -->

</body>

</html>