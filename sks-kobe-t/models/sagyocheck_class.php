<?php
    // 作業開始クラス
    class Sagyocheck
    {
        // 変数の宣言
        public $inp_sumvalue;
        public $inp_t;
        public $inp_move_cost_yen = NULL;
        public $inp_move_cost_kilo = NULL;

        public $errmsg;

        // 入力チェック
        public function inputCheck() {
            if ($this->inp_sumvalue == 0) {
                $this->errmsg .= "作業実績の種類を選択してください。<br />";
            }
            if ($this->inp_t != "") {
                if (!(ctype_digit($this->inp_t))) {
                    $this->errmsg .= "作業種類は整数を入力してください。<br />";
                }
            }
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
