<?php 
    // 端末識別クラス
    class Judgephone
    {
        // 変数の宣言
        public $judge;  // スマートフォン:true / 携帯:false

        function __construct() {

            $ua = $_SERVER['HTTP_USER_AGENT'];

            // ドコモ
            if (preg_match('/^DoCoMo/', $ua)) {
                $this->judge = false;
            // au
            } elseif (preg_match('/^KDDI-|^UP\.Browser/',$ua)) {
                $this->judge = false;
            // SoftBank
            } elseif (preg_match('#^J-(PHONE|EMULATOR)/|^(Vodafone/|MOT(EMULATOR)?-[CV]|SoftBank/|[VS]emulator/)#', $ua)) {
                $this->judge = false;
            // Willcom
            } elseif (preg_match('/(DDIPOCKET|WILLCOM);/', $ua)) {
                $this->judge = true;
            // e-mobile
            } elseif (preg_match('#^(emobile|Huawei|IAC)/#', $ua)) {
                $this->judge = true;
            // スマートフォン
            } elseif (preg_match('#\b(iP(hone|od);|Android )|dream|blackberry9500|blackberry9530|blackberry9520|blackberry9550|blackberry9800|CUPCAKE|webOS|incognito|webmate#', $ua)) {
                $this->judge = true;
            // モバイル端末
            } elseif (preg_match('#(^Nokia\w+|^BlackBerry[0-9a-z]+/|^SAMSUNG\b|Opera Mini|Opera Mobi|PalmOS\b|Windows CE\b)#', $ua)) {
                $this->judge = false;
            // PC	
            } else {
                $this->judge = true;
            }

        }
    }
?>
