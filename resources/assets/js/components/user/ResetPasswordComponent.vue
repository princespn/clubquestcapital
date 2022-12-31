<template>
<div class="account-wraper d-flex reset">
     <div class="cols-section left-container d-flex align-items-center form-seperate">
	    <div class="login-wraper">
		 <form @submit.prevent="resetPassword">
		  <h2 class="md-heading text-left">Reset Password</h2>		 
		  <div class="form-group">
             <label><strong>New Password</strong></label>
             <input type="password" class="form-control inputbg input-lock { error: errors.has('newpassword') }" name="newpassword" id="newpassword" v-model="user.newpassword" v-validate="'required|min:8|max:30'" autofocus="" placeholder="Enter New Password">
              <div class="tooltip1" v-show="errors.has('newpassword')">
              <div class="tooltip1-inner"><span class="text-danger error-msg-size tooltip1-inner" v-show="errors.has('newpassword')">{{ errors.first('newpassword') }}</span></div>
            </div>
		    </div>
             <div class="form-group">
             <label><strong>Confirm Password</strong></label>
              <input type="password" name="confirmpassword" class="form-control inputbg input-lock" id="confirmpassword" required="" v-model="user.confirmpassword" v-validate="'required|min:8|max:30'" placeholder="Enter Confirm Password">
              <div class="tooltip1" v-show="errors.has('confirmpassword')">
               <div class="tooltip1-inner"> <span class="text-danger error-msg-size tooltip1-inner" v-show="errors.has('confirmpassword')">{{ errors.first('confirmpassword') }}</span></div>
		    </div>
            </div>
		 
		  <p class="p-text">Already have an account ? <router-link to="/login" class="text-primary">Login</router-link></p>
		  <div class="form-group text-center">
      <button type="submit" class="btn btn-login reset-btn" :disabled='!isSubmit || errors.any() || !isActiveBtn'>Submit</button>
		  </div>
		  </form>
		</div>
	 </div>
	 <div class="cols-section right-container logo-seperate">
	     <div class="logo-image"><a href="#"><img src="public/user_files/assets/images/background-logo.png"></a></div>
	     <div class="logo-text"><img src="public/user_files/assets/images/logo-text.png" class="img-fluid"></div>
	 </div>
     </div>


</template>
<script>
  export default {
      data() {
          return {
              resettoken:'',
              user: {
                  newpassword: '',
                  confirmpassword:''
              },
              flag_for_hide_validation_messege:'',
              icon: '../public/user_files/assets/img/icon-mlm.png',
              logo: '../public/user_files/assets/img/logo.png',
              hostName: window.location.origin,
              isActiveBtn:true
          }
      },
      computed:{
          isSubmit(){
             return this.user.newpassword && this.user.confirmpassword;
          }
      },
      mounted(){
          this.getResetToken();
          this.one_letter = 'invalid',
          this.greater_than_6 = 'invalid',
          this.one_capital_letter = 'invalid',
          this.special_char = 'invalid',
          this.one_number = 'invalid',
          this.starting_with_letter = 'invalid',
          this.flag_for_hide_validation_messege = false
      },
  
      methods: {
          onPasswordClick() {
  
            this.one_letter = 'invalid';
            this.greater_than_6 = 'invalid';
            this.one_capital_letter = 'invalid';
            this.special_char = 'invalid';
            this.one_number = 'invalid';
            this.starting_with_letter = 'invalid';
            this.flag_for_hide_validation_messege = true;
  
            if (this.user.newpassword.substring(0, 1) == this.user.newpassword.match(/[A-z]/)) {
                          // alert();
                          this.starting_with_letter = 'valid';
                      }
  
                      if ((this.user.newpassword.length >= 6) && (this.user.newpassword.length <= 15)) {
                         this.greater_than_6 = 'valid';
  
                     }
                     if (this.user.newpassword.match(/[a-z]/)) {
                         this.one_letter = 'valid';
                     }
  
                     if (this.user.newpassword.match(/[A-Z]/)) {
                         this.one_capital_letter = 'valid';
                     }
                     if (this.user.newpassword.match(/\d/)) {
                      this.one_number = 'valid';
                  }
  
                  if (this.user.newpassword.match(/[^a-zA-Z0-9\-\/]/)) {
                     this.special_char = 'valid';
                 }
                 if (this.user.newpassword.match(/\s/g)) {
                     this.special_char = 'invalid';
                 }
  
                 if (this.one_letter === 'valid' && this.greater_than_6 === 'valid' && this.one_capital_letter === 'valid' && this.special_char === 'valid' && this.one_number === 'valid' && this.starting_with_letter === 'valid') {
                     this.flag_for_hide_validation_messege = false;
                 }else{
                    this.errors.add({
                        field: 'password',
                        msg: 'password not valid'
                    });
                }
  
          },
  
          getResetToken(){
              var url = window.location.href;
              var hash = url.split('=');
              if (hash.length == 1) {
                  this.$toaster.error('Something Went Wrong...')
              } else {
                  this.resettoken = hash[1];
              }
          },
  
          resetPassword() {
              if(this.user.newpassword !=this.user.confirmpassword){
                  this.$toaster.error('Password not matched')
              }else{
                  this.isActiveBtn = false;
                  axios.post('reset-password', {
                      resettoken: this.resettoken,
                      password: this.user.newpassword,
                      confirm_password: this.user.confirmpassword,
                  }).then(resp => {
                      if(resp.data.code==200){
                         this.$toaster.success(resp.data.message)
                         this.$router.push({ name: 'login' });
  
                      }else{
                        this.$toaster.error(resp.data.message)
                      }
                      this.isActiveBtn = true;
                  }).catch(err => {
  
                  })
              }
          },
      }
  }
</script>