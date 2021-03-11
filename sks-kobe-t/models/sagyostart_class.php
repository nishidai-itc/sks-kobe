<?php
    // 作業開始クラス
    class Sagyostart
    {
        // 変数の宣言
        public $inp_rest_reason;

        public $errmsg;

        // 入力チェック
        public function inputCheck() {
            if (mb_strlen($this->inp_rest_reason) > 1000) {
                $this->errmsg .= "休暇理由は1,000文字以内で入力してください。<br />";
            }
            if ($this->inp_t_work_comment == "") {
                $this->errmsg .= "作業報告を入力してください。<br />";
            }
            if (mb_strlen($this->inp_t_work_comment) > 1000) {
                $this->errmsg .= "作業報告は1,000文字以内で入力してください。<br />";
            }
        }
    }
?>
