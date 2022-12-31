<template>
<div class="account-wraper d-flex reset">
     <div class="cols-section left-container d-flex align-items-center form-seperate">
	    <div class="login-wraper">
		 <form action="#!">
		  <h2 class="md-heading text-left">Reset Password</h2>
		  <p class="text-sm text-left">Please enter your user id below and we will send you OTP on your register mail id</p>
		  <div class="form-group">
         <input type="text" class="form-control inputbg input-lock" autofocus="" v-model="user_id" v-on:input="checkuserexist" placeholder="User Id">
         <div v-if="!useractive" class="tooltip2"><span class="text-danger error-msg-size tooltip-inner">{{ this.usermsg }}</span></div>    
		</div>
		  <div class="robot-wraper d-flex">
		     <div class="left-cols"><img src="public/user_files/assets/images/Component-1.png"></div>
			 <div class="right-cols">
			   <p>Prove that you are not a robot</p>
			   <div class="d-flex justify-content-center align-items-center icon-wraper">
			     <label class="select-label">
				  <input type="radio" name="check">
				  <span><img src="public/user_files/assets/images/hat-icon.png"></span>
				 </label>
				 <label class="select-label next">
				  <input type="radio" name="check">
				  <span><img src="public/user_files/assets/images/probot-icon.png"></span>
				 </label>
			   </div>
			 </div>
		  </div>
		  <p class="p-text">Already have an account ? <router-link to="/login" class="text-primary">Login</router-link></p>
		  <div class="form-group text-center">
      <button type="button" class="btn btn-login reset-btn" @click="sendOTP" :disabled="!isSubmit">Reset</button>
		  </div>
		  </form>
		</div>
	 </div>
	 <div class="cols-section right-container logo-seperate">
	     <div class="logo-image"><a href="#"><img src="public/user_files/assets/images/background-logo.png"></a></div>
	     <div class="logo-text"><img src="public/user_files/assets/images/logo-text.png" class="img-fluid"></div>
	 </div>

   <div class="modal fade" id="Detailsmodal" role="dialog" data-backdrop="static">
                                <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                <div v-show="otpstatus == false">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">            &times;</button>
                                <h4 class="modal-title">Enter Otp</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <!--  <label for="btc_address">Otp </label> -->
                                        <input type="text" name="otp" class="form-control"  placeholder="Enter OTP" v-model="otp" v-validate="'required'"/>
                                        <div class="tooltip2"  v-show="errors.has('otp')">
                                          <div class="tooltip-inner">
                                            <span v-show="errors.has('otp')">{{errors.first("otp")}}</span>
                                          </div>                                        
                                      </div>
                                     
                                      <div class="col-md-12">                                      
                                          <button @click="checkOtp()"  type="button" class="btn btn-primary">Submit</button>
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
import { domain } from "./../../user-config/config";
export default {
  data() {
    return {
      weburl: "",
      useractive: true,
      terms: "",
      user_id: "",
      otp: "",
      otpstatus: "",
      icon: "../public/user_files/assets/img/icon-mlm.png",
      logo: "../public/user_files/assets/img/logo.png",
      hostName: window.location.origin,
      isActiveBtn: true,
    };
  },
  computed: {
    isSubmit() {
      return this.user_id;
    },
  },
  mounted() {
    this.weburl = domain;

    //$('#forgotMe').trigger('click');
    //localStorage.setItem('access_token', "UDGHDFGITIERTMNMNBCVMNBKJC");
  },
  methods: {
    checkuserexist() {
      axios
        .post("checkuserexist", {
          user_id: this.user_id,
        })
        .then((response) => {
          if (response.data.code == 200) {
            this.useractive = true;
          } else {
            this.useractive = false;
            this.usermsg = response.data.message;
          }
        })
        .catch((error) => {});
    },

    forgotPassword() {
      this.isActiveBtn = false;
      axios
        .post("reset-passwordlink", {
          user_id: this.user_id,
        })
        .then((resp) => {
          if (resp.data.code == 200) {
            this.$toaster.success(resp.data.message);
            this.$router.push({ name: "login" });
          } else {
            this.$toaster.error(resp.data.message);
          }
          this.isActiveBtn = true;
        })
        .catch((err) => {});
    },

    sendOTP() {
      axios
        .post("sendOtp-update-user-profile1", {
          user_id: this.user_id,
        })
        .then((response) => {
          if (response.data.code == 200) {
            //console.log(response);
            this.$toaster.success(response.data.message);
            $("#Detailsmodal").modal("show");
            //this.statedata=response.data.data.message;

            $("#forgotMe").trigger("click");
            
          } else {
            this.$toaster.error(response.data.message);
          }
        })
        .catch((error) => {});
    },

    checkOtp() {
      axios
        .post("checkotp2", {
          otp: this.otp,
          user_id: this.user_id,
        })
        .then((response) => {
          if (response.data.code == 200) {
            // this.statedata=response.data.data;
            // this.otp = '';
            $("#forgotMe").trigger("click");
            $("#Detailsmodal").modal("hide");
            //  $('#editBankDetailsmodal').modal('hide');
            //this.otpstatus = true;
            window.location.href = response.data.data;
            /*$('#editBankDetails1').modal('show');*/
            // this.$toaster.success(response.data.message);
          } else {
            this.$toaster.error(response.data.message);
          }
        })
        .catch((error) => {});
    },
  },
      
};
</script>