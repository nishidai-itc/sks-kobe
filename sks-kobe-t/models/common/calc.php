<?php

    $kinmu_flg = "";
    $kinmu_time = 0;
    $kinmu_otime = 0;
    $hayade = 0;
    $tikoku = 0;
    $soutai = 0;
    $zan = 0;
    $hayazan = 0;
    $tuzan = 0;
    $kinmu_syotei = 0;
    $kinmu_kyukei = 0;
    $syotei = 480;

    if ($this->inp_shift_ktime != "") {
        $wk00_k = $this->inp_shift_ktime*60;
    }
    if ($this->inp_shift_otime != "") {
        $wk00_o = $this->inp_shift_otime*60;
    }
    if ($this->inp_shift_rtime != "") {
        $wk00_r = $this->inp_shift_rtime*60;
    }

    //勤務区分
    if ($this->inp_plan_kbn != "") {
        $calc_plan_kbn = $this->inp_plan_kbn;
    }
    //上番区分
    if ($this->inp_joban_kbn != "") {
        $calc_joban_kbn = $this->inp_joban_kbn;
    }
    //所定上番時刻
    if ($this->inp_plan_joban_time != "") {
        $calc_plan_joban_time = sprintf("%02d",$this->inp_plan_joban_time)*60+substr($this->inp_plan_joban_time,3,2)+1440;
    }
    //所定下番時刻
    if ($this->inp_plan_kaban_time != "") {
        $calc_plan_kaban_time = sprintf("%02d",$this->inp_plan_kaban_time)*60+substr($this->inp_plan_kaban_time,3,2)+1440;
    }
    //実績上番時刻
    if ($this->inp_joban_time != "") {
        $calc_joban_time = sprintf("%02d",$this->inp_joban_time)*60+substr($this->inp_joban_time,3,2)+1440;
    }
    //実績下番時刻
    if ($this->inp_kaban_time != "") {
        $calc_kaban_time = sprintf("%02d",$this->inp_kaban_time)*60+substr($this->inp_kaban_time,3,2)+1440;
    }
    //var_dump($calc_plan_kbn,$calc_joban_kbn,$calc_plan_joban_time,$calc_plan_kaban_time,$calc_joban_time,$calc_kaban_time);
    //exit;

    //上番区分が年休、欠勤、勤務区分が年休以外
    if ($calc_joban_kbn != "4" && $calc_joban_kbn != "5" && $calc_plan_kbn != "4") {
    
        //上番区分が年休、欠勤、勤務区分が年休、時給以外
        //シフトの所定開始、終了から勤務予定合計時間を取得
        if ($calc_plan_kbn != "6") {
            //通常勤務
            if ($calc_plan_joban_time < $calc_plan_kaban_time) {
                $wk00_t = $calc_plan_kaban_time - $calc_plan_joban_time;
            //泊まり
            } elseif ($calc_plan_joban_time == $calc_plan_kaban_time) {
                $wk00_t = 1440;
            //日をまたぐ勤務
            } elseif ($calc_plan_joban_time > $calc_plan_kaban_time) {
                $wk00_t = 1440 - ($calc_plan_joban_time - $calc_plan_kaban_time);
            }
        }
        
        //実績上番か下番が空なら計算しない
        if ($calc_joban_time != "" && $calc_kaban_time != "") {
            
            //実績労働時間を取得
            //24時間
            if ($calc_joban_time == $calc_kaban_time) {
                $kinmu_time = 1440;
            //通常
            } elseif ($calc_joban_time < $calc_kaban_time) {
                $kinmu_time = $calc_kaban_time - $calc_joban_time;
            //日をまたぐ　elseif ($calc_joban_time > $calc_kaban_time)
            } else {
                $kinmu_time = 1440 - ($calc_joban_time - $calc_kaban_time);
            }
            $kinmu_time_total = $kinmu_time;
            //var_dump($calc_plan_kbn,$wk00_t,$kinmu_time,$calc_joban_time,$calc_kaban_time);
            //exit;
            
            //勤務区分が泊、日勤、夜勤
            if ($calc_plan_kbn == 1 || $calc_plan_kbn == 2 || $calc_plan_kbn == 3) {
            
                ////シフトの労働時間がゼロ以外
                //if ($wk00_r != 0) {
                
                //勤務予定時間と実績時間が全く同じ場合
                if ($calc_plan_joban_time == $calc_joban_time && $calc_plan_kaban_time == $calc_kaban_time) {
                    $kinmu_time = $wk00_r;
                    if ($wk00_o == 0) {
                        $kinmu_otime = 0;
                    } else {
                        $kinmu_otime = $wk00_o;
                    }
                    $hayazan = 0;
                    $tuzan = 0;
                } else {
                
                    //勤務区分が泊
                    if ($calc_plan_kbn == 1) {
                        
                        //日をまたぐ勤務or合計時間が同じで開始、終了が違う勤務
                        if ($calc_joban_time > $calc_kaban_time || $calc_joban_time == $calc_kaban_time) {
                            //早出、遅刻
                            if ($calc_plan_joban_time > $calc_joban_time) {
                                $hayade = $calc_plan_joban_time - $calc_joban_time;
                            } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                $tikoku = $calc_joban_time - $calc_plan_joban_time;
                            }
                            //残業、早退
                            if ($calc_plan_kaban_time > $calc_kaban_time) {
                                $soutai = $calc_plan_kaban_time - $calc_kaban_time;
                            } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                $zan = $calc_kaban_time - $calc_plan_kaban_time;
                            }
                        //日をまたがない勤務
                        } elseif ($calc_joban_time < $calc_kaban_time) {
                            //早出、遅刻
                            if ($calc_plan_joban_time > $calc_joban_time) {
                                $hayade = $calc_plan_joban_time - $calc_joban_time;
                            } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                $tikoku = $calc_joban_time - $calc_plan_joban_time;
                            }
                            //残業、早退
                            if ($calc_plan_kaban_time > $calc_kaban_time) {
                                $soutai = $calc_plan_kaban_time - $calc_kaban_time;
                            } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                $soutai = 1440 - ($calc_kaban_time - $calc_plan_kaban_time);
                            } else {
                                $soutai = 1440;
                            }
                        }
                        //var_dump($calc_plan_kbn,$wk00_t,$kinmu_time,$hayade,$tikoku,$soutai,$zan);
                        //exit;
                        
                        //実績の上番、下番時間別にフラグを立てる
                        //所定内の勤務時間
                        if ($tikoku != "" && $soutai == "") {
                            $kinmu_flg = 1;
                            $calc_kinmu_time = $kinmu_time - $zan;
                        } elseif ($tikoku == "" && $soutai != "") {
                            $kinmu_flg = 2;
                            $calc_kinmu_time = $kinmu_time - $hayade;
                        } else {
                            $kinmu_flg = 3;
                            $calc_kinmu_time = $kinmu_time;
                        }
                        
                        //シフトに所定残業がある場合
                        if ($wk00_o != 0) {
                            
                            //所定と実績合計時間が同じ場合
                            if ($kinmu_time == $wk00_t) {
                                //所定労働時間より所定内勤務時間の方が少ないor同じ場合
                                if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                                    $hayazan = $hayade;
                                    $tuzan = $zan;
                                    $kinmu_time = $calc_kinmu_time;
                                    $kinmu_otime = 0;
                                //所定労働時間より所定内勤務時間の方が多い場合
                                } else {
                                    //所定残業
                                    $kinmu_syotei = $calc_kinmu_time - $wk00_r;
                                    //計算
                                    if ($wk00_o > $kinmu_syotei || $wk00_o == $kinmu_syotei) {
                                        $kinmu_otime = $kinmu_syotei;
                                    } else {
                                        $kinmu_otime = $wk00_o;
                                    }
                                    
                                    if ($kinmu_flg == 1) {
                                        $hayazan = 0;
                                        $tuzan = $zan + ($calc_kinmu_time - $wk00_r - $kinmu_otime);
                                    } elseif ($kinmu_flg == 2) {
                                        $tuzan = $calc_kinmu_time - $wk00_r - $kinmu_otime;
                                        $hayazan = $hayade;
                                    }
                                    $kinmu_time = $wk00_r;
                                }
                            } else {
                                if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                                    $hayazan = $hayade;
                                    $tuzan = $zan;
                                    $kinmu_time = $calc_kinmu_time;
                                    $kinmu_otime = 0;
                                } else {
                                    //所定残業
                                    $kinmu_syotei = $calc_kinmu_time - $wk00_r;
                                    //計算
                                    if ($wk00_o > $kinmu_syotei || $wk00_o == $kinmu_syotei) {
                                        $kinmu_otime = $kinmu_syotei;
                                    } else {
                                        $kinmu_otime = $wk00_o;
                                    }
                                    
                                    if ($kinmu_flg == 1) {
                                        $hayazan = 0;
                                        $tuzan = $zan + ($calc_kinmu_time - $wk00_r - $kinmu_otime);
                                    } elseif ($kinmu_flg == 2) {
                                        $tuzan = $calc_kinmu_time - $wk00_r - $kinmu_otime;
                                        $hayazan = $hayade;
                                    } else {
                                        $tuzan = $calc_kinmu_time - $wk00_r - $kinmu_otime;
                                        $hayazan = $hayade;
                                    }
                                    $kinmu_time = $wk00_r;
                                }
                            }
                        //シフトに所定残業がない場合
                        } else {
                            //所定と実績合計時間が同じ場合
                            if ($kinmu_time == $wk00_t) {
                                //所定労働時間より所定内勤務時間の方が少ないor同じ場合
                                if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                                    $hayazan = $hayade;
                                    $tuzan = $zan;
                                    $kinmu_time = $calc_kinmu_time;
                                    $kinmu_otime = 0;
                                //所定労働時間より所定内勤務時間の方が多い場合
                                } else {
                                    if ($kinmu_flg == 1) {
                                        $hayazan = 0;
                                        $tuzan = $zan + ($kinmu_time - $wk00_r - $zan);
                                    } elseif ($kinmu_flg == 2) {
                                        $tuzan = $kinmu_time - $wk00_r - $hayade;
                                        $hayazan = $kinmu_time - $wk00_r - $tuzan;
                                    }
                                    $kinmu_time = $wk00_r;
                                    $kinmu_otime = 0;
                                }
                            } else {
                                if ($calc_kinmu_time < $wk00_r) {
                                    $hayazan = $hayade;
                                    $tuzan = $zan;
                                    $kinmu_time = $calc_kinmu_time;
                                    $kinmu_otime = 0;
                                } elseif ($calc_kinmu_time == $wk00_r) {
                                    $hayazan = $hayade;
                                    $tuzan = $zan;
                                    $kinmu_time = $calc_kinmu_time;
                                    $kinmu_otime = 0;
                                } else {
                                    if ($kinmu_flg == 1) {
                                        $hayazan = 0;
                                        $tuzan = $zan + ($kinmu_time - $wk00_r - $zan);
                                    } elseif ($kinmu_flg == 2) {
                                        $tuzan = $kinmu_time - $wk00_r - $hayade;
                                        $hayazan = $kinmu_time - $wk00_r - $tuzan;
                                    } else {
                                        $hayazan = 0;
                                        $tuzan = $kinmu_time - $wk00_r;
                                    }
                                    $kinmu_time = $wk00_r;
                                    $kinmu_otime = 0;
                                }
                            }
                        }
                        //var_dump($calc_plan_kbn,"所".$wk00_t,"実".$kinmu_time,"早".$hayazan,"残".$tuzan,"所残".$kinmu_otime,"シ勤".$calc_kinmu_time);
                        //exit;
                    //勤務区分が日勤
                    } elseif ($calc_plan_kbn == 2) {
                        
                        if ($calc_joban_time > $calc_kaban_time || $calc_joban_time == $calc_kaban_time) {
                            
                            if ($calc_plan_joban_time > $calc_joban_time) {
                                $hayade = $calc_plan_joban_time - $calc_joban_time;
                            } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                $tikoku = $calc_joban_time - $calc_plan_joban_time;
                            }
                            
                            if ($calc_plan_kaban_time > $calc_kaban_time) {
                                $zan = 1440 - ($calc_plan_kaban_time - $calc_kaban_time);
                            } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                $zan = $calc_kaban_time - $calc_plan_kaban_time;
                            }
                            
                        } elseif ($calc_joban_time < $calc_kaban_time) {
                            
                            if ($calc_plan_joban_time > $calc_joban_time) {
                                $hayade = $calc_plan_joban_time - $calc_joban_time;
                            } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                $tikoku = $calc_joban_time - $calc_plan_joban_time;
                            }
                            
                            if ($calc_plan_kaban_time > $calc_kaban_time) {
                                $soutai = $calc_plan_kaban_time - $calc_kaban_time;
                            } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                $zan = $calc_kaban_time - $calc_plan_kaban_time;
                            }
                            
                        }
                        //var_dump($calc_plan_kbn,"所".$wk00_t,"実".$kinmu_time,"早出".$hayade,"遅刻".$tikoku,"早退".$soutai,"残業".$zan);
                        //exit;
                        if ($tikoku == "" && $soutai == "") {
                            $kinmu_flg = 4;
                            $calc_kinmu_time = $kinmu_time - $hayade - $zan;
                        } elseif ($tikoku != "" && $soutai == "") {
                            $kinmu_flg = 1;
                            $calc_kinmu_time = $kinmu_time - $zan;
                        } elseif ($tikoku == "" && $soutai != "") {
                            $kinmu_flg = 2;
                            $calc_kinmu_time = $kinmu_time - $hayade;
                        } else {
                            $kinmu_flg = 3;
                            $calc_kinmu_time = $kinmu_time;
                        }
                        
                        if ($wk00_o != 0) {
                            
                            if ($kinmu_time == $wk00_t) {
                                if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                                    $hayazan = $hayade;
                                    $tuzan = $zan;
                                    $kinmu_time = $calc_kinmu_time;
                                    $kinmu_otime = 0;
                                } else {
                                    $kinmu_syotei = $calc_kinmu_time - $wk00_r;
                                    if ($wk00_o > $kinmu_syotei || $wk00_o == $kinmu_syotei) {
                                        $kinmu_otime = $kinmu_syotei;
                                    } else {
                                        $kinmu_otime = $wk00_o;
                                    }
                                    
                                    if ($kinmu_flg == 1) {
                                        $hayazan = 0;
                                        $tuzan = $zan + ($calc_kinmu_time - $wk00_r - $kinmu_otime);
                                    } elseif ($kinmu_flg == 2) {
                                        $tuzan = $calc_kinmu_time - $wk00_r - $kinmu_otime;
                                        $hayazan = $hayade;
                                    }
                                    $kinmu_time = $wk00_r;
                                }
                            } else {
                            
                                if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                                    $hayazan = $hayade;
                                    $tuzan = $zan;
                                    $kinmu_time = $calc_kinmu_time;
                                    $kinmu_otime = 0;
                                } else {
                                    $kinmu_syotei = $calc_kinmu_time - $wk00_r;
                                    //$kinmu_kyukei = $calc_kinmu_time - $wk00_r - $wk00_o;
                                    if ($wk00_o > $kinmu_syotei || $wk00_o == $kinmu_syotei) {
                                        $kinmu_otime = $kinmu_syotei;
                                    } else {
                                        $kinmu_otime = $wk00_o;
                                    }
                                    
                                    if ($kinmu_flg == 1) {
                                        $hayazan = 0;
                                        $tuzan = $zan + ($calc_kinmu_time - $wk00_r - $kinmu_otime);
                                    } elseif ($kinmu_flg == 2) {
                                        $tuzan = $calc_kinmu_time - $wk00_r - $kinmu_otime;
                                        $hayazan = $hayade;
                                    } elseif ($kinmu_flg == 3) {
                                        $tuzan = $calc_kinmu_time - $wk00_r - $kinmu_otime;
                                        $hayazan = $hayade;
                                    } else {
                                        $tuzan = $zan;
                                        $hayazan = $hayade;
                                    }
                                    $kinmu_time = $wk00_r;
                                }
                            }
                        } else {
                            
                            if ($kinmu_time == $wk00_t) {
                                if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                                    $hayazan = $hayade;
                                    $tuzan = $zan;
                                    $kinmu_time = $calc_kinmu_time;
                                    $kinmu_otime = 0;
                                } else {
                                    if ($kinmu_flg == 1) {
                                        $hayazan = 0;
                                        $tuzan = $zan + ($calc_kinmu_time - $wk00_r);
                                    } elseif ($kinmu_flg == 2) {
                                        $tuzan = $calc_kinmu_time - $wk00_r;
                                        $hayazan = $hayade;
                                    }
                                    $kinmu_time = $wk00_r;
                                    $kinmu_otime = 0;
                                }
                            } else {
                                if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                                    $hayazan = $hayade;
                                    $tuzan = $zan;
                                    $kinmu_time = $calc_kinmu_time;
                                    $kinmu_otime = 0;
                                } else {
                                    if ($kinmu_flg == 1) {
                                        $hayazan = 0;
                                        $tuzan = $zan + ($calc_kinmu_time - $wk00_r);
                                    } elseif ($kinmu_flg == 2) {
                                        $tuzan = $calc_kinmu_time - $wk00_r;
                                        $hayazan = $hayade;
                                    } elseif ($kinmu_flg == 3) {
                                        $hayazan = 0;
                                        $tuzan = $calc_kinmu_time - $wk00_r;
                                    } else {
                                        $hayazan = $hayade;
                                        $tuzan = $zan;
                                    }
                                    $kinmu_time = $wk00_r;
                                    $kinmu_otime = 0;
                                }
                            }
                        }
                    //勤務区分が夜勤
                    } elseif ($calc_plan_kbn == 3) {
                        //シフトの所定が日をまたがない勤務
                        if ($calc_plan_joban_time < $calc_plan_kaban_time) {
                            if ($calc_joban_time > $calc_kaban_time || $calc_joban_time == $calc_kaban_time) {
                                if ($calc_plan_joban_time > $calc_joban_time) {
                                    $hayade = $calc_plan_joban_time - $calc_joban_time;
                                } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                    $tikoku = $calc_joban_time - $calc_plan_joban_time;
                                }
                                
                                if ($calc_plan_kaban_time > $calc_kaban_time) {
                                    $zan = 1440 - ($calc_plan_kaban_time - $calc_kaban_time);
                                } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                    $zan = $calc_kaban_time - $calc_plan_kaban_time;
                                }
                            } elseif ($calc_joban_time < $calc_kaban_time) {
                                if ($calc_plan_joban_time > $calc_joban_time) {
                                    $hayade = $calc_plan_joban_time - $calc_joban_time;
                                } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                    $tikoku = $calc_joban_time - $calc_plan_joban_time;
                                }
                                
                                if ($calc_plan_kaban_time > $calc_kaban_time) {
                                    $soutai = $calc_plan_kaban_time - $calc_kaban_time;
                                } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                    $zan = $calc_kaban_time - $calc_plan_kaban_time;
                                }
                            }
                        //シフトの所定が日をまたぐ勤務
                        } else {
                            //当日勤務のみ
                            if ($calc_joban_time > $calc_kaban_time || $calc_joban_time == $calc_kaban_time) {
                                if ($calc_plan_joban_time > $calc_joban_time) {
                                    $hayade = $calc_plan_joban_time - $calc_joban_time;
                                } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                    $tikoku = $calc_joban_time - $calc_plan_joban_time;
                                }
                                
                                if ($calc_plan_kaban_time > $calc_kaban_time) {
                                    $soutai = $calc_plan_kaban_time - $calc_kaban_time;
                                } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                    $zan = $calc_kaban_time - $calc_plan_kaban_time;
                                }
                            } elseif ($calc_joban_time < $calc_kaban_time) {
                                //翌日勤務
                                if ($calc_joban_time <= $calc_plan_kaban_time) {
                                    if ($calc_plan_joban_time > $calc_joban_time) {
                                        $tikoku = 1440 - ($calc_plan_joban_time - $calc_joban_time);
                                    }
                                    
                                    if ($calc_plan_kaban_time > $calc_kaban_time) {
                                        $soutai = $calc_plan_kaban_time - $calc_kaban_time;
                                    } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                        $zan = $calc_kaban_time - $calc_plan_kaban_time;
                                    }
                                //当日勤務
                                } else {
                                    if ($calc_plan_joban_time > $calc_joban_time) {
                                        $hayade = $calc_plan_joban_time - $calc_joban_time;
                                    } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                        $tikoku = $calc_joban_time - $calc_plan_joban_time;
                                    }
                                    
                                    if ($calc_plan_kaban_time < $calc_kaban_time) {
                                        $soutai = 1440 - ($calc_kaban_time - $calc_plan_kaban_time);
                                    }
                                }
                                
                                //if ($calc_plan_joban_time > $calc_joban_time) {
                                //    $tikoku = 1440 - ($calc_plan_joban_time - $calc_joban_time);
                                //} elseif ($calc_plan_joban_time < $calc_joban_time) {
                                //    $tikoku = $calc_joban_time - $calc_plan_joban_time;
                                //}
                                //
                                //if ($calc_plan_kaban_time > $calc_kaban_time) {
                                //    $soutai = $calc_plan_kaban_time - $calc_kaban_time;
                                //} elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                //    $zan = $calc_kaban_time - $calc_plan_kaban_time;
                                //}
                            }
                        }
                        //var_dump($calc_plan_kbn,"所".$wk00_t,"実".$kinmu_time,"早出".$hayade,"遅刻".$tikoku,"早退".$soutai,"残業".$zan);
                        //exit;
                        if ($tikoku == "" && $soutai == "") {
                            $kinmu_flg = 4;
                            $calc_kinmu_time = $kinmu_time - $hayade - $zan;
                        } elseif ($tikoku != "" && $soutai == "") {
                            $kinmu_flg = 1;
                            $calc_kinmu_time = $kinmu_time - $zan;
                        } elseif ($tikoku == "" && $soutai != "") {
                            $kinmu_flg = 2;
                            $calc_kinmu_time = $kinmu_time - $hayade;
                        } else {
                            $kinmu_flg = 3;
                            $calc_kinmu_time = $kinmu_time;
                        }
                        //var_dump($calc_plan_kbn,"所".$wk00_t/60,"計算前実".$kinmu_time/60,"早出".$hayade/60,"遅刻".$tikoku/60,"早退".$soutai/60,"残業".$zan/60,"シ勤".$calc_kinmu_time/60);
                        //exit;
                        //シフト内勤務が所定労働以下
                        if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                            $hayazan = $hayade;
                            $tuzan = $zan;
                            $kinmu_time = $calc_kinmu_time;
                            $kinmu_otime = 0;
                        //シフト内勤務が所定労働以上
                        } else {
                            //所定残業有り
                            if ($wk00_o != 0) {
                                $kinmu_syotei = $calc_kinmu_time - $wk00_r;
                                if ($wk00_o > $kinmu_syotei || $wk00_o == $kinmu_syotei) {
                                    $kinmu_otime = $kinmu_syotei;
                                } else {
                                    $kinmu_otime = $wk00_o;
                                }
                                
                                if ($kinmu_flg == 1) {
                                    $hayazan = 0;
                                    $tuzan = $zan + ($calc_kinmu_time - $wk00_r - $kinmu_otime);
                                } elseif ($kinmu_flg == 2 || $kinmu_flg == 3) {
                                    $tuzan = $calc_kinmu_time - $wk00_r - $kinmu_otime;
                                    $hayazan = $hayade;
                                } else {
                                    $tuzan = $zan;
                                    $hayazan = $hayade;
                                }
                                $kinmu_time = $wk00_r;
                            //所定残業なし
                            } else {
                                if ($kinmu_flg == 1) {
                                    $hayazan = 0;
                                    $tuzan = $zan + ($calc_kinmu_time - $wk00_r);
                                } elseif ($kinmu_flg == 2 || $kinmu_flg == 3) {
                                    $tuzan = $calc_kinmu_time - $wk00_r;
                                    $hayazan = $hayade;
                                } else {
                                    $hayazan = $hayade;
                                    $tuzan = $zan;
                                }
                                $kinmu_time = $wk00_r;
                                $kinmu_otime = 0;
                            }
                        }
                    }
                    //var_dump($calc_plan_kbn,"所合".$wk00_t/60,"実勤".$kinmu_time/60,"実合".$kinmu_time_total/60,"早残".$hayazan/60,"通残".$tuzan/60,"所残".$kinmu_otime/60,"シ勤".$calc_kinmu_time/60);
                    //exit;
                }
                //}
            //勤務区分が時給
            } elseif ($calc_plan_kbn == 6) {
                //勤務時間8時間越え
                if ($kinmu_time > $syotei) {
                    $tuzan = $kinmu_time - $syotei;
                    $kinmu_time = $kinmu_time - $tuzan;
                }
            }
            
            //KICTのみ15分刻みで計算
            if ($this->inp_genba_id != "" && $this->inp_genba_id == 6) {
                $tuzan1 = floor($tuzan/60)*60;
                $tuzan2 = $tuzan%60;
                if ($tuzan2%15 != 0) {
                    $calc1 = $tuzan2;
                    $calc2 = 15;
                    
                    if ($calc1%$calc2 < 5) {
                        $tuzan       = $tuzan1+($calc2*floor($calc1/$calc2));
                    } else {
                        $tuzan       = $tuzan1+($calc2*ceil($calc1/$calc2));
                    }
                }
            }
            
            $this->kinmu_time       = $kinmu_time;
            $this->syotei_otime       = $kinmu_otime;
            $this->hayazan_time       = $hayazan;
            $this->tuzan_time       = $tuzan;
            //var_dump($calc_plan_kbn,"実勤".$kinmu_time/60,"実合".$kinmu_time_total/60,"早残".$hayazan/60,"通残".$tuzan/60,"シ勤".$calc_kinmu_time/60);
            //exit;
            
        //実績がない場合
        } else {
            if ($wk00_r != 0) {
                $kinmu_time = $wk00_r;
            }
            if ($wk00_o != 0) {
                $kinmu_otime = $wk00_o;
            }
            $hayazan = 0;
            $tuzan = 0;
            
            $this->kinmu_time       = $kinmu_time;
            $this->syotei_otime       = $kinmu_otime;
            $this->hayazan_time       = $hayazan;
            $this->tuzan_time       = $tuzan;
        }
    //上番区分が年休、欠勤、勤務区分が年休の場合
    } else {
        $this->kinmu_time       = $kinmu_time;
        $this->syotei_otime       = $kinmu_otime;
        $this->hayazan_time       = $hayazan;
        $this->tuzan_time       = $tuzan;
    }

?>