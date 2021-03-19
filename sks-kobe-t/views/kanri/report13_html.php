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
            <td><label>（警備場所）</label></td>
            <td><label>（契約先）</label></td>
          </tr>

          <tr>
            <td><label>日本郵船神戸バンプール</label></td>
            <td><label>日本郵船株式会社　殿</label></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <form action="report13.php" method="post">
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
          <td><label>（１）構内作業</label></td>
          <td><label>日本港運</label></td>
          <td>
            <div class="time">
              <input type="number" class="text-center" name="wk_start_time[0]" value="<?php echo $wk_start_time[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="wk_start_time[1]" value="<?php echo $wk_start_time[1]; ?>" min="0" max="59">
            </div>
            <label for="">～</label>
            <div class="time">
              <input type="number" class="text-center" name="wk_end_time[0]" value="<?php echo $wk_end_time[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="wk_end_time[1]" value="<?php echo $wk_end_time[1]; ?>" min="0" max="59">
            </div>
          </td>
        </tr>

        <tr>
          <td colspan="3"><label>（２）搬出入車（者）の安全誘導、火災、盗難の防止、不法侵入者の排除、その他事故防止に留意</label></td>
        </tr>

        <tr>
          <td colspan="2"><label>（３）正門立哨</label></td>
          <td>
            <div class="time">
              <input type="number" class="text-center" name="picket_start_time[0]" value="<?php echo $picket_start_time[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="picket_start_time[1]" value="<?php echo $picket_start_time[1]; ?>" min="0" max="59">
            </div>
            <label for="">～</label>
            <div class="time">
              <input type="number" class="text-center" name="picket_end_time[0]" value="<?php echo $picket_end_time[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="picket_end_time[1]" value="<?php echo $picket_end_time[1]; ?>" min="0" max="59">
            </div>
          </td>
        </tr>

        <tr>
          <td><label>（４）特記事項</label></td>
          <td colspan="2">
            <textarea name="comment" id="" class="w-100" cols="" rows="3" value="<?php echo $comment; ?>"><?php echo $comment; ?></textarea>
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
          <td rowspan="5" class="align-middle">巡<br>回</td>
          <td>
            <label>１</label>
            <div class="time">
              <input type="number" class="text-center" name="patrol_time1[0]" value="<?php echo $patrol_time1[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="patrol_time1[1]" value="<?php echo $patrol_time1[1]; ?>" min="0" max="59">
            </div>
          </td>
          <td rowspan="5" class="align-middle">勤<br>務<br>員</td>
          <td>
            <label>Ａ</label>
            <select name="wk_staff_id1" id="wk_staff_id1" class="w-50">
              <option value=""></option>
              <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
              <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
              <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id1 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </td>
          <td rowspan="5">
            <label>（備考）</label>
            <textarea name="etc_comment" id="" class="w-100" cols="" rows="5" value="<?php echo $etc_comment; ?>"><?php echo $etc_comment; ?></textarea>
          </td>
        </tr>

        <tr>
          <td>
            <label>２</label>
            <div class="time">
              <input type="number" class="text-center" name="patrol_time2[0]" value="<?php echo $patrol_time2[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="patrol_time2[1]" value="<?php echo $patrol_time2[1]; ?>" min="0" max="59">
            </div>
          </td>
          <td>
            <label>Ｂ</label>
            <select name="wk_staff_id2" id="wk_staff_id2" class="w-50">
              <option value=""></option>
              <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
              <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
              <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id2 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </td>
        </tr>

        <tr>
          <td>
            <label>３</label>
            <div class="time">
              <input type="number" class="text-center" name="patrol_time3[0]" value="<?php echo $patrol_time3[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="patrol_time3[1]" value="<?php echo $patrol_time3[1]; ?>" min="0" max="59">
            </div>
          </td>
          <td>
            <label>Ｃ</label>
            <select name="wk_staff_id3" id="wk_staff_id3" class="w-50">
              <option value=""></option>
              <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
              <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
              <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id3 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </td>
        </tr>

        <tr>
          <td>
            <label>４</label>
            <div class="time">
              <input type="number" class="text-center" name="patrol_time4[0]" value="<?php echo $patrol_time4[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="patrol_time4[1]" value="<?php echo $patrol_time4[1]; ?>" min="0" max="59">
            </div>
          </td>
          <td>
            <label>Ｄ</label>
            <select name="wk_staff_id4" id="wk_staff_id4" class="w-50">
              <option value=""></option>
              <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
              <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
              <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id4 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </td>
        </tr>

        <tr>
          <td></td>
          <td></td>
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
  $('hr').css('border-top','1px solid #000')

  $('table td').addClass('p-0')

  $('.time').addClass('d-inline-block border border-dark')
  $('.time [type="number"]').addClass('p-0 border-0')
  $('.time [type="number"]').css('width','45px')

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