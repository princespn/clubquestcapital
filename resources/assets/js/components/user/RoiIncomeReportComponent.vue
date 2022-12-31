<template>
<div class="main-content">
<UserDetails></UserDetails>     
			  <div class="row profile-container fund-container common-rows">
			    
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 right-cols common-cols">
				  <div class="card">
				   <div class="card-body user-detail">
				  <h4 class="card-title">ROI Earnings</h4>
					  <form action="#" id="searchForm">
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
						  <input type="text" class="form-control form-customblack" id="deposit-id">
						</div>
					  </div>
					  <div class="col-md-3 serch-btncols">
					    <div class="serch-wraper">
						  <button type="button" id="onSearchClick"  class="btn btn-search btn-custom">Search</button>
						</div>
					  </div>
					</div>
					<div class="row fund-table">
					  <div class="col-md-12">
					     <div class="table-wraper report-table-section">
					      <div class="table-responsive">
						    <table  id="roi-income-report"  class="report-table table depos-table table-striped table-sm" style="width:100%">
								<thead>
									<tr>
										<th><span class="th-wraper">Sr. No</span></th>
										<th><span class="th-wraper">Date</span></th>									
										<th><span class="th-wraper">Deposit Id</span></th>
                    <th><span class="th-wraper">Package</span></th>
                    <th><span class="th-wraper">ROI Amount</span></th>										
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
    UserDetails
},
  data() {
    return {
      INR: "",
      deposit_id: null,
      from_date: null,
      to_date: null,
    };
  },
  computed: {
    isReset() {
      return this.deposit_id;
      return this.from_date;
      return this.to_date;
    },
  },
  mounted() {
    this.getRoi();
    this.getPackages();
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
      setTimeout(function () {
        const table = $("#roi-income-report").DataTable({
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
          dom: "lrtip",
          ajax: {
            url: apiUserHost + "roi-income",
            type: "POST",
            data: function (d) {
              i = 0;
              i = d.start + 1;

              let params = {
                deposit_id: $("#deposit-id").val(),
                frm_date: $("#from-date").val(),
                to_date: $("#to-date").val(),
              };
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
            { "defaultContent": "",
              data: "pin" 
              },
            /*{ data: 'name' },*/
            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                return `<span>$${row.on_amount}</span>`;
              },
            },
            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                return `<span>$${row.amount}</span>`;
              },
            },
            /*{ render: function (data, type, row, meta) {
                                   if(that.type == "INR")
                                     {
                                        return `<span>₹${row.on_amount.toFixed(2) * that.INR.toFixed(2)}</span>`;
                                    } else{
                                        return `<span>$${row.on_amount}</span>`;
                                    }
                                
                                }
                            },*/
            /*{ data: 'amount' },*/
            /*{ data: 'on_amount' },*/
            
            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                if (row.status === "Paid") {
                  return `<span class="label label-success">Paid</span>`;
                } else {
                  return `<span class="label label-danger">Unpaid</span>`;
                }
              },
            },
          ],
        });

        $("#onSearchClick").click(function () {
          var startDate = $("#from").val();
          var endDate = $("#to").val();
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
      }, 0);
    },
  },
};
</script>