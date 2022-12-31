<template>
 <div class="main-content">
    <UserDetails></UserDetails>      
			  <div class="row profile-container fund-container common-rows">
			    
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 right-cols common-cols">
				  <div class="card">
				   <div class="card-body user-detail">
				  <h4 class="card-title">Direct Earnings</h4>
					<form>
                    <div class="row table-form">
					  <div class="col-md-6 date-range">
					    <label for="usr">Date Range:</label>
					    <div class="form-group d-flex">
						  <input type="date" class="form-control form-customblack from"   name="start"  placeholder="From" id="from-date">
						  <input type="date" class="form-control form-customblack to" name="end"  id="to-date" placeholder="To">
						</div>
					  </div>
					  <div class="col-md-3">
					    <label for="usr">Enter User Id:</label>
					    <div class="form-group d-flex">
						  <input type="text" class="form-control form-customblack" id="user-id">
						</div>
					  </div>
					  <div class="col-md-3 serch-btncols">
					    <div class="serch-wraper">
						  <button type="button" id="onSearchClick" class="btn btn-search btn-custom">Search</button>
						</div>
					  </div>
					</div>
					<div class="row fund-table">
					  <div class="col-md-12">
					     <div class="table-wraper report-table-section">
					      <div class="table-responsive">
						    <table id="direct-income-report" class="report-table table depos-table table-striped table-sm" style="width:100%">
								<thead>
									<tr>
										<th><span class="th-wraper">Sr. No</span></th>
										<th><span class="th-wraper">Date</span></th>									
										<th><span class="th-wraper">User Id</span></th>
                    <th><span class="th-wraper">Amount</span></th>
                    <th><span class="th-wraper">Lapse</span></th>
										<th><span class="th-wraper">Remark</span></th>
                    <th><span class="th-wraper">Status</span></th>	
									</tr>
								</thead>
								<tbody>
                  
                </tbody>
								
							</table>
                </div>
					  </div>
					  </div>
					</div>
					</form>
			
				   </div>
				  </div>
				</div>
			  </div>
       </div> 
</template>

<script>
import moment from "moment";
import { apiUserHost } from "../../user-config/config";
import Breadcrum from "./BreadcrumComponent.vue";
import Swal from "sweetalert2";
import UserDetails from "./UserDetails.vue";
export default {
  components: {
    Breadcrum,
    UserDetails
},
  data() {
    return {
      INR: "",
      type: "",
      levelincome: {
        level_balance: "",
        level_income_balance: "",
        wallet_id: 1
      },
      walletlists: {
        srno: "",
        name: ""
      }
    };
  },
  computed: {
    isCompleteLevelIncome() {
      return (
        this.levelincome.level_balance &&
        this.levelincome.level_income_balance &&
        this.levelincome.wallet_id
      );
    }
  },
  mounted() {
    //  this.getLevelBalance();
    this.getLevelIncome();
    this.getWalletList();
    // this.getProjectSetting();
   // this.getPackages();
  },
  methods: {
    getWalletList() {
      axios
        .get("wallet-list", {})
        .then(response => {
          this.walletlists = response.data.data;
          //alert(this.walletlists);
        })
        .catch(error => {});
    },
    getPackages() {
      axios
        .get("get-packages", {})
        .then(response => {
          this.INR = response.data.data[0]["convert"];
          this.type = response.data.data[0]["type"];
        })
        .catch(error => {});
    },

    getLevelBalance() {
      axios
        .get("get-user-dashboard", {})
        .then(response => {
          this.levelincome.level_balance =
            response.data.data.level_income_balance;
        })
        .catch(error => {});
    },

    updateLevelIncome() {
      Swal({
        title: "Are you sure?",
        text: `You want to transfer the wallet`,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes"
      }).then(result => {
        if (result.value) {
          axios
            .post("transfer-to-wallet", {
              direct_income_balance: 0,
              roi_balance: 0,
              binary_income_balance: 0,
              leadership_income_balance: 0,
              level_income_balance: this.levelincome.level_income_balance,
              wallet_id: this.levelincome.wallet_id
            })
            .then(response => {
              if (response.data.code == 200) {
                this.$toaster.success(response.data.message);
                this.levelincome.level_income_balance = "";
                this.getLevelBalance();
                this.getWalletList();
              } else {
                this.$toaster.error(response.data.message);
              }
            });
        }
      });
    },

    getLevelIncome() {
      let i = 0;
      let that = this;
      let token = localStorage.getItem("user-token");
      setTimeout(function() {
        const table = $("#direct-income-report").DataTable({
          responsive: true,
          lengthMenu: [
            [10, 50, 100],
            [10, 50, 100]
          ],
          retrieve: true,
          destroy: true,
          processing: false,
          serverSide: true,
          responsive: true,
          stateSave: false,
          ordering: false,
          dom: 'lrtip',
          ajax: {
            url: apiUserHost + "direct-income",
            type: "POST",
            data: function(d) {
              i = 0;
              i = d.start + 1;

              let params = {
                user_id: $("#user-id").val(),
                frm_date: $("#from-date").val(),
                to_date: $("#to-date").val(),
              };
              Object.assign(d, params);
              return d;
            },
            headers: {
              Authorization: "Bearer " + token
            },
            dataSrc: function(json) {
              if (json.code === 200) {
                that.arrGetHelp = json.data.records;
                json["draw"] = json.data.draw;
                json["recordsFiltered"] = json.data.recordsFiltered;
                json["recordsTotal"] = json.data.recordsTotal;
                return json.data.records;
              } else {
                json["draw"] = 0;
                json["recordsFiltered"] = 0;
                json["recordsTotal"] = 0;
                return json;
              }
            }
          },
          columns: [
            {
              "defaultContent": "",
              render: function(data, type, row, meta) {
                return i++;
              }
            },
            {
              "defaultContent": "",
              render: function(data, type, row, meta) {
                if (
                  row.entry_time === null ||
                  row.entry_time === undefined ||
                  row.entry_time === ""
                ) {
                  return `-`;
                } else {
                  return moment(String(row.entry_time)).format("YYYY/MM/DD");
                }
              }
            },
            { "defaultContent": "",
              data: "from_user_id" },
            /*{ data: 'from_fullname' },*/
            
            /*{
              render: function(data, type, row, meta) {
                if (that.type == "INR") {
                  return `<span>₹${parseFloat(row.amount).toFixed(2) *
                    parseFloat(that.INR).toFixed(2)}</span>`;
                } else {
                  return `<span>$${row.amount}</span>`;
                }
              }
            },*/
            {
              "defaultContent": "",
              render: function(data, type, row, meta) {
                return `<span>$${row.amount}</span>`;
              }
            },
            {
              "defaultContent": "",
              render: function(data, type, row, meta) {
                return `<span>$${row.laps_amount}</span>`;
              }
            },
            { "defaultContent": "",
              data: "remark" 
            },
            /*{
              "defaultContent": "",
              render: function(data, type, row, meta) {
                return `<span>$${row.purchase_wallet_amount}</span>`;
              }
            },
            {
              "defaultContent": "",
              render: function(data, type, row, meta) {
                return `<span>$${row.working_wallet_amount}</span>`;
              }
            },
            
            /*{ data: 'amount' },*/
            {
              "defaultContent": "",
              render: function(data, type, row, meta) {
                if (row.status === "Paid") {
                  return `<span class="label label-success">Paid</span>`;
                } else {
                  return `<span class="label label-danger">Unpaid</span>`;
                }
              }
            }
          ]
        });
      }, 0);

       $("#onSearchClick").click(function () {

                var startDate = $("#from-date").val();
                var endDate = $("#to-date").val();
                if (endDate < startDate) {
                    //alert("To date should not less than from date ");
                    that.$toaster.error("To date should be greater than from date");
                    return false;
                }
          table.ajax.reload();
        });
        $("#onResetClick").click(function () {
          $("#searchForm").trigger("reset");
          table.ajax.reload();
        });
    }
  }
};
</script>