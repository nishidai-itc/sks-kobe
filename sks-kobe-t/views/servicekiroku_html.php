<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen, projection" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>　
    <script type="text/javascript" src="../js/jquery-1.8.0.min.js" charset="utf-8"></script>
    <title>かんたんヘルパーさん</title>
  </head>

  <script type="text/javascript">
  <!--
  function confrim(act){
      document.frm.act.value=act;
      document.frm.submit();
  }
  // -->
  </script>

  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="col-xs-12 col-md-12">
            <button type="button" class="btn btn-success btn-lg btn-block" onclick="location.href='kakokiroku.php'">過去記録の複写</button>
          </div>
        </div>
      </div>
      <br />
      <form name="frm" method="POST" action="servicekiroku.php">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <table class="table table-bordered">
            <tr>
              <th class="success">利用者</th>
              <td><?php print($common->html_display($user->oup_m_user_name[0])); ?> 様</td>
            </tr>
            <tr>
              <th class="success">ヘルパー</th>
              <td><?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん</td>
            </tr>
            <tr>
              <th class="success">実施日時</th>
              <td><?php print(substr($work->oup_t_work_plan_start_date[0],0,10)); ?> (<?php print($weekday); ?>) <input type="time" class="form-control" name="run_start_time" value="<?php print(substr($work->oup_t_work_plan_start_time[0],0,2) . ":" . substr($work->oup_t_work_plan_start_time[0],2,2)); ?>">　～　<input type="time" class="form-control" name="run_end_time" value="<?php print(substr($work->oup_t_work_run_end_time[0],0,2) . ":" . substr($work->oup_t_work_run_end_time[0],2,2)); ?>"></td>
            </tr>
            <tr>
              <th class="success">サービス種類</th>
              <td><?php print($work->oup_t_work_service_content[0]); ?>　<?php print(intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2))); ?>分<br />
                <table>
<?php for($i=0;$i<count($serviceq->oup_m_serviceq_tcode);$i++) { ?>
    <?php if ($serviceq->oup_m_serviceq_tcode[$i]=="1") { ?>
        <?php for($j=1;$j<=10;$j++) { ?>
            <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]!="") { ?>
                  <tr>
                    <td>
                <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'kbn'}[$i]=="1") { ?>
                      <label class="checkbox-inline"><input type="checkbox" name="m_serviceq_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[]" value="<?php print($j); ?>" <?php if ($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][chk]=="1") { print("checked"); } ?> ><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?></label>
                <?php } else { ?>
                      <label class="checkbox-inline"><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?><input type="text" name="m_serviceqt_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[<?php print($j); ?>]" value="<?php print($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][content]); ?>"></label>
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
              <th class="success">準備記録等</th>
              <td>
                <table>
<?php for($i=0;$i<count($serviceq->oup_m_serviceq_tcode);$i++) { ?>
    <?php if ($serviceq->oup_m_serviceq_tcode[$i]=="2") { ?>
        <?php for($j=1;$j<=10;$j++) { ?>
            <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]!="") { ?>
                  <tr>
                    <td>
                <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'kbn'}[$i]=="1") { ?>
                      <label class="checkbox-inline"><input type="checkbox" name="m_serviceq_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[]" value="<?php print($j); ?>" <?php if ($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][chk]=="1") { print("checked"); } ?> ><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?></label>
                <?php } else { ?>
                      <label class="checkbox-inline"><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?><input type="text" name="m_serviceqt_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[<?php print($j); ?>]" value="<?php print($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][content]); ?>"></label>
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
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <table class="table table-bordered">
            <tr class="success">
              <th colspan="2">身体介護</th>
            </tr>
<?php for($i=0;$i<count($serviceq->oup_m_serviceq_tcode);$i++) { ?>
    <?php if ($serviceq->oup_m_serviceq_tcode[$i]=="3") { ?>
            <tr>
              <th class="success"><?php print($serviceq->oup_m_serviceq_type[$i]); ?></th>
              <td>
                <table>
        <?php for($j=1;$j<=10;$j++) { ?>
            <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]!="") { ?>
                  <tr>
                    <td>
                <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'kbn'}[$i]=="1") { ?>
                      <label class="checkbox-inline"><input type="checkbox" name="m_serviceq_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[]" value="<?php print($j); ?>" <?php if ($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][chk]=="1") { print("checked"); } ?> ><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?></label>
                <?php } else { ?>
                      <label class="checkbox-inline"><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?><input type="text" name="m_serviceqt_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[<?php print($j); ?>]" value="<?php print($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][content]); ?>"></label>
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
          <table class="table table-bordered">
            <tr class="success">
              <th class="success" colspan="2">自立支援</th>
            </tr>
<?php for($i=0;$i<count($serviceq->oup_m_serviceq_tcode);$i++) { ?>
    <?php if ($serviceq->oup_m_serviceq_tcode[$i]=="4") { ?>
            <tr>
              <th class="success"><?php print($serviceq->oup_m_serviceq_type[$i]); ?></th>
              <td>
                <table>
        <?php for($j=1;$j<=10;$j++) { ?>
            <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]!="") { ?>
                  <tr>
                    <td>
                <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'kbn'}[$i]=="1") { ?>
                      <label class="checkbox-inline"><input type="checkbox" name="m_serviceq_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[]" value="<?php print($j); ?>" <?php if ($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][chk]=="1") { print("checked"); } ?> ><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?></label>
                <?php } else { ?>
                      <label class="checkbox-inline"><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?><input type="text" name="m_serviceqt_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[<?php print($j); ?>]" value="<?php print($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][content]); ?>"></label>
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
          <table class="table table-bordered">
            <tr class="success">
              <th colspan="2">生活・家事援助</th>
            </tr>
<?php for($i=0;$i<count($serviceq->oup_m_serviceq_tcode);$i++) { ?>
    <?php if ($serviceq->oup_m_serviceq_tcode[$i]=="5") { ?>
            <tr>
              <th class="success"><?php print($serviceq->oup_m_serviceq_type[$i]); ?></th>
              <td>
                <table>
        <?php for($j=1;$j<=10;$j++) { ?>
            <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]!="") { ?>
                  <tr>
                    <td>
                <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'kbn'}[$i]=="1") { ?>
                      <label class="checkbox-inline"><input type="checkbox" name="m_serviceq_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[]" value="<?php print($j); ?>" <?php if ($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][chk]=="1") { print("checked"); } ?> ><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?></label>
                <?php } else { ?>
                      <label class="checkbox-inline"><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?><input type="text" name="m_serviceqt_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[<?php print($j); ?>]" value="<?php print($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][content]); ?>"></label>
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
          <table class="table table-bordered">
            <tr class="success">
              <th colspan="2">その他</th>
            </tr>
<?php for($i=0;$i<count($serviceq->oup_m_serviceq_tcode);$i++) { ?>
    <?php if ($serviceq->oup_m_serviceq_tcode[$i]=="6") { ?>
            <tr>
              <th class="success"><?php print($serviceq->oup_m_serviceq_type[$i]); ?></th>
              <td>
                <table>
        <?php for($j=1;$j<=10;$j++) { ?>
            <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]!="") { ?>
                  <tr>
                    <td>
                <?php if ($serviceq->{'oup_m_serviceq_a'.$j.'kbn'}[$i]=="1") { ?>
                      <label class="checkbox-inline"><input type="checkbox" name="m_serviceq_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[]" value="<?php print($j); ?>" <?php if ($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][chk]=="1") { print("checked"); } ?> ><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?></label>
                <?php } else { ?>
                      <label class="checkbox-inline"><?php print($serviceq->{'oup_m_serviceq_a'.$j.'content'}[$i]); ?><input type="text" name="m_serviceqt_<?php print($serviceq->oup_m_serviceq_tcode[$i]); ?>_<?php print($serviceq->oup_m_serviceq_qcode[$i]); ?>[<?php print($j); ?>]" value="<?php print($answer[$serviceq->oup_m_serviceq_tcode[$i]][$serviceq->oup_m_serviceq_qcode[$i]][$j][content]); ?>"></label>
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
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-md-9">
          <div class="col-xs-12 col-md-12">
            <button type="submit" class="btn btn-success btn-lg btn-block">送信します</button>
          </div>
        </div>
      </div>
      <br />
      <INPUT type="hidden" name="act" value="1">

      </form>

    </div>
  </body>
</html>
