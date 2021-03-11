
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
.w-15{
  width: 15% !important;
}
</style>

<body>
  <div class="container">
    
    <br>
    <form action="report1.php" method="post">

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td><label>（警備場所）</label></td>
            <td><label>契約先</label></td>
          </tr>

          <tr>
            <td><label>PI・C-15.16.17　KICT</label></td>
            <td><label>商船港運株式会社　殿</label></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td><label>（勤務時間）</label></td>
            <td><label>天候</label></td>
            <td><label>担当警備士</label></td>
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
                <?php if ($staff2->oup_m_staff_id) { ?>
                <?php for ($i=0;$i<count($staff2->oup_m_staff_id);$i++) { ?>
                <option value="<?php echo $staff2->oup_m_staff_id[$i]; ?>"<?php echo $staff2->oup_m_staff_id[$i] == $staff_id ? "selected" : "" ; ?>><?php echo $staff_name[$staff2->oup_m_staff_id[$i]]; ?></option>
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
            <td class="align-middle" rowspan="12">状<br>況</td>
            <td><label>１．入出港船舶</label></td>
            <td><label>入港</label></td>
            <td><label>出港</label></td>
          </tr>

          <?php for ($i=1;$i<=9;$i++) { ?>
          <tr>
            <td>
              <input type="text" class="text w-75" name="wk_ship<?php echo $i; ?>" value="<?php echo ${"wk_ship".$i}; ?>">
            </td>
            <td>
              <input type="checkbox" class="check" value="in<?php echo $i; ?>" <?php echo !is_array(${"wk_ship_in_port_time".$i}) ? "checked" : ""; ?>>
              <label class="m-0">停泊</label>
              <div class="time">
                <input type="number" class="text-center" name="wk_ship_in_port_time<?php echo $i; ?>[0]" value="<?php echo ${"wk_ship_in_port_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="wk_ship_in_port_time<?php echo $i; ?>[1]" value="<?php echo ${"wk_ship_in_port_time".$i}[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td>
              <input type="checkbox" class="check" value="out<?php echo $i; ?>" <?php echo !is_array(${"wk_ship_out_port_time".$i}) ? "checked" : ""; ?>>
              <label class="m-0">停泊</label>
              <div class="time">
                <input type="number" class="text-center" name="wk_ship_out_port_time<?php echo $i; ?>[0]" value="<?php echo ${"wk_ship_out_port_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="wk_ship_out_port_time<?php echo $i; ?>[1]" value="<?php echo ${"wk_ship_out_port_time".$i}[1]; ?>" min="0" max="59">
              </div>
            </td>
          </tr>
          <?php } ?>

          <tr>
            <td class="pt-1">
              <div class="d-inline-block w-25"><label>２．搬入出</label></div>
              <div class="time">
                <input type="number" class="text-center" name="wk_in_out_start_time[0]" value="<?php echo $wk_in_out_start_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="wk_in_out_start_time[1]" value="<?php echo $wk_in_out_start_time[1]; ?>" min="0" max="59">
              </div>
              <div class="time">
                <input type="number" class="text-center" name="wk_in_out_end_time[0]" value="<?php echo $wk_in_out_end_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="wk_in_out_end_time[1]" value="<?php echo $wk_in_out_end_time[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td class="pt-1" colspan="2">
              <div class="d-inline-block w-25"><label>４．VP終了</label></div>
              <div class="time">
                <input type="number" class="text-center" name="wk_vp_end_time[0]" value="<?php echo $wk_vp_end_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="wk_vp_end_time[1]" value="<?php echo $wk_vp_end_time[1]; ?>" min="0" max="59">
              </div>
            </td>
          </tr>

          <tr>
            <td>
              <div class="d-inline-block w-25"><label>３．構内作業</label></div>
              <div class="time">
                <input type="number" class="text-center" name="wk_joban_time[0]" value="<?php echo $wk_joban_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="wk_joban_time[1]" value="<?php echo $wk_joban_time[1]; ?>" min="0" max="59">
              </div>
              <div class="time">
                <input type="number" class="text-center" name="wk_kaban_time[0]" value="<?php echo $wk_kaban_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="wk_kaban_time[1]" value="<?php echo $wk_kaban_time[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td colspan="2">
              <div class="d-inline-block w-25"><label>５．VP作業終了</label></div>
              <div class="time">
                <input type="number" class="text-center" name="wk_vp_kaban_time[0]" value="<?php echo $wk_vp_kaban_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="wk_vp_kaban_time[1]" value="<?php echo $wk_vp_kaban_time[1]; ?>" min="0" max="59">
              </div>
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
            <td class="align-middle" rowspan="2">重<br>点</td>
            <td><label>１．車両及び外来者等の入出管理</label></td>
          </tr>

          <tr>
            <td><label>２．管理棟及び、その他の火災盗難等の警戒設備、並びに不法侵入者の警戒監視</label></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td class="align-middle" rowspan="3">実<br>施</td>
            <td><label>１．各ポスト立哨、車両等の誘導</label></td>
          </tr>

          <tr>
            <td><label>２．管理棟及び、その他の火災盗難等の警戒設備、並びに不法侵入者の警戒監視</label></td>
          </tr>

          <tr>
            <td><label>３．照明灯点消灯、水道メーター検針</label></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr class="con">
            <td class="align-middle" rowspan="17">特<br>記</td>
            <td><label>１．甲陽運輸</label></td>
            <td class="w-15">
              <div class="time">
                <input type="number" class="text-center" name="koyo_joban_time[0]" value="<?php echo $koyo_joban_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="koyo_joban_time[1]" value="<?php echo $koyo_joban_time[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td class="w-15">
              <div class="time">
                <input type="number" class="text-center" name="koyo_kaban_time[0]" value="<?php echo $koyo_kaban_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="koyo_kaban_time[1]" value="<?php echo $koyo_kaban_time[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td class="align-middle" rowspan="3"><label>ヤード照明</label></td>
            <td><label>点灯</label></td>
            <td><label>消灯</label></td>
          </tr>

          <tr class="con">
            <td><label>２．住井運輸</label></td>
            <td>
              <div class="time">
                <input type="number" class="text-center" name="sumii_joban_time[0]" value="<?php echo $sumii_joban_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="sumii_joban_time[1]" value="<?php echo $sumii_joban_time[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td>
              <div class="time">
                <input type="number" class="text-center" name="sumii_kaban_time[0]" value="<?php echo $sumii_kaban_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="sumii_kaban_time[1]" value="<?php echo $sumii_kaban_time[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td>
              <div class="time">
                <input type="number" class="text-center" name="yard_on_time1[0]" value="<?php echo $yard_on_time1[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="yard_on_time1[1]" value="<?php echo $yard_on_time1[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td>
              <div class="time">
                <input type="number" class="text-center" name="yard_off_time1[0]" value="<?php echo $yard_off_time1[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="yard_off_time1[1]" value="<?php echo $yard_off_time1[1]; ?>" min="0" max="59">
              </div>
            </td>
          </tr>

          <tr class="con">
            <td><label>３．最終退出者</label></td>
            <td>
              <input type="checkbox" class="check2" <?php echo !is_array($last_exit1) ? "checked" : "" ; ?>>
              
              <div class="time">
                <input type="number" class="text-center" name="last_exit1[0]" value="<?php echo is_array($last_exit1) ? $last_exit1[0] : "" ; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="last_exit1[1]" value="<?php echo is_array($last_exit1) ? $last_exit1[1] : "" ; ?>" min="0" max="59">
              </div>
              <input type="text" class="text" name="last_exit1" value="<?php echo !is_array($last_exit1) ? $last_exit1 : "" ; ?>">
              
            </td>
            <td>
              <input type="checkbox" class="check2" <?php echo !is_array($last_exit2) ? "checked" : "" ; ?>>
              
              <div class="time">
                <input type="number" class="text-center" name="last_exit2[0]" value="<?php echo is_array($last_exit2) ? $last_exit2[0] : "" ; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="last_exit2[1]" value="<?php echo is_array($last_exit2) ? $last_exit2[1] : "" ; ?>" min="0" max="59">
              </div>
              <input type="text" class="text" name="last_exit2" value="<?php echo !is_array($last_exit2) ? $last_exit2 : "" ; ?>">
              
            </td>
            <!-- <td>
              <input type="text" class="text" name="last_exit" value="<?php echo $last_exit; ?>">
            </td> -->
            <td>
              <div class="time">
                <input type="number" class="text-center" name="yard_on_time2[0]" value="<?php echo $yard_on_time2[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="yard_on_time2[1]" value="<?php echo $yard_on_time2[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td>
              <div class="time">
                <input type="number" class="text-center" name="yard_off_time2[0]" value="<?php echo $yard_off_time2[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="yard_off_time2[1]" value="<?php echo $yard_off_time2[1]; ?>" min="0" max="59">
              </div>
            </td>
          </tr>

          <tr>
            <td colspan="6"><label>【残業】</label></td>
          </tr>

          <?php for ($i=0;$i<count($tokki);$i++) { ?>
          <tr>
            <td>
              <label><?php echo $tokki[$i]["title"] ; ?></label>
            </td>
            <td colspan="3">
              <div class="time">
                <input type="number" class="text-center" name="<?php echo $tokki[$i]["name"][0] ; ?>[0]" value="<?php echo ${$tokki[$i]["name"][0]}[0] ; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="<?php echo $tokki[$i]["name"][0] ; ?>[1]" value="<?php echo ${$tokki[$i]["name"][0]}[1] ; ?>" min="0" max="59">
              </div>
              <label>～</label>
              <div class="time">
                <input type="number" class="text-center" name="<?php echo $tokki[$i]["name"][1] ; ?>[0]" value="<?php echo ${$tokki[$i]["name"][1]}[0] ; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="<?php echo $tokki[$i]["name"][1] ; ?>[1]" value="<?php echo ${$tokki[$i]["name"][1]}[1] ; ?>" min="0" max="59">
              </div>
            </td>
            <td colspan="2">
              <input type="number" class="text-center num" name="<?php echo $tokki[$i]["name"][2] ; ?>" value="<?php echo ${$tokki[$i]["name"][2]} ; ?>" min="0">
              <label>名</label>
              <label>X</label>
              <input type="number" class="text-center num" name="<?php echo $tokki[$i]["name"][3] ; ?>" value="<?php echo ${$tokki[$i]["name"][3]} ; ?>">
              <label>H</label>
            </td>
          </tr>
          <?php } ?>

          <tr>
            <td><label>・コメント</label></td>
            <td colspan="5">
              <textarea name="comment" id="" class="w-100" cols="" rows="3" value="<?php echo $comment; ?>"><?php echo $comment; ?></textarea>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <?php /* ?>
    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td><label>巡回</label></td>
            <?php for ($i=1;$i<=8;$i++) { ?>
            <td>
              <label><?php echo $title[$i]; ?></label>
              <div class="time2">
                <input type="number" class="text-center" name="patrol_time<?php echo $i ; ?>[0]" value="<?php echo ${"patrol_time".$i}[0] ; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="patrol_time<?php echo $i ; ?>[1]" value="<?php echo ${"patrol_time".$i}[1] ; ?>" min="0" max="59">
              </div>
            </td>
            <?php } ?>
          </tr>
        </table>
      </div>
    </div>
    <hr>
    <?php */ ?>

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <?php for ($i=1;$i<=5;$i++) { ?>
          <tr>
            <?php if ($i == 1) { ?>
            <td rowspan="6" class="align-middle"><label>備<br>考</label></td>
            <td></td>
            <td></td>
            <td rowspan="6" class="align-middle"><label>勤<br>務<br>員</label></td>
            <?php } elseif ($i == 2) { ?>
            <td><label>B</label></td>
            <td><label>C</label></td>
            <?php } elseif ($i == 3) { ?>
            <td><label>水道メーター</label></td>
            <td><label>水道メーター</label></td>
            <?php } elseif ($i == 4) { ?>
            <td>
              <input type="number" class="text-center p-0 w-75" name="metertb1" value="<?php echo $meterb1 ; ?>" min="0">
            </td>
            <td>
              <input type="number" class="text-center p-0 w-75" name="metertc1" value="<?php echo $meterc1 ; ?>" min="0">
            </td>
            <?php } ?>
            <?php if ($i == 5) { ?>
            <td>
              <input type="number" class="text-center p-0 w-75" name="metertb2" value="<?php echo $meterb2 ; ?>" min="0">
            </td>
            <td>
              <input type="number" class="text-center p-0 w-75" name="metertc2" value="<?php echo $meterc2 ; ?>" min="0">
            </td>
            <?php } ?>
            <?php for ($j=1;$j<=3;$j++) { ?>
            <td>
              <label></label>
              <select name="wk_staff_id<?php echo $j+($i-1)*3; ?>" id="wk_staff_id<?php echo $j+($i-1)*3; ?>" class="w-75">
                <option value=""></option>
                <?php if ($staff2->oup_m_staff_id) { ?>
                <?php for ($k=0;$k<count($staff2->oup_m_staff_id);$k++) { ?>
                <option value="<?php echo $staff2->oup_m_staff_id[$k]; ?>"<?php echo $staff2->oup_m_staff_id[$k] == ${"wk_staff_id".($j+($i-1)*3)} ? "selected" : "" ; ?>>
                  <?php echo $kbnMark[$staff_kbn[$staff2->oup_m_staff_id[$k]]]; ?>
                  <?php echo $staff_name[$staff2->oup_m_staff_id[$k]]; ?>
                </option>
                <?php } ?>
                <?php } ?>
              </select>
            </td>
            <?php } ?>
          </tr>
          <?php } ?>

          <tr>
            <td colspan="2"></td>
            <td colspan="3">
              <textarea name="wk_comment" id="" class="w-100" cols="" rows="2" value="<?php echo $wk_comment; ?>"><?php echo $wk_comment; ?></textarea>
            </td>
          </tr>
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

  </div>
  <br>

  <div class="modal-footer"></div>
</body>

</html>

<script type="text/javascript">
  var width
  window.onload = function() {
    width = $(window).width()
    if (width < 770) {
      changeWidth('30px')
      changeWidth2('20px')
    } else {
      changeWidth('45px')
      changeWidth2('35px')
    }
  }
  function changeWidth(num) {
    $('.con .time [type="number"]').css('width',num)
  }
  function changeWidth2(num) {
    $('.time2 [type="number"]').css('width',num)
  }

  $(window).resize(function(){
    width = $(window).width()
    if (width < 770) {
      changeWidth('30px')
      changeWidth2('20px')
    } else {
      changeWidth('45px')
      changeWidth2('35px')
    }
  })

  $('hr').css('border-top','1px solid #000')

  // $('.table').css('table-layout','fixed')

  $('table td').addClass('p-0')

  $('[type="text"]').addClass('p-0')

  $('.time, .time2').addClass('d-inline-block border border-dark')
  $('.time [type="number"], .time2 [type="number"]').addClass('p-0 border-0')
  $('.time [type="number"], .num').css('width','45px')
  $('.num, .text').addClass('pl-1')
  $('.num, .text').css('border','1px solid #343a40')
  $('.text').addClass('w-50')

  // 入港、出港checkbox
  var checkList = {}
  var no
  // （初期表示）
  $('.check').each(function(){
    no = $(this).val()
    if ($(this).prop('checked')) {
      checkList['div'+no] = $(this).next().next().remove()
    } else {
      checkList['div'+no] = $(this).next().remove()
    }
  })
  // （クリックで切り替え）
  $('.check').click(function(){
    no = $(this).val()
    $(this).parent().append(checkList['div'+no])
    checkList['div'+no] = $(this).next().remove()
  })

  // 最終退出者checkbox（初期表示）
  $('.check2').each(function(){
    if ($(this).prop('checked')) {
      $(this).next().removeClass('d-inline-block')
      $(this).next().addClass('d-none')
    } else {
      $(this).next().next().addClass('d-none')
    }
  })
  // 最終退出者checkbox（切り替え）
  $('.check2').click(function(){
    if ($(this).prop('checked')) {
      $(this).next().removeClass('d-inline-block')
      $(this).next().addClass('d-none')

      $(this).next().next().removeClass('d-none')
    } else {
      $(this).next().addClass('d-inline-block')
      $(this).next().removeClass('d-none')

      $(this).next().next().addClass('d-none')
    }
  })

  $('.temp, .regist').click(function(){
    if (!confirm('この内容で登録します。よろしいですか？')) return false

    // 最終退出者POST送信する値判定
    $('.check2').each(function(){
      if ($(this).prop('checked')) {
        $(this).next().children('input[type="number"]').removeAttr('name')
      } else {
        $(this).next().next().removeAttr('name')
      }
    })

    if ($(this).hasClass('temp')) {
      $('[name="act"]').val('2')
    } else {
      $('[name="act"]').val('1')
    }
    
    $('form').submit()
  })
</script>