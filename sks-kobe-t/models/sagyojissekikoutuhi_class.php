<?php
    // 作業実績交通費クラス
    class Sagyojissekikoutuhi
    {
        // 変数の宣言
        public $inp_move_cost_yen = NULL;
        public $inp_move_cost_kilo = NULL;

        public $errmsg;

        // 入力チェック
        public function inputCheck() {

            $this->errmsg = "";

            if ($this->inp_move_cost_yen != "") {
                if (!(ctype_digit($this->inp_move_cost_yen))) {
                    $this->errmsg .= "交通費は整数を入力してください。<br />";
                }
            }
            if ($this->inp_move_cost_kilo != "") {
                if (!(is_numeric($this->inp_move_cost_kilo))) {
                    $this->errmsg .= "移動距離は数字を入力してください。<br />";
                }
            }
        }
    }
?>
