<template>
  <div>
    <div class="main-content">
     <UserDetails></UserDetails>
			  <div class="row common-rows">
			    <div class="col-12 col-sm-12 col-md-12 col-lg-7 left-cols common-cols">
				   <div class="wraper">
				     <div class="referral-wraper">
					   <div class="card">
						  <div class="card-body">
						    <h4 class="md-heading">Referral Links</h4>
							<div class="row">
							  <div class="col-md-6">
							    <div class="form-group">
								  <label for="usr">Left Referral Links</label>
								  <div class="input-container d-flex"> 
                        <input type="text" readonly class="form-control inputr-1" id="referral-left" :value="referrallink.link+'&position=1'">
                        <button id="refcopy1" onclick="myFunctionRefLeft()" onmouseout="outFunc()" class="btn btn-copy copyButton1">Copy Now</button>
								   <!---<input type="text" class="form-control inputr-1" id="usr" value="https://www.azardio.com/azardio/user#/register/?">
									<button class="btn btn-copy copyButton1">Copy Now</button>-->
								  </div>
								</div>
							  </div>
							  <div class="col-md-6">
							    <div class="form-group">
								  <label for="usr">Right Referral Links</label>
								  <div class="input-container d-flex">         
                            <input type="text" id="myRightInput" readonly class="form-control inputr-2" :value="referrallink.link+'&position=2'">
                              <button id="right-refcopy" onclick="myFunctionRefRight()" class="btn btn-copy copyButton2"  onmouseout="outrightFunc()">Copy Now</button>
                             <!--<input type="text" class="form-control inputr-2" id="usr" value="https://www.azardio.com/azardio/user#/register/?">
									<button class="btn btn-copy copyButton2">Copy Now</button>-->
								  </div>
								</div>
							  </div>
							</div>
						  </div>
					   </div>
					 </div>
					 <div class="welcome-wraper">
					   <div class="card">
						  <div class="card-body">
						    <h4 class="md-heading">Hello, {{userdata.user_id}}</h4>
							<p class="p-text">Welcome to <span>{{useractivities.fullname}}</span>, enjoy your success journey with us...!</p>
							<div class="news-wraper d-flex align-items-center">
							  <a href="#" class="btn btn-news">Latest NEWS</a>
							  <p class="p-text">Welcome to <strong>{{useractivities.email}}</strong>, enjoy your success journey with us...!</p>
							</div>
						  </div>
					   </div>
					 </div>
				   </div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-5 right-cols common-cols">
				   <div class="revenue-wraper">
				      <div class="card">
						<div class="card-body">
						  <div class="header d-flex align-items-center">
						    <h4 class="md-heading">Revenue</h4>
							<div class="total-wraper"><span class="title">Total Spent</span><br><span class="result-title">${{userdata.total_deposit}}</span></div>
						  </div>
						  <div class="graph-wraper">
							  <img src="public/user_files/assets/images/graph-1.png">
							</div>
						</div>
				      </div>
				   </div>
				</div>
			  </div>
			  <div class="row boxes-card-rows common-rows">
			    <div class="col-12 col-sm-12 col-md-6 col-lg-3 card-cols common-cols">
				   <div class="card card-box">
					 <div class="card-body d-flex align-items-center">
					   <div class="wraper-in ">
					     <p class="profit-title">ROI Profit</p>
					     <p class="profit-nums">${{userdata.roi_income}}</p>
					   </div>
					   <div class="img-wraper"><img src="public/user_files/assets/images/roi-image.png"></div>
					 </div>
				   </div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-3 card-cols common-cols">
				  <div class="card card-box">
					 <div class="card-body d-flex align-items-center">
					   <div class="wraper-in ">
					     <p class="profit-title">Binary Profit</p>
					     <p class="profit-nums">$ {{userdata.binary_income}}</p>
					   </div>
					   <div class="img-wraper"><img src="public/user_files/assets/images/binary-image.png"></div>
					 </div>
				   </div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-3 card-cols common-cols">
				  <div class="card card-box">
					 <div class="card-body d-flex align-items-center">
					   <div class="wraper-in ">
					     <p class="profit-title">Direct Profit</p>
					     <p class="profit-nums">$ {{userdata.direct_income}}</p>
					   </div>
					   <div class="img-wraper"><img src="public/user_files/assets/images/direct-image.png"></div>
					 </div>
				   </div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-3 card-cols common-cols">
				 <div class="card card-box">
					 <div class="card-body d-flex align-items-center">
					   <div class="wraper-in ">
					     <p class="profit-title">Earning Wallet</p>
					     <p class="profit-nums">$ {{userdata.total_earnings}}</p>
					   </div>
					   <div class="img-wraper"><img src="public/user_files/assets/images/earning-image.png"></div>
					 </div>
				   </div>
				</div>
			  </div>
			  <div class="row users-rows common-rows">
			    <div class="col-12 col-sm-12 col-md-12 col-lg-4 common-cols">
				  <div class="card">
					<div class="card-body">
					  <div class="heading">
					     <h4 class="md-heading">Total Users</h4>
					  </div>
					  <div class="table-wraper report-table-section dashboard-table">
					      <div class="table-responsive">
						    <table id="report-table" class="report-table table depos-table table-striped table-sm" style="width:100%">
								<thead>
									<tr>
										<th><span class="th-wraper">Sr. No</span></th>
										<th><span class="th-wraper">User Id</span></th>
										<th><span class="th-wraper">Position</span></th>
										<th><span class="th-wraper">Date</span></th>
										<th><span class="th-wraper">Status</span></th>
									</tr>
								</thead>
								<tbody>
                           
                        </tbody>						
							</table>
                    </div>
					  </div>
					</div>
				  </div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-4 common-cols">
				  <div class="card withdraw-card">
					<div class="card-body">
					  <div class="heading">
					     <h4 class="md-heading">Withdrawal</h4>
					  </div>
					  <div class="wallet-wraper">
					     <p class="p-text">Total Funds in Withdrawal wallet</p>
						 <p class="earn-text">${{ (userdata.working_Wallet_balancenew)}}</p>
					  </div>
					  <div class="currency-wraper">
					    <div class="form-group" v-if="mode === 'withdraw'">
						  <label for="usr">Currency Type:</label>
                    <select v-model="Currency_type" class="form-control">
                     <option value="">Select Currancy</option>
                        <option v-for="cur in currency_code" :value="cur.currency_code">
                                             {{cur.currency_name}} ( {{cur.currency_code}} )
                           </option>
                     </select>
						  <!--<input type="text" class="form-control" id="usr" placeholder="Bitcoin (BTC)">-->
						</div>
                  <input type="text" id="set-working-wallet" placeholder="Amount" v-model="set_working_wallet"  class="form-control blue-back W-a-xs { error: errors.has('set-working-wallet') }" v-validate="'required|numeric'"
                                 onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" />
               <div class="tooltip2" v-show="errors.has('Amount')">
                     <div class="tooltip-inner">
                        <span v-show="errors.has('Amount')">{{ errors.first('Amount') }}</span>
                     </div>
                </div>
						<!--<p class="amnt-text">Enter Available Amount : <span>$ 300</span></p>-->
						<div class="form-group">
						  <label for="usr">Deduction:</label>
                    <input type="text" name="deduction" v-model="deduction" class="form-control" disabled  readonly>
                  </div>
                         
						 <!--<input type="text" class="form-control" id="usr" placeholder="8 %">-->
						
					  </div>
					  <div class="btn-wraper text-center">
                  <button v-if="mode == 'withdraw'" class="btn btn-withdraw" type="button" @click.prevent="sendOTP()">Withdraw</button>
					   
					  </div>
					</div>
				  </div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-4 common-cols">
                   <form  @submit.prevent="purchasePackagecoin(product_id, currency_code,amount)" data-vv-scope="addfundform">	
                   <div class="card withdraw-card">
					<div class="card-body">
					  <div class="heading">
					     <h4 class="md-heading">Add Fund</h4>
					  </div>
					  <div class="wallet-wraper">
					     <p class="p-text">Total Funds in  Fund wallet</p>
						 <p class="earn-text">${{userdata.fund_Wallet_balance}}</p>
					  </div>
					  <div class="currency-wraper">
					    <div class="form-group">
						  <label for="usr">Enter Amount ( USD ):</label>
						  <!--<input type="text" class="form-control" id="usr" placeholder="$ 0">-->
                     <input type="text" class="form-control" placeholder="Enter Amount" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Numbers only" v-model="amount" v-validate="'required|numeric|min_value:50'" />
						   
                  </div>
						<p class="amnt-text">Preview Amount : <span> <input v-model="amount" formcontrolname="touser-id" id="touser-id" name="touser-id" placeholder="Preview Amount" type="text" class="form-control" disabled></span></p>
						<div class="form-group">
						  <label for="usr">Payment Mode :</label>
						 <select v-model="Currency_type" class="form-control">
                     <option value="">Select Currancy</option>
                        <option v-for="cur in currency_code" :value="cur.currency_code">
                                             {{cur.currency_name}} ( {{cur.currency_code}} )
                           </option>
                     </select>
						</div>
					  </div>
					  <div class="btn-wraper text-center">
                  <button type="submit" class="btn btn-withdraw btn-lightbg">Make Payment</button>
					
					  </div>
					</div>
				  </div>
              </form>
				</div>
			  </div>
         </div> 

           <div id="editBankDetailsmodal" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" class="modal">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h4 class="modal-title">Enter OTP</h4>
                              <button type="button" data-dismiss="modal" class="close">×</button>
                           </div>
                           <div class="modal-body">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <input type="text" name="otp" placeholder="Enter OTP" class="form-control" aria-required="true" aria-invalid="false"> 
                                       <div class="tooltip2" style="display: none;">
                                          <div class="tooltip-inner"><span style="display: none;"></span></div>
                                       </div>
                                    </div>
                                    <br> <br> <br> <br> 
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                    <button type="button" class="btn btn-primary" @click.prevent="verifyOtp()">Submit</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
            </div>
  </div>
</template>

<script>
   import moment from "moment";
   import VueApexCharts from 'vue-apexcharts';
   import {
      apiUserHost
   } from "../../user-config/config";
import UserDetails from "./UserDetails.vue";
   export default {
       components: {
    apexchart: VueApexCharts,
    UserDetails
},

      data() {


         return {
             series: [],
          chartOptions: {
             colors:['#ffa755', '#6fe365', '#4a6ecc','#c8c8c8'],
             legend: {
               show: false,
             },
            chart: {
              width: 380,
              type: 'pie',
            },
            labels: ['ROI Earning', 'Direct Earning', 'Binary Earning','XentoBonus Earning'],
            responsive: [{
              breakpoint: 480,
              options: {
                chart: {
                  width: 200
                },
                legend: {
                  position: 'bottom'
                }
              }
            }]
          },
            itemname: "",
            INR: "",
            type: "",

            usddata: 0,
            series_data: [],
            currency_code: {},
            withdrawal_currency_code: {},
            typeChange: 'BTC',
            amount: '',
            userdata: {
               total_earnings: 0,
               roi_income: 0,
               leveincome: 0,
               direct_income: 0,
               totawithdraw: 0,
               total_withdraw_amount: 0,
               top_up_Wallet_balance: 0,
               direct_list: 0,
               fund_Wallet_balance: 0,
               retopup_days: 0
            },
            mode: "withdraw",
            Currency_type: 'BTC',
           // set_working_wallet: '',
            set_working_wallet: '',
            userProfile: {},
            todolists: {
               id: "",
               itemname: ""
            },
            getpackages: {
               id: ""
            },
            myteams: {
               fullname: ""
            },
            useractivities: {
               fullname: "",
               message: "",
               entry_time: ""
            },
            working_balance: 0,
            objProSettings: {},
            referrallink: "",
            disablebtn: false,
            subject: "",
            isValid: true,
            usermsg: "",
            otp: "",
            deduction: "",
            newsdata: '',
            link: "",
            link1: "",
            link2: "",
            displayLink: true,
            displaymodal: false,
            usersleft: '',
            usersright: '',
            todayleft: '',
            todayright: '',
            usersrightcounts: '',
            usersleftcounts: '',
            icoStatusInfo: '',
            adminStatus: '',
            contest_data: {},
            table: {},
            mode: "withdraw",
            withdrawBtn: false,
            currency_code: [],
            deduction: "",
            remark: ''
         };
      },

      mounted() {
         // this.getInvestmentReports();
         //this.getIcoStatusFun();
         //this.disableCpy();
         this.getUserDetails();
         //this.check90Days();
         //this.getusddata();
         //this.get_todays_rank_count();
         //this.close();
         //this.getUserContestData();
        this.getAllCurrency();
        this.getWithdrawalCurrency();
       this.getWorkingWithdrawalDeduction();
         this.getWorkingWithdrawal();
         this.getLevelView();
         this.getnews();
         //  alert(this.INR);
         //  this.getToDoList();
         // this.getPackages();
         //this.getMyTeam();
         // this.getAllActivity();
         // this.getUserProfile();
         //this.getProSettings();
          this.getReferralLink();
         // this.checkPromo();
         setTimeout(() => {
            this.get_graph_report();
         }, 2000)
         this.getGraphDetails();
      },
      computed: {
         isCompletePromotions() {
            return this.link1;
         },
         isCompletePromotions2() {
            return this.link2;
         },
         isCompleteWorkingWithdrawal() {
            return this.set_working_wallet || this.addTopup;
         },
      },
      methods: {
         moveTop(){
           document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;

        },
         getGraphDetails()
         {
           new google.charts.load("current", {packages:["corechart"]});
        new google.charts.setOnLoadCallback(this.drawChart());
         },
         drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Income', 'In $'],
          ['Roi',  5.85],
          ['Direct',  1.66],
          ['Binary', 0.316],
          ['XentoBonus', 0.0791]
        ]);

      var options = {  
        legend: 'none',
        pieSliceText: 'label',
        title: '',
        pieStartAngle: 100,
      };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      },
         getnews() {
            axios.get('get-news')
               .then(response => {
                  if (response.data.code === 200) {
                     this.newsdata = response.data.data;
                  }
               }).catch(error => {

               });
         },
         getWorkingWithdrawal() {
            axios
               .get("get-working-balance", {})
               .then((response) => {
                  // console.log(response)
                  if (response.data.code == 200) {
                     this.working_balance =
                        typeof response.data.data == Object ? 0 : response.data.data;
                  }
               })
               .catch((error) => {});
         },
         getWorkingWithdrawalDeduction() {
            axios
               .get("get-working-withdrawal-deduction", {})
               .then((response) => {
                  // console.log(response)
                  if (response.data.code == 200) {
                     this.deduction =
                        typeof response.data.data == Object ? 0 : response.data.data + "%";
                  }
               })
               .catch((error) => {});
         },
         getAllCurrency() {
            axios.get('getall-currency', {
                  withdrwal_status: 1,
               })
               .then(response => {
                  this.currency_code = response.data.data;
               })
               .catch(error => {});
         },
         getWithdrawalCurrency() {
            axios
               .post("getall-currency", {
                  withdrwal_status: 1,
               })
               .then((response) => {
                  this.currency_code = response.data.data;
                  // this.Currency_type = "TRX";
               })
               .catch((error) => {});
         },
         get_graph_report() {
            var that = this;
            var ctx = document.getElementById("polarChart1").getContext('2d');
            Chart.defaults.global.legend.display = false;
            var myChart = new Chart(ctx, {
               type: 'polarArea',
               data: {
                  labels: ["Binary Income", "Direct Income", "ROI Income", "Available Balance"],
                  datasets: [{
                     backgroundColor: [
                        "#496ecc",
                        "#49820d",
                        "#ffa755",
                        "#c8c8c8"
                     ],
                     data: [this.userdata.binary_income, this.userdata.direct_income, this.userdata
                        .roi_income, this.userdata.matching_bonus_income
                     ]
                  }]
               },
               options: {
                  maintainAspectRatio: true,
                  scale: {
                     scaleShowLine: false,
                     display: false,
                     pointLabels: {
                        fontSize: 0
                     },
                  },
                  tooltips: {
                     enabled: false,
                  }
               }
            });
         },
         getIcoStatusFun() {
            axios
               .get("getIcoStatus", {})
               .then(response => {
                  this.icoStatusInfo = response.data.data.ico_status;
                  this.adminStatus = response.data.data.ico_admin_error_msg;


               })

         },
         purchasePackagecoin(product_id = '', currency_code = '', hash_unit = 0) {

            // $(".loadrr").modal();
            //$(".loader").show();
            /*if(currency_code != 'BTC')
            {
               axios.post('sendWAMessage', {
                 INR: this.INR,
                 amount: hash_unit,
              })
              this.fundamount = hash_unit;
              this.fundAmountDisplay = hash_unit * this.INR;
              this.product_id = product_id;
              $("#INR-payment").modal("show");
            }
            else
            {*/
            // alert(currency_code);
            // $(".overlay").show();
            // $(".loader").show();
            if (currency_code == 'PM') {
               // $('#login').modal();

               //this.doPayment(hash_unit);
               this.amt = hash_unit;
               /* axios.post('sendWAMessage', {
                  INR: this.INR,
                  amount: hash_unit,
               })
               this.fundamount = hash_unit;
               this.fundAmountDisplay = hash_unit * this.INR;
               this.product_id = product_id;
               $("#INR-payment").modal("show");*/
            } else {

               axios.post('purchase-package', {
                     currency_code: this.typeChange,
                     hash_unit: this.amount,
                  })
                  .then(resp => {
                     if (resp.data.code === 200) {
                        this.getpackagedetails = resp.data.data;
                        this.qrcodevalue = this.getpackagedetails.address;
                        var txn = resp.data.data.txn_details;
                        $('#loader').modal().hide();
                        $('#loader').modal('hide');
                        location.replace(this.getpackagedetails.status_url);
                        /*if (this.getpackagedetails.exists == 0) {
                          location.replace(this.getpackagedetails.status_url);
                        }else{
                          this.$toaster.success("Already requested for same amount");              
                        }*/
                        //$('#demo-default-modal').modal();
                     } else {
                        this.$toaster.error(resp.data.message);
                     }
                  })
                  .catch(error => {});
            }

         },
         get_todays_rank_count() {
            axios
               .get("/getAmount")
               .then(resp => {
                  if (resp.data.code === 200) {
                     //console.log(resp);

                     // this.alrank_data = resp.data.data[0];
                     this.usersleft = resp.data.data.usersleft;
                     this.usersright = resp.data.data.usersright;
                     this.usersrightcounts = resp.data.data.usersrightcounts;
                     this.usersleftcounts = resp.data.data.usersleftcounts;
                     this.todayleft = resp.data.data.todayleft;
                     this.todayright = resp.data.data.todayright;
                  }
               })
               .catch({});
         },
         close() {
            $("#sheet").click(function () {
               $("#myModal").css("display", "none");
            });
         },
         closePopup(id = 'editBankDetailsmodal') {
            $("#" + id).modal("hide");
         },
         closePopup1() {
            this.$router.push("/add-fund-one");
            location.reload();

         },
         disableCpy() {
            $(document).ready(function () {
               $("#referral-link1").bind("cut copy paste", function (e) {
                  e.preventDefault();
               });
            });
         },
         getProSettings() {
            axios
               .get("/getprojectsettings")
               .then(resp => {
                  if (resp.data.code === 200) {
                     this.objProSettings = resp.data.data;
                     // console.log(this.objProSettings);
                  }
               })
               .catch(err => {});
         },
         getusddata() {
            axios
               .get("getusddata", {})
               .then(response => {
                  var usd_data = response.data.data.usddata;
                  this.usddata = parseFloat(usd_data).toFixed(4)
                  /*console.log(this.usddata);*/

               })
               .catch(error => {});
         },
         // myFunctionb() {
         //       var copyText = document.getElementById("referral-link");
         //       copyText.select();
         //       copyText.setSelectionRange(0, 99999)
         //       document.execCommand("copy");

         //       var tooltip = document.getElementById("myTooltip");
         //       tooltip.innerHTML = "Copied: "; //+ copyText.value;
         //   },
         //    outFunct() {
         //       var tooltip = document.getElementById("myTooltip");
         //       tooltip.innerHTML = "Copy to clipboard";
         //   },
         getReferralLink() {
            axios
               .get("/get-reference-id")
               .then(resp => {
                  if (resp.data.code === 200) {
                     this.referrallink = resp.data.data;

                     // this.referrallink = "https://www.arbitude.com/arbitude/public/user#/register?ref_id=7509997056";
                  }
               })
               .catch({});
         },
         rankdisplay() {
            axios
               .get("/getrank", {})
               .then(resp => {
                  if (resp.data.code === 200) {


                     //this.alrank_data = resp.data.data[0];
                     // console.log(resp.data.data); 
                     // this.referrallink = "https://www.arbitude.com/arbitude/public/user#/register?ref_id=7509997056";
                  }
               })
               .catch({});
         },
         getUserDetails() {
            axios
               .get("get-user-dashboard")
               .then(response => {
                  this.userdata = response.data.data;
                  
                  this.series.push(this.userdata.roi_income);
                  this.series.push(this.userdata.direct_income);
                  this.series.push(this.userdata.binary_income);
                  this.series.push(this.userdata.matching_bonus_income);
                  this.referrallink = response.data.data;
                  /*$("#rank").html(this.userdata.rank);*/
                 /* if (this.userdata.show_popup == 1) {
                     $('#show_popup').modal('show');
                  } else {
                     $('#show_popup').modal('hide');
                  }*/
               })
               .catch(error => {});
         },
         getToDoList() {
            axios
               .post("todo-list", {})
               .then(response => {
                  this.todolists = response.data.data;
               })
               .catch(error => {});
         },

         deleteTodo(id) {
            axios
               .post("todo-delete", {
                  id: id
               })
               .then(response => {
                  if (response.data.code == 200) {
                     this.$toaster.success(response.data.message);
                     this.getToDoList();
                  } else {
                     this.$toaster.error(response.data.message);
                  }
               })
               .catch(error => {});
         },

         addTodo() {
            axios
               .post("todo-add", {
                  itemname: this.itemname
               })
               .then(response => {
                  if (response.data.code == 200) {
                     this.$toaster.success(response.data.message);
                     this.getToDoList();
                     this.itemname = "";
                  } else {
                     this.$toaster.error(response.data.message);
                  }
               })
               .catch(error => {});
         },

         getPackages() {
            axios
               .get("get-packages", {})
               .then(response => {
                  this.INR = response.data.data[0]["convert"];
                  this.type = response.data.data[0]["type"];
                  this.getpackages = response.data.data;
               })
               .catch(error => {});
         },
         
         checkPromo() {
            axios
               .post("check/promotonalexist")
               .then(response => {
                  if (response.data.code == 200) {
                     this.displayLink = false;
                  } else {
                     this.displayLink = true;
                  }
               })
               .catch(error => {});
         },

         check90Days() {
            axios.post("check_90_days").then(response => {
                  if (response.data.code == 200) {
                     this.displaymodal = true;
                  } else {
                     this.displaymodal = false;
                  }
               })
               .catch(error => {});
         },

         getAllActivity() {
            axios
               .get("all-activity", {})
               .then(response => {
                  this.useractivities = response.data.data;
               })
               .catch(error => {});
         },
         getUserProfile() {
            axios.get("get-profile-info", {})
               .then(response => {
                  this.userProfile = response.data.data;
               })
               .catch(error => {});
         },
         getUserContestData() {
            axios.post("get-user-contest-data", {})
               .then(response => {
                  this.contest_data = response.data.data;
               })
               .catch(error => {});
         },
         getUserContestData1() {
            let i = 0;
            let that = this;
            let token = localStorage.getItem("user-token");
            setTimeout(function () {
               that.table = $("#contest-data").DataTable({
                  responsive: true,
                  lengthMenu: [
                     [10, 50, 100],
                     [10, 50, 100]
                  ],
                  bLengthChange: false,
                  searching: false,
                  retrieve: true,
                  destroy: true,
                  processing: false,
                  serverSide: true,
                  responsive: true,
                  stateSave: false,
                  ordering: false,
                  bPaginate: false,
                  bInfo: false,
                  ajax: {
                     url: apiUserHost + "get-user-contest-data",
                     type: "POST",
                     data: function (d) {
                        i = 0;
                        i = d.start + 1;

                        let params = {};
                        Object.assign(d, params);
                        return d;
                     },
                     headers: {
                        Authorization: "Bearer " + token
                     },
                     dataSrc: function (json) {
                        if (json.code === 200) {
                           that.arrGetHelp = json.data;
                           json["recordsFiltered"] = json.data;
                           json["recordsTotal"] = 4;
                           return json.data;
                        } else {
                           json["recordsFiltered"] = 0;
                           json["recordsTotal"] = 0;
                           return json;
                        }
                     }
                  },
                  columns: [{
                        render: function (data, type, row, meta) {
                           return i++;
                        }
                     },

                     {
                        render: function (data, type, row, meta) {
                           return that.userdata.l_commander;
                        }
                     },
                     {
                        render: function (data, type, row, meta) {
                           return that.userdata.r_commander;
                        }
                     },
                     {
                        render: function (data, type, row, meta) {
                           return row.required_left_commanders;
                        }
                     },
                     {
                        render: function (data, type, row, meta) {
                           return row.required_right_commanders;
                        }
                     },
                     {
                        render: function (data, type, row, meta) {
                           return row.contest_prize;
                        }
                     },
                     {
                        render: function (data, type, row, meta) {
                           if (row.claim_status == 0) {
                              return `<button class="btn green-claim claimprize">Claim</button>`;
                           } else if (row.claim_status == 1) {
                              return `<button class=" btn red-claim" data-toggle="tooltip" data-placement="top" title="you have already claimed this reward" disaled>Claimed</button>`;
                           } else if (row.claim_status == 2) {
                              return `<span class="label text-danger">Rejected</span>`;
                           } else if (row.claim_status == 3) {
                              return `<span class="label text-danger">You have already claimed another reward</span>`;
                           } else {
                              return `<span class="label text-danger">Not Achieved`;
                           }
                        }
                     },

                  ]
               });
               $('#contest-data').on('click', '.claimprize', function () {
                  if (that.table.row($(this).parents('tr')).data() !== undefined) {
                     var data = that.table.row($(this).parents('tr')).data();
                     that.claim_prize(data, that.table);
                  } else {
                     var data = table.row($(this)).data();
                     that.claim_prize(data, that.table);
                  }
               });
            }, 0);
         },
         sendOTP() {
            var arr = {};
            if (this.mode == "withdraw") {
               if (this.Currency_type == "") {
                  this.withdrawBtn = false;
                  return this.$toaster.error("Please select Currency");

               }
               arr = {
                  type: "Withdrawal"
               };
            } else {
               arr = {
                  type: "transfer"
               };
            }
            axios
               .post("sendOtp-update-user-profile", arr)
               .then((response) => {
                  if (response.data.code == 200) {
                     //console.log(response);
                     this.$toaster.success(response.data.message);
                     //this.statedata=response.data.data.message;
                     this.otp = "";
                     $("#editBankDetailsmodal").modal("show");
                  } else {
                     this.$toaster.error(response.data.message);
                  }
               })
               .catch((error) => {});
         },
         verifyOtp() {
            this.withdrawBtn = true;
            axios
               .post("withdraw-income", {
                  otp: this.otp,
                  level_income_balance: 0,
                  direct_income_balance: 0,
                  roi_balance: 0,
                  binary_income_balance: 0,
                  topup_wallet: 0,
                  addTopup: this.addTopup,
                  transfer_wallet: 0,
                  working_wallet: Number(this.set_working_wallet),
                  mode: this.mode,
                  Currency_type: this.Currency_type,
                  remark: this.remark
               })
               .then((response) => {
                  this.withdrawBtn = false;
                  if (response.data.code == 200) {
                     this.$toaster.success(response.data.message);

                     $("#editBankDetailsmodal").modal("hide");

                     this.$router.push({
                        path: "withdrawals-income-report"
                     });
                  } else {
                     this.$toaster.error(response.data.message);
                     this.otp = "";
                  }
               });
         },
         claim_prize(id) {
            axios.post("claim_prize", {
                  id: id
               }).then(response => {
                  if (response.data.code == 200) {
                     this.$toaster.success(response.data.message);
                     this.getUserContestData();
                  } else {
                     this.$toaster.error(response.data.message);
                  }
               })
               .catch(error => {});
         },
         getLevelView() {
            let i = 0;
            let that = this;
            let token = localStorage.getItem("user-token");
            setTimeout(function () {
               that.table = $("#report-table").DataTable({
                  responsive: true,
                  lengthMenu: [
                     [5, 10, 50],
                     [5, 10, 50]
                  ],
                  retrieve: true,
                  destroy: true,
                  processing: false,
                  serverSide: true,
                  responsive: true,
                  stateSave: false,
                  ordering: false,
                  scrollY: 250,
                  deferRender: true,
                  scroller: true,
                  dom: 'rt',
                  ajax: {
                     url: apiUserHost + "team-view",
                     type: "POST",
                     data: function (d) {
                        i = 0;
                        i = d.start + 1;

                        let params = {
                           user_id: $("#user-id").val(),
                           frm_date: $("#from-date").val(),
                          // to_date: $("#to-date").val(),
                        };
                        Object.assign(d, params);
                        return d;
                     },

                     headers: {
                        Authorization: "Bearer " + token
                     },
                     dataSrc: function (json) {
                        if (json.code === 200) {
                           that.arrGetHelp = json.data.records;
                           json["draw"] = json.data.draw;
                           json["recordsFiltered"] = json.data.recordsFiltered;
                           json["recordsTotal"] = json.data.recordsTotal;
                           return json.data.records;
                        } else {
                           json["draw"] = 0;
                           json["recordsFiltered"] = 0;
                           json["recordsTotal"] = 0;
                           return json;
                        }
                     }
                  },
                  columns: [{
                        "defaultContent": "",
                        render: function (data, type, row, meta) {
                           return i++;
                        }
                     },
                     {
                        data: "user_id",
                        "defaultContent": ""
                     },
                     // { data: 'fullname' },            
                     {
                        data: "position",
                        "defaultContent": ""
                     },
                     {
                        "defaultContent": "",
                        render: function (data, type, row, meta) {
                           if (
                              row.joining_date === null ||
                              row.joining_date === undefined ||
                              row.joining_date === ""
                           ) {
                              return `-`;
                           } else {
                              return moment(String(row.joining_date)).format("YYYY/MM/DD");
                           }
                        }
                     },
                     {
                        "defaultContent": "",
                        render: function (data, type, row, meta) {
                           // that.type == "USD";
                           if (row.amount != 0) {
                              return `<span style="color:green;">Active</span>`;
                           } else {
                              return `<span style="color:red;">Inactive</span>`;
                           }
                        }
                     }
                  ]
               });

               $("#onSearchClick").click(function () {
                  that.table.ajax.reload();
               });
               $("#onResetClick").click(function () {
                  $("#searchForm").trigger("reset");
                  that.table.ajax.reload();
               });

            }, 0);
         },
         sendLink(no) {
            if (no == 1) {
               this.link = this.link1;
            } else {
               this.link = this.link2;
            }
            this.disablebtn = true;
            axios
               .post("store/promotional", {
                  subject: this.subject,
                  link: this.link
               })
               .then(response => {
                  if (response.data.code == 200) {
                     //
                     this.disablebtn = false;
                     this.$toaster.success(response.data.message);
                     this.$router.push({
                        path: "promotional-report"
                     });
                  } else {
                     this.disablebtn = false;
                     this.$toaster.error(response.data.message);
                  }
               });
         }
      }
   };
</script>