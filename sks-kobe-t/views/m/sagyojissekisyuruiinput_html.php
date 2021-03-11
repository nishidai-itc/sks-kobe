<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>
  <body><br />
<?php // var_dump($_SESSION); ?>

        <?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん <br />
        <?php print(date('m/d')) ?> (<?php print($week[$w]); ?>) <b><?php print($run_end_time); ?></b><br /><br />
        作業時間 <?php print(substr($work->oup_t_work_run_start_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_run_start_time[0],2,2)); ?>-
        <?php print($run_end_time); ?> (<?php print(intval(substr($run_end_time,0,2)) * 60 + intval(substr($run_end_time,3,2)) - intval(substr($work->oup_t_work_run_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_run_start_time[0],2,2))); ?>分)<br />
<br />

        <?php if ($sagyojissekisyurui->errmsg != "") { ?>
            <p><font color="red"><?php print(htmlspecialchars_decode($common->html_display($sagyojissekisyurui->errmsg))); ?></font></p>
        <?php } ?>

      <form name="frm" method="POST" action="../controllers/sagyojissekisyuruiinput.php">

      利用者 <?php print($common->html_display($user->oup_m_user_name[0])); ?> 様 
      <?php if($work->oup_t_work_staff_memo[0] != "") { ?><br />ｽﾀｯﾌﾒﾓ<br /><?php print($work->oup_t_work_staff_memo[0]); ?><?php } ?><?php if($work->oup_t_work_admin_memo[0] != "") { ?><br /><br />管理者ﾒﾓ<br /><?php print($work->oup_t_work_admin_memo[0]); ?><?php } ?><?php if($work->oup_t_work_instruction_memo[0] != "") { ?><br /><br /><font color="red">指示内容</font><br /><?php print($work->oup_t_work_instruction_memo[0]); ?><?php } ?>

        <br /><input type="checkbox" name="equal" value="1">作業は予定通りでした
        <br />(予定)
<?php print($work->oup_t_work_service_content[0]); ?> <?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?> 分<br />
        <br />
        <input type="submit" value="登録します">
        <br />

      <input type="hidden" name="T20" value="<?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?>">

        <table>
          <tr>
            <td><font size="+1"><?php print($work->oup_t_work_service_content[0]); ?></font>
              <input type="text" name="T0" istyle="4" mode="numeric" size="5"> 分
            </td>
          </tr>
        </table>
<br />
        <table>
          <tr>
            <td>交通費</td>
            <td><input type="text" name="move_cost_yen" value="<?php print($move_cost_yen); ?>" placeholder="" size="6" istyle="4" format="N" mode="numeric"></td>
            <td>円</td>
          </tr>
          <tr>
            <td>移動距離</td>
            <td><input type="text" name="move_cost_kilo" value="<?php print($move_cost_kilo); ?>" placeholder="" size="6" istyle="4" format="N" mode="numeric"></td>
            <td>km</td>
          </tr>
          <tr>
            <td>その他</td>
            <td><input type="text" name="move_cost_etc" value="<?php print($move_cost_etc); ?>" placeholder="" size="6"></td>
            <td>&nbsp;</td>
          </tr>
        </table>

        作業で気づいたことがあればｺﾒﾝﾄしてください<br />このｺﾒﾝﾄは管理者にﾒｰﾙで送られます<br />
        <br />

        作業実績ｺﾒﾝﾄ <label><input type="checkbox" name="alert_kbn" value="1"> 重要</label>
        <br />
        <textarea name="t_work_comment" rows="3" istyle="1" format="M" mode="hiragana"></textarea>
        <br />
        <br />

        <input type="submit" value="登録します">
<br />
<br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
<?php if (count($work2->oup_t_work_plan_service_no) == 0) { ?>
        <INPUT type="hidden" name="syurui_cnt" value="<?php print(count($worktype->oup_m_work_type_kbn)); ?>">
<?php } else { ?>
        <INPUT type="hidden" name="syurui_cnt" value="<?php print(count($work2->oup_t_work_plan_service_no)); ?>">
<?php } ?>
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
        <INPUT type="hidden" name="run_end_time" value="<?php print(date('H:i')); ?>">

      </form>

      <form name="frm2" method="POST" action="../controllers/menu.php">
        <input type="submit" value="戻る">
        <br />
        <br />

        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>

  </body>
</html>
