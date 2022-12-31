import Vue from "vue";
import axios from "axios";

export default function setup() {
  axios.interceptors.request.use(
    function(config) {
      const token = localStorage.getItem("access_token");
     // const adminauth = localStorage.getItem("admin_auth");
      if (token != null) {
        config.headers.Authorization = "Bearer " + token;
      }else{
        //location.reload();
      }
      return config;
    },
    function(err) {
      return Promise.reject(err);
    }
  );
  axios.interceptors.response.use(
    function(config) {
      return config;
    },
    function(err) {
      if (err.response.status == 401 || err.response.status == 403) {
        return;
      }
    }
  );
}
