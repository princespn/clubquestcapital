<template>
  <div v-if="token">
     
      <div class="wrapper"> 
             <topbar v-if="!isregister"></topbar>
               <div id="content">
                 <navlink v-if="!isregister"></navlink>
 
        <!--    <transition name="fade"> -->
        <router-view></router-view> 
               </div> 

       <!-- <div v-if="!isregister" class="footer">
    
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="www.clubquestcapital.com" target="_blank">Xento Corp</a> 2022</p>
            </div>
        </div> -->

      
    </div> 
  </div>
  <div v-else>
    <router-view></router-view>
  </div>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-active {
  opacity: 0;
}
</style>
<script>
import topbar from "./../components/user/HeaderComponent.vue";
import navlink from "./../components/user/NavigationComponent.vue";

export default {
  data() {
    return {
      token: "",
      objProSettings: {},
      isregister:""
    };
  },
  components: {
    topbar,
    navlink
  },
  mounted() {
    this.token = localStorage.getItem("user-token");
    this.getProSettings();
     var routname = this.$route.name;
    if (routname == 'register' || routname == 'thankyou' || routname == 'currencyAddress') {
      this.isregister=true;
    }
  },
  methods: {
    getProSettings() {
      axios
        .get("/getprojectsettings")
        .then(resp => {
          if (resp.data.code === 200) {
            this.objProSettings = resp.data.data;
          }
        })
        .catch(err => {});
    }
  }
};
</script>