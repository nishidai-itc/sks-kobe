<?php
    // 作業開始クラス
    class Sagyojissekisyurui
    {
        // 変数の宣言
        public $inp_sumvalue;
        public $inp_t;

        public $errmsg;

        // 入力チェック
        public function inputCheck() {
            if ($this->inp_sumvalue == 0) {
                $this->errmsg .= "「作業は予定通りでした」にチェックを入れるか、作業時間を入力してください。<br />";
            }
            if ($this->inp_t != "") {
                if (!(ctype_digit($this->inp_t))) {
                    $this->errmsg .= "作業種類は整数を入力してください。<br />";
                }
            }
        }
    }
?>
