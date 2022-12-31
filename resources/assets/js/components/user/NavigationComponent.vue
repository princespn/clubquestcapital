<template>
  <nav class="navbar navbar-expand-lg navbar-light nav-header">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <!--<span>Toggle Sidebar</span>-->
                    </button>
                    <!--<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>-->

                    <div class="" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            
                            <li class="nav-item dropdown ellipse-li">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
								<div class="dropdown-menu">
								
                <router-link to="/my-profile" class="dropdown-item">My Profile</router-link>
								<router-link to="/my-profile" class="dropdown-item">Edit Profile</router-link>
								 <span  class="dropdown-item" @click="logout">Logout</span>
               <!--<router-link @click="logout" class="dropdown-item">Logout</router-link>-->
									
								</div>
                  </li>
                    <li class="nav-item">
                    <router-link to="/my-profile" class="nav-link">
								   <div class="profile-wraper d-flex">
								     <div class="profile-image">
									   <img src="public/user_files/assets/images/profile-img.jpg">
									 </div>
									 <div class="name-wraper"><span class="user-name">{{userdata.fullname}}</span><br><span class="user-cart">{{userdata.current_time}}</span></div>
								   </div>
                    </router-link>
                    </li>
                        </ul>
                    </div>
                </div>
            </nav>
</template>
<script>
   import moment from "moment";
   import { apiUserHost } from "../../user-config/config";
   export default {
     data() {
       return {
         rankdata:"",
         userdata: {
           fullname: "",
           current_time: "",
           is_franchise: "0"
         },
         is_franchise: "0",
         photo:'',
         usddata:'',
         referrallink: "",
       };
     },
     mounted() {
       this.getUserDetails();
       $(function(){
               $("#upload_link").on('click', function(e){
                   e.preventDefault();
                   $("#photo:hidden").trigger('click');
               });
           });
       
      // this.getUserProfile();
       //this.getProfileImg();
       /*this.getusddata();*/
      /* this.getrankdata();*/
     },
     methods: {
      moveTop(){
           document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;

        },
       clickSubMenu(){
     // alert('hieq2234ii');
   
       },
       hideNav(){
   
             var windowWidth = window.screen.width;      
             // alert(windowWidth);           
             if (windowWidth< 768) {
                // alert('hi');
   
                 // $('.pace-done').removeClass('nav-toggle');
                 $('#go').trigger('click');
                   // alert('hi');
   
             }
              
         },
       getusddata(){
         axios
           .get("getusddata", {})
           .then(response => {
             this.usddata = response.data.data.usddata;
             /*console.log(this.usddata);*/
             
           })
           .catch(error => {});
       },
       // hideNav() {
       //    alert('hiii');
        
       // },
   
     /*  getUserProfile() {
         axios
           .get("get-profile-info", {})
           .then(response => {
             this.userdata = response.data.data;
             this.is_franchise = response.data.data.is_franchise;
           })
           .catch(error => {});
       },*/
    
        getProfileImg(){ 
           axios.get('get-profile-img', {
           })
           .then(response => {
                 if (response.data.code == 200) {
   
                     this.photo = response.data.data.attachment;
                  }else{
                     this.photo = 'public/user_files/images/face7.jpg';
                  }
               
               
               
           })
           .catch(error => {
           }); 
       },
    getUserDetails() {
       axios
         .get("get-user-navigation", {})
         .then(response => {
           this.userdata = response.data.data;
           this.referrallink = response.data.data;
            if(this.userdata.is_franchise==1){
                $("#is_franchise").html(this.userdata.user_id + '( franchise )');
              }else{
                $("#is_franchise").html(this.userdata.user_id);
              }
   
         })
         .catch(error => {});
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
                   if(upload_type == 'pan'){
                       if(this.$refs.pan.files[0] != ''){
                           formData.append('photo', this.$refs.pan.files[0]);
                       }             
                   }
                   if(upload_type == 'address'){
                       if(this.$refs.address.files[0] != ''){
                           formData.append('photo', this.$refs.address.files[0]);
                       }
                   }
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
                       if (response.data.code == 200) {
                         this.$toaster.success(response.data.message);
                         $('#update-user-documents').trigger("reset");
                         location.reload();
                         this.readUserProfile();
                         this.readUserDocuments();
                         location.reload();
                       }else{
                         this.$toaster.error(response.data.message);
                       }
                   })
               },
   
       logout() {
         localStorage.removeItem("user-token");
         //localStorage.removeItem('INR');
         // localStorage.removeItem('p_type');
         localStorage.removeItem("type");
         // if the request fails, remove any
         location.reload();
         this.$router.push("/login");
         location.reload();
       }
     }
   };
</script>