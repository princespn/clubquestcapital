<template>
  <!-- Sidebar  -->
  <nav id="sidebar">
    <div class="sidebar-header">
      <div class="logo-wraper text-center">
        <router-link to="/dashboard" class="nav-link"><img src="public/user_files/assets/images/club-logo-lg.png" /></router-link>
      </div>
    </div>

    <ul class="list-unstyled components" id="accordion">
      <li class="nav-item">
          <router-link to="/dashboard" class="nav-link">       
          <span>
            <svg xmlns="http://www.w3.org/2000/svg"
              width="18.143"
              height="22.786"
              viewBox="0 0 37.206 37.206">
              <path id="Icon_material-dashboard"
                data-name="Icon material-dashboard"
                d="M4.5,25.17H21.036V4.5H4.5Zm0,16.536H21.036V29.3H4.5Zm20.67,0H41.706V21.036H25.17Zm0-37.206V16.9H41.706V4.5Z"
                transform="translate(-4.5 -4.5)"
                fill="#0c5adb"/>
            </svg>
          </span>
          Dashboard
       </router-link>
      </li>
      <li class="nav-item">
        <router-link to="/my-profile" class="nav-link">      
          <span>
            <svg id="Group_17" data-name="Group 17"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              width="18.143"
              height="22.786"
              viewBox="0 0 18.143 22.786">
              <defs>
                <clipPath id="clip-path">
                  <rect id="Rectangle_2982"
                    data-name="Rectangle 2982"
                    width="18.143"
                    height="22.786"
                    transform="translate(0 0)"
                    fill="#0c5adb"/>
                </clipPath>
              </defs>
              <g id="Group_6918"
                data-name="Group 6918"
                transform="translate(0 0)"
                clip-path="url(#clip-path)">
                <path id="Path_2686"
                  data-name="Path 2686"
                  d="M14.141,37.782c-.059.054-.12.107-.181.159s-.124.106-.188.157c-.131.1-.266.206-.4.3L10.51,44.272,9.94,40.891l.845-1.359c-.1.023-.206.043-.311.062a7.2,7.2,0,0,1-.814.1c-.15.01-.3.016-.455.016a7.3,7.3,0,0,1-1.7-.2l.858,1.388-.536,3.441L4.658,38.113c-.146-.116-.287-.238-.424-.365l-.057.051C-.062,41.464,0,47.878,0,48.149l0,.227H18.143l-.009-.241c-.3-7.411-3.265-9.861-3.993-10.353"
                  transform="translate(0 -25.591)"
                  fill="#0c5adb"/>
                <path id="Path_2687"
                  data-name="Path 2687"
                  d="M14.253,0a6.808,6.808,0,1,0,6.809,6.808A6.816,6.816,0,0,0,14.253,0"
                  transform="translate(-5.047 0)"
                  fill="#0c5adb"/>
              </g>
            </svg>
          </span>
          Profile
       </router-link>
      </li>
      <li class="nav-item">
        <router-link to="/add-fund-one" class="nav-link">    
          <span>
            <svg id="Group_19"
              data-name="Group 19"
              xmlns="http://www.w3.org/2000/svg"
              width="21.944"
              height="23.169"
              viewBox="0 0 21.944 23.169">
              <path id="Path_2743"
                data-name="Path 2743"
                d="M424.838,767.124c-1.313.75-2.249,1.206-2.994,1.087a5.345,5.345,0,0,0,2.946-2.813c.056-.131-.344-.316-.474-.372a.258.258,0,0,0-.338.136,4.783,4.783,0,0,1-1.993,2.4,10.9,10.9,0,0,0,1.211-4.763H411.4a9.75,9.75,0,0,0,1.941,5.809h7.909l.005-.006a4.13,4.13,0,0,0,1.183.169,5.6,5.6,0,0,0,2.787-.813c.124-.07.032-.617-.039-.741a.258.258,0,0,0-.352-.1"
                transform="translate(-406.327 -762.803)"
                fill="#0c5adb"
              />
              <path
                id="Path_2744"
                data-name="Path 2744"
                d="M410.477,782.868h-8.093a10.974,10.974,0,0,0-6.925,10.2c0,6.059,4.912,6.583,10.972,6.583s10.972-.524,10.972-6.583a10.973,10.973,0,0,0-6.926-10.2m-1.043,9.945a2.5,2.5,0,0,1-2.258,2.223l.007,1.4h-1.354v-1.292a6.234,6.234,0,0,1-2.414-.622l.511-1.583a5.458,5.458,0,0,0,1.32.476c.709.146,1.937.107,2.087-.559.146-.646-.274-.9-1.149-1.15s-2.4-.966-2.542-2.146c-.151-1.285.431-2.278,2.167-2.646v-1.355h1.355v1.188a5.907,5.907,0,0,1,1.91.441l-.327,1.455a7.282,7.282,0,0,0-2.208-.375c-.9.062-.956.972-.32,1.379a19.381,19.381,0,0,0,2.216,1.018,2.089,2.089,0,0,1,1,2.147"
                transform="translate(-395.459 -776.48)"
                fill="#0c5adb"
              />
            </svg>
          </span>
          Deposit
        </router-link>
      </li>
      <li class="nav-item">
        <a
          href="#account-active"
          data-toggle="collapse"
          aria-expanded="false"
          class="nav-link dropdown-toggle"
        >
          <span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="21.004"
              height="18.67"
              viewBox="0 0 21.004 18.67"
            >
              <path
                id="Icon_awesome-file-signature"
                data-name="Icon awesome-file-signature"
                d="M7.956,15.466a.4.4,0,0,0-.371-.238.4.4,0,0,0-.365.226l-.28.559a.583.583,0,0,1-1.075-.076L5.251,14.1,4.864,15.26a1.574,1.574,0,0,1-1.5,1.077H2.917a.583.583,0,0,1,0-1.167h.452a.409.409,0,0,0,.388-.279L4.42,12.9a.876.876,0,0,1,1.661,0l.506,1.518a1.636,1.636,0,0,1,2.407.516.414.414,0,0,0,.341.228V12.166L14,7.532v-1.7H9.043a.878.878,0,0,1-.875-.875V0H.875A.873.873,0,0,0,0,.875V17.8a.873.873,0,0,0,.875.875H13.127A.873.873,0,0,0,14,17.8V16.336l-4.668,0A1.566,1.566,0,0,1,7.956,15.466ZM14,4.445a.872.872,0,0,0-.255-.616L10.177.255A.875.875,0,0,0,9.558,0H9.335V4.668H14Zm-3.5,8.207V15.17h2.516l5.9-5.936L16.438,6.758ZM20.732,6.1,19.57,4.94a.929.929,0,0,0-1.313,0l-.994.994,2.475,2.475.994-.994A.928.928,0,0,0,20.732,6.1Z"
                fill="#0c5adb"
              ></path>
            </svg>
          </span>
          Account Activation
        </a>
        <ul
          class="collapse list-unstyled"
          id="account-active"
          data-parent="#accordion"
        >
          <li>
             <router-link to="/self-topup" class="nav-link">Topup</router-link>             
          </li>
          <li>
          <router-link to="/topup-report" class="nav-link">Topup Report</router-link>  
          </li>
          <li>
          <router-link to="/downline-topup-report" class="nav-link">Topup downline Report</router-link>  
          </li>
        </ul>
      </li>
       <li class="nav-item">
        <a
          href="#account-active2"
          data-toggle="collapse"
          aria-expanded="false"
          class="nav-link dropdown-toggle"
        >
          <span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="21.004"
              height="18.67"
              viewBox="0 0 21.004 18.67"
            >
              <path
                id="Icon_awesome-file-signature"
                data-name="Icon awesome-file-signature"
                d="M7.956,15.466a.4.4,0,0,0-.371-.238.4.4,0,0,0-.365.226l-.28.559a.583.583,0,0,1-1.075-.076L5.251,14.1,4.864,15.26a1.574,1.574,0,0,1-1.5,1.077H2.917a.583.583,0,0,1,0-1.167h.452a.409.409,0,0,0,.388-.279L4.42,12.9a.876.876,0,0,1,1.661,0l.506,1.518a1.636,1.636,0,0,1,2.407.516.414.414,0,0,0,.341.228V12.166L14,7.532v-1.7H9.043a.878.878,0,0,1-.875-.875V0H.875A.873.873,0,0,0,0,.875V17.8a.873.873,0,0,0,.875.875H13.127A.873.873,0,0,0,14,17.8V16.336l-4.668,0A1.566,1.566,0,0,1,7.956,15.466ZM14,4.445a.872.872,0,0,0-.255-.616L10.177.255A.875.875,0,0,0,9.558,0H9.335V4.668H14Zm-3.5,8.207V15.17h2.516l5.9-5.936L16.438,6.758ZM20.732,6.1,19.57,4.94a.929.929,0,0,0-1.313,0l-.994.994,2.475,2.475.994-.994A.928.928,0,0,0,20.732,6.1Z"
                fill="#0c5adb"
              ></path>
            </svg>
          </span>
         Reports
        </a>
        <ul
          class="collapse list-unstyled"
          id="account-active2"
          data-parent="#accordion"
        >
          <li>
            <router-link to="/direct-user-list" class="nav-link">Direct Member</router-link>    
          </li>
          <li>             
            <router-link to="/team-view" class="nav-link">Team View</router-link>          
          </li>
          <li>              
            <router-link to="/roi-income-report" class="nav-link">ROI Earnings Report</router-link>  
         </li>
          <li>              
            <router-link to="/direct-income-report" class="nav-link">Direct Earnings Report</router-link>  
         </li>
          <li>              
            <router-link to="/binary-income-report" class="nav-link">Binary Earnings Report</router-link>  
         </li>
        </ul>
      </li>
      <li class="nav-item collapse-items">
        <a
          href="#withdraw-summ"
          data-toggle="collapse"
          aria-expanded="false"
          class="nav-link dropdown-toggle"
        >
          <span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="17.579"
              height="21.571"
              viewBox="0 0 17.579 21.571"
            >
              <path
                id="Path_17"
                data-name="Path 17"
                d="M668.416,464.03a1.287,1.287,0,0,0-1.285,1.286v19a1.287,1.287,0,0,0,1.285,1.286H679.89v-2.525a2.021,2.021,0,0,1,2.019-2.019h2.8V465.316a1.287,1.287,0,0,0-1.286-1.286Zm12.942,11.77H670.481v-.885h10.877Zm0-3.1H670.481v-.885h10.877Zm0-3.1H670.481v-.885h10.877Z"
                transform="translate(-667.131 -464.03)"
                fill="#0c5adb"
              />
            </svg>
          </span>
          Withdraw Summery
        </a>
        <ul class="collapse list-unstyled"  id="withdraw-summ" data-parent="#accordion">
          <li>
          <router-link to="/make-working-withdrawal" class="nav-link">Place Withdrawal</router-link>  
          </li>
          <li>
          <router-link to="/withdrawals-income-report" class="nav-link">Withdrawal Report</router-link>  
          </li>
        </ul>
      </li>

      <li class="nav-item">
      <router-link to="/tree-view" class="nav-link"><span><i class="fa fa-users" aria-hidden="true" style="width: auto"></i></span> Team</router-link>        
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <span>
            <svg
              id="Icon_ionic-ios-filing"
              data-name="Icon ionic-ios-filing"
              xmlns="http://www.w3.org/2000/svg"
              width="17.579"
              height="16.227"
              viewBox="0 0 17.579 16.227"
            >
              <path
                id="Path_7"
                data-name="Path 7"
                d="M19.263,4.5H5.065a1.7,1.7,0,0,0-1.69,1.69V19.036a1.7,1.7,0,0,0,1.69,1.69h14.2a1.7,1.7,0,0,0,1.69-1.69V6.19A1.7,1.7,0,0,0,19.263,4.5Zm.507,7.437a.678.678,0,0,1-.676.676H15.427a.675.675,0,0,0-.638.448,1.267,1.267,0,0,1-1.1.9H10.643a1.258,1.258,0,0,1-1.1-.9.671.671,0,0,0-.638-.448H5.234a.678.678,0,0,1-.676-.676V6.359a.678.678,0,0,1,.676-.676h13.86a.678.678,0,0,1,.676.676Z"
                transform="translate(-3.375 -4.5)"
                fill="#0c5adb"
              />
              <path
                id="Path_8"
                data-name="Path 8"
                d="M19.453,10.183H8.467a.593.593,0,0,1-.592-.592h0A.593.593,0,0,1,8.467,9H19.453a.593.593,0,0,1,.592.592h0A.593.593,0,0,1,19.453,10.183Z"
                transform="translate(-5.171 -6.296)"
                fill="#0c5adb"
              />
              <path
                id="Path_9"
                data-name="Path 9"
                d="M19.453,14.683H8.467a.593.593,0,0,1-.592-.592h0a.593.593,0,0,1,.592-.592H19.453a.593.593,0,0,1,.592.592h0A.593.593,0,0,1,19.453,14.683Z"
                transform="translate(-5.171 -8.091)"
                fill="#0c5adb"
              />
            </svg>
          </span>
          Transfer Funds
        </a>
      </li>
      
    </ul>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      userdetails: {
        user_id: "",
        ip_address: "",
        current_time: "",
      },
      server_time: "",
      icon: "../public/user_files/assets/img/small-icon.png",
      logo: "../public/user_files/assets/img/loginLogo.png",
      referrallink: "",
      ip_addr: "",
    };
  },
  mounted() {
    //this.getUserLoginDetails();
    //this.getReferralLink();
    //this.getIpAddress();
  },
  methods: {
    getUserLoginDetails() {
      axios
        .get("get-user-dashboard", {})
        .then((response) => {
          //console.log(response);
          this.userdetails = response.data.data;
          // alert(this.userdetails.fullname);
          this.server_time = response.data.data.server_time.date;
        })
        .catch((error) => {});
    },
    logout() {
      localStorage.removeItem("user-token");
      localStorage.removeItem("INR");
      localStorage.removeItem("p_type");
      localStorage.removeItem("type");
      // if the request fails, remove any
      //location.reload();
      this.$router.push({ name: "login" });
    },
    getReferralLink() {
      axios
        .get("/get-reference-id")
        .then((resp) => {
          if (resp.data.code === 200) {
            this.referrallink = resp.data.data;
          }
        })
        .catch({});
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
  },
};
</script>