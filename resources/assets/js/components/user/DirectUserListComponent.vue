<template>
 <div class="main-content">   
    <UserDetails></UserDetails>          
			  <div class="row profile-container fund-container common-rows">			    
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 right-cols common-cols">
				  <div class="card">
				   <div class="card-body user-detail">
				 
					<form>
           <div class="row table-form">
					  <div class="col-md-5 date-range">
					    <label for="usr">Date Range:</label>
					    <div class="form-group d-flex">
						  <input type="date" class="form-control form-customblack from" name="start" id="from-date" placeholder="From">
						  <input type="date" class="form-control form-customblack to" name="start"  placeholder="To" id="to-date">
						</div>
					  </div>
					  <div class="col-md-3">
					    <label for="usr">User Id:</label>
					    <div class="form-group d-flex">
						  <input type="text" class="form-control form-customblack" placeholder="User Id" id="user-id">
						</div>
					  </div> 
           <div class="col-md-3">

            <label for="usr">Select Status:</label>
                  <div class="form-group d-flex">
                    <select id="status" class="form-control form-customblack">
                      <option value>All</option>
                      <option value="1">Active</option>
                      <option value="2">Inactive</option>
            </select>
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
						    <table id="direct-user-list" class="report-table table depos-table table-striped table-sm" style="width:100%">
								<thead>
									<tr>
									  <th><span class="th-wraper">Sr. No</span></th>
                     <th><span class="th-wraper">Date</span></th>
                    <th><span class="th-wraper">User Id</span></th>                 
                   <th><span class="th-wraper">Phone</span></th>
                   <th><span class="th-wraper">Email</span></th>
                   <!--<th><span class="th-wraper">Investment</span></th>-->
                   <th><span class="th-wraper">Position</span></th>
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
import UserDetails from "./UserDetails.vue";
import moment from "moment";
import { apiUserHost } from "../../user-config/config";
import Breadcrum from "./BreadcrumComponent.vue";
export default {
  components: {
    Breadcrum,
    UserDetails,
  },
  data() {
    return {
      getlevels: {
        level_id: "",
        level_name: "",
      },
      INR: "",
      type: "",
    };
  },
  mounted() {
    this.getLevelView();
    /*this.getLevels();
    this.getPackages();*/
  },
  methods: {
    getLevelView() {
      let i = 0;
      let that = this;
      let token = localStorage.getItem("user-token");
      setTimeout(function () {
        that.table = $("#direct-user-list").DataTable({
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
            url: apiUserHost + "direct_list",
            type: "POST",
            data: function (d) {
              i = 0;
              i = d.start + 1;

              let params = {
                user_id: $("#user-id").val(),
                frm_date: $("#from-date").val(),
                to_date: $("#to-date").val(),
                status: $("#status").val(),
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
              defaultContent: "",
              render: function (data, type, row, meta) {
                return i++;
              },
            },
            {
              defaultContent: "",
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
            { data: "user_id", defaultContent: "" },
           /* { data: "fullname" },*/
            { data: "mobile", defaultContent: "" },
            { data: "email", defaultContent: "" },

          /** {
              render: function(data, type, row, meta) {
                that.type == "USD";
                if (that.type == "INR") {
                  return `<span>${row.total_investment * that.INR}</span>`;
                } else {
                  return `<span>${row.total_investment}</span>`;
                }
              }
            },
              {
              defaultContent: "",
              render: function (data, type, row, meta) {
                return `<span>$${row.topup_amount}</span>`;
              },
            },*/
            { data: "position", defaultContent: "" },

           /*  {
                              render: function (data, type, row, meta) {
                                if (row.total_investment > 0) {
                                  return `<span class="label label-primary">Paid</span>`;
                                } else {
                                  return `<span class="label label-danger">Unpaid</span>`;
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
          that.table.ajax.reload();
        });
        $("#onResetClick").click(function () {
          $("#searchForm").trigger("reset");
          that.table.ajax.reload();
        });
      }, 0);
    },

    getLevels() {
      axios
        .get("get-level", {})
        .then((response) => {
          this.getlevels = response.data.data;
          //alert(this.getlevels);
        })
        .catch((error) => {});
    },
    getPackages() {
      axios
        .get("get-packages", {})
        .then((response) => {
          this.INR = response.data.data[0]["convert"];
          this.type = response.data.data[0]["type"];
        })
        .catch((error) => {});
    },
  },
};
</script>