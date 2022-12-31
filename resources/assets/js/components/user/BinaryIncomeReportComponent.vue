<template>
<div class="main-content">
  <UserDetails></UserDetails>      
			  <div class="row profile-container fund-container common-rows">
			    
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 right-cols common-cols">
				  <div class="card">
				   <div class="card-body user-detail">
				  <h4 class="card-title">Binary Earnings</h4>
					  <form action="#" id="searchForm">
            <div class="row table-form">
					  <div class="col-md-6 date-range">
					    <label for="usr">Date Range:</label>
					    <div class="form-group d-flex">
						  <input type="date" class="form-control form-customblack from" id="from" placeholder="From">
						  <input type="date" class="form-control form-customblack to" id="to" placeholder="To">
						</div>
					  </div>
					  <!--<div class="col-md-3">
					    <label for="usr">Enter Deposit Id:</label>
					    <div class="form-group d-flex">
						  <input type="text" class="form-control form-customblack" id="deoid">
						</div>
					  </div>-->
					  <div class="col-md-3 serch-btncols">
					    <div class="serch-wraper">
						  <button type="button"  id="onSearchClick" class="btn btn-search btn-custom">Search</button>
						</div>
					  </div>
					</div>
					<div class="row fund-table">
					  <div class="col-md-12">
					     <div class="table-wraper report-table-section">
					      <div class="table-responsive">
						    <table id="binary-report"  class="report-table table depos-table table-striped table-sm" style="width:100%">
								<thead>
									<tr>
										<th><span class="th-wraper">Sr. No</span></th>
										<th><span class="th-wraper">Date</span></th>									
										<th><span class="th-wraper">Amount</span></th>
                    <th><span class="th-wraper">Left Business</span></th>
                    <th><span class="th-wraper">Right Business</span></th>
										<th><span class="th-wraper">Lapse Amount</span></th>
                    <th><span class="th-wraper">Remark</span></th>
                    <th><span class="th-wraper">Income Percentage</span></th>
               							
                       
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
      from_date: null,
      to_date: null,
    };
  },
  computed: {},
  mounted() {
    this.getTopupReport();
  },
  methods: {
    getTopupReport() {
      let i = 0;
      let that = this;
      let token = localStorage.getItem("user-token");
      setTimeout(function () {
        const table = $("#binary-report").DataTable({
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
            url: apiUserHost + "binary-income",
            type: "POST",
            data: function (d) {
              i = 0;
              i = d.start + 1;

              let params = {
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
                return meta.row + 1;
              },
            },


            /*{
                  render: function (data, type, row, meta) {
                      return `<span>${row.user_id}</span><span>(${row.fullname})</span>`;
                  }
              },*/

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
                  return moment(String(row.entry_time)).format("YYYY-MM-DD");
                }
              },
            },

            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                return `<span>$${row.amount}</span>`;
              },
            },

            /*{
              render: function(data, type, row, meta) {
                return `<span>$${row.net_amount}</span>`;
              }
            },*/
            { "defaultContent": "",
              data: "left_bv" 
            },
            {"defaultContent": "",
               data: "right_bv" 
            },
            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                return `<span>$${row.laps_amount}</span>`;
              },
            },
            {"defaultContent": "",
               data: "remark" 
            },
            // { "defaultContent": "",
            //   data: "rank" 
            // },
            {"defaultContent": "",
               data: "percentage" 
            },
            /* { data: "laps_bv" },
            { data: "remark" },*/
            
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