<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" media="screen, projection" />
    <script src="bootstrapalpa/js/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>
  </head>

  <script>
    function confirm1(no) {
      if(!confirm('この項目を削除してもよろしいですか?')) return false;
      location.href = "genba2.php?act=2&genba_id="+no+"&genba_id2="+no;
    }
  </script>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>現場一覧</h4>
      </div>

      <form name="frm" method="POST" action="login.php">

        <div class="card" style="padding: 10px;">
          <div class="card-body">
            <?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん<br /><?php print(date('m/d')) ?>(<?php print($week[$w]); ?>) <?php print(date('H:i')) ?>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-6">
            <a href="genba2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規登録</a>
          </div>
          <div class="col-6">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
<?php for ($i=0;$i<count($genba->oup_m_genba_id);$i++) { 
                if($i == 0 || $i%10 == 0){
                ?>
              <tr align="center">
                <td width="30" bgcolor="FFDCA5">&nbsp;</td>
                <td width="85" bgcolor="FFDCA5">現場ID</td>
                <td width="150" bgcolor="FFDCA5">現場名</td>
                <td width="150" bgcolor="FFDCA5">現場カナ</td>
                <td width="150" bgcolor="FFDCA5">親現場名</td>
                <td width="70" bgcolor="FFDCA5">表示順序</td>
                <td width="30" bgcolor="FFDCA5">&nbsp;</td>
              </tr>
                <?php } ?>
              <tr align="center">
                <td>
                    <div id="<?php print($genba->oup_m_genba_id[$i]); ?>">
                        <a href="genba2.php?no=<?php print($genba->oup_m_genba_id[$i]); ?>">詳</a>
                    </div>
                </td>
                <td><?php print($genba->oup_m_genba_id[$i]); ?></td>
                <td><?php print($genba->oup_m_genba_name[$i]); ?></td>
                <td nowrap><?php print($genba->oup_m_genba_kana[$i]); ?></td>
                <td><?php print($genbas[$genba->oup_m_genba_oya_id[$i]]); ?></td>
                <td><?php print($genba->oup_m_genba_hyoji_kbn[$i]); ?></td>
                <td><a href="#" onClick="confirm1(<?php print($genba->oup_m_genba_id[$i]); ?>);">削</a></td>
              </tr>
<?php } ?>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <a href="genba2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規登録</a>
          </div>
          <div class="col-6">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
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
