
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
            <td>警備場所</td>
            <td>契約先</td>
          </tr>

          <tr>
            <td>住友倉庫ポートアイランド　L-6</td>
            <td>株式会社住友倉庫　神戸支店</td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <form action="report3.php" method="post">

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td class="align-middle" rowspan="2" colspan="3">
              <?php echo substr($start_date,0,4)."年".substr($start_date,5,2)."月".substr($start_date,8,2)."日　(".getWeek($start_date).")"; ?>
              <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
            </td>
            <td>天候</td>
            <td>所長</td>
            <td>記録者</td>
          </tr>
          <tr>
            <td>
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
            <td><input type="text" class="" name="chief" value="<?php echo $chief; ?>"></td>
            <td>
              <select name="staff_id" id="staff_id" class="">
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
      <!-- 中央 -->
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td colspan="3">（１）守衛者</td>
          </tr>
          <tr>
            <td>配置</td>
            <td>氏名</td>
            <td>勤務時間</td>
          </tr>
          <?php for ($i=1;$i<=10;$i++) { ?>
          <tr>
            <td>
              <select name="wk_haiti<?php echo $i; ?>" id="wk_haiti<?php echo $i; ?>" class="">
                <option value=""></option>
                <?php for ($j=0;$j<count($haiti);$j++) { ?>
                <option value="<?php echo $haiti[$j]; ?>"<?php echo $haiti[$j] == ${"wk_haiti".$i} ? "selected" : "" ; ?>><?php echo $haiti[$j]; ?></option>
                <?php } ?>
              </select>
            </td>
            <td>
              <select name="wk_staff_id<?php echo $i; ?>" id="wk_staff_id<?php echo $i; ?>" class="">
                <option value=""></option>
                <?php if ($staff2->oup_m_staff_id) { ?>
                <?php for ($j=0;$j<count($staff2->oup_m_staff_id);$j++) { ?>
                <option value="<?php echo $staff2->oup_m_staff_id[$j]; ?>"<?php echo $staff2->oup_m_staff_id[$j] == ${"wk_staff_id".$i} ? "selected" : "" ; ?>><?php echo $staff_name[$staff2->oup_m_staff_id[$j]]; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </td>
            <td>
              <div class="time">
                <input type="number" class="text-center" name="wk_joban_time<?php echo $i; ?>[0]" value="<?php echo ${"wk_joban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="wk_joban_time<?php echo $i; ?>[1]" value="<?php echo ${"wk_joban_time".$i}[1]; ?>" min="0" max="59">
              </div>
              <label>～</label>
              <div class="time">
                <input type="number" class="text-center" name="wk_kaban_time<?php echo $i; ?>[0]" value="<?php echo ${"wk_kaban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="wk_kaban_time<?php echo $i; ?>[1]" value="<?php echo ${"wk_kaban_time".$i}[1]; ?>" min="0" max="59">
              </div>
            </td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <!-- 中央 -->
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td colspan="5">（１）日常記録</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td>時間</td>
            <td>氏名</td>
            <td>特記事項</td>
          </tr>

          <?php /* ?>
          <?php for ($i=0;$i<5;$i++) { ?>
          <?php for ($j=0;$j<$detail[$i];$j++) { ?>
          <tr>
            <?php if ($j == 0) { ?>
            <td class="align-middle" rowspan="<?php echo $detail[$i]; ?>"></td>
            <?php } ?>

            <td></td>
            <td>
              <div class="time">
                <input type="number" class="text-center" name="" value="" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="" value="" min="0" max="59">
              </div>
            </td>
            <td>
              <select name="staff_id" id="staff_id" class="">
                <option value=""></option>
                <?php if ($staff2->oup_m_staff_id) { ?>
                <?php for ($k=0;$k<count($staff2->oup_m_staff_id);$k++) { ?>
                <option value="<?php echo $staff2->oup_m_staff_id[$k]; ?>"<?php echo $staff2->oup_m_staff_id[$k] == $staff_id ? "selected" : "" ; ?>><?php echo $staff2->oup_m_staff_id[$k]; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </td>

            <?php if ($j == 0) { ?>
            <td rowspan="<?php echo $detail[$i]; ?>"><textarea name="" id="" rows="<?php echo $detail[$i]; ?>" class="w-100" value=""></textarea></td>
            <?php } ?>
          </tr>
          <?php } ?>
          <?php } ?>
          <?php */ ?>
          
          <?php $c = 0; ?>
          <?php for ($i=0;$i<count($title);$i++) { ?>
          <?php for ($j=0;$j<count($title[$i]["row"]);$j++) { ?>
          <?php $c = $c+1; ?>
          <tr>
            <?php if ($j == 0) { ?>
            <td class="align-middle" rowspan="<?php echo count($title[$i]["row"]); ?>"><label><?php echo $title[$i]["column"]; ?></label></td>
            <?php } ?>

            <?php if ($title[$i]["row"][$j]) { ?>
            <td><label><?php echo $title[$i]["row"][$j]; ?></label></td>
            <?php } else { ?>
            <td><input type="text" class="" name="wk_detail_title<?php echo $c; ?>" value="<?php echo ${"wk_detail_title".$c}; ?>"></td>
            <?php } ?>

            <td>
              <div class="time">
                <input type="number" class="text-center" name="wk_detail_time<?php echo $c ; ?>[0]" value="<?php echo ${"wk_detail_time".$c}[0] ; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="wk_detail_time<?php echo $c ; ?>[1]" value="<?php echo ${"wk_detail_time".$c}[1] ; ?>" min="0" max="59">
              </div>
            </td>
            <td>
              <select name="wk_detail_staff_id<?php echo $c ; ?>" id="wk_detail_staff_id<?php echo $c ; ?>" class="">
                <option value=""></option>
                <?php if ($staff2->oup_m_staff_id) { ?>
                <?php for ($k=0;$k<count($staff2->oup_m_staff_id);$k++) { ?>
                <option value="<?php echo $staff2->oup_m_staff_id[$k]; ?>"<?php echo $staff2->oup_m_staff_id[$k] == ${"wk_detail_staff_id".$c} ? "selected" : "" ; ?>><?php echo $staff_name[$staff2->oup_m_staff_id[$k]]; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </td>
            
            <?php if ($j == 0) { ?>
            <td rowspan="<?php echo count($title[$i]["row"]); ?>">
              <textarea name="wk_detail_comment<?php echo $c; ?>" id="" rows="<?php echo count($title[$i]["row"]); ?>" class="w-100" value="<?php echo ${"wk_detail_comment".$c} ; ?>"><?php echo ${"wk_detail_comment".$c} ; ?></textarea>
            </td>
            <?php } ?>
          </tr>
          <?php } ?>
          <?php } ?>

        </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <!-- 中央 -->
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td colspan="4"><label>（3）22時以降　夜間退出記録</label></td>
          </tr>

          <tr>
            <td><label>会社名</label></td>
            <td><label>氏名</label></td>
            <td><label>退出時間</label></td>
            <td><label>SKS対応者</label></td>
          </tr>

          <tr>
            <td><input type="text" class="" name="night_company" value="<?php echo $night_company; ?>"></td>
            <td>
              <select name="night_taiin_id" id="night_taiin_id" class="">
                <option value=""></option>
                <?php if ($staff2->oup_m_staff_id) { ?>
                <?php for ($j=0;$j<count($staff2->oup_m_staff_id);$j++) { ?>
                <option value="<?php echo $staff2->oup_m_staff_id[$j]; ?>"<?php echo $staff2->oup_m_staff_id[$j] == $night_taiin_id ? "selected" : "" ; ?>><?php echo $staff_name[$staff2->oup_m_staff_id[$j]]; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </td>
            <td>
              <div class="time">
                <input type="number" class="text-center" name="night_exit_time[0]" value="<?php echo $night_exit_time[0] ; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="night_exit_time[1]" value="<?php echo $night_exit_time[1] ; ?>" min="0" max="59">
              </div>
            </td>
            <td>
              <select name="night_staff_id" id="night_staff_id" class="">
                <option value=""></option>
                <?php if ($staff2->oup_m_staff_id) { ?>
                <?php for ($j=0;$j<count($staff2->oup_m_staff_id);$j++) { ?>
                <option value="<?php echo $staff2->oup_m_staff_id[$j]; ?>"<?php echo $staff2->oup_m_staff_id[$j] == $night_staff_id ? "selected" : "" ; ?>><?php echo $staff_name[$staff2->oup_m_staff_id[$j]]; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
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

  $('[type="number"]').addClass('p-0')

  $('.input-group-text').css('background-color','white')

  $('.input-group-text').addClass('border-0')

  $('.w-15').css('width','15%')

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