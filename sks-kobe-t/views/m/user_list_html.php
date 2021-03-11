<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>
  <body>
    <h2>利用者様登録・選択</h2>

    <?php print($common->html_display($staff->oup_m_staff_name[0])); ?>　さん<br /><br />
    <?php print(date('Y/m/d')); ?> (<?php print($common->html_display($week[$w])); ?>)  <?php print(date('H:i')); ?><br /><br />
    作業準備中<br /><br />
    利用者様を選択してください<br /><br />


<?php for($i=0;$i<count($user->oup_m_user_id);$i++) { ?>
<?php /* ?>
    <?php if ($common->career == "docomo") { ?>
        <a href="sagyostart.php?<?php print(SID); ?>&m_user_id=<?php print($user->oup_m_user_id[$i]); ?>" lcs><?php print($common->html_display($user->oup_m_user_name[$i])); ?> 様 <?php if ($user->oup_m_user_birth_date[$i] != "") { ?>(<?php print((int) ((date('Ymd')-(substr($user->oup_m_user_birth_date[$i],0,4).substr($user->oup_m_user_birth_date[$i],5,2).substr($user->oup_m_user_birth_date[$i],8,2)))/10000)); ?>)<?php } ?></a>
    <?php } elseif ($common->career == "softbank") { ?>
        <a href="location:auto?url=sagyostart.php&<?php print(SID); ?>&m_user_id=<?php print($user->oup_m_user_id[$i]); ?>"><?php print($common->html_display($user->oup_m_user_name[$i])); ?> 様 <?php if ($user->oup_m_user_birth_date[$i] != "") { ?>(<?php print((int) ((date('Ymd')-(substr($user->oup_m_user_birth_date[$i],0,4).substr($user->oup_m_user_birth_date[$i],5,2).substr($user->oup_m_user_birth_date[$i],8,2)))/10000)); ?>)<?php } ?></a>
    <?php } else { ?>
<?php */ ?>
        <a href="sagyostart.php?<?php print(SID); ?>&m_user_id=<?php print($user->oup_m_user_id[$i]); ?>"><?php print($common->html_display($user->oup_m_user_name[$i])); ?> 様 <?php if ($user->oup_m_user_birth_date[$i] != "") { ?>(<?php print((int) ((date('Ymd')-(substr($user->oup_m_user_birth_date[$i],0,4).substr($user->oup_m_user_birth_date[$i],5,2).substr($user->oup_m_user_birth_date[$i],8,2)))/10000)); ?>)<?php } ?></a>
<?php /* ?>
    <?php } ?>
<?php */ ?>
<br />
<?php } ?>
    <br />
    利用者様が表示されていない場合、利用者を「利用者様登録」から登録すると一覧に表示されます。<br /><br />

    <form name="frm1" method="POST" action="user_regist.php">
      <input type="submit" value="利用者様登録">
      <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
    </form>
    <br />
    <br />
    <form name="frm2" method="POST" action="menu.php">
      <input type="submit" value="戻る">
      <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
    </form>
    <br />
    <br />
  </body>
</html>
