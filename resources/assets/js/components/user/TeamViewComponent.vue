<template>
  <div class="main-content">
    <UserDetails></UserDetails>   
    <div class="row profile-container fund-container common-rows">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 right-cols common-cols">
        <div class="card">
          <div class="card-body user-detail">       
            <form id="searchForm">
              <div class="row table-form">
                <div class="col-md-6 date-range">
                  <label for="usr">Date Range:</label>
                  <div class="form-group d-flex">
                    <input  type="date" class="form-control form-customblack from" name="start"  placeholder="From" id="from-date"/>
                    <input type="date"  class="form-control form-customblack to" name="end" placeholder="To" id="to-date"/>
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="usr">User Id:</label>
                  <div class="form-group d-flex">
                    <input placeholder="User Id" id="user-id"  type="text"  class="form-control form-customblack"/>
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="usr">Select Team:</label>
                  <div class="form-group d-flex">
                    <select id="position" class="form-control">
                      <option value>All</option>
                      <option value="1">Left Team</option>
                      <option value="2">Right Team</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="usr">Select Status:</label>
                  <div class="form-group d-flex">
                    <select id="status" class="form-control">
                      <option value>All</option>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3 serch-btncols">
                  <div class="serch-wraper">
                    <button type="button"  id="search-box" class="btn btn-search btn-custom"> Search Now</button>
                  </div>
                </div>
               </div>
              <div class="row fund-table">
                <div class="col-md-12">
                  <div class="table-wraper report-table-section">
                    <div class="table-responsive">
                       <table id="report-table"  class="report-table table depos-table table-striped table-sm" style="width:100%">
								
                        <thead>
                          <tr>
                            <th><span class="th-wraper">Sr. No</span></th>
                            <th>
                              <span class="th-wraper">Registration Date</span>
                            </th>
                            <th><span class="th-wraper">User Id</span></th>
                            <th><span class="th-wraper">Name</span></th>
                            <th><span class="th-wraper">Sponsor Id</span></th>
                            <th><span class="th-wraper">Placement Id</span></th>
                            <th><span class="th-wraper">Position</span></th>
                            <th><span class="th-wraper">Left BV</span></th>
                            <th><span class="th-wraper">Right BV</span></th>
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
import DatePicker from "vuejs-datepicker";
import { apiUserHost } from "../../user-config/config";
import Breadcrum from "./BreadcrumComponent.vue";
import UserDetails from "./UserDetails.vue";
export default {
  components: {
    Breadcrum,
    DatePicker,
    UserDetails,
  },
  data() {
    return {
      position: "",
      status: "",
      user_id: null,
      from_date: null,
      to_date: null,
      team: {},
    };
  },
  computed: {
    isReset() {
      return this.user_id;
      return this.from_date;
      return this.to_date;
      return this.position;
      return this.status;
    },
  },
  mounted() {
    this.getTeam();
  },
  methods: {
    customFormatter(date) {
      return moment(date).format("DD-MM-Y");
    },
    getTeam() {
      let i = 0;
      let that = this;
      let token = localStorage.getItem("user-token");
      setTimeout(function () {
        const table = $("#report-table").DataTable({
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
          ajax: {
            url: apiUserHost + "team-view",
            type: "POST",
            data: function (d) {
              i = 0;
              i = d.start + 1;

              let params = {
                user_id: $("#user-id").val(),
                frm_date: $("#from-date").val(),
                to_date: $("#to-date").val(),
                position: $("#position").val(),
                status: $("#status").val(),
                // type: $("#type").val()
                // level_id : $('#level-id').val(),
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
                that.team = json.data.records;
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
                  row.joining_date === null ||
                  row.joining_date === undefined ||
                  row.joining_date === ""
                ) {
                  return `-`;
                } else {
                  return moment(String(row.joining_date)).format("YYYY/MM/DD");
                }
              },
            },
            {
              defaultContent: "",
              data: "user_id",
            },
            { defaultContent: "", data: "fullname" },
            { defaultContent: "", data: "sponser_id" },
            { defaultContent: "", data: "upline_id" },
            { defaultContent: "", data: "position" },
            /*{
                                    render: function (data, type, row, meta) {
                                        if (row.type === 'Red') {
                                          return `<span style="color:Red">${row.type}</span>`;
                                        } else {
                                             return `<span style="color:Green">${row.type}</span>`;
                                        }
                                    }
                                },*/
            { defaultContent: "", data: "left_bv" },
            { defaultContent: "", data: "right_bv" },
            {
              defaultContent: "",
              render: function (data, type, row, meta) {
                if (row.status === "Inactive") {
                  return `<span class="btn btn-danger">${row.status}</span>`;
                } else {
                  return `<span class="btn btn-success">${row.status}</span>`;
                }
              },
            },
          ],
        });
        $("#search-box").click(function () {
          var startDate = $("#from-date").val();
          var endDate = $("#to-date").val();
          if (endDate < startDate) {
            //alert("To date should not less than from date ");
            that.$toaster.error("To date should be greater than from date");
            return false;
          }
          table.ajax.reload();
        });

        $("#reset").click(function () {
          $("#user-id").val("");
          $("#from-date").val("");
          $("#to-date").val("");
          $("#position").val("");
          $("#status").val("");
          $("#search-form").trigger("reset");
          i = 0;
          table.ajax.reload();
        });
        // $('#reset').click(function () {
        //     $('#user-id').val('');
        //     $('#from-date').val('');
        //     $('#to-date').val('');
        //     $('#position').val('');
        //     $('#search-form').trigger("reset");
        //     i = 0;
        //      table.ajax.reload();

        // });
      }, 0);
    },
  },
};
</script>