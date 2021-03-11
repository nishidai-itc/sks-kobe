<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" media="screen, projection" />
    <script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/jquery.balloon.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>
  </head>

  <script>
    function confirm1(no,name) {
      if(!confirm(name + 'さんの項目を削除してもよろしいですか?')) return false;
      location.href = "staff2.php?act=2&staff_id="+no;
    }
  </script>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>隊員一覧</h4>
      </div>

      <form name="frm" method="POST" action="login.php">

        <div class="row">
          <div class="col-6">
            <a href="staff2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規登録</a>
          </div>
          <div class="col-6">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
<?php for ($i=0;$i<count($staff->oup_m_staff_id);$i++) { 
                if($i == 0 || $i%10 == 0){
                ?>
              <tr align="center">
                <td width="30" bgcolor="FFDCA5">&nbsp;</td>
                <td width="85" bgcolor="FFDCA5">隊員ID</td>
                <td width="150" bgcolor="FFDCA5">隊員名</td>
                <td width="150" bgcolor="FFDCA5">隊員カナ</td>
                <td width="150" bgcolor="FFDCA5">配置照会名</td>
                <td width="150" bgcolor="FFDCA5">権限</td>
                <td width="150" bgcolor="FFDCA5">雇用形態</td>
                <td width="150" bgcolor="FFDCA5">現場</td>
                <td width="150" bgcolor="FFDCA5">入社日</td>
                <td width="150" bgcolor="FFDCA5">退職日</td>
                <td width="150" bgcolor="FFDCA5">協力会社</td>
                <td width="30" bgcolor="FFDCA5">&nbsp;</td>
              </tr>
                <?php } ?>
              <tr align="center">
                <td><div id="<?php print($staff->oup_m_staff_id[$i]); ?>"><a href="staff2.php?no=<?php print($staff->oup_m_staff_id[$i]); ?>">詳</a></div></td>
                <td><?php print($staff->oup_m_staff_id[$i]); ?></td>
                <td><?php print($staff->oup_m_staff_name[$i]); ?></td>
                <td><?php print($staff->oup_m_staff_kana[$i]); ?></td>
                <td><?php print($staff->oup_m_staff_haiti_name[$i]); ?></td>
                <td><?php print($staff->auth[$staff->oup_m_staff_auth[$i]]); ?></td>
                <td><?php print($staff->koyo[$staff->oup_m_staff_kbn[$i]]); ?></td>
                <td><?php print($genbas[$staff->oup_m_staff_genba_id[$i]]); ?></td>
                <td><?php print($staff->oup_m_staff_nyusya[$i]); ?></td>
                <td><?php print($staff->oup_m_staff_taisya[$i]); ?></td>
                <td><?php print($companys[$staff->oup_m_staff_company[$i]]); ?></td>
                <td><a href="javascript:void(0);" onClick="confirm1('<?php print($staff->oup_m_staff_id[$i]); ?>','<?php print($staff->oup_m_staff_name[$i]); ?>');">削</a></td>
              </tr>
<?php } ?>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <a href="staff2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規登録</a>
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
