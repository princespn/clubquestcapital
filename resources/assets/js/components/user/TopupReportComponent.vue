<template>
 <div class="main-content">
 <UserDetails></UserDetails>
			  <div class="row profile-container fund-container common-rows">
			    
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 right-cols common-cols">
				  <div class="card">
				   <div class="card-body user-detail">
				    <h3 class="text-center">My Activations</h3>
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
					    <label for="usr">Enter Deposit Id:</label>
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
						    <table id="downline-topup-report" class="report-table table depos-table table-striped table-sm" style="width:100%">
								<thead>
									<tr>
										<th><span class="th-wraper">Sr. No</span></th>
                   <!--<th><span class="th-wraper">User Id</span></th>-->
                    <th><span class="th-wraper">Date</span></th>
										<th><span class="th-wraper">Deposit Id</span></th>
                    	<th><span class="th-wraper">Amount</span></th>
										<!--<th><span class="th-wraper">Package Name</span></th>-->
										<th><span class="th-wraper">Topup From</span></th>
                    <th><span class="th-wraper">Action</span></th>
							
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
    //  this.closetime();
    },
    methods: {
      getTopupReport() {
                let i = 0;
                let that = this;
                let token = localStorage.getItem('user-token');
                setTimeout(function(){

                    const table = $('#downline-topup-report').DataTable({
                        responsive: true,
                        lengthMenu: [[10, 50, 100], [10, 50, 100]],
                        retrieve: true,
                        destroy: true,
                        processing: false,
                        serverSide: true,
                        responsive: true,
                        stateSave: false,
                        ordering: true,
                        ajax: {
              url: apiUserHost + "topup-report",
              type: 'POST',
                            data: function (d) {
                                i = 0;
                                i = d.start + 1;

                                let params = {
                                };
                                Object.assign(d, params);
                                return d;
                            },
                            headers: {
                              'Authorization': 'Bearer ' + token
                            },
                            dataSrc: function (json) {
                                if (json.code === 200) {
                                    that.arrGetHelp = json.data.records;
                                    json['draw'] = json.data.draw;
                                    json['recordsFiltered'] = json.data.recordsFiltered;
                                    json['recordsTotal'] = json.data.recordsTotal;
                                    return json.data.records;
                                } else {
                                    json['draw'] = 0;
                                    json['recordsFiltered'] = 0;
                                    json['recordsTotal'] = 0;
                                    return json;
                                }
                            }
                        },
                        columns: [
                        {
                defaultContent: "",
                render: function (data, type, row, meta) {
                  //return meta.row + 1;
                  return i++;
                            },
                          },
                        /*  {
                         render: function (data, type, row, meta) {
                                      return `<span>${row.user_id}</span><span>(${row.fullname})</span>`;
                                  }
                              }, */
  
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
                                  return moment(String(row.entry_time)).format("YYYY-MM-DD");
                                }
                              },
                            },
                           {
                                defaultContent: "",
                                data: "pin",
                              },
                              {
                         defaultContent: "",
                        render: function (data, type, row, meta) {
                          return `<span>$${row.amount}</span>  `;
                        },
                      },
                      { defaultContent: "", data: "topupfrom" },
             
                        {
                          defaultContent: "",
                          render: function (data, type, row, meta) {
                            if (
                              row.compound_lock_status == 0
                            ) {
                              return `<button type="button" id="Updatelokingstatus" class="btn btn-linkedin btn-md waves-effect" data-pin="${row.pin}">Lock Now</button>`;
                            } else if (
                              row.compound_lock_status == 1
                            ) {
                              return '<b>Locked</b>';
                            } else{
                              return '<b>--</b>'
                            }
                          },
                        },
                      /*
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
                    return moment(String(row.entry_time)).format("YYYY-MM-DD");
                  }
                },
              },
  
             
              /*{ data: 'amount' },*/
             
              /*{
                defaultContent: "",
                render: function (data, type, row, meta) {
                  return row.product_name  + ' ( ' + row.package_type + ' ) ' ;
                },
              },*/
              // { data: 'franchise_user_id' },
              /*{ data: 'name' },*/
              /* { data: 'top_up_by' },
                              { data: 'top_up_type' },
                              { data: 'payment_type' },*/
              /*{ data: 'withdraw' },*/
             
                // { defaultContent: "", data: "compound_lock_status" },
            ],
          });
      
      $("#topup-report tbody").on("click", "#Updatelokingstatus", function () {
            that.onViewClicks($(this).data("pin"));
          
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
              $(this).data("date"),
              $(this).data("compound_lock_status")
            );
          });
        }, 0);
      },
   
      onViewClicks(pin) {  
        Swal({
          title: "Are you sure?",
          text: `You want to Locked`,
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes"
        }).then(result => {
          if (result.value) {
         axios .post("Updatelokingstatus",{
          pin: pin,
         })
          .then(response => {
            if (response.data.code == 200) {
              this.$toaster.success(response.data.message);
              $('#topup-report').DataTable().ajax.reload();
            } else {
              this.$toaster.error(response.data.message);
            }
          }).catch(err => {
               this.$toaster.error(response.data.message);
            })
          }
        });
      },
    /*  closetime() {
        axios
          .post("closestatus")
          .then((resp) => {
            if (resp.data.code == 200) {
              this.$toaster.success(response.data.message);
            }
          })
          .catch((error) => {
            this.$toaster.error(response.data.message);
          })
      },*/
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