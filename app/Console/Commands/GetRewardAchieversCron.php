<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use App\Models\AllRewards;
use App\Models\AllRewardsAchievers;
use App\Models\Topup;
use App\Models\DailyBonus;
use App\Models\Product;
use App\Dashboard;
use App\User;
use DB;

class GetRewardAchieversCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:get_reward_achievers';    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reward Achievers Cron';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    
    public function handle()
    {   
       list($usec, $sec) = explode(" ", microtime());
        $time_start1 = ((float)$usec + (float)$sec);
        // DB::raw('LOCK TABLES `tbl_dashboard` WRITE');
        // DB::raw('LOCK TABLES `tbl_dailybonus` WRITE');
     
        // $time_start1 = microtime_float();
        $today = \Carbon\Carbon::now();
        $today_datetime = $today->toDateTimeString();
        $today_datetime2 = $today->toDateString();
        $day = \Carbon\Carbon::now()->format('D');
        $msg = "Reward Cron started at ".$today_datetime;
       // echo $msg."\n";    
        
        $insert_reward_arr = array();
        $updateDataArr = array();
        $updateDashboardArr = array();
        $reward_amt = array();        
        
        $qualifiedUser = User::select("id", "user_id as name","reward_id","l_bv","r_bv")->where('binary_qualified_status', '=', 1)->where('topup_status', '1')->where('status','=','Active')->get();
// dd($qualifiedUser);
        if (!empty($qualifiedUser)){

          foreach($qualifiedUser as $ulist){
            
            $uid= $ulist->id;
            $rewardid= $ulist->reward_id;
            // dd($rewardid);
            /*$l_bv = Topup::join('tbl_today_details as ttd','ttd.from_user_id','=','tbl_topup.id')->where('ttd.to_user_id',$uid)->where('ttd.position',1)->sum('tbl_topup.amount');
            $r_bv = Topup::join('tbl_today_details as ttd','ttd.from_user_id','=','tbl_topup.id')->where('ttd.to_user_id',$uid)->where('ttd.position',2)->sum('tbl_topup.amount');*/
            $l_bv = $ulist->l_bv;
            $r_bv = $ulist->r_bv;

           //dd($l_bv.'--'.$r_bv);

            $bv= min($l_bv,$r_bv);
            $userexistforreward = AllRewards::select('id','reward_name','required_bv','reward_amount')->where('status','=',0)->where('id','>',$rewardid)->get();

            foreach($userexistforreward as $rewardlist) 
            {

              $rid =   $rewardlist->id;
              $required_bv  =   $rewardlist->required_bv;
              $reward_name  =   $rewardlist->reward_name;
              $reward_amount=   $rewardlist->reward_amount;
              if($bv >= $required_bv){
                //  echo  $msg = "min bv " . $bv . "---" ."reward " . $reward_name . "-----" ."req:: " . $required_bv . "-----"."uid:: " . $uid . "\n";
                $Insertdata = array();
                $Insertdata['reward_id'] = $rid;
                $Insertdata['reward_name'] = $reward_name;
                $Insertdata['user_id'] = $uid;
                $Insertdata['status'] = 1;
                $Insertdata['entry_time'] = $today_datetime;
                array_push($insert_reward_arr,$Insertdata);

                $updateDataArr[$uid]['id'] = $uid;
                $updateDataArr[$uid]['reward_id'] = $rid;
                $updateDataArr[$uid]['reward_name'] = $reward_name;
                if(!isset($reward_amt[$uid])){
                    $reward_amt[$uid] = 0;
                }
            	$reward_amt[$uid] = $reward_amt[$uid] + $reward_amount;
            	
                $updateDashboardArr[$uid]['id'] = $uid;
                $updateDashboardArr[$uid]['reward_income'] = $reward_amt[$uid];
                $updateDashboardArr[$uid]['reward_income_withdraw'] = $reward_amt[$uid];
                $updateDashboardArr[$uid]['working_wallet'] = $reward_amt[$uid];
               
                /*array_push($updateDataArr,$updateData);*/

              }else{
              //  echo 'Req' . $required_bv. "\n";
              }
            }
          }
        }

        $count = 1;
        $array = array_chunk($insert_reward_arr,1000);
        while($count <= count($array))
        {
          $key = $count-1;
          AllRewardsAchievers::insert($array[$key]);
          echo $count." insert count array ".count($array[$key])."\n";
          $count ++;
        }

        $count2 = 1;
        $array2 = array_chunk($updateDataArr,1000);
        while ($count2 <= count($array2)) 
        {
          $key2 = $count2 - 1;
          $arrProcess = $array2[$key2];
          $ids = implode(',', array_column($arrProcess, 'id'));
          $reward_qry = 'reward_name = (CASE id';
          $reward_id_qry = 'reward_id = (CASE id';
          
          foreach ($arrProcess as $key => $val) {
              $reward_qry = $reward_qry . " WHEN " . $val['id'] . " THEN '" . $val['reward_name'] . "'";
              $reward_id_qry = $reward_id_qry . " WHEN " . $val['id'] . " THEN '" . $val['reward_id'] . "'";

          }

          $reward_qry = $reward_qry . " END)";
          $reward_id_qry = $reward_id_qry . " END)";

        
          $updt_qry = "UPDATE tbl_users SET " . $reward_qry . "," . $reward_id_qry . "  WHERE id IN (" . $ids . ")";
         $updt_user = DB::statement(DB::raw($updt_qry));

          echo $count2 . " update reward  of user array " . count($arrProcess) . "\n";
          $count2++;
        }


        $count3 = 1;
        $array3 = array_chunk($updateDashboardArr,1000);
        while ($count3 <= count($array3)) 
        {
          $key3 = $count3 - 1;
          $arrProcess3 = $array3[$key3];
          $ids = implode(',', array_column($arrProcess3, 'id'));
         
          $reward_income_qry = 'reward_income = (CASE id';
          $reward_income_withdraw_qry = 'reward_income_withdraw = (CASE id';
          $working_wallet_qry = 'working_wallet = (CASE id';

          foreach ($arrProcess3 as $key => $val) {
              $reward_income_qry = $reward_income_qry . " WHEN " . $val['id'] . " THEN reward_income + " . $val['reward_income'] ;
              $reward_income_withdraw_qry = $reward_income_withdraw_qry . " WHEN " . $val['id'] . " THEN reward_income_withdraw + " . $val['reward_income_withdraw'] ;
              $working_wallet_qry = $working_wallet_qry . " WHEN " . $val['id'] . " THEN working_wallet + " . $val['working_wallet'];

          }

          $reward_income_qry = $reward_income_qry . " END)";
          $reward_income_withdraw_qry = $reward_income_withdraw_qry . " END)";
          $working_wallet_qry = $working_wallet_qry . " END)";

          $upd_dashboard_qry = "UPDATE tbl_dashboard SET " . $reward_income_qry . "," . $reward_income_withdraw_qry . " ," . $working_wallet_qry . "  WHERE id IN (" . $ids . ")";
          $updt_userDashboard = DB::statement(DB::raw($upd_dashboard_qry));

          echo $count3 . " update reward related information of user array " . count($arrProcess3) . "\n";
          $count3++;
        }
    }
}