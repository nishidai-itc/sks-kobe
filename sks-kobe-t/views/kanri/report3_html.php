
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
    <!-- <div class="row">
      <div class="col-12">
        <div>警備場所</div>
      </div>
      <div class="col-12">
        <div>日本郵船神戸コンテナターミナル</div>
      </div>
    </div>
    <hr> -->

    <?php /* ?>
    <div class="row">
      <!-- <input type="date" class="form-control w-auto" value="<?php echo $date; ?>" readonly> -->
      <div class="col-sm-3 align-self-center"><?php echo $dates[1]."月".$dates[2]."日　(".$week[$w].")"; ?></div>
      <div class="col-sm-4">
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
      <div class="col-sm-5">
        <div class="row">
          <div class="col-6">所長</div>
          <div class="col-6">記録者</div>

          <div class="col-6">
            <input type="text" class="form-control" value="">
          </div>
          <div class="col-6">
            <select name="" id="" class="form-control">
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
      <!-- 中央 -->
      <div class="col-12">（１）守衛者</div>

      <div class="col-3">配置</div>
      <div class="col-3">氏名</div>
      <div class="col-6">勤務時間</div>

      <?php for ($i=0;$i<10;$i++) { ?>
      <div class="col-3">
        <input type="text" class="form-control" value="">
      </div>
      <div class="col-3">
        <select name="" id="" class="form-control">
          <option value=""></option>
          <?php if ($staff2->oup_m_staff_id) { ?>
          <?php for ($j=0;$j<count($staff2->oup_m_staff_id);$j++) { ?>
          <option value="<?php echo $staff2->oup_m_staff_id[$j]; ?>"<?php echo $staff2->oup_m_staff_id[$j] == $staff_id ? "selected" : "" ; ?>><?php echo $staff2->oup_m_staff_name[$j]; ?></option>
          <?php } ?>
          <?php } ?>
        </select>
      </div>
      <div class="col-6 input-group">
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
      <?php } ?>
    </div>
    <hr>

    <div class="row">
      <!-- 中央 -->
      <div class="col-12">（１）日常記録</div>

      <div class="col-3"></div>
      <div class="col-3">時間</div>
      <div class="col-3">氏名</div>
      <div class="col-3">特記事項</div>

      <div class="col-1 align-self-center">開<br>錠</div>
      <div class="col-2">
        <div class="row">
          <div class="col-12">外周</div>

          <div class="col-12">200倉庫</div>

          <div class="col-12">300倉庫</div>
        </div>
      </div>
      <div class="col-6">
        <div class="row">
          <?php for ($i=0;$i<3;$i++) { ?>
          <div class="col-6 input-group">
            <input type="number" class="form-control text-center border-right-0" value="" min="0" max="23">
            <span class="border-top border-bottom pt-1">:</span>
            <input type="number" class="form-control text-center border-left-0" value="" min="0" max="59">
          </div>
          <div class="col-6">
            <select name="" id="" class="form-control">
              <option value=""></option>
              <?php if ($staff2->oup_m_staff_id) { ?>
              <?php for ($j=0;$j<count($staff2->oup_m_staff_id);$j++) { ?>
              <option value="<?php echo $staff2->oup_m_staff_id[$j]; ?>"<?php echo $staff2->oup_m_staff_id[$j] == $staff_id ? "selected" : "" ; ?>><?php echo $staff2->oup_m_staff_name[$j]; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="col-3">
        <textarea name="" id="" rows="" class="form-control" value=""></textarea>
      </div>
    </div>
    <hr>
    <?php */ ?>

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

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td class="align-middle" rowspan="2" colspan="3"><?php echo $dates[1]."月".$dates[2]."日　(".$week[$w].")"; ?></td>
            <td>天候</td>
            <td>所長</td>
            <td>記録者</td>
          </tr>
          <tr>
            <td>
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
            <td><input type="text" class="" value=""></td>
            <td>
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
          <?php for ($i=0;$i<10;$i++) { ?>
          <tr>
            <td><input type="text" class="" value=""></td>
            <td>
              <select name="" id="" class="">
                <option value=""></option>
                <?php if ($staff2->oup_m_staff_id) { ?>
                <?php for ($j=0;$j<count($staff2->oup_m_staff_id);$j++) { ?>
                <option value="<?php echo $staff2->oup_m_staff_id[$j]; ?>"<?php echo $staff2->oup_m_staff_id[$j] == $staff_id ? "selected" : "" ; ?>><?php echo $staff2->oup_m_staff_name[$j]; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </td>
            <td>
              <input type="number" class="text-center" value="" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" value="" min="0" max="59">
              <span class="">～</span>
              <input type="number" class="text-center" value="" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" value="" min="0" max="59">
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
          <?php for ($i=0;$i<count($con1);$i++) { ?>
          <?php for ($j=0;$j<$con1[$i]["row"];$j++) { ?>
            <tr>
            <?php if ($j == 0) { ?>
            <td class="align-middle" rowspan="<?php echo $con1[$i]["row"]; ?>"><?php echo $con1[$i]["title"]; ?></td>
            <?php } ?>
            <td><?php echo $con1[$i]["rowTitle"][$j]; ?></td>
            <td>
              <input type="number" class="text-center" value="<?php if ($i == 0 || $i == 3 || $i == 4) {echo funcstr($con1[$i]["defaultTime"][$j]);} ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" value="<?php if ($i == 0 || $i == 3 || $i == 4) {echo funcstr2($con1[$i]["defaultTime"][$j]);} ?>" min="0" max="59">
            </td>
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
            <?php if ($j == 0) { ?>
            <td rowspan="<?php echo $con1[$i]["row"]; ?>">
              <textarea name="" id="" rows="<?php echo $con1[$i]["row"]; ?>" class="" value=""></textarea>
              <!-- <input type="text"> -->
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
          <?php for ($i=0;$i<3;$i++) { ?>
          <tr>
            <td <?php echo $i == 0 ? "colspan=\"4\"" : "" ; ?>>
              <?php if ($i == 0) {echo "(3)22時以降　夜間退出記録";} elseif ($i == 1) {echo "会社名";} else {echo "<input type=\"text\" class=\"\" value=\"\">";} ?>
            </td>
            <?php if ($i != 0) { ?>
            <td>
              <?php if ($i == 1) {echo "氏名";} else { ?>
              <select name="" id="" class="">
                <option value=""></option>
                <?php if ($staff2->oup_m_staff_id) { ?>
                <?php for ($j=0;$j<count($staff2->oup_m_staff_id);$j++) { ?>
                <option value="<?php echo $staff2->oup_m_staff_id[$j]; ?>"<?php echo $staff2->oup_m_staff_id[$j] == $staff_id ? "selected" : "" ; ?>><?php echo $staff2->oup_m_staff_name[$j]; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
              <?php } ?>
            </td>
            <td>
              <?php if ($i == 1) {echo "退出時間";} else { ?>
              <input type="number" class="text-center" value="" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" value="" min="0" max="59">
              <?php } ?>
            </td>
            <td>
              <?php if ($i == 1) {echo "SKS対応者";} else { ?>
              <select name="" id="" class="">
                <option value=""></option>
                <?php if ($staff2->oup_m_staff_id) { ?>
                <?php for ($j=0;$j<count($staff2->oup_m_staff_id);$j++) { ?>
                <option value="<?php echo $staff2->oup_m_staff_id[$j]; ?>"<?php echo $staff2->oup_m_staff_id[$j] == $staff_id ? "selected" : "" ; ?>><?php echo $staff2->oup_m_staff_name[$j]; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
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

  $('.input-group-text').css('background-color','white')

  $('.input-group-text').addClass('border-0')

  $('.w-15').css('width','15%')

  // $('.align-self-center').css('writing-mode','vertical-rl')

  $('table td').addClass('p-0')
</script>