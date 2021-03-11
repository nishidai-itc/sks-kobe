
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">


  <!-- bootstrap-4.3.1 -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

  <title>警備報告書</title>
</head>

<style>
/* .table-bordered td{
  border: 1px solid #000;
} */
.col-1,
.col-2,
.col-3,
.col-4,
.col-5,
.col-6,
.col-7,
.col-8,
.col-9,
.col-10,
.col-11,
.col-12,{
  border: 1px solid #000 !important;
}
.w-20{
  width: 20%;
}
.w-5{
  width: 5%;
}
.w-3{
  width: 3%;
}
</style>

<body>
  <div class="container">

    <br>
    <div class="row">
      <div class="col-6">
        <div>♦勤務場所</div>
        <div style="font-size: 2em;">KFC</div>
      </div>
      <div class="col-6">
        <div>♦契約先</div>
        <div style="font-size: 2em;">商船港運株式会社</div>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-6">
        <div>♦勤務時間</div>
      </div>
      <div class="col-2">
        <div>天候</div>
      </div>
      <div class="col-1"></div>
      <div class="col-3">
        <div>担当警備員</div>
      </div>
    </div>
    <div class="row">
      <div class="col-1">自）</div>
      <div class="col-2"><input type="date" class="form-control w-auto" value="2021-02-17" readonly></div>
      <div class="col-1 pt-1">水曜日</div>
      <div class="col-2"><input type="time" class="form-control w-auto"></div>
      <div class="col-2">
        <!-- <input type="text" class="form-control w-auto"> -->
        <select name="" id="" class="form-control w-auto">
          <option value=""></option>
                    <option value="1">晴</option>
                    <option value="2">曇</option>
                  </select>
      </div>
      <div class="col-1"></div>
      <div class="col-2">
        <!-- <input type="text" class="form-control w-auto"> -->
        <select name="" id="" class="form-control w-auto">
          <option value=""></option>
                              <option value="SR16">SR粟井</option>
                    <option value="SR 18">SR楠</option>
                    <option value="1">ITCテスト</option>
                    <option value="S15R">SR磯山</option>
                    <option value="GOP40">G小村</option>
                    <option value="GOP23">G椿</option>
                    <option value="SR15">SR南</option>
                    <option value="SR 17">SR 吉岡</option>
                    <option value="2">ITCテスト２</option>
                    <option value="PO09">P合屋</option>
                    <option value="3216">赤木　勝巳</option>
                    <option value="SR03">SR阿久根</option>
                    <option value="2811">浅川　行司</option>
                    <option value="GOP06">G荒井</option>
                    <option value="2809">荒賀　正勝</option>
                    <option value="PO12">P五十嵐</option>
                    <option value="2318">池田　智</option>
                    <option value="2622">石井　義夫</option>
                    <option value="3212">伊豆原　正照</option>
                    <option value="2810">市川　陽一</option>
                    <option value="SR08">SR伊藤</option>
                    <option value="3305">伊奈　雅朗</option>
                    <option value="GOP24">G井上</option>
                    <option value="WFS02">W井上</option>
                    <option value="3014">井上　啓</option>
                    <option value="2206">井上　通</option>
                    <option value="3019">井上　文孝</option>
                    <option value="P014">P猪嶋</option>
                    <option value="PO14">P猪嶋</option>
                    <option value="2254">五百倉　治</option>
                    <option value="3103">今里　正憲</option>
                    <option value="2812">入江　喬士</option>
                    <option value="JPS04">J岩佐</option>
                    <option value="GOP42">G岩橋</option>
                    <option value="JPS05">J上里</option>
                    <option value="GOP09">G植杉</option>
                    <option value="2253">上田　忠昌</option>
                    <option value="3104">臼井　健兒</option>
                    <option value="GOP10">G梅永</option>
                    <option value="2605">榎田　俊昭</option>
                    <option value="2905">大浦　邦秀</option>
                    <option value="SR09">SR大曽根</option>
                    <option value="GOP17">G太田</option>
                    <option value="GOP36">G大田</option>
                    <option value="PO07">P大谷</option>
                    <option value="PO08">P大野</option>
                    <option value="2927">大野　實</option>
                    <option value="1724">大野　善幸</option>
                    <option value="GOP13">G大橋</option>
                    <option value="1410">大見　重義</option>
                    <option value="SR11">SR大森</option>
                    <option value="GOP30">G岡田</option>
                    <option value="JPS06">J岡松</option>
                    <option value="3005">岡本　昌宏</option>
                    <option value="2324">小川　亮</option>
                    <option value="3115">奥田　清隆</option>
                    <option value="2727">奥野　眞一</option>
                    <option value="3102">押部　秀樹</option>
                    <option value="2409">尾田　増雄</option>
                    <option value="GOP39">G小原</option>
                    <option value="ﾃｸﾉ07">ﾃ片山</option>
                    <option value="PO13">P鹿屋</option>
                    <option value="3217">樺山昇一</option>
                    <option value="3111">鎌田　穣</option>
                    <option value="ｼﾞｬ02">ｼﾞｬ河内</option>
                    <option value="2238">川口　力</option>
                    <option value="2827">川尻　賢二</option>
                    <option value="3211">川瀬　晃</option>
                    <option value="新和02">新和川原</option>
                    <option value="新和05">新和川村</option>
                    <option value="AT01">A岸本</option>
                    <option value="2719">木透　孝昭</option>
                    <option value="GOP20">G北村</option>
                    <option value="2249">木戸　正二</option>
                    <option value="JPS02">J熊本</option>
                    <option value="2922">黒川　隆一</option>
                    <option value="2740">古賀　慎一郎</option>
                    <option value="3013">小林　徹三</option>
                    <option value="GOP28">G古東</option>
                    <option value="ﾃｸﾉ02">ﾃ(Ａ)近藤</option>
                    <option value="3210">五島　正雄</option>
                    <option value="1823">佐尾　英俊　</option>
                    <option value="WFS01">W酒井</option>
                    <option value="2730">坂井　豊秀</option>
                    <option value="3213">坂　真一郎</option>
                    <option value="PO15">P坂根</option>
                    <option value="2625">坂本　光一</option>
                    <option value="JPS01">J崎山</option>
                    <option value="2626">笹倉　博志</option>
                    <option value="2825">佐藤　学</option>
                    <option value="PO06">P里村</option>
                    <option value="PO03">P沢田</option>
                    <option value="SR06">SR荘司</option>
                    <option value="GOP19">G宍戸</option>
                    <option value="新和03">新和篠原</option>
                    <option value="2709">陣野　貞士郎</option>
                    <option value="GOP01">G鈴木</option>
                    <option value="JPS03">J鈴木</option>
                    <option value="SR07">SR角南</option>
                    <option value="WFS03">W隅岡</option>
                    <option value="1324">仙田　恭一</option>
                    <option value="GOP34">G泰井</option>
                    <option value="SR12">SR高木</option>
                    <option value="GOP03">G(Ａ)高瀬</option>
                    <option value="GOP32">G高田</option>
                    <option value="GOP05">G鷹野</option>
                    <option value="GOP12">G高橋</option>
                    <option value="0004">滝田　功</option>
                    <option value="2704">瀧元　晶子</option>
                    <option value="2020">竹内</option>
                    <option value="ｼﾞﾔ04">ｼﾞﾔ武田</option>
                    <option value="SR10">SR武本</option>
                    <option value="GOP11">G立江</option>
                    <option value="3205">谷川　祐之</option>
                    <option value="GOP31">G谷口</option>
                    <option value="SR13">SR玉岡</option>
                    <option value="PO01">P茶野</option>
                    <option value="3010">鎭守　吉博</option>
                    <option value="2006">辻　龍夫</option>
                    <option value="ﾃｸﾉ00">ﾃ〇〇</option>
                    <option value="1622">寺尾　佳典</option>
                    <option value="2808">東條　和典</option>
                    <option value="2921">東条　吉彦</option>
                    <option value="2702">時山　利広</option>
                    <option value="2818">徳田　健志</option>
                    <option value="3016">徳永　尚哉</option>
                    <option value="1271">戸田　暁快</option>
                    <option value="3108">戸田　順壱</option>
                    <option value="GOP27">G富永</option>
                    <option value="3109">富永　隆弘</option>
                    <option value="3214">富山　哲男</option>
                    <option value="2510">友森　彰男</option>
                    <option value="2620">豊島　九二男</option>
                    <option value="GOP22">G土肥</option>
                    <option value="GOP04">G(Ａ)中尾</option>
                    <option value="3204">中田　佳仁</option>
                    <option value="3207">中戸　智史</option>
                    <option value="2828">中根　巖</option>
                    <option value="GOP16">G中野</option>
                    <option value="2434">中村　啓</option>
                    <option value="2724">中村　卓郎</option>
                    <option value="2745">中山　興夫</option>
                    <option value="2901">長尾　保則</option>
                    <option value="3009">成田　龍二</option>
                    <option value="2748">難波　巌</option>
                    <option value="2823">難波　一清</option>
                    <option value="3202">西浦　惠信</option>
                    <option value="WFS05">W西尾</option>
                    <option value="GOP15">G西口</option>
                    <option value="1416">西田　泰博</option>
                    <option value="SR05">SR仁科</option>
                    <option value="1914">西村　明悦</option>
                    <option value="2612">西村　繁</option>
                    <option value="2609">西村　進一</option>
                    <option value="2203">西山　育治</option>
                    <option value="2502">丹羽　通雄</option>
                    <option value="3021">野井　慎</option>
                    <option value="PO11">P野上</option>
                    <option value="GOP26">G野澤</option>
                    <option value="2701">橋爪　良彦</option>
                    <option value="1256">畠中　礼子</option>
                    <option value="GOP08">G林</option>
                    <option value="3101">林　美央</option>
                    <option value="WFS06">W原田</option>
                    <option value="1918">春江　信行</option>
                    <option value="2523">春本　晃</option>
                    <option value="GOP21">G馬殿</option>
                    <option value="ｼﾞｬ03">ｼﾞｬ東</option>
                    <option value="1606">檜山　英治</option>
                    <option value="2916">平岡　秀一</option>
                    <option value="2756">平田　義晴</option>
                    <option value="3112">広瀬　昇</option>
                    <option value="GOP07">G福島</option>
                    <option value="2231">福嶋　純夫</option>
                    <option value="SR04">SR福田政</option>
                    <option value="0007">福永　輝一</option>
                    <option value="ﾃｸﾉ04">ﾃ福本</option>
                    <option value="GOP38">G藤岡</option>
                    <option value="3215">藤岡 　昌好</option>
                    <option value="3209">藤倉　寿慶</option>
                    <option value="ｼﾞｬ01">ｼﾞｬ藤澤</option>
                    <option value="GOP29">G藤田</option>
                    <option value="1907">藤田　達也</option>
                    <option value="3107">藤谷　光良</option>
                    <option value="GOP41">G藤見</option>
                    <option value="3007">藤本　譲二</option>
                    <option value="2908">船越　英男</option>
                    <option value="2734">舩越　克幸</option>
                    <option value="PO04">P佛生</option>
                    <option value="ﾃｸﾉ01">ﾃ北條</option>
                    <option value="SR01">SR星山</option>
                    <option value="3208">細見　達夫</option>
                    <option value="ﾃｸﾉ03">ﾃ(Ａ)前田</option>
                    <option value="2632">前田　武夫</option>
                    <option value="2614">前田　実</option>
                    <option value="GOP33">G曲渕</option>
                    <option value="3106">増山　恒夫</option>
                    <option value="GOP25">G松浦</option>
                    <option value="3206">松浦　和</option>
                    <option value="2816">松尾　誠一</option>
                    <option value="GOP37">G松岡</option>
                    <option value="1255">松下　育夫</option>
                    <option value="GOP35">G松田</option>
                    <option value="3017">松田　健</option>
                    <option value="3201">松田　一雄</option>
                    <option value="1811">松福　大運</option>
                    <option value="AT02">A松本</option>
                    <option value="GOP02">G松本</option>
                    <option value="2924">松本　宗美</option>
                    <option value="3301">松本　行雄</option>
                    <option value="PO02">P○○</option>
                    <option value="SR02">SR○○</option>
                    <option value="GOP11-1">G○○</option>
                    <option value="GOP11-2">G○○</option>
                    <option value="GOP18">G丸山</option>
                    <option value="ﾃｸﾉ05">ﾃ三河</option>
                    <option value="2616">水谷　紀夫</option>
                    <option value="GOP14">G溝上</option>
                    <option value="3303">三谷　祐司</option>
                    <option value="2710">宮内　信房</option>
                    <option value="2521">宮坂　重樹</option>
                    <option value="新和01">新和宮原</option>
                    <option value="新和04">新和三輪</option>
                    <option value="3114">向井　威一朗</option>
                    <option value="WFS04">W向仲</option>
                    <option value="3304">森　司</option>
                    <option value="2917">彌富　勝彦</option>
                    <option value="1620">矢部　修市</option>
                    <option value="2909">山内　健正</option>
                    <option value="ﾃｸﾉ06">ﾃ山口</option>
                    <option value="2640">山田　宏之</option>
                    <option value="2925">山根　博幸</option>
                    <option value="PO05">P山本</option>
                    <option value="2920">弓場　靖正</option>
                    <option value="SR14">SR吉岡</option>
                    <option value="3113">吉田　好廣</option>
                    <option value="PO10">P吉永</option>
                    <option value="WFS07">W渡辺</option>
                    <option value="WFS08">W渡辺広</option>
                    <option value="2641">亘　利秀</option>
                            </select>
      </div>
    </div>
    <div class="row mt-1">
      <div class="col-1">至）</div>
      <div class="col-3"></div>
      <div class="col-2"><input type="time" class="form-control w-auto"></div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">♦搬出入車両及び外来者の適正誘導並びに、構内全域、盗難、火災予防、<br>不法侵入等、発見、排除、下記の通り点検警備にあたる。</div>
    </div>
    <hr>

    <!-- <div class="row">
      <div class="col-12">（１）その他貨物及びコンテナ整理誘導</div>
      <div class="col-12">　♦作業終了時間（16時30分）</div>
      <div class="col-12">　♦安全旗掲揚（07時30分）</div>
      <div class="col-12">　降納（16時30分）</div>
    </div> -->
    <div class="row">
      <div class="col-1">（１）</div>
      <div class="col-3">その他貨物及びコンテナ整理誘導</div>
    </div>
    <div class="row">
      <div class="col-1"></div>
      <div class="col-3">♦作業終了時間</div>
      <div class="col-2 input-group">
        <!-- <input type="time" class="form-control w-auto"> -->
        <input type="number" class="form-control text-center p-0 w-auto border-right-0" min="0" max="23">
        <span class="border-top border-bottom pt-1">:</span>
        <input type="number" class="form-control text-center p-0 w-auto border-left-0" min="0" max="59">
      </div>
    </div>
    <div class="row mt-1 mb-1">
      <div class="col-1"></div>
      <div class="col-3">♦安全旗掲揚</div>
      <div class="col-2 input-group">
        <!-- <input type="time" class="form-control w-auto"> -->
        <input type="number" class="form-control text-center p-0 w-auto border-right-0" min="0" max="23">
        <span class="border-top border-bottom pt-1">:</span>
        <input type="number" class="form-control text-center p-0 w-auto border-left-0" min="0" max="59">
      </div>
    </div>
    <div class="row">
      <div class="col-1"></div>
      <div class="col-3">降納</div>
      <div class="col-2 input-group">
        <!-- <input type="time" class="form-control w-auto"> -->
        <input type="number" class="form-control text-center p-0 w-auto border-right-0" min="0" max="23">
        <span class="border-top border-bottom pt-1">:</span>
        <input type="number" class="form-control text-center p-0 w-auto border-left-0" min="0" max="59">
      </div>
    </div>
    <hr>

    <!-- <div class="row">
      <div class="col-12">（特記事項）</div>
      <div class="col-12">　♢税関執務時間外届け</div>
      <div class="col-12">　♢上屋内外巡回　：保安帽着用、無断入庫者の確認</div>
      <div class="col-12">　♢タクシー並びに外来乗用車駐車の監視、誘導</div>
    </div> -->
    <div class="row">
      <div class="col-12">（特記事項）</div>
      <div class="col-1"></div>
      <div class="col-11">♢税関執務時間外届け</div>
      <div class="col-1"></div>
      <div class="col-11">♢上屋内外巡回　：保安帽着用、無断入庫者の確認</div>
      <div class="col-1"></div>
      <div class="col-11">♢タクシー並びに外来乗用車駐車の監視、誘導</div>
    </div>
    <hr>

    <div class="row">
      <div class="col-1 m-auto">備<br>考</div>
      <div class="col-11">
        <textarea name="" id="" rows="5" class="form-control"></textarea>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-6">
        <button type="button" class="btn btn-success btn-block regist" role="button">登録</button>
      </div>
      <div class="col-6">
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

