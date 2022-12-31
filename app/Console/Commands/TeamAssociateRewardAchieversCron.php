<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use App\Models\TeamRewards;
use App\Models\TeamRewardsAchievers;
use App\Models\Topup;
use App\Models\DailyBonus;
use App\Models\Product;
use App\Dashboard;
use App\User;
use DB;

class TeamAssociateRewardAchieversCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:team_associate_reward_achievers';    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Team Associate Reward Achievers Cron';

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
        $msg = "Team Associate Reward Cron started at ".$today_datetime;
       // echo $msg."\n";    
        
        $insert_reward_arr = array();
        $updateDataArr = array();
        $updateDashboardArr = array();
        $reward_amt = array();   

         $first = TeamRewards::orderBy('id','asc')->pluck("required_direct")->first();       

        $qualifiedUser = DB::table('tbl_users')
            ->select('id','direct_reward_id','paid_directs')
            ->where('topup_status', '1')
            ->where('status','=','Active')->where('paid_directs','>=',$first)
            ->get();
           
        // $qualifiedUser = DB::table('tbl_users')
        //     ->selectRaw('count(tbl_users.id) as total_child,ref_user_id,direct_reward_id')
        //     ->groupBy('ref_user_id')
        //     ->where('topup_status', '1')
        //     ->where('status','=','Active')
        //     ->get();

        if (!empty($qualifiedUser)){

          foreach($qualifiedUser as $ulist){
            
            $uid = $ulist->id;
            $rewardid= $ulist->direct_reward_id;
            $paid_directs = $ulist->paid_directs;
            // dd($paid_directs);
            $userexistforreward = TeamRewards::select('id','required_direct','reward_amount')->where('status','=',1)->where('id','>',$rewardid)->get();

            foreach($userexistforreward as $rewardlist) 
            {

              $rid =   $rewardlist->id;
              $required_direct  =   $rewardlist->required_direct;
              $reward_amount =   $rewardlist->reward_amount;
              if($paid_directs >= $required_direct){
                              

                $Insertdata = array();
                $Insertdata['direct_reward_id'] = $rid;
                $Insertdata['user_id'] = $uid;
                $Insertdata['status'] = 1;
                $Insertdata['entry_time'] = $today_datetime;
                array_push($insert_reward_arr,$Insertdata);

                $updateDataArr[$uid]['id'] = $uid;
                $updateDataArr[$uid]['direct_reward_id'] = $rid;
                if(!isset($reward_amt[$uid])){
                    $reward_amt[$uid] = 0;
                }
            	$reward_amt[$uid] = $reward_amt[$uid] + $reward_amount;
            	
                $updateDashboardArr[$uid]['id'] = $uid;

                $updateDashboardArr[$uid]['working_wallet'] = $reward_amt[$uid];
                $updateDashboardArr[$uid]['reward_income'] = $reward_amt[$uid];
                $updateDashboardArr[$uid]['reward_income_withdraw'] = $reward_amt[$uid];
               
              $data = $paid_directs - $required_direct;
               $updateData = array();
              $updateData['paid_directs'] = $data;
              // dd($data);
              DB::table('tbl_users')->where('id', $uid)->update($updateData);
                /*array_push($updateDataArr,$updateData);*/

              }else{
              //  echo 'Req' . $required_direct. "\n";
              }
            }
          }
        }
        $count = 1;
        $array = array_chunk($insert_reward_arr,1000);
        while($count <= count($array))
        {
          $key = $count-1;
          TeamRewardsAchievers::insert($array[$key]);
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
          $direct_reward_id_qry = 'direct_reward_id = (CASE id';
          
          foreach ($arrProcess as $key => $val) {
              
              $direct_reward_id_qry = $direct_reward_id_qry . " WHEN " . $val['id'] . " THEN '" . $val['direct_reward_id'] . "'";

             
          }
          $direct_reward_id_qry = $direct_reward_id_qry . " END)";

        
          $updt_qry = "UPDATE tbl_users SET " . $direct_reward_id_qry . "  WHERE id IN (" . $ids . ")";
         $updt_user = DB::statement(DB::raw($updt_qry));

          echo $count2 . " update team associate reward  of user array " . count($arrProcess) . "\n";
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

          $upd_dashboard_qry = "UPDATE tbl_dashboard SET " . $reward_income_qry . "," . $reward_income_withdraw_qry . "," . $working_wallet_qry . "  WHERE id IN (" . $ids . ")";
          $updt_userDashboard = DB::statement(DB::raw($upd_dashboard_qry));

          echo $count3 . " update team associate reward related information of user array " . count($arrProcess3) . "\n";
          $count3++;
        }
    }
}