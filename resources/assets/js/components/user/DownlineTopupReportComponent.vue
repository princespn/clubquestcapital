
<template>
   <div class="main-content">
 <UserDetails></UserDetails>
			  <div class="row profile-container fund-container common-rows">
			    
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 right-cols common-cols">
				  <div class="card">
				   <div class="card-body user-detail">
				    <h3 class="text-center">Member Activation</h3>
					 <form action="#" id="searchForm">
            <div class="row table-form">
					  <div class="col-md-6 date-range">
					    <label for="usr">Date Range:</label>
					    <div class="form-group d-flex">
						  <input type="date" name="start" id="from-date" class="form-control form-customblack from" placeholder="From">
						  <input type="date" name="start" id="to-date" class="form-control form-customblack to" placeholder="To">
						</div>
					  </div>
            <div class="col-md-3">
					    <label for="usr">User Id:</label>
					    <div class="form-group d-flex">
          	  <input type="text" placeholder="User Id" class="form-control form-customblack"  id="user-id">
						</div>
					  </div>
					  <div class="col-md-3">
					    <label for="usr">Deposit Id:</label>
					    <div class="form-group d-flex">
						  <input type="text" class="form-control form-customblack"  id="deposit-id">
						</div>
					  </div>
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
						    <table id="topup-report" class="report-table table depos-table table-striped table-sm" style="width:100%">
								<thead>
									<tr>
										<th><span class="th-wraper">Sr. No</span></th>
                   <!--<th><span class="th-wraper">User Id</span></th>-->
                    <th><span class="th-wraper">Date</span></th>
                    <th><span class="th-wraper">User Id</span></th>
										<th><span class="th-wraper">Deposit Id</span></th>
                    	<th><span class="th-wraper">Amount</span></th>
                      <th><span class="th-wraper">Plan</span></th>
										<th><span class="th-wraper">Topup From</span></th>
                 
                    
							
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
    return {};
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
        const table = $("#topup-report").DataTable({
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
            url: apiUserHost + "downline-topup-report",
            type: "POST",
            data: function (d) {
              i = 0;
              i = d.start + 1;

              let params = {
                user_id: $("#user-id").val(),
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
                return meta.row + 1;
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
                  return moment(String(row.entry_time)).format("YYYY-MM-DD");
                }
              },
            },
            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                return `<span>${row.user_id}</span>`;
              },
            },
            { "defaultContent": "",
              data: "pin" 
            },
            /*{ data: 'amount' },*/
            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                return `<span>$${row.amount}</span>  `;
              },
            },
            {
              "defaultContent": "",
              render: function (data, type, row, meta) {
                return row.package_name /* + ' ( ' + row.package_type + ' ) ' */;
              },
            },
            // { data: 'franchise_user_id' },
            /*{ data: 'name' },*/
            /* { data: 'top_up_by' },
                            { data: 'top_up_type' },
                            { data: 'payment_type' },*/
            { "defaultContent": "",
              data: "topupfrom" },
        
            /* {
                                render: function (data, type, row, meta) {
                                    if (row.entry_time === null || row.entry_time === undefined || row.entry_time === '') {
                                      return `-`;
                                    } else {
                                        return `<label class="waves-effect" id="view" data-amount="${row.amount}" data-id="${row.franchise_user_id}" data-date="${row.entry_time}"data-currency="${row.currency_code}" style="color:#7367f0">View
                                            </label>`;
                                    }
                                }
                            }*/
          ],
        });
       
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
        $("#topup-report tbody").on("click", "#view", function () {
          that.onViewClick(
            $(this).data("id"),
            $(this).data("amount"),
            $(this).data("currency"),
            $(this).data("date")
          );
        });
      }, 0);
    },
    onViewClick(id, amount, currency, date1, franchise_id) {
      this.$router.push({
        name: "certificate",
        params: {
          amount: amount,
          currency: currency,
          user_id: id,
          date1: date1,
          franchise_id: franchise_id,
        },
      });
    },
  },
};
</script>
