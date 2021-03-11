<?php

    // 給与マスタクラス
    class Kyuyo
    {
        // 変数の宣言
        //public $inp_m_tuti_msg = null;
        //public $inp_m_tuti_startday = null;
        //public $inp_m_tuti_endday = null;
        
        public $inp_m_kyuyo_no;
        public $inp_m_kyuyo_nengetu;
        public $inp_m_kyuyo_k0;
        public $inp_m_kyuyo_name;
        public $inp_m_kyuyo_k1 = null;
        public $inp_m_kyuyo_k2 = null;
        public $inp_m_kyuyo_k3 = null;
        public $inp_m_kyuyo_k4 = null;
        public $inp_m_kyuyo_k5 = null;
        public $inp_m_kyuyo_k6 = null;
        public $inp_m_kyuyo_k7 = null;
        public $inp_m_kyuyo_k8 = null;
        public $inp_m_kyuyo_k9 = null;
        public $inp_m_kyuyo_k10 = null;
        public $inp_m_kyuyo_k11 = null;
        public $inp_m_kyuyo_k12;
        public $inp_m_kyuyo_k13;
        public $inp_m_kyuyo_k14;
        public $inp_m_kyuyo_h1 = null;
        public $inp_m_kyuyo_h2 = null;
        public $inp_m_kyuyo_h3 = null;
        public $inp_m_kyuyo_h4 = null;
        public $inp_m_kyuyo_h5 = null;
        public $inp_m_kyuyo_h6 = null;
        public $inp_m_kyuyo_h7 = null;
        public $inp_m_kyuyo_h8 = null;
        public $inp_m_kyuyo_h9 = null;
        public $inp_m_kyuyo_h10 = null;
        public $inp_m_kyuyo_h11 = null;
        public $inp_m_kyuyo_s1 = null;
        public $inp_m_kyuyo_s2 = null;
        public $inp_m_kyuyo_s3 = null;
        public $inp_m_kyuyo_s4 = null;
        public $inp_m_kyuyo_s5 = null;
        public $inp_m_kyuyo_s6 = null;
        public $inp_m_kyuyo_s7 = null;
        public $inp_m_kyuyo_s8 = null;
        public $inp_m_kyuyo_s9 = null;
        public $inp_m_kyuyo_s10 = null;
        public $inp_m_kyuyo_s11 = null;
        public $inp_m_kyuyo_s12;
        public $inp_m_kyuyo_s13;
        public $inp_m_kyuyo_e1;
        public $inp_m_kyuyo_e2;
        public $inp_m_kyuyo_e3;
        public $inp_m_kyuyo_e4;
        public $inp_m_kyuyo_e5;
        public $inp_m_kyuyo_e6;
        public $inp_m_kyuyo_kbn = null;
        
        public $oup_m_kyuyo_no;
        public $oup_m_kyuyo_nengetu;
        public $oup_m_kyuyo_k0;
        public $oup_m_kyuyo_name;
        public $oup_m_kyuyo_k1;
        public $oup_m_kyuyo_k2;
        public $oup_m_kyuyo_k3;
        public $oup_m_kyuyo_k4;
        public $oup_m_kyuyo_k5;
        public $oup_m_kyuyo_k6;
        public $oup_m_kyuyo_k7;
        public $oup_m_kyuyo_k8;
        public $oup_m_kyuyo_k9;
        public $oup_m_kyuyo_k10;
        public $oup_m_kyuyo_k11;
        public $oup_m_kyuyo_k12;
        public $oup_m_kyuyo_k13;
        public $oup_m_kyuyo_k14;
        public $oup_m_kyuyo_h1;
        public $oup_m_kyuyo_h2;
        public $oup_m_kyuyo_h3;
        public $oup_m_kyuyo_h4;
        public $oup_m_kyuyo_h5;
        public $oup_m_kyuyo_h6;
        public $oup_m_kyuyo_h7;
        public $oup_m_kyuyo_h8;
        public $oup_m_kyuyo_h9;
        public $oup_m_kyuyo_h10;
        public $oup_m_kyuyo_h11;
        public $oup_m_kyuyo_s1;
        public $oup_m_kyuyo_s2;
        public $oup_m_kyuyo_s3;
        public $oup_m_kyuyo_s4;
        public $oup_m_kyuyo_s5;
        public $oup_m_kyuyo_s6;
        public $oup_m_kyuyo_s7;
        public $oup_m_kyuyo_s8;
        public $oup_m_kyuyo_s9;
        public $oup_m_kyuyo_s10;
        public $oup_m_kyuyo_s11;
        public $oup_m_kyuyo_s12;
        public $oup_m_kyuyo_s13;
        public $oup_m_kyuyo_e1;
        public $oup_m_kyuyo_e2;
        public $oup_m_kyuyo_e3;
        public $oup_m_kyuyo_e4;
        public $oup_m_kyuyo_e5;
        public $oup_m_kyuyo_e6;
        public $oup_m_kyuyo_kbn;
        

        // 入力チェック
        public function inputCheck()
        {
        }
        
        //
        //public function columnKyuyo()
        //{
        //    $db = new Db();
        //
        //    // MySQLへ接続する
        //    $db->connect();
        //
        //    $sql = "select count(*) from information_schema.columns where table_name = '#{t_wk_detail}'; "
        //
        //    // var_dump($sql);
        //
        //    // 文字化け防止
        //    $db->set_charset();
        //
        //    // クエリを送信する
        //    $db->prepare($sql);
        //
        //    // プリペアドクエリを実行する
        //    $db->stmt_execute();
        //
        //    // 結果保持用メモリを開放する
        //    $db->stmt_close();
        //
        //    // MySQLへの接続を閉じる
        //    $db->close();
        //}

        // セレクト
        public function getKyuyo()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_kyuyo_no "
	             . ",   m_kyuyo_nengetu "
	             . ",   m_kyuyo_k0 "
	             . ",   m_kyuyo_name "
	             . ",   m_kyuyo_k1 "
	             . ",   m_kyuyo_k2 "
	             . ",   m_kyuyo_k3 "
	             . ",   m_kyuyo_k4 "
	             . ",   m_kyuyo_k5 "
	             . ",   m_kyuyo_k6 "
	             . ",   m_kyuyo_k7 "
	             . ",   m_kyuyo_k8 "
	             . ",   m_kyuyo_k9 "
	             . ",   m_kyuyo_k10 "
	             . ",   m_kyuyo_k11 "
	             . ",   m_kyuyo_k12 "
	             . ",   m_kyuyo_k13 "
	             . ",   m_kyuyo_k14 "
	             . ",   m_kyuyo_h1 "
	             . ",   m_kyuyo_h2 "
	             . ",   m_kyuyo_h3 "
	             . ",   m_kyuyo_h4 "
	             . ",   m_kyuyo_h5 "
	             . ",   m_kyuyo_h6 "
	             . ",   m_kyuyo_h7 "
	             . ",   m_kyuyo_h8 "
	             . ",   m_kyuyo_h9 "
	             . ",   m_kyuyo_h10 "
	             . ",   m_kyuyo_h11 "
	             . ",   m_kyuyo_s1 "
	             . ",   m_kyuyo_s2 "
	             . ",   m_kyuyo_s3 "
	             . ",   m_kyuyo_s4 "
	             . ",   m_kyuyo_s5 "
	             . ",   m_kyuyo_s6 "
	             . ",   m_kyuyo_s7 "
	             . ",   m_kyuyo_s8 "
	             . ",   m_kyuyo_s9 "
	             . ",   m_kyuyo_s10 "
	             . ",   m_kyuyo_s11 "
	             . ",   m_kyuyo_s12 "
	             . ",   m_kyuyo_s13 "
	             . ",   m_kyuyo_e1 "
	             . ",   m_kyuyo_e2 "
	             . ",   m_kyuyo_e3 "
	             . ",   m_kyuyo_e4 "
	             . ",   m_kyuyo_e5 "
	             . ",   m_kyuyo_e6 "
	             . ",   m_kyuyo_kbn "
	             . ",   m_kyuyo_created "
	             . ",   m_kyuyo_created_id "
	             . ",   m_kyuyo_modified "
	             . ",   m_kyuyo_modified_id "
                 . "FROM "
                 .     "m_kyuyo "
                 . "WHERE 0 = 0 ";
            
            if ($this->inp_m_kyuyo_no != "") {
                $sql .= "AND m_kyuyo_no = '" . $db->escape_string($this->inp_m_kyuyo_no) . "' ";
            }
            if ($this->inp_m_kyuyo_nengetu != "") {
                $sql .= "AND m_kyuyo_nengetu = '" . $db->escape_string($this->inp_m_kyuyo_nengetu). "' ";
            }
            if ($this->inp_m_kyuyo_k0 != "") {
                $sql .= "AND m_kyuyo_k0 = '" . $db->escape_string($this->inp_m_kyuyo_k0). "' ";
            }
            //if ($this->inp_m_kyuyo_prev_k0 != "") {
            //    $sql .= "AND m_kyuyo_k0 < '" . $db->escape_string($this->inp_m_kyuyo_prev_k0). "' ";
            //}
            //if ($this->inp_m_kyuyo_next_k0 != "") {
            //    $sql .= "AND m_kyuyo_k0 > '" . $db->escape_string($this->inp_m_kyuyo_next_k0). "' ";
            //}
            //if ($this->inp_m_tuti_endday != "") {
            //    $sql .= "AND m_tuti_endday = '" . $db->escape_string(substr($this->inp_m_tuti_endday,0,4)."-".substr($this->inp_m_tuti_endday,4,2)."-".substr($this->inp_m_tuti_endday,6,2)) . "' ";
            //}
            //if ($this->inp_m_tuti_day != "") {
            //    $sql .= "AND (m_tuti_startday <= '" . $db->escape_string(substr($this->inp_m_tuti_day,0,4)."-".substr($this->inp_m_tuti_day,4,2)."-".substr($this->inp_m_tuti_day,6,2)) . "' && m_tuti_startday != '0000-00-00')";
            //    $sql .= "AND (m_tuti_endday >= '" . $db->escape_string(substr($this->inp_m_tuti_day,0,4)."-".substr($this->inp_m_tuti_day,4,2)."-".substr($this->inp_m_tuti_day,6,2)) . "' && m_tuti_endday != '0000-00-00')";
            //}
            //if ($this->inp_m_tuti_msg != "") {
            //    $sql .= "AND m_tuti_msg = '" . $db->escape_string($this->inp_m_tuti_msg) . "' ";
            //}
            //if ($this->inp_m_tuti_msg2 != "") {
            //    $sql .= "AND (m_tuti_msg is not null && m_tuti_msg != '') ";
            //}
            if ($this->inp_order == "") {
                $sql .= "ORDER BY m_kyuyo_no  ";
            } else {
                $sql .= $db->escape_string($this->inp_order);
            }
            //if ($this->inp_m_kyuyo_next_k0 != "" || $this->inp_m_kyuyo_prev_k0 != "") {
            //    $sql .= " limit 1";
            //}

//print($sql);
            // SQL実行

            // 文字化け防止
            $db->set_charset();

            // var_dump($sql);

            // プリペアドクエリを実行する
            $result = $db->query($sql, $row);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;

                    $this->oup_m_kyuyo_no[]           = $row[$i++];
                    $this->oup_m_kyuyo_nengetu[]      = $row[$i++];
                    $this->oup_m_kyuyo_k0[]           = $row[$i++];
                    $this->oup_m_kyuyo_name[]           = $row[$i++];
	                $this->oup_m_kyuyo_k1[]          = $row[$i++];
	                $this->oup_m_kyuyo_k2[]          = $row[$i++];
	                $this->oup_m_kyuyo_k3[]          = $row[$i++];
	                $this->oup_m_kyuyo_k4[]          = $row[$i++];
	                $this->oup_m_kyuyo_k5[]          = $row[$i++];
	                $this->oup_m_kyuyo_k6[]          = $row[$i++];
	                $this->oup_m_kyuyo_k7[]          = $row[$i++];
	                $this->oup_m_kyuyo_k8[]       = $row[$i++];
	                $this->oup_m_kyuyo_k9[]        = $row[$i++];
	                $this->oup_m_kyuyo_k10[]        = $row[$i++];
	                $this->oup_m_kyuyo_k11[]        = $row[$i++];
	                $this->oup_m_kyuyo_k12[]        = $row[$i++];
	                $this->oup_m_kyuyo_k13[]      = $row[$i++];
	                $this->oup_m_kyuyo_k14[]       = $row[$i++];
	                $this->oup_m_kyuyo_h1[]           = $row[$i++];
	                $this->oup_m_kyuyo_h2[]           = $row[$i++];
	                $this->oup_m_kyuyo_h3[]           = $row[$i++];
	                $this->oup_m_kyuyo_h4[]           = $row[$i++];
	                $this->oup_m_kyuyo_h5[]           = $row[$i++];
	                $this->oup_m_kyuyo_h6[]           = $row[$i++];
	                $this->oup_m_kyuyo_h7[]           = $row[$i++];
	                $this->oup_m_kyuyo_h8[]        = $row[$i++];
	                $this->oup_m_kyuyo_h9[]         = $row[$i++];
	                $this->oup_m_kyuyo_h10[]         = $row[$i++];
	                $this->oup_m_kyuyo_h11[]         = $row[$i++];
	                $this->oup_m_kyuyo_s1[]     = $row[$i++];
	                $this->oup_m_kyuyo_s2[]     = $row[$i++];
	                $this->oup_m_kyuyo_s3[]     = $row[$i++];
	                $this->oup_m_kyuyo_s4[]     = $row[$i++];
	                $this->oup_m_kyuyo_s5[]     = $row[$i++];
	                $this->oup_m_kyuyo_s6[]     = $row[$i++];
	                $this->oup_m_kyuyo_s7[]     = $row[$i++];
	                $this->oup_m_kyuyo_s8[]  = $row[$i++];
	                $this->oup_m_kyuyo_s9[]   = $row[$i++];
	                $this->oup_m_kyuyo_s10[]   = $row[$i++];
	                $this->oup_m_kyuyo_s11[]   = $row[$i++];
	                $this->oup_m_kyuyo_s12[]   = $row[$i++];
	                $this->oup_m_kyuyo_s13[] = $row[$i++];
	                $this->oup_m_kyuyo_e1[]    = $row[$i++];
	                $this->oup_m_kyuyo_e2[]      = $row[$i++];
	                $this->oup_m_kyuyo_e3[]         = $row[$i++];
	                $this->oup_m_kyuyo_e4[]       = $row[$i++];
	                $this->oup_m_kyuyo_e5[]       = $row[$i++];
	                $this->oup_m_kyuyo_e6[]          = $row[$i++];
	                $this->oup_m_kyuyo_kbn[]          = $row[$i++];
	                $this->oup_m_kyuyo_created[]            = $row[$i++];
	                $this->oup_m_kyuyo_created_id[]         = $row[$i++];
	                $this->oup_m_kyuyo_modified[]           = $row[$i++];
	                $this->oup_m_kyuyo_modified_id[]        = $row[$i++];

                    // var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
            return $result;

            // var_dump($result);

            // MySQLへの接続を閉じる
            $db->close();
        }

        // インサート
        public function insertKyuyo()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO m_kyuyo "
                 . "( "
	             . "    m_kyuyo_nengetu "
	             . ",   m_kyuyo_k0 "
	             . ",   m_kyuyo_name "
	             . ",   m_kyuyo_k1 "
	             . ",   m_kyuyo_k2 "
	             . ",   m_kyuyo_k3 "
	             . ",   m_kyuyo_k4 "
	             . ",   m_kyuyo_k5 "
	             . ",   m_kyuyo_k6 "
	             . ",   m_kyuyo_k7 "
	             . ",   m_kyuyo_k8 "
	             . ",   m_kyuyo_k9 "
	             . ",   m_kyuyo_k10 "
	             . ",   m_kyuyo_k11 "
	             . ",   m_kyuyo_k12 "
	             . ",   m_kyuyo_k13 "
	             . ",   m_kyuyo_k14 "
	             . ",   m_kyuyo_h1 "
	             . ",   m_kyuyo_h2 "
	             . ",   m_kyuyo_h3 "
	             . ",   m_kyuyo_h4 "
	             . ",   m_kyuyo_h5 "
	             . ",   m_kyuyo_h6 "
	             . ",   m_kyuyo_h7 "
	             . ",   m_kyuyo_h8 "
	             . ",   m_kyuyo_h9 "
	             . ",   m_kyuyo_h10 "
	             . ",   m_kyuyo_h11 "
	             . ",   m_kyuyo_s1 "
	             . ",   m_kyuyo_s2 "
	             . ",   m_kyuyo_s3 "
	             . ",   m_kyuyo_s4 "
	             . ",   m_kyuyo_s5 "
	             . ",   m_kyuyo_s6 "
	             . ",   m_kyuyo_s7 "
	             . ",   m_kyuyo_s8 "
	             . ",   m_kyuyo_s9 "
	             . ",   m_kyuyo_s10 "
	             . ",   m_kyuyo_s11 "
	             . ",   m_kyuyo_s12 "
	             . ",   m_kyuyo_s13 "
	             . ",   m_kyuyo_e1 "
	             . ",   m_kyuyo_e2 "
	             . ",   m_kyuyo_e3 "
	             . ",   m_kyuyo_e4 "
	             . ",   m_kyuyo_e5 "
	             . ",   m_kyuyo_e6 "
	             . ",   m_kyuyo_kbn "
	             . ",   m_kyuyo_created "
	             . ",   m_kyuyo_created_id "
	             . ",   m_kyuyo_modified "
	             . ",   m_kyuyo_modified_id "
                 . ") "
                 . "VALUES "
                 . "( "
                 . "     '".$this->inp_m_kyuyo_nengetu."'"
                 . ",    '".$this->inp_m_kyuyo_k0."'"
                 . ",    '".$this->inp_m_kyuyo_name."'"
                 . ",    '".$this->inp_m_kyuyo_k1."'"
                 . ",    '".$this->inp_m_kyuyo_k2."'"
                 . ",    '".$this->inp_m_kyuyo_k3."'"
                 . ",    '".$this->inp_m_kyuyo_k4."'"
                 . ",    '".$this->inp_m_kyuyo_k5."'"
                 . ",    '".$this->inp_m_kyuyo_k6."'"
                 . ",    '".$this->inp_m_kyuyo_k7."'"
                 . ",    '".$this->inp_m_kyuyo_k8."'"
                 . ",    '".$this->inp_m_kyuyo_k9."'"
                 . ",    '".$this->inp_m_kyuyo_k10."'"
                 . ",    '".$this->inp_m_kyuyo_k11."'"
                 . ",    '".$this->inp_m_kyuyo_k12."'"
                 . ",    '".$this->inp_m_kyuyo_k13."'"
                 . ",    '".$this->inp_m_kyuyo_k14."'"
                 . ",    '".$this->inp_m_kyuyo_h1."'"
                 . ",    '".$this->inp_m_kyuyo_h2."'"
                 . ",    '".$this->inp_m_kyuyo_h3."'"
                 . ",    '".$this->inp_m_kyuyo_h4."'"
                 . ",    '".$this->inp_m_kyuyo_h5."'"
                 . ",    '".$this->inp_m_kyuyo_h6."'"
                 . ",    '".$this->inp_m_kyuyo_h7."'"
                 . ",    '".$this->inp_m_kyuyo_h8."'"
                 . ",    '".$this->inp_m_kyuyo_h9."'"
                 . ",    '".$this->inp_m_kyuyo_h10."'"
                 . ",    '".$this->inp_m_kyuyo_h11."'"
                 . ",    '".$this->inp_m_kyuyo_s1."'"
                 . ",    '".$this->inp_m_kyuyo_s2."'"
                 . ",    '".$this->inp_m_kyuyo_s3."'"
                 . ",    '".$this->inp_m_kyuyo_s4."'"
                 . ",    '".$this->inp_m_kyuyo_s5."'"
                 . ",    '".$this->inp_m_kyuyo_s6."'"
                 . ",    '".$this->inp_m_kyuyo_s7."'"
                 . ",    '".$this->inp_m_kyuyo_s8."'"
                 . ",    '".$this->inp_m_kyuyo_s9."'"
                 . ",    '".$this->inp_m_kyuyo_s10."'"
                 . ",    '".$this->inp_m_kyuyo_s11."'"
                 . ",    '".$this->inp_m_kyuyo_s12."'"
                 . ",    '".$this->inp_m_kyuyo_s13."'"
                 . ",    '".$this->inp_m_kyuyo_e1."'"
                 . ",    '".$this->inp_m_kyuyo_e2."'"
                 . ",    '".$this->inp_m_kyuyo_e3."'"
                 . ",    '".$this->inp_m_kyuyo_e4."'"
                 . ",    '".$this->inp_m_kyuyo_e5."'"
                 . ",    '".$this->inp_m_kyuyo_e6."'"
                 . ",    '".$this->inp_m_kyuyo_kbn."'"
                 . ",    '".$this->inp_m_kyuyo_created."'"
                 . ",    '".$this->inp_m_kyuyo_created_id."'"
                 . ",    '".$this->inp_m_kyuyo_modified."'"
                 . ",    '".$this->inp_m_kyuyo_modified_id."'"
                 . ") ";

            // var_dump($sql);

            // 文字化け防止
            $db->set_charset();

            // クエリを送信する
            $db->prepare($sql);

            // プリペアドクエリを実行する
            $db->stmt_execute();

            // 結果保持用メモリを開放する
            $db->stmt_close();

            // MySQLへの接続を閉じる
            $db->close();
        }

        // アップデート
        public function updateKyuyo()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE m_kyuyo SET "
                 . "    m_kyuyo_no                     = '" . $this->inp_m_kyuyo_no . "' ";
            //if ($this->inp_m_kyuyo_k1 != "") {
            //    $sql .= ",   m_kyuyo_k1            = '" . $this->inp_m_kyuyo_k1 . "' ";
            //}
            if (!is_null($this->inp_m_kyuyo_kbn)) {
                $sql .= ",   m_kyuyo_kbn            = '" . $this->inp_m_kyuyo_kbn . "' ";
            }
            for ($i=0;$i<14;$i++) {
                if ($i != 0 && $i != 12 && $i != 13) {
                    if (!is_null($this->{'inp_m_kyuyo_k'.$i})) {
                        $sql .= ",   m_kyuyo_k$i            = '" . $this->{'inp_m_kyuyo_k'.$i} . "' ";
                    }
                    if (!is_null($this->{'inp_m_kyuyo_h'.$i})) {
                        $sql .= ",   m_kyuyo_h$i            = '" . $this->{'inp_m_kyuyo_h'.$i} . "' ";
                    }
                }
                if ($i != 0) {
                    if (!is_null($this->{'inp_m_kyuyo_s'.$i})) {
                        $sql .= ",   m_kyuyo_s$i            = '" . $this->{'inp_m_kyuyo_s'.$i} . "' ";
                    }
                }
            }
            for ($i=2;$i<7;$i++) {
                if ($this->{'inp_m_kyuyo_e'.$i} != "") {
                    $sql .= ",   m_kyuyo_e$i            = '" . $this->{'inp_m_kyuyo_e'.$i} . "' ";
                }
            }
            if ($this->inp_m_kyuyo_modified != "") {
                $sql .= ",   m_kyuyo_modified            = '" . $this->inp_m_kyuyo_modified . "' ";
            }
            if ($this->inp_m_kyuyo_modified_id != "") {
                $sql .= ",   m_kyuyo_modified_id            = '" . $this->inp_m_kyuyo_modified_id . "' ";
            }
            
            $sql .= "WHERE 0 = 0 ";
            $sql .= "AND m_kyuyo_no        = '" . $db->escape_string($this->inp_m_kyuyo_no) . "' ";

             //var_dump($sql);

            // 文字化け防止
            $db->set_charset();

            // クエリを送信する
            $db->prepare($sql);

            // プリペアドクエリを実行する
            $db->stmt_execute();

            // 結果保持用メモリを開放する
            $db->stmt_close();

            // MySQLへの接続を閉じる
            $db->close();
        }

        // デリート
        public function deleteKyuyo()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "DELETE FROM m_kyuyo "
                 . "WHERE ";
            $sql .= "    m_kyuyo_nengetu = '" . $db->escape_string($this->inp_m_kyuyo_nengetu). "' ";
            $sql .= "AND m_kyuyo_k0      = '" . $db->escape_string($this->inp_m_kyuyo_k0). "' ";

            // var_dump($sql);

            // 文字化け防止
            $db->set_charset();

            // クエリを送信する
            $db->prepare($sql);

            // プリペアドクエリを実行する
            $db->stmt_execute();

            // 結果保持用メモリを開放する
            $db->stmt_close();

            // MySQLへの接続を閉じる
            $db->close();
        }
    }
