
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
    
    <br>
    <div class="row">
      <div class="col-6">
        <div>♦勤務場所</div>
        <div style="font-size: 2em;">PI・C-15.16.17　KICT</div>
      </div>
      <div class="col-6">
        <div>♦契約先</div>
        <div style="font-size: 2em;">商船港運株式会社　殿</div>
      </div>
    </div>
    <hr>

    <div class="row">
      <!-- <table class="table table-borderless">
        <tr>
          <td colspan="4">♦勤務時間</td>
          <td colspan="2">天候</td>
          <td>担当警備士</td>
        </tr>
        <tr>
          <td>自）</td>
          <td><input type="date" class="form-control" value="<?php echo $date; ?>" readonly></td>
          <td><?php echo "(".$week[$w].")"; ?></td>
          <td class="input-group">
            <input type="number" class="form-control text-center border-right-0" min="0" max="23">
            <span class="border-top border-bottom pt-1">:</span>
            <input type="number" class="form-control text-center border-left-0" min="0" max="59">
          </td>
          <td>
            <select name="" id="" class="form-control">
              <option value=""></option>
              <?php for ($i=1;$i<=2;$i++) { ?>
              <option value="<?php echo $i; ?>"<?php echo $i == $weather ? "selected" : "" ; ?>><?php echo $i == "1" ? "晴" : "曇" ; ?></option>
              <?php } ?>
            </select>
          </td>
          <td>
            <select name="" id="" class="form-control">
              <option value=""></option>
              <?php for ($i=1;$i<=2;$i++) { ?>
              <option value="<?php echo $i; ?>"<?php echo $i == $weather ? "selected" : "" ; ?>><?php echo $i == "1" ? "晴" : "曇" ; ?></option>
              <?php } ?>
            </select>
          </td>
          <td>
            <select name="" id="" class="form-control">
              <option value=""></option>
              <?php if ($staff2->oup_m_staff_id) { ?>
              <?php for ($i=0;$i<count($staff2->oup_m_staff_id);$i++) { ?>
              <option value="<?php echo $staff2->oup_m_staff_id[$i]; ?>"<?php echo $staff2->oup_m_staff_id[$i] == $staff_id ? "selected" : "" ; ?>><?php echo $staff2->oup_m_staff_name[$i]; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </td>
        </tr>
      </table> -->

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
          <div class="col-7 mt-1"><?php echo $dates2[0]."年".$dates2[1]."月".$dates2[2]."日　(".$week[$w2].")"; ?></div>
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
      <!-- <div class="col-1 m-auto">状<br>況</div>
      <div class="col-11">
        <div class="row">
          <div class="col-6">１．入出港船舶</div>
          <div class="col-3">入港</div>
          <div class="col-3">出港</div>

          <?php for ($i=1;$i<=5;$i++) { ?>
          <div class="col-6">
            <input type="text" class="form-control w-auto">
          </div>
          <div class="col-3 input-group">
            <input type="number" class="form-control text-center p-0 w-auto border-right-0" min="0" max="23">
            <span class="border-top border-bottom pt-1">:</span>
            <input type="number" class="form-control text-center p-0 w-auto border-left-0" min="0" max="59">
          </div>
          <div class="col-3 input-group">
            <input type="number" class="form-control text-center p-0 w-auto border-right-0" min="0" max="23">
            <span class="border-top border-bottom pt-1">:</span>
            <input type="number" class="form-control text-center p-0 w-auto border-left-0" min="0" max="59">
          </div>
          <?php } ?>
        </div>
      </div> -->

      <div class="col-12">
        <table class="table m-0">
          <tr class="">
            <td class="border-top-0 align-middle" rowspan="10">状<br>況</td>
            <td class="border-top-0" colspan="2">１．入出港船舶</td>
            <td class="border-top-0">入港</td>
            <td class="border-top-0">出港</td>
          </tr>
          <?php for ($i=1;$i<=7;$i++) { ?>
          <tr>
            <td colspan="2">
              <div class="w-100">
                <input type="text" class="form-control">
              </div>
            </td>
            <td>
              <div class="input-group">
                <input type="checkbox" class="mr-1 mt-2">
                <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                <span class="border-top border-bottom pt-1">:</span>
                <input type="number" class="form-control text-center border-left-0" min="0" max="59">
              </div>
            </td>
            <td>
              <div class="input-group">
                <input type="checkbox" class="mr-1 mt-2">
                <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                <span class="border-top border-bottom pt-1">:</span>
                <input type="number" class="form-control text-center border-left-0" min="0" max="59">
              </div>
            </td>
          </tr>
          <?php } ?>
          <tr>
            <!-- <td>
              <div class="row">
                <div class="col-lg-3">２．搬入出</div>
                <div class="col-lg-4 d-flex">
                  <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                </div>
                <div class="col-lg-4 d-flex">
                  <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                </div>
              </div>
            </td>
            <td colspan="2">
              <div class="row">
                <div class="col-lg-4">４．VP終了</div>
                <div class="col-lg-8 d-flex">
                  <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                </div>
              </div>
            </td> -->

            <!-- <td>２．搬入出</td>
            <td>
              <div class="d-flex">
                <div class="input-group mr-1">
                  <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                </div>
                <div class="input-group">
                  <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                </div>
              </div>
            </td>
            <td>４．VP終了</td>
            <td>
              <div class="input-group">
                <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                <span class="border-top border-bottom pt-1">:</span>
                <input type="number" class="form-control text-center border-left-0" min="0" max="59">
              </div>
            </td> -->

            <td colspan="2">
              <div class="row">
                <div class="col-md-12 col-lg-4">２．搬入出</div>
                <div class="col-md-6 col-lg-4 input-group">
                  <input type="number" class="form-control text-center border-right-0" value="08" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" value="30" min="0" max="59">
                </div>
                <div class="col-md-6 col-lg-4 input-group">
                  <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                </div>
              </div>
            </td>
            <td colspan="2">
              <div class="row">
                <div class="col-md-12 col-lg-4">４．VP終了</div>
                <div class="col-md-6 input-group">
                  <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <!-- <td class="border-top-0">
              <div class="row">
                <div class="col-lg-3">３．構内作業</div>
                <div class="col-lg-4 d-flex">
                  <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                </div>
                <div class="col-lg-4 d-flex">
                  <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                </div>
              </div>
            </td>
            <td class="border-top-0" colspan="2">
              <div class="row">
                <div class="col-lg-4">５．VP作業終了</div>
                <div class="col-lg-8 d-flex">
                  <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                </div>
              </div>
            </td> -->

            <!-- <td class="border-top-0">３．構内作業</td>
            <td class="border-top-0">
              <div class="d-flex">
                <div class="input-group mr-1">
                  <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                </div>
                <div class="input-group">
                  <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                </div>
              </div>
            </td>
            <td class="border-top-0">５．VP作業終了</td>
            <td class="border-top-0">
              <div class="input-group">
                <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                <span class="border-top border-bottom pt-1">:</span>
                <input type="number" class="form-control text-center border-left-0" min="0" max="59">
              </div>
            </td> -->

            <td class="border-top-0" colspan="2">
              <div class="row">
                <div class="col-md-12 col-lg-4">３．構内作業</div>
                <div class="col-md-6 col-lg-4 input-group">
                  <input type="number" class="form-control text-center border-right-0" value="08" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" value="30" min="0" max="59">
                </div>
                <div class="col-md-6 col-lg-4 input-group">
                  <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                </div>
              </div>
            </td>
            <td class="border-top-0" colspan="2">
              <div class="row">
                <div class="col-md-12 col-lg-4">５．VP作業終了</div>
                <div class="col-md-6 input-group">
                  <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                  <span class="border-top border-bottom pt-1">:</span>
                  <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                </div>
              </div>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <!-- <div class="col-1 align-self-center">重<br>点</div>
      <div class="col-11">
        <div class="row">
          <div class="col-12">１．車両及び外来者等の入出管理</div>

          <div class="col-12">２．管理棟及び、その他の火災盗難等の警戒設備、並びに不法侵入者の警戒監視</div>
        </div>
      </div> -->

      <div class="col-12">
        <table class="table table-borderless m-0">
          <tr>
            <td class="align-middle">重<br>点</td>
            <td>１．車両及び外来者等の入出管理<br>２．管理棟及び、その他の火災盗難等の警戒設備、並びに不法侵入者の警戒監視</td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless m-0">
          <tr>
            <td class="align-middle">実<br>施</td>
            <td>１．各ポスト立哨、車両等の誘導<br>２．管理棟及び、その他の火災盗難等の警戒設備、並びに不法侵入者の警戒監視<br>３．照明灯点消灯、水道メーター検針<br>４．船舶入出港時の立ち会い</td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-1 align-self-center">特<br>記</div>
      <div class="col-11 pl-0">
        <div class="row">
          <div class="col-12">
            <table class="table table-borderless">
              <tr>
                <td class="pl-0">１．甲陽運輸</td>
                <td>
                  <div class="d-flex">
                    <div class="input-group mr-1">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                  </div>
                </td>
                <td class="align-middle" rowspan="3">ヤード<br>照明</td>
                <td class="text-center">点灯</td>
                <td class="text-center">消灯</td>
              </tr>
              <tr>
                <td class="pl-0">２．住井運輸</td>
                <td>
                  <div class="d-flex">
                    <div class="input-group mr-1">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                  </div>
                </td>
                <td>
                  <div class="input-group">
                    <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                    <span class="border-top border-bottom pt-1">:</span>
                    <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                  </div>
                </td>
                <td>
                  <div class="input-group">
                    <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                    <span class="border-top border-bottom pt-1">:</span>
                    <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                  </div>
                </td>
              </tr>
              <tr>
                <td class="pl-0">３．最終退出者</td>
                <td>
                  <div class="d-flex">
                    <div class="input-group mr-1">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                  </div>
                </td>
                <td>
                  <div class="input-group">
                    <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                    <span class="border-top border-bottom pt-1">:</span>
                    <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                  </div>
                </td>
                <td>
                  <div class="input-group">
                    <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                    <span class="border-top border-bottom pt-1">:</span>
                    <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                  </div>
                </td>
              </tr>
            </table>
          </div>

          <div class="col-12">【残業】</div>

          <div class="col-12">
            <table class="table">
            <?php for ($i=0;$i<8;$i++) { ?>
              <tr>
                <td><?php echo $tokki[$i][0]; ?></td>
                <td><?php if ($i == 0 || $i == 1) {echo "早朝";} ?></td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" value="<?php echo $tokki[$i][1]; ?>" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" value="<?php echo $tokki[$i][2]; ?>" min="0" max="59">
                    </div>
                    <div class="pt-1">～</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" value="<?php echo $tokki[$i][3]; ?>" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" value="<?php echo $tokki[$i][4]; ?>" min="0" max="59">
                    </div>
                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center" value="<?php echo $tokki[$i][5]; ?>" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">名</div>
                      </div>
                    </div>
                    <div class="pt-1">x</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center" value="<?php echo $tokki[$i][6]; ?>" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">H</div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>

              <?php /* ?>
              <tr>
                <td>・共同デポ</td>
                <td>早朝</td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                    <div class="pt-1">～</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">名</div>
                      </div>
                    </div>
                    <div class="pt-1">x</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">H</div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>・PC15.16.17　並び</td>
                <td>早朝</td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                    <div class="pt-1">～</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">名</div>
                      </div>
                    </div>
                    <div class="pt-1">x</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">H</div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>・PC15.16.17　CY</td>
                <td></td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                    <div class="pt-1">～</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">名</div>
                      </div>
                    </div>
                    <div class="pt-1">x</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">H</div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>・専用道白出口</td>
                <td></td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                    <div class="pt-1">～</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">名</div>
                      </div>
                    </div>
                    <div class="pt-1">x</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">H</div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>・VP作業</td>
                <td></td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                    <div class="pt-1">～</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">名</div>
                      </div>
                    </div>
                    <div class="pt-1">x</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">H</div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>・昼作業</td>
                <td></td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                    <div class="pt-1">～</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">名</div>
                      </div>
                    </div>
                    <div class="pt-1">x</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">H</div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>・ゲート延長</td>
                <td></td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                    <div class="pt-1">～</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">名</div>
                      </div>
                    </div>
                    <div class="pt-1">x</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">H</div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>・Mバース</td>
                <td></td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                    <div class="pt-1">～</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center border-right-0" min="0" max="23">
                      <span class="border-top border-bottom pt-1">:</span>
                      <input type="number" class="form-control text-center border-left-0" min="0" max="59">
                    </div>
                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">名</div>
                      </div>
                    </div>
                    <div class="pt-1">x</div>
                    <div class="input-group">
                      <input type="number" class="form-control text-center" min="0" max="99">
                      <div class="input-group-append">
                        <div class="input-group-text border-0">H</div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <?php */ ?>

            <?php } ?>

              <tr>
                <td colspan="5" rowspan="2">
                  <div class="d-flex">
                    <div>・</div>
                    <!-- <input type="text" class="form-control"> -->
                    <textarea name="" id="" class="form-control" cols="" rows="2">巡回点検異常ありません</textarea>
                  </div>
                </td>
                <!-- <td  colspan="4"></td> -->
              </tr>
              <tr>
                <td></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-1 align-self-center">巡<br>回</div>
      <div class="col-11">
        <div class="row">
        <?php for ($i=0;$i<8;$i++) { ?>
          <div class="col-md-4 col-lg-2 input-group">
            <div class="input-group-prepend">
              <span class="input-group-text border-0"><?php echo $num[$i][0]; ?></span>
            </div>
            <input type="number" class="form-control text-center border-right-0" value="<?php echo $num[$i][1]; ?>" min="0" max="23">
            <span class="border-top border-bottom pt-1">:</span>
            <input type="number" class="form-control text-center border-left-0" value="<?php echo $num[$i][2]; ?>" min="0" max="59">
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-5 align-self-center">
        <div class="row">
          <div class="col-1 align-self-center">備<br>考</div>
          <div class="col-11">
            <div class="row">
              <div class="col-6">B</div>
              <div class="col-6">C</div>

              <div class="col-6">水道メーター</div>
              <div class="col-6">水道メーター</div>

              <div class="col-6">
                <input type="number" class="form-control text-center">
              </div>
              <div class="col-6">
                <input type="number" class="form-control text-center">
              </div>

              <div class="col-6 pt-1">
                <input type="number" class="form-control text-center">
              </div>
              <div class="col-6 pt-1">
                <input type="number" class="form-control text-center">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-7">
        <div class="row">
          <div class="col-1 align-self-center">勤<br>務<br>員</div>
          <div class="col-11">
            <div class="row">
            <?php for ($i=0;$i<5;$i++) { ?>
            <?php for ($j=0;$j<3;$j++) { ?>
              <!-- <div class="col-4 input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"></span>
                </div>
                <select name="" id="" class="form-control">
                  <option value=""></option>
                  <?php if ($staff2->oup_m_staff_id) { ?>
                  <?php for ($k=0;$k<count($staff2->oup_m_staff_id);$k++) { ?>
                  <option value="<?php echo $staff2->oup_m_staff_id[$k]; ?>"<?php echo $staff2->oup_m_staff_id[$k] == $staff_id ? "selected" : "" ; ?>><?php echo $staff2->oup_m_staff_name[$k]; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div> -->
              <div class="col-1 p-0">
                <select name="" id="" class="form-control">
                  <option value=""></option>
                  <?php for ($k=0;$k<count($kinmu);$k++) { ?>
                  <option value="<?php echo $k; ?>"><?php echo $kinmu[$k]; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-3 p-0">
                <select name="" id="" class="form-control">
                  <option value=""></option>
                  <?php if ($staff2->oup_m_staff_id) { ?>
                  <?php for ($k=0;$k<count($staff2->oup_m_staff_id);$k++) { ?>
                  <option value="<?php echo $staff2->oup_m_staff_id[$k]; ?>"<?php echo $staff2->oup_m_staff_id[$k] == $staff_id ? "selected" : "" ; ?>><?php echo $staff2->oup_m_staff_name[$k]; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
            <?php } ?>
            <?php } ?>
            <div class="col-12">
              <textarea name="" id="" class="form-control" cols="" rows=""></textarea>
            </div>
            </div>
          </div>
        </div>
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

  </div>
  <br>

  <div class="modal-footer"></div>
</body>

</html>

<script type="text/javascript">
  $('hr').css('border-top','1px solid #000')

  $('table tr td').addClass('border-dark')

  $('[type="number"]').addClass('p-0')

  $('.input-group-text').css('background-color','white')
</script>