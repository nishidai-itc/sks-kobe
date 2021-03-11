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
  location.href = "kotuhi2.php?act=2&kotuhi_no=" + no;
}
</script>

<body>
  <div class="container">
    <div class="page-header">
      <h4>交通費一覧</h4>
    </div>

    <form name="frm" method="POST" action="kotuhi1.php" enctype="multipart/form-data">

      <div class="card" style="padding: 10px;">
        <div class="card-body">
          <?php print($common->html_display($staff->oup_m_staff_name[0])); ?>
          さん<br /><?php print(date('m/d')) ?>(<?php print($week[$w]); ?>) <?php print(date('h:i')) ?>
        </div>
      </div>
      <br />
      <?php /*if ($msg != "") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger"><?php print($msg); ?></p></pre></div>
            </div>
      <?php } */?>
      <div class="row">
        <div class="col-6">
            <FONT>アップロードファイル名：</FONT><input class="btn btn-success btn-block" type='file' value="<?php print($inp_userfile); ?>" id ="inp_userfile" name='inp_userfile' size='80'>
          <!--<a href="kotuhi2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規登録</a>-->
        </div>
        <div class="col-6">
            <FONT>&nbsp;</FONT><INPUT type='submit' class="btn btn-success btn-block" value=' 取り込み処理実行 ' name='modify'>
          <!--<a href="kanri/menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>-->
        </div>
      </div>
      <br />
      <div class="row">
        <div class="col-12">
          <table class="table table-sm table-bordered">
            <tr class="text-center">
              <td bgcolor="FFDCA5">隊員</td>
              <td bgcolor="FFDCA5">現場</td>
              <td bgcolor="FFDCA5">金額</td>
              <td bgcolor="FFDCA5">メモ</td>
              <td bgcolor="FFDCA5">適用開始日</td>
              <td bgcolor="FFDCA5">&nbsp;</td>
            </tr>
            <?php for ($i=0;$i<count($kotuhi->oup_m_kotuhi_no);$i++) { ?>
            <tr class="text-center">
              <td><?php print($kotuhi->oup_m_kotuhi_staff_name[$i]); ?></td>
              <td><?php print($kotuhi->oup_m_kotuhi_place[$i]); ?></td>
              <td><?php print($kotuhi->oup_m_kotuhi_cost[$i]); ?></td>
              <!--<td><input type="text" name="kotukikan" value="" ></td>
              <td><input type="text" name="startday" value="" ></td>-->
              <td><?php print($kotuhi->oup_m_kotuhi_kikan[$i]); ?></td>
              <td><?php if ($kotuhi->oup_m_kotuhi_startday[$i] != "0000-00-00") {print($kotuhi->oup_m_kotuhi_startday[$i]);} ?></td>
              <td>
                <a href="#" onClick="confirm1(<?php print($kotuhi->oup_m_kotuhi_no[$i]); ?>);"><i
                    class="fas fa-trash-alt"></i>
                </a>
              </td>
            </tr>
            <?php } ?>
          </table>
        </div>
      </div>
      <br />

      <div class="row">
        <!--<div class="col-6">
          <a href="kotuhi2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規登録</a>
        </div>-->
        <div class="col-12">
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