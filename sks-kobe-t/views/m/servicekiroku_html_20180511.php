<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんヘルパーさん</title>
  </head>

  <body>
      <button type="button" onclick="location.href='kakokiroku.php'">過去記録の複写</button>
      <br />
      <form name="frm" method="POST" action="servicekiroku.php">
          <table>
            <tr>
              <th>利用者</th>
              <td><?php print($common->html_display($user->oup_m_user_name[0])); ?> 様</td>
            </tr>
            <tr>
              <th>ヘルパー</th>
              <td><?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん</td>
            </tr>
            <tr>
              <th>実施日時</th>
              <td><?php print(substr($work->oup_t_work_plan_start_date[0],0,10)); ?> (<?php print($weekday); ?>) <input type="time" name="run_start_time" value="<?php print(substr($work->oup_t_work_plan_start_time[0],0,2) . ":" . substr($work->oup_t_work_plan_start_time[0],2,2)); ?>">　～　<input type="time" name="run_end_time" value="<?php print(substr($work->oup_t_work_run_end_time[0],0,2) . ":" . substr($work->oup_t_work_run_end_time[0],2,2)); ?>"></td>
            </tr>
            <tr>
              <th>サービス種類</th>
              <td><?php print($work->oup_t_work_service_content[0]); ?>　<?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?>分<br />
                <table>
<?php for($i=0;$i<count($serviceq->oup_m_serviceq_tcode);$i++) { ?>
    <?php if ($serviceq->oup_m_serviceq_tcode[$i]=="1") { ?>
        <?php for($j=1;$j<=10;$j++) { ?>
            <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]!="") { ?>
                  <tr>
                    <td>
                <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'kbn'}[$i]=="1") { ?>
                      <input type="checkbox" name="m_serviceq_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[]" value="<?php print($j); ?>" <?php if ($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][chk]=="1") { print("checked"); } ?> ><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?>
                <?php } else { ?>
                      <?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?><input type="text" name="m_serviceqt_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[<?php print($j); ?>]" value="<?php print($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][content]); ?>">
                <?php } ?>
                    </td>
                  </tr>
            <?php } ?>
        <?php } ?>
    <?php } ?>
<?php } ?>
                </table>
              </td>
            </tr>
            <tr>
              <th>準備記録等</th>
              <td>
                <table>
<?php for($i=0;$i<count($serviceq->oup_m_serviceq_tcode);$i++) { ?>
    <?php if ($serviceq->oup_m_serviceq_tcode[$i]=="2") { ?>
        <?php for($j=1;$j<=10;$j++) { ?>
            <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]!="") { ?>
                  <tr>
                    <td>
                <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'kbn'}[$i]=="1") { ?>
                      <input type="checkbox" name="m_serviceq_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[]" value="<?php print($j); ?>" <?php if ($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][chk]=="1") { print("checked"); } ?> ><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?>
                <?php } else { ?>
                      <?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?><input type="text" name="m_serviceqt_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[<?php print($j); ?>]" value="<?php print($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][content]); ?>">
                <?php } ?>
                    </td>
                  </tr>
            <?php } ?>
        <?php } ?>
    <?php } ?>
<?php } ?>
                </table>
              </td>
            </tr>
          </table>

          <table>
            <tr>
              <th colspan="2">身体介護</th>
            </tr>
<?php for($i=0;$i<count($serviceq->oup_m_serviceq_tcode);$i++) { ?>
    <?php if ($serviceq->oup_m_serviceq_tcode[$i]=="3") { ?>
            <tr>
              <th><?php print($serviceq->oup_m_serviceq_type[$i]); ?></th>
              <td>
                <table>
        <?php for($j=1;$j<=10;$j++) { ?>
            <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]!="") { ?>
                  <tr>
                    <td>
                <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'kbn'}[$i]=="1") { ?>
                      <input type="checkbox" name="m_serviceq_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[]" value="<?php print($j); ?>" <?php if ($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][chk]=="1") { print("checked"); } ?> ><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?>
                <?php } else { ?>
                      <?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?><input type="text" name="m_serviceqt_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[<?php print($j); ?>]" value="<?php print($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][content]); ?>">
                <?php } ?>
                    </td>
                  </tr>
            <?php } ?>
        <?php } ?>
                </table>
            </tr>
    <?php } ?>
<?php } ?>
          </table>
          <table>
            <tr>
              <th colspan="2">自立支援</th>
            </tr>
<?php for($i=0;$i<count($serviceq->oup_m_serviceq_tcode);$i++) { ?>
    <?php if ($serviceq->oup_m_serviceq_tcode[$i]=="4") { ?>
            <tr>
              <th><?php print($serviceq->oup_m_serviceq_type[$i]); ?></th>
              <td>
                <table>
        <?php for($j=1;$j<=10;$j++) { ?>
            <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]!="") { ?>
                  <tr>
                    <td>
                <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'kbn'}[$i]=="1") { ?>
                      <input type="checkbox" name="m_serviceq_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[]" value="<?php print($j); ?>" <?php if ($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][chk]=="1") { print("checked"); } ?> ><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?>
                <?php } else { ?>
                      <?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?><input type="text" name="m_serviceqt_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[<?php print($j); ?>]" value="<?php print($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][content]); ?>">
                <?php } ?>
                    </td>
                  </tr>
            <?php } ?>
        <?php } ?>
                </table>
            </tr>
    <?php } ?>
<?php } ?>
          </table>
          <table>
            <tr>
              <th colspan="2">生活・家事援助</th>
            </tr>
<?php for($i=0;$i<count($serviceq->oup_m_serviceq_tcode);$i++) { ?>
    <?php if ($serviceq->oup_m_serviceq_tcode[$i]=="5") { ?>
            <tr>
              <th><?php print($serviceq->oup_m_serviceq_type[$i]); ?></th>
              <td>
                <table>
        <?php for($j=1;$j<=10;$j++) { ?>
            <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]!="") { ?>
                  <tr>
                    <td>
                <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'kbn'}[$i]=="1") { ?>
                      <input type="checkbox" name="m_serviceq_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[]" value="<?php print($j); ?>" <?php if ($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][chk]=="1") { print("checked"); } ?> ><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?>
                <?php } else { ?>
                      <?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?><input type="text" name="m_serviceqt_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[<?php print($j); ?>]" value="<?php print($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][content]); ?>">
                <?php } ?>
                    </td>
                  </tr>
            <?php } ?>
        <?php } ?>
                </table>
            </tr>
    <?php } ?>
<?php } ?>
          </table>
          <table>
            <tr>
              <th colspan="2">その他</th>
            </tr>
<?php for($i=0;$i<count($serviceq->oup_m_serviceq_tcode);$i++) { ?>
    <?php if ($serviceq->oup_m_serviceq_tcode[$i]=="6") { ?>
            <tr>
              <th><?php print($serviceq->oup_m_serviceq_type[$i]); ?></th>
              <td>
                <table>
        <?php for($j=1;$j<=10;$j++) { ?>
            <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]!="") { ?>
                  <tr>
                    <td>
                <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'kbn'}[$i]=="1") { ?>
                      <input type="checkbox" name="m_serviceq_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[]" value="<?php print($j); ?>" <?php if ($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][chk]=="1") { print("checked"); } ?> ><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?>
                <?php } else { ?>
                      <?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?><input type="text" name="m_serviceqt_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[<?php print($j); ?>]" value="<?php print($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][content]); ?>">
                <?php } ?>
                    </td>
                  </tr>
            <?php } ?>
        <?php } ?>
                </table>
            </tr>
    <?php } ?>
<?php } ?>
          </table>
      <br />

        <input type="submit" value="送信します">
        <br />
        <INPUT type="hidden" name="act" value="1">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />

      </form>

  </body>
</html>
