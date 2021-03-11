<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>
  <body>
    <h2>作業実績入力</h2>

<?php // var_dump($_SESSION); ?>

        <?php print($common->html_display($staff->oup_m_staff_name[0])); ?>　さん<br />
        <?php print(date('Y/m/d')) ?> (<?php print($week[$w]); ?>) <?php print($run_end_time); ?><br /><br />
        作業開始時刻　<?php print(substr($work->oup_t_work_run_start_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_run_start_time[0],2,2)); ?><br />
        作業終了時刻　<?php print($run_end_time); ?><br />作業時間　<?php print(intval(substr($run_end_time,0,2)) * 60 + intval(substr($run_end_time,3,2)) - intval(substr($work->oup_t_work_run_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_run_start_time[0],2,2))); ?> 分<br />
<br />

        <?php if ($sagyocheck->errmsg != "") { ?>
            <p><font color="red"><?php print(htmlspecialchars_decode($common->html_display($sagyocheck->errmsg))); ?></font></p>
        <?php } ?>

<?php if (count($work2->oup_t_work_plan_service_no) == 0) { ?>
<?php } else { ?>
      <form name="frm" method="POST" action="../controllers/sagyoinput.php">
        <input type="submit" value="作業予定と同じ">
        <br />

    <?php for($i=0;$i<count($work2->oup_t_work_plan_service_no);$i++) { ?>
      <input type="hidden" name="T<?php print($i); ?>" value="<?php print($work2->oup_t_work_plan_service_time[$i]); ?>">
    <?php } ?>

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="2">
        <INPUT type="hidden" name="syurui_cnt" value="<?php print(count($work2->oup_t_work_plan_service_no)); ?>">
      </form>
<?php } ?>

      <form name="frm" method="POST" action="../controllers/sagyoinput.php">

        <table>
<?php if (count($work2->oup_t_work_plan_service_no) == 0) { ?>
    <?php for($i=0;$i<count($worktype->oup_m_work_type_kbn);$i++) { ?>
          <tr>
            <td width="100"><?php print($common->html_display($worktype->oup_m_work_type_content[$i])); ?></td>
          </tr>
            <td>
              <input type="text" name="T<?php print($i); ?>" istyle="4" mode="numeric" size="5"> 分
            </td>
          </tr>
    <?php } ?>
<?php } else { ?>
    <?php for($i=0;$i<count($work2->oup_t_work_plan_service_no);$i++) { ?>
          <tr>
            <td width="120"><font size="+1"><?php print($work2->oup_t_work_plan_content[$i]); ?></font></td>
          </tr>
          <tr>
            <td width="120">
              <input type="text" name="T<?php print($i); ?>" istyle="4" mode="numeric" size="5"> 分
              </td>
          </tr>
    <?php } ?>
<?php } ?>
        </table>
<br />

        <table>
          <tr>
            <td>交通費</td>
            <td><input type="text" name="move_cost_yen" value="<?php print($move_cost_yen); ?>" placeholder="" size="6"></td>
            <td>円</td>
          </tr>
          <tr>
            <td>移動距離</td>
            <td><input type="text" name="move_cost_kilo" value="<?php print($move_cost_kilo); ?>" placeholder="" size="6"></td>
            <td>km</td>
          </tr>
          <tr>
            <td>その他</td>
            <td><input type="text" name="move_cost_etc" value="<?php print($move_cost_etc); ?>" placeholder="" size="6"></td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <br />

        作業で気づいたことがあればｺﾒﾝﾄしてください<br />このｺﾒﾝﾄは管理者にﾒｰﾙで送られます<br />
        <br />

      <form name="frm" method="POST" action="sagyoinput.php">
        <label><input type="checkbox" name="alert_kbn" value="1"> 重要</label>
        <br />
        <br />

        作業実績ｺﾒﾝﾄ
        <br />
        <textarea name="t_work_comment" rows="3"></textarea>
        <br />
        <br />

        <input type="submit" value="確認へ">
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

<?php /* ?>
    <?php if ($common->career == "docomo") { ?>
        <INPUT type="hidden" name="ido" value="<?php print($common->dms2Deg($_REQUEST['lat'],$common->career)); ?>">
        <INPUT type="hidden" name="keido" value="<?php print($common->dms2Deg($_REQUEST['lon'],$common->career)); ?>">
    <?php } elseif ($common->career == "softbank") { ?>
		<?php preg_match("/N([\d\.]+)E([\d\.]+)$/", $_REQUEST['pos'], $m); ?>
        <INPUT type="hidden" name="ido" value="<?php print($common->localdeg($m[1])); ?>">
        <INPUT type="hidden" name="keido" value="<?php print($common->localdeg($m[2])); ?>">
    <?php } else { ?>
<?php */ ?>
        <INPUT type="hidden" name="ido" value="">
        <INPUT type="hidden" name="keido" value="">
<?php /* ?>
    <?php } ?>
<?php */ ?>

      </form>

      <form name="frm2" method="POST" action="../controllers/menu.php">
        <input type="submit" value="戻る">
        <br />
        <br />
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>

  </body>
</html>
