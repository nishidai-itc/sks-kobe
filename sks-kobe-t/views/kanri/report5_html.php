
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
    <?php /* ?>
    <div class="row">
      <div class="col-6">
        <div>♦警備場所</div>
      </div>
      <div class="col-6">
        <div>♦契約先</div>
      </div>
      <div class="col-6">
        <div style="font-size: 2em;">RIC-4・C-5</div>
      </div>
      <div class="col-6">
        <div style="font-size: 2em;">三菱倉庫株式会社　殿</div>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-lg-7">
        <div class="row">
          <div class="col-md-12">♦勤務時間</div>

          <div class="col-1"><?php echo "自）"; ?></div>
          <!-- <input type="date" class="form-control w-auto" value="<?php echo $date; ?>" readonly> -->
          <div class="col-7"><?php echo $dates[0]."年".$dates[1]."月".$dates[2]."日　(".$week[$w].")"; ?></div>
          <div class="col-4 input-group">
            <input type="number" class="form-control text-center border-right-0" value="<?php echo $joban_time[0]; ?>" min="0" max="23">
            <span class="border-top border-bottom pt-1">:</span>
            <input type="number" class="form-control text-center border-left-0" value="<?php echo $joban_time[1]; ?>" min="0" max="59">
          </div>

          <div class="col-1 mt-1"><?php echo "至）"; ?></div>
          <!-- <input type="date" class="form-control w-auto" value="<?php echo $date; ?>" readonly> -->
          <div class="col-7"><?php echo $dates2[0]."年".$dates2[1]."月".$dates2[2]."日　(".$week[$w2].")"; ?></div>
          <div class="col-4 input-group mt-1">
            <input type="number" class="form-control text-center border-right-0" value="<?php echo $kaban_time[0]; ?>" min="0" max="23">
            <span class="border-top border-bottom pt-1">:</span>
            <input type="number" class="form-control text-center border-left-0" value="<?php echo $kaban_time[1]; ?>" min="0" max="59">
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-7">
        <div class="row">
          <div class="col-12">天候</div>

          <div class="col-12 d-flex">
            <select name="" id="" class="form-control w-auto">
              <option value=""></option>
              <?php for ($i=1;$i<count($weathers)+1;$i++) { ?>
              <option value="<?php echo $i; ?>"<?php echo $i == $weather ? "selected" : "" ; ?>><?php echo $weathers[$i]; ?></option>
              <?php } ?>
            </select>
            　
            <select name="" id="" class="form-control w-auto">
              <option value=""></option>
              <?php for ($i=1;$i<count($weathers)+1;$i++) { ?>
              <option value="<?php echo $i; ?>"<?php echo $i == $weather ? "selected" : "" ; ?>><?php echo $weathers[$i]; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-5">
        <div class="row">
          <div class="col-12">担当警備士</div>
          
          <div class="col-12">
            <select name="" id="" class="form-control w-auto">
              <option value=""></option>
              <?php if ($staff2->oup_m_staff_id) { ?>
              <?php for ($i=0;$i<count($staff2->oup_m_staff_id);$i++) { ?>
              <option value="<?php echo $staff2->oup_m_staff_id[$i]; ?>"<?php echo $staff2->oup_m_staff_id[$i] == $staff_id ? "selected" : "" ; ?>><?php echo $staff2->oup_m_staff_name[$i]; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
    </div>
    <hr>

    <div class="row">
      <!-- 左側 -->
      <div class="col-md-8">
        <div class="row">
          <div class="col-12">１．状況</div>

          <div class="col-1"></div>
          <div class="col-11">i．入出港</div>

          <?php for ($i=0;$i<4;$i++) { ?>
          <div class="col-1"></div>
          <div class="col-4 d-flex">
            <div>RC-</div>
            <input type="text" class="form-control">
          </div>
          <div class="col-7 d-flex">
            <!-- <div class="form-check">
              <input class="form-check-input" type="checkbox" id="check1a" checked>
              <label class="form-check-label" for="check1a">Check A</label>
            </div> -->
            <div class="input-group">
              <input type="number" class="form-control text-center border-right-0" value="" min="0" max="23">
              <span class="border-top border-bottom pt-1">:</span>
              <input type="number" class="form-control text-center border-left-0" value="" min="0" max="59">
              <div class="input-group-prepend">
                <div class="input-group-text">～</div>
              </div>
              <input type="number" class="form-control text-center border-right-0" value="" min="0" max="23">
              <span class="border-top border-bottom pt-1">:</span>
              <input type="number" class="form-control text-center border-left-0" value="" min="0" max="59">
            </div>
          </div>
          <?php } ?>

          <div class="col-12">&nbsp;</div>

          <div class="col-1"></div>
          <div class="col-11">ii．C-4ゲート立哨</div>

          <?php for ($i=0;$i<4;$i++) { ?>
          <div class="col-1"></div>
          <div class="col-<?php if ($i == 3) {echo "11";} else {echo "4";} ?>"><?php if ($i == 1) {echo "東サブゲート立哨";} elseif ($i == 2) {echo "iii．搬入出車両";} elseif ($i == 3) {echo "iv．各ゲート及び管理棟、CFS事務所の開錠及び施錠実施";} else {echo "";} ?></div>
          <?php if ($i != 3) { ?>
          <div class="col-7 d-flex">
            <div class="input-group">
              <input type="number" class="form-control text-center border-right-0" value="" min="0" max="23">
              <span class="border-top border-bottom pt-1">:</span>
              <input type="number" class="form-control text-center border-left-0" value="" min="0" max="59">
              <div class="input-group-prepend">
                <div class="input-group-text">～</div>
              </div>
              <input type="number" class="form-control text-center border-right-0" value="" min="0" max="23">
              <span class="border-top border-bottom pt-1">:</span>
              <input type="number" class="form-control text-center border-left-0" value="" min="0" max="59">
            </div>
          </div>
          <?php } ?>
          <?php if ($i == 2) { ?><div class="col-12">&nbsp;</div><?php } ?>
          <?php } ?>

          <div class="col-12">２．重点</div>

          <div class="col-1"></div>
          <div class="col-11">i．管理棟及び各建屋の火災、盗難等の警戒警備並びに<br>不法侵入者の警戒監視</div>

          <div class="col-1"></div>
          <div class="col-11">ii．搬入出車両及び外来者の適正誘導</div>

          <div class="col-12">３．実施</div>

          <div class="col-1"></div>
          <div class="col-11">i．昼夜間巡回、警戒警備及び外周赤外線システムの監視</div>

          <div class="col-1"></div>
          <div class="col-11">ii．管理棟及び各建屋の鍵の保管管理</div>

          <div class="col-12">発砲</div>

          <div class="col-12">
            <textarea name="" id="" rows="5" class="form-control" value=""></textarea>
          </div>
        </div>
      </div>
      <!-- 右側 -->
      <div class="col-md-4">
        <div class="row">
          <div class="col-12"></div>

          <div class="col-12">ヤード照明</div>

          <?php for ($i=0;$i<6;$i++) { ?>
          <div class="col-12"><?php if ($i == 4) {echo "トンボ照明";} elseif ($i == 5) {echo "C5倉庫屋外照明　西・南";} else {echo "C-".($i+2);} ?></div>
          
          <?php for ($j=0;$j<2;$j++) { ?>
          <div class="col-12 d-flex">
            <div class="input-group">
              <input type="number" class="form-control text-center border-right-0" value="" min="0" max="23">
              <span class="border-top border-bottom pt-1">:</span>
              <input type="number" class="form-control text-center border-left-0" value="" min="0" max="59">
              <div class="input-group-prepend">
                <div class="input-group-text">～</div>
              </div>
              <input type="number" class="form-control text-center border-right-0" value="" min="0" max="23">
              <span class="border-top border-bottom pt-1">:</span>
              <input type="number" class="form-control text-center border-left-0" value="" min="0" max="59">
            </div>
          </div>
          <?php } ?>
          <?php } ?>
        </div>
      </div>
    </div>
    <hr>
    <!-- <div class="row">
    <div class=""></div>
    </div> -->

    <div class="row">
      <div class="col-1 align-self-center">巡<br>回</div>
      <div class="col-11">
        <div class="row">
          <?php for ($i=0;$i<16;$i++) { ?>
          <div class="col-md-4 col-lg-3 d-flex">
            <div class="w-15 text-center"><?php echo $i; ?></div>
            <div class="input-group">
              <input type="number" class="form-control text-center border-right-0" value="" min="0" max="23">
              <span class="border-top border-bottom pt-1">:</span>
              <input type="number" class="form-control text-center border-left-0" value="" min="0" max="59">
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <hr>

    <div class="row">
      <!-- 左側 -->
      <div class="col-md-6">
        <div class="row">
          <div class="col-1 align-self-center">備<br>考</div>
          <div class="col-11">
            <div class="row">
              <div class="col-12">
                <textarea name="" id="" rows="" class="form-control" value="">巡回　点検　警備その他服務中異常ありません</textarea>
              </div>

              <div class="col-lg-7 input-group mt-1">
                <div class="input-group-prepend">
                  <div class="input-group-text">管理棟終了</div>
                </div>
                <!-- <input type="text" class="form-control"> -->
                <input type="number" class="form-control text-center border-right-0" value="" min="0" max="23">
                <span class="border-top border-bottom pt-1">:</span>
                <input type="number" class="form-control text-center border-left-0" value="" min="0" max="59">
              </div>
              <div class="col-lg-5 input-group mt-1">
                <div class="input-group-prepend">
                  <div class="input-group-text">部外者</div>
                </div>
                <input type="number" class="form-control text-center">
                <div class="input-group-append">
                  <div class="input-group-text">名</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 右側 -->
      <div class="col-md-6">
        <div class="row">
          <?php for ($i=0;$i<count($abc);$i++) { ?>
          <!-- <div class="col-md-6 col-lg-4 input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><?php echo $abc[$i]; ?></div>
            </div>
            <input type="number" class="form-control text-center border-right-0" value="" min="0" max="23">
            <span class="border-top border-bottom pt-1">:</span>
            <input type="number" class="form-control text-center border-left-0" value="" min="0" max="59">
          </div> -->
          <div class="col-md-6 col-lg-4 d-flex">
            <div class="w-15 text-center"><?php echo $abc[$i]; ?></div>
            <div class="input-group">
              <input type="number" class="form-control text-center border-right-0" value="" min="0" max="23">
              <span class="border-top border-bottom pt-1">:</span>
              <input type="number" class="form-control text-center border-left-0" value="" min="0" max="59">
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <hr>
    <?php */ ?>

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
              <?php echo "自）".$dates[0]."年".$dates[1]."月".$dates[2]."日　(".$week[$w].")"; ?>
              <input type="number" class="text-center" value="<?php echo $joban_time[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" value="<?php echo $joban_time[1]; ?>" min="0" max="59">
            </td>
          </tr>
          <tr>
            <td>
              <?php echo "至）".$dates2[0]."年".$dates2[1]."月".$dates2[2]."日　(".$week[$w2].")"; ?>
              <input type="number" class="text-center" value="<?php echo $kaban_time[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" value="<?php echo $kaban_time[1]; ?>" min="0" max="59">
            </td>
            <td rowspan="2">
              <select name="" id="" class="">
                <option value=""></option>
                <?php for ($i=1;$i<count($weathers)+1;$i++) { ?>
                <option value="<?php echo $i; ?>"<?php echo $i == $weather ? "selected" : "" ; ?>><?php echo $weathers[$i]; ?></option>
                <?php } ?>
              </select>
              <select name="" id="" class="">
                <option value=""></option>
                <?php for ($i=1;$i<count($weathers)+1;$i++) { ?>
                <option value="<?php echo $i; ?>"<?php echo $i == $weather ? "selected" : "" ; ?>><?php echo $weathers[$i]; ?></option>
                <?php } ?>
              </select>
            </td>
            <td rowspan="2">
              <select name="" id="" class="">
                <option value=""></option>
                <?php if ($staff2->oup_m_staff_id) { ?>
                <?php for ($i=0;$i<count($staff2->oup_m_staff_id);$i++) { ?>
                <option value="<?php echo $staff2->oup_m_staff_id[$i]; ?>"<?php echo $staff2->oup_m_staff_id[$i] == $staff_id ? "selected" : "" ; ?>><?php echo $staff2->oup_m_staff_name[$i]; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
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
          <?php for ($i=0;$i<count($table_content);$i++) { ?>
          <tr>
            <?php for ($j=0;$j<$table_content[$i]["td_cnt"];$j++) { ?>
            <td colspan="<?php echo $table_content[$i]["td_array"][$j]["td_colspan"]; ?>" <?php if ($i == 18 && $j == 0) {echo "rowspan=\"5\"";} ?>>
            <?php echo $table_content[$i]["td_array"][$j]["td_con"] ; ?>
            </td>
            <?php } ?>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <hr>
    <?php */ ?>

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <?php for ($i=0;$i<count($table_con["tr"]);$i++) { ?>
          <tr>
            <?php for ($j=0;$j<count($table_con["tr"][$i]["td"]);$j++) { ?>
            <td class="<?php echo $table_con["tr"][$i]["td"][$j]["class"]; ?>" colspan="<?php echo $table_con["tr"][$i]["td"][$j]["colspan"]; ?>" <?php if ($i == 18 && $j == 0) {echo "rowspan=\"5\"";} ?>>
              <?php //echo $table_con["tr"][$i]["td"][$j]["content"] ; ?>
              <?php if ($table_con["tr"][$i]["td"][$j]["content"]) { ?>
              <?php for ($k=0;$k<count($table_con["tr"][$i]["td"][$j]["content"]);$k++) { ?>
                <?php if ($table_con["tr"][$i]["td"][$j]["content"][$k][0] == "input_text") { ?>
                  <input type="text" class="w-100" value="">
                <?php } elseif ($table_con["tr"][$i]["td"][$j]["content"][$k][0] == "input_time") { ?>
                  <input type="number" class="text-center" value="<?php echo $table_con["tr"][$i]["td"][$j]["content"][$k][1]; ?>" min="0" max="23">
                  <span class="">:</span>
                  <input type="number" class="text-center" value="<?php echo $table_con["tr"][$i]["td"][$j]["content"][$k][2]; ?>" min="0" max="59">
                  <span class="">～</span>
                  <input type="number" class="text-center" value="<?php echo $table_con["tr"][$i]["td"][$j]["content"][$k][3]; ?>" min="0" max="23">
                  <span class="">:</span>
                  <input type="number" class="text-center" value="<?php echo $table_con["tr"][$i]["td"][$j]["content"][$k][4]; ?>" min="0" max="59">
                <?php } elseif ($table_con["tr"][$i]["td"][$j]["content"][$k][0] == "input_check_time") { ?>
                  <span><input type="checkbox" class="check"></span>
                  <div class="d-inline-block">
                    <input type="number" class="text-center" value="<?php echo $table_con["tr"][$i]["td"][$j]["content"][$k][1]; ?>" min="0" max="23">
                    <span class="">:</span>
                    <input type="number" class="text-center" value="<?php echo $table_con["tr"][$i]["td"][$j]["content"][$k][2]; ?>" min="0" max="59">
                  </div>
                  <span class="">～</span>
                  <div class="d-inline-block">
                    <span><input type="checkbox" class="check"></span>
                    <input type="number" class="text-center" value="<?php echo $table_con["tr"][$i]["td"][$j]["content"][$k][3]; ?>" min="0" max="23">
                    <span class="">:</span>
                    <input type="number" class="text-center" value="<?php echo $table_con["tr"][$i]["td"][$j]["content"][$k][4]; ?>" min="0" max="59">
                  </div>
                <?php } elseif ($table_con["tr"][$i]["td"][$j]["content"][$k][0] == "textarea") { ?>
                  <textarea name="" id="" rows="5" class="w-100" value=""></textarea>
                <?php } else  { ?>
                  <?php echo $table_con["tr"][$i]["td"][$j]["content"][$k][0] ; ?>
                <?php } ?>
              <?php } ?>
              <?php } ?>
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
            <?php for ($j=0;$j<6;$j++) { ?>
            <?php if ($i == 0 && $j == 0) { ?>
            <td class="align-middle" rowspan="3">巡<br>回</td>
            <?php } ?>
            <td><?php echo $i == 0 ? $j+1 : $i*6+($j+1) ; ?></td>
            <td class="">
              <input type="number" class="text-center number-left" value="<?php echo $i == 0 ? $zyunkai_default[$j][0] : $zyunkai_default[$i*6+($j)][0] ; ?>" min="0" max="23">
              <span class="number-colon">:</span>
              <input type="number" class="text-center number-right" value="<?php echo $i == 0 ? $zyunkai_default[$j][1] : $zyunkai_default[$i*6+($j)][1] ; ?>" min="0" max="59">
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
            <?php for ($j=0;$j<3;$j++) { ?>
            <?php if ($i == 0 && $j == 0) { ?>
            <td class="align-middle" rowspan="3">備<br>考</td>
            <td rowspan="2" colspan="4">
              <textarea name="" id="" rows="" class="w-100" value="">巡回　点検　警備その他服務中異常ありません</textarea>
            </td>
            <?php } ?>
            <?php if ($i == 2 && $j == 0) { ?>
            <td>管理棟終了</td>
            <td>
              <!-- <input type="number" class="text-center number-left" value="" min="0" max="23">
              <span class="number-colon">:</span>
              <input type="number" class="text-center number-right" value="" min="0" max="59"> -->
              <input type="text" class="" value="泊り">
            </td>
            <td>部外者</td>
            <td>
              <input type="number" class="text-center number-left" value="" min="0" max="99">
              <span>名</span>
            </td>
            <?php } ?>
            <td><?php echo $i == 0 ? $abc[$j] : $abc[$i*3+$j] ; ?></td>
            <td>
              <select name="" id="" class="">
                <option value=""></option>
                <?php if ($staff2->oup_m_staff_id) { ?>
                <?php for ($k=0;$k<count($staff2->oup_m_staff_id);$k++) { ?>
                <option value="<?php echo $staff2->oup_m_staff_id[$k]; ?>"<?php echo $staff2->oup_m_staff_id[$k] == $staff_id ? "selected" : "" ; ?>><?php echo $staff2->oup_m_staff_name[$k]; ?></option>
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

    <div class="row">
      <div class="col-12 text-right">（株）新神戸セキュリティ</div>
    </div>
    <br>

    <div class="row">
      <div class="col-4">
        <button type="button" class="btn btn-warning btn-block regist" role="button">一時保存</button>
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

  $('[type="number"]').addClass('p-0')

  // $('.input-group-text').css('background-color','white')

  // $('.input-group-text').addClass('border-0')

  // $('.w-15').css('width','15%')

  $('table td').addClass('p-0')

  $('[type="number"]').css('width','40px')

  // $('.check').change(function(){
  //   if ($(this).prop('checked')) {
  //     // $(this).parent().parent().children('div').eq(0).remove()

  //     // $(this).parent().children('div').children().eq(1).addClass('d-none')
  //     // $(this).parent().children('div').children().eq(2).addClass('d-none')
  //     // $(this).parent().children('div').children().eq(3).addClass('d-none')
  //     // $(this).parent().children('div').children().eq(0).removeClass('d-none')
  //   } else {
  //     // $(this).parent().children('div').children().eq(0).addClass('d-none')
  //     // $(this).parent().children('div').children().eq(1).removeClass('d-none')
  //     // $(this).parent().children('div').children().eq(2).removeClass('d-none')
  //     // $(this).parent().children('div').children().eq(3).removeClass('d-none')
  //   }
  // })
</script>