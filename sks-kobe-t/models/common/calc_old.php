<?php

    $kinmu_time = "";
    $syotei = "480";
    $kin_flg = "";
    //$wk00_o_del_flg = "";
    $ka_sou = "";
    $ka_zan = "";
    $jo_ti = "";
    $jo_zan = "";
    if ($this->inp_shift_ktime != "") {
        $wk00_k = $this->inp_shift_ktime*60;
    }
    if ($this->inp_shift_otime != "") {
        $wk00_o = $this->inp_shift_otime*60;
    }
    if ($this->inp_shift_rtime != "") {
        $wk00_r = $this->inp_shift_rtime*60;
    }
    //$wk00_t = $wk00_r + $wk00_o + $wk00_k;
    //        $wk00_k = ()*60;
    //        $wk00_t = ($shift2_total[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_joban_time[$i]][$wkdetail->oup_t_wk_plan_kaban_time[$i]])*60;
    //        $wk00_o = ($shift2_ovr[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_joban_time[$i]][$wkdetail->oup_t_wk_plan_kaban_time[$i]])*60;
    //        $wk00 = ($shift2_rod[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_joban_time[$i]][$wkdetail->oup_t_wk_plan_kaban_time[$i]])*60;
    if ($this->inp_joban_kbn != "") {
        $calc_joban_kbn = $this->inp_joban_kbn;
    }
    if ($this->inp_plan_kbn != "") {
        $calc_plan_kbn = $this->inp_plan_kbn;
    }
    if ($this->inp_plan_joban_time != "") {
        $calc_plan_joban_time = $this->inp_plan_joban_time;
    }
    if ($this->inp_plan_kaban_time != "") {
        $calc_plan_kaban_time = $this->inp_plan_kaban_time;
    }
    if ($this->inp_joban_time != "") {
        $calc_joban_time = $this->inp_joban_time;
    }
    if ($this->inp_kaban_time != "") {
        $calc_kaban_time = $this->inp_kaban_time;
    }

    //合計勤務時間
    //シフトの労働、所定残、休憩時間から取得
    //$wk00_t = $wk00_r + $wk00_o + $wk00_k;

    //シフトの所定開始～終了時間から取得
    //通常勤務
    if (sprintf('%02d',($calc_plan_joban_time))*60+substr($calc_plan_joban_time,3,2) < sprintf('%02d',($calc_plan_kaban_time))*60+substr($calc_plan_kaban_time,3,2)) {
        $wk00_t = (sprintf('%02d',($calc_plan_kaban_time))*60+substr($calc_plan_kaban_time,3,2)) - (sprintf('%02d',($calc_plan_joban_time))*60+substr($calc_plan_joban_time,3,2));
    //泊まり
    } elseif (sprintf('%02d',($calc_plan_joban_time))*60+substr($calc_plan_joban_time,3,2) == sprintf('%02d',($calc_plan_kaban_time))*60+substr($calc_plan_kaban_time,3,2)) {
        $wk00_t = 1440;
    //日をまたぐ勤務
    } elseif (sprintf('%02d',($calc_plan_joban_time))*60+substr($calc_plan_joban_time,3,2) > sprintf('%02d',($calc_plan_kaban_time))*60+substr($calc_plan_kaban_time,3,2)) {
        $wk00_t = 1440 - ((sprintf('%02d',($calc_plan_joban_time))*60+substr($calc_plan_joban_time,3,2)) - (sprintf('%02d',($calc_plan_kaban_time))*60+substr($calc_plan_kaban_time,3,2)));
    }
    //if ($calc_joban_kbn=="4") {
    //    $kinmu_time = 0;
    //    $syotei_otime = 0;
    //    $hayazan_time = 0;
    //    $tuzan_time = 0;
    //} else if ($calc_joban_kbn=="5") {
    //    $kinmu_time = 0;
    //    $syotei_otime = 0;
    //    $hayazan_time = 0;
    //    $tuzan_time = 0;
    //} else {
    if ($calc_joban_kbn != "4" && $calc_joban_kbn != "5") {
        if ($calc_plan_kbn == 1 || $calc_plan_kbn == 2 || $calc_plan_kbn == 3) {
            if ($wk00_r!=0) {
                    if (($calc_plan_joban_time == $calc_joban_time && $calc_plan_kaban_time == $calc_kaban_time) || $calc_kaban_time == "" || $calc_joban_time == "" || ($calc_joban_time == "" && $calc_kaban_time == "")) {
                        $kinmu_time = sprintf('%02d',($wk00_r/60)).":".sprintf('%02d',($wk00_r%60));
                        if ($wk00_o == 0) {
                            $syotei_otime = 0;
                        } else {
                            $syotei_otime = $wk00_o;
                        }
                        $hayazan_time = 0;
                        $tuzan_time = 0;
                    } else {
                        if ($calc_plan_joban_time < $calc_joban_time || ($calc_plan_kaban_time > $calc_kaban_time && $calc_joban_time < $calc_kaban_time) || ($calc_plan_kbn == 1 && $calc_plan_joban_time < $calc_joban_time) ||
                        ($calc_plan_kbn == 1 && $calc_plan_kaban_time > $calc_kaban_time) || ($calc_plan_joban_time > $calc_plan_kaban_time && $calc_plan_kaban_time > $calc_kaban_time) || ($calc_plan_joban_time > $calc_plan_kaban_time && $calc_joban_time < $calc_kaban_time)) {
                            $kin_flg = 4;
                            if ($calc_joban_time > $calc_kaban_time && $calc_plan_joban_time < $calc_plan_kaban_time) {
                                $plus = 1440;
                            } elseif ($calc_plan_joban_time > $calc_plan_kaban_time && $calc_joban_time < $calc_kaban_time) {
                                $plus = -1440;
                            } else {
                                $plus = 0;
                            }
                                $joban_time = sprintf('%02d',($calc_joban_time))*60 + substr($calc_joban_time,3,2);
                                $kaban_time = sprintf('%02d',($calc_kaban_time))*60 + substr($calc_kaban_time,3,2);
                                $plan_joban_time = sprintf('%02d',($calc_plan_joban_time))*60 + substr($calc_plan_joban_time,3,2);
                                $plan_kaban_time = sprintf('%02d',($calc_plan_kaban_time))*60 + substr($calc_plan_kaban_time,3,2);
                                $kinmu_time = $wk00_t + $plus;
                                
                                if ($calc_plan_joban_time > $calc_joban_time) {
                                    $hayazan = $plan_joban_time - $joban_time;
                                    $kinmu_time = $kinmu_time + $hayazan;
                                }
                                if ($calc_plan_joban_time < $calc_joban_time) {
                                    $tikoku = $joban_time - $plan_joban_time;
                                    $kinmu_time = $kinmu_time - $tikoku;
                                }
                                if ($calc_plan_kaban_time < $calc_kaban_time) {
                                    $tuzan = $kaban_time - $plan_kaban_time;
                                    $kinmu_time = $kinmu_time + $tuzan;
                                }
                                if ($calc_plan_kaban_time > $calc_kaban_time) {
                                    $sotai = $plan_kaban_time - $kaban_time;
                                    $kinmu_time = $kinmu_time - $sotai;
                                }
                                
                                if ($kinmu_time < $syotei) {
                                    $calc_kinmu_time = $kinmu_time;
                                    $kinmu_time = sprintf('%02d',($kinmu_time/60)).":".sprintf('%02d',($kinmu_time%60));
                                } else {
                                    //計算用
                                    $calc_kinmu_time = $kinmu_time;
                                    //DB登録用
                                    $kinmu_time = sprintf('%02d',($syotei/60)).":".sprintf('%02d',($syotei%60));
                                }
                                
                                $syotei_otime = 0;
                                //var_dump($calc_kinmu_time,$kinmu_time);
                                //exit;
                        } else {
                            //早出+
                            if ($calc_joban_time != "" && $calc_plan_joban_time != $calc_joban_time && $calc_kaban_time != "") {
                                if ($calc_plan_joban_time > $calc_joban_time) {
                                    $plan_joban_time = sprintf('%02d',($calc_plan_joban_time))*60 + substr($calc_plan_joban_time,3,2);
                                    $joban_time = sprintf('%02d',($calc_joban_time))*60 + substr($calc_joban_time,3,2);
                                    $jo_zan = $plan_joban_time - $joban_time;
                                }
                            }
                            //遅刻-
                            if ($calc_joban_time != "" && $calc_plan_joban_time != $calc_joban_time && $calc_kaban_time != "") {
                                if ($calc_plan_joban_time < $calc_joban_time) {
                                    $plan_joban_time = sprintf('%02d',($calc_plan_joban_time))*60 + substr($calc_plan_joban_time,3,2);
                                    $joban_time = sprintf('%02d',($calc_joban_time))*60 + substr($calc_joban_time,3,2);
                                    $jo_ti = $joban_time - $plan_joban_time;
                                }
                            }
                            //残業+
                            if ($calc_kaban_time != "" && $calc_plan_kaban_time != $calc_kaban_time && $calc_joban_time != "") {
                                if ($calc_plan_kaban_time < $calc_kaban_time) {
                                    $plan_kaban_time = sprintf('%02d',($calc_plan_kaban_time))*60 + substr($calc_plan_kaban_time,3,2);
                                    $kaban_time = sprintf('%02d',($calc_kaban_time))*60 + substr($calc_kaban_time,3,2);
                                    $ka_zan = $kaban_time - $plan_kaban_time;
                                }
                            }
                            //早退-
                            if ($calc_kaban_time != "" && $calc_plan_kaban_time != $calc_kaban_time && $calc_joban_time != "") {
                                if ($calc_plan_kaban_time > $calc_kaban_time) {
                                    $plan_kaban_time = sprintf('%02d',($calc_plan_kaban_time))*60 + substr($calc_plan_kaban_time,3,2);
                                    $kaban_time = sprintf('%02d',($calc_kaban_time))*60 + substr($calc_kaban_time,3,2);
                                    $ka_sou = $plan_kaban_time - $kaban_time;
                                }
                            }
                            $kinmu_time = $wk00_t;
                            if ($ka_sou != "") {
                                $kinmu_time = $kinmu_time - $ka_sou;
                            }
                            if ($ka_zan != "") {
                                $kinmu_time = $kinmu_time + $ka_zan;
                            }
                            if ($jo_ti != "") {
                                $kinmu_time = $kinmu_time - $jo_ti;
                            }
                            if ($jo_zan != "") {
                                $kinmu_time = $kinmu_time + $jo_zan;
                            }
                            //日をまたいだ勤務の場合(日勤、夜勤)
                            if ($calc_plan_joban_time > $calc_kaban_time || $plan_kbn == 1) {
                                $kinmu_time = $kinmu_time + 1440;
                                if ($calc_plan_joban_time > $calc_plan_kaban_time) {
                                    $kinmu_time = $kinmu_time - 1440;
                                }
                            }
                            if ($wk00_t < $kinmu_time) {
                                if ($wk00_o != 0) {
                                        $syotei_otime = $wk00_o;
                                        //計算用
                                        $calc_kinmu_time = $kinmu_time;
                                        //DB登録用
                                        $kinmu_time = sprintf('%02d',($wk00_r/60)).":".sprintf('%02d',($wk00_r%60));
                                        $kin_flg = 1;
                                } else {
                                    $syotei_otime = 0;
                                        //計算用
                                        $calc_kinmu_time = $kinmu_time;
                                        //DB登録用
                                        $kinmu_time = sprintf('%02d',($wk00_r/60)).":".sprintf('%02d',($wk00_r%60));
                                        $kin_flg = 1;
                                }
                            } else {
                                if ($wk00_o != 0) {
                                    $syotei_otime = 0;
                                    $kinmu_time = sprintf('%02d',($kinmu_time/60)).":".sprintf('%02d',($kinmu_time%60));
                                } else {
                                    $syotei_otime = 0;
                                    $kinmu_time = sprintf('%02d',($kinmu_time/60)).":".sprintf('%02d',($kinmu_time%60));
                                }
                            }
                        }
                    }
            }
        } elseif ($calc_plan_kbn == 6) {
            if ($calc_joban_time != "" && $calc_kaban_time != "") {
            //print("<font color=\"red\">");
                $joban_time = sprintf('%02d',($calc_joban_time))*60 + substr($calc_joban_time,3,2);
                $kaban_time = sprintf('%02d',($calc_kaban_time))*60 + substr($calc_kaban_time,3,2);
                if ($joban_time > $kaban_time) {
                    $kinmu_time = $joban_time - $kaban_time;
                    if ($kinmu_time < $syotei) {
                        $calc_kinmu_time = $kinmu_time;
                        $kinmu_time = sprintf('%02d',($kinmu_time/60)).":".sprintf('%02d',($kinmu_time%60));
                    } else {
                        //計算用
                        $calc_kinmu_time = $kinmu_time;
                        //DB登録用
                        $kinmu_time = sprintf('%02d',($syotei/60)).":".sprintf('%02d',($syotei%60));
                    }
                }
                elseif ($joban_time < $kaban_time) {
                    $kinmu_time = $kaban_time - $joban_time;
                    if ($kinmu_time < $syotei) {
                        $calc_kinmu_time = $kinmu_time;
                        $kinmu_time = sprintf('%02d',($kinmu_time/60)).":".sprintf('%02d',($kinmu_time%60));
                    } else {
                        //計算用
                        $calc_kinmu_time = $kinmu_time;
                        //DB登録用
                        $kinmu_time = sprintf('%02d',($syotei/60)).":".sprintf('%02d',($syotei%60));
                    }
                }
                //print("</font>");
            } else {
                $kinmu_time = 0;
                $syotei_otime = 0;
                $hayazan_time = 0;
                $tuzan_time = 0;
            }
        } else {
            $kinmu_time = 0;
            $syotei_otime = 0;
            $hayazan_time = 0;
            $tuzan_time = 0;
        }
    //}
    
    if (($calc_plan_kbn == 1 || $calc_plan_kbn == 2 || $calc_plan_kbn == 3) && $kin_flg != "") {
        if ($kin_flg == 4) {
        $plan_jtime = sprintf("%02d",substr($calc_plan_joban_time,0,2))*60+substr($calc_plan_joban_time,3,2);
        $plan_ktime = sprintf("%02d",substr($calc_plan_kaban_time,0,2))*60+substr($calc_plan_kaban_time,3,2);
        $jtime = sprintf("%02d",substr($calc_joban_time,0,2))*60+substr($calc_joban_time,3,2);
        $ktime = sprintf("%02d",substr($calc_kaban_time,0,2))*60+substr($calc_kaban_time,3,2);
            //if ($calc_plan_joban_time > $calc_joban_time) {
            if (($calc_plan_joban_time > $calc_joban_time && $calc_plan_kbn != 3)
            || ($calc_plan_kbn == 3 && $calc_plan_joban_time > $calc_joban_time && $calc_kaban_time < $calc_joban_time && $calc_plan_kaban_time < $calc_plan_joban_time)
            || ($calc_plan_kbn == 3 && $calc_plan_joban_time > $calc_joban_time && $calc_plan_kaban_time > $calc_plan_joban_time)) {
                $tuzan_time = 0;
                $hayazan_time = $plan_jtime - $jtime;
                $kinmu_time = $calc_kinmu_time - $hayazan_time;
                //所定残有り、勤務時間8時間超え
                if ($wk00_o != 0 && $kinmu_time > $syotei) {
                //  7/21
                    //$kinmu_time = $kinmu_time - $hayazan_time;
                    //$tuzan_time = $wk00_o - $hayazan_time;
                    $tuzan_time = $kinmu_time - $syotei;
                    $kinmu_time = $syotei;
                    
                    $tuzan_time = sprintf('%02d',($tuzan_time/60)).":".sprintf('%02d',($tuzan_time%60));
                }
                if (($calc_plan_kbn == 1 && $kinmu_time > $syotei) || ($calc_plan_kbn == 3 && $kinmu_time > $syotei)) {
                    $kinmu_time = $syotei;
                    $tuzan_time = $calc_kinmu_time - $hayazan_time - $syotei;
                    $tuzan_time = sprintf('%02d',($tuzan_time/60)).":".sprintf('%02d',($tuzan_time%60));
                }
                $hayazan_time = sprintf('%02d',($hayazan_time/60)).":".sprintf('%02d',($hayazan_time%60));
                $kinmu_time = sprintf('%02d',($kinmu_time/60)).":".sprintf('%02d',($kinmu_time%60));
            } elseif (($calc_plan_joban_time <= $calc_joban_time && $calc_plan_kaban_time >= $calc_kaban_time && $calc_joban_time < $calc_kaban_time) ||
                ($calc_plan_joban_time <= $calc_joban_time && $calc_plan_kaban_time >= $calc_kaban_time && $calc_plan_joban_time > $calc_plan_kaban_time) ||
                ($calc_plan_joban_time <= $calc_joban_time && $calc_plan_kaban_time >= $calc_kaban_time && $calc_plan_joban_time == $calc_plan_kaban_time)) {
                if ($calc_kinmu_time > $wk00_r && $calc_kinmu_time < $wk00_t) {
                    $tuzan_time = $calc_kinmu_time - (sprintf("%02d",substr($kinmu_time,0,2))*60+substr($kinmu_time,3,2));
                    $tuzan_time = sprintf('%02d',($tuzan_time/60)).":".sprintf('%02d',($tuzan_time%60));
                    $hayazan_time = 0;
                } elseif ($calc_kinmu_time > $syotei) {
                    $hayazan_time = 0;
                    $tuzan_time = $calc_kinmu_time - (sprintf("%02d",substr($kinmu_time,0,2))*60+substr($kinmu_time,3,2));
                    $tuzan_time = sprintf('%02d',($tuzan_time/60)).":".sprintf('%02d',($tuzan_time%60));
                } else {
                    $hayazan_time = 0;
                    $tuzan_time = 0;
                }
            } else {
                if ($calc_plan_joban_time > $calc_plan_kaban_time && $calc_joban_time < $calc_kaban_time) {
                    $hayazan_time = 0;
                    $tuzan_time = 0;
                } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                    $hayazan_time = 0;
                    $tuzan_time = $ktime - $plan_ktime;
                    $kinmu_time = $calc_kinmu_time - $tuzan_time;
                    if ($wk00_o != 0 && $kinmu_time > $syotei) {
                        $kinmu_time = $kinmu_time - $tuzan_time;
                        $tuzan_time = $tuzan_time + $wk00_o - $tuzan_time;
                    }
                    if (($calc_plan_kbn == 1 && $kinmu_time > $syotei) || ($calc_plan_kbn == 3 && $kinmu_time > $syotei)) {
                        $kinmu_time = $syotei;
                        $tuzan_time = $calc_kinmu_time - $syotei;
                    }
                    $tuzan_time = sprintf('%02d',($tuzan_time/60)).":".sprintf('%02d',($tuzan_time%60));
                    $kinmu_time = sprintf('%02d',($kinmu_time/60)).":".sprintf('%02d',($kinmu_time%60));
                } else {
                    $hayazan_time = 0;
                    $kinmu_time = $plan_ktime - $jtime;
                    $tuzan_time = $calc_kinmu_time - $kinmu_time;
                    if ($wk00_o != 0 && $kinmu_time > $syotei) {
                        $tuzan_time = $tuzan_time + ($kinmu_time-$syotei);
                        $kinmu_time = $kinmu_time - ($kinmu_time-$syotei);
                    }
                    $tuzan_time = sprintf('%02d',($tuzan_time/60)).":".sprintf('%02d',($tuzan_time%60));
                    $kinmu_time = sprintf('%02d',($kinmu_time/60)).":".sprintf('%02d',($kinmu_time%60));
                }
                //echo '&nbsp;';
            }
        } elseif ($kin_flg == 1) {
                if ($calc_plan_kaban_time == $calc_kaban_time && $calc_plan_joban_time > $calc_joban_time) {
                    $hayazan_time = $calc_kinmu_time - $wk00_t;
                    $hayazan_time = sprintf('%02d',($hayazan_time/60)).":".sprintf('%02d',($hayazan_time%60));
                    $tuzan_time = 0;
                } else if ($calc_plan_joban_time == $calc_joban_time) {
                    $tuzan_time = $calc_kinmu_time - $wk00_t;
                    $hayazan_time = 0;
                    $tuzan_time = sprintf('%02d',($tuzan_time/60)).":".sprintf('%02d',($tuzan_time%60));
                } else  {
                    $joban_time1 = sprintf('%02d',($calc_plan_joban_time))*60 + substr($calc_plan_joban_time,3,2);
                    $joban_time2 = sprintf('%02d',($calc_joban_time))*60 + substr($calc_joban_time,3,2);
                    $hayazan_time = $joban_time1 - $joban_time2;
                    $tuzan_time = $calc_kinmu_time - $hayazan_time - $wk00_t;
                    $hayazan_time = sprintf('%02d',($hayazan_time/60)).":".sprintf('%02d',($hayazan_time%60));
                    $tuzan_time = sprintf('%02d',($tuzan_time/60)).":".sprintf('%02d',($tuzan_time%60));
                }
        } else {
            $hayazan_time = 0;
            $tuzan_time = 0;
            //echo '&nbsp;';
        }
    } elseif ($calc_plan_kbn == 6) {
        if ($calc_joban_time != "" && $calc_kaban_time != "" && $calc_kinmu_time > $syotei) {
            $tuzan_time = $calc_kinmu_time - $syotei;
            $hayazan_time = 0;
            $tuzan_time = sprintf('%02d',($tuzan_time/60)).":".sprintf('%02d',($tuzan_time%60));
        } else {
            $hayazan_time = 0;
            $tuzan_time = 0;
            //echo '&nbsp;';
        }
    }
    
    if ($this->inp_kaban_time == "" || $this->inp_joban_time == "") {
        //$this->kinmu_time       = ($wk00_r/60).".".(sprintf("%02d",$wk00_r%60));
        $this->kinmu_time       = $wk00_r;
        $this->syotei_otime       = $syotei_otime;
        $this->hayazan_time       = 0;
        $this->tuzan_time       = 0;
    } else {
        //$this->kinmu_time       = substr($kinmu_time,0,2).".".substr($kinmu_time,3,2);
        //$this->kinmu_time       = ((substr($kinmu_time,0,2)*60)+substr($kinmu_time,3,2))/60;
        
        //KICTのみ15分刻みで計算
        //if (sprintf("%01d",substr($kinmu_time,3,2)%15 != 0) && $this->inp_genba_id == 6) {
        //    $calc1 = sprintf("%01d",substr($kinmu_time,3,2));
        //    $calc2 = 15;
        //    if ($calc1%$calc2 < 5) {
        //        $this->kinmu_time       = substr($kinmu_time,0,2)*60+($calc2*floor($calc1/$calc2));
        //    } else {
        //        $this->kinmu_time       = substr($kinmu_time,0,2)*60+($calc2*ceil($calc1/$calc2));
        //    }
        //} else {
            //KICT以外
            $this->kinmu_time       = substr($kinmu_time,0,2)*60+substr($kinmu_time,3,2);
        //}
        $this->syotei_otime       = $syotei_otime;
        
        //KICTのみ15分刻みで計算
        //if (sprintf("%01d",substr($hayazan_time,3,2)%15 != 0) && $this->inp_genba_id == 6) {
        //    $calc1 = sprintf("%01d",substr($hayazan_time,3,2));
        //    $calc2 = 15;
        //    if ($calc1%$calc2 < 5) {
        //        $this->hayazan_time       = substr($hayazan_time,0,2)*60+($calc2*floor($calc1/$calc2));
        //    } else {
        //        $this->hayazan_time       = substr($hayazan_time,0,2)*60+($calc2*ceil($calc1/$calc2));
        //    }
        //} else {
            //KICT以外
            $this->hayazan_time       = substr($hayazan_time,0,2)*60+substr($hayazan_time,3,2);
        //}

        //KICTのみ15分刻みで計算
        if (sprintf("%01d",substr($tuzan_time,3,2)%15 != 0) && $this->inp_genba_id == 6) {
            $calc1 = sprintf("%01d",substr($tuzan_time,3,2));
            $calc2 = 15;
            //var_dump($calc1);
            //exit;
            if ($calc1%$calc2 < 5) {
                $this->tuzan_time       = substr($tuzan_time,0,2)*60+($calc2*floor($calc1/$calc2));
            } else {
                $this->tuzan_time       = substr($tuzan_time,0,2)*60+($calc2*ceil($calc1/$calc2));
            }
            //if ($calc1/$calc2 >= 1) {
            //    if ($calc1%$calc2 < 5) {
            //        $this->tuzan_time       = substr($tuzan_time,0,2)*60+($calc1 - $calc1%$calc2);
            //    } else {
            //        $this->tuzan_time       = substr($tuzan_time,0,2)*60+($calc2*ceil($calc1/$calc2));
            //    }
            //} else {
            //    if ($calc1/5 < 1) {
            //        $this->tuzan_time       = substr($tuzan_time,0,2)*60+0;
            //    } else {
            //        $this->tuzan_time       = substr($tuzan_time,0,2)*60+$calc2;
            //    }
            //}
        } else {
            //KICT以外
            $this->tuzan_time       = substr($tuzan_time,0,2)*60+substr($tuzan_time,3,2);
        }
    }
    //var_dump($this->kinmu_time,$this->syotei_otime,$this->hayazan_time,$this->tuzan_time);
    //exit;
    } else {
        $this->kinmu_time       = 0;
        $this->syotei_otime       = 0;
        $this->hayazan_time       = 0;
        $this->tuzan_time       = 0;
    }

?>