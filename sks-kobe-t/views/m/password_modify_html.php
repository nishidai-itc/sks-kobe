<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
        <h2>ﾊﾟｽﾜｰﾄﾞ変更</h2>

        <form name="frm" method="POST" action="password_modify.php">

        <?php if ($password->errmsg != "") { ?>
            <p><font color="red"><?php print(htmlspecialchars_decode($common->html_display($password->errmsg))); ?></font></p>
        <?php } ?>

        <label>現在のﾊﾟｽﾜｰﾄﾞ</label>
        <br />
        <input name="now_pw" type="password"  placeholder="現在のﾊﾟｽﾜｰﾄﾞ">
        <br />
        <br />
        <label>新しいﾊﾟｽﾜｰﾄﾞ</label>
        <br />
        <input name="new_pw1" type="password"  placeholder="新しいﾊﾟｽﾜｰﾄﾞ">
        <br />
        <br />
        <label>新しいﾊﾟｽﾜｰﾄﾞ（確認）</label>
        <br />
        <input name="new_pw2" type="password"  placeholder="新しいﾊﾟｽﾜｰﾄﾞ">
        <br />
        <br />

        <input type="submit" value="次へ">
        <br />
        <br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />

        </form>

        <form name="frm" method="POST" action="menu.php">
          <input type="submit" value="戻る">
          <br />
          <br />

          <?php /* アクションフラグ */ ?>
          <INPUT type="hidden" name="act" value="1">
          <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
        </form>
  </body>
</html>
