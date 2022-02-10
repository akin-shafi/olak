<?php 
  require_once('../private/initialize.php');

$page = 'Dashboard';
$page_title = 'User Dashboard';
include(SHARED_PATH . '/admin_header.php'); 

?>
<div class="content-wrapper">
            <!-- Main content -->
            <section class="content ">
               <div class="container">
                  <div class="col-md-10 m-auto">
                     <div class="row mb-20 mt-20">
                        <div class="col-md-12">
                           <div class="alert alert-warning text-center">
                              <div class="lh-34 ">
                                 <p class="fs-14 mb-0"><strong><i class="icon-info"></i> Finish Setup!</strong> You haven't finished your setup yet. We recommend you to finish your setup before send your invoice.</p>
                              </div>
                              <a href="http://accufy.originlabsoft.com/admin/business" class="btn btn-default">Finish Setup Now</a>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                     </div>
                     <form id="invoice_form" method="post" enctype="multipart/form-data" class="validate-form leave_con" action="http://accufy.originlabsoft.com/admin/invoice/preview" role="form" novalidate>
                        <div class="row mb-10">
                           <div class="col-md-4 col-xs-12">
                              <h2 class="pull-left">Create New Invoice</h2>
                           </div>
                           <div class="col-md-8 col-xs-12">
                              <div class="inv-top-btn mb-10">
                                 <button type="submit" class="btn btn-info btn-rounded save_invoice_btn pull-right ml-5">Save and continue</button>
                                 <button id="edit_invoice" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info pull-right mr-10 edit_invoice_btn" style="display: none;">Edit</button>
                                 <button type="submit" class="btn waves-effect waves-light btn-outline-info btn-rounded pull-right mr-10 preview_invoice_btn">Preview</button>
                              </div>
                              <input type="hidden" class="set_value" name="check_value">
                           </div>
                        </div>
                        <input type="hidden" class="add_val" name="add_val" value="">
                        <div class="alert alert-danger mb-20 error_area" style="display: none;">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <h4>Oops! There was an issue with your invoice. Please try again.</h4>
                           <div id="load_error"></div>
                        </div>
                        <!-- load preview data -->
                        <div id="load_data"> </div>
                        <div class="invoice_area mt-20">
                           <!-- invoice header -->
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="panel panel-default inv exh">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                       <div class="panel-heading inv" role="tab" id="heading8">
                                          <h4 class="panel-title inv">
                                             <span class="style_border">Business address and contact details, title, summary, and logo</span>
                                             <i class="fa fa-angle-down pull-right"></i>
                                          </h4>
                                       </div>
                                    </a>
                                    <div id="collapse8" class="panel-collapse data_collaps_border collapse" role="tabpanel" aria-labelledby="heading8" aria-expanded="false" style="height: 1px;">
                                       <div class="panel-body inv">
                                          <div class="row">
                                             <div class="col-md-6">
                                                <span class="alterlogo"><i class="flaticon-close"></i></span>
                                             </div>
                                             <div class="col-md-6">
                                                <input type="text" class="form-control text-right" name="title" placeholder="Invoice title" value="">
                                                <input type="text" id="example-input-large" name="summary" class="form-control form-control-md text-right" placeholder="Summary example: project name, description of invoice" value="">
                                                <p class="mb-0 pull-right"><strong>sandsify</strong></p>
                                                <br>
                                                <p class="pull-right">Nigeria</p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- invoice body -->
                           <div class="box shadow-lg">
                              <div class="box-body inv">
                                 <div class="container">
                                    <div class="row mb-20">
                                       <div class="col-xs-12 col-md-12">
                                          <div class="row inv-info">
                                             <div class="col-xs-6 col-md-4 text-left">
                                                <h5>Bill to</h5>
                                                <div id="load_customers">
                                                   <select class="form-control single_select" name="customer" id="customer">
                                                      <option value="">Select Customer</option>
                                                   </select>
                                                </div>
                                                <a data-toggle="modal" href="#customerModal" title="Add a row" class="add-new-item btn btn-block btn-default btn-sm p-10"><i class="icon-plus"></i> Add a customer</a>
                                                <div class="mt-20" id="load_info"></div>
                                             </div>
                                             <div class="col-xs-6 col-md-8 text-right">
                                                <div class="form-group row">
                                                   <label for="inputEmail3" class="col-sm-8 text-right control-label col-form-label">Invoice number</label>
                                                   <div class="col-sm-4">
                                                      <input type="text" class="form-control" name="number" value="2021-1" placeholder="Invoice number">
                                                   </div>
                                                </div>
                                                <div class="form-group row">
                                                   <label for="inputEmail3" class="col-sm-8 text-right control-label col-form-label">P.O./S.O. number</label>
                                                   <div class="col-sm-4">
                                                      <input type="text" value="" class="form-control" name="poso_number">
                                                   </div>
                                                </div>
                                                <div class="form-group row">
                                                   <label for="inputEmail3" class="col-sm-8 text-right control-label col-form-label">Invoice date</label>
                                                   <div class="col-sm-4">
                                                      <div class="input-group">
                                                         <input type="text" class="form-control datepicker" placeholder="yyyy/mm/dd" name="date" value="2021-12-17">
                                                         <div class="input-group-append">
                                                            <span class="input-group-text">
                                                            <i class="fa fa-calender"></i>
                                                            </span>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="form-group row mt-10">
                                                   <label for="inputEmail3" class="col-sm-8 text-right control-label col-form-label">Payment due date</label>
                                                   <div class="col-sm-4">
                                                      <div class="input-group">
                                                         <input type="text" id="payment_due" class="form-control datepicker payment_due" name="payment_due" value="2021-12-17">
                                                         <div class="input-group-append">
                                                            <span class="input-group-text">
                                                            <i class="fa fa-calender"></i>
                                                            </span>
                                                         </div>
                                                      </div>
                                                      <select class="form-control mt-5 due_limit" name="due_limit">
                                                         <option  value="1">On Receipt</option>
                                                         <option  value="15">Within 15 Days</option>
                                                         <option  value="30">Within 30 Days</option>
                                                         <option  value="45">Within 45 Days</option>
                                                         <option  value="60">Within 60 Days</option>
                                                         <option  value="75">Within 75 Days</option>
                                                         <option  value="90">Within 90 Days</option>
                                                      </select>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-12 p-0">
                                          <div class="table-responsive invcus-table">
                                             <table class="table">
                                                <thead>
                                                   <tr class="item-row">
                                                      <th>Item</th>
                                                      <th>Details</th>
                                                      <th>Price</th>
                                                      <th>Quantity</th>
                                                      <th>Total</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                <thead id="add_item">
                                                </thead>
                                                <tr>
                                                   <td colspan="5" class="p-0">
                                                      <a href="#" class="btn btn-default add_item_btn"><i class="icon-plus"></i> Add an item</a>
                                                   </td>
                                                </tr>
                                                <tr id="products_list_inv" style="display: none;">
                                                   <td colspan="5" class="p-0">
                                                      <div class="main-inv-product">
                                                         <div class="inv-product br-10 dshadow">
                                                            <div class="form-group has-search">
                                                               <span class="icon-magnifier form-control-feedback"></span>
                                                               <input type="text" class="form-control search_product" placeholder="Type product">
                                                            </div>
                                                            <div class="loaderp text-center p-10"></div>
                                                            <!-- load ajax data -->
                                                            <a href="#" class="cancel-inv">&times;</a>
                                                            <div id="load_product" class="pro-scroll">
                                                            </div>
                                                            <div class="col-md-12 p-0 text-center">
                                                               <a id="addRow" href="#" class="add-new-item btn btn-block btn-info p-10"><i class="icon-plus"></i> Add new item</a>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td class="text-right"><strong>Sub Total</strong></td>
                                                   <td>
                                                      <span class="currency_wrapper"></span>
                                                      <span id="subtotal">0.00</span> 
                                                      <input type="hidden" class="subtotal" name="sub_total" value="">
                                                   </td>
                                                </tr>
                                                <input type="hidden" class="total_tax" id="total_tax" value=""> 
                                                <tr>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td class="text-right"><strong>Discount</strong></td>
                                                   <td width="15%">
                                                      <div class="input-group">
                                                         <input type="text" id="discount" name="discount" value="" class="form-control" aria-describedby="basic-addon2">
                                                         <div class="input-group-append discount">
                                                            <span class="input-group-text" id="basic-addon1">%</span>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
                                                   <td class="text-right"><span class="currency_name mr-10"></span> <strong> Grand Total</strong></td>
                                                   <td>
                                                      <span class="currency_wrapper"></span>
                                                      <span id="grandTotal">0</span>
                                                      <input type="hidden" class="grandtotal" name="grand_total" value="">
                                                      <input type="hidden" class="convert_total" name="convert_total" value="">
                                                   </td>
                                                </tr>
                                                </tbody>
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="box-footer text-right">
                                 <input type="hidden" class="currency_code" name="currency_code" value="">
                                 <strong><span class="conversion_currency"> </span></strong>
                              </div>
                           </div>
                           <!-- invoice footer -->
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="panel panel-default inv">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                       <div class="panel-heading inv" role="tab" id="heading8">
                                          <h4 class="panel-title inv">
                                             <span class="style_border">Footer</span>
                                             <i class="fa fa-angle-down pull-right fa-1x"></i>
                                          </h4>
                                       </div>
                                    </a>
                                    <div id="collapse2" class="panel-collapse data_collaps_border collapse" role="tabpanel" aria-labelledby="heading2" aria-expanded="false" style="height: 1px;">
                                       <div class="panel-body inv">
                                          <div class="row">
                                             <div class="col-md-12">
                                                <textarea id="summernote" class="form-control" rows="8" name="footer_note" placeholder="Enter a footer for this invoice (e.g. tax information, thank you note)"></textarea>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row mb-10">
                              <div class="col-md-12">
                                 <div class="inv-top-btn mb-10">
                                    <button type="submit" class="btn btn-info btn-rounded save_invoice_btn pull-right ml-5">Save and continue</button>
                                    <button id="edit_invoice" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info pull-right mr-10 edit_invoice_btn" style="display: none;">Edit</button>
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-info btn-rounded pull-right mr-10 preview_invoice_btn">Preview</button>
                                 </div>
                                 <input type="hidden" class="set_value" name="check_value">
                              </div>
                           </div>
                        </div>
                        <!-- csrf token -->
                        <input type="hidden" name="csrf_test_name" value="068df1bcd3d2903a41d948503457ba0f">
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="is_recurring" value="0">
                     </form>
                  </div>
               </div>
            </section>
         </div>
         <!-- product list modal -->
         <div id="productModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-zoom modal-md">
               <form id="product-form" method="post" enctype="multipart/form-data" class="validate-form" action="http://accufy.originlabsoft.com/admin/invoice/ajax_add_product" role="form" novalidate>
                  <div class="modal-content modal-md">
                     <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Add new product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                     </div>
                     <div class="modal-body">
                        <div class="form-group row">
                           <label class="col-sm-4 text-right control-label col-form-label">Product Name</label>
                           <div class="col-sm-8">
                              <input type="text" class="form-control" name="name" required>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-4 text-right control-label col-form-label">Price</label>
                           <div class="col-sm-8">
                              <input type="text" class="form-control" name="price" required>
                           </div>
                        </div>
                        <input type="hidden" class="form-control" name="quantity" value="0">
                        <div class="form-group row">
                           <label class="col-sm-4 text-right control-label col-form-label">Details</label>
                           <div class="col-sm-8">
                              <textarea class="form-control" name="details"> </textarea>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <!-- csrf token -->
                        <input type="hidden" name="csrf_test_name" value="068df1bcd3d2903a41d948503457ba0f">
                        <button type="submit" class="btn btn-info waves-effect pull-right">Add Product</button>
                     </div>
                  </div>
               </form>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
         <!-- customer modal -->
         <div id="customerModal" class="modal fade" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-zoom modal-md">
               <form id="customer-form" method="post" enctype="multipart/form-data" class="validate-form" action="http://accufy.originlabsoft.com/admin/invoice/ajax_add_customer" role="form" novalidate>
                  <div class="modal-content modal-md">
                     <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Add New Customer</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                     </div>
                     <div class="modal-body">
                        <div class="form-group">
                           <label>Customer Name <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" required name="name">
                        </div>
                        <div class="form-group">
                           <label class="col-sm-2 control-label p-0" for="example-input-normal">Country </label>
                           <select class="form-control single_select col-sm-12" id="country" name="country" style="width: 100%">
                              <option value="">Select</option>
                              <option value="1">
                                 Andorra                                
                              </option>
                              <option value="2">
                                 United Arab Emirates                                
                              </option>
                              <option value="3">
                                 Afghanistan                                
                              </option>
                              <option value="4">
                                 Antigua and Barbuda                                
                              </option>
                              <option value="5">
                                 Anguilla                                
                              </option>
                              <option value="6">
                                 Albania                                
                              </option>
                              <option value="7">
                                 Armenia                                
                              </option>
                              <option value="8">
                                 Angola                                
                              </option>
                              <option value="9">
                                 Argentina                                
                              </option>
                              <option value="10">
                                 Austria                                
                              </option>
                              <option value="11">
                                 Australia                                
                              </option>
                              <option value="12">
                                 Aruba                                
                              </option>
                              <option value="13">
                                 Azerbaijan                                
                              </option>
                              <option value="14">
                                 Barbados                                
                              </option>
                              <option value="15">
                                 Bangladesh                                
                              </option>
                              <option value="16">
                                 Belgium                                
                              </option>
                              <option value="17">
                                 Burkina Faso                                
                              </option>
                              <option value="18">
                                 Bulgaria                                
                              </option>
                              <option value="19">
                                 Bahrain                                
                              </option>
                              <option value="20">
                                 Burundi                                
                              </option>
                              <option value="21">
                                 Benin                                
                              </option>
                              <option value="22">
                                 Bermuda                                
                              </option>
                              <option value="23">
                                 Brazil                                
                              </option>
                              <option value="24">
                                 Bhutan                                
                              </option>
                              <option value="25">
                                 Botswana                                
                              </option>
                              <option value="26">
                                 Belarus                                
                              </option>
                              <option value="27">
                                 Belize                                
                              </option>
                              <option value="28">
                                 Canada                                
                              </option>
                              <option value="29">
                                 Switzerland                                
                              </option>
                              <option value="30">
                                 Cote d&#039;Ivoire                                
                              </option>
                              <option value="31">
                                 Cook Islands                                
                              </option>
                              <option value="32">
                                 Chile                                
                              </option>
                              <option value="33">
                                 Cameroon                                
                              </option>
                              <option value="34">
                                 China                                
                              </option>
                              <option value="35">
                                 Colombia                                
                              </option>
                              <option value="36">
                                 Costa Rica                                
                              </option>
                              <option value="37">
                                 Cuba                                
                              </option>
                              <option value="38">
                                 Cape Verde                                
                              </option>
                              <option value="39">
                                 Cyprus                                
                              </option>
                              <option value="40">
                                 Czech Republic                                
                              </option>
                              <option value="41">
                                 Germany                                
                              </option>
                              <option value="42">
                                 Djibouti                                
                              </option>
                              <option value="43">
                                 Denmark                                
                              </option>
                              <option value="44">
                                 Dominica                                
                              </option>
                              <option value="45">
                                 Dominican Republic                                
                              </option>
                              <option value="46">
                                 Algeria                                
                              </option>
                              <option value="47">
                                 Ecuador                                
                              </option>
                              <option value="48">
                                 Estonia                                
                              </option>
                              <option value="49">
                                 Egypt                                
                              </option>
                              <option value="50">
                                 Eritrea                                
                              </option>
                              <option value="51">
                                 Spain                                
                              </option>
                              <option value="52">
                                 Ethiopia                                
                              </option>
                              <option value="53">
                                 Finland                                
                              </option>
                              <option value="54">
                                 Fiji                                
                              </option>
                              <option value="55">
                                 Faroe Islands                                
                              </option>
                              <option value="56">
                                 France                                
                              </option>
                              <option value="57">
                                 Gabon                                
                              </option>
                              <option value="58">
                                 United Kingdom                                
                              </option>
                              <option value="59">
                                 Grenada                                
                              </option>
                              <option value="60">
                                 Georgia                                
                              </option>
                              <option value="61">
                                 Guernsey                                
                              </option>
                              <option value="62">
                                 Ghana                                
                              </option>
                              <option value="63">
                                 Gibraltar                                
                              </option>
                              <option value="64">
                                 Guinea                                
                              </option>
                              <option value="65">
                                 Equatorial Guinea                                
                              </option>
                              <option value="66">
                                 Greece                                
                              </option>
                              <option value="67">
                                 Guatemala                                
                              </option>
                              <option value="68">
                                 Guinea-Bissau                                
                              </option>
                              <option value="69">
                                 Guyana                                
                              </option>
                              <option value="70">
                                 Hong Kong                                
                              </option>
                              <option value="71">
                                 Honduras                                
                              </option>
                              <option value="72">
                                 Croatia                                
                              </option>
                              <option value="73">
                                 Haiti                                
                              </option>
                              <option value="74">
                                 Hungary                                
                              </option>
                              <option value="75">
                                 Indonesia                                
                              </option>
                              <option value="76">
                                 Ireland                                
                              </option>
                              <option value="77">
                                 Israel                                
                              </option>
                              <option value="78">
                                 Isle of Man                                
                              </option>
                              <option value="79">
                                 India                                
                              </option>
                              <option value="80">
                                 Iraq                                
                              </option>
                              <option value="81">
                                 Iceland                                
                              </option>
                              <option value="82">
                                 Italy                                
                              </option>
                              <option value="83">
                                 Jersey                                
                              </option>
                              <option value="84">
                                 Jamaica                                
                              </option>
                              <option value="85">
                                 Jordan                                
                              </option>
                              <option value="86">
                                 Japan                                
                              </option>
                              <option value="87">
                                 Kenya                                
                              </option>
                              <option value="88">
                                 Kyrgyzstan                                
                              </option>
                              <option value="89">
                                 Cambodia                                
                              </option>
                              <option value="90">
                                 Kiribati                                
                              </option>
                              <option value="91">
                                 Comoros                                
                              </option>
                              <option value="92">
                                 Kuwait                                
                              </option>
                              <option value="93">
                                 Cayman Islands                                
                              </option>
                              <option value="94">
                                 Kazakhstan                                
                              </option>
                              <option value="95">
                                 Laos                                
                              </option>
                              <option value="96">
                                 Lebanon                                
                              </option>
                              <option value="97">
                                 Saint Lucia                                
                              </option>
                              <option value="98">
                                 Liechtenstein                                
                              </option>
                              <option value="99">
                                 Sri Lanka                                
                              </option>
                              <option value="100">
                                 Liberia                                
                              </option>
                              <option value="101">
                                 Lesotho                                
                              </option>
                              <option value="102">
                                 Lithuania                                
                              </option>
                              <option value="103">
                                 Luxembourg                                
                              </option>
                              <option value="104">
                                 Latvia                                
                              </option>
                              <option value="105">
                                 Morocco                                
                              </option>
                              <option value="106">
                                 Monaco                                
                              </option>
                              <option value="107">
                                 Moldova                                
                              </option>
                              <option value="108">
                                 Montenegro                                
                              </option>
                              <option value="109">
                                 Madagascar                                
                              </option>
                              <option value="110">
                                 Marshall Islands                                
                              </option>
                              <option value="111">
                                 Mali                                
                              </option>
                              <option value="112">
                                 Myanmar                                
                              </option>
                              <option value="113">
                                 Mongolia                                
                              </option>
                              <option value="114">
                                 Mauritania                                
                              </option>
                              <option value="115">
                                 Montserrat                                
                              </option>
                              <option value="116">
                                 Malta                                
                              </option>
                              <option value="117">
                                 Mauritius                                
                              </option>
                              <option value="118">
                                 Maldives                                
                              </option>
                              <option value="119">
                                 Malawi                                
                              </option>
                              <option value="120">
                                 Mexico                                
                              </option>
                              <option value="121">
                                 Malaysia                                
                              </option>
                              <option value="122">
                                 Mozambique                                
                              </option>
                              <option value="123">
                                 Namibia                                
                              </option>
                              <option value="124">
                                 New Caledonia                                
                              </option>
                              <option value="125">
                                 Niger                                
                              </option>
                              <option value="126">
                                 Nigeria                                
                              </option>
                              <option value="127">
                                 Nicaragua                                
                              </option>
                              <option value="128">
                                 Netherlands                                
                              </option>
                              <option value="129">
                                 Norway                                
                              </option>
                              <option value="130">
                                 Nepal                                
                              </option>
                              <option value="131">
                                 Nauru                                
                              </option>
                              <option value="132">
                                 Niue                                
                              </option>
                              <option value="133">
                                 New Zealand                                
                              </option>
                              <option value="134">
                                 Oman                                
                              </option>
                              <option value="135">
                                 Panama                                
                              </option>
                              <option value="136">
                                 Peru                                
                              </option>
                              <option value="137">
                                 French Polynesia                                
                              </option>
                              <option value="138">
                                 Papua New Guinea                                
                              </option>
                              <option value="139">
                                 Philippines                                
                              </option>
                              <option value="140">
                                 Pakistan                                
                              </option>
                              <option value="141">
                                 Poland                                
                              </option>
                              <option value="142">
                                 Portugal                                
                              </option>
                              <option value="143">
                                 Palau                                
                              </option>
                              <option value="144">
                                 Paraguay                                
                              </option>
                              <option value="145">
                                 Qatar                                
                              </option>
                              <option value="146">
                                 Romania                                
                              </option>
                              <option value="147">
                                 Serbia                                
                              </option>
                              <option value="148">
                                 Russia                                
                              </option>
                              <option value="149">
                                 Rwanda                                
                              </option>
                              <option value="150">
                                 Saudi Arabia                                
                              </option>
                              <option value="151">
                                 Solomon Islands                                
                              </option>
                              <option value="152">
                                 Seychelles                                
                              </option>
                              <option value="153">
                                 Sudan                                
                              </option>
                              <option value="154">
                                 Sweden                                
                              </option>
                              <option value="155">
                                 Singapore                                
                              </option>
                              <option value="156">
                                 Slovenia                                
                              </option>
                              <option value="157">
                                 Slovakia                                
                              </option>
                              <option value="158">
                                 Sierra Leone                                
                              </option>
                              <option value="159">
                                 San Marino                                
                              </option>
                              <option value="160">
                                 Senegal                                
                              </option>
                              <option value="161">
                                 Somalia                                
                              </option>
                              <option value="162">
                                 Suriname                                
                              </option>
                              <option value="163">
                                 El Salvador                                
                              </option>
                              <option value="164">
                                 Swaziland                                
                              </option>
                              <option value="165">
                                 Chad                                
                              </option>
                              <option value="166">
                                 Togo                                
                              </option>
                              <option value="167">
                                 Thailand                                
                              </option>
                              <option value="168">
                                 Tajikistan                                
                              </option>
                              <option value="169">
                                 Turkmenistan                                
                              </option>
                              <option value="170">
                                 Tunisia                                
                              </option>
                              <option value="171">
                                 Tonga                                
                              </option>
                              <option value="172">
                                 Turkey                                
                              </option>
                              <option value="173">
                                 Trinidad and Tobago                                
                              </option>
                              <option value="174">
                                 Tuvalu                                
                              </option>
                              <option value="175">
                                 Taiwan                                
                              </option>
                              <option value="176">
                                 Ukraine                                
                              </option>
                              <option value="177">
                                 Uganda                                
                              </option>
                              <option value="178">
                                 United States                                
                              </option>
                              <option value="179">
                                 Uruguay                                
                              </option>
                              <option value="180">
                                 Uzbekistan                                
                              </option>
                              <option value="181">
                                 Vietnam                                
                              </option>
                              <option value="182">
                                 Vanuatu                                
                              </option>
                              <option value="183">
                                 Wallis and Futuna                                
                              </option>
                              <option value="184">
                                 Samoa                                
                              </option>
                              <option value="185">
                                 Yemen                                
                              </option>
                              <option value="186">
                                 South Africa                                
                              </option>
                              <option value="187">
                                 Zambia                                
                              </option>
                              <option value="188">
                                 Zimbabwe                                
                              </option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-2 control-label p-0" for="example-input-normal">Currency </label>
                           <select class="form-control col-sm-12 wd-100" id="currency" name="currency" disabled>
                              <option value="">Select</option>
                              >
                              EUR - Euro                              </option>
                              >
                              AED - United Arab Emirates                              </option>
                              >
                              AFN - Afghan afghani                              </option>
                              >
                              XCD - East Caribbean dolla                              </option>
                              >
                              XCD - East Caribbean dolla                              </option>
                              >
                              ALL - Albanian lek                              </option>
                              >
                              AMD - Armenian dram                              </option>
                              >
                              AOA - Angolan kwanza                              </option>
                              >
                              ARS - Argentine peso                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              AUD - Australian dollar                              </option>
                              >
                              AWG - Aruban florin                              </option>
                              >
                              AZN - Azerbaijani manat                              </option>
                              >
                              BBD - Barbadian dollar                              </option>
                              >
                              BDT - Bangladeshi taka                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              XOF - West African CFA fra                              </option>
                              >
                              BGN - Bulgarian lev                              </option>
                              >
                              BHD - Bahraini dinar                              </option>
                              >
                              BIF - Burundian franc                              </option>
                              >
                              XOF - West African CFA fra                              </option>
                              >
                              BMD - Bermudian dollar                              </option>
                              >
                              BRL - Brazilian real                              </option>
                              >
                              BTN - Bhutanese ngultrum                              </option>
                              >
                              BWP - Botswana pula                              </option>
                              >
                              BYR - Belarusian ruble                              </option>
                              >
                              BZD - Belize dollar                              </option>
                              >
                              CAD - Canadian dollar                              </option>
                              >
                              CHF - Swiss franc                              </option>
                              >
                              XOF - West African CFA fra                              </option>
                              >
                              NZD - New Zealand dollar                              </option>
                              >
                              CLP - Chilean peso                              </option>
                              >
                              XAF - Central African CFA                               </option>
                              >
                              CNY - Chinese yuan                              </option>
                              >
                              COP - Colombian peso                              </option>
                              >
                              CRC - Costa Rican colón                              </option>
                              >
                              CUC - Cuban convertible pe                              </option>
                              >
                              CVE - Cape Verdean escudo                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              CZK - Czech koruna                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              DJF - Djiboutian franc                              </option>
                              >
                              DKK - Danish krone                              </option>
                              >
                              XCD - East Caribbean dolla                              </option>
                              >
                              DOP - Dominican peso                              </option>
                              >
                              DZD - Algerian dinar                              </option>
                              >
                              USD - United States dollar                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              EGP - Egyptian pound                              </option>
                              >
                              ERN - Eritrean nakfa                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              ETB - Ethiopian birr                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              FJD - Fijian dollar                              </option>
                              >
                              DKK - Danish krone                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              XAF - Central African CFA                               </option>
                              >
                              GBP - British pound                              </option>
                              >
                              XCD - East Caribbean dolla                              </option>
                              >
                              GEL - Georgian lari                              </option>
                              >
                              GBP - British pound                              </option>
                              >
                              GHS - Ghana cedi                              </option>
                              >
                              GIP - Gibraltar pound                              </option>
                              >
                              GNF - Guinean franc                              </option>
                              >
                              XAF - Central African CFA                               </option>
                              >
                              EUR - Euro                              </option>
                              >
                              GTQ - Guatemalan quetzal                              </option>
                              >
                              XOF - West African CFA fra                              </option>
                              >
                              GYD - Guyanese dollar                              </option>
                              >
                              HKD - Hong Kong dollar                              </option>
                              >
                              HNL - Honduran lempira                              </option>
                              >
                              HRK - Croatian kuna                              </option>
                              >
                              HTG - Haitian gourde                              </option>
                              >
                              HUF - Hungarian forint                              </option>
                              >
                              IDR - Indonesian rupiah                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              ILS - Israeli new shekel                              </option>
                              >
                              GBP - British pound                              </option>
                              >
                              INR - Indian rupee                              </option>
                              >
                              IQD - Iraqi dinar                              </option>
                              >
                              ISK - Icelandic króna                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              GBP - British pound                              </option>
                              >
                              JMD - Jamaican dollar                              </option>
                              >
                              JOD - Jordanian dinar                              </option>
                              >
                              JPY - Japanese yen                              </option>
                              >
                              KES - Kenyan shilling                              </option>
                              >
                              KGS - Kyrgyzstani som                              </option>
                              >
                              KHR - Cambodian riel                              </option>
                              >
                              AUD - Australian dollar                              </option>
                              >
                              KMF - Comorian franc                              </option>
                              >
                              KWD - Kuwaiti dinar                              </option>
                              >
                              KYD - Cayman Islands dolla                              </option>
                              >
                              KZT - Kazakhstani tenge                              </option>
                              >
                              LAK - Lao kip                              </option>
                              >
                              LBP - Lebanese pound                              </option>
                              >
                              XCD - East Caribbean dolla                              </option>
                              >
                              CHF - Swiss franc                              </option>
                              >
                              LKR - Sri Lankan rupee                              </option>
                              >
                              LRD - Liberian dollar                              </option>
                              >
                              LSL - Lesotho loti                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              MAD - Moroccan dirham                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              MDL - Moldovan leu                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              MGA - Malagasy ariary                              </option>
                              >
                              USD - United States dollar                              </option>
                              >
                              XOF - West African CFA fra                              </option>
                              >
                              MMK - Burmese kyat                              </option>
                              >
                              MNT - Mongolian tögrög                              </option>
                              >
                              MRO - Mauritanian ouguiya                              </option>
                              >
                              XCD - East Caribbean dolla                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              MUR - Mauritian rupee                              </option>
                              >
                              MVR - Maldivian rufiyaa                              </option>
                              >
                              MWK - Malawian kwacha                              </option>
                              >
                              MXN - Mexican peso                              </option>
                              >
                              MYR - Malaysian ringgit                              </option>
                              >
                              MZN - Mozambican metical                              </option>
                              >
                              NAD - Namibian dollar                              </option>
                              >
                              XPF - CFP franc                              </option>
                              >
                              XOF - West African CFA fra                              </option>
                              >
                              NGN - Nigerian naira                              </option>
                              >
                              NIO - Nicaraguan córdoba                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              NOK - Norwegian krone                              </option>
                              >
                              NPR - Nepalese rupee                              </option>
                              >
                              AUD - Australian dollar                              </option>
                              >
                              NZD - New Zealand dollar                              </option>
                              >
                              NZD - New Zealand dollar                              </option>
                              >
                              OMR - Omani rial                              </option>
                              >
                              PAB - Panamanian balboa                              </option>
                              >
                              PEN - Peruvian nuevo sol                              </option>
                              >
                              XPF - CFP franc                              </option>
                              >
                              PGK - Papua New Guinean ki                              </option>
                              >
                              PHP - Philippine peso                              </option>
                              >
                              PKR - Pakistani rupee                              </option>
                              >
                              PLN - Polish z?oty                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              - Palauan dollar                              </option>
                              >
                              PYG - Paraguayan guaraní                              </option>
                              >
                              QAR - Qatari riyal                              </option>
                              >
                              RON - Romanian leu                              </option>
                              >
                              RSD - Serbian dinar                              </option>
                              >
                              RUB - Russian ruble                              </option>
                              >
                              RWF - Rwandan franc                              </option>
                              >
                              SAR - Saudi riyal                              </option>
                              >
                              SBD - Solomon Islands doll                              </option>
                              >
                              SCR - Seychellois rupee                              </option>
                              >
                              SDG - Sudanese pound                              </option>
                              >
                              SEK - Swedish krona                              </option>
                              >
                              BND - Brunei dollar                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              SLL - Sierra Leonean leone                              </option>
                              >
                              EUR - Euro                              </option>
                              >
                              XOF - West African CFA fra                              </option>
                              >
                              SOS - Somali shilling                              </option>
                              >
                              SRD - Surinamese dollar                              </option>
                              >
                              USD - United States dollar                              </option>
                              >
                              SZL - Swazi lilangeni                              </option>
                              >
                              XAF - Central African CFA                               </option>
                              >
                              XOF - West African CFA fra                              </option>
                              >
                              THB - Thai baht                              </option>
                              >
                              TJS - Tajikistani somoni                              </option>
                              >
                              TMT - Turkmenistan manat                              </option>
                              >
                              TND - Tunisian dinar                              </option>
                              >
                              TOP - Tongan pa?anga                              </option>
                              >
                              TRY - Turkish lira                              </option>
                              >
                              TTD - Trinidad and Tobago                               </option>
                              >
                              AUD - Australian dollar                              </option>
                              >
                              TWD - New Taiwan dollar                              </option>
                              >
                              UAH - Ukrainian hryvnia                              </option>
                              >
                              UGX - Ugandan shilling                              </option>
                              >
                              USD - United States dollar                              </option>
                              >
                              UYU - Uruguayan peso                              </option>
                              >
                              UZS - Uzbekistani som                              </option>
                              >
                              VND - Vietnamese ??ng                              </option>
                              >
                              VUV - Vanuatu vatu                              </option>
                              >
                              XPF - CFP franc                              </option>
                              >
                              WST - Samoan t?l?                              </option>
                              >
                              YER - Yemeni rial                              </option>
                              >
                              ZAR - South African rand                              </option>
                              >
                              ZMW - Zambian kwacha                              </option>
                              >
                              BWP - Botswana pula                              </option>
                           </select>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <!-- csrf token -->
                        <input type="hidden" name="csrf_test_name" value="068df1bcd3d2903a41d948503457ba0f">
                        <button type="submit" class="btn btn-info waves-effect pull-right">Add Customer </button>
                     </div>
                  </div>
               </form>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
         <footer class="main-footer">
            <div class="pull-right d-none d-sm-inline-block">
               <div id="floating-container">
                  <div class="circle1 circle-blue1"></div>
                  <div class="floating-menus" style="display:none;">
                     <div>
                        <a href="http://accufy.originlabsoft.com/admin/invoice/create"> Create new Invoice              <i class="fa fa-file-text-o"></i></a>
                     </div>
                     <div>
                        <a href="http://accufy.originlabsoft.com/admin/estimate/create"> Create new Estimate              <i class="fa fa-file-text"></i></a>
                     </div>
                     <div>
                        <a href="http://accufy.originlabsoft.com/admin/bills/create">Create New Bill              <i class="fa fa-file-text-o"></i></a>
                     </div>
                     <div>
                        <a href="http://accufy.originlabsoft.com/admin/customer">Add Customer               <i class="fa fa-user-o"></i></a>
                     </div>
                     <div>
                        <a href="http://accufy.originlabsoft.com/admin/vendor">Add Vendor              <i class="fa ti-user"></i></a>
                     </div>
                  </div>
                  <div class="fab-button">
                     <i class="ti-plus" aria-hidden="true"></i>
                  </div>
               </div>
            </div>
         </footer>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>