<template>  
      <div class="row align-items-center panel-row common-rows">
			    <div class="col-12 col-sm-12 col-md-12 col-lg-4 common-cols">
				  <h2 class="lg-heading">{{ title }}</h2>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-8 common-cols">
				  <div class="id-wraper d-flex">
				    <div class="id-box">
					  <p class="title-id">IP Address</p>
					  <p class="nums-id">{{ip_addr}}</p>
					</div>
					<div class="id-box">
					  <p class="title-id">Server Time</p>
					  <p class="nums-id">{{userdata.server_time}}</p>
					</div>
					<div class="id-box">
					  <p class="title-id">User ID</p>
					  <p class="nums-id">{{userdata.user_id}}</p>
					</div>
				  </div>
				</div>
			  </div>
     
</template>
<script>
//import moment from "moment";
//import { apiUserHost } from "../../user-config/config";
import Breadcrum from "./BreadcrumComponent.vue";
export default {
  components: {
    Breadcrum
  },
  data() {
    return {
      title:'',
       userdata: {
               user_id: 0,
                server_time: 0,
               
            },
            //server_time:0,
            ip_addr : 0,
    };
  },
  mounted() {
    this.getUserLoginDetails();
    this.getIpAddress();
    this.updateList() 
  },
  watch: { '$route' () { 
      this.updateList()
      } 
  },
  methods: {
        updateList () { 
      this.breadcrumbList = this.$route.meta.breadcrumb,
        this.title = this.$route.meta.title

      },
	 getUserLoginDetails() {
      axios
        .get("get-user-dashboard")
        .then((response) => {
          //console.log(response);
          this.userdata = response.data.data;
          // alert(this.userdetails.fullname);
         // this.server_time = response.data.data.server_time.date;
        })
        .catch((error) => {});
    },
	getIpAddress() {
      axios
        .post("/get-ip-addr")
        .then((resp) => {
          if (resp.data.code === 200) {
            this.ip_addr = resp.data.data;
          } else {
            this.ip_addr = "-";
          }
        })
        .catch({});
    },
  
  }
};
</script>