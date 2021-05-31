<?php 
    // 共通クラス
    class Common
    {
        // 変数の宣言
        public $judgephone;     // スマートフォン:true / 携帯:false
        public $career;         // ドコモ:docomo / au:au / softbank:softbank
        public $uae;
        public $device;
        public $rootpath = '/var/www/html/sks-kobe-t';

        function __construct() {

            ini_set('default_mimetype', 'text/html');
            ini_set('default_charset', 'UTF-8');

            mb_language('Japanese');
            mb_internal_encoding('UTF-8');
            mb_http_input('pass');
            mb_http_output('UTF-8');

            // 携帯の判定
            $ua = $_SERVER['HTTP_USER_AGENT'];

            // ドコモ
            if (preg_match('/^DoCoMo/', $ua)) {
                $this->judgephone = false;
                $this->career = "docomo";
            // au
            } elseif (preg_match('/^KDDI-|^UP\.Browser/',$ua)) {
                $this->judgephone = false;
                $this->career = "au";
            // SoftBank
            } elseif (preg_match('#^J-(PHONE|EMULATOR)/|^(Vodafone/|MOT(EMULATOR)?-[CV]|SoftBank/|[VS]emulator/)#', $ua)) {
                $this->judgephone = false;
                $this->career = "softbank";
            // Willcom
            } elseif (preg_match('/(DDIPOCKET|WILLCOM);/', $ua)) {
                $this->judgephone = true;
            // e-mobile
            } elseif (preg_match('#^(emobile|Huawei|IAC)/#', $ua)) {
                $this->judgephone = true;
            // スマートフォン
            } elseif (preg_match('#\b(iP(hone|od);|Android )|dream|blackberry9500|blackberry9530|blackberry9520|blackberry9550|blackberry9800|CUPCAKE|webOS|incognito|webmate#', $ua)) {
                $this->judgephone = true;
                $this->judgephone2 = true;
            // モバイル端末
            } elseif (preg_match('#(^Nokia\w+|^BlackBerry[0-9a-z]+/|^SAMSUNG\b|Opera Mini|Opera Mobi|PalmOS\b|Windows CE\b)#', $ua)) {
                $this->judgephone = false;
            // PC	
            } else {
                $this->judgephone = true;
                $this->career = "pc";
            }
            
            if (strstr($ua, 'Edge') || strstr($ua, 'Edg')) {
              $this->uae = 1;
            } elseif (strstr($ua, 'Trident') || strstr($ua, 'MSIE')) {
              $this->uae = 1;
            } elseif (strstr($ua, 'OPR') || strstr($ua, 'Opera')) {
              $this->uae = 1;
            } elseif (strstr($ua, 'Chrome')) {
              $this->uae = 2;
            } elseif (strstr($ua, 'Firefox')) {
              $this->uae = 2;
            } elseif (strstr($ua, 'Safari')) {
              $this->uae = 2;
            } else {
              $this->uae = "";
            }
            
            if ((strpos($ua, 'Android') !== false) && (strpos($ua, 'Mobile') !== false) || (strpos($ua, 'iPhone') !== false) || (strpos($ua, 'Windows Phone') !== false)) {
                // スマホからのアクセス
                $this->device = "mobile";
            } elseif ((strpos($ua, 'Android') !== false) || (strpos($ua, 'iPad') !== false)) {
                // タブレットからのアクセス
                $this->device = "tablet";
            } elseif ((strpos($ua, 'DoCoMo') !== false) || (strpos($ua, 'KDDI') !== false) || (strpos($ua, 'SoftBank') !== false) || (strpos($ua, 'Vodafone') !== false) || (strpos($ua, 'J-PHONE') !== false)) {
                // 携帯からのアクセス
                $this->device = "old-phone";
            } else {
                // PCからのアクセス
                $this->device = "pc";
            }

        }

        // HTML画面表示
        function html_display($str) {

            if ($this->judgephone) {
				$str = htmlspecialchars($str);
            } else {
				$str = htmlspecialchars($str);
                //$str = mb_convert_encoding($str, "SJIS", "UTF-8");
            }

            return $str;
        }

        // HTMLデコード
        function html_decode($str) {
            if ($this->judgephone) {
            } else {
                //$str = mb_convert_encoding($str, "UTF-8", "SJIS");
            }

            return $str;
        }

        /** 
         * キャリアに応じて度分秒表示を度表示に変換する. 
         * 
         * @param dms 緯度または経度 
         * @param carrier キャリア 
         * @return double 度表示の緯度または経度 
         */  
        function dms2Deg($dms, $carrier) {  

            $parsed = explode(".",$dms);
            if (is_numeric($parsed[0])) {
                $deg = (double)$parsed[0];
            } else {
                return false;
            }
            if (is_numeric($parsed[1])) {
                $min = (double)$parsed[1];
            } else {
                return false;
            }
            if (is_numeric($parsed[2])) {
                $sec = (double)$parsed[2];
            } else {
                return false;
            }
            if (is_numeric($parsed[3])) {
                $secDecimal = (double)$parsed[3];
            } else {
                return false;
            }
            $d = 0;

            if (($carrier == "au") || ($carrier == "softbank")) { 
                return false;
            } else {
                $d = $deg + ((($min * 60 + $sec + $secDecimal / 1000) * 1000) / 3600000);  
            }
//            $d = (string)$d;
//            $d = substr($d,0,5);

//            String[] parsed = dms.split("\.");  
//            double deg = Double.parseDouble(parsed[0]);  
//            double min = Double.parseDouble(parsed[1]);  
//            double sec = Double.parseDouble(parsed[2]);  
//            double secDecimal = Double.parseDouble(parsed[3]);  
//            double d = 0;  
//            if ("au".equals(carrier) || "softbank".equals(carrier)) {  
//                d = deg + (((min * 60 + sec + secDecimal / 10) * 1000) / 3600000);  
//            } else {  
//                d = deg + (((min * 60 + sec + secDecimal / 100) * 1000) / 3600000);  
//            }  
//            String d1 = String.valueOf(d);  
//            String result = StringUtils.division(d1, 1, 5);  
//          
            return $d;  
        }  

		function localdeg($val) {
			$val = str_replace("+", "", $val);
			preg_match("/^(\d+)\.(\d+)\.(\d+)\.(\d*)$/", $val, $m);
			$d = $m[1]; $f = $m[2]; $b = "$m[3].$m[4]";
			return($d + ($f * 60 + $b) / 3600);
		}

        function dateSeparate($val) {
            if (!$val) {
                return $val;
            } else {
                return substr($val,0,4).".".substr($val,4,2).".".substr($val,6,2);
            }
        }
    }
?>
