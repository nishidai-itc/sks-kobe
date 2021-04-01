
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">


  <!-- bootstrap-4.3.1 -->
  <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
  <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->

  <title>警備報告書</title>
</head>

<style>
.w-90{
  width: 90% !important;
}
.w-45{
  width: 45% !important;
}
.w-15{
  width: 15% !important;
}
.w-10{
  width: 10% !important;
}
</style>

<body>
  <div class="container">
    <!-- ヘッダー -->
    <!-- <div class="page-header">
      <br>
      <h2>TKUシステム</h2>
      <h4>メニュー</h4>
    </div> -->

    <!-- ログイン者情報 -->
    <!-- <div class="row">
      <div class="col-12">
        <div class="card" style="padding: 10px;">
          <div class="card-body"></div>
        </div>
      </div>
    </div>
    <br> -->

    <br>
    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td>（警備場所）</td>
            <td>契約先</td>
          </tr>
          <tr>
            <td>RIC-4・C-5</td>
            <td>三菱倉庫株式会社　殿</td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <form action="report5.php" method="post">

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td>（勤務時間）</td>
            <td>天候</td>
            <td>報告者</td>
          </tr>

          <tr>
            <td>
              <label><?php echo "自）".substr($start_date,0,4)."年".substr($start_date,5,2)."月".substr($start_date,8,2)."日　(".getWeek($start_date).")"; ?></label>
              <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
              <div class="time">
                <input type="number" class="text-center" name="joban_time[0]" value="<?php echo $joban_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="joban_time[1]" value="<?php echo $joban_time[1]; ?>" min="0" max="59">
              </div>
            </td>
          </tr>

          <tr>
            <td>
              <label><?php echo "至）".substr($end_date,0,4)."年".substr($end_date,5,2)."月".substr($end_date,8,2)."日　(".getWeek($end_date).")"; ?></label>
              <input type="hidden" name="end_date" value="<?php echo $end_date; ?>">
              <div class="time">
                <input type="number" class="text-center" name="kaban_time[0]" value="<?php echo $kaban_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="kaban_time[1]" value="<?php echo $kaban_time[1]; ?>" min="0" max="59">
              </div>
            </td>

            <td rowspan="2">
              <select name="weather1" id="weather1" class="">
                <option value=""></option>
                <?php for ($i=0;$i<count($weathers);$i++) { ?>
                <option value="<?php echo $weathers[$i]; ?>"<?php echo $weathers[$i] == $weather1 ? "selected" : "" ; ?>><?php echo $weathers[$i]; ?></option>
                <?php } ?>
              </select>
              <select name="weather2" id="weather2" class="">
                <option value=""></option>
                <?php for ($i=0;$i<count($weathers);$i++) { ?>
                <option value="<?php echo $weathers[$i]; ?>"<?php echo $weathers[$i] == $weather2 ? "selected" : "" ; ?>><?php echo $weathers[$i]; ?></option>
                <?php } ?>
              </select>
            </td>
            <td rowspan="2">
              <select name="staff_id" id="staff_id" class="w-50">
                <option value=""></option>
                <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
                <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
                <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $staff_id ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td colspan="2"><label>１．状況</label></td>
            <td><label>ヤード照明</label></td>
          </tr>

          <tr>
            <td colspan="2"><label>i．入出港</label></td>
            <td><label>C-2</label></td>
          </tr>

          <?php for ($i=1;$i<=6;$i++) { ?>
          <tr>
            <td class="rc">
              <label>RC-</label>
              <input type="text" class="text w-75" name="ship<?php echo $i; ?>" value="<?php echo ${"ship".$i}; ?>">
            </td>
            <td>

              <input type="checkbox" class="check" value="in<?php echo $i; ?>" <?php echo !is_array(${"ship_in_port_time".$i}) ? "checked" : ""; ?>>
              <label class="m-0">停泊</label>
              <div class="time">
                <input type="number" class="text-center" name="ship_in_port_time<?php echo $i; ?>[0]" value="<?php echo ${"ship_in_port_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="ship_in_port_time<?php echo $i; ?>[1]" value="<?php echo ${"ship_in_port_time".$i}[1]; ?>" min="0" max="59">
              </div>

              <label>～</label>

              <input type="checkbox" class="check" value="out<?php echo $i; ?>" <?php echo !is_array(${"ship_out_port_time".$i}) ? "checked" : ""; ?>>
              <label class="m-0">停泊</label>
              <div class="time">
                <input type="number" class="text-center" name="ship_out_port_time<?php echo $i; ?>[0]" value="<?php echo ${"ship_out_port_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="ship_out_port_time<?php echo $i; ?>[1]" value="<?php echo ${"ship_out_port_time".$i}[1]; ?>" min="0" max="59">
              </div>

            </td>
            <td>
              <?php if ($i < 5) { ?>
              <select name="c2_kbn<?php echo $i;?>" id="" class="">
                <option value=""></option>
                <?php for ($j=0;$j<count($light_kbn1);$j++) { ?>
                <option value="<?php echo $light_kbn1[$j]; ?>"<?php echo $light_kbn1[$j] == ${"c2_kbn".$i} ? "selected" : "" ; ?>><?php echo $light_kbn1[$j]; ?></option>
                <?php } ?>
              </select>
              <div class="time">
                <input type="number" class="text-center" name="c2_joban_time<?php echo $i; ?>[0]" value="<?php echo ${"c2_joban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="c2_joban_time<?php echo $i; ?>[1]" value="<?php echo ${"c2_joban_time".$i}[1]; ?>" min="0" max="59">
              </div>
              <label>～</label>
              <div class="time">
                <input type="number" class="text-center" name="c2_kaban_time<?php echo $i; ?>[0]" value="<?php echo ${"c2_kaban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="c2_kaban_time<?php echo $i; ?>[1]" value="<?php echo ${"c2_kaban_time".$i}[1]; ?>" min="0" max="59">
              </div>
              <?php } ?>
            </td>
          </tr>
          <?php } ?>

          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>

          <?php for ($i=1;$i<=3;$i++) { ?>
          <tr>
            <td>
              <?php if ($i == 1) { ?><div>&nbsp;</div><?php } ?>
              <label><?php if ($i == 1) {echo "ii．C-4ゲート立哨";} elseif ($i == 2) {echo "東サブゲート立哨";} else {echo "iii．搬入出車両";} ?></label>
            </td>
            <td>
              <?php if ($i == 1) { ?>
                <div class="mb-2">
                  <span class="weekday badge badge-secondary" style="cursor:pointer;">平日</span>
                  　<span class="saturday badge badge-secondary" style="cursor:pointer;">土曜</span>　
                  <span class="holiday badge badge-secondary" style="cursor:pointer;">日祝</span>
                </div>
              <?php } ?>
              <input type="checkbox" class="picket" value="j<?php echo $i; ?>" <?php echo !is_array(${"picket_joban_time".$i}) ? "checked" : ""; ?>>
              <input type="text" class="text" name="picket_joban_time<?php echo $i; ?>" value="<?php echo !is_array(${"picket_joban_time".$i}) ? ${"picket_joban_time".$i} : ""; ?>" style="width: 100px;">
              <div class="time">
                <input type="number" class="text-center" name="picket_joban_time<?php echo $i; ?>[0]" value="<?php echo is_array(${"picket_joban_time".$i}) ? ${"picket_joban_time".$i}[0] : ""; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="picket_joban_time<?php echo $i; ?>[1]" value="<?php echo is_array(${"picket_joban_time".$i}) ? ${"picket_joban_time".$i}[1] : ""; ?>" min="0" max="59">
              </div>
              <label>～</label>
              <input type="checkbox" class="picket" value="k<?php echo $i; ?>" <?php echo !is_array(${"picket_kaban_time".$i}) ? "checked" : ""; ?>>
              <input type="text" class="text" name="picket_kaban_time<?php echo $i; ?>" value="<?php echo !is_array(${"picket_kaban_time".$i}) ? ${"picket_kaban_time".$i} : ""; ?>" style="width: 100px;">
              <div class="time">
                <input type="number" class="text-center" name="picket_kaban_time<?php echo $i; ?>[0]" value="<?php echo is_array(${"picket_kaban_time".$i}) ? ${"picket_kaban_time".$i}[0] : ""; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="picket_kaban_time<?php echo $i; ?>[1]" value="<?php echo is_array(${"picket_kaban_time".$i}) ? ${"picket_kaban_time".$i}[1] : ""; ?>" min="0" max="59">
              </div>
            </td>
            <td>
              <?php if ($i == 1) { ?>
              <div><label>C-3</label></div>
              <?php } ?>
              <select name="c3_kbn<?php echo $i;?>" id="" class="">
                <option value=""></option>
                <?php for ($j=0;$j<count($light_kbn1);$j++) { ?>
                <option value="<?php echo $light_kbn1[$j]; ?>"<?php echo $light_kbn1[$j] == ${"c3_kbn".$i} ? "selected" : "" ; ?>><?php echo $light_kbn1[$j]; ?></option>
                <?php } ?>
              </select>
              <div class="time">
                <input type="number" class="text-center" name="c3_joban_time<?php echo $i; ?>[0]" value="<?php echo ${"c3_joban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="c3_joban_time<?php echo $i; ?>[1]" value="<?php echo ${"c3_joban_time".$i}[1]; ?>" min="0" max="59">
              </div>
              <label>～</label>
              <div class="time">
                <input type="number" class="text-center" name="c3_kaban_time<?php echo $i; ?>[0]" value="<?php echo ${"c3_kaban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="c3_kaban_time<?php echo $i; ?>[1]" value="<?php echo ${"c3_kaban_time".$i}[1]; ?>" min="0" max="59">
              </div>
            </td>
          </tr>
          <?php } ?>
          <tr>
            <td colspan="2"></td>
            <td>
              <select name="c3_kbn4" id="" class="">
                <option value=""></option>
                <?php for ($j=0;$j<count($light_kbn1);$j++) { ?>
                <option value="<?php echo $light_kbn1[$j]; ?>"<?php echo $light_kbn1[$j] == $c3_kbn4 ? "selected" : "" ; ?>><?php echo $light_kbn1[$j]; ?></option>
                <?php } ?>
              </select>
              <div class="time">
                <input type="number" class="text-center" name="c3_joban_time4[0]" value="<?php echo $c3_joban_time4[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="c3_joban_time4[1]" value="<?php echo $c3_joban_time4[1]; ?>" min="0" max="59">
              </div>
              <label>～</label>
              <div class="time">
                <input type="number" class="text-center" name="c3_kaban_time4[0]" value="<?php echo $c3_kaban_time4[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="c3_kaban_time4[1]" value="<?php echo $c3_kaban_time4[1]; ?>" min="0" max="59">
              </div>
            </td>
          </tr>

          <tr>
            <td colspan="2"><label>iv．各ゲート及び管理棟、CFS事務所の開錠及び施錠実施</label></td>
            <td><label>C-4</label></td>
          </tr>

          <?php for ($i=1;$i<=4;$i++) { ?>
          <tr>
            <td colspan="2">
              <?php if ($i < 4) {?>
              <label><?php if ($i == 1) {echo "２．重点";} elseif ($i == 2) {echo "i．管理棟及び各建屋の火災、盗難等の警戒警備並びに";} else {echo "不法侵入者の警戒監視";} ?></label>
              <?php } ?>
            </td>
            <td>
              <select name="c4_kbn<?php echo $i;?>" id="" class="">
                <option value=""></option>
                <?php for ($j=0;$j<count($light_kbn1);$j++) { ?>
                <option value="<?php echo $light_kbn1[$j]; ?>"<?php echo $light_kbn1[$j] == ${"c4_kbn".$i} ? "selected" : "" ; ?>><?php echo $light_kbn1[$j]; ?></option>
                <?php } ?>
              </select>
              <div class="time">
                <input type="number" class="text-center" name="c4_joban_time<?php echo $i; ?>[0]" value="<?php echo ${"c4_joban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="c4_joban_time<?php echo $i; ?>[1]" value="<?php echo ${"c4_joban_time".$i}[1]; ?>" min="0" max="59">
              </div>
              <label>～</label>
              <div class="time">
                <input type="number" class="text-center" name="c4_kaban_time<?php echo $i; ?>[0]" value="<?php echo ${"c4_kaban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="c4_kaban_time<?php echo $i; ?>[1]" value="<?php echo ${"c4_kaban_time".$i}[1]; ?>" min="0" max="59">
              </div>
            </td>
          </tr>
          <?php } ?>

          <tr>
            <td colspan="2"><label>ii．搬入出車両及び外来者の適正誘導</label></td>
            <td><label>C-5</label></td>
          </tr>

          <?php for ($i=1;$i<=4;$i++) { ?>
          <tr>
            <td colspan="2">
            <?php if ($i < 4) {?>
              <label><?php if ($i == 1) {echo "３．実施";} elseif ($i == 2) {echo "i．昼夜間巡回、警戒警備及び外周赤外線システムの監視";} else {echo "ii．管理棟及び各建屋の鍵の保管管理";} ?></label>
            <?php } ?>
            </td>
            <td>
              <select name="c5_kbn<?php echo $i;?>" id="" class="">
                <option value=""></option>
                <?php for ($j=0;$j<count($light_kbn1);$j++) { ?>
                <option value="<?php echo $light_kbn1[$j]; ?>"<?php echo $light_kbn1[$j] == ${"c5_kbn".$i} ? "selected" : "" ; ?>><?php echo $light_kbn1[$j]; ?></option>
                <?php } ?>
              </select>
              <div class="time">
                <input type="number" class="text-center" name="c5_joban_time<?php echo $i; ?>[0]" value="<?php echo ${"c5_joban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="c5_joban_time<?php echo $i; ?>[1]" value="<?php echo ${"c5_joban_time".$i}[1]; ?>" min="0" max="59">
              </div>
              <label>～</label>
              <div class="time">
                <input type="number" class="text-center" name="c5_kaban_time<?php echo $i; ?>[0]" value="<?php echo ${"c5_kaban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="c5_kaban_time<?php echo $i; ?>[1]" value="<?php echo ${"c5_kaban_time".$i}[1]; ?>" min="0" max="59">
              </div>
            </td>
          </tr>
          <?php } ?>

          <tr>
            <td colspan="2"><label>発報</label></td>
            <td><label>トンボ照明</label></td>
          </tr>
          
          <?php for ($i=1;$i<=4;$i++) { ?>
          <tr>
            <?php if ($i == 1) { ?>
            <td rowspan="9" colspan="2" class="pr-5"><textarea name="comment" id="" class="w-100" cols="" rows="12" value="<?php echo $comment; ?>"><?php echo $comment; ?></textarea></td>
            <?php } ?>
            <td>
              <select name="tonbo_light_kbn<?php echo $i;?>" id="" class="">
                <option value=""></option>
                <?php for ($j=0;$j<count($light_kbn2);$j++) { ?>
                <option value="<?php echo $light_kbn2[$j]; ?>"<?php echo $light_kbn2[$j] == ${"tonbo_light_kbn".$i} ? "selected" : "" ; ?>><?php echo $light_kbn2[$j]; ?></option>
                <?php } ?>
              </select>
              <div class="time">
                <input type="number" class="text-center" name="tonbo_light_joban_time<?php echo $i; ?>[0]" value="<?php echo ${"tonbo_light_joban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="tonbo_light_joban_time<?php echo $i; ?>[1]" value="<?php echo ${"tonbo_light_joban_time".$i}[1]; ?>" min="0" max="59">
              </div>
              <label>～</label>
              <div class="time">
                <input type="number" class="text-center" name="tonbo_light_kaban_time<?php echo $i; ?>[0]" value="<?php echo ${"tonbo_light_kaban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="tonbo_light_kaban_time<?php echo $i; ?>[1]" value="<?php echo ${"tonbo_light_kaban_time".$i}[1]; ?>" min="0" max="59">
              </div>
            </td>
          </tr>
          <?php } ?>

          <tr>
            <td><label>C5倉庫屋外照明　西・南</label></td>
          </tr>

          <?php for ($i=1;$i<=4;$i++) { ?>
          <tr>
            <td>
              <select name="c5_light_kbn<?php echo $i;?>" id="" class="">
                <option value=""></option>
                <?php for ($j=0;$j<count($light_kbn2);$j++) { ?>
                <option value="<?php echo $light_kbn2[$j]; ?>"<?php echo $light_kbn2[$j] == ${"c5_light_kbn".$i} ? "selected" : "" ; ?>><?php echo $light_kbn2[$j]; ?></option>
                <?php } ?>
              </select>
              <div class="time">
                <input type="number" class="text-center" name="c5_light_joban_time<?php echo $i; ?>[0]" value="<?php echo ${"c5_light_joban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="c5_light_joban_time<?php echo $i; ?>[1]" value="<?php echo ${"c5_light_joban_time".$i}[1]; ?>" min="0" max="59">
              </div>
              <label>～</label>
              <div class="time">
                <input type="number" class="text-center" name="c5_light_kaban_time<?php echo $i; ?>[0]" value="<?php echo ${"c5_light_kaban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="c5_light_kaban_time<?php echo $i; ?>[1]" value="<?php echo ${"c5_light_kaban_time".$i}[1]; ?>" min="0" max="59">
              </div>
            </td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td colspan="9" class="pb-2">
              <span class="weekday2 badge badge-secondary" style="cursor:pointer;">平日</span>
              　<span class="saturday2 badge badge-secondary" style="cursor:pointer;">土曜</span>　
              <span class="holiday2 badge badge-secondary" style="cursor:pointer;">日祝</span>
            </td>
          </tr>
          <?php for ($i=0;$i<2;$i++) { ?>
          <tr>
            <?php if ($i == 0) { ?>
            <td rowspan="2" class="align-middle"><label>巡<br>回</label></td>
            <?php } ?>
            <?php for ($j=1;$j<=8;$j++) { ?>
            <td>
              <label class="text-right" style="width: 20px;"><?php echo $j+$i*8 ; ?></label>
              <div class="patrol time2 <?php echo $j+$i*8; ?>">
                <input type="number" class="text-center" name="patrol_time<?php echo $j+$i*8; ?>[0]" value="<?php echo ${"patrol_time".($j+($i*8))}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="patrol_time<?php echo $j+$i*8; ?>[1]" value="<?php echo ${"patrol_time".($j+($i*8))}[1]; ?>" min="0" max="59">
              </div>
            </td>
            <?php } ?>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <?php for ($i=0;$i<3;$i++) { ?>
          <tr>
            <?php if ($i == 0) { ?>
            <td class="align-middle" rowspan="3">備<br>考</td>
            <td rowspan="2" colspan="2" class="">
              <textarea name="wk_comment" id="" rows="5" class="w-100" value="<?php echo $wk_comment; ?>"><?php echo $wk_comment; ?></textarea>
            </td>
            <?php } elseif ($i == 2) { ?>
            <td>
              <div class="row">
                <div class="col-12"><label>管理棟終了</label></div>
                <div class="col-12">
                  <!-- <input type="text" class="text" name="wk_admin_end" value="<?php echo $wk_admin_end; ?>"> -->
                  <span class="inp badge badge-secondary" style="cursor:pointer;"><?php echo is_array($wk_admin_end) ? "時刻" : "入力" ; ?></span>
                  <input type="text" class="text w-75" name="wk_admin_end" value="<?php echo !is_array($wk_admin_end) && $wk_admin_end ? $wk_admin_end : "泊り"; ?>">
                  <div class="time">
                    <input type="number" class="text-center" name="wk_admin_end[0]" value="<?php echo is_array($wk_admin_end) ? $wk_admin_end[0] : ""; ?>" min="0" max="23">
                    <span class="">:</span>
                    <input type="number" class="text-center" name="wk_admin_end[1]" value="<?php echo is_array($wk_admin_end) ? $wk_admin_end[1] : ""; ?>" min="0" max="59">
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col-12"><label>部外者</label></div>
                <div class="col-12">
                  <input type="number" class="text-center num" name="wk_outsider" value="<?php echo $wk_outsider; ?>" min="0" max="99">
                  <!-- <input type="text" class="text-center num" name="wk_outsider" value="<?php echo $wk_outsider; ?>"> -->
                  <label>名</label>
                </div>
              </div>
            </td>
            <?php } ?>
            <?php for ($j=1;$j<=3;$j++) { ?>
            <td>
              <table class="table table-borderless">
                <tr>
                  <td>
                    <div class="row">
                      <div class="col-md-4 col-xl-3">
                        <div class="row">
                          <div class="col-12 pr-0">
                            <select name="wk_staff_id<?php echo $j+$i*3 ; ?>_kbn" id="" class="w-100">
                              <option value=""></option>
                              <?php for ($k=1;$k<=count($kinmu_kbn);$k++) { ?>
                              <option value="<?php echo $k; ?>" <?php echo $k == ${"wk_staff_id".($j+($i*3))."_kbn"} ? "selected" : ""; ?>><?php echo $kinmu_kbn[$k]; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="col-12 pr-0">
                            <select name="wk_staff_id<?php echo $j+$i*3 ; ?>_ken" id="" class="w-100">
                              <option value=""></option>
                              <option value="1" <?php echo ${"wk_staff_id".($j+($i*3))."_ken"} == "1" ? "selected" : ""; ?>>研</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-8 col-xl-9 pl-0">
                        <!-- <label><?php echo $wk_kbn[${"wk_staff_id".($j+$i*3)}].$wk_ken[${"wk_staff_id".($j+$i*3)}] ; ?></label> -->
                        <select name="wk_staff_id<?php echo $j+$i*3 ; ?>" id="wk_staff_id<?php echo $j+$i*3 ; ?>" class="w-75 h-100">
                          <option value=""></option>
                          <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
                          <?php for ($k=0;$k<count($wkdetail->oup_t_wk_detail_no);$k++) { ?>
                          <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$k]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$k] == ${"wk_staff_id".($j+($i*3))} ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$k]]; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>
            </td>
            <?php } ?>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <hr>

    <input type="hidden" name="no" value="<?php echo $no; ?>">
    <input type="hidden" name="act" value="">
    </form>

    <div class="row">
      <div class="col-12 text-right">（株）新神戸セキュリティ</div>
    </div>
    <br>

    <div class="row">
      <div class="col-4">
        <button type="button" class="btn btn-warning btn-block temp" role="button">一時保存</button>
      </div>
      <div class="col-4">
        <button type="button" class="btn btn-success btn-block regist" role="button">完了</button>
      </div>
      <div class="col-4">
        <?php if ($_SESSION["menu_flg"] == "kanri") { ?>
        <button type="button" class="btn btn-secondary btn-block" role="button" onclick="location.href='keibihokoku.php'">戻る</button>
        <?php } else { ?>
        <button type="button" class="btn btn-secondary btn-block" role="button" onclick="location.href='report_menu.php'">戻る</button>
        <?php } ?>
      </div>
    </div>

    <!-- ログアウト -->
    <!-- <div class="row">
      <div class="col-12">
        <form name="frm" method="POST" action="">
          <button class="btn btn-secondary btn-block" name="logout" role="button">ログアウト</button>
        </form>
      </div>
    </div> -->

  </div>
  <br>

  <div class="modal-footer"></div>
</body>

</html>

<script type="text/javascript">
  var inp

  function winload() {
    $('.time, .time2').addClass('d-inline-block border border-dark')
    $('.time [type="number"], .time2 [type="number"]').addClass('p-0 border-0')
    width = $(window).width()
    if (width <= 800) {
    // if ('<?php echo $common->device; ?>' != 'pc') {
      $('.time [type="number"]').css('width','30px')
      $('.time2 [type="number"]').css('width','20px')
      $('.rc').css('width','25%')
    } else if (width <= 1100) {
      $('.time [type="number"]').css('width','40px')
      $('.time2 [type="number"]').css('width','35px')
      $('.rc').css('width','40%')
    } else {
      $('.time [type="number"], .time2 [type="number"]').css('width','45px')
      $('.rc').css('width','40%')
    }

    if ($('.inp').text() == '入力') {
      inp = $('.inp').next().next().remove()
    } else {
      inp = $('.inp').next().remove()
    }
  }
  winload()
  
  $(window).resize(function(){
    width = $(window).width()
    if (width <= 800) {
    // if ('<?php echo $common->device; ?>' != 'pc') {
      $('.time [type="number"]').css('width','30px')
      $('.time2 [type="number"]').css('width','20px')
      $('.rc').css('width','25%')
    } else if (width <= 1100) {
      $('.time [type="number"]').css('width','45px')
      $('.time2 [type="number"]').css('width','35px')
      $('.rc').css('width','30%')
    } else {
      $('.time2 [type="number"]').css('width','45px')
      $('.rc').css('width','40%')
    }
  })

  $('hr').css('border-top','1px solid #000')

  $('table td').addClass('p-0')

  // $('.time, .time2').addClass('d-inline-block border border-dark')
  // $('.time [type="number"], .time2 [type="number"]').addClass('p-0 border-0')
  // $('.time [type="number"], .num').css('width','45px')
  $('.num').css('width','45px')
  $('.num, .text').addClass('p-0')
  $('.num, .text').css('border','1px solid #343a40')

  var checkList = {}
  var no
  // 入出港checkbox（初期表示）
  $('.check').each(function(){
    no = $(this).val()
    if ($(this).prop('checked')) {
      checkList[no] = $(this).next().next().remove()
    } else {
      checkList[no] = $(this).next().remove()
    }
  })
  // 入出港checkbox（クリックで切り替え）
  $('.check').click(function(){
    no = $(this).val()
    if ($(this).prop('checked')) {
      $(this).next().after(checkList[no])
      checkList[no] = $(this).next().remove()
    } else {
      $(this).next().after(checkList[no])
      checkList[no] = $(this).next().remove()
    }
  })

  var picketList = {}
  var no
  // 立哨ゲート、搬入出車両（初期表示）
  $('.picket').each(function(){
    no = $(this).val()
    if ($(this).prop('checked')) {
      picketList[no] = $(this).next().next().remove()
    } else {
      picketList[no] = $(this).next().remove()
    }
  })
  $('.picket').change(function(){
    no = $(this).val()
    if ($(this).prop('checked')) {
      $(this).next().after(picketList[no])
      picketList[no] = $(this).next().remove()
    } else {
      $(this).next().after(picketList[no])
      picketList[no] = $(this).next().remove()
    }
  })
  
  $('.inp').click(function(){
    if ($(this).text() == '入力') {
      $(this).text('時刻')
    } else {
      $(this).text('入力')
    }
    $(this).parent().append(inp)
    inp = $(this).next().remove()
  })

  // 曜日ボタン（ゲート立哨、搬入出車両）
  var daysList = {
    // 上番、下番時刻（平日）
    'weekday':{'j1':['08','30'],'j2':['08','30'],'j3':['08','30'],'k1':['18','30'],'k2':['18','30'],'k3':['18','30']},
    // 上番、下番時刻（土曜）
    'saturday':{'j1':['08','30'],'j2':'作業なし','j3':['08','30'],'k1':['11','30'],'k2':'作業なし','k3':['11','30']},
    // 上番、下番時刻（日曜、祝日）
    'holiday':{'j1':'作業なし','j2':'作業なし','j3':'作業なし','k1':'作業なし','k2':'作業なし','k3':'作業なし'},
  }
  $('.weekday, .saturday, .holiday').click(function(){
    var kbn = $(this).attr('class')
    kbn = kbn.split(' ')
    kbn = kbn[0]
    $('.picket').each(function(){
      no = $(this).val()
      for (var i=1;i<=2;i++) {
        if (kbn == 'weekday') {
          if ($(this).prop('checked')) {
            $(this).prop('checked',false).change()
          }
        } else if (kbn == 'saturday') {
          if ($(this).prop('checked')) {
            $(this).prop('checked',false).change()
          }
          if ((no == 'j2' || no == 'k2') && !$(this).prop('checked')) {
            $(this).prop('checked',true).change()
          }
        } else {
          if (!$(this).prop('checked')) {
            $(this).prop('checked',true).change()
          }
        }

        if (daysList[kbn][no].length == 2) {
          $(this).next().children().eq(0).val(daysList[kbn][no][0])
          $(this).next().children().eq(2).val(daysList[kbn][no][1])
        } else {
          $(this).next().val(daysList[kbn][no])
        }
      }
    })
    // for (var i=1;i<=3;i++) {
    //   $('[name^="picket_joban_time'+i+'"]').each(function(key,value){
    //     $(this).val(joban[kbn][i][key])
    //     console.log(key,value)
    //   })
    //   $('[name^="picket_kaban_time'+i+'"]').each(function(key,value){
    //     $(this).val(kaban[kbn][i][key])
    //   })
    // }
  })

  // 曜日ボタン（巡回）
  var patrolList = {
    // 巡回時刻（平日）
    'weekday2':{
      '1':['17','30'],'2':['19','00'],'3':['21','00'],'4':['22','30'],'5':['24','00'],'6':['01','00'],
      '7':['02','00'],'8':['03','00'],'9':['04','00'],'10':['05','30'],'11':['06','30'],'12':['',''],
      '13':['',''],'14':['',''],'15':['',''],'16':['','']
    },
    // 巡回時刻（土曜）
    'saturday2':{
      '1':['13','00'],'2':['15','00'],'3':['17','00'],'4':['19','00'],'5':['21','00'],'6':['22','30'],
      '7':['24','00'],'8':['01','00'],'9':['02','00'],'10':['03','00'],'11':['04','00'],'12':['04','30'],
      '13':['',''],'14':['',''],'15':['',''],'16':['','']
    },
    // 巡回時刻（日曜、祝日）
    'holiday2':{
      '1':['08','00'],'2':['10','00'],'3':['12','00'],'4':['14','00'],'5':['16','00'],'6':['17','30'],
      '7':['19','00'],'8':['21','00'],'9':['22','30'],'10':['24','00'],'11':['01','00'],'12':['02','30'],
      '13':['03','30'],'14':['04','20'],'15':['05','30'],'16':['06','30']
    },
  }
  $('.weekday2, .saturday2, .holiday2').click(function(){
    var kbn = $(this).attr('class')
    kbn = kbn.split(' ')
    kbn = kbn[0]
    $('.patrol').each(function(key,value){
      var no = $(this).attr('class')
      no = no.split(' ')
      no = no[2]
      // console.log(patrolList[kbn][key+1])
      $(this).children().eq(0).val(patrolList[kbn][key+1][0])
      $(this).children().eq(2).val(patrolList[kbn][key+1][1])
    })
  })

  $('.temp, .regist').click(function(){
    if (!confirm('この内容で登録します。よろしいですか？')) return false

    if ($(this).hasClass('temp')) {
      $('[name="act"]').val('2')
    } else {
      $('[name="act"]').val('1')
    }

    // Gチェックあればアラート
    $.ajax({
      url : "ajaxController.php",
      type:"post",
      data: {
        act: 'gchk',
        no: $('[name="start_date"]').val().replace(/-/g,'')+'5'
      },
      dataType:"json"
    }).done(function(data){
      if (data == '1') {
        alert('既にGチェック済のため登録できません。')
      } else {
        $('form').submit()
      }
    }).fail(function(data){
      alert('通信エラー')
    })
    
    // $('form').submit()
  })
</script>