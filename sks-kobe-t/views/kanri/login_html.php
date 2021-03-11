<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" media="screen, projection" />
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h2>勤怠管理システム（管理画面）</h2>
        <h4>ログイン</h4>
      </div>

      <form name="frm" method="POST" action="login.php">

        <?php if ($login->errmsg != "") { ?>
            <div class="row">
              <div class="col-12">
                <div class="card" style="padding: 10px;">
                  <div class="card-body">
                    <p class="text-danger"><?php print($login->errmsg); ?></p>
                  </div>
                </div>
              </div>
            </div>
            <br />
        <?php } ?>

        <?php if ($status == "1") { ?>
            <?php if (strtotime(date("Y/m/d", strtotime("1 month"))) >= strtotime($company->oup_m_company_end_date[0])) { ?>
                <div class="row">
                  <div class="col-xs-12 col-md-12"><pre><p class="text-danger">利用期限は <?php print(date('Y/m/d',strtotime($company->oup_m_company_end_date[0]))); ?> となっております。継続される場合は、アイ・ティ・シー クラウド担当へご連絡ください。078-222-0701</p></pre></div>
                </div>
            <?php } ?>
        <?php } ?>
        <?php if ($status == "2") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger">現在ご契約が終了しております。継続利用される場合は、アイ・ティ・シー クラウド担当へご連絡ください。078-222-0701</p></pre></div>
            </div>
        <?php } ?>

        <?php if ($status == "4") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger">現在試用期間が終了しております。継続利用される場合は、アイ・ティ・シー クラウド担当へご連絡ください。078-222-0701</p></pre></div>
            </div>
        <?php } ?>

        <?php if ($status == "5") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger">現在ご利用停止中です。アイ・ティ・シー クラウド担当へご連絡ください。078-222-0701</p></pre></div>
            </div>
        <?php } ?>

        <?php if (!(($status == "2") || ($status == "4") || ($status == "5"))) { ?>

        <?php if ($status == "3") { ?>
            <div class="row">
            <div class="col-xs-12 col-md-12"><pre><p class="text-danger">試用期限は <?php print(date('Y/m/d',strtotime($company->oup_m_company_try_end_date[0]))); ?> となっております。継続される場合は、アイ・ティ・シー クラウド担当へご連絡ください。078-222-0701</p></pre></div>
            </div>
        <?php } ?>


        <div class="row">
          <div class="col-12"><label>ログインID</label></div>
        </div>
        <div class="row">
          <div class="col-12">
            <input type="text" name="staff_login_id" value="<?php print($staff_login_id); ?>" class="form-control" placeholder="ログインID">
          </div>
        </div>
        <div class="row">
          <div class="col-12"><label>パスワード</label></div>
        </div>
        <div class="row">
          <div class="col-12">
              <input type="password" name="staff_pass" value="<?php print($staff_pass); ?>" class="form-control" placeholder="パスワード">
          </div>
        </div>
        <div class="row">
          <div class="col-12"><label class="checkbox"><input type="checkbox" name="nextpass" value="1"> 次回からの入力を省略</label></div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-success btn-lg btn-block" role="button">ログイン</button>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-12">
            <div class="card" style="padding: 10px;">
              <div class="card-body">
                <p class="text-info">ログインID/パスワードを忘れた方は管理者へ確認してください。</p>
              </div>
            </div>
          </div>
        </div>

        <?php } ?>

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">

      </form>

    </div>

      <div class="modal-footer">
          <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
      </div><!-- /footer -->

  </body>

</html>
