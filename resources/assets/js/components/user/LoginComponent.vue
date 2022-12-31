<template>
  <div class="account-wraper d-flex">
     <div class="cols-section left-container d-flex align-items-center">
	    <div class="login-wraper">
		  <form action="" @submit.prevent="login">
		  <h2 class="md-heading text-center">Login</h2>
		  <p class="text-sm text-center">Please Login to continue</p>
		  <div class="form-group">
			<!-- <input type="email" class="form-control inputbg input-lock" placeholder="Mail" id="email"> -->
            <input type="text" class="form-control inputbg input-lock" placeholder="Enter User ID" name="user_id" id="user_id" required="" v-model="user.user_id" autofocus="">
		  </div>
		  <div class="form-group pass-grp">
			<!-- <input type="password" class="form-control inputbg input-lock" placeholder="password" id="pwd"> -->
             <input type="password" class="form-control inputbg input-lock"  placeholder="Enter password" name="password" id="password" v-model="user.password">
		  </div>
		  <p class="text-right forgot-text">
            <!-- <a href="reset.php">Forgot Password</a> -->
              <router-link to="/forgot-password" class=""> Forgot password?</router-link>
            </p>
		  <div class="form-group text-center">
		    <!-- <button type="button" class="btn btn-login">Login</button> -->
             <button :disabled="!loginComplete" class="btn btn-login" type="submit">Login</button>
		  </div>
		  <!--<p class="text-sm text-center loginwith-text">Login with</p>
		  <div class="social-wraper d-flex justify-content-center">
		    <a href="#"><img src="public/user_files/assets/images/facebook.png"></a>
			<a href="#"><img src="public/user_files/assets/images/google.png"></a>
		  </div>-->
		  <p class="text-sm text-center option-text mb-0">Don't have an account 
            <!-- <a href="register.php"><strong>Signup</strong></a> -->
            <router-link to="/register" class="text-primary"> Signup Now </router-link>
            </p>
		  </form>
		</div>
	 </div>
	 <div class="cols-section right-container">
	     <div class="logo-image"><img src="public/user_files/assets/images/background-logo.png"></div>
	     <div class="logo-text"><img src="public/user_files/assets/images/logo-text.png" class="img-fluid"></div>
	     <!--<div class="btn-wraper">
		   <button class="btn btn-signin">Signup</button>
		 </div>-->
	 </div>
  </div>
</template>
<script>
    import { domain } from'./../../user-config/config';
            export default {
            data() {
                return {
                     weburl:'',
                    user: {
                        user_id: '',
                        password: ''
                    },
                   // icon: '../public/user_files/assets/img/icon-mlm.png',
                  ///  logo: '../public/user_files/assets/img/logo.png',
                    hostName: window.location.origin,
                    verify2fa:'',
                    googleotp : null,
                    token : null,
                    verifymailotp : null,
                    otp : null,
                    rand_no:'',
                    captcha:'',
                    captchamatch:false,
                    terms:false,
                    captchamatcherror:'',
                    /*lockout: true*/
                }
            },
            computed:{
               loginComplete(){
                  return this.user.user_id && this.user.password;
               }
            },
            mounted() {
                    this.weburl = domain;
                    var user_id = this.$route.query.user_id;
                    var password = this.$route.query.password;
                    if (user_id!==undefined && password!==undefined && user_id!=='' && password!=='') {
                        this.user.user_id = user_id;
                        this.user.password = password;
                        this.login();
                    }
                    this.getRandomNo();
            },
            methods: {
                login() {
                    axios.post('login', {
                        user_id: this.user.user_id,
                        password: this.user.password,
                    }).then(resp => {
                         let userinfo = resp.data.data; 
                        if(resp.data.code === 200){
                            const token = resp.data.data.access_token;
                            //this.$toaster.success(resp.data.message) 
                             if(userinfo.google2faauth == "TRUE"){
                                //this.verify2Fa();
                                this.token = token;
                                this.verify2fa = true;
                            }else{
                            localStorage.setItem('user-token', token); // store the token in localstorage
                            localStorage.setItem('type', "user"); // store the token in localstorage
                           // this.getPackages();
                                 this.$toaster.success(resp.data.message) 
                                this.$router.push({name: 'dashboard'});
                                location.reload();
                            }
                            
                        }/*else if (resp.data.code === 400) {
                          this.wrong_message = resp.data.message;
                          console.log(resp.data.data.time); 
                          let $time=resp.data.data.time;
                          this.lockout = false;
                          setTimeout(()=>{
                          this.lockout = true;
                          console.log('Button Activated')}, $time)  
                        }*/ else {
                            this.$toaster.error(resp.data.message)
                        }
                    }).catch(err => {
                        //localStorage.removeItem('user-token'); // if the request fails, remove any 
                       // location.reload();
                        this.$router.push({ name: 'login' });
                    })
                },
                   getPackages(){
                    axios.get('get-packages', {
                    })
                    .then(response => {
                        var INR = response.data.data[0]['convert'];
                        var type = response.data.data[0]['type'];
                        localStorage.setItem('INR', INR); 
                        localStorage.setItem('p_type', type); 
                        return true;
                    })
                    .catch(error => {
                    });        
                 },
                reset() {
                    this.user.user_id = '';
                    this.user.password = '';
                },
               matchCaptcha(){
                   if(parseInt(this.captcha) != parseInt(this.rand_no)){
                    /*this.errors.add({
                                    field: 'captcha',
                                    msg: 'Captcha not match'
                                    });*/
                   // alert();                
                    this.captchamatch  = false;
                    this.captchamatcherror="captcha not match";               
                   // return false;
                  }else{
                    // alert();
                    this.captchamatcherror="";  
                    this.captchamatch  = true;  
                     /*this.errors.remove({
                                    field: 'captcha',
                                    
                                    });*/
                   // return true;
                  }
                },
                getRandomNo() {
                  axios
                    .get("generate-random-no", {})
                    .then(response => {
                      this.rand_no = response.data.data;
                    })
                    .catch(error => {});
                },
                 verify2Fa(){
                        axios.post('2fa/validatelogintoken',
                        {
                            googleotp:this.googleotp
                        },
                        {
                            headers: { 'Authorization':  "Bearer "+this.token }
                        }).then(resp => {
                            if(resp.data.code == 200) {
                                if(this.token){
                                    this.sendotp = false;
                                    localStorage.setItem('user-token', this.token);
                                    localStorage.setItem('type', 'user'); 
                                    this.$toaster.success(resp.data.message);
                                     this.$router.push({ name:'dashboard'});
                                     location.reload();
                                    //window.location.href = redirect;
        
                                } else {
                                    this.$toaster.success(resp.data.message);
                                    this.$router.push({ name:'dashboard'});
                                     location.reload();
                                }
                            } else {
                                this.$toaster.error(resp.data.message);
                            }
                        }).catch(err => {
                            this.$toastr.error("Something went wrong");
                        })
                    },
        
            }
        }
</script>