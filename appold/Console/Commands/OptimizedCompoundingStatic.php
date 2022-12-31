<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Config;
use App\Models\Topup;
use App\Models\CompoundDailyBouns;
use App\Models\Product;
use App\Dashboard;
use DB;


class OptimizedCompoundingStatic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:optimized_compounding_static';    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compounding Cron';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    
    public function handle()
    {   
       list($usec, $sec) = explode(" ", microtime());

        $time_start1 = ((float)$usec + (float)$sec);
        // dd('end');
        DB::raw('LOCK TABLES `tbl_dashboard` WRITE');
        // DB::raw('LOCK TABLES `tbl_topup` WRITE');
        DB::raw('LOCK TABLES `tbl_compound_dailybouns` WRITE');
        //cron here
     
        $day = \Carbon\Carbon::now()->format('D');
            
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $msg = "Compound Cron started at ".$current_time;
        echo $msg."\n";

        $insert_dailybonus_arr = array();
        
        $update_dash_arr = array();
        $user_id_arr = $user_id_arr1 = $user_id_arr2 = array();
        $pin_arr = array();
        $updateTopupData = [];
  // print_r $pin_arr;
        $allTopusDistinctEntryTime = Topup::select(DB::raw("Date(tbl_topup.compound_last_roi_entry_time) as compound_last_roi_entry_time"))
        ->join('tbl_users as tu', 'tu.id', '=', 'tbl_topup.id')
        ->join('tbl_product as tp', 'tp.id', '=', 'tbl_topup.type')
        ->join('tbl_dashboard as td', 'td.id', '=', 'tbl_topup.id')
        ->where('tu.status', 'Active')->where('tu.type', '')
        ->where('tbl_topup.compound_lock_status','1')->where('tbl_topup.compound_amount','>',0)
        ->where('tbl_topup.total_compound_roi_amount','<',DB::raw('tbl_topup.compound_amount'))
        ->where(DB::raw("TIMESTAMPDIFF(DAY,DATE(tbl_topup.compound_last_roi_entry_time),DATE(now()))"), '>=', DB::raw('tp.date_diff'))
        ->groupby(DB::raw("Date(tbl_topup.compound_last_roi_entry_time)"))
        //->limit(1)
        ->get();
        // dd($allTopusDistinctEntryTime);
        foreach ($allTopusDistinctEntryTime as $tpdet) 
        {
            
        echo "Last ROI Date -> ".$compound_last_roi_entry_time=$tpdet->compound_last_roi_entry_time;
        echo "\n";
            
        $allTopus = Topup::select('tbl_topup.id','tbl_topup.pin','tbl_topup.type','tbl_topup.compound_amount','tbl_topup.entry_time','tbl_topup.compounding_lock_percentage','tbl_topup.total_compound_roi_amount','tbl_topup.total_compound_amount','tbl_topup.compound_lock_status','tp.date_diff','tbl_topup.amount_roi','tbl_topup.compound_last_roi_entry_time','tu.entry_time as register_date')
        ->join('tbl_users as tu', 'tu.id', '=', 'tbl_topup.id')
        ->join('tbl_product as tp', 'tp.id', '=', 'tbl_topup.type')
        ->join('tbl_dashboard as td', 'td.id', '=', 'tbl_topup.id')
        ->where('tu.status', 'Active')->where('tu.type', '')
        ->where('tbl_topup.compound_lock_status','1')
        ->where('tbl_topup.total_compound_roi_amount','<',DB::raw('tbl_topup.total_compound_amount'))
       ->where(DB::raw("TIMESTAMPDIFF(DAY,DATE(tbl_topup.compound_last_roi_entry_time),DATE(now()))"), '>=', DB::raw('tp.date_diff'))
        ->where(DB::raw("Date(tbl_topup.compound_last_roi_entry_time)"),$compound_last_roi_entry_time)
       // ->limit(100000)
        ->get();      
        
            $i=1;
        
            echo "last compound date -> ".$compound_last_roi_entry_time;
            echo "\n";           
          
            foreach ($allTopus as $tp)
            {  

               $date_diff = $tp->date_diff;
               $getDate = \Carbon\Carbon::now()->toDateString();
               $nextEntrydate=date('Y-m-d', strtotime($compound_last_roi_entry_time. ' + '.$date_diff. 'days'));
               $getDay = \Carbon\Carbon::parse($nextEntrydate)->format('D');
            
               if(strtotime($nextEntrydate) <= strtotime($getDate))
               {    
                    $on_amount = $tp->compound_amount;
                    $roi_amt_per = $tp->compounding_lock_percentage;
                    $roi_amt = ($on_amount*$roi_amt_per)/100;//0.4
                    $working_amt = $roi_amt;//0.4 - 0.04 = 0.36

                    list($usec, $sec) = explode(" ", microtime());

                    $time_start = ((float)$usec + (float)$sec);               

                        $Dailydata = array();
                        $Dailydata['amount'] = $roi_amt;
                        $Dailydata['id'] = $tp->id;
                        $Dailydata['pin'] = $tp->pin;
                        // $Dailydata['status'] = 'Paid';
                        // $Dailydata['software_perentage'] = 0;
                        $Dailydata['daily_percentage'] = $roi_amt_per;
                        // $Dailydata['software_amount'] = 0;
                        $Dailydata['daily_amount'] = $roi_amt;
                        $Dailydata['entry_time'] = $nextEntrydate;
                        $Dailydata['on_amount'] = $on_amount;

                        $Dailydata['type'] = $tp->type;
                        // $Dailydata['tax_amount'] = 0;
                        // dd($Dailydata);
                        array_push($insert_dailybonus_arr,$Dailydata);

                        $updateCoinData = array();
                        $updateCoinData['id'] = $tp->id;
                        $updateCoinData['usd'] = $roi_amt;
                        $updateCoinData['total_profit'] = $roi_amt;
                        $updateCoinData['compound_income'] = $working_amt;
                        $updateCoinData['compound_income_withdraw'] = $working_amt;
                        $updateCoinData['compounding_wallet'] = $working_amt; 
                        $updateCoinData['roi_income'] = $working_amt; 
// dd($updateCoinData);
                        array_push($update_dash_arr,$updateCoinData);
                
                    // topup update                   
                    $updateTopupData[] = array(
                    'total_compound_roi_amount' => DB::raw("total_compound_roi_amount + " .$roi_amt),
                        'compound_last_roi_entry_time' => $nextEntrydate,
                        'pin' => $tp->pin,
                        'compound_amount' => DB::raw("compound_amount + " .$roi_amt)
                    );

                    // dd($updateTopupData);
                  
                    $total_compound_roi_amount = $tp->total_compound_roi_amount +$roi_amt;
                    $compound_amount = $tp->compound_amount + $roi_amt;
// dd($pin_arr);
                    if ($total_compound_roi_amount >= $tp->total_compound_amount) {
                        array_push($pin_arr, $tp->pin);
                       
                    }
       
                    echo " -> srno -> ".$i++." -> id -> ".$tp->id." ->  compound date -> ".$nextEntrydate." -> ";
             

                    list($usec, $sec) = explode(" ", microtime());
                    $time_end = ((float)$usec + (float)$sec);
                    $time = $time_end - $time_start;
                    echo "time ".$time."\n";
                                                
                }

             echo "\n compound date ".$nextEntrydate."\n";
           }
        }
        $count = 1;
        $array = array_chunk($insert_dailybonus_arr,1000);
       // dd($array);
        while($count <= count($array))
        {
          $key = $count-1;
     
          CompoundDailyBouns::insert($array[$key]);
          echo $count." insert count array ".count($array[$key])."\n";
          $count ++;
        }

        /*Update ROI Income array*/
        $count1 = 1;
        $array1 = array_chunk($update_dash_arr,1000);
        while($count1 <= count($array1))
        {
            $key1 = $count1-1;
            $arrProcess = $array1[$key1];
            $mainArr = array();
            foreach ($arrProcess as $k => $v) {
                $mainArr[$v['id']]['id'] = $v['id'];
        
                if (!isset($mainArr[$v['id']]['total_profit']) && !isset($mainArr[$v['id']]['compound_income']) && !isset($mainArr[$v['id']]['compound_income_withdraw']) && !isset($mainArr[$v['id']]['compounding_wallet']) && !isset($mainArr[$v['id']]['roi_income'])) 
                {

                    $mainArr[$v['id']]['compound_income']=$mainArr[$v['id']]['total_profit']=0;
                    $mainArr[$v['id']]['compounding_wallet']=$mainArr[$v['id']]['compound_income_withdraw']=0;
                    $mainArr[$v['id']]['roi_income']=$mainArr[$v['id']]['compound_income_withdraw']=0;
                                        
                }
                $mainArr[$v['id']]['total_profit'] += $v['total_profit']; 
                $mainArr[$v['id']]['compound_income'] += $v['compound_income']; 
                $mainArr[$v['id']]['compounding_wallet'] += $v['compounding_wallet']; 
                $mainArr[$v['id']]['roi_income'] += $v['roi_income']; 
                $mainArr[$v['id']]['compound_income_withdraw'] += $v['compound_income_withdraw']; 
                               
            }
            $ids = implode(',', array_column($mainArr, 'id'));
            $total_profit_qry = 'total_profit = (CASE id';
            $compounding_wallet_qry = 'compounding_wallet = (CASE id';
            $roi_income_qry = 'roi_income = (CASE id';
            $compound_income_qry = 'compound_income = (CASE id';
            $compound_income_withdraw_qry = 'compound_income_withdraw = (CASE id';

            foreach ($mainArr as $key => $val) {
                $total_profit_qry = $total_profit_qry . " WHEN ".$val['id']." THEN total_profit + ".$val['total_profit'];             
                $compounding_wallet_qry = $compounding_wallet_qry . " WHEN ".$val['id']." THEN compounding_wallet + ".$val['compounding_wallet'];
            
                $compound_income_qry = $compound_income_qry . " WHEN ".$val['id']." THEN compound_income + ".$val['compound_income'];

                $roi_income_qry = $roi_income_qry . " WHEN ".$val['id']." THEN roi_income + ".$val['roi_income'];
                
                $compound_income_withdraw_qry = $compound_income_withdraw_qry . " WHEN ".$val['id']." THEN compound_income_withdraw + ".$val['compound_income_withdraw'];
            }

            $total_profit_qry = $total_profit_qry . " END)";         
            $roi_income_qry = $roi_income_qry . " END)";         
            $compounding_wallet_qry = $compounding_wallet_qry . " END)";
            $compound_income_qry = $compound_income_qry . " END)";
            $compound_income_withdraw_qry = $compound_income_withdraw_qry . " END)";

            $updt_qry = "UPDATE tbl_dashboard SET ".$total_profit_qry." ,".$roi_income_qry. ",".$compounding_wallet_qry." ,".$compound_income_withdraw_qry." , ".$compound_income_qry." WHERE id IN (".$ids.")";
            $updt_user = DB::statement(DB::raw($updt_qry));

            echo $count1." update from user dash array ".count($mainArr)."\n";
            $count1 ++;
        }

         $stopCount = 1;
              $stopDirect = array_chunk($updateTopupData,1000);

              while($stopCount <= count($stopDirect))
              {
                  $keyx = $stopCount-1;
                  $arrProcess = $stopDirect[$keyx];
                  $pin = "'".implode("','", array_column($arrProcess, 'pin'))."'";
                  $total_compound_roi_amount = 'total_compound_roi_amount = (CASE pin';
                  $compound_amount = 'compound_amount = (CASE pin';
                  $compound_last_roi_entry_time = 'compound_last_roi_entry_time = (CASE pin';
                  foreach ($arrProcess as $key => $val){
                     $total_compound_roi_amount = $total_compound_roi_amount . " WHEN '".$val['pin']."' THEN ".$val['total_compound_roi_amount'];
                     $compound_amount = $compound_amount . " WHEN '".$val['pin']."' THEN ".$val['compound_amount'];
                     $compound_last_roi_entry_time = $compound_last_roi_entry_time . " WHEN '".$val['pin']."' THEN '".$val['compound_last_roi_entry_time']."'";
                  }
                  $total_compound_roi_amount = $total_compound_roi_amount . " END)"; 
                  $compound_amount = $compound_amount . " END)"; 
                  $compound_last_roi_entry_time = $compound_last_roi_entry_time . " END)"; 
                  $updt_qry = "UPDATE tbl_topup SET ".$total_compound_roi_amount." ,".$compound_last_roi_entry_time.",".$compound_amount." WHERE pin IN (".$pin.")";
                  $updt_user = DB::statement(DB::raw($updt_qry));
                  echo $stopCount." update direct status array ".count($arrProcess)."\n";
                  $stopCount ++;
              }

              // dd($allTopus->pin);

            $count3 = 1;     
            $array3 = array_chunk($pin_arr,1000);
            // dd($array3);
            while($count3 <= count($array3))
            {
              $key3 = $count3-1;

              Topup::whereIn('pin',$array3[$key3])->update(['compound_lock_status'=>'0']);
              echo $count3." update pin array ".count($array3[$key3])."\n";
              $count3 ++;
            }
    
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $msg = "Compound Cron end at ".$current_time."\nTotal records : ".count($insert_dailybonus_arr)."\n";
        
        echo $msg;

        echo "\n";
            list($usec, $sec) = explode(" ", microtime());
                                $time_end1 = ((float)$usec + (float)$sec);
                                   $time = $time_end1 - $time_start1;
                                   echo "after compound income cron ".$time."\n"; 
        

        DB::raw('UNLOCK TABLES');
    
    }
}
