
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
.table2 tr,
.table2 th,
.table2 td {
  display: block;
  padding: 0;
}
.table2 tbody tr {
  display: flex;
}
.w-10{
  width: 10% !important;
}
.w-15{
  width: 15% !important;
}
.w-35{
  width: 35% !important;
}
.w-45{
  width: 45% !important;
}
.w-65{
  width: 65% !important;
}
.w-85{
  width: 85% !important;
}
</style>

<body>
  <div class="container-fluid">
    
    <br>
    <form action="report15.php" method="post">

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td class="font-weight-bold"><label><font size="5em">チェックシート</font></label></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless table-responsive">
          <?php for ($i=1;$i<=2;$i++) { ?>
          <tr>
            <td class="" style="min-width: 200px;">
              <?php if ($i == 1) { ?>
              <?php echo substr($start_date,0,4)."年".substr($start_date,5,2)."月".substr($start_date,8,2)."日　(".getWeek($start_date).")"; ?>
              <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
              <?php } ?>
            </td>

            <?php for ($j=1;$j<=10;$j++) { ?>
            <td style="min-width: 100px;"><?= $j + ($i - 1) * 10 ?>回目</td>
            <?php } ?>
          </tr>

          <tr>
            <td class="align-middle">巡回者氏名</td>
            <?php for ($j=1;$j<=10;$j++) { ?>
            <td>
              <?php for ($k=1;$k<=2;$k++) { ?>
              <select name="patrol_staff_id<?= $patrolStaff[$k].($j + ($i - 1) * 10) ?>" class="w-100">
                <option value=""></option>
                <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
                <?php for ($l=0;$l<count($wkdetail->oup_t_wk_detail_no);$l++) { ?>
                <option value="<?= $wkdetail->oup_t_wk_taiin_id[$l]; ?>"<?= $wkdetail->oup_t_wk_taiin_id[$l] == ${"patrol_staff_id".$patrolStaff[$k].($j + ($i - 1) * 10)} ? "selected" : "" ; ?>><?= $staff_name[$wkdetail->oup_t_wk_taiin_id[$l]]; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
              <?php } ?>
            </td>
            <?php } ?>
          </tr>

          <tr>
            <td>巡回時間</td>
            <?php for ($j=1;$j<=10;$j++) { ?>
            <td>
              <div class="input-group">
                <input type="number" class="form-control1" name="patrol_time<?= $j + ($i - 1) * 10 ?>[0]" value="<?= ${"patrol_time".($j + ($i - 1) * 10)}[0]; ?>" min="0" max="23">
                <div class="input-group-append"><div class="input-group-text">:</div></div>
                <input type="number" class="form-control2" name="patrol_time<?= $j + ($i - 1) * 10 ?>[1]" value="<?= ${"patrol_time".($j + ($i - 1) * 10)}[1]; ?>" min="0" max="59">
              </div>
            </td>
            <?php } ?>
          </tr>
          <?php } ?>

          <tr>
            <td colspan="11" style="height: 30px;"></td>
          </tr>

          <tr>
            <td>赤外線検知センサー発報の有無</td>
            <?php for ($i=1;$i<=10;$i++) { ?>
            <td class="align-bottom">
              <select name="sensor_select<?= $i ?>" id="sensor_select<?= $i ?>" class="w-100">
                <option value=""></option>
                <?php foreach ($select as $key => $val) { ?>
                <option value="<?= $key ?>"<?= $key == ${"sensor_select".$i} ? "selected" : "" ; ?>><?= $val ?></option>
                <?php } ?>
              </select>
            </td>
            <?php } ?>
          </tr>

          <tr>
            <td>監視カメラによる異常の有無</td>
            <?php for ($i=1;$i<=10;$i++) { ?>
            <td class="align-bottom">
              <select name="camera_select<?= $i ?>" id="camera_select<?= $i ?>" class="w-100">
                <option value=""></option>
                <?php foreach ($select as $key => $val) { ?>
                <option value="<?= $key ?>"<?= $key == ${"camera_select".$i} ? "selected" : "" ; ?>><?= $val ?></option>
                <?php } ?>
              </select>
            </td>
            <?php } ?>
          </tr>

          <tr>
            <td colspan="11">チェックポイント</td>
          </tr>

          <?php /*foreach ($checkCon1 as $key => $val) { ?>
          <tr>
            <td><?= $val ?></td>

            <td colspan="5" class="<?= $key!=1 ? "pl-5" : "" ?>">
              <label><?= $checkCon2[$key] ?></label>
            </td>

            <td colspan="5">
            <label><?= $checkCon3[$key] ?></label>
            </td>
          </tr>
          <?php }*/ ?>

          <tr>
            <td colspan="11">
              <table class="table table2 table-borderless d-flex">
                <thead class="w-50">
                  <tr>
                    <?php foreach ($checkCon1 as $key => $val) { ?>
                    <th class="py-2"><?= $val ?></th>
                    <?php } ?>
                  </tr>
                </thead>

                <tbody class="w-100">
                  <tr>
                    <td class="w-100">（赤外線検知センサー発報、監視カメラによるヤード内異状）</td>
                  </tr>

                  <tr>
                    <td class="w-100 py-2 pl-3">
                      <div class="row">
                        <div class="col-3"><label>発見者</label></div>
                        <div class="col-9">
                          <select name="dis_staff_id" id="dis_staff_id" class="">
                            <option value=""></option>
                            <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
                            <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
                            <option value="<?= $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?= $wkdetail->oup_t_wk_taiin_id[$i] == $dis_staff_id ? "selected" : "" ; ?>><?= $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td class="w-100 py-2 pl-3">
                      <div class="row">
                        <div class="col-3"><label>発見日時</label></div>
                        <div class="col-9">
                          <input type="date" class="" name="dis_date" value="<?= $dis_date ?>">
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td class="w-100 py-2 pl-3">
                      <div class="row">
                        <div class="col-3"><label>発見場所</label></div>
                        <div class="col-9"><input type="text" class="w-100" name="dis_place" value="<?= $dis_place ?>"></div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td class="w-100 py-2 pl-3">
                      <div class="row">
                        <div class="col-12"><label>発見内容</label></div>
                        <div class="col-12"><textarea class="w-100" cols="" rows="4" name="dis_contents" value="<?= $dis_contents ?>"><?= $dis_contents ?></textarea></div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td class="w-100 py-2 pl-3">
                      <div class="row">
                        <div class="col-12"><label>その他何かあれば記載してください</label></div>
                        <div class="col-12"><textarea class="w-100" cols="" rows="6" name="etc_contents" value="<?= $etc_contents ?>"><?= $etc_contents ?></textarea></div>
                      </div>
                    </td>
                  </tr>
                </tbody>

                <tbody class="w-100">
                  <tr>
                    <td class="w-100">埠頭設備点検表</td>
                  </tr>

                  <?php foreach ($checkCon3 as $key => $val) { ?>
                  <?php if ($key == 1) {continue;} ?>
                  <tr>
                    <td class="w-100 pl-3">
                      <div class="row">
                        <div class="col-12"><label><?= $checkCon3[$key] ?></label></div>
                        <div class="col-12"><textarea class="w-100" cols="" rows="3" name="wharf_contents<?= intval($key)-1 ?>" value="<?= ${"wharf_contents".(intval($key)-1)} ?>"><?= ${"wharf_contents".(intval($key)-1)} ?></textarea></div>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td class="w-100 pl-3">
                      <div class="row">
                        <div class="col-12"><label>コメント</label></div>
                        <div class="col-12"><textarea class="w-100" cols="" rows="3" name="comment" value="<?= $comment ?>"><?= $comment ?></textarea></div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>

        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <label>*原則は赤外線検知及び監視カメラによりチェックを行う。発報、異常、不審等あれば、安全を確認の上、現場でチェックを行う。</label>
      </div>

      <div class="col-12">
        <label>*発報、異常、不審な状況があった場合には内容を記入してください。</label>
      </div>

      <div class="col-12">
        <label>*緊急を要する場合には、連絡体制に従って、速やかに連絡を入れてください。</label>
      </div>
    </div>
    <hr>

    <!-- <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          
        </table>
      </div>
    </div>
    <hr> -->

    <input type="hidden" name="no" value="<?php echo $no; ?>">
    <input type="hidden" name="act" value="">
    </form>

    <!-- <div class="row">
      <div class="col-12 text-right">（株）新神戸セキュリティ</div>
    </div>
    <br> -->

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
  /*
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
  */

  $('hr').css('border-top','1px solid #000')

  $('table td').addClass('p-0')

  $('[type="text"]').addClass('p-0')

  // $('.time, .time2').addClass('d-inline-block border border-dark')
  // $('.time [type="number"], .time2 [type="number"]').addClass('p-0 border-0')
  // $('.time [type="number"], .num').css('width','45px')
  // $('.hour').css('width','55px')
  // $('.num, .text, .hour').addClass('pl-1')
  // $('.num, .text, .hour').css('border','1px solid #343a40')
  // $('.text').css('width','100px')

  // 時刻フォーム
  $('.form-control1, .form-control2').addClass('form-control p-0 text-center border-dark rounded-0')
  $('.form-control1, .form-control2, .input-group-append').css({
    'height': '25px'
  })
  $('.form-control1').addClass('border-right-0')
  $('.form-control2').addClass('border-left-0')
  $('.input-group-append').addClass('p-0 border-top border-bottom border-dark rounded-0')
  $('.input-group-text').addClass('p-0 bg-white border-0')

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
        no: $('[name="start_date"]').val().replace(/-/g,'')+'15'
      },
      dataType:"json"
    }).done(function(data){
      // console.log(data)
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