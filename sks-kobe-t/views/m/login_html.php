<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="Shift_JIS">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>

    <h1>かんたんﾍﾙﾊﾟｰさん</h1>
    <h2>ﾛｸﾞｲﾝ</h2>

      <form name="frm" method="POST" action="login.php">

        <?php if ($login->errmsg != "") { ?>
            <p><font color="red"><?php print(htmlspecialchars_decode($common->html_display($login->errmsg))); ?></font></p>
        <?php } ?>

        <?php if ($status == "2") { ?>
            <p><font color="red">現在ご契約が終了しております。継続利用される場合は、アイ・ティ・シー クラウド担当へご連絡ください。078-222-0701</font></p>
        <?php } ?>

        <?php if ($status == "4") { ?>
            <p><font color="red">現在試用期間が終了しております。継続利用される場合は、アイ・ティ・シー クラウド担当へご連絡ください。078-222-0701</font></p>
        <?php } ?>

        <?php if ($status == "5") { ?>
            <p><font color="red">現在ご利用停止中です。アイ・ティ・シー クラウド担当へご連絡ください。078-222-0701</font></p>
        <?php } ?>

        <?php if (!(($status == "2") || ($status == "4") || ($status == "5"))) { ?>

        <?php if ($status == "3") { ?>
            <p><font color="red">試用期限は <?php print(date('Y/m/d',strtotime($company->oup_m_company_try_end_date[0]))); ?> となっております。継続される場合は、アイ・ティ・シー クラウド担当へご連絡ください。078-222-0701</font></p>
        <?php } ?>

        <label>ﾛｸﾞｲﾝID</label>
<br />
        <input type="text" name="staff_login_id" value="<?php print($staff_login_id); ?>" placeholder="ﾛｸﾞｲﾝID">
<br />
        <label>ﾊﾟｽﾜｰﾄﾞ</label>
<br />
        <input type="password" value="<?php print($staff_pass); ?>" name="staff_pass" placeholder="ﾊﾟｽﾜｰﾄﾞ">
<br />
<br />
        <label class="checkbox"><input type="checkbox" name="nextpass" value="1"> 次回からの入力を省略</label>
<br />
        <input type="submit" value="ﾛｸﾞｲﾝ">
<br />
<br />
        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">

        ﾛｸﾞｲﾝID/ﾊﾟｽﾜｰﾄﾞを忘れた方は管理者へ確認してください。

        <?php } ?>

      </form>

  </body>

</html>
