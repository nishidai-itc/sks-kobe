<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen, projection" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>　
    <title>かんたんヘルパーさん</title>
  </head>
  <body>
    <div class="container">
      <div class="page-header">
        <h4>利用者様選択</h4>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12">
<?php 
    for($i=0;$i<count($user->oup_m_user_id);$i++) {
        $disp = "0";
        if (($kana == "ア") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ア") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ァ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｱ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｧ"))) {
            $disp = "1";
        }
        if (($kana == "イ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="イ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ィ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｲ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｨ"))) {
            $disp = "1";
        }
        if (($kana == "ウ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ウ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ゥ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｳ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｩ"))) {
            $disp = "1";
        }
        if (($kana == "エ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="エ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ェ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｴ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｪ"))) {
            $disp = "1";
        }
        if (($kana == "オ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="オ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ォ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｵ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｫ"))) {
            $disp = "1";
        }
        if (($kana == "カ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="カ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ガ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｶ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｶﾞ"))) {
            $disp = "1";
        }
        if (($kana == "キ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="キ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ギ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｷ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｷﾞ"))) {
            $disp = "1";
        }
        if (($kana == "ク") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ク") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="グ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｸ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｸﾞ"))) {
            $disp = "1";
        }
        if (($kana == "ケ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ケ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ゲ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｹ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｹﾞ"))) {
            $disp = "1";
        }
        if (($kana == "コ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="コ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ゴ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｺ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｺﾞ"))) {
            $disp = "1";
        }
        if (($kana == "サ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="サ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ザ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｻ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｻﾞ"))) {
            $disp = "1";
        }
        if (($kana == "シ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="シ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ジ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｼ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｼﾞ"))) {
            $disp = "1";
        }
        if (($kana == "ス") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ス") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ズ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｽ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｽﾞ"))) {
            $disp = "1";
        }
        if (($kana == "セ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="セ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ゼ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｾ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｾﾞ"))) {
            $disp = "1";
        }
        if (($kana == "ソ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ソ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ゾ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｿ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｿﾞ"))) {
            $disp = "1";
        }
        if (($kana == "タ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="タ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ダ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾀ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾀﾞ"))) {
            $disp = "1";
        }
        if (($kana == "チ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="チ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ヂ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾁ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾁﾞ"))) {
            $disp = "1";
        }
        if (($kana == "ツ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ツ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ヅ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾂ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾂﾞ"))) {
            $disp = "1";
        }
        if (($kana == "テ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="テ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="デ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾃ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾃﾞ"))) {
            $disp = "1";
        }
        if (($kana == "ト") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ト") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ド") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾄ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾄﾞ"))) {
            $disp = "1";
        }
        if (($kana == "ナ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ナ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾅ"))) {
            $disp = "1";
        }
        if (($kana == "ニ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ニ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾆ"))) {
            $disp = "1";
        }
        if (($kana == "ヌ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ヌ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾇ"))) {
            $disp = "1";
        }
        if (($kana == "ネ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ネ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾈ"))) {
            $disp = "1";
        }
        if (($kana == "ノ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ノ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾉ"))) {
            $disp = "1";
        }
        if (($kana == "ハ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ハ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="バ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾊ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾊﾞ"))) {
            $disp = "1";
        }
        if (($kana == "ヒ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ヒ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ビ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾋ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾋﾞ"))) {
            $disp = "1";
        }
        if (($kana == "フ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="フ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ブ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾌ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾌﾞ"))) {
            $disp = "1";
        }
        if (($kana == "ヘ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="へ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ベ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾍ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾍﾞ"))) {
            $disp = "1";
        }
        if (($kana == "ホ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ホ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ボ") ||
             (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾎ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾎﾞ"))) {
            $disp = "1";
        }
        if (($kana == "マ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="マ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾏ"))) {
            $disp = "1";
        }
        if (($kana == "ミ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ミ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾐ"))) {
            $disp = "1";
        }
        if (($kana == "ム") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ム") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾑ"))) {
            $disp = "1";
        }
        if (($kana == "メ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="メ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾒ"))) {
            $disp = "1";
        }
        if (($kana == "モ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="モ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾓ"))) {
            $disp = "1";
        }
        if (($kana == "ヤ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ヤ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾔ"))) {
            $disp = "1";
        }
        if (($kana == "ユ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ユ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾕ"))) {
            $disp = "1";
        }
        if (($kana == "ヨ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ヨ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾖ"))) {
            $disp = "1";
        }
        if (($kana == "ラ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ラ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾗ"))) {
            $disp = "1";
        }
        if (($kana == "リ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="リ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾘ"))) {
            $disp = "1";
        }
        if (($kana == "ル") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ル") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾙ"))) {
            $disp = "1";
        }
        if (($kana == "レ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="レ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾚ"))) {
            $disp = "1";
        }
        if (($kana == "ロ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ロ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾛ"))) {
            $disp = "1";
        }
        if (($kana == "ワ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ワ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾜ"))) {
            $disp = "1";
        }
        if (($kana == "ヲ") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ヲ") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ｦ"))) {
            $disp = "1";
        }
        if (($kana == "ン") && 
            ((mb_substr($user->oup_m_user_kana[$i],0,1)=="ン") || (mb_substr($user->oup_m_user_kana[$i],0,1)=="ﾝ"))) {
            $disp = "1";
        }
?>
<?php if ($disp=="1") { ?>
          <button class="btn btn-success btn-lg btn-block" onclick="location.href='make_plan.php?m_user_id=<?php print($user->oup_m_user_id[$i]); ?>&m_user_name=<?php print($user->oup_m_user_name[$i]); ?>'"><?php print($common->html_display($user->oup_m_user_name[$i])); ?> 様 <?php if ($user->oup_m_user_birth_date[$i] != "") { ?>(<?php print((int) ((date('Ymd')-(substr($user->oup_m_user_birth_date[$i],0,4).substr($user->oup_m_user_birth_date[$i],5,2).substr($user->oup_m_user_birth_date[$i],8,2)))/10000)); ?>)<?php } ?></button>
<?php } ?>
<?php 
    }
?>
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <button class="btn btn-default btn-block" onclick="location.href='select_kana.php'">戻る</button>
        </div>
      </div>
      <br />

    </div>
  </body>
</html>
