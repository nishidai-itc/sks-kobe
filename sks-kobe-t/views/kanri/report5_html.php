
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

          <?php for ($i=1;$i<=4;$i++) { ?>
          <tr>
            <td class="rc">
              <label>RC-</label>
              <input type="text" class="text w-75" name="ship<?php echo $i; ?>" value="<?php echo ${"ship".$i}; ?>">
            </td>
            <td>

              <div class="w-45 d-inline-block">
                <input type="checkbox" class="check" value="in<?php echo $i; ?>" <?php echo !is_array(${"ship_in_port_time".$i}) ? "checked" : ""; ?>>
                <label class="m-0">停泊</label>
                <div class="time">
                  <input type="number" class="text-center" name="ship_in_port_time<?php echo $i; ?>[0]" value="<?php echo ${"ship_in_port_time".$i}[0]; ?>" min="0" max="23">
                  <span class="">:</span>
                  <input type="number" class="text-center" name="ship_in_port_time<?php echo $i; ?>[1]" value="<?php echo ${"ship_in_port_time".$i}[1]; ?>" min="0" max="59">
                </div>
              </div>

              <label>～</label>

              <div class="w-45 d-inline-block">
                <input type="checkbox" class="check" value="out<?php echo $i; ?>" <?php echo !is_array(${"ship_out_port_time".$i}) ? "checked" : ""; ?>>
                <label class="m-0">停泊</label>
                <div class="time">
                  <input type="number" class="text-center" name="ship_out_port_time<?php echo $i; ?>[0]" value="<?php echo ${"ship_out_port_time".$i}[0]; ?>" min="0" max="23">
                  <span class="">:</span>
                  <input type="number" class="text-center" name="ship_out_port_time<?php echo $i; ?>[1]" value="<?php echo ${"ship_out_port_time".$i}[1]; ?>" min="0" max="59">
                </div>
              </div>

            </td>
            <td>
            <?php if ($i < 3) { ?>
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
            <td colspan="2"></td>
            <td><label>C-3</label></td>
          </tr>

          <?php for ($i=1;$i<=3;$i++) { ?>
          <tr>
            <td><label><?php if ($i == 1) {echo "ii．C-4ゲート立哨";} elseif ($i == 2) {echo "東サブゲート立哨";} else {echo "iii．搬入出車両";} ?></label></td>
            <td>
              <div class="time">
                <input type="number" class="text-center" name="picket_joban_time<?php echo $i; ?>[0]" value="<?php echo ${"picket_joban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="picket_joban_time<?php echo $i; ?>[1]" value="<?php echo ${"picket_joban_time".$i}[1]; ?>" min="0" max="59">
              </div>
              <label>～</label>
              <div class="time">
                <input type="number" class="text-center" name="picket_kaban_time<?php echo $i; ?>[0]" value="<?php echo ${"picket_kaban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="picket_kaban_time<?php echo $i; ?>[1]" value="<?php echo ${"picket_kaban_time".$i}[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td>
              <?php if ($i != 3) { ?>
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
              <?php } ?>
            </td>
          </tr>
          <?php } ?>

          <tr>
            <td colspan="2"><label>iv．各ゲート及び管理棟、CFS事務所の開錠及び施錠実施</label></td>
            <td><label>C-4</label></td>
          </tr>

          <?php for ($i=1;$i<=2;$i++) { ?>
          <tr>
            <td colspan="2"><label><?php if ($i == 1) {echo "２．重点";} else {echo "i．管理棟及び各建屋の火災、盗難等の警戒警備並びに<br>不法侵入者の警戒監視";} ?></label></td>
            <td>
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

          <?php for ($i=1;$i<=3;$i++) { ?>
          <tr>
            <td colspan="2"><label><?php if ($i == 1) {echo "３．実施";} elseif ($i == 2) {echo "i．昼夜間巡回、警戒警備及び外周赤外線システムの監視";} else {echo "ii．管理棟及び各建屋の鍵の保管管理";} ?></label></td>
            <td>
              <?php if ($i != 3) { ?>
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
              <?php } ?>
            </td>
          </tr>
          <?php } ?>

          <tr>
            <td colspan="2"><label>発砲</label></td>
            <td><label>トンボ照明</label></td>
          </tr>
          
          <?php for ($i=1;$i<=2;$i++) { ?>
          <tr>
            <?php if ($i == 1) { ?>
            <td rowspan="5" colspan="2" class="pr-5"><textarea name="comment" id="" class="w-100" cols="" rows="5" value="<?php echo $comment; ?>"><?php echo $comment; ?></textarea></td>
            <?php } ?>
            <td>
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

          <?php for ($i=1;$i<=2;$i++) { ?>
          <tr>
            <td>
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
          <?php for ($i=0;$i<2;$i++) { ?>
          <tr>
            <?php if ($i == 0) { ?>
            <td rowspan="2" class="align-middle"><label>巡<br>回</label></td>
            <?php } ?>
            <?php for ($j=1;$j<=8;$j++) { ?>
            <td>
              <label class="text-right" style="width: 20px;"><?php echo $j+$i*8 ; ?></label>
              <div class="time2">
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
            <td rowspan="2" colspan="2">
              <textarea name="wk_comment" id="" rows="" class="w-100" value="<?php echo $wk_comment; ?>"><?php echo $wk_comment; ?></textarea>
            </td>
            <?php } elseif ($i == 2) { ?>
            <td>
              <label>管理棟終了</label>
              <input type="text" class="text" name="wk_admin_end" value="<?php echo $wk_admin_end; ?>">
            </td>
            <td>
              <label>部外者</label>
              <input type="number" class="text-center num" name="wk_outsider" value="<?php echo $wk_outsider; ?>" min="0" max="99">
              <label>名</label>
            </td>
            <?php } ?>
            <?php for ($j=1;$j<=3;$j++) { ?>
            <td>
              <!-- <label><?php echo $abc[$j+$i*3] ; ?></label> -->
              <label><?php echo $wk_kbn[${"wk_staff_id".($j+$i*3)}].$wk_hosoku[${"wk_staff_id".($j+$i*3)}] ; ?></label>
              <select name="wk_staff_id<?php echo $j+$i*3 ; ?>" id="wk_staff_id<?php echo $j+$i*3 ; ?>" class="wk_staff_id">
                <option value=""></option>
                <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
                <?php for ($k=0;$k<count($wkdetail->oup_t_wk_detail_no);$k++) { ?>
                <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$k]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$k] == ${"wk_staff_id".($j+($i*3))} ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$k]]; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
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
  window.onload = function() {
    width = $(window).width()
    if (width <= 800) {
    // if ('<?php echo $common->device; ?>' != 'pc') {
      $('.time2 [type="number"]').css('width','20px')
      $('.rc').css('width','25%')
    } else if (width <= 1100) {
      $('.time2 [type="number"]').css('width','35px')
      $('.rc').css('width','40%')
    } else {
      $('.time2 [type="number"]').css('width','45px')
      $('.rc').css('width','50%')
    }
  }
  $(window).resize(function(){
    width = $(window).width()
    if (width <= 800) {
    // if ('<?php echo $common->device; ?>' != 'pc') {
      $('.time2 [type="number"]').css('width','20px')
      $('.rc').css('width','25%')
    } else if (width <= 1100) {
      $('.time2 [type="number"]').css('width','35px')
      $('.rc').css('width','40%')
    } else {
      $('.time2 [type="number"]').css('width','45px')
      $('.rc').css('width','50%')
    }
  })

  $('hr').css('border-top','1px solid #000')

  $('table td').addClass('p-0')

  $('.time, .time2').addClass('d-inline-block border border-dark')
  $('.time [type="number"], .time2 [type="number"]').addClass('p-0 border-0')
  $('.time [type="number"], .num').css('width','45px')
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

  $('.temp, .regist').click(function(){
    if (!confirm('この内容で登録します。よろしいですか？')) return false

    if ($(this).hasClass('temp')) {
      $('[name="act"]').val('2')
    } else {
      $('[name="act"]').val('1')
    }
    
    $('form').submit()
  })
</script>