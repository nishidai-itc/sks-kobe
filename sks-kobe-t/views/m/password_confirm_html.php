<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
      <h2>ﾊﾟｽﾜｰﾄﾞ変更確認</h2>

      <form name="frm" method="POST" action="password_confirm.php">

        ﾊﾟｽﾜｰﾄﾞを変更します。<br />よろしいですか。
        <br />
        <br />

        <input type="submit" value="登録">
        <br />
        <br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">

    </form>

    <form name="frm1" method="POST" action="password_modify.php">
        <input type="submit" value="戻る">
        <br />
        <br />
        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
    </form>

  </body>
</html>
