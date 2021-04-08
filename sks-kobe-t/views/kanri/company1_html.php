<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" media="screen, projection" />
    <!-- <script src="bootstrapalpa/js/jquery.min.js"></script> -->
    <script src="../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>
  </head>

  <script>
    // function confirm1(no,name) {
    //   if(!confirm(name +'の項目を削除してもよろしいですか?')) return false;
    //   location.href = "company2.php?act=2&company_id="+no+"&company_id2="+no;
    // }
  </script>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>協力会社一覧</h4>
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
            <a href="company2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規登録</a>
          </div>
          <div class="col-6">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
<?php for ($i=0;$i<count($company->oup_m_company_id);$i++) { 
                if($i == 0 || $i%10 == 0){
                ?>
              <tr align="center">
                <td width="30" bgcolor="FFDCA5">&nbsp;</td>
                <td width="85" bgcolor="FFDCA5">協力会社ID</td>
                <td width="150" bgcolor="FFDCA5">協力会社名</td>
                <td width="150" bgcolor="FFDCA5">協力会社カナ</td>
                <td width="130" bgcolor="FFDCA5">使用終了日</td>
                <td width="30" bgcolor="FFDCA5">&nbsp;</td>
              </tr>
                <?php } ?>
              <tr align="center" <?php echo $company->oup_m_company_deleteday[$i] != "" ? "bgcolor='#d5d5d5'" : "" ; ?>>
                <td>
                    <div id="<?php print($company->oup_m_company_id[$i]); ?>">
                        <a href="company2.php?flgs=1&no=<?php print($company->oup_m_company_id[$i]); ?>">詳</a>
                    </div>
                </td>
                <td><?php print($company->oup_m_company_id[$i]); ?></td>
                <td><?php print($company->oup_m_company_name[$i]); ?></td>
                <td nowrap><?php print($company->oup_m_company_kana[$i]); ?></td>
                <td><?php print($company->oup_m_company_deleteday[$i]); ?></td>
                <td><a href="#" onClick="confirm1('<?php print($company->oup_m_company_id[$i]); ?>','<?php print($company->oup_m_company_name[$i]); ?>');">削</a></td>
              </tr>
<?php } ?>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <a href="company2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規登録</a>
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

<script type="text/javascript">
  function confirm1(no,name) {
    if(!confirm(name +'の項目を削除してもよろしいですか?')) return false;

    $.ajax({
      type: 'post',
      url: 'ajaxController.php',
      data: {
        act: 'companyDel',
        no: no
      },
      dataType:"json"
    }).done(function(data){
      console.log(data)
      if (!data) {
        alert(name+'に関連する勤務があります、勤務を先に削除してください。')
        return false
      }

      location.href = "company2.php?act=2&company_id="+no+"&company_id2="+no;
    }).fail(function(data){
      alert('通信エラー')
    })
  }
</script>