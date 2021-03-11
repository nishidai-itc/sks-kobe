<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
    <h4>作業予定詳細</h4>

	<?php if(!($confirmflg)) { ?>
    <br />
          <form name="frm4" method="POST" action="sagyoplandetail.php">
            <input type="submit" value="予定確認OK">
            <?php /* アクションフラグ */ ?>
            <INPUT type="hidden" name="act" value="4">
            <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
          </form>
          <br />
	<?php } else { ?>
    <br />
          全て予定確認OK 連絡済<br />
	<?php } ?>

<?php for($i=0;$i<count($work->oup_t_work_no);$i++) { ?>
<?php
    $user       = new User;         // 利用者クラス
    // 利用者 取得 に 必要な情報をセット
    $user->inp_m_user_id = $work->oup_t_work_user_id[$i];
    // 利用者 取得
    $user->getUser();
?>

      <p><?php print($common->html_display($user->oup_m_user_name[0])); ?> 様<br /><br /><?php print($common->html_display(substr($work->oup_t_work_plan_start_date[$i],0,4)."/".substr($work->oup_t_work_plan_start_date[$i],5,2)."/".substr($work->oup_t_work_plan_start_date[$i],8,2))) ?> <?php print($common->html_display(substr($work->oup_t_work_plan_start_time[$i],0,2).":".substr($work->oup_t_work_plan_start_time[$i],2,2))); ?> から <?php print($common->html_display(substr($work->oup_t_work_plan_end_time[$i],0,2).":".substr($work->oup_t_work_plan_end_time[$i],2,2))); ?>
<?php if($work->oup_t_work_staff_memo[$i] != "") { ?><br /><br />スタッフメモ<br /><?php print($work->oup_t_work_staff_memo[$i]); ?><?php } ?>
<?php if($work->oup_t_work_admin_memo[$i] != "") { ?><br /><br />管理者メモ<br /><?php print($work->oup_t_work_admin_memo[$i]); ?><?php } ?>
<?php if($work->oup_t_work_instruction_memo[$i] != "") { ?><br /><br /><font color="red">指示内容</font><br /><?php print($work->oup_t_work_instruction_memo[$i]); ?><?php } ?>
          <?php if(substr($work->oup_t_work_plan_start_date[$i],0,4).substr($work->oup_t_work_plan_start_date[$i],5,2).substr($work->oup_t_work_plan_start_date[$i],8,2) <= date("Ymd")) { ?><?php if ($work->oup_t_work_stop_kbn[$i] == "") { ?><form name="frm" method="GET" action="sagyostartplan.php"><input type="submit" value="作業報告します"><input type="hidden" name="work_no" value="<?php print($work->oup_t_work_no[$i]); ?>"><input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" /></form><?php } else { ?><?php if(substr($work->oup_t_work_plan_start_date[$i],0,4).substr($work->oup_t_work_plan_start_date[$i],5,2).substr($work->oup_t_work_plan_start_date[$i],8,2).$work->oup_t_work_plan_start_time[$i] > date("YmdHi",strtotime("-1 day"))) { ?><form name="frm" method="GET" action="sagyostartplan.php"><input type="submit" value="作業修正します"><input type="hidden" name="work_no" value="<?php print($work->oup_t_work_no[$i]); ?>"><input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" /></form><?php } ?><?php } ?><?php } ?>
<?php } ?>
      <br />
      <form name="frm" method="POST" action="../controllers/recently_list.php">
        <input type="submit" value="戻る">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>
      <br />
    </div>
  </body>
</html>
