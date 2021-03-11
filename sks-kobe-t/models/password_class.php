<?php
    // パスワードクラス
    class Password
    {
        // 変数の宣言
        public $inp_now_pw;
        public $inp_new_pw1;
        public $inp_new_pw2;

        public $errmsg;

        // 入力チェック
        public function inputCheck() {

            if ($this->inp_now_pw == "") {
                $this->errmsg .= "現在のパスワードを入力してください。<br />";
            }
            if ($this->inp_new_pw1 == "") {
                $this->errmsg .= "新しいパスワードを入力してください。<br />";
            }
            if ($this->inp_new_pw2 == "") {
                $this->errmsg .= "新しいパスワード（確認）を入力してください。<br />";
            }
            if ($this->inp_new_pw1 != $this->inp_new_pw2) {
                $this->errmsg .= "現在のパスワードと新しいパスワード（確認）が違います。";
            }
        }

        // 入力チェック
        public function confirmCheck() {

            if ($this->inp_new_pw1 == "") {
                $this->errmsg .= "新しいパスワードを入力してください。<br />";
            }
        }
    }
?>
