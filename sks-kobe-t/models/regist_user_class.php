<?php
    // ログインクラス
    class Registuser
    {
        // 変数の宣言
        public $inp_m_user_kana;
        public $inp_m_user_name;
        public $inp_m_user_birth_date;

        public $errmsg;

        // 入力チェック
        public function inputCheck() {

            if ($this->inp_m_user_name == "") {
                $this->errmsg .= "利用者さんのお名前（漢字）が入力されていません。<br />";
            }
            if ($this->inp_m_user_kana == "") {
                $this->errmsg .= "利用者さんのお名前（カナ）が入力されていません。<br />";
            }
            if ($this->inp_m_user_birth_date == "") {
			} else {
	            if ($this->inp_m_user_birth_date == "--") {
				} else {
		            if (mb_strlen($this->inp_m_user_birth_date) != 10) {
		                $this->errmsg .= "利用者さんの生年月日に正しい日付を入力してください。<br />";
		            } else {
		                if (checkdate(substr($this->inp_m_user_birth_date,5,2), substr($this->inp_m_user_birth_date,8,2), substr($this->inp_m_user_birth_date,0,4))) {
		                } else {
		                    $this->errmsg .= "利用者さんの生年月日に正しい日付を入力してください。<br />";
		                }
		            }
		        }
	        }
        }
    }
?>
