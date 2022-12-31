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
                  <input type="text"  v-model="searchText" class="form-control" placeholder="User ID" autocomplete="off" v-on:keyup="checkUserExisted" v-validate="{required:true,min:6,max:10,regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+){6,10}$/}" maxlength="10"/>
                    <!--<input type="text" class="form-control" placeholder="Search user Id">-->
                    <div class="input-group-append">
                     <button class="btn btn-search" type="button" @click="onSearchClick"><i class="fa fa-search" aria-hidden="true"></i></button>
                     <button class="btn btn-search" @click="onBackClick" ><i class="fa fa-arrow-left"></i></button>
                    <button class="btn btn-search" @click="onForwardClick"><i class="fa fa-arrow-right"></i></button>
                    </div>
                  </div>
                 </div>
               </div> 
               <div class="row treeview-section">
                      <div class="col-md-12">
                       <div class="tree-struct">
                          <div class="row tree-level-1 midline row-1">
                            <div class="col-12 col-md-12">
                              <a href="#" class="mytooltip">
                                 <div class="img-box">
                                  <img  :src="imgURL + '/assets/images/tree-view/' +userdata.image"  class="user-icons"/><br />
                           <!--<img src="public/user_files/images/Active.png" class="user-icons"><br>-->
                                  <span>{{ userdata.user_id }}</span>
                                </div>
                                <div class="tooltiptext">
                                  <div class="tooltip-body d-flex align-items-center">
                                   <div class="contentID-wraper d-flex align-items-center justify-content-center">
                                      <div class="wraper-box"><div class="img-wraper"><img :src=" imgURL +'/assets/images/tree-view/' +userdata.image"/>
                                        <!--<img src="images/user-tooltip.png">--></div><br><span class="userID-text">{{ userdata.user_id }}</span></div> 
                                   </div>
                                   <div class="content-wraper d-flex">
                                      <div class="left-cols">
                                       <p class="username text-p"><span class="title-span">Username:</span>
                                      <span v-if="userdata.user_id=='Absent'">-</span>
                                      <span v-if="userdata.user_id!='Absent'">{{userdata.fullname}}</span>
                                      </p>
                                       <p class="username text-p"><span class="title-span">UserID:</span><span>{{ userdata.user_id }}</span></p>
                                       <p class="username text-p"><span class="title-span">Status:</span><span  v-if="userdata.selftopup > 0">Active</span><span v-else>InActive</span></p>
                                       <div class="more-detail">
                                         <p class="username text-p"><span class="title-span">Sponsor Id:</span><span>{{ userdata.sponsor_id }}</span></p>
                                         <p class="username text-p"><span class="title-span">Placement Id:</span><span>{{userdata.virtual_parent_id}}</span></p>
                                        <p class="username text-p"><span class="title-span">Package:</span><span>{{ userdata.product_name }}</span></p>
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
                                             <div class="box-head nums"> {{ userdata.l_c_count }}</div>
                                             <div class="box-head nums"> {{ userdata.r_c_count }}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Business</div>
                                             <div class="box-head nums">{{ userdata.l_bv }}</div>
                                             <div class="box-head nums">{{ userdata.r_bv }}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Carry Forward</div>
                                             <div class="box-head nums">{{ userdata.left_bv }}</div>
                                             <div class="box-head nums">{{ userdata.right_bv }}</div>
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
                            <div class="col-md-12 tree-line"><img src="public/user_files/assets/images/tree-line.png"></div>
                            <div class="col-6 col-md-6 left-cols">
                              <a href="#" class="mytooltip">
                                 <div class="img-box">
                                  <img  :src="imgURL + '/assets/images/tree-view/' +usertreeview[0].level[0].image"  class="user-icons"/><br />
                                 <span>{{ usertreeview[0].level[0].user_id }}</span>
                                </div>
                                <div class="tooltiptext import">
                                  <div class="tooltip-body d-flex align-items-center">
                                   <div class="contentID-wraper d-flex align-items-center justify-content-center">
                                      <div class="wraper-box"><div class="img-wraper"><img :src=" imgURL + '/assets/images/tree-view/' +usertreeview[0].level[0].image"/></div><br><span class="userID-text">{{ usertreeview[0].level[0].user_id }}</span></div> 
                                   </div>
                                   <div class="content-wraper d-flex">
                                      <div class="left-cols">
                                       <p class="username text-p"><span class="title-span">Username:</span>
                                        <span v-if="usertreeview[0].level[0].user_id=='Absent'">-</span>
                                        <span v-if="usertreeview[0].level[0].user_id!='Absent'">{{usertreeview[0].level[0].fullname}}</span>
                                      </p>
                                       <p class="username text-p"><span class="title-span">UserID:</span><span>{{ usertreeview[0].level[0].user_id }}</span></p>
                                       <p class="username text-p"><span class="title-span">Status:</span><span  v-if="usertreeview[0].level[0].selftopup > 0">Active</span><span v-else>InActive</span></p>
                                       <div class="more-detail">
                                         <p class="username text-p"><span class="title-span">Sponsor Id:</span><span>{{ usertreeview[0].level[0].sponsor_id }}</span></p>
                                         <p class="username text-p"><span class="title-span">Placement Id:</span><span>{{ usertreeview[0].level[0].virtual_parent_id }}</span></p>
                                        <p class="username text-p"><span class="title-span">Package:</span><span>{{ usertreeview[0].level[0].product_name }}</span></p>
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
                                             <div class="box-head nums">{{ usertreeview[0].level[0].l_c_count }}</div>
                                             <div class="box-head nums">{{ usertreeview[0].level[0].l_c_count }}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Business</div>
                                             <div class="box-head nums">{{ usertreeview[0].level[0].l_bv }}</div>
                                             <div class="box-head nums">{{ usertreeview[0].level[0].r_bv }}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Carry Forward</div>
                                             <div class="box-head nums">{{ usertreeview[0].level[0].left_bv }}</div>
                                             <div class="box-head nums">{{ usertreeview[0].level[0].right_bv }}</div>
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
                           <div class="col-6 col-md-6 right-cols">
                              <a href="#" class="mytooltip">
                                 <div class="img-box">
                                  <img  :src="imgURL + '/assets/images/tree-view/' + usertreeview[0].level[1].image"  class="user-icons"/><br />
                                    <span>{{ usertreeview[0].level[1].user_id }}</span>
                                </div>
                                <div class="tooltiptext">
                                  <div class="tooltip-body d-flex align-items-center">
                                   <div class="contentID-wraper d-flex align-items-center justify-content-center">
                                      <div class="wraper-box"><div class="img-wraper"><img :src=" imgURL + '/assets/images/tree-view/' +usertreeview[0].level[1].image"></div><br><span class="userID-text">{{ usertreeview[0].level[1].user_id }}</span></div> 
                                   </div>
                                   <div class="content-wraper d-flex">
                                      <div class="left-cols">
                                       <p class="username text-p"><span class="title-span">Username:</span>
                                        <span v-if="usertreeview[0].level[1].user_id=='Absent'">-</span>
                                          <span v-if="usertreeview[0].level[1].user_id!='Absent'">{{usertreeview[0].level[1].fullname}}</span>
                                     </p>
                                       <p class="username text-p"><span class="title-span">UserID:</span><span>{{ usertreeview[0].level[1].user_id }}</span></p>
                                       <p class="username text-p"><span class="title-span">Status:</span><span  v-if="usertreeview[0].level[1].selftopup > 0">Active</span><span v-else>InActive</span></p>
                                       <div class="more-detail">
                                         <p class="username text-p"><span class="title-span">Sponsor Id:</span><span>{{ usertreeview[0].level[1].sponsor_id }}</span></p>
                                         <p class="username text-p"><span class="title-span">Placement Id:</span><span>{{ usertreeview[0].level[1].virtual_parent_id }}</span></p>
                                        <p class="username text-p"><span class="title-span">Package:</span><span>{{ usertreeview[0].level[1].product_name }}</span></p>
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
                                             <div class="box-head nums">{{usertreeview[0].level[1].l_c_count}}</div>
                                             <div class="box-head nums">{{usertreeview[0].level[1].r_c_count}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Business</div>
                                             <div class="box-head nums">{{usertreeview[0].level[1].l_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[0].level[1].r_bv}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Carry Forward</div>
                                             <div class="box-head nums">{{usertreeview[0].level[1].left_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[0].level[1].right_bv}}</div>
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
                         <div class="row row-3">
                            <div class="col-6 col-md-6 left-cols">
                             <div class="row tree-level-3 midline VHline">
                                <div class="col-md-12 tree-line"><img src="public/user_files/assets/images/tree-line2.png"></div>
                                <div class="col-6 col-md-6">
                                  <a href="#" class="mytooltip">
                                   <div class="img-box imgs-3rdleft">
                                    <img  :src="imgURL + '/assets/images/tree-view/' + usertreeview[1].level[0].image"  class="user-icons"/><br />
                                    <!--<img src="images/Active.png" class="user-icons"><br>-->
                                     <span>{{usertreeview[1].level[0].user_id}}</span>
                                   </div>
                                   <div class="tooltiptext">
                                  <div class="tooltip-body d-flex align-items-center">
                                   <div class="contentID-wraper d-flex align-items-center justify-content-center">
                                      <div class="wraper-box"><div class="img-wraper"><img :src=" imgURL + '/assets/images/tree-view/' +usertreeview[1].level[0].image"></div><br><span class="userID-text">{{usertreeview[1].level[0].user_id}}</span></div> 
                                   </div>
                                   <div class="content-wraper d-flex">
                                      <div class="left-cols">
                                       <p class="username text-p"><span class="title-span">Username:</span>
                                        <span v-if="usertreeview[1].level[0].user_id=='Absent'">-</span>
                                        <span v-if="usertreeview[1].level[0].user_id!='Absent'">{{usertreeview[1].level[0].fullname}}</span>
                                     </p>
                                       <p class="username text-p"><span class="title-span">UserID:</span><span>{{usertreeview[1].level[0].user_id}}</span></p>
                                       <p class="username text-p"><span class="title-span">Status:</span><span  v-if="usertreeview[0].level[0].selftopup > 0">Active</span><span v-else>InActive</span></p>
                                       <div class="more-detail">
                                         <p class="username text-p"><span class="title-span">Sponsor Id:</span><span>{{usertreeview[1].level[0].sponsor_id}}</span></p>
                                         <p class="username text-p"><span class="title-span">Placement Id:</span><span>{{usertreeview[1].level[0].virtual_parent_id}}</span></p>
                                        <p class="username text-p"><span class="title-span">Package:</span><span>{{usertreeview[1].level[0].product_name}}</span></p>
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
                                             <div class="box-head nums">{{usertreeview[1].level[0].l_c_count}}</div>
                                             <div class="box-head nums">{{usertreeview[1].level[0].r_c_count}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Business</div>
                                             <div class="box-head nums">{{usertreeview[1].level[0].l_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[1].level[0].r_bv}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Carry Forward</div>
                                             <div class="box-head nums">{{usertreeview[1].level[0].left_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[1].level[0].right_bv}}</div>
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
                               <div class="col-6 col-md-6">
                                 <a href="#" class="mytooltip">
                                   <div class="img-box imgs-3rdright">
                                     <!--<img src="images/Active.png" class="user-icons"><br>-->
                                     <img  :src="imgURL + '/assets/images/tree-view/' + usertreeview[1].level[1].image"  class="user-icons"/><br />
                                   
                                     <span>{{usertreeview[1].level[1].user_id}}</span>
                                   </div>
                                   <div class="tooltiptext">
                                  <div class="tooltip-body d-flex align-items-center">
                                   <div class="contentID-wraper d-flex align-items-center justify-content-center">
                                      <div class="wraper-box"><div class="img-wraper"><img :src=" imgURL + '/assets/images/tree-view/' +usertreeview[1].level[1].image"></div><br><span class="userID-text">{{usertreeview[1].level[1].user_id}}</span></div> 
                                   </div>
                                   <div class="content-wraper d-flex">
                                      <div class="left-cols">
                                       <p class="username text-p"><span class="title-span">Username:</span>
                                        <span v-if="usertreeview[1].level[1].user_id=='Absent'">-</span>
                                        <span v-if="usertreeview[1].level[1].user_id!='Absent'">{{usertreeview[1].level[1].fullname}}</span>
                                     </p>
                                       <p class="username text-p"><span class="title-span">UserID:</span><span>{{usertreeview[1].level[1].user_id}}</span></p>
                                       <p class="username text-p"><span class="title-span">Status:</span><span  v-if="usertreeview[1].level[1].selftopup > 0">Active</span><span v-else>InActive</span></p>
                                       <div class="more-detail">
                                         <p class="username text-p"><span class="title-span">Sponsor Id:</span><span>{{usertreeview[1].level[1].sponsor_id}}</span></p>
                                         <p class="username text-p"><span class="title-span">Placement Id:</span><span>{{usertreeview[1].level[1].virtual_parent_id}}</span></p>
                                        <p class="username text-p"><span class="title-span">Package:</span><span>{{usertreeview[1].level[1].product_name}}</span></p>
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
                                             <div class="box-head nums">{{usertreeview[1].level[1].l_c_count}}</div>
                                             <div class="box-head nums">{{usertreeview[1].level[1].r_c_count}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Business</div>
                                             <div class="box-head nums">{{usertreeview[1].level[1].l_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[1].level[1].r_bv}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Carry Forward</div>
                                             <div class="box-head nums">{{usertreeview[1].level[1].left_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[1].level[1].right_bv}}</div>
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
                           </div>
                           <div class="col-6 col-md-6 right-cols">
                              <div class="row tree-level-3 midline VHline">
                                <div class="col-md-12 tree-line"><img src="public/user_files/assets/images/tree-line3.png"></div>
                                <div class="col-6 col-md-6">
                                  <a href="#" class="mytooltip">
                                   <div class="img-box imgs-3rdleft-level">
                                    <img  :src="imgURL + '/assets/images/tree-view/' + usertreeview[1].level[2].image"  class="user-icons"/><br />
                                   <span>{{usertreeview[1].level[2].user_id}}</span>
                                   </div>
                                   <div class="tooltiptext">
                                  <div class="tooltip-body d-flex align-items-center">
                                   <div class="contentID-wraper d-flex align-items-center justify-content-center">
                                      <div class="wraper-box"><div class="img-wraper"><img :src=" imgURL + '/assets/images/tree-view/' +usertreeview[1].level[2].image"></div><br><span class="userID-text">{{usertreeview[1].level[2].user_id}}</span></div> 
                                   </div>
                                   <div class="content-wraper d-flex">
                                      <div class="left-cols">
                                       <p class="username text-p"><span class="title-span">Username:</span>
                                        <span v-if="usertreeview[1].level[2].user_id=='Absent'">-</span>
                                        <span v-if="usertreeview[1].level[2].user_id!='Absent'">{{usertreeview[1].level[2].fullname}}</span>
                                        </p>
                                       <p class="username text-p"><span class="title-span">UserID:</span><span>{{usertreeview[1].level[2].user_id}}</span></p>
                                       <p class="username text-p"><span class="title-span">Status:</span><span  v-if="usertreeview[1].level[2].selftopup > 0">Active</span><span v-else>InActive</span></p>
                                       <div class="more-detail">
                                         <p class="username text-p"><span class="title-span">Sponsor Id:</span><span>{{usertreeview[1].level[2].sponsor_id}}</span></p>
                                         <p class="username text-p"><span class="title-span">Placement Id:</span><span>{{usertreeview[1].level[2].virtual_parent_id}}</span></p>
                                        <p class="username text-p"><span class="title-span">Package:</span><span>{{usertreeview[1].level[2].product_name}}</span></p>
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
                                             <div class="box-head nums">{{usertreeview[1].level[2].user_id}}</div>
                                             <div class="box-head nums">{{usertreeview[1].level[2].user_id}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Business</div>
                                             <div class="box-head nums">{{usertreeview[1].level[2].user_id}}</div>
                                             <div class="box-head nums">{{usertreeview[1].level[2].user_id}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Carry Forward</div>
                                             <div class="box-head nums">{{usertreeview[1].level[2].user_id}}</div>
                                             <div class="box-head nums">{{usertreeview[1].level[2].user_id}}</div>
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
                               <div class="col-6 col-md-6">
                                 <a href="#" class="mytooltip">
                                   <div class="img-box imgs-3rdright-level">
                                    <img  :src="imgURL + '/assets/images/tree-view/' + usertreeview[1].level[3].image"  class="user-icons"/><br />
                                   
                                     <span>{{usertreeview[1].level[3].user_id}}</span>
                                   </div>
                                   <div class="tooltiptext">
                                  <div class="tooltip-body d-flex align-items-center">
                                   <div class="contentID-wraper d-flex align-items-center justify-content-center">
                                      <div class="wraper-box"><div class="img-wraper"><img :src=" imgURL + '/assets/images/tree-view/' +usertreeview[1].level[3].image"></div><br><span class="userID-text">{{usertreeview[1].level[3].user_id}}</span></div> 
                                   </div>
                                   <div class="content-wraper d-flex">
                                      <div class="left-cols">
                                       <p class="username text-p"><span class="title-span">Username:</span>
                                        <span v-if="usertreeview[1].level[3].user_id=='Absent'">-</span>
                                        <span v-if="usertreeview[1].level[3].user_id!='Absent'">{{usertreeview[1].level[3].fullname}}</span>
                                     </p>
                                       <p class="username text-p"><span class="title-span">UserID:</span><span>{{usertreeview[1].level[3].user_id}}</span></p>
                                       <p class="username text-p"><span class="title-span">Status:</span><span  v-if="usertreeview[1].level[3].selftopup > 0">Active</span><span v-else>InActive</span></p>
                                       <div class="more-detail">
                                         <p class="username text-p"><span class="title-span">Sponsor Id:</span><span>{{usertreeview[1].level[3].sponser_id}}</span></p>
                                         <p class="username text-p"><span class="title-span">Placement Id:</span><span>{{usertreeview[1].level[3].virtual_parent_id}}</span></p>
                                        <p class="username text-p"><span class="title-span">Package:</span><span>{{usertreeview[1].level[3].product_name}}</span></p>
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
                                             <div class="box-head nums">{{usertreeview[1].level[3].l_c_count}}</div>
                                             <div class="box-head nums">{{usertreeview[1].level[3].r_c_count}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Business</div>
                                             <div class="box-head nums">{{usertreeview[1].level[3].l_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[1].level[3].r_bv}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Carry Forward</div>
                                             <div class="box-head nums">{{usertreeview[1].level[3].left_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[1].level[3].right_bv}}</div>
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
                           </div>
                         </div>
                         <div class="row row-4">
                            <div class="col-3 col-md-3 left-cols">
                             <div class="row tree-level-4 midline VHline">
                             <div class="col-md-12 tree-line line-four-1"><img src="public/user_files/assets/images/tree-line4.png"></div>
                                <div class="col-6 col-md-6">
                                  <a href="#" class="mytooltip">
                                   <div class="img-box img-level-1">
                                    <img  :src="imgURL + '/assets/images/tree-view/' + usertreeview[2].level[0].image"  class="user-icons"/><br />
                                    <span>{{usertreeview[2].level[0].user_id}}</span>
                                   </div>
                                   <div class="tooltiptext">
                                  <div class="tooltip-body d-flex align-items-center">
                                   <div class="contentID-wraper d-flex align-items-center justify-content-center">
                                      <div class="wraper-box"><div class="img-wraper"><img :src=" imgURL +'/assets/images/tree-view/' +usertreeview[2].level[0].image"/></div><br><span class="userID-text">{{usertreeview[2].level[0].user_id}}</span></div> 
                                   </div>
                                   <div class="content-wraper d-flex">
                                      <div class="left-cols">
                                       <p class="username text-p"><span class="title-span">Username:</span>
                                        <span v-if="usertreeview[2].level[0].user_id=='Absent'">-</span>
                                        <span v-if="usertreeview[2].level[0].user_id!='Absent'">{{usertreeview[2].level[0].fullname}}</span>
                                        </p>
                                       <p class="username text-p"><span class="title-span">UserID:</span><span>{{usertreeview[2].level[0].user_id}}</span></p>
                                       <p class="username text-p"><span class="title-span">Status:</span><span  v-if="usertreeview[2].level[0].selftopup > 0">Active</span><span v-else>InActive</span></p>
                                       <div class="more-detail">
                                         <p class="username text-p"><span class="title-span">Sponsor Id:</span><span>{{usertreeview[2].level[0].sponsor_id}}</span></p>
                                         <p class="username text-p"><span class="title-span">Placement Id:</span><span>{{usertreeview[2].level[0].virtual_parent_id}}</span></p>
                                        <p class="username text-p"><span class="title-span">Package:</span><span>{{usertreeview[2].level[0].product_name}}</span></p>
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
                                             <div class="box-head nums">{{usertreeview[2].level[0].l_c_count}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[0].r_c_count}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Business</div>
                                             <div class="box-head nums">{{usertreeview[2].level[0].l_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[0].r_bv}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Carry Forward</div>
                                             <div class="box-head nums">{{usertreeview[2].level[0].left_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[0].right_bv}}</div>
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
                               <div class="col-6 col-md-6">
                                 <a href="#" class="mytooltip">
                                   <div class="img-box img-level-2">
                                    <img  :src="imgURL + '/assets/images/tree-view/' + usertreeview[2].level[1].image"  class="user-icons"/><br />
                                   <span>{{usertreeview[2].level[1].user_id}}</span>
                                   </div>
                                   <div class="tooltiptext">
                                  <div class="tooltip-body d-flex align-items-center">
                                   <div class="contentID-wraper d-flex align-items-center justify-content-center">
                                      <div class="wraper-box"><div class="img-wraper"><img :src=" imgURL +'/assets/images/tree-view/' +usertreeview[2].level[1].image"/></div><br><span class="userID-text">{{usertreeview[2].level[1].user_id}}</span></div> 
                                   </div>
                                   <div class="content-wraper d-flex">
                                      <div class="left-cols">
                                       <p class="username text-p"><span class="title-span">Username:</span>
                                        <span v-if="usertreeview[2].level[1].user_id=='Absent'">-</span>
                                        <span v-if="usertreeview[2].level[1].user_id!='Absent'">{{usertreeview[2].level[1].fullname}}</span>
                                        </p>
                                       <p class="username text-p"><span class="title-span">UserID:</span><span>{{usertreeview[2].level[1].user_id}}</span></p>
                                       <p class="username text-p"><span class="title-span">Status:</span><span  v-if="usertreeview[2].level[1].selftopup > 0">Active</span><span v-else>InActive</span></p>
                                       <div class="more-detail">
                                         <p class="username text-p"><span class="title-span">Sponsor Id:</span><span>{{usertreeview[2].level[1].sponsor_id}}</span></p>
                                         <p class="username text-p"><span class="title-span">Placement Id:</span><span>{{usertreeview[2].level[1].virtual_parent_id}}</span></p>
                                        <p class="username text-p"><span class="title-span">Package:</span><span>{{usertreeview[2].level[1].product_name}}</span></p>
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
                                             <div class="box-head nums">{{usertreeview[2].level[1].l_c_count}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[1].r_c_count}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Business</div>
                                             <div class="box-head nums">{{usertreeview[2].level[1].l_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[1].r_bv}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Carry Forward</div>
                                             <div class="box-head nums">{{usertreeview[2].level[1].left_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[1].right_bv}}</div>
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
                           </div>
                           <div class="col-3 col-md-3 mid-cols">
                              <div class="row tree-level-4 midline VHline">
                              <div class="col-md-12 tree-line line-four-2"><img src="public/user_files/assets/images/tree-line7.png"></div>
                                <div class="col-6 col-md-6">
                                  <a href="#" class="mytooltip">
                                   <div class="img-box img-level-3">
                                    <img  :src="imgURL + '/assets/images/tree-view/' + usertreeview[2].level[2].image"  class="user-icons"/><br />
                                   <span>{{usertreeview[2].level[2].user_id}}</span>
                                   </div>
                                   <div class="tooltiptext">
                                  <div class="tooltip-body d-flex align-items-center">
                                   <div class="contentID-wraper d-flex align-items-center justify-content-center">
                                      <div class="wraper-box"><div class="img-wraper"><img :src=" imgURL +'/assets/images/tree-view/' +usertreeview[2].level[2].image"/></div><br><span class="userID-text">{{usertreeview[2].level[2].user_id}}</span></div> 
                                   </div>
                                   <div class="content-wraper d-flex">
                                      <div class="left-cols">
                                       <p class="username text-p"><span class="title-span">Username:</span>
                                        <span v-if="usertreeview[2].level[2].user_id=='Absent'">-</span>
                                        <span v-if="usertreeview[2].level[2].user_id!='Absent'">{{usertreeview[2].level[2].fullname}}</span>
                                        </p>
                                       <p class="username text-p"><span class="title-span">UserID:</span><span>{{usertreeview[2].level[2].user_id}}</span></p>
                                       <p class="username text-p"><span class="title-span">Status:</span><span  v-if="usertreeview[2].level[2].selftopup > 0">Active</span><span v-else>InActive</span></p>
                                       <div class="more-detail">
                                         <p class="username text-p"><span class="title-span">Sponsor Id:</span><span>{{usertreeview[2].level[2].sponser_id}}</span></p>
                                         <p class="username text-p"><span class="title-span">Placement Id:</span><span>{{usertreeview[2].level[2].virtual_parent_id}}</span></p>
                                        <p class="username text-p"><span class="title-span">Package:</span><span>{{usertreeview[2].level[2].product_name}}</span></p>
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
                                             <div class="box-head nums">{{usertreeview[2].level[2].l_c_count}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[2].r_c_count}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Business</div>
                                             <div class="box-head nums">{{usertreeview[2].level[2].l_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[2].r_bv}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Carry Forward</div>
                                             <div class="box-head nums">{{usertreeview[2].level[2].left_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[2].right_bv}}</div>
                                          </div>
                                         </div>
                                       </div>
                                     </div>
                                   </div>
                                 </div>
                                </div>>
                                 </a>
                                 <!--<p class="p-title"><span>QU92101415</span></p>-->
                               </div>
                               <div class="col-6 col-md-6">
                                 <a href="#" class="mytooltip">
                                   <div class="img-box img-level-4">
                                    <img  :src="imgURL + '/assets/images/tree-view/' + usertreeview[2].level[3].image"  class="user-icons"/><br />
                                    <span>{{usertreeview[2].level[3].user_id}}</span>
                                   </div>
                                   <div class="tooltiptext">
                                  <div class="tooltip-body d-flex align-items-center">
                                   <div class="contentID-wraper d-flex align-items-center justify-content-center">
                                      <div class="wraper-box"><div class="img-wraper"><img :src=" imgURL +'/assets/images/tree-view/' +usertreeview[2].level[3].image"/></div><br><span class="userID-text">{{usertreeview[2].level[3].user_id}}</span></div> 
                                   </div>
                                   <div class="content-wraper d-flex">
                                      <div class="left-cols">
                                       <p class="username text-p"><span class="title-span">Username:</span>
                                        <span v-if="usertreeview[2].level[3].user_id=='Absent'">-</span>
                                        <span v-if="usertreeview[2].level[3].user_id!='Absent'">{{usertreeview[2].level[3].fullname}}</span>
                                        </p>
                                       <p class="username text-p"><span class="title-span">UserID:</span><span>{{usertreeview[2].level[3].user_id}}</span></p>
                                       <p class="username text-p"><span class="title-span">Status:</span><span  v-if="usertreeview[2].level[3].selftopup > 0">Active</span><span v-else>InActive</span></p>
                                       <div class="more-detail">
                                         <p class="username text-p"><span class="title-span">Sponsor Id:</span><span>{{usertreeview[2].level[3].sponser_id}}</span></p>
                                         <p class="username text-p"><span class="title-span">Placement Id:</span><span>{{usertreeview[2].level[3].virtual_parent_id}}</span></p>
                                        <p class="username text-p"><span class="title-span">Package:</span><span>{{usertreeview[2].level[3].product_name}}</span></p>
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
                                             <div class="box-head nums">{{usertreeview[2].level[3].l_c_count}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[3].r_c_count}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Business</div>
                                             <div class="box-head nums">{{usertreeview[2].level[3].l_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[3].r_bv}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Carry Forward</div>
                                             <div class="box-head nums">{{usertreeview[2].level[3].left_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[3].right_bv}}</div>
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
                           </div>
                           <div class="col-3 col-md-3 mid-2-cols">
                              <div class="row tree-level-4 midline VHline">
                              <div class="col-md-12 tree-line line-four-3"><img src="public/user_files/assets/images/tree-line6.png"></div>
                                <div class="col-6 col-md-6">
                                  <a href="#" class="mytooltip">
                                   <div class="img-box img-level-5">
                                    <img  :src="imgURL + '/assets/images/tree-view/' + usertreeview[2].level[4].image"  class="user-icons"/><br />
                                   <span>{{usertreeview[2].level[4].user_id}}</span>
                                   </div>
                                   <div class="tooltiptext">
                                  <div class="tooltip-body d-flex align-items-center">
                                   <div class="contentID-wraper d-flex align-items-center justify-content-center">
                                      <div class="wraper-box"><div class="img-wraper"><img :src=" imgURL +'/assets/images/tree-view/' +usertreeview[2].level[4].image"/></div><br><span class="userID-text">{{usertreeview[2].level[4].user_id}}</span></div> 
                                   </div>
                                   <div class="content-wraper d-flex">
                                      <div class="left-cols">
                                       <p class="username text-p"><span class="title-span">Username:</span>
                                        <span v-if="usertreeview[2].level[4].user_id=='Absent'">-</span>
                                        <span v-if="usertreeview[2].level[4].user_id!='Absent'">{{usertreeview[2].level[4].fullname}}</span>
                                      </p>
                                       <p class="username text-p"><span class="title-span">UserID:</span><span>{{usertreeview[2].level[4].user_id}}</span></p>
                                       <p class="username text-p"><span class="title-span">Status:</span><span  v-if="usertreeview[2].level[4].selftopup > 0">Active</span><span v-else>InActive</span></p>
                                       <div class="more-detail">
                                         <p class="username text-p"><span class="title-span">Sponsor Id:</span><span>{{usertreeview[2].level[4].sponser_id}}</span></p>
                                         <p class="username text-p"><span class="title-span">Placement Id:</span><span>{{usertreeview[2].level[4].virtual_parent_id}}</span></p>
                                        <p class="username text-p"><span class="title-span">Package:</span><span>{{usertreeview[2].level[4].product_name}}</span></p>
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
                                             <div class="box-head nums">{{usertreeview[2].level[4].l_c_count}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[4].r_c_count}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Business</div>
                                             <div class="box-head nums">{{usertreeview[2].level[4].l_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[4].r_bv}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Carry Forward</div>
                                             <div class="box-head nums">{{usertreeview[2].level[4].left_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[4].right_bv}}</div>
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
                               <div class="col-6 col-md-6">
                                 <a href="#" class="mytooltip">
                                   <div class="img-box img-level-6">
                                    <img  :src="imgURL + '/assets/images/tree-view/' + usertreeview[2].level[5].image"  class="user-icons"/><br />
                                   <span>{{ usertreeview[2].level[5].user_id }}</span>
                                   </div>
                                   <div class="tooltiptext">
                                  <div class="tooltip-body d-flex align-items-center">
                                   <div class="contentID-wraper d-flex align-items-center justify-content-center">
                                      <div class="wraper-box"><div class="img-wraper"><img :src=" imgURL +'/assets/images/tree-view/' +usertreeview[2].level[5].image"/></div><br><span class="userID-text">{{ usertreeview[2].level[5].user_id }}</span></div> 
                                   </div>
                                   <div class="content-wraper d-flex">
                                      <div class="left-cols">
                                       <p class="username text-p"><span class="title-span">Username:</span>
                                        <span v-if="usertreeview[2].level[5].user_id=='Absent'">-</span>
                                        <span v-if="usertreeview[2].level[5].user_id!='Absent'">{{usertreeview[2].level[5].fullname}}</span>
                                      </p>
                                       <p class="username text-p"><span class="title-span">UserID:</span><span>{{ usertreeview[2].level[5].user_id }}</span></p>
                                       <p class="username text-p"><span class="title-span">Status:</span><span  v-if="usertreeview[2].level[5].selftopup > 0">Active</span><span v-else>InActive</span></p>
                                       <div class="more-detail">
                                         <p class="username text-p"><span class="title-span">Sponsor Id:</span><span>{{ usertreeview[2].level[5].sponsor_id }}</span></p>
                                         <p class="username text-p"><span class="title-span">Placement Id:</span><span>{{ usertreeview[2].level[5].virtual_parent_id }}</span></p>
                                        <p class="username text-p"><span class="title-span">Package:</span><span>{{ usertreeview[2].level[5].product_name }}</span></p>
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
                                             <div class="box-head nums">{{ usertreeview[2].level[5].user_id }}</div>
                                             <div class="box-head nums">{{ usertreeview[2].level[5].user_id }}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Business</div>
                                             <div class="box-head nums">{{ usertreeview[2].level[5].user_id }}</div>
                                             <div class="box-head nums">{{ usertreeview[2].level[5].user_id }}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Carry Forward</div>
                                             <div class="box-head nums">{{ usertreeview[2].level[5].user_id }}</div>
                                             <div class="box-head nums">{{ usertreeview[2].level[5].user_id }}</div>
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
                           </div>
                           <div class="col-3 col-md-3 right-cols">
                              <div class="row tree-level-4 midline VHline">
                               <div class="col-md-12 tree-line line-four-4"><img src="public/user_files/assets/images/tree-line5.png"></div>
                                <div class="col-6 col-md-6">
                                  <a href="#" class="mytooltip">
                                   <div class="img-box img-level-7">
                                    <img  :src="imgURL + '/assets/images/tree-view/' + usertreeview[2].level[6].image"  class="user-icons"/><br />
                                   <span>{{usertreeview[2].level[6].user_id}}</span>
                                   </div>
                                   <div class="tooltiptext">
                                  <div class="tooltip-body d-flex align-items-center">
                                   <div class="contentID-wraper d-flex align-items-center justify-content-center">
                                      <div class="wraper-box"><div class="img-wraper"><img :src=" imgURL +'/assets/images/tree-view/' +usertreeview[2].level[6].image"/></div><br><span class="userID-text">{{usertreeview[2].level[6].user_id}}</span></div> 
                                   </div>
                                   <div class="content-wraper d-flex">
                                      <div class="left-cols">
                                       <p class="username text-p"><span class="title-span">Username:</span>
                                        <span v-if="usertreeview[2].level[6].user_id=='Absent'">-</span>
                                        <span v-if="usertreeview[2].level[6].user_id!='Absent'">{{usertreeview[2].level[6].fullname}}</span>
                                      </p>
                                       <p class="username text-p"><span class="title-span">UserID:</span><span>{{usertreeview[2].level[6].user_id}}</span></p>
                                       <p class="username text-p"><span class="title-span">Status:</span><span  v-if="usertreeview[2].level[6].selftopup > 0">Active</span><span v-else>InActive</span></p>
                                       <div class="more-detail">
                                         <p class="username text-p"><span class="title-span">Sponsor Id:</span><span>{{usertreeview[2].level[6].sponsor_id}}</span></p>
                                         <p class="username text-p"><span class="title-span">Placement Id:</span><span>{{usertreeview[2].level[6].virtual_parent_id}}</span></p>
                                        <p class="username text-p"><span class="title-span">Package:</span><span>{{usertreeview[2].level[6].product_name}}</span></p>
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
                                             <div class="box-head nums">{{usertreeview[2].level[6].l_c_count}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[6].r_c_count}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Business</div>
                                             <div class="box-head nums">{{usertreeview[2].level[6].l_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[6].r_bv}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Carry Forward</div>
                                             <div class="box-head nums">{{usertreeview[2].level[6].left_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[6].right_bv}}</div>
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
                               <div class="col-6 col-md-6">
                                 <a href="#" class="mytooltip">
                                   <div class="img-box img-level-8">
                                    <img  :src="imgURL + '/assets/images/tree-view/' + usertreeview[2].level[7].image"  class="user-icons"/><br />
                                   <span>{{usertreeview[2].level[7].user_id}}</span>
                                   </div>
                                   <div class="tooltiptext">
                                  <div class="tooltip-body d-flex align-items-center">
                                   <div class="contentID-wraper d-flex align-items-center justify-content-center">
                                      <div class="wraper-box"><div class="img-wraper"><img :src=" imgURL +'/assets/images/tree-view/' +usertreeview[2].level[7].image"/></div><br><span class="userID-text">{{usertreeview[2].level[7].user_id}}</span></div> 
                                   </div>
                                   <div class="content-wraper d-flex">
                                      <div class="left-cols">
                                       <p class="username text-p"><span class="title-span">Username:</span>
                                        <span v-if="usertreeview[2].level[7].user_id=='Absent'">-</span>
                                        <span v-if="usertreeview[2].level[7].user_id!='Absent'">{{usertreeview[2].level[7].fullname}}</span>
                                      </p>
                                       <p class="username text-p"><span class="title-span">UserID:</span><span>{{usertreeview[2].level[7].user_id}}</span></p>
                                       <p class="username text-p"><span class="title-span">Status:</span><span  v-if="usertreeview[2].level[7].selftopup > 0">Active</span><span v-else>InActive</span></p>
                                       <div class="more-detail">
                                         <p class="username text-p"><span class="title-span">Sponsor Id:</span><span>{{usertreeview[2].level[7].sponser_id}}</span></p>
                                         <p class="username text-p"><span class="title-span">Placement Id:</span><span>{{usertreeview[2].level[7].virtual_parent_id}}</span></p>
                                        <p class="username text-p"><span class="title-span">Package:</span><span>{{usertreeview[2].level[7].product_name}}</span></p>
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
                                             <div class="box-head nums">{{usertreeview[2].level[7].l_c_count}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[7].r_c_count}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Business</div>
                                             <div class="box-head nums">{{usertreeview[2].level[7].l_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[7].r_bv}}</div>
                                          </div>
                                          <div class="tabs-body d-flex">
                                              <div class="box-head">Carry Forward</div>
                                             <div class="box-head nums">{{usertreeview[2].level[7].left_bv}}</div>
                                             <div class="box-head nums">{{usertreeview[2].level[7].right_bv}}</div>
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
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                   <div class="row">
                      <div class="col-md-12">
                        <div class="d-flex status-wraper">
                          <div class="status-cols"><img src="public/user_files/assets/images/Active.png"> <span>Active</span></div>
                         <div class="status-cols"><img src="public/user_files/assets/images/Inactive.png"> <span>Inactive</span></div>
                         <div class="status-cols"><img src="public/user_files/assets/images/Absent.png"> <span>Absent</span></div>
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
  import { apiUserHost, userAssets } from "./../../user-config/config";
  import moment from "moment";
  export default {
    components: {
      Breadcrum,
      UserDetails
    },
    data() {
      return {
        imgURL: userAssets,
        user_id: "",
        fullname:'',
        userdata: {},
        usertreeview: [],
        lengthOFlastlevelOfTree: 0,
        isAvialable: "",
        searchText: "",
        nameForBack: "",
        BackListArray: [],
        ForwordListArray: [],
        back_status: false,
        forward_status: false
      };
    },
    mounted() {
      this.getTreeViewManual();
      $("li").hover(
        function() {
          $(this).addClass("is-active");
        },
        function() {
          $(this).removeClass("is-active");
        }
      );
      //this.getPools();
    },
    methods: {
      getTreeViewManual() {
        axios
          .post("/getlevelviewtree/productbase", {
            id: this.user_id,
            reqFrom:'web'
          })
          .then(resp => {
            if (resp.data.code === 200) {
              this.userdata = resp.data.data.user;
              this.usertreeview = resp.data.data.tree_data;
              console.log(this.usertreeview);
              this.lengthOFlastlevelOfTree = this.usertreeview[
                this.usertreeview.length - 1
              ].level[
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
          .catch(err => {
            this.$toaster.error(err);
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
        $(".nav li").hover(function() {
          $(this)
            .addClass("is-active")
            .siblings()
            .removeClass("is-active");
        });
  
        $(".nav li").mouseleave(function() {
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
          this.$toaster.error("You are on root, you can not forward");
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
            user_id: this.searchText
          })
          .then(resp => {
            if (resp.data.code === 200) {
              this.isAvialable = "Available";
              this.fullname = resp.data.data.fullname;
            } else {
              this.isAvialable = "Not Available";
              this.fullname = resp.data.message;
            }
          })
          .catch(err => {
            this.$toaster.error(err);
          });
      },
      registerUser(position, current_level, current_placement) {
        //console.log("Position : " + position);
        // console.log("Virtual : " + virtual_parent_id);
        // console.log("Sponser : " + sponsor_id);
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
          let sponseruserinfo = this.usertreeview[placement_level].level[
            fetchposition
          ];
          //console.log(this.virtual_parent_id );
          //let virtual_parent_id = sponseruserinfo.user_id
          this.$root.placement_user_id = sponseruserinfo.user_id;
          /*this.$root.position  = position;
            this.$router.push({name: 'register-user'});*/
          //console.log(JSON.stringify(sponseruserinfo));
          //console.log("Virtual : " + virtual_parent_id);
        }
        if (
          this.$root.placement_user_id != undefined &&
          this.$root.placement_user_id != "Not Available"
        ) {
          this.$root.position = position;
          this.$router.push({
            name: "register-user"
          });
        }
        //console.log("Register");
      }
    }
  };
</script>

