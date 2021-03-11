<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
        <h2>利用者さん登録</h2>

        利用者さんを登録してください
<br />
<br />

      <form name="frm" method="POST" action="user_regist.php">

        <?php if ($registuser->errmsg != "") { ?>
            <p>
              <font color="red"><?php print(htmlspecialchars_decode($common->html_display($registuser->errmsg))); ?></font>
            </p>
        <?php } ?>

        <label>利用者のお名前（漢字）</label>
        <br />
        <input type="text" name="m_user_name" value="<?php print($m_user_name); ?>" placeholder="利用者のお名前（漢字）">
        <br />
        <br />

        <label>利用者のお名前（ｶﾅ）</label>
        <br />
        <input type="text" name="m_user_kana" value="<?php print($m_user_kana); ?>" placeholder="利用者のお名前（ｶﾅ）">
        <br />
        <br />

        <label>利用者さんの生年月日</label>
        <br />
        <input type="text" name="m_user_birth_date_yy" value="<?php print($m_user_birth_date_yy); ?>" placeholder="年" size="5">
        <label>年</label>
        <select name="m_user_birth_date_mm">
          <option value=""></option>
<?php for ($i=1;$i<=12;$i++) { ?>
          <option value="<?php print(sprintf("%02d", $i)); ?>" <?php if(sprintf("%02d", $i) == $m_user_birth_date_mm) { print("selected"); } ?>><?php print($i); ?></option>
<?php } ?>
        </select>
        <label>月</label>
        <select name="m_user_birth_date_dd">
          <option value=""></option>
<?php for ($i=1;$i<=31;$i++) { ?>
          <option value="<?php print(sprintf("%02d", $i)); ?>" <?php if(sprintf("%02d", $i) == $m_user_birth_date_dd) { print("selected"); } ?>><?php print($i); ?></option>
<?php } ?>
        </select>
        <label >日</label>
        <br />
        <br />

        <input type="submit" value="登録します">
        <br />
        <br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />

      </form>

      <form name="frm" method="POST" action="user_list.php">
        <input type="submit" value="戻る">
        <br />
        <br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />

      </form>

  </body>

</html>
