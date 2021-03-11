<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" media="screen, projection" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>
  </head>

<script type="text/javascript">
/*
function func() {
    document.frm.submit();
}
function func2(arg1) {
    document.frm.act.value='2';
    document.frm.work_day.value=arg1;
    document.frm.submit();
}
*/
</script>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>隊員登録</h4>
      </div>

      <form name="frm" method="POST" action="staff2.php">
      <?php if ($staff2->errmsg != "") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger"><?php print($staff2->errmsg); ?></p></pre></div>
            </div>
        <?php } ?>

        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">隊員ID</td>
                <td width="85"><input type="text" name="staff_id" value="<?php print($staff->oup_m_staff_id[0]); ?>" <?php echo $staff_id || $staff_id2 ? "readonly style=\"background-color: #e9ecef;\"" : "" ; ?>></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">隊員名</td>
                <td><input type="text" name="staff_name" value="<?php print($staff->oup_m_staff_name[0]); ?>"></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">隊員名カナ</td>
                <td><input type="text" name="staff_kana" value="<?php print($staff->oup_m_staff_kana[0]); ?>"></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">配置照会名</td>
                <td><input type="text" name="haiti_name" value="<?php print($staff->oup_m_staff_haiti_name[0]); ?>"></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">ログインID</td>
                <td><input type="text" name="staff_login_id" value="<?php print($staff->oup_m_staff_login_id[0]); ?>"></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">パスワード</td>
                <td><input type="text" name="staff_pass" value=""></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">権限</td>
                <td align="left">
<?php for ($i=1;$i<=count($staff->auth);$i++) { ?>
                  <input type="radio" name="staff_auth" value="<?php print($i); ?>" <?php if ($staff->oup_m_staff_auth[0] == $i) { print("checked=\"checked\""); } ?> > <?php print($staff->auth[$i]); ?> <br />
<?php } ?>
                </td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">雇用形態</td>
                <td align="left">
<?php for ($i=1;$i<=count($staff->koyo);$i++) { ?>
                  <input type="radio" name="staff_koyo" value="<?php print($i); ?>" <?php if ($staff->oup_m_staff_kbn[0] == $i) { print("checked=\"checked\""); } ?> > <?php print($staff->koyo[$i]); ?> <br />
<?php } ?>
                </td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">現場</td>
                <td align="left">
                        <select id="genba_id" name="genba_id" class="form-control">
                          <option value=""></option>
<?php for ($i=0;$i<count($genba->oup_m_genba_id);$i++) { ?>
                          <option value="<?php print($genba->oup_m_genba_id[$i]); ?>" <?php if ($staff->oup_m_staff_genba_id[0]===$genba->oup_m_genba_id[$i]) { print("selected"); } ?> ><?php print($genba->oup_m_genba_name[$i]); ?></option>
<?php } ?>
                        </select>
                </td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">入社日</td>
                <td width="85">
                    <input type="date" maxlength="8" name="nyusya" value="<?php print($staff->oup_m_staff_nyusya[0]); ?>">
                </td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">退職日</td>
                <td width="85">
                    <input type="date" maxlength="8" name="taisya" value="<?php print($staff->oup_m_staff_taisya[0]); ?>">
                </td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">協力会社</td>
                <td align="left">
                    <select id="company_id" name="company_id" class="form-control">
                        <option value=""></option>
                        <?php for ($i=0;$i<count($company->oup_m_company_id);$i++) { ?>
                        <option value="<?php print($company->oup_m_company_id[$i]); ?>" 
                        <?php if ($staff->oup_m_staff_company[0]==$company->oup_m_company_id[$i]) {
                            print("selected");
                        } ?> ><?php print($company->oup_m_company_name[$i]); ?></option>
                        <?php } ?>
                    </select>
                </td>
                <!--<td width="85"><input type="text" name="company" value="<?php print($staff->oup_m_staff_company[0]); ?>"></td>-->
              </tr>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <!-- <button type="button" onclick="submit();" class="btn btn-success btn-block" role="button">登録</button> -->
            <button type="button" class="btn btn-success btn-block regist" role="button">登録</button>
          </div>
          <div class="col-6">
            <a href="staff1.php#<?php print($staff_id); ?>" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />

        <input type="hidden" name="act" value="1">
        <input type="hidden" name="staff_id2" value="<?php print($staff->oup_m_staff_id[0]); ?>">

      </form>

    </div>

      <div class="modal-footer">
          <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
      </div><!-- /footer -->

  </body>
</html>

<script type="text/javascript">
$('.regist').click(function(){
  var id = $("input[name='staff_id2']").val()
  var data = {
    staff_id: $("input[name='staff_id']").val(),
    staff_name: $("input[name='staff_name']").val(),
    staff_kana: $("input[name='staff_kana']").val(),
    haiti_name: $("input[name='haiti_name']").val(),
    staff_login_id: $("input[name='staff_login_id']").val(),
    staff_pass: $("input[name='staff_pass']").val(),
    staff_auth: $("input[name='staff_auth']:checked").val(),
    staff_koyo: $("input[name='staff_koyo']:checked").val(),
    genba_id: $('#genba_id').val(),
    nyusya: $("input[name='nyusya']").val(),
    taisya: $("input[name='taisya']").val(),
    company_id: $('#company_id').val(),
  }
  // console.log(data)
  // for (list of Object.keys(data)) {
  //   console.log(data[list])
  // }
  var flg = true
  // バリデーションチェック
  $.each(data,function(key,value){
    if (key != 'staff_login_id' && key != 'staff_pass' && key != 'nyusya' && key != 'taisya' && key != 'company_id' && key != 'staff_auth') {
      if (!value) {
        if (key == 'staff_koyo') {
          alert('チェックボックスをいれて下さい。')
          $("input[name='"+key+"']").focus()
          flg = false
          return false
        } else {
          alert('空欄では登録できません。')
          if (key == 'genba_id') {
            $('#'+key).focus()
          } else {
            $("input[name='"+key+"']").focus()
          }
          flg = false
          return false
        }
      }
    }
  })

  if (!flg) {
    return
  }
  
  // 新規登録
  if (!id) {
    $.ajax({
      type: 'post',
      url: './staff2.php',
      data: {
        act: '3',
        staff_id: data.staff_id,
        staff_login_id: data.staff_login_id,
        staff_id2: $("input[name='staff_id2']").val(),
      },
      dataType: 'json',
      statusCode: {}
    }).done(function(data){
      console.log(data)
      if (data[0]) {
        if (data[1] == '1') {
          alert('既に同じ隊員IDの隊員が登録されています。')
        } else {
          alert('既に同じ隊員IDもしくはログインIDの隊員が登録されています。')
        }
      } else {
        $('form').submit()
      }
    }).fail(function(data){
      alert('通信エラー')
    })
  // 更新
  } else {
    $.ajax({
      type: 'post',
      url: './staff2.php',
      data: {
        id: id,
        act: '4',
        staff_id: data.staff_id,
        staff_login_id: data.staff_login_id,
      },
      dataType: 'json',
      statusCode: {}
    }).done(function(data){
      console.log(data)
      if (data) {
        alert('既に同じログインIDの隊員が登録されています。')
      } else {
        $('form').submit()
      }
    }).fail(function(data){
      alert('通信エラー')
    })
  }

  // if (!flg) {
  //   return
  // }
  // $('form').submit()
})
</script>