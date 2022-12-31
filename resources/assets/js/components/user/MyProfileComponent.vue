<template>
 <div class="main-content">
        <UserDetails></UserDetails>			
			  <div class="row profile-container common-rows">
			    <div class="col-12 col-sm-12 col-md-12 col-lg-4 left-cols common-cols">
				   <div class="card card-blur">
					  <div class="card-body">
					     <div class="profile-wraper">
							 <div class="profile-image">
							   <div class="img-wraper">
							     <img src="public/user_files/assets/images/profile-img.jpg">
								 <label for="test" class="custom-file-upload">
								  <div><i class="fa fa-camera" aria-hidden="true"></i></div>
								  <input type="file" id="test">
								</label>
							   </div>
							 </div>
							 <p class="profile-name">{{profile.fullname}}<br><span class="profile-post">{{profile.user_id}}</span></p>
							 <div class="profit-wraper">
								<div class="profit-box d-flex">
								   <div class="profit-name">ROI Profits</div>
								   <div class="profit-value">$ 0</div>
								</div>
								<div class="profit-box d-flex">
								   <div class="profit-name">Binary Profit</div>
								   <div class="profit-value">$ 0</div>
								</div>
								<div class="profit-box d-flex">
								   <div class="profit-name">Direct Profit</div>
								   <div class="profit-value">$ 0</div>
								</div>
							 </div>
							 <div class="btn-wraper mb-3">
							    <button type="button" class="btn btn-custom btn-update">Updated</button>
							 </div>
							 <div class="btn-wraper">
								<button type="button" class="btn btn-transparent btn-edit">Edit Profile</button>
							 </div>
						   </div>
					  </div>
				   </div>
				   
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-8 right-cols common-cols">
				  <div class="card user-card">
				   <div class="card-body user-detail">
				  <ul class="nav nav-pills">
					  <li class="active"><a data-toggle="pill" href="#user-menu" class="active">User Id</a></li>
					  <li><a data-toggle="pill" href="#pass-menu">Change Password</a></li>
					  <li><a data-toggle="pill" href="#paym-info">Payment Info</a></li>
					</ul>
                    
					<div class="tab-content tabs-form">
					  <div id="user-menu" class="tab-pane fade show active">
						 <div class="row align-items-center">
						   <div class="col-12 col-sm-12 col-md-3"><label>User Id</label></div>
						   <div class="col-12 col-sm-12 col-md-9">
						     <div class="form-group">
							  <input type="text" readonly="" class="form-control form-custom" id="inputUserId" v-model="profile.user_id">
							</div>
						   </div>
						 </div>
						 <div class="row align-items-center">
						   <div class="col-12 col-sm-12 col-md-3"><label>Name</label></div>
						   <div class="col-12 col-sm-12 col-md-9">
						     <div class="form-group">
							  <input type="text" class="form-control form-custom" id="inputName" v-model="profile.fullname"  v-on:keypress="isLetter($event)" v-validate="'required|min:5|alpha_spaces|max:30'" maxlength="30" minlength="5">
                <div class="tooltip2" v-show="errors.has('profile.fullname')">
                <div class="tooltip-inner">
                  <span v-show="errors.has('profile.fullname')">{{ errors.first('profile.fullname') }}</span>
                  </div>
                </div>        
              
              </div>
						   </div>
						 </div>
						 <div class="row align-items-center">
						   <div class="col-12 col-sm-12 col-md-3"><label>Email</label></div>
						   <div class="col-12 col-sm-12 col-md-9">
						     <div class="form-group">
							  <input type="text" class="form-control form-custom" id="inputEmail" v-model="profile.email" v-validate="'required|email'">
                
							</div>
						   </div>
						 </div>
						 <div class="row align-items-center">
						   <div class="col-12 col-sm-12 col-md-3"><label>Mobile No.</label></div>
						   <div class="col-12 col-sm-12 col-md-9">
						     <div class="form-group">
							  <input type="text" class="form-control form-custom" id="mobile" maxlength="22"  minlength="6"  @onInput="onInput" defaultCountry="VG" v-model="profile.mobile" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" v-validate="'required|max:22|min:6'">
                          <div class="tooltip2" v-show="errors.has('profile.mobile')">
                                   <div class="tooltip-inner">
                                                  <span v-show="errors.has('profile.mobile')">{{ errors.first('profile.mobile') }}</span>
                                                </div>
                                            </div>
						   </div>
						 </div>
             </div>
						 <div class="row align-items-center mt-3">
						   <div class="col-12 col-sm-12 col-md-12 btn-wraper">
						     <div class="form-group">
              <button type="button" class="btn btn-custom" @click.prevent="sendOTP('profile')"  :disabled=" errors.any() || !isCompleteProfile">Save Changes</button>
							
							</div>
						   </div>
						 </div>
					  </div>
					  <div id="pass-menu" class="tab-pane fade">
						 <div class="row align-items-center">
						   <div class="col-12 col-sm-12 col-md-3"><label>Old Password</label></div>
						   <div class="col-12 col-sm-12 col-md-9">
						     <div class="form-group">
                  <input name="old_password" class="form-control  form-custom" placeholder="Enter Your Old Password" id="old_password" type="password" v-model="updatepassword.old_password" v-validate="'required'" data-vv-as="old password" />
                           <div class="tooltip2" v-show="errors.has('old_password')">
                                  <div class="tooltip-inner">
                                     <span v-show="errors.has('old_password')">{{ errors.first('old_password') }}</span>
                                  </div>
                              </div>

							    </div>
						   </div>
						 </div>
						 <div class="row align-items-center">
						   <div class="col-12 col-sm-12 col-md-3"><label>New Password</label></div>
						   <div class="col-12 col-sm-12 col-md-9">
						     <div class="form-group">
                  <input ref="new_password" name="new_password" class="form-control form-custom" placeholder="Enter Your New Password" maxlength="30" id="new_password" type="password" v-model="updatepassword.new_password" v-validate="'required|min:8|max:30'" data-vv-as="new password"/>
                  <div class="tooltip2" v-show="errors.has('new_password')">
                              <div class="tooltip-inner">
                                <span v-show="errors.has('new_password')">{{ errors.first('new_password') }}</span>
                              </div>
                            </div>
							</div>
						   </div>
						 </div>
						 <div class="row align-items-center">
						   <div class="col-12 col-sm-12 col-md-3"><label>Retype Password</label></div>
						   <div class="col-12 col-sm-12 col-md-9">
						     <div class="form-group">
                  <input name="retype_password" class="form-control form-custom" placeholder="Re-Type New Password" id="retype_password" type="password" v-model="updatepassword.retype_password"  v-validate="'required|confirmed:new_password'"  maxlength="30" data-vv-as="re-enter password" v-on:keyup="onPasswordClick"/>
							 <div class="tooltip2" v-show="errors.has('retype_password')">
                              <div class="tooltip-inner">
                                <span v-show="errors.has('retype_password')">{{ errors.first('retype_password') }}</span>
                              </div>
                            </div>
                     </div>
						   </div>
						 </div>
						 <div class="row align-items-center mt-3">
						   <div class="col-12 col-sm-12 col-md-12 btn-wraper dbls-wraper">
						     <div class="form-group">
                      <button type="button" @click.prevent="sendOTP('password')" :disabled='!isCompletePassword || errors.any() || !isDisableBtn' class="btn btn-custom">Update Password</button>
							  <button type="reset" class="btn btn-transparent" @click="ResetField()">Reset Password</button>
							</div>
						   </div>
						 </div>
					  </div>
					<div id="paym-info" class="tab-pane fade">
						 <div class="row align-items-center">
						   <div class="col-12 col-sm-12 col-md-3"><label>BTC Address</label></div>
						   <div class="col-12 col-sm-12 col-md-9">
						     <div class="form-group">
                <input type="text" id="btc_add" maxlength="42" class="form-control form-custom" required placeholder="BTC Address" v-model="profile.btc_address" name="btc_address" v-on:input="checkaddress"/>
                              <div v-if="!btcactive" class="tooltip2">
                              <span class="text-danger error-msg-size tooltip-inner">{{ this.btcmsg }}</span>
                              </div>                  
							    </div>
						   </div>              
              </div>
              <div class="row align-items-center">
						   <div class="col-12 col-sm-12 col-md-3"><label>Litecoin Address</label></div>
						   <div class="col-12 col-sm-12 col-md-9">
						     <div class="form-group">
                        <input type="text" maxlength="42" id="ltc_address" class="form-control form-custom" required placeholder="Litecoin Address" v-model="profile.ltc_address" name="ltc_address" v-on:input="checkLTCAddress"/>
                      <div v-if="!ltcactive" class="tooltip2">
                      <span class="text-danger error-msg-size">{{ this.ltcmsg }}</span>
                     </div>                
							    </div>
						   </div>              
              </div>
            <div class="row align-items-center">
              <div class="col-12 col-sm-12 col-md-3"><label>TRX Address</label></div>
						   <div class="col-12 col-sm-12 col-md-9">
						         <div class="form-group">
                        <input type="text" maxlength="42" id="trx_add" class="form-control form-custom" required placeholder="TRX Address" v-model="profile.trx_address" name="trx_address" v-on:input="checkTRXAddress(1)"/>
                             <div v-if="!trxactive" class="tooltip2">
                             <span class="text-danger error-msg-size">{{ this.trxmsg }}</span>
                              </div>            
							    </div>
						   </div>
               </div>
             <div class="row align-items-center">
              <div class="col-12 col-sm-12 col-md-3"><label>USDT-TRC20 Address</label></div>
						   <div class="col-12 col-sm-12 col-md-9">
						         <div class="form-group">
                        <input type="text" maxlength="42" id="usdt_add" class="form-control form-custom" required placeholder="USDT-TRC20 Address" v-model="profile.usdt_trc20_address" name="usdt-trc20_address" v-on:input="checkTRXAddress(2)"/>
                             <div v-if="!usdttrxactive" class="tooltip2">
                             <span class="text-danger error-msg-size">{{ this.usdttrxmsg }}</span>
                              </div>            
							        </div>
						   </div>
               </div>
            <div class="row align-items-center">
              <div class="col-12 col-sm-12 col-md-3"><label>Solona Address</label></div>
						   <div class="col-12 col-sm-12 col-md-9">
						         <div class="form-group">
                        <input type="text" maxlength="45" id="sol_add" class="form-control form-custom" required placeholder="Solona Address" v-model="profile.sol_address" name="sol_address"  v-validate="'alpha_num'"  v-on:input=" checkSOLAddress" @keydown.space.prevent
                         onkeypress="return ((event.charCode > 64 && event.charCode < 91) || (event.charCode > 96
                          && event.charCode < 123) || event.charCode == 8 || event.charCode == 32 || (event.charCode >= 48 && event.charCode <= 57));"/>
                             <div v-if="!solactive" class="tooltip2">
                             <span class="text-danger error-msg-size">{{ this.solmsg }}</span>
                              </div>            
							        </div>
						   </div>
               </div>
           <div class="row align-items-center">
              <div class="col-12 col-sm-12 col-md-3"><label>Dogecoin Address</label></div>
						   <div class="col-12 col-sm-12 col-md-9">
						         <div class="form-group">
                        <input type="text" maxlength="42" id="bnb_add" class="form-control form-custom" required placeholder="Dogecoin Address" v-model="profile.doge_address" name="doge_address" v-on:input="checkDOGEAddress()"/>
                             <div v-if="!dogeactive" class="tooltip2">
                             <span class="text-danger error-msg-size">{{ this.dogemsg }}</span>
                              </div>            
							        </div>
						   </div>
               </div>

             <div class="row align-items-center mt-3">
						   <div class="col-12 col-sm-12 col-md-12 btn-wraper">
						     <div class="form-group">
                      <button type="button" class="btn btn-custom"  :disabled="!isCompleteAddress || !trxactive || !btcactive || !dogeactive || !ltcactive || !ethactive || !usdttrxactive ||!solactive" @click.prevent="sendOTP('address')" >Save Changes</button>
							</div>
						   </div>
						 </div>
             
						 </div>					 
					  </div>					
          </div>
				   </div>
				  </div>

          <div class="modal fade" id="editBankDetailsmodal" role="dialog"  data-backdrop="static">
                    <div class="modal-dialog pops">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div v-show="otpstatus==false">
                          <div class="modal-header">
                            <h4 class="modal-title">Enter OTP</h4>
                            <button type="button" class="close" @click="closePopup()" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-3 col-3">
                                  <img src="public/user_files/assets/images/otp.png" class="img-fluid">
                                </div>
                                <div class="col-md-9 col-9">
                                  <!--  <label for="btc_address">Otp </label> -->
                                  <input
                                    type="text"
                                    name="otp"
                                    id="otp_number"
                                    class="form-control"
                                    placeholder="Enter OTP"
                                    v-model="otp"
                                    v-validate="'required'"
                                  />

                                  <div class="tooltip2" v-show="errors.has('otp')">
                                    <div class="tooltip-inner">
                                      <span v-show="errors.has('otp')">{{ errors.first('otp') }}</span>
                                    </div>
                                  </div>
                                </div>

                                <br />
                                <br />
                                <br />
                                <br />
                                <div class="clearfix"></div>
                                <div class="col-md-12">                               
                               <button @click="verifyOtp()" type="button" class="btn btn-primary kbb-bbt">Submit</button>
                               </div>
                              </div>
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
  import Breadcrum from './BreadcrumComponent.vue';
import UserDetails from './UserDetails.vue';
     export default {  
        components: {
    Breadcrum,
    UserDetails
}, 
        data() {
           return {
               isDisableBtn:true,
               nameErr:'',
             mobile_data:'',

              working_balance: 0,
              type:'',
              btcactive: true,
              otpstatus:'',
              otpverifyre:'',
              btcmsg: '',
              trxmsg: '',
              btc_preset: 0,
              otp:'',
              profile: {
                 //code:'',
                 user_id: '',
                // sponser: '',
                 //sponser_fullname: '',
                 //sponser_country: '',
                 fullname: '',
                 //city: '',
                 email: '',
                 btc_address: '',
                 trx_address:'',
                 usdt_trc20_address:'',
                 sol_address:'',
                 ltc_address:'',
                // perfect_money_address: '',
                // country: '',
                 mobile: '',
                 address: '',
                 ref_user_id: '',
                  holder_name: '',
                      bank_name: '',
                      branch_name: '',
                      pan_no: '',
                      ifsc_code: '',    
                      btc_address:'',
                      account_no:'',
                       bnb_address:"",
                       ethereum:"",
                      // bnb_address:"",
              },
              isValidBTCAddress: true,
              updatepassword: {
                      old_password: '',
                      new_password: '',
                      retype_password: '',
              }, 
             // profile: [],
             // updatepassword:[],
              btcactive:true,
              disablebtn:false,  
              //btc_address:'',
              //btc_addresses:'',
              typingTimer:'',
              btc_error:false,
              doneTypingInterval:500,
              photo:'',
              isDisableBtn:true,
              trxactive:true,
              bnbactive:true,
              ltcactive:true,
              usdttrxactive:true,
             // photoSelected:'',
              proimg:'user_files/img/avatar-1-256.png',
  
           }
        },
        computed: {

       
          isCompleteProfile() {
            return (
              this.profile.fullname &&
              this.profile.email &&
              this.profile.mobile
            );
          },
          ResetField(){ 
         this.updatepassword.old_password="";
         this.updatepassword.new_password="";
         this.updatepassword.retype_password="";
         },
          isCompleteAddress() {
            // alert(this.profile.btc_address);
             return (
               this.profile.btc_address || this.profile.trx_address  || this.profile.usdt_trc20_address || this.profile.ltc_address || this.profile.doge_address|| this.profile.sol_address || this.profile.eth_address
             );
           },
          isCompletePassword(){
            return this.updatepassword.old_password && this.updatepassword.new_password && this.updatepassword.retype_password;
          }
        },
        mounted() {
           this.readProfile();
           this.getWorkingWithdrawal();
           //this.getPackages();
          // this.getProfileImg();
        },
        methods: {
         moveTop(){
           document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;

        },
        isLetter(e) {
          let char = String.fromCharCode(e.keyCode); // Get the character
          if(/^[A-Za-z ]+$/.test(char)) return true; // Match with regex 
          else e.preventDefault(); // If not match, don't add to input text
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
            onInput({ number, isValid, country }) {
         // console.log(number)
         if (number) {
           this.checkMobileValid = isValid;
           this.getcountry = country;
           // this.temp = number.split(" ");
           //   this.temp.shift();
           this.getMobile = number.input;
           this.profiledata.mobile = this.getMobile;
           this.profiledata.country = country.iso2;
           this.getCountryCode = country.iso2;
         }
       },
            readProfile() {      
              axios.post('get-profile-info', {
              })
              .then(response => {  
                 this.profile = response.data.data;
                 //this.btc_addresses = response.data.data.btc_address;
              })
              .catch(error => {
              });
            },
            checkTRXAddress(addFor){
               var trx_address = "";
               if(addFor == "1"){
                  trx_address = ""+this.profile.trx_address+"";
               }else{
                  trx_address = ""+this.profile.usdt_trc20_address+"";
               }
               if(trx_address.charAt(0) == 't' || trx_address.charAt(0) == 'T' || trx_address == ''){
                  this.trxactive = true;
                  this.usdttrxactive = true;
                  this.trxmsg = "";
                  this.usdttrxmsg = "";
               }else{
                  if(addFor == 1){
                     this.trxactive = false;
                     this.trxmsg = "TRX Address should be start with 'T or t'";
                  }else{
                     this.usdttrxactive = false;
                     this.usdttrxmsg = "USDT-TRC20 Address should be start with 'T or t'";
                  }
               }
            },
            checkLTCAddress(){
               let ltc_address = ""+this.profile.ltc_address+"";
               // console.log(ltc_address.substring(1,4));
               if(ltc_address.charAt(0) == '3' || ltc_address.charAt(0) == 'L' || ltc_address.charAt(0) == 'M' || ltc_address == ''){
                  this.ltcactive = true;
                  this.ltcmsg = "";
               }else{
                  this.ltcactive = false;
                  this.ltcmsg = "Litecoin Address should be start with '3 or L or M'";
               }
            },

            checkBNBAddress(){
               let bnb_bsc_address = ""+this.profile.bnb_bsc_address+"";
               if(bnb_bsc_address.charAt(0) == '0' || bnb_bsc_address.charAt(0) == '1' || bnb_bsc_address == ''){
                  this.bnbactive = true;
                  this.bnbmsg = "";
               }else{
                  this.bnbactive = false;
                  this.bnbmsg = "BNB-BSC Address should be start with '0 or 1'";
               }
            },
            getPackages() {
              axios.get('get-packages', {})
                  .then(response => {
                      this.getpackages = response.data.data;
                      this.type = response.data.data[0]['type'];
                  })
                  .catch(error => {});
            },
            updateUserData() {
                Swal({
                    title: 'Are you sure?',
                    text: `You want to update this user`,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.value) {
                        axios.post('user-update', {
                                fullname: this.profile.fullname,
                                email: this.profile.email,
                                mobile: this.profile.mobile,
                                btc: this.profile.btc_address,
                                country: this.profile.country,
                                account_no: this.profile.account_no,
                                holder_name: this.profile.holder_name,
                                pan_no: this.profile.pan_no,
                                bank_name: this.profile.bank_name,
                                ifsc_code: this.profile.ifsc_code,
                                branch_name: this.profile.branch_name,

                            })
                            .then(response => {
                                if (response.data.code == 200) {
                                    this.$toaster.success(response.data.message);
                                } else {
                                    this.$toaster.error(response.data.message);
                                }
                            })
                            .catch(error => {});
                    }
                });
            },
            getCountry() {
                axios.get("country").then(response => {
                    this.countries = response.data.data;
                }).catch(error => {

                });
            },
            verifyOtp() {
               
                    if (this.otpverifyre == "profile") {
                      this.updateUserDetails();
                    } else if (this.otpverifyre == "password") {
                      this.updateUserPassword();
                    } else if (this.otpverifyre == "address") {
                      this.changeAddress();
                    }
                  
            },
            // verifyOtp() {
            //   axios
            //     .post("verify-user-otp", {
            //       otp: this.otp,
            //     })
            //     .then((response) => {
            //       if (response.data.code == 200) {
            //         // this.otpVerified = true;
            //         this.$toaster.success(response.data.message);
            //         this.otpSent = true;
            //         this.optVerified = true;
            //         if (this.otpverifyre == "profile") {
            //           this.updateUserDetails();
            //         } else if (this.otpverifyre == "password") {
            //           this.updateUserPassword();
            //         } else if (this.otpverifyre == "address") {
            //           this.changeAddress();
            //         }
            //         // this.otp = '';
            //         $("#editBankDetailsmodal").modal("hide");
            //       } else {
            //         this.$toaster.error(response.data.message);
            //       }
            //     })
            //     .catch((error) => {
            //       this.message = "";
            //     });
            // },
            updateUserDetails(){
              axios.post('update-user-deatils',{
                  otp: this.otp,
                  fullname: this.profile.fullname,
                  email: this.profile.email,
                  mobile: this.profile.mobile,
                  btc: this.profile.btc_address,
                  country: this.profile.country,
                  account_no: this.profile.account_no,
                  holder_name: this.profile.holder_name,
                  pan_no: this.profile.pan_no,
                  bank_name: this.profile.bank_name,
                  ifsc_code: this.profile.ifsc_code,
                  branch_name: this.profile.branch_name,
              }).then(response=>{
                  if(response.data.code == 200){
                     // this.statedata=response.data.data;
                     // this.otp = '';
                      $('#editBankDetailsmodal').modal('hide');
                     this.otpstatus = false; 
                     /*$('#editBankDetails1').modal('show');*/
                     // this.$router.push({ path: "my-profile" });
                     this.$toaster.success(response.data.message);
                     // location.reload();
                  }else{    
                       this.$toaster.error(response.data.message);
                     }
              }).catch(error=>{
              }) 
            },
            checkOtp(){
              axios.post('checkotp1',{
                  otp:this.otp,
                  fullname: this.profile.fullname,
                  email: this.profile.email,
                  mobile: this.profile.mobile,
                  btc: this.profile.btc_address,
                  country: this.profile.country,
                  account_no: this.profile.account_no,
                  holder_name: this.profile.holder_name,
                  pan_no: this.profile.pan_no,
                  bank_name: this.profile.bank_name,
                  ifsc_code: this.profile.ifsc_code,
                  branch_name: this.profile.branch_name,
              }).then(response=>{
                  if(response.data.code == 200){
                     // this.statedata=response.data.data;
                     // this.otp = '';
                      $('#editBankDetailsmodal').modal('hide');
                     this.otpstatus = false; 
                     /*$('#editBankDetails1').modal('show');*/
                     this.$toaster.success(response.data.message);

                  }else{    
                       this.$toaster.error(response.data.message);
                     }
              }).catch(error=>{
              }) 
            },
            closePopup(){
              $("#editBankDetailsmodal").modal("hide");
            },
        
            checkTRXAddress(addFor){
              var trx_address = "";
              if(addFor == "1"){
                 trx_address = ""+this.profile.trx_address+"";
              }else{
                 trx_address = ""+this.profile.usdt_trc20_address+"";
              }
              if(trx_address != ""){
               if(trx_address.charAt(0) == 't' || trx_address.charAt(0) == 'T' || trx_address == ''){

                   if(trx_address.length >= 26 && trx_address.length <= 45){
                       this.trxactive = true;
                       this.usdttrxactive = true;
                       this.trxmsg = "";
                       this.usdttrxmsg = "";
                     }else{
                         if(addFor == 1){
                           this.trxactive = false;
                           this.trxmsg = "TRX Address must have minimum 26 and maximum 45 characters";
                         }else{
                           this.usdttrxactive = false;
                           this.usdttrxmsg = "USDT-TRC20 Address must have minimum 26 and maximum 45 characters";
                         }
                   }
                 
               }else{
                   if(addFor == 1){
                     this.trxactive = false;
                     this.trxmsg = "TRX Address should be start with 'T or t'";
                   }else{
                     this.usdttrxactive = false;
                     this.usdttrxmsg = "USDT-TRC20 Address should be start with 'T or t'";
                   }
               }

              }else{
                   this.trxactive = true;
                   this.usdttrxactive = true;
                   this.trxmsg = "";
                   this.usdttrxmsg = "";
              }
           },

            checkLTCAddress(){
               let ltc_address = ""+this.profile.ltc_address+"";
               if(ltc_address != ""){
                 if(ltc_address.charAt(0) == 'L' || ltc_address.charAt(0) == 'M' || ltc_address.charAt(0) == 'l' && ltc_address.charAt(1) == 't' && ltc_address.charAt(2) == 'c' && ltc_address.charAt(3) == '1' || ltc_address == ''){
                    if(ltc_address.length >= 26 && ltc_address.length <= 45){

                    this.ltcactive = true;
                    this.ltcmsg = "";
                    }else{
                       this.ltcactive = false;
                       this.ltcmsg = "Litecoin Address must have minimum 26 and maximum 45 characters";
                    }
                 }else{
                    this.ltcactive = false;
                    this.ltcmsg = "Litecoin Address should be start with 'L' or 'M' or 'ltc1'";
                 }
               }else{
                   this.ltcactive = true;
                    this.ltcmsg = "";
               }
               console.log(ltc_address.substring(1,4));
            },
  
            checkBNBAddress(){
               let bnb_bsc_address = ""+this.profile.bnb_bsc_address+"";
               if(bnb_bsc_address != ""){
                 if(bnb_bsc_address.charAt(0) == '0' || bnb_bsc_address.charAt(0) == '1' || bnb_bsc_address == ''){
                 if(bnb_bsc_address.length >= 26 && bnb_bsc_address.length <= 45){

                    this.bnbactive = true;
                    this.bnbmsg = "";
                 }else{
                       this.bnbactive = false;
                       this.bnbmsg = "BNB-BSC Address must have minimum 26 and maximum 45 characters";
                    }
                 }else{
                    this.bnbactive = false;
                    this.bnbmsg = "BNB-BSC Address should be start with '0 or 1'";
                 }

               }else{
                    this.bnbactive = true;
                    this.bnbmsg = "";
               }
            },

            checkDOGEAddress(){
              let doge_address = ""+this.profile.doge_address+"";
              // console.log(ltc_address.substring(1,4));
              if(doge_address != ""){
                 if(doge_address.charAt(0) == 'D' || doge_address == ''){
                 if(doge_address.length >= 26 && doge_address.length <= 45){
                    this.dogeactive = true;
                    this.dogemsg = "";
                    }else{
                          this.dogeactive = false;
                          this.dogemsg = "Doge Address must have minimum 26 and maximum 45 characters";
                       }
                 }else{
                    this.dogeactive = false;
                    this.dogemsg = "Doge Address should be start with 'D'";
                 }

              }else{
                 this.dogeactive = true;
                    this.dogemsg = "";
              }
           },

            checkETHAddress(){
               let ethereum = ""+this.profile.eth_address+"";
               if(ethereum != ""){
                 if(ethereum.charAt(0) == '0' && ethereum.charAt(1) == 'x' || ethereum == ''){

                    if(ethereum.length >= 26 && ethereum.length <= 45){
                    this.ethactive = true;
                    this.ethmsg = "";
                    }else{
                          this.ethactive = false;
                          this.ethmsg = "Ethereum Address must have minimum 26 and maximum 45 characters";
                       }
                 }else{
                    this.ethactive = false;
                    this.ethmsg = "Ethereum Address should be start with '0x'";
                 }

               }else{
                    this.ethactive = true;
                    this.ethmsg = "";
               }
           },

             checkXRPAddress(){
              let xrp_address = ""+this.profile.xrp_address+"";
              // console.log(ltc_address.substring(1,4));
              if(xrp_address != ""){
                 if(xrp_address.charAt(0) == 'r' || xrp_address == ''){
                 if(xrp_address.length >= 26 && xrp_address.length <= 45){
                    this.xrpactive = true;
                    this.xrpmsg = "";
                    }else{
                          this.xrpactive = false;
                          this.xrpmsg = "Ripple Address must have minimum 26 and maximum 45 characters";
                       }
                 }else{
                    this.xrpactive = false;
                    this.xrpmsg = "Ripple Address should be start with 'r'";
                 }

              }else{
                 this.xrpactive = true;
                 this.xrpmsg = ""; 
              }
           },

            checkSOLAddress(){
              let sol_address = ""+this.profile.sol_address+"";
              // console.log(ltc_address.substring(1,4));
              if(sol_address != ""){
                 if(sol_address.charAt(0) == 's' || sol_address == ''){
                 if(sol_address.length >= 26 && sol_address.length <= 45){
                    this.solactive = true;
                    this.solmsg = "";
                    }else{
                          this.solactive = false;
                          this.solmsg = "Solana Address must have minimum 26 and maximum 45 characters";
                       }
                 }else{
                    this.solactive = false;
                    this.solmsg = "Solana Address should be start with 's'";
                 }

              }else{
                 this.solactive = true;
                    this.solmsg = "";
              }
           }, 
            sendOTP(e){
              this.otpverifyre = e;
              document.getElementById('otp_number').value = ''; 
              axios.post('sendOtp-update-user-profile').then(response=>{

                    if(response.data.code == 200){
                        //console.log(response);
                        this.$toaster.success(response.data.message);
                        //this.statedata=response.data.data.message;
                   
                    $('#editBankDetailsmodal').modal('show');

                    }else{                 
                           this.$toaster.error(response.data.message);
                       }
                }).catch(error=>{
                })  
            },
            updateUserPassword() {
                this.disablebtn = true;
                var new_password = this.updatepassword.new_password;
                var retype_password = this.updatepassword.retype_password;
                if (new_password == retype_password) {
                    axios.post('change-password', { 
                        otp: this.otp,                   
                        current_pwd: this.updatepassword.old_password,
                        new_pwd: this.updatepassword.new_password,
                        conf_pwd: this.updatepassword.retype_password,           
                    })
                    .then(response => {     
                        if(response.data.code === 200) {  
                        this.$toaster.success(response.data.message);
                       // $('#update-user-password').trigger("reset"); 
                        $('#editBankDetailsmodal').modal('hide');
                        this.$router.push({ path: "my-profile" });
                        this.otpstatus = false; 
                       // this.clearPassword()  
                         this.disablebtn = false;
                          location.reload();
                        }else{
                            this.$toaster.error(response.data.message);
                             this.disablebtn = false;
                        }                     
                    })
                } else {
                    this.$toaster.error('New Password and Reset Password Not Matched...');
                     this.disablebtn = false;
                }                
            },
            clearPassword() {
                this.updatepassword.old_password = '';
                this.updatepassword.new_password = '';
                this.updatepassword.retype_password = '';
            },
            uploadImameModal(){
              $('#upload-modal').modal('show');
            },
            photoSelected(evt) {
               // alert();
                $('#uploadPhoto').attr('disabled',false);
            },
            onUploadDocuments(upload_type) {  
              /* Create FormData object */
              let formData = new FormData();
              /* 
                  Here we check file uploading type that is photo, pan card or address proof.
                  Append file upload to photo.
              */
              if(upload_type == 'photo'){
                  if(this.$refs.photo.files[0] != ''){
                      formData.append('photo', this.$refs.photo.files[0]);
                  }               
              }
              /*if(upload_type == 'pan'){
                  if(this.$refs.pan.files[0] != ''){
                      formData.append('photo', this.$refs.pan.files[0]);
                  }             
              }
              if(upload_type == 'address'){
                  if(this.$refs.address.files[0] != ''){
                      formData.append('photo', this.$refs.address.files[0]);
                  }
              }*/
              /* Here we append file type that is photo, pan card or address proof. */
              formData.append('name', upload_type);                
              axios.post('upload-photos',
                  formData,
                  {
                      headers: {
                          'Content-Type': 'multipart/form-data'
                      }
                  }
              )
              .then(response => { 
                  this.$toaster.success(response.data.message);
                  $('#update-user-documents').trigger("reset");
                  this.getProfileImg();
                 //this.readUserDocuments();
              })
            },
            getProfileImg(){
               axios.post('get-profile-img').then(response=>{

                    if(response.data.code == 200){
                        this.proimg = response.data.data.attachment;
                    }else{                 
                           //this.$toaster.error(response.data.message);
                       }
                }).catch(error=>{
                })  
            },
            changeAddress(){
              axios.post('change-address', {   
                  otp: this.otp,                   
                  btc: this.profile.btc_address,
                  trn: this.profile.trx_address,        
                  bnb_bsc: this.profile.bnb_bsc_address ,   
                  sol_add: this.profile.sol_address ,        
                  usdt_trc20: this.profile.usdt_trc20_address, 
                  ltc:this.profile.ltc_address,
                  doge: this.profile.doge_address,
                  bch: this.profile.bch_address,
                  shib: this.profile.shib_address,
                  pm : this.profile.pm_address,    
              })
              .then(response => {     
                  if(response.data.code === 200) {  
                    this.$toaster.success(response.data.message);
                    $('#editBankDetailsmodal').modal('hide');
                     this.otpstatus = false; 
                     this.$router.push({ path: "my-profile" });
                    this.disablebtn = false;
                    // location.reload();
                  }else{
                    this.$toaster.error(response.data.message);
                    this.disablebtn = false;
                  }                     
              });
            },
            checkaddress() {
              this.btcactive = false;
              this.btcmsg = "Bitcoin address is not valid";
              let btc_address = ""+this.profile.btc_address+"";
               // console.log(ltc_address.substring(1,4));
               if(btc_address.charAt(0) == '3' || btc_address.charAt(0) == '1' || btc_address.charAt(0) == 'b' || btc_address == ''){
                  axios
                   .post("check_address", {
                     network_type: "BTC",
                     address: this.profile.btc_address
                   })
                   .then(response => {

                     if (response.data.code == 200) {
                       this.btcactive = true;
                        this.btcmsg = "";
                     } else {
                       this.btcactive = false;
                       this.btcmsg = response.data.message;
                     }
                   })
                   .catch(error => {});
                  
               }else{
                  this.btcactive = false;
                  this.btcmsg = "Bitcoin Address should be start with '3 or 1 or b'";
               }              
            },
    onPasswordClick() {
         this.one_letter = "invalid";
         this.greater_than_8 = "invalid";
         this.one_capital_letter = "invalid";
         this.special_char = "invalid";
         this.one_number = "invalid";
         this.starting_with_letter = "invalid";
         this.password_validation_msg = true;
   
         if (
           this.updatepassword.new_password.substring(0, 1) ==
           this.updatepassword.new_password.match(/[A-z]/)
         ) {
           this.starting_with_letter = "valid";
         }
   
         if (
           this.updatepassword.new_password.length >= 8 &&
           this.updatepassword.new_password.length <= 22
         ) {
           this.greater_than_8 = "valid";
         }
         if (this.updatepassword.new_password.match(/[a-z]/)) {
           this.one_letter = "valid";
         }
   
         if (this.updatepassword.new_password.match(/[A-Z]/)) {
           this.one_capital_letter = "valid";
         }
         if (this.updatepassword.new_password.match(/[0-9]/)) {
           this.one_number = "valid";
         }
   
         if (this.updatepassword.new_password.match(/[^a-zA-Z0-9\-\/]/)) {
           this.special_char = "valid";
         }
         if (this.updatepassword.new_password.match(/\s/g)) {
           this.special_char = "valid";
         }
         if (
           this.one_letter === "valid" &&
           this.greater_than_8 === "valid" &&
           this.one_capital_letter === "valid" &&
           this.special_char === "valid" &&
           this.one_number === "valid" &&
           this.starting_with_letter === "valid"
         ) {
           //this.flag_for_hide_validation_messege = false;
           this.password_validation_msg = false;
         } else {
           this.errors.add({
             field: "new_password",
             msg: "password not valid",
           });
           this.password_validation_msg = true;
         }
         if (this.updatepassword.new_password != this.updatepassword.retype_password) {
           /*this.errors.add('this.password_confirmation', 'not match')*/
           this.errors.add({
             field: "retype_password",
             msg: "password does not match",
           });
         }
       },
   
  
        }      
     }
</script>