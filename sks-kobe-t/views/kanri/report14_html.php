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

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td colspan="2" class="text-center"><label><font size="6em">警備報告書</font></label></td>
          </tr>

          <tr>
            <td class="w-50"><label>契約先<br>日本郵船株式会社　殿</label></td>
            <td rowspan="2">
              <label>株式会社新神戸セキュリティ<br>〒658-0027　神戸市東灘区青木１丁目２－１<br>TEL（078）436-7255　FAX（078）436-7275</label>
            </td>
          </tr>

          <tr>
            <td colspan="2"><label>警備場所：RC-6・7、内航バース間</label></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <form action="report14.php" method="post">
    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td><label>警備実施日</label></td>
            <td colspan="2">
              <label><?php echo substr($start_date,0,4)."年".substr($start_date,5,2)."月".substr($start_date,8,2)."日　(".getWeek($start_date).")"; ?></label>
              <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
            </td>
            <td colspan="2">
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
          </tr>

          <tr>
            <td colspan="5">&nbsp;</td>
          </tr>

          <tr>
            <td><label>警備員氏名</label></td>
            <td>上番</td>
            <td>下番</td>
            <td>早出・残業</td>
            <td></td>
          </tr>

          <?php for ($i=1;$i<=4;$i++) { ?>
          <tr>
            <td>
              <select name="wk_staff_id<?php echo $i; ?>" id="wk_staff_id<?php echo $i; ?>" class="w-50">
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
            </td>
            <td>
              <div class="time">
                <input type="number" class="text-center" name="wk_kaban_time<?php echo $i; ?>[0]" value="<?php echo ${"wk_kaban_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="wk_kaban_time<?php echo $i; ?>[1]" value="<?php echo ${"wk_kaban_time".$i}[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td>
              <input type="number" class="text-center num" name="wk_zan<?php echo $i; ?>" value="<?php echo ${"wk_zan".$i}; ?>" min="0">
              <label>H</label>
            </td>
            <td></td>
          </tr>
          <?php } ?>

          <tr>
            <td colspan="5">&nbsp;</td>
          </tr>
          
          <tr>
            <td><label>立哨時間</label></td>
            <td colspan="2">
              <div class="time">
                <input type="number" class="text-center" name="picket_joban_time[0]" value="<?php echo $picket_joban_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="picket_joban_time[1]" value="<?php echo $picket_joban_time[1]; ?>" min="0" max="59">
              </div>
              <label>～</label>
              <div class="time">
                <input type="number" class="text-center" name="picket_kaban_time[0]" value="<?php echo $picket_kaban_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="picket_kaban_time[1]" value="<?php echo $picket_kaban_time[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td colspan="2"></td>
          </tr>

          <tr>
            <td class="align-middle"><label>特記事項</label></td>
            <td colspan="4">
              <textarea name="comment" id="" class="w-100" cols="" rows="5" value="<?php echo $comment; ?>"><?php echo $comment; ?></textarea>
            </td>
          </tr>

          <tr>
            <td colspan="5"><label>警備重点事項</label></td>
          </tr>

          <tr>
            <td colspan="5"><label>１．無関係者のヤード内立ち入りの防止警戒</label></td>
          </tr>

          <tr>
            <td colspan="5"><label>２．船員の安全誘導</label></td>
          </tr>

          <tr>
            <td colspan="5"><label>３．その他、事故防止に留意</label></td>
          </tr>

          <tr>
            <td colspan="5" class="text-right"><label>以上のとおり警備結果を報告致します。</label></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <input type="hidden" name="no" value="<?php echo $no; ?>">
    <input type="hidden" name="act" value="">
    </form>

    <?php /* ?>
    <div class="row">
    <table class="table table-bordered" id="">
    <thead class="thead-light">

    <colgroup>
                  <col>
                  <col>
                  <col>
                  <col width="">
                  <col width="">
    </colgroup>


                  <tr>
                    <th>警備員氏名</th>
                    <th>上番</th>
                    <th>下番</th> 
                    <th>早出・残業</th>
                    <!-- <th></th> -->
                  </tr>
    </thead>
    <tbody>
                  <tr>
                    <td><input type="text" name="" class="" value="難波"></td>
                    <td><input type="time" name="" class="" value=""></td>
                    <td><input type="time" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <!-- <td></td> -->
                  </tr>
                  <tr>
                    <td><input type="text" name="" class="" value=""></td>
                    <td><input type="time" name="" class="" value=""></td>
                    <td><input type="time" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <!-- <td></td> -->
                  </tr>

                  <tr>
                    <td><input type="text" name="" class="" value=""></td>
                    <td><input type="time" name="" class="" value=""></td>
                    <td><input type="time" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <!-- <td></td> -->
                  </tr>

                  <tr>
                    <td><input type="text" name="" class="" value=""></td>
                    <td><input type="time" name="" class="" value=""></td>
                    <td><input type="time" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <!-- <td></td> -->
                  </tr>

                </tbody>
              </table>




    </div>
    <hr>
    <div class="row">
     <div class="col-12">立哨時間　<input type="time" class="" value="08:00">　～　<input type="time" class="" value="16:40"></div>
    </div>
    <hr>
    
    <div class="row">
      <div class="col-1 m-auto">特記事項</div>
      <div class="col-11">
        <textarea name="" id="" rows="5" class="form-control"></textarea>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">警備重点事項</div>
      <div class="col-12">1.無関係者のヤード内立ち入りの防止警戒</div>
      <div class="col-12">2.船員の安全誘導</div>
      <div class="col-12">3.その他、事故防止に留意</div>
      <div class="col-12">　　　　　　　　　　　　　　　　　　　　　　　　以上のとおり警備結果を報告致します。</div>

    </div>
    <hr>

    <div class="row">
      <div class="col-1 m-auto">備<br>考</div>
      <div class="col-11">
        <textarea name="" id="" rows="5" class="form-control"></textarea>
      </div>
    </div>
    <hr>
    <?php */ ?>

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
        <button type="button" class="btn btn-secondary btn-block" role="button" onclick="location.href='report_menu.php'">戻る</button>
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
  $('.time [type="number"], .num').css('width','45px')

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