<template>
  <div class="account-wraper d-flex register">
     <div class="cols-section left-container d-flex align-items-center">
	    <div class="">
		  <div class="logo-image"><img src="public/user_files/assets/images/background-logo.png"></div>
		  <div class="logo-text"><img src="public/user_files/assets/images/logo-text.png" class="img-fluid"></div>
		</div>
	 </div>
	 <div class="cols-section right-container">
	     <div class="wraper-form">
		  <form @submit.prevent="registerUser" data-vv-scope="registerform" autocomplete="off">
                                   
		   <h2 class="md-heading">Registration</h2>
		   <p class="sm-text">By registering you agree to the terms of use</p>
		   <p class="sm-text mb-4 text-medium">Already have an account? <router-link to="/login" class="text-primary"><strong>Login</strong></router-link></p>
		   <div class="row">
		    <div class="col-md-6">
			   <div class="form-group pass-grp">
		   <input type="text" placeholder="User Id"  class="form-control inputbg input-user" v-model="register.user_id" v-validate="'required|alpha_num|min:5|max:30'" data-vv-as="user_id" readonly=""/>                             
          <div v-if="useractive1" class="tooltip2"> <span class="text-danger error-msg-size tooltip-inner">
            {{ this.usermsg1 }}</span>
              </div>
            <div class="tooltip2" v-show="errors.has('user_id')">
                 <div class="tooltip-inner">
                      <span v-show="errors.has('user_id')">{{ errors.first("user_id") }}</span> 
                  </div>
            </div>
        </div>           
        </div>	
			 <div class="col-md-6">
         <div class="form-group pass-grp">
				<!--<input type="text" class="form-control inputbg input-user" placeholder="Enter Your Full Name" id="fname">-->
         <input type="text" name="fullname" class="form-control inputbg input-user" placeholder="Enter Your Full Name" v-on:keypress="isLetter($event)" v-model="register.fullname" v-validate="'required|alpha_spaces|min:5|max:30'" data-vv-as="Name" maxlength="30" v-on:input="checkuserexist(1)">
          <div class="tooltip2" v-show="errors.has('registerform.fullname')">
          <div class="tooltip-inner">
            <span v-show="errors.has('registerform.fullname')">{{ errors.first('registerform.fullname') }}</span>
             </div>
          </div>
			   </div>			   			
		   </div>    
       </div>
		   <div class="row">
        <div class="col-md-6">
			    <div class="form-group pass-grp">
			          <select v-model="register.country" placeholder="Select Country name." id="country" class="form-control inputbg input-sponsor" v-validate="'required'">
                  <option value="" selected>Select Country</option>
                    <option v-for="con in countries" v-bind:key="con.id" :value="con.iso_code">{{con.country}}</option>
                </select> 
                <div v-if="countryerr !== ''" class="tooltip2">
                  <span class=" text-danger">{{ this.countryerr }}</span>
                </div>
			 </div>
			 </div>		   
			 <div class="col-md-6">

        <div class="form-group pass-grp">
				<!--<input type="password" class="form-control inputbg input-mail" placeholder="Enter Your Mail Id" id="pwd">-->
			   <input type="text"  name="email" id="email" class="form-control inputbg input-mail" placeholder="Enter Your Mail Id"  v-model="register.email" v-validate="'required|email|max:70'" data-vv-as="email" autocomplete="false">
         <div class="tooltip2" v-show="errors.has('registerform.email')">
            <div class="tooltip-inner">
            <span v-show="errors.has('registerform.email')">{{ errors.first('registerform.email') }}</span>
            </div>
          </div>
        </div>
			 
		   </div>
       </div>
		   <div class="row">
		     <div class="col-md-6">
			   <div class="form-group pass-grp">
				<!--<input type="text" class="form-control inputbg input-phone" placeholder="Enter Your Phone No." id="phno">-->
         <input  type="text" maxlength="22"  minlength="6" name="mobile" @onInput="onInput" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" defaultCountry="VG" class="form-control inputbg input-phone" placeholder="Enter Your Mobile No." v-model="register.mobile"  data-vv-as="mobile" v-validate="'required|max:22|min:6'"/>
                                           <div class="tooltip2" v-show="errors.has('registerform.mobile')">
                                                 <div class="tooltip-inner">
                                                  <span v-show="errors.has('registerform.mobile')">{{ errors.first('registerform.mobile') }}</span>
                                                </div>
                                            </div>
			   </div>
			 </div>
       <div class="col-md-6">
			  <div class="form-group pass-grp">
				<!--<input type="text" class="form-control inputbg input-sponsor" placeholder="Enter Your Sponsor's Id" id="sponid">-->
			     <input type="text" name="referral_id"  maxlength="22" class="form-control inputbg input-sponsor" placeholder="Enter Sponsor Id" v-model="register.referral_id" v-validate="'required|min:5'" v-on:input="checkuserexist(2)" id="referral_id" data-vv-as="referral id">
              <div v-if='!useractive' class="tooltip2">
              <div class="tooltip-inner">
                <span class="tooltip-inner">{{ this.usermsg }}</span>
                </div>
                </div>
             <!--<div class="tooltip2" v-show="errors.has('registerform.referral_id')">
                  <div class="tooltip-inner">
                    <span v-show="errors.has('registerform.referral_id')">{{ errors.first('registerform.referral_id') }}</span>
               </div>
            </div>-->
			 </div>
			 </div>
			 <div class="col-md-6">
			   <div class="form-group pass-grp">
				<!---<input type="password" class="form-control inputbg input-lock" placeholder="Enter Password" id="pwd">
         <span class="reg_ico2"><i @click="showPass" aria-hidden="true" :class="eye"></i></span>-->
          <input ref="password" id="password" type="Password" data-toggle="password" class="form-control inputbg input-lock" placeholder="Enter Password" maxlength="30" name="password" v-model="register.password" v-validate="{required:true,min:8,max:30,regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/}" data-vv-as="password" />
            <div class="tooltip2" v-show="errors.has('registerform.password')">
                      <div class="tooltip-inner">
                      <span v-show="errors.has('registerform.password')">{{ errors.first('registerform.password') }}</span>
                      </div>
            </div>
			   </div>
			 </div>
       <div class="col-md-6">
			   <div class="form-group pass-grp">
				<!--<input type="password" class="form-control inputbg input-position" placeholder="7493566" id="pwd">-->
          <input type="password" id="confirm_password" class="form-control inputbg input-lock" placeholder="Confirm Password" name="confirm_password" maxlength="30" v-model="register.confirm_password" data-vv-validate-on="blur" v-validate="'required|confirmed:password'" data-vv-as="confirm password" v-on:keyup="onPasswordClick">
          <div class="tooltip2" v-show="errors.has('registerform.confirm_password')">
                    <div class="tooltip-inner">
                    <span v-show="errors.has('registerform.confirm_password')">{{ errors.first('registerform.confirm_password') }}</span>
                    </div>
            </div>
        
			   </div>
			 </div>
		   </div>
		   <div class="row">		  
			 <div class="col-md-6">
			   <div class="form-group pass-grp">
				<!--<input type="password"  placeholder="Confirm Password" class="form-control inputbg input-position"  id="cpwd">-->
			   <select id="s_id" v-model="register.position" class="form-control inputbg input-position">
                                        <option value="">Select Position</option>
                                        <option value="1">Left</option>
                                        <option value="2">Right</option>
                                      </select>
         
         </div>
			 </div>
		   </div>
		   <div class="row btn-wraper">
		     <div class="col-md-12 text-center">
			   <div class="form-group pass-grp">
                      <button type="submit" :disabled=" !isCompleteRegister || isActiveBtn==false" value="Register" class="btn btn-regsiter">REGISTER</button>

				<!-- <button type="button" class="btn btn-regsiter">REGISTER</button>-->
			   </div>
			 </div>
		   </div>
		   </form>
		 </div>
	 </div>
  </div>
</template>
<script>
   import "vue-tel-input/dist/vue-tel-input.css";
   import VueTelInput from "vue-tel-input";
   import { domain } from "./../../user-config/config";
   export default {
     components: {
       VueTelInput,
     },
     data() {
       return {
         password_validation_msg: true,
         usermsg: "",
         weburl: "",
         useractive: true,
         useractive1: false,
         otpSent: false,
         otp: "",
         otpVerified: false,
         isVerifyOtp: "",
         whatsapp_no: "",
         register: {
           user_id: "",
           fullname: "",
           email: "",
           referral_id: "",
           mobile: "",
           //btc_address: "",
           password: "",
           confirm_password: "",
           position: "",
           country: "",
   
           //secret_question:'',
           // secret_ans:'',
         },
         countries: {
           iso_code: "",
           country: "",
         },
         flag_for_hide_validation_messege: "",
         icon: "../public/user_files/assets/img/icon-mlm.png",
         logo: "../public/user_files/assets/img/logo.png",
         hostName: window.location.origin,
         checkMobileValid: true,
         getcountry: "",
         getMobile: "",
         temp: "",
         selected: true,
         isActiveBtn: true,
         queArr: "",
         terms: false,
         agree: "",
         rand_no: "",
         captcha: "",
         captchamatch: false,
         captchamatcherror: "",
         btc_error: "",
         typingTimer: "",
         doneTypingInterval: 500,
         showpassword: 0,
         showpassword2: 0,
         alreadyref: 0,
         is_referral: "",
         eye: "fa fa-eye-slash",
         eye2: "fa fa-eye-slash",
         password:'',
       };
     },
     computed: {
       isCompleteRegister() {
         return (
           this.register.user_id &&
           // && !this.btc_error
           this.register.email &&
           this.register.referral_id &&
        //   this.terms &&
         //  this.agree &&
           this.register.position &&
           this.register.fullname &&
           this.register.mobile &&
           // this.selected &&
           this.register.country &&
           this.register.password &&
           this.register.confirm_password //&&
           //this.register.btc_address &&
           // this.checkMobileValid&&
           // this.register.mobile
           // this.register.eth_address
         );
       },
     },
     mounted() {
      document.onreadystatechange = () => {
        if (document.readyState == "complete") {
            $('#email').val('');
            $('#password').val('');
        }
      }
      setTimeout(function(){$('#email').val('');},2000)
      setTimeout(function(){$('#email').val('');},2000)
      setTimeout(function(){$('#password').val('');},2000)
      setTimeout(function(){$('#password').val('');},2000)
            
       this.weburl = domain;
       // alert(this.weburl);
      this.register.user_id =
      "CQC" + parseInt(Math.floor(Math.random() * 90000) + 10000);
       this.getCountry();
       /*this.getQuestions();*/
       /*this.getRandomNo();*/
       (this.one_letter = "invalid"),
         (this.greater_than_6 = "invalid"),
         (this.one_capital_letter = "invalid"),
         (this.special_char = "invalid"),
         (this.one_number = "invalid"),
         (this.starting_with_letter = "invalid"),
         (this.flag_for_hide_validation_messege = false);
       if (
         this.$route.query.ref_id != undefined &&
         this.$route.query.ref_id != ""
       ) {
         // this.register.referral_id  = this.$route.query.ref_id;
         var uniqueid = this.$route.query.ref_id;
         this.register.position = this.$route.query.position;
         this.register.referral_id = this.$route.query.ref_id;
        this.getUserId(uniqueid);
         //this.checkuserexist();
         this.alreadyref = 1;
       }
     },
     methods: {
        isLetter(e) {
     let char = String.fromCharCode(e.keyCode); // Get the character
     if(/^[A-Za-z ]+$/.test(char)) return true; // Match with regex 
     else e.preventDefault(); // If not match, don't add to input text
      },
       step1Fun(){
       this.$validator.validateAll('registerform').then((result) => {
        if (result) {
       let terms = $("input[name='terms']:checked").val();
       let agree = $("input[name='agree']:checked").val();


       /*if(agree!=undefined && terms=='on'){

              this.step2Fun();
            }else{*/

               this.$toaster.error(" Please Fill all fields ");
           /* }*/

               //$("#resend_otp").hide();
           }
       });
              
    },
       onInput({ number, isValid, country }) {
         if (number) this.checkMobileValid = isValid;
         this.getcountry = country;
         this.temp = number.split(" ");
         this.temp.shift();
         this.getMobile = this.temp.join("");
        
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
           this.register.password.substring(0, 1) ==
           this.register.password.match(/[A-z]/)
         ) {
           this.starting_with_letter = "valid";
         }
   
         if (
           this.register.password.length >= 8 &&
           this.register.password.length <= 22
         ) {
           this.greater_than_8 = "valid";
         }
         if (this.register.password.match(/[a-z]/)) {
           this.one_letter = "valid";
         }
   
         if (this.register.password.match(/[A-Z]/)) {
           this.one_capital_letter = "valid";
         }
         if (this.register.password.match(/[0-9]/)) {
           this.one_number = "valid";
         }
   
         if (this.register.password.match(/[^a-zA-Z0-9\-\/]/)) {
           this.special_char = "valid";
         }
         if (this.register.password.match(/\s/g)) {
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
             field: "password",
             msg: "password not valid",
           });
           this.password_validation_msg = true;
         }
         if (this.register.password != this.register.confirm_password) {
           /*this.errors.add('this.password_confirmation', 'not match')*/
           this.errors.add({
             field: "confirm_password",
             msg: "password does not match",
           });
         }
       },
       getCountry() {
         axios
           .get("country", {})
           .then((response) => {
             this.countries = response.data.data;
            console.log(response.data.data);
           })
           .catch((error) => {});
       },
       getQuestions() {
         axios
           .get("get-questions", {})
           .then((response) => {
             this.queArr = response.data.data;
           })
           .catch((error) => {});
       },
       sendOtp() {
         if (this.register.position == "") {
           this.$toaster.error("Please Select Position");
           this.disablebtn = 0;
           /*$('#submit').prop('disabled', false);*/
           return false;
         }
         axios
           .post("send-registration-otp", {
             /*  alert(whatsapp_no);*/
             /*mobile_number: this.register.mobile,*/
             /* alert(whatsapp_no);*/
             email: this.register.email,
             user_id: this.register.user_id,
           })
           .then((response) => {
             if (response.data.code == 200) {
               this.otpVerified = false;
               this.$toaster.success(response.data.message);
               this.otpSent = true;
             } else {
               this.$toaster.error(response.data.message);
             }
           })
           .catch((error) => {
             this.message = "";
           });
       },
       verifyOtp() {
         axios
           .post("verify-registration-otp", {
             mobile: this.register.mobile,
             user_id: this.register.user_id,
             otp: this.otp,
           })
           .then((response) => {
             if (response.data.code == 200) {
               this.otpVerified = true;
               this.$toaster.success(response.data.message);
               this.otpSent = true;
               this.optVerified = true;
               this.registerUser();
               //  this.mobileNotEditable = true;
               //  $("#whatsapp_no").prop("readonly",true);
             } else {
               this.$toaster.error(response.data.message);
             }
           })
           .catch((error) => {
             this.message = "";
           });
       },
       getRandomNo() {
         axios
           .get("generate-random-no", {})
           .then((response) => {
             this.rand_no = response.data.data;
           })
           .catch((error) => {});
       },
   
       check($event) {
         if ($("#agree").prop("checked") == true) {
           this.agree = 1;
         } else {
           this.agree = 0;
         }
       },
   
       checkuserexist(para) {
         // alert(para);
         if (para == 1) {
           var user = this.register.user_id;
         } else {
           var user = this.register.referral_id;
           // if(this.register.referral_id == 'Admin' || this.register.referral_id == 'admin'){
           //   this.useractive = false;
           //   this.isActiveBtn = false;
           //   this.usermsg = "Invalid User";
           //   exit;
           // }
         }
         axios
           .post("checkuserexist", {
             user_id: user,
           })
           .then((response) => {
             if (response.data.code == 200) {
               if (para == 1) {
                 this.useractive1 = true;
                 this.usermsg1 = "user Already exist with this id";
                 this.isActiveBtn = false;
               } else {
                 this.useractive = true;
                 if (this.useractive1 == false) {
                   this.isActiveBtn = true;
                 }
               }
             } else {
               if (para == 1) {
                 this.useractive1 = false;
                 if (this.useractive == true) {
                   this.isActiveBtn = true;  
                 }
                 //this.isActiveBtn = true;
                 this.usermsg1 = response.data.message;
               } else {
                 this.useractive = false;
                 this.isActiveBtn = false;
                 this.usermsg = response.data.message;
               }
             }
           })
           .catch((error) => {});
       },
   
       getUserId() {
         axios
           .post("get-user-id", {
             uid: this.$route.query.ref_id,
           })
           .then((response) => {
             if (response.data.code == 200) {
               this.register.referral_id = response.data.data;
               $("#referral_id").prop("readonly", true);
               $("#s_id").attr("disabled", "disabled");
               this.register.email='';
               this.useractive = true;
             } else {
               this.useractive = false;
               this.usermsg = response.data.message;
             }
           })
           .catch((error) => {});
       },
       matchCaptcha() {
         if (parseInt(this.captcha) != parseInt(this.rand_no)) {
           /*this.errors.add({
                           field: 'captcha',
                           msg: 'Captcha not match'
                           });*/
           // alert();
           this.captchamatch = false;
           this.captchamatcherror = "captcha not match";
           // return false;
         } else {
           // alert();
           this.captchamatcherror = "";
           this.captchamatch = true;
           /*this.errors.remove({
                           field: 'captcha',
                           
                           });*/
           // return true;
         }
       },
       registerUser() {
         this.isActiveBtn = false;
         // var password = this.register.password;
         // var confirm_password = this.register.confirm_password;
         // if (password == confirm_password) {
         this.$validator.validateAll('registerform').then((result) => {
        if (result) {
            axios.post("register", {             
            user_id: this.register.user_id,
             email: this.register.email,
             mobile: this.register.mobile,
             fullname: this.register.fullname,
             country: this.register.country,
             ref_user_id: this.register.referral_id,
             password: this.register.password,
             password_confirmation: this.register.confirm_password,
             position: this.register.position,
             address: "",
             //btc_address: this.register.btc_address,
             //secret_question: this.register.secret_question,
             // secret_ans: this.register.secret_ans,
           })
           .then((resp) => {
             if (resp.data.code == 200) { 
               $("#registerForm").trigger("reset");
               this.$toaster.success(resp.data.message);
               this.disablebtn = false;
               this.$router.push({
                 name: "thankyou",
                 params: {
                   user_id: resp.data.data.userid,
                   password: resp.data.data.password,
                 },
               });
             } else {
               this.$toaster.error(resp.data.message);
             }
             this.isActiveBtn = true;
           }).catch((err) => {});
        }});

       },
       getPackages() {
         axios
           .get("get-packages", {})
           .then((response) => {
             var INR = response.data.data[0]["convert"];
             var type = response.data.data[0]["type"];
             localStorage.setItem("INR", INR);
             localStorage.setItem("p_type", type);
             return true;
           })
           .catch((error) => {});
       },
       reset() {
         this.user.user_id = "";
         this.user.password = "";
       },
       getReferralId() {
         $("#referral_id").val("Williamson");
       },
       matchpassword() {
         if (this.register.password != this.register.confirm_password) {
           /*this.errors.add('this.password_confirmation', 'not match')*/
           this.errors.add({
             field: "confirm_password",
             msg: "password does not match",
           });
           // this.password_validation_msg = true;
         } else {
           // this.password_validation_msg = false;
         }
       },
       /* check($event){
         if($("#agree").prop('checked') == true){
           this.terms = 1;
         }else{
           this.terms = 0;
         } 
       },*/
       showPass() {
         if (this.showpassword == 0) {
           document.getElementById("password").type = "text";
           this.eye = "fa fa-eye";
           this.showpassword = 1;
         } else if (this.showpassword == 1) {
           document.getElementById("password").type = "password";
           this.showpassword = 0;
           this.eye = "fa fa-eye-slash";
         }
       },
       showPass2() {
         if (this.showpassword2 == 0) {
           document.getElementById("confirm_password").type = "text";
           this.eye2 = "fa fa-eye";
           this.showpassword2 = 1;
         } else if (this.showpassword2 == 1) {
           document.getElementById("confirm_password").type = "password";
           this.showpassword2 = 0;
           this.eye2 = "fa fa-eye-slash";
         }
       },
   
       checkValidBTCAddr() {
         let that = this;
         that.isValidBTCAddress = false;
         that.btc_error = false;
         $(".loaderD").html(
           'Checking BTC Address..<i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size:16px"></i>'
         );
         clearTimeout(this.typingTimer);
   
         if (/\s/.test(that.register.btc_address)) {
           that.errors.remove("btc_address");
           that.errors.add({
             field: "btc_address",
             msg: "Spaces not allowed in address",
           });
           $(".loaderD").html("");
           return false;
         } else {
           that.errors.remove("btc_address");
         }
         /*that.errors.remove('btc_address'); 
            that.errors.add({field: 'btc_address', msg: 'Enter valid BTC address.'});*/
   
         that.typingTimer = setTimeout(function () {
           if (that.register.btc_address == "") {
             $(".loaderD").html("");
             that.isValidBTCAddress = true;
             that.btc_error = false;
             that.errors.remove("btc_address");
           } else {
             that.errors.add({
               field: "btc_address",
               msg: "checking for valid btc address",
             });
             that.isValidBTCAddress = false;
             axios
               .post("check_address1", {
                 address: that.register.btc_address,
                 network_type: "BTC",
               })
               .then((response) => {
                 if (response.data.code === 200) {
                   $(".loaderD").html("");
                   that.isValidBTCAddress = true;
                   that.btc_error = false;
                   that.errors.remove("btc_address");
                 } else {
                   $(".loaderD").html("");
                   that.btc_error = true;
                   that.isValidBTCAddress = false;
                   that.errors.remove("btc_address");
                   that.errors.add({
                     field: "btc_address",
                     msg: "Enter valid BTC address.",
                   });
                 }
               })
               .catch((error) => {});
           }
         }, this.doneTypingInterval);
       },
       checkAddress() {
         $(".loaderD").html(
           'Checking BTC Address..<i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size:16px"></i>'
         );
         clearTimeout(this.typingTimer);
         let that = this;
         that.typingTimer = setTimeout(function () {
           that.btc_error = false;
           if (that.register.btc_address == "") {
             that.btc_error = false;
             $(".loaderD").html("");
           } else {
             axios
               .post("check_address1", {
                 address: that.register.btc_address,
                 network_type: "BTC",
               })
               .then((response) => {
                 if (response.data.code == 200) {
                   $(".loaderD").html("");
                   that.btc_error = false;
                 } else {
                   that.btc_error = true;
                   $(".loaderD").html("");
                 }
               })
               .catch((error) => {});
           }
         }, this.doneTypingInterval);
       },
       check1() {
         if (this.is_referral == true) {
           this.register.referral_id = "Williamson";
           this.checkuserexist();
         } else {
           this.register.referral_id = "";
           this.sponsor_name = "";
         }
       },
     },
   };
</script>