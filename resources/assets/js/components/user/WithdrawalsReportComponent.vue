<template>
 <div class="main-content">
        <UserDetails></UserDetails>        
			  <div class="row profile-container fund-container common-rows">
			    
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 right-cols common-cols">
				  <div class="card">
				   <div class="card-body user-detail">
				  <h4 class="card-title">Withdrawal Report</h4>
					<form method="#">
                    <div class="row table-form">
					  <div class="col-md-6 date-range">
					    <label for="usr">Date Range:</label>
					    <div class="form-group d-flex">
						  <input type="date" class="form-control form-customblack from" id="from" placeholder="From">
						  <input type="date" class="form-control form-customblack to" id="to" placeholder="To">
						</div>
					  </div>
					  <div class="col-md-3">
					    <label for="usr">Enter Deposit Id:</label>
					    <div class="form-group d-flex">
						  <input type="text" class="form-control form-customblack" id="deoid">
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
						    <table id="withdrawals-income-report"  class="report-table table depos-table table-striped table-sm" style="width:100%">
								<thead>
									<tr>
										<th><span class="th-wraper">Sr. No</span></th>
										<th><span class="th-wraper">Date</span></th>									
										<th><span class="th-wraper">Amount</span></th>
                    <th><span class="th-wraper">Net Amount</span></th>
                    <th><span class="th-wraper">Deduction</span></th>
										<th><span class="th-wraper">Address</span></th>
                    <th><span class="th-wraper">Currency Type</span></th>
                    <th><span class="th-wraper">Withdrawal Type</span></th>
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
import UserDetails from "./UserDetails.vue";
export default {
  components: {
    Breadcrum,
    UserDetails,
  },
  data() {
    return {
      INR: "",
    };
  },
  mounted() {
    this.getRoi();
    //this.getProjectSetting();
    //  this.getPackages();
  },
  methods: {
    getPackages() {
      axios
        .get("get-packages", {})
        .then((response) => {
          this.INR = response.data.data[0]["convert"];
          this.type = response.data.data[0]["type"];
        })
        .catch((error) => {});
    },
    getRoi() {
      let i = 0;
      let that = this;
      let token = localStorage.getItem("user-token");
      //var lang = "Chinese";
      setTimeout(function () {
        const table = $("#withdrawals-income-report").DataTable({
          responsive: true,
          lengthMenu: [
            [10, 50, 100],
            [10, 50, 100],
          ],
          retrieve: true,
          destroy: true,
          processing: false,
          serverSide: true,
          responsive: true,
          stateSave: false,
          ordering: false,
          /* "language": {
                            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/"+ lang +".json"
                        },*/
          ajax: {
            url: apiUserHost + "withdrwal-income",
            type: "POST",
            data: function (d) {
              i = 0;
              i = d.start + 1;

              let params = {};
              Object.assign(d, params);
              return d;
            },
            headers: {
              Authorization: "Bearer " + token,
            },
            dataSrc: function (json) {
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
            },
          },
          columns: [
            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                return i++;
              },
            },
             {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                if (
                  row.entry_time === null ||
                  row.entry_time === undefined ||
                  row.entry_time === ""
                ) {
                  return `-`;
                } else {
                  return moment(String(row.entry_time)).format("YYYY/MM/DD");
                }
              },
            },

            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                return `<span>$${row.amount + row.deduction}</span>`;
              },
            },
            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                return `<span>$${row.deduction}</span>`;
              },
            },
            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                return `<span>$${row.amount}</span>`;
              },
            },
            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                return `<a href="https://www.blockchain.com/btc/address/${row.to_address}">${row.to_address}</a>`;
              },
            },

            
            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                return `<span>${row.network_type}</span>`;
              },
            },
            /*{
              "defaultContent": "",
              render: function (data, type, row, meta) {
                if (row.network_type == "BTC") {
                  return `Bitcoin(BTC)`;
                } else if (row.network_type == "TRX") {
                  return `TRON`;
                } else if (row.network_type === "ETH") {
                  return `Ethereum(ETH)`;
                } else if (row.network_type === "USDT.TRC20") {
                  return `Tether USD(USDT.TRC20)`;
                } else if (row.network_type === "BSC") {
                  return `BNB Coin(BSC)`;
                } else if (row.network_type === "BCH") {
                  return `BCH`;
                } else if (row.network_type === "LTC") {
                  return `Litecoin(LTC)`;
                } else if (row.network_type === "DOGE") {
                  return `Dogecoin(DOGE)`;
                } else if (row.network_type === "PM") {
                  return `Perfect Money(PM)`;
                } else if (row.network_type === "SHIB") {
                  return `SHIBA(SHIB)`;
                } else {
                  return ``;
                }
              },
            },*/
            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                if (row.withdraw_type == 2) {
                  return `Working`;
                } else if (row.withdraw_type == 3) {
                  return `ROI`;
                } else if (row.withdraw_type === 6) {
                  return `Transfer`;
                } else {
                  return ``;
                }
              },
            },
            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                if (row.status == 0) {
                  return `<span class="label text-warning">Pending</span>`;
                } else if (row.status == 1) {
                  return `<span class="label text-success">Confirmed</span>`;
                } else if (row.status == 2) {
                  return `<span class="label text-danger">Rejected</span>`;
                } else {
                  return ``;
                }
              },
            },
            /*{ data: 'on_amount' },*/
           
            /*{ "defaultContent": "",
              data: "remark" },*/
          ],
        });

        
      }, 0);

       $("#onSearchClick").click(function() {

                var startDate = $("#from").val();
                var endDate = $("#to").val();
                if (endDate < startDate) {
                    //alert("To date should not less than from date ");
                    that.$toaster.error("To date should be greater than from date");
                    return false;
                }
                that.table.ajax.reload();
                });
                
    },
  },
};
</script>