<template>
    <div class="main-content">
         <UserDetails></UserDetails>
			  <div class="row profile-container fund-container common-rows">
			    
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 right-cols common-cols">
				  <div class="card">
				   <div class="card-body user-detail">
				   
				    <ul class="nav nav-pills">
					<li class="active">
                     <router-link to="/add-fund-one">Add Fund</router-link></li>
                     <li><router-link to="/pending-add-deposite">Pending Funds transactions</router-link></li>
                     <li><router-link to="/confirm-deposite"  class="active">Payment Info</router-link></li>
					</ul>
                    <form action="#" id="searchForm">
                    <div class="row table-form">
					  <div class="col-md-6 date-range">
					    <label for="usr">Date Range:</label>
					    <div class="form-group d-flex">
                        <input type="date" name="start" placeholder="From" id="from-date" class="form-control form-customblack from">
                      <input type="date" name="end" placeholder="To" id="to-date" class="form-control form-customblack to">
                         
						</div>
					  </div>
					  <div class="col-md-3">
					    <label for="usr">Enter Deposit Id:</label>
					    <div class="form-group d-flex">
                       <input placeholder="Enter Deposit Id" id="deposit-id" type="text" class="form-control form-customblack">
                         
						</div>
					  </div>
					  <div class="col-md-3 serch-btncols">
					    <div class="serch-wraper">
						  <button type="button" id="onSearchClick" class="btn btn-search btn-custom">Search</button>
						</div>
					  </div>
					</div>
                    </form>
					<div class="row fund-table payment-table">
					  <div class="col-md-12">
					     <div class="table-wraper report-table-section">
					      <div class="table-responsive">
						    <table  id="confirm-deposite" class="report-table table depos-table table-striped table-sm" style="width:100%">
								<thead>
									<tr>
										<th><span class="th-wraper">Sr. No</span></th>
										<th><span class="th-wraper">Date</span></th>
                                        <th><span class="th-wraper">Deposit Id</span></th>
										<th><span class="th-wraper">Amount</span></th>
										<th><span class="th-wraper">Package Mode</span></th>
									    <th><span class="th-wraper">Address</span></th>
									
                                    </tr>
								</thead>
                                <tbody>
                                    
                                </tbody>
								<!--<tfoot>
									<tr>
										<th colspan="2"></th>
										<th class="total"><span>Total</span></th>
										<th class="total-value"><span>$0</span></th>
										<th colspan="1"></th>
									</tr>
								</tfoot>-->
							</table>
                           </div>
					  </div>
					  </div>
					</div>					
				   </div>
				  </div>
				</div>
			  </div>
            </div>  
</template>

<script>
    import moment from 'moment';
    import { apiUserHost } from'../../user-config/config';
    import Breadcrum from './BreadcrumComponent.vue';
import UserDetails from './UserDetails.vue';
    export default {  
        components: {
    Breadcrum,
    UserDetails
}, 
        data(){
            return{
                //total_amount:0,
                INR:'',
                type:'',
            }
        },
        mounted(){
            this.getConfirmedDeposite();
            //this.getProjectSetting();
            //this.getPackages();
            $(function() {
                var start = moment('2015-01-01');
                var end = moment();
                function cb(start, end) {
                    if(start.format('DD/MM/YYYY') == '01/01/2015') {
                        $('.range-text').html('All');
                        $('.from, .to').val('');
                        $('#daterangefocus').focus(); 
                    }else {
                        $('#reportrange span').html(start.format('D-MM-YYYY') + ' - ' + end.format('D-MM-YYYY'));
                        $('.from').val(start.format('D-MM-YYYY'));
                        $('.to').val(end.format('D-MM-YYYY'));
                        $('#daterangefocus').focus(); 
                    }
                }
                $('#reportrange').daterangepicker({
                    opens: 'left',
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'All': [moment('2015-01-01'), moment()],
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                }, cb);
                cb(start, end);
            });
        },
        methods:{
            reloadTable(){
                 // alert();
                $('#confirm-deposite').DataTable().ajax.reload();
                 $('#daterangefocus').blur(); 
                 
            },
            getConfirmedDeposite(){
                let i = 0;
                let that = this;
                let token = localStorage.getItem('user-token');
                setTimeout(function(){

                     that.table = $('#confirm-deposite').DataTable({
                        responsive: true,
                        lengthMenu: [[10, 50, 100], [10, 50, 100]],
                        retrieve: true,
                        destroy: true,
                        processing: false,
                        serverSide: true,
                        responsive: true,
                        stateSave: false,
                        ordering: false,
                        dom: 'lrtip',

                        // buttons: [
                        //     // 'copyHtml5',
                        //     'excelHtml5',
                        //    // 'csvHtml5',
                        //    // 'pdfHtml5',
                        //  //   'pageLength',
                        // ],
                        ajax: {
                            url: apiUserHost+'confirm-add-deposit',
                            type: 'POST',
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
                              'Authorization': 'Bearer ' + token
                            },
                            dataSrc: function (json) {
                                if (json.code === 200) {

                                    let total_amount = 0;
                                    if(json.data.records.length != 0){
                                        for (let j = 0; j < json.data.records.length; j++) {
                                            total_amount = total_amount + parseInt(json.data.records[j].price_in_usd);          
                                            $('#total_amount').text("$"+total_amount);
                                        }
                                    }else{
                                        $('#total_amount').text("$0");
                                    }

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
                                "defaultContent": "", 
                                render: function (data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            },
                            {
                                "defaultContent": "", 
                                render: function (data, type, row, meta) {
                                    if (row.entry_time === null || row.entry_time === undefined || row.entry_time === '') {
                                      return `-`;
                                    } else {
                                        return moment(String(row.entry_time)).format('YYYY/MM/DD');
                                    }
                                }
                            },
                            { data: 'invoice_id' },

                            /* { render: function (data, type, row, meta) {
                                   if(that.type == "INR")
                                     {
                                        return `<span>${row.rupee_plan_name}</span>`;
                                    } else{
                                        return `<span>${row.plan_name}</span>`;
                                    }
                                
                                } 
                            },*/
                            /*{ data: 'plan_name' },   */          
                            /*{ data: 'price_in_usd' },*/
                              { 
                                "defaultContent": "", 
                                render: function (data, type, row, meta) {
                                //if(that.type == "INR")
                                    // {
                                 //            return `<span>${ parseFloat(row.price_in_usd).toFixed(2) * parseFloat(that.INR).toFixed(2)}</span>`;
                                  //  } else{
                                        return `<span>$${row.price_in_usd}</span>`;
                                    //}
                                
                                } 
                            },
                            { data: 'payment_mode' },
                            /*{ data: 'address' },*/
                            {
                                "defaultContent": "", 
                                render: function (data, type, row, meta) {
                                    return "<span style='word-break: break-word;'>"+row.address+"</span>";
                                }
                            },
                            /*{
                                render: function (data, type, row, meta) {
                                    return "<a href='"+row.status_url+"'>Checkout</a>";
                                }
                            },*/
                        ]
                    });

                  $("#onSearchClick").click(function() {


                    var startDate = $("#from-date").val();
          var endDate = $("#to-date").val();
          if (endDate < startDate) {
            //alert("To date should not less than from date ");
            that.$toaster.error("To date should be greater than from date");
            return false;
          }
                      that.table.ajax.reload();
                    });
                    $("#onResetClick").click(function() {
                      $("#searchForm").trigger("reset");
                      that.table.ajax.reload();
                    });
                },0);
            },  
             getProjectSetting(){
                axios.get('getprojectsettings', {
            })
            .then(response => {
                this.INR = response.data.data['USD-to-INR'];
            })
            .catch(error => {
                }); 
            },      
       getPackages(){
            axios.get('get-packages', {
            })
            .then(response => {
               this.INR = response.data.data[0]['convert'];
                this.type = response.data.data[0]['type'];
                
            })
            .catch(error => {
            });        
         },   
        }
    }
</script>