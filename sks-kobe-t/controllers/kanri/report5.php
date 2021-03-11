<?php
    session_start();
    
    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:../controllers/login.php');
    }
?>
<?php
    require_once('../../models/common/common.php');          // 共通クラス
    require_once('../../models/common/db.php');              // DBクラス
    require_once('../../models/Wkdetail.php');               // 作業開始クラス
    require_once('../../models/Staff.php');                  // 社員クラス
    
    $act            = NULL;
    $weather        = null;
    $weathers       = array(
        "1"=>"晴",
        "2"=>"曇",
        "3"=>"雨",
        "4"=>"雪"
    );
    $staff_id       = null;
    $date           = date("Y-m-d");
    $date2          = date("Y-m-d",strtotime($date." +1 day"));
    $dates          = explode("-",$date);
    $dates2         = explode("-",$date2);
    $joban_time     = array(
        "08",
        "00"
    );
    $kaban_time     = array(
        "08",
        "00"
    );
    $abc       = array(
        "A",
        "B",
        "C",
        "D",
        "E",
        "F",
        "G",
        "H",
        "I"
    );
    $zyunkai_default = array(
        array("17","30"),
        array("19","00"),
        array("21","00"),
        array("22","30"),
        array("00","00"),
        array("01","00"),
        array("02","00"),
        array("03","00"),
        array("04","00"),
        array("05","30"),
        array("06","30")
    );

    // $input_check = "<span><input type=\"checkbox\" class=\"check\" value=\"\"></span>";
    $input_text = "<input type=\"text\" class=\"w-100\" value=\"\">";
    $input_time ="<input type=\"number\" class=\"text-center\" value=\"\" min=\"0\" max=\"23\"><span class=\"\">:</span><input type=\"number\" class=\"text-center\" value=\"\" min=\"0\" max=\"59\">
    <span class=\"\">～</span><input type=\"number\" class=\"text-center\" value=\"\" min=\"0\" max=\"23\"><span class=\"\">:</span><input type=\"number\" class=\"text-center\" value=\"\" min=\"0\" max=\"59\">";
    $input_check_time ="<span><input type=\"checkbox\" class=\"check\" value=\"\"></span><input type=\"number\" class=\"text-center\" value=\"\" min=\"0\" max=\"23\"><span class=\"\">:</span><input type=\"number\" class=\"text-center\" value=\"\" min=\"0\" max=\"59\">
    <span class=\"\">～</span><span> <input type=\"checkbox\" class=\"check\" value=\"\"></span><input type=\"number\" class=\"text-center\" value=\"\" min=\"0\" max=\"23\"><span class=\"\">:</span><input type=\"number\" class=\"text-center\" value=\"\" min=\"0\" max=\"59\">";
    $table_con = array(
        "tr"=>array(
            array(
                "class"=>"",
                "td"=>array(
                    array(
                        "colspan"=>"3",
                        // "content"=>"１．状況"
                        "content"=>array(
                            array(
                                "１．状況"
                            )
                        )
                    )
                )
            ),
            array(
                "class"=>"",
                "td"=>array(
                    array("colspan"=>"2","class"=>"","content"=>array(array("i．入出港"))),
                    array("colspan"=>"","class"=>"","content"=>array(array("ヤード照明")))
                )
            ),
            array("class"=>"","td"=>array(array("colspan"=>"","class"=>"d-flex","content"=>array(array("<span>RC-</span>"),array("input_text"))),array("colspan"=>"","class"=>"text-center","content"=>array(array("input_check_time","","","",""))),array("colspan"=>"","class"=>"","content"=>array(array("C-2"))))),
            array("class"=>"","td"=>array(array("colspan"=>"","class"=>"d-flex","content"=>array(array("<span>RC-</span>"),array("input_text"))),array("colspan"=>"","class"=>"text-center","content"=>array(array("input_check_time","","","",""))),array("colspan"=>"","class"=>"","content"=>array(array("input_time","","","",""))))),
            array("class"=>"","td"=>array(array("colspan"=>"","class"=>"d-flex","content"=>array(array("<span>RC-</span>"),array("input_text"))),array("colspan"=>"","class"=>"text-center","content"=>array(array("input_check_time","","","",""))),array("colspan"=>"","class"=>"","content"=>array(array("input_time","","","",""))))),
            array("class"=>"","td"=>array(array("colspan"=>"","class"=>"d-flex","content"=>array(array("<span>RC-</span>"),array("input_text"))),array("colspan"=>"","class"=>"text-center","content"=>array(array("input_check_time","","","",""))),array("colspan"=>"","class"=>"","content"=>""))),
            array("class"=>"","td"=>array(array("colspan"=>"2","class"=>"","content"=>array(array("<span>RC-</span>"),array("C-4ゲート立哨"))),array("colspan"=>"","class"=>"","content"=>array(array("C-3"))))),
            array("class"=>"","td"=>array(array("colspan"=>"","class"=>"","content"=>""),array("colspan"=>"","class"=>"text-center","content"=>array(array("input_time","08","30","17","00"))),array("colspan"=>"","class"=>"","content"=>array(array("input_time","","","",""))))),
            array("class"=>"","td"=>array(array("colspan"=>"","class"=>"","content"=>array(array("東サブゲート立哨"))),array("colspan"=>"","class"=>"text-center","content"=>array(array("input_time","08","30","16","30"))),array("colspan"=>"","class"=>"","content"=>array(array("input_time","","","",""))))),
            array("class"=>"","td"=>array(array("colspan"=>"","class"=>"","content"=>array(array("iii．搬入出車両"))),array("colspan"=>"","class"=>"text-center","content"=>array(array("input_time","08","30","17","00"))),array("colspan"=>"","class"=>"","content"=>""))),
            array("class"=>"","td"=>array(array("colspan"=>"2","class"=>"","content"=>array(array("<span>RC-</span>"),array("iv．各ゲート及び管理棟、CFS事務所の開錠及び施錠実施"))),array("colspan"=>"","class"=>"","content"=>array(array("c-4"))))),
            array("class"=>"","td"=>array(array("colspan"=>"2","class"=>"","content"=>array(array(array(array("input_time","","","",""))))),array("colspan"=>"","class"=>"","content"=>array(array("input_time","","","",""))))),
            array("class"=>"","td"=>array(array("colspan"=>"2","class"=>"","content"=>array(array("i．管理棟及び各建屋の火災、盗難等の警戒警備並びに<br>不法侵入者の警戒監視"))),array("colspan"=>"","class"=>"","content"=>array(array("input_time","","","",""))))),
            array("class"=>"","td"=>array(array("colspan"=>"2","class"=>"","content"=>array(array("ii．搬入出車両及び外来者の適正誘導"))),array("colspan"=>"","class"=>"","content"=>array(array("C-5"))))),
            array("class"=>"","td"=>array(array("colspan"=>"2","class"=>"","content"=>array(array("３．実施"))),array("colspan"=>"","class"=>"","content"=>array(array("input_time","","","",""))))),
            array("class"=>"","td"=>array(array("colspan"=>"2","class"=>"","content"=>array(array("i．昼夜間巡回、警戒警備及び外周赤外線システムの監視"))),array("colspan"=>"","class"=>"","content"=>array(array("input_time","","","",""))))),
            array("class"=>"","td"=>array(array("colspan"=>"2","class"=>"","content"=>array(array("ii．管理棟及び各建屋の鍵の保管管理"))),array("colspan"=>"","class"=>"","content"=>""))),
            array("class"=>"","td"=>array(array("colspan"=>"2","class"=>"","content"=>array(array("発砲"))),array("colspan"=>"","class"=>"","content"=>array(array("トンボ照明"))))),
            array("class"=>"","td"=>array(array("colspan"=>"2","class"=>"","content"=>array(array("textarea"))),array("colspan"=>"","class"=>"","content"=>array(array("input_time","","","",""))))),
            array("class"=>"","td"=>array(array("colspan"=>"","class"=>"","content"=>array(array("input_time","","","",""))))),
            array("class"=>"","td"=>array(array("colspan"=>"","class"=>"","content"=>array(array("C5倉庫屋外照明　西・南"))))),
            array("class"=>"","td"=>array(array("colspan"=>"","class"=>"","content"=>array(array("input_time","","","",""))))),
            array("class"=>"","td"=>array(array("colspan"=>"","class"=>"","content"=>array(array("input_time","","","",""))))),
        )
    );
    // var_dump(count($table_con["tr"][2]["td"][0]["content"][1]),$table_con["tr"][0]["td"][0]["content"][0]);
    /*
    $table_content = array(
        array(
            "td_cnt"=>1,
            "td_array"=>array(
                array(
                    "td_colspan"=>"3",
                    "td_con"=>"１．状況"
                )
            )
        ),
        array("td_cnt"=>2,"td_array"=>
            array(array("td_colspan"=>"2","td_con"=>"i．入出港"),array("td_colspan"=>"","td_con"=>"ヤード照明"))
        ),
        array("td_cnt"=>3,"td_array"=>
            array(array("td_colspan"=>"","td_con"=>"<span>RC-</span>".$input_text),array("td_colspan"=>"","td_con"=>$input_time),array("td_colspan"=>"","td_con"=>"C-2"))
        ),
        array("td_cnt"=>3,"td_array"=>array(
            array("td_colspan"=>"","td_con"=>"<span>RC-</span>".$input_text),
            array("td_colspan"=>"","td_con"=>$input_time),
            array("td_colspan"=>"","td_con"=>$input_time)
        )
        ),
        array("td_cnt"=>3,"td_array"=>array(
            array("td_colspan"=>"","td_con"=>"<span>RC-</span>".$input_text),
            array("td_colspan"=>"","td_con"=>$input_time),
            array("td_colspan"=>"","td_con"=>$input_time)
        )
        ),
        array("td_cnt"=>3,"td_array"=>array(
            array("td_colspan"=>"","td_con"=>"<span>RC-</span>".$input_text),
            array("td_colspan"=>"","td_con"=>$input_time),
            array("td_colspan"=>"","td_con"=>"")
        )
        ),
        array("td_cnt"=>2,"td_array"=>array(
            array("td_colspan"=>"2","td_con"=>"C-4ゲート立哨"),
            array("td_colspan"=>"","td_con"=>"C-3")
        )
        ),
        array("td_cnt"=>3,"td_array"=>array(
            array("td_colspan"=>"","td_con"=>""),
            array("td_colspan"=>"","td_con"=>$input_time),
            array("td_colspan"=>"","td_con"=>$input_time)
        )
        ),
        array("td_cnt"=>3,"td_array"=>array(
            array("td_colspan"=>"","td_con"=>"東サブゲート立哨"),
            array("td_colspan"=>"","td_con"=>$input_time),
            array("td_colspan"=>"","td_con"=>$input_time)
        )
        ),
        array("td_cnt"=>3,"td_array"=>array(
            array("td_colspan"=>"","td_con"=>"iii．搬入出車両"),
            array("td_colspan"=>"","td_con"=>$input_time),
            array("td_colspan"=>"","td_con"=>"")
        )
        ),
        array("td_cnt"=>2,"td_array"=>array(
            array("td_colspan"=>"2","td_con"=>"iv．各ゲート及び管理棟、CFS事務所の開錠及び施錠実施"),
            array("td_colspan"=>"","td_con"=>"C-4")
        )
        ),
        array("td_cnt"=>2,"td_array"=>array(
            array("td_colspan"=>"2","td_con"=>"２．重点"),
            array("td_colspan"=>"","td_con"=>$input_time)
        )
        ),
        array("td_cnt"=>2,"td_array"=>array(
            array("td_colspan"=>"2","td_con"=>"i．管理棟及び各建屋の火災、盗難等の警戒警備並びに<br>不法侵入者の警戒監視"),
            array("td_colspan"=>"","td_con"=>$input_time)
        )
        ),
        array("td_cnt"=>2,"td_array"=>array(
            array("td_colspan"=>"2","td_con"=>"ii．搬入出車両及び外来者の適正誘導"),
            array("td_colspan"=>"","td_con"=>"C-5")
        )
        ),
        array("td_cnt"=>2,"td_array"=>array(
            array("td_colspan"=>"2","td_con"=>"３．実施"),
            array("td_colspan"=>"","td_con"=>$input_time)
        )
        ),
        array("td_cnt"=>2,"td_array"=>array(
            array("td_colspan"=>"2","td_con"=>"i．昼夜間巡回、警戒警備及び外周赤外線システムの監視"),
            array("td_colspan"=>"","td_con"=>$input_time)
        )
        ),
        array("td_cnt"=>2,"td_array"=>array(
            array("td_colspan"=>"2","td_con"=>"ii．管理棟及び各建屋の鍵の保管管理"),
            array("td_colspan"=>"","td_con"=>"")
        )
        ),
        array("td_cnt"=>2,"td_array"=>array(
            array("td_colspan"=>"2","td_con"=>"発砲"),
            array("td_colspan"=>"","td_con"=>"トンボ照明")
        )
        ),
        array("td_cnt"=>2,"td_array"=>array(
            array("td_colspan"=>"2","td_con"=>"<textarea name=\"\" id=\"\" rows=\"5\" class=\"w-100\" value=\"\"></textarea>"),
            array("td_colspan"=>"","td_con"=>$input_time)
        )
        ),
        array("td_cnt"=>1,"td_array"=>array(
            array("td_colspan"=>"","td_con"=>$input_time),
        )
        ),
        array("td_cnt"=>1,"td_array"=>array(
            array("td_colspan"=>"","td_con"=>"C5倉庫屋外照明　西・南"),
        )
        ),
        array("td_cnt"=>1,"td_array"=>array(
            array("td_colspan"=>"","td_con"=>$input_time),
        )
        ),
        array("td_cnt"=>1,"td_array"=>array(
            array("td_colspan"=>"","td_con"=>$input_time),
        )
        ),
    );
    // var_dump($table_content);
    */
    
    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date($date));
    $time2 = strtotime(date($date2));
    $w = date("w", $time);
    $w2 = date("w", $time2);

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;         // 共通クラス
    $wkdetail       = new Wkdetail;       // 作業実施テーブルクラス
    $staff      = new Staff;          // 社員マスタクラス
    $staff2      = new Staff;
    
    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    $staff2->getStaff();

?>
<?php
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/report5_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/kanri/m/report5_html.php');
    }
?>
