<?php
    // ログインクラス
    class Login
    {
        // 変数の宣言
        public $inp_staff_login_id;
        public $inp_staff_pass;

        public $errmsg;

        // 入力チェック
        public function inputCheck() {

            if ($this->inp_staff_login_id == "") {
                $this->errmsg .= "ログインIDを入力してください。<br />";
            }
            if ($this->inp_staff_pass == "") {
                $this->errmsg .= "パスワードを入力してください。<br />";
            }
        }
    }
?>
