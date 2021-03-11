<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body><br />
<!--
    <form name="frm0" method="POST" action="tel:<?php print($common->html_display($office->oup_m_office_tel[0])); ?>">
      <input type="submit" value="管理者へ電話">
    </form>
    <br />
-->
          <?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん <br /><?php print(date('m/d')) ?>(<?php print($common->html_display($week[$w])); ?>) <b><?php print(date('H:i')); ?></b><br /><br />
<?php if ($company->oup_m_company_simple_kbn[0] != "1") { ?>
<?php if (($updflg) && ($setting->workinputmode=="startend")) { ?>
<b>訪問作業中</b><br />
<?php } else { ?>
<b>作業準備中</b><br />
<?php } ?>
<?php } ?>
          <br />


<?php if (($updflg) && ($setting->workinputmode=="startend")) { ?>

      利用者 <?php print($common->html_display($user->oup_m_user_name[0])); ?> 様<br /><br />予定 <?php print(substr($work->oup_t_work_plan_start_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_plan_start_time[0],2,2)); ?>-<?php print(substr($work->oup_t_work_plan_end_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_plan_end_time[0],2,2)); ?> (<?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?>分)<br /><br />
<?php print($work->oup_t_work_service_content[0]); ?> <?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?>分<br />
      <?php if($work->oup_t_work_staff_memo[0] != "") { ?><br />スタッフメモ<br /><?php print($work->oup_t_work_staff_memo[0]); ?><?php } ?><?php if($work->oup_t_work_admin_memo[0] != "") { ?><br /><br />管理者メモ<br /><?php print($work->oup_t_work_admin_memo[0]); ?><?php } ?><?php if($work->oup_t_work_instruction_memo[0] != "") { ?><br /><br /><font color="red">指示内容</font><br /><?php print($work->oup_t_work_instruction_memo[0]); ?><?php } ?>
      <br />

<?php /* ?>
    <?php if ($common->career == "docomo") { ?>
      <form name="frm" method="POST" action="sagyojissekiinput.php" lcs>
          <input type="submit" value="作業終了します">
          <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>
    <?php } elseif ($common->career == "softbank") { ?>
      <a href="location:auto?url=sagyojissekiinput.php&<?php print(SID); ?>">作業終了します</a>
    <?php } else { ?>
<?php */ ?>
      <form name="frm" method="POST" action="sagyojissekisyuruiinput.php">
          <input type="submit" value="作業終了します">
          <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>
<?php /* ?>
    <?php } ?>
<?php */ ?>
          <br />
          <br />
<?php /*
          <form name="frm" method="POST" action="menu.php">
            <button type="submit">作業中止します</button>
*/ ?>
            <?php /* アクションフラグ */ ?>
<?php /*
            <INPUT type="hidden" name="act" value="1">
            <INPUT type="hidden" name="work_no" value="<?php print($work->oup_t_work_no[0]); ?>">
            <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
          </form>
*/ ?>
          <form name="frm" method="POST" action="menu.php">
            <input type="submit" value="作業をやり直します">
            <?php /* アクションフラグ */ ?>
            <INPUT type="hidden" name="act" value="2">
            <INPUT type="hidden" name="work_no" value="<?php print($work->oup_t_work_no[0]); ?>">
            <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
          </form>
          <br />
<?php } else { ?>
<?php if ($todayworkflg) { ?>
          <form name="frm1" method="POST" action="../controllers/today_list.php">
            <input type="submit" value="本日の予定へ">
            <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
          </form>
<?php } ?>
<?php if ($recentlyworkflg) { ?>
          <form name="frm2" method="POST" action="recently_list.php">
            <input type="submit" value="直近の予定確認">
            <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
          </form>
          <br />
<?php } ?>
<?php if ($company->oup_m_company_linkage_kbn[0] == "1") { ?>
          <form name="frm1" method="POST" action="../controllers/user_list.php">
            <input type="submit" value="利用者様選択へ">
            <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
          </form>
          <br />
<?php } ?>
          <form name="frm2" method="POST" action="sagyohokokulist.php">
            <input type="submit" value="作業報告一覧">
            <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
          </form>
<?php if ($common->html_display($company->oup_m_company_disp_work_created[0]) == "1") { ?>
          <form name="frm3" method="POST" action="work_regist.php">
            <input type="submit" value="作業報告新規入力">
            <?php /* アクションフラグ */ ?>
            <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
          </form>
          <br />
<?php } ?>
          <form name="frm4" method="POST" action="mypage_detail.php">
            <input type="submit" value="本人情報">
            <?php /* アクションフラグ */ ?>
            <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
          </form>
          <form name="frm5" method="POST" action="password_modify.php">
            <input type="submit" value="ﾊﾟｽﾜｰﾄﾞ変更">
            <?php /* アクションフラグ */ ?>
            <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
          </form>
          <br />

          <br />

          <form name="frm" method="POST" action="login.php">
              <input type="submit" name="logout" value="ﾛｸﾞｱｳﾄ">
          </form>
          <br />
          <br />
<?php } ?>

  </body>
</html>
