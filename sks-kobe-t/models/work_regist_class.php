<?php
    // 作業登録クラス
    class Workregist
    {
        // 変数の宣言
        public $inp_user_id;
        public $inp_run_start_date;
        public $inp_run_start_time_hh;
        public $inp_run_start_time_mm;
        public $inp_run_end_time_hh;
        public $inp_run_end_time_mm;
        public $inp_run_time;

        public $errmsg;

        // 入力チェック
        public function inputCheck() {
            if ($this->inp_user_id== "") {
                $this->errmsg .= "利用者を選択してください。<br />";
            }
            if ($this->inp_run_start_date== "") {
                $this->errmsg .= "作業日を選択してください。<br />";
            } else {
                if (checkdate(substr($this->inp_run_start_date,5,2), substr($this->inp_run_start_date,8,2), substr($this->inp_run_start_date,0,4))) {
                } else {
                    $this->errmsg .= "作業日に正しい日付を入力してください。<br />";
                }
            }
            if ($this->inp_run_start_time_hh== "") {
                $this->errmsg .= "作業開始時間を選択してください。<br />";
            } else {
                if ($this->inp_run_start_time_mm== "") {
                    $this->errmsg .= "作業開始時間を選択してください。<br />";
                }
            }
            if ($this->inp_run_end_time_hh== "") {
                $this->errmsg .= "作業終了時間を選択してください。<br />";
            } else {
                if ($this->inp_run_end_time_mm== "") {
                    $this->errmsg .= "作業終了時間を選択してください。<br />";
                }
            }
        }
    }
?>
