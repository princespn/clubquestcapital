<template>
   <div class="main-content">
   <UserDetails></UserDetails>
     <div class="row common-rows">
       <div class="col-12 col-sm-12 col-md-12 col-lg-12 right-cols common-cols">
         <div class="card">
           <div class="card-body">
             <div class="row search-filter">
               <div class="col-md-4 date-range">
                 <div class="input-group mb-3 double-group">
                   <!-- <input type="text" class="form-control" placeholder="Search user Id"> -->
                   <input
                     type="text"
                     class="form-control"
                     v-model="searchText"
                     v-on:keyup="checkUserExisted"
                     name="search"
                     placeholder="Search..."/>
 
                   <div class="input-group-append">
                     <button
                       class="btn btn-search"
                       @click="onSearchClick"
                       type="button">
                       <i class="fa fa-search" aria-hidden="true"></i>
                     </button>
                   <button class="btn btn-search" @click="onBackClick" >
                         <i class="fa fa-arrow-left"></i>
                 </button>
                 <button class="btn btn-search" @click="onForwardClick">
                           <i class="fa fa-arrow-right"></i>
                 </button>
                   </div>
                   
                 </div>
                 <span :class="{'text-success': isAvialable == 'Available','text-danger': isAvialable == 'Absent'}"  v-if="isAvialable!=''">{{fullname}}</span>
                   
                 <!--<span :class="{'text-success': isAvialable == 'Available', 'text-danger': isAvialable == 'Not Available',}"
                     v-if="isAvialable != ''">{{ isAvialable }}</span>-->
               </div>
             </div>
             <div class="row treeview-section">
               <div class="col-md-12">
                 <div class="tree-struct">
                   <div class="row tree-level-1 midline row-1">
                     <div class="col-12 col-md-12">
                       <a class="mytooltip">
                         <div class="img-box">
                           <img  :src="imgURL + '/assets/images/tree-view/' +userdata.image"  class="user-icons"/><br />
                           <span>{{ userdata.user_id }}</span>
                         </div>
                         <div class="tooltiptext">
                           <div class="tooltip-body d-flex align-items-center">
                             <div
                               class="
                                 contentID-wraper
                                 d-flex
                                 align-items-center
                                 justify-content-center
                               "
                             >
                               <div class="wraper-box">
                                 <div class="img-wraper">
                                   <img
                                     :src="
                                       imgURL +
                                       '/assets/images/tree-view/' +
                                       userdata.image
                                     "
                                   />
                                 </div>
                                 <br /><span class="userID-text">{{ userdata.user_id }}</span>
                               </div>
                             </div>
                             <div class="content-wraper d-flex">
                               <div class="left-cols">
                                 <p class="username text-p">
                                   <span class="title-span">Username:</span>
                                   <span v-if="userdata.user_id=='Absent'">-</span>
                                   <span v-if="userdata.user_id!='Absent'">{{userdata.fullname}}</span>
                                               
                                   <!--<span> {{ userdata.fullname }}</span>-->
                                 </p>
                                 <p class="username text-p">
                                   <span class="title-span">UserID:</span>
                                   <span>{{ userdata.user_id }}</span>
                                 </p>
                                 <p class="username text-p"  v-if="userdata.selftopup > 0">
                                   <span class="title-span">Status:</span
                                   ><span>Active</span>
                                 </p>
                                 <p class="username text-p" v-else>
                                   <span class="title-span">Status:</span
                                   ><span>Inactive</span>
                                 </p>
                                 <div class="more-detail">
                                   <p class="username text-p">
                                     <span class="title-span">Sponsor Id:</span
                                     ><span>{{ userdata.sponsor_id }}</span>
                                   </p>
                                   <p class="username text-p">
                                     <span class="title-span">Placement Id:</span
                                     ><span>{{
                                       userdata.virtual_parent_id
                                     }}</span>
                                   </p>
                                   <p class="username text-p">
                                     <span class="title-span">Package:</span
                                     ><span>{{ userdata.product_name }}</span>
                                   </p>
                                 </div>
                               </div>
                               <div class="right-cols">
                                 <div class="right-wraper">
                                   <div class="table-detals">
                                     <div class="tabs-head d-flex">
                                       <div class="box-head"></div>
                                       <div class="box-head">Left</div>
                                       <div class="box-head">Right</div>
                                     </div>
                                     <div class="tabs-body d-flex">
                                       <div class="box-head">Team</div>
                                       <div class="box-head nums">
                                         {{ userdata.l_c_count }}
                                       </div>
                                       <div class="box-head nums">
                                         {{ userdata.r_c_count }}
                                       </div>
                                     </div>
                                     <div class="tabs-body d-flex">
                                       <div class="box-head">Business</div>
                                       <div class="box-head nums">
                                         {{ userdata.l_bv }}
                                       </div>
                                       <div class="box-head nums">
                                         {{ userdata.r_bv }}
                                       </div>
                                     </div>
                                     <div class="tabs-body d-flex">
                                       <div class="box-head">Carry Forward</div>
                                       <div class="box-head nums">
                                         {{ userdata.left_bv }}
                                       </div>
                                       <div class="box-head nums">
                                         {{ userdata.right_bv }}
                                       </div>
                                     </div>
                                   </div>
                                 </div>
                               </div>
                             </div>
                           </div>
                         </div>
                       </a>
                       <!--<p class="p-title"><span>QU92101415</span></p>-->
                     </div>
                   </div>
                   <div class="row tree-level-2 midline VHline row-2">
                     <div class="col-md-12 tree-line">
                       <img
                         src="public/user_files/assets/images/tree-line.png"
                       />
                     </div>
                     
                     <div  v-for="(levelData, j) in usertreeview[0].level"  :class="getClassName(j)">
                       <a class="mytooltip">
                         <div class="img-box">
                           <img
                             @click="getMatrixTreeData(levelData.user_id)"
                             :src="
                               imgURL +
                               '/assets/images/tree-view/' +
                               levelData.image
                             "
                             class="user-icons"
                           /><br />
                           <span>{{ levelData.user_id }}</span>
                         </div>
                         <div class="tooltiptext import">
                           <div class="tooltip-body d-flex align-items-center">
                             <div
                               class="
                                 contentID-wraper
                                 d-flex
                                 align-items-center
                                 justify-content-center
                               "
                             >
                               <div class="wraper-box">
                                 <div class="img-wraper">
                                   
                                 </div>
                                 <br /><span class="userID-text">{{ levelData.user_id }}</span>
                               </div>
                             </div>
                             <div class="content-wraper d-flex">
                               <div class="left-cols">
                                 <p class="username text-p">
                                   <span class="title-span">Username:</span>
                                   <!--<span>{{ levelData.fullname }}</span>-->
                                   <span v-if="levelData.user_id =='Absent'">-</span>
                                   <span v-if="levelData.user_id!='Absent'">{{levelData.fullname }}</span>
                                                
                                 </p>
                                 <p class="username text-p">
                                   <span class="title-span">UserID:</span
                                   ><span>{{ levelData.user_id }}</span>
                                 </p>
                                 <p
                                   class="username text-p"
                                   v-if="levelData.selftopup > 0">
                                   <span class="title-span">Status:</span
                                   ><span>Active</span>
                                 </p>
                                 <p class="username text-p" v-else>
                                   <span class="title-span">Status:</span
                                   ><span>Inactive</span>
                                 </p>
                                 <div class="more-detail">
                                   <p class="username text-p">
                                     <span class="title-span">Sponsor Id:</span
                                     ><span>{{ levelData.sponser_id }}</span>
                                   </p>
                                   <p class="username text-p">
                                     <span class="title-span">Placement Id:</span
                                     ><span>{{
                                       levelData.virtual_parent_id
                                     }}</span>
                                   </p>
                                   <p class="username text-p">
                                     <span class="title-span">Package:</span
                                     ><span>{{ levelData.product_name }}</span>
                                   </p>
                                 </div>
                               </div>
                               <div class="right-cols">
                                 <div class="right-wraper">
                                   <div class="table-detals">
                                     <div class="tabs-head d-flex">
                                       <div class="box-head"></div>
                                       <div class="box-head">Left</div>
                                       <div class="box-head">Right</div>
                                     </div>
                                     <div class="tabs-body d-flex">
                                       <div class="box-head">Team</div>
                                       <div class="box-head nums">
                                         {{ levelData.l_c_count }}
                                       </div>
                                       <div class="box-head nums">
                                         {{ levelData.r_c_count }}
                                       </div>
                                     </div>
                                     <div class="tabs-body d-flex">
                                       <div class="box-head">Business</div>
                                       <div class="box-head nums">
                                         {{ levelData.l_bv }}
                                       </div>
                                       <div class="box-head nums">
                                         {{ levelData.r_bv }}
                                       </div>
                                     </div>
                                     <div class="tabs-body d-flex">
                                       <div class="box-head">Carry Forward</div>
                                       <div class="box-head nums">
                                         {{ levelData.left_bv }}
                                       </div>
                                       <div class="box-head nums">
                                         {{ levelData.right_bv }}
                                       </div>
                                     </div>
                                   </div>
                                 </div>
                               </div>
                             </div>
                           </div>
                         </div>
                       </a>
                     </div>
                   </div>
                   <div class="row row-3">
                     <div v-for="index in 2"
                       :set="(vcount = index - 1)"
                       :class="getClassName(index - 1)"
                     >
                       <div class="row tree-level-3 midline VHline">
                         <div class="col-md-12 tree-line">
                           <img
                             :src="
                               'public/user_files/assets/images/tree-line' +
                               (index + 1) +
                               '.png'
                             "
                           />
                         </div>
                         <div
                           class="col-6 col-md-6"
                           v-for="(levelData, j) in usertreeview[1].level.slice(
                             vcount * 2,
                             index * 2
                           )"
                         >
                           <a class="mytooltip">
                             <div
                               class="img-box"
                               :class="getClassForbox(vcount * 2 + j)"
                             >
                               <img
                                 @click="getMatrixTreeData(levelData.user_id)"
                                 :src="
                                   imgURL +
                                   '/assets/images/tree-view/' +
                                   levelData.image
                                 "
                                 class="user-icons"
                               /><br />
                               <span>{{ levelData.user_id }}</span>
                             </div>
                             <div class="tooltiptext import">
                               <div
                                 class="tooltip-body d-flex align-items-center"
                               >
                                 <div
                                   class="
                                     contentID-wraper
                                     d-flex
                                     align-items-center
                                     justify-content-center
                                   "
                                 >
                                   <div class="wraper-box">
                                     <div class="img-wraper">
                                       <img
                                         :src="
                                           imgURL +
                                           '/assets/images/tree-view/' +
                                           levelData.image
                                         "
                                       />
                                     </div>
                                     <br /><span class="userID-text"
                                       >{{ levelData.user_id }}</span
                                     >
                                   </div>
                                 </div>
                                 <div class="content-wraper d-flex">
                                   <div class="left-cols">
                                     <p class="username text-p">
                                       <span class="title-span">Username:</span
                                       ><span>{{ levelData.fullname }}</span>
                                     </p>
                                     <p class="username text-p">
                                       <span class="title-span">UserID:</span
                                       ><span>{{ levelData.user_id }}</span>
                                     </p>
                                     <p
                                       class="username text-p"
                                       v-if="levelData.selftopup > 0"
                                     >
                                       <span class="title-span">Status:</span
                                       ><span>Active</span>
                                     </p>
                                     <p class="username text-p" v-else>
                                       <span class="title-span">Status:</span
                                       ><span>Inactive</span>
                                     </p>
                                     <div class="more-detail">
                                       <p class="username text-p">
                                         <span class="title-span"
                                           >Sponsor Id:</span
                                         ><span>{{ levelData.sponsor_id }}</span>
                                       </p>
                                       <p class="username text-p">
                                         <span class="title-span"
                                           >Placement Id:</span
                                         ><span>{{
                                           levelData.virtual_parent_id
                                         }}</span>
                                       </p>
                                       <p class="username text-p">
                                         <span class="title-span">Package:</span
                                         ><span>{{
                                           levelData.product_name
                                         }}</span>
                                       </p>
                                     </div>
                                   </div>
                                   <div class="right-cols">
                                     <div class="right-wraper">
                                       <div class="table-detals">
                                         <div class="tabs-head d-flex">
                                           <div class="box-head"></div>
                                           <div class="box-head">Left</div>
                                           <div class="box-head">Right</div>
                                         </div>
                                         <div class="tabs-body d-flex">
                                           <div class="box-head">Team</div>
                                           <div class="box-head nums">
                                             {{ levelData.l_c_count }}
                                           </div>
                                           <div class="box-head nums">
                                             {{ levelData.r_c_count }}
                                           </div>
                                         </div>
                                         <div class="tabs-body d-flex">
                                           <div class="box-head">Business</div>
                                           <div class="box-head nums">
                                             {{ levelData.l_bv }}
                                           </div>
                                           <div class="box-head nums">
                                             {{ levelData.r_bv }}
                                           </div>
                                         </div>
                                         <div class="tabs-body d-flex">
                                           <div class="box-head">
                                             Carry Forward
                                           </div>
                                           <div class="box-head nums">
                                             {{ levelData.left_bv }}
                                           </div>
                                           <div class="box-head nums">
                                             {{ levelData.right_bv }}
                                           </div>
                                         </div>
                                       </div>
                                     </div>
                                   </div>
                                 </div>
                               </div>
                             </div>
                           </a>
                         </div>
                       </div>
                     </div>
                   </div>
                   <div class="row row-4">
                     <div
                       v-for="index in 4"
                       :set="(vcount = index - 1)"
                       :class="getClassName3(index - 1)"
                     >
                       <div class="row tree-level-4 midline VHline">
                         <div class="col-md-12 tree-line line-four-1">
                           <img :src="getsrc(index - 1)" />
                         </div>
                         <div
                           class="col-6 col-md-6"
                           v-for="(levelData, j) in usertreeview[2].level.slice(
                             vcount * 2,
                             index * 2
                           )"
                           :set="(newC = vcount * 2 + 1)"
                         >
                           <a class="mytooltip">
                             <div
                               :class="
                                 'img-box img-level-' + (vcount * 2 + j + 1) + ''
                               "
                             >
                               <img
                                 @click="getMatrixTreeData(levelData.user_id)"
                                 :src="
                                   imgURL +
                                   '/assets/images/tree-view/' +
                                   levelData.image
                                 "
                                 class="user-icons"
                               /><br />
                               <span>{{ levelData.user_id }}</span>
                             </div>
                             <div class="tooltiptext import">
                               <div
                                 class="tooltip-body d-flex align-items-center"
                               >
                                 <div
                                   class="
                                     contentID-wraper
                                     d-flex
                                     align-items-center
                                     justify-content-center
                                   "
                                 >
                                   <div class="wraper-box">
                                     <div class="img-wraper">
                                       <img
                                         :src="
                                           imgURL +
                                           '/assets/images/tree-view/' +
                                           levelData.image
                                         "
                                       />
                                     </div>
                                     <br /><span class="userID-text"
                                       >{{ levelData.user_id }}</span
                                     >
                                   </div>
                                 </div>
                                 <div class="content-wraper d-flex">
                                   <div class="left-cols">
                                     <p class="username text-p">
                                       <span class="title-span">Username:</span
                                       ><span>{{ levelData.fullname }}</span>
                                     </p>
                                     <p class="username text-p">
                                       <span class="title-span">UserID:</span
                                       ><span>{{ levelData.user_id }}</span>
                                     </p>
                                     <p
                                       class="username text-p"
                                       v-if="levelData.selftopup > 0"
                                     >
                                       <span class="title-span">Status:</span
                                       ><span>Active</span>
                                     </p>
                                     <p class="username text-p" v-else>
                                       <span class="title-span">Status:</span
                                       ><span>Inactive</span>
                                     </p>
                                     <div class="more-detail">
                                       <p class="username text-p">
                                         <span class="title-span"
                                           >Sponsor Id:</span
                                         ><span>{{ levelData.sponsor_id }}</span>
                                       </p>
                                       <p class="username text-p">
                                         <span class="title-span"
                                           >Placement Id:</span
                                         ><span>{{
                                           levelData.virtual_parent_id
                                         }}</span>
                                       </p>
                                       <p class="username text-p">
                                         <span class="title-span">Package:</span
                                         ><span>{{
                                           levelData.product_name
                                         }}</span>
                                       </p>
                                     </div>
                                   </div>
                                   <div class="right-cols">
                                     <div class="right-wraper">
                                       <div class="table-detals">
                                         <div class="tabs-head d-flex">
                                           <div class="box-head"></div>
                                           <div class="box-head">Left</div>
                                           <div class="box-head">Right</div>
                                         </div>
                                         <div class="tabs-body d-flex">
                                           <div class="box-head">Team</div>
                                           <div class="box-head nums">
                                             {{ levelData.l_c_count }}
                                           </div>
                                           <div class="box-head nums">
                                             {{ levelData.r_c_count }}
                                           </div>
                                         </div>
                                         <div class="tabs-body d-flex">
                                           <div class="box-head">Business</div>
                                           <div class="box-head nums">
                                             {{ levelData.l_bv }}
                                           </div>
                                           <div class="box-head nums">
                                             {{ levelData.r_bv }}
                                           </div>
                                         </div>
                                         <div class="tabs-body d-flex">
                                           <div class="box-head">
                                             Carry Forward
                                           </div>
                                           <div class="box-head nums">
                                             {{ levelData.left_bv }}
                                           </div>
                                           <div class="box-head nums">
                                             {{ levelData.right_bv }}
                                           </div>
                                         </div>
                                       </div>
                                     </div>
                                   </div>
                                 </div>
                               </div>
                             </div>
                           </a>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <div class="row">
               <div class="col-md-12">
                 <div class="d-flex status-wraper">
                   <div class="status-cols">
                     <img src="public/user_files/assets/images/Active.png" />
                     <span>Active</span>
                   </div>
                   <div class="status-cols">
                     <img src="public/user_files/assets/images/Inactive.png" />
                     <span>Inactive</span>
                   </div>
                   <div class="status-cols">
                     <img src="public/user_files/assets/images/Absent.png" />
                     <span>Absent</span>
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
 import UserDetails from "./UserDetails.vue";
 
 import Breadcrum from "./BreadcrumComponent.vue";
 import { userAssets } from "../../user-config/config";
 //import moment from "moment";
 export default {
   components: {
     Breadcrum,
     UserDetails,
   },
   data() {
     return {
       imgURL: userAssets,
       user_id: "",
       userdata: {},
       usertreeview: [],
       lengthOFlastlevelOfTree: 0,
       isAvialable: "",
       searchText: "",
       nameForBack: "",
       BackListArray: [],
       ForwordListArray: [],
       back_status: false,
       forward_status: false,
       usersleft: "",
       usersright: "",
       todayleft: "",
       todayright: "",
       usersrightcounts: "",
       usersleftcounts: "",
       userdata_for_rank: {},
     };
   },
   computed: {
     getClassName() {
       return (i) => {
         if (i === 0) return "col-6 col-md-6 left-cols";
         else if (i === 1) return "col-6 col-md-6 right-cols";
         else return "NoClass";
         // In this way you can maintain as many classNames you want based on the condition
       };
     },
     getClassName3() {
       return (i) => {
         if (i === 0) return "col-3 col-md-3 left-cols";
         else if (i === 1) return "col-3 col-md-3 mid-cols";
         else if (i === 2) return "col-3 col-md-3 mid-2-cols";
         else if (i === 3) return "col-3 col-md-3 right-cols";
         else return "NoClass";
         // In this way you can maintain as many classNames you want based on the condition
       };
     },
     getsrc() {
       return (i) => {
         if (i === 0) return "public/user_files/assets/images/tree-line4.png";
         else if (i === 1)
           return "public/user_files/assets/images/tree-line7.png";
         else if (i === 2)
           return "public/user_files/assets/images/tree-line6.png";
         else if (i === 3)
           return "public/user_files/assets/images/tree-line5.png";
         else return "NoClass";
         // In this way you can maintain as many classNames you want based on the condition
       };
     },
     getClassForbox() {
       return (i) => {
         if (i === 0) return "img-box imgs-3rdleft";
         else if (i === 1) return "img-box imgs-3rdright";
         else if (i === 2) return "img-box imgs-3rdleft-level";
         else if (i === 3) return "img-box imgs-3rdright-level";
         else return "NoClass";
         // In this way you can maintain as many classNames you want based on the condition
       };
     },
   },
   mounted() {
     /*this.getUserDetails();*/
     //this.getAmount();
     //this.get_todays_rank_count();
     this.getTreeViewManual();
     $("li").hover(
       function () {
         $(this).addClass("is-active");
       },
       function () {
         $(this).removeClass("is-active");
       }
     );
     //this.getPools();
   },
   methods: {
     getUserDetails() {
       axios
         .get("get-user-dashboard", {})
         .then((response) => {
           this.userdata_for_rank = response.data.data;
           //this.referrallink = response.data.data;
           // $("#rank").html(this.userdata.rank);
         })
         .catch((error) => {});
     },
     getAmount() {
       axios
         .get("/getrank")
         .then((resp) => {
           if (resp.data.code === 200) {
             //console.log(resp);
             this.all_rank_data = resp.data.data[0];
             // this.usersleft = resp.data.data.usersleft;
             // this.usersright = resp.data.data.usersright;
             // this.usersrightcounts = resp.data.data.usersrightcounts;
             // this.usersleftcounts = resp.data.data.usersleftcounts;
             // this.todayleft = resp.data.data.todayleft;
             // this.todayright = resp.data.data.todayright;
           }
         })
         .catch({});
     },
     get_todays_rank_count() {
       axios
         .get("/getAmount")
         .then((resp) => {
           if (resp.data.code === 200) {
             console.log(resp);
 
             // this.all_rank_data = resp.data.data[0];
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
     getTreeViewManual() {
       axios
         .post("/getlevelviewtree/productbase", {
           id: this.user_id,
          // reqFrom: "web",
         })
         .then((resp) => {
           if (resp.data.code === 200) {
             this.userdata = resp.data.data.user;
             this.usertreeview = resp.data.data.tree_data;
             this.userdata_for_rank = resp.data.data.user_rankdata;
 
             this.lengthOFlastlevelOfTree =
               this.usertreeview[this.usertreeview.length - 1].level[
                 this.usertreeview[this.usertreeview.length - 1].level.length - 1
               ].level;
 
             if (!this.back_status) {
               this.nameForBack = this.userdata.user_id;
               if (
                 this.BackListArray[this.BackListArray.length - 1] !==
                 this.nameForBack
               ) {
                 this.BackListArray.push(this.nameForBack);
               }
               this.back_status = false;
             }
           }
         })
         .catch((err) => {
          // this.$toaster.error(err);
         });
     },
     getWidth(data) {
       switch (data.level) {
         case 1:
           return "50%";
         case 2:
           return "25%";
       }
     },
     changeStyle($event) {
       $(".nav li").hover(function () {
         $(this).addClass("is-active").siblings().removeClass("is-active");
       });
 
       $(".nav li").mouseleave(function () {
         $(this).removeClass("is-active");
       });
     },
     getMatrixTreeData(id) {
       this.user_id = id;
       this.getTreeViewManual();
     },
     onSearchClick() {
       this.isAvialable = "";
       if (this.searchText === "") {
         this.isAvialable = "";
       } else {
         this.user_id = this.searchText;
         this.getTreeViewManual();
       }
     },
     onBackClick() {
       if (this.BackListArray.length === 1) {
         this.back_status = false;
         this.$toaster.error("You are on root, you can not back");
       } else {
         this.back_status = true;
         const lengthOfArray = this.BackListArray.length;
         const userIdForBack = this.BackListArray[lengthOfArray - 2];
         const userIdForForword = this.BackListArray[lengthOfArray - 1];
         this.getMatrixTreeData(userIdForBack);
         this.BackListArray.splice(lengthOfArray - 1, 1);
         this.ForwordListArray.push(userIdForForword);
       }
       this.searchText = "";
       this.isAvialable = "";
     },
     onForwardClick() {
       if (this.ForwordListArray.length === 0) {
         this.forward_status = false;
         this.$toaster.error("You are on root, you can not back");
       } else {
         this.forward_status = true;
         const lengthOfArray = this.ForwordListArray.length;
 
         /*if(lengthOfArray > 1){
                   const userIdForForword = this.ForwordListArray[lengthOfArray - 2];
                   this.getMatrixTreeData(this.ForwordListArray[lengthOfArray - 1]);
                } else {
                   const userIdForForword = this.ForwordListArray[lengthOfArray - 1];
                   this.getMatrixTreeData(this.ForwordListArray[lengthOfArray - 1]);
                }*/
         const userIdForBack = this.ForwordListArray[lengthOfArray - 1];
         //this.getMatrixTreeData(userIdForForword);
         this.getMatrixTreeData(this.ForwordListArray[lengthOfArray - 1]);
         this.ForwordListArray.splice(lengthOfArray - 1, 1);
         this.BackListArray.push(userIdForBack);
       }
       this.searchText = "";
       this.isAvialable = "";
     },
     checkUserExisted() {
       axios
         .post("/checkuserexist/crossleg", {
           user_id: this.searchText,
         })
         .then((resp) => {
           if (resp.data.code === 200) {
             this.isAvialable = "Available";
           } else {
             this.isAvialable = "Not Available";
           }
         })
         .catch((err) => {
           this.$toaster.error(err);
         });
     },
     registerUser(position, current_level, current_placement) {
       //console.log("Position : " + position);
       // console.log("Virtual : " + virtual_id);
       // console.log("Sponsor : " + sponsor_id);
       // console.log("Current Placement Position : " + current_placement);
       //console.log(this.usertreeview);
       // fetch placement id
       let placement_level = current_level - 2;
       if (placement_level < 0) {
         this.$root.placement_user_id = this.userdata.user_id;
       } else {
         //console.log("Placement Level : " + placement_level);
         let fetchposition = current_placement < 2 ? 0 : 1;
         //console.log("Fetch Position : " + fetchposition);
         let Sponsoruserinfo =
           this.usertreeview[placement_level].level[fetchposition];
         //console.log(this.virtual_parent_id );
         //let virtual_id = Sponsoruserinfo.user_id
         this.$root.placement_user_id = Sponsoruserinfo.user_id;
         /*this.$root.position  = position;
                this.$router.push({name: 'register-user'});*/
         //console.log(JSON.stringify(Sponsoruserinfo));
         //console.log("Virtual : " + virtual_id);
       }
       if (
         this.$root.placement_user_id != undefined &&
         this.$root.placement_user_id != "Absent"
       ) {
         this.$root.position = position;
        this.$router.push({
          name: "register-user",
         });
       }
       //console.log("Register");
     },
   },
 };
 </script>