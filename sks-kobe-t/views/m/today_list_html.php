<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>
  <body><br />
    <?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん <br />
    <?php print(date('m/d')); ?> (<?php print($common->html_display($week[$w])); ?>) <b><?php print(date('H:i')); ?></b><br /><br />
<?php if ($company->oup_m_company_simple_kbn[0] != "1") { ?>
    <b>作業準備中</b><br /><br />
<?php } ?>
    作業予定を選択してください<br /><br />

<?php if (($updflg) && ($setting->workinputmode=="startend")) { ?>
<?php } else { ?>
    <?php if(!($confirmflg)) { ?>
          <form name="frm4" method="POST" action="today_list.php">
            <input type="submit" value="本日 全て訪問OK">
            <?php /* アクションフラグ */ ?>
            <INPUT type="hidden" name="act" value="4">
            <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
          </form>
    <?php } else { ?>
          本日 全て訪問OK 連絡済<br />
    <?php } ?>
<?php } ?>

<?php for($i=0;$i<count($work->oup_t_work_no);$i++) { ?>
<?php
    $user     = new User;       // 利用者クラス
    // 利用者マスタ 取得 に必要な情報をセット
    $user->inp_m_user_id = $work->oup_t_work_user_id[$i];
    $user->getUser();
?>
<?php /* ?>
    <?php if ($common->career == "docomo") { ?>
        <a href="sagyostartplan.php?<?php print(SID); ?>&work_no=<?php print($work->oup_t_work_no[$i]); ?>" lcs><?php print(substr($work->oup_t_work_plan_start_time[$i],0,2).":".substr($work->oup_t_work_plan_start_time[$i],2,2)); ?> から <?php print(substr($work->oup_t_work_plan_end_time[$i],0,2).":".substr($work->oup_t_work_plan_end_time[$i],2,2)); ?> <?php print($common->html_display($user->oup_m_user_name[0])); ?> 様</a>
    <?php } elseif ($common->career == "softbank") { ?>
        <a href="location:auto?url=sagyostartplan.php&<?php print(SID); ?>&work_no=<?php print($work->oup_t_work_no[$i]); ?>"><?php print(substr($work->oup_t_work_plan_start_time[$i],0,2).":".substr($work->oup_t_work_plan_start_time[$i],2,2)); ?> から <?php print(substr($work->oup_t_work_plan_end_time[$i],0,2).":".substr($work->oup_t_work_plan_end_time[$i],2,2)); ?> <?php print($common->html_display($user->oup_m_user_name[0])); ?> 様</a></a>
    <?php } else { ?>
<?php */ ?>


        <a href="sagyostartplan.php?<?php print(SID); ?>&work_no=<?php print($work->oup_t_work_no[$i]); ?>"><?php print(substr($work->oup_t_work_plan_start_time[$i],0,2).":".substr($work->oup_t_work_plan_start_time[$i],2,2)); ?> - <?php print(substr($work->oup_t_work_plan_end_time[$i],0,2).":".substr($work->oup_t_work_plan_end_time[$i],2,2)); ?> <?php print($common->html_display($user->oup_m_user_name[0])); ?> 様</a>
<?php /* ?>
    <?php } ?>
<?php */ ?>
    <br />
<?php } ?>

    <br />
    <form name="frm2" method="POST" action="menu.php">
      <input type="submit" value="戻る">
      <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
    </form>
    <br />
    <br />
  </body>
</html>
