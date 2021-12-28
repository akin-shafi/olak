<?php 
  require_once('../../private/initialize.php');

$page = 'Dashboard';
$page_title = 'User Dashboard';
include(SHARED_PATH . '/admin_header.php'); 

?>
<div class="content-wrapper">
   <section class="content container">
      <form method="post" enctype="multipart/form-data" action="update.php" role="form" class="form-horizontal">
         <div class="nav-tabs-custom">
            <ul class="nav nav-tabs admin mb-4">
               <li><a class="active" href="http://accufy.originlabsoft.com/admin/profile"><i class="fa fa-cog"></i> <span class="hidden-xs">General Settings</span>  </a></li>
               <li><a class="" href="http://accufy.originlabsoft.com/admin/profile/change_password"><i class="fa fa-lock"></i> <span class="hidden-xs">Change Password</span></a></li>
               <li><a class="" href="http://accufy.originlabsoft.com/admin/business"><i class="fa fa-briefcase"></i> <span class="hidden-xs">Business</span></a></li>
               <li><a class="" href="http://accufy.originlabsoft.com/admin/business/invoice_customize"><i class="fa fa-paint-brush"></i> <span class="hidden-xs">Invoice Customization</span></a></li>
               <li><a class="" href="http://accufy.originlabsoft.com/admin/role_management/permissions"><i class="fa fa-check-circle"></i> <span class="hidden-xs">Role Permissions</span></a></li>
               <li><a class="" href="http://accufy.originlabsoft.com/admin/role_management"><i class="fa fa-users"></i> <span class="hidden-xs">Role Management</span></a></li>
            </ul>
            <div class="row m-5 mt-20">
               <div class="col-md-8 box">
                  <div class="box-header">
                     <h3 class="box-title">Personal Information</h3>
                  </div>
                  <div class="box-body p-10">
                     <div class="form-group">
                        <div class="avatar-upload text-center">
                           <div class="avatar-edit">
                              <input type='file' name="photo" id="imageUpload" accept=".png, .jpg, .jpeg" />
                              <label for="imageUpload"></label>
                           </div>
                           <div class="avatar-preview">
                              <div id="imagePreview" style="background-image: url(http://accufy.originlabsoft.com/uploads/thumbnail/checkmark_thumb-150x150.png);">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group m-t-20">
                        <label class="col-sm-4 control-label" for="example-input-normal">Name</label>
                        <div class="col-sm-12">
                           <input type="text" name="name" value="John Doe" class="form-control" >
                        </div>
                     </div>
                     <div class="form-group m-t-20">
                        <label class="col-sm-4 control-label" for="example-input-normal">Email</label>
                        <div class="col-sm-12">
                           <input type="text" name="email" value="john@gmail.com" class="form-control" >
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label" for="example-input-normal">Country</label>
                        <div class="col-sm-12">
                           <select class="form-control single_select" name="country">
                              <option value="0">Select</option>
                              <option value="188" 
                                 >
                                 Zimbabwe                                  
                              </option>
                              <option value="187" 
                                 >
                                 Zambia                                  
                              </option>
                              <option value="186" 
                                 >
                                 South Africa                                  
                              </option>
                              <option value="185" 
                                 >
                                 Yemen                                  
                              </option>
                              <option value="184" 
                                 >
                                 Samoa                                  
                              </option>
                              <option value="183" 
                                 >
                                 Wallis and Futuna                                  
                              </option>
                              <option value="182" 
                                 >
                                 Vanuatu                                  
                              </option>
                              <option value="181" 
                                 >
                                 Vietnam                                  
                              </option>
                              <option value="180" 
                                 >
                                 Uzbekistan                                  
                              </option>
                              <option value="179" 
                                 >
                                 Uruguay                                  
                              </option>
                              <option value="178" 
                                 >
                                 United States                                  
                              </option>
                              <option value="177" 
                                 >
                                 Uganda                                  
                              </option>
                              <option value="176" 
                                 >
                                 Ukraine                                  
                              </option>
                              <option value="175" 
                                 >
                                 Taiwan                                  
                              </option>
                              <option value="174" 
                                 >
                                 Tuvalu                                  
                              </option>
                              <option value="173" 
                                 >
                                 Trinidad and Tobago                                  
                              </option>
                              <option value="172" 
                                 >
                                 Turkey                                  
                              </option>
                              <option value="171" 
                                 >
                                 Tonga                                  
                              </option>
                              <option value="170" 
                                 >
                                 Tunisia                                  
                              </option>
                              <option value="169" 
                                 >
                                 Turkmenistan                                  
                              </option>
                              <option value="168" 
                                 >
                                 Tajikistan                                  
                              </option>
                              <option value="167" 
                                 >
                                 Thailand                                  
                              </option>
                              <option value="166" 
                                 >
                                 Togo                                  
                              </option>
                              <option value="165" 
                                 >
                                 Chad                                  
                              </option>
                              <option value="164" 
                                 >
                                 Swaziland                                  
                              </option>
                              <option value="163" 
                                 >
                                 El Salvador                                  
                              </option>
                              <option value="162" 
                                 >
                                 Suriname                                  
                              </option>
                              <option value="161" 
                                 >
                                 Somalia                                  
                              </option>
                              <option value="160" 
                                 >
                                 Senegal                                  
                              </option>
                              <option value="159" 
                                 >
                                 San Marino                                  
                              </option>
                              <option value="158" 
                                 >
                                 Sierra Leone                                  
                              </option>
                              <option value="157" 
                                 >
                                 Slovakia                                  
                              </option>
                              <option value="156" 
                                 >
                                 Slovenia                                  
                              </option>
                              <option value="155" 
                                 >
                                 Singapore                                  
                              </option>
                              <option value="154" 
                                 >
                                 Sweden                                  
                              </option>
                              <option value="153" 
                                 >
                                 Sudan                                  
                              </option>
                              <option value="152" 
                                 >
                                 Seychelles                                  
                              </option>
                              <option value="151" 
                                 >
                                 Solomon Islands                                  
                              </option>
                              <option value="150" 
                                 >
                                 Saudi Arabia                                  
                              </option>
                              <option value="149" 
                                 >
                                 Rwanda                                  
                              </option>
                              <option value="148" 
                                 >
                                 Russia                                  
                              </option>
                              <option value="147" 
                                 >
                                 Serbia                                  
                              </option>
                              <option value="146" 
                                 >
                                 Romania                                  
                              </option>
                              <option value="145" 
                                 >
                                 Qatar                                  
                              </option>
                              <option value="144" 
                                 >
                                 Paraguay                                  
                              </option>
                              <option value="143" 
                                 >
                                 Palau                                  
                              </option>
                              <option value="142" 
                                 >
                                 Portugal                                  
                              </option>
                              <option value="141" 
                                 >
                                 Poland                                  
                              </option>
                              <option value="140" 
                                 >
                                 Pakistan                                  
                              </option>
                              <option value="139" 
                                 selected>
                                 Philippines                                  
                              </option>
                              <option value="138" 
                                 >
                                 Papua New Guinea                                  
                              </option>
                              <option value="137" 
                                 >
                                 French Polynesia                                  
                              </option>
                              <option value="136" 
                                 >
                                 Peru                                  
                              </option>
                              <option value="135" 
                                 >
                                 Panama                                  
                              </option>
                              <option value="134" 
                                 >
                                 Oman                                  
                              </option>
                              <option value="133" 
                                 >
                                 New Zealand                                  
                              </option>
                              <option value="132" 
                                 >
                                 Niue                                  
                              </option>
                              <option value="131" 
                                 >
                                 Nauru                                  
                              </option>
                              <option value="130" 
                                 >
                                 Nepal                                  
                              </option>
                              <option value="129" 
                                 >
                                 Norway                                  
                              </option>
                              <option value="128" 
                                 >
                                 Netherlands                                  
                              </option>
                              <option value="127" 
                                 >
                                 Nicaragua                                  
                              </option>
                              <option value="126" 
                                 >
                                 Nigeria                                  
                              </option>
                              <option value="125" 
                                 >
                                 Niger                                  
                              </option>
                              <option value="124" 
                                 >
                                 New Caledonia                                  
                              </option>
                              <option value="123" 
                                 >
                                 Namibia                                  
                              </option>
                              <option value="122" 
                                 >
                                 Mozambique                                  
                              </option>
                              <option value="121" 
                                 >
                                 Malaysia                                  
                              </option>
                              <option value="120" 
                                 >
                                 Mexico                                  
                              </option>
                              <option value="119" 
                                 >
                                 Malawi                                  
                              </option>
                              <option value="118" 
                                 >
                                 Maldives                                  
                              </option>
                              <option value="117" 
                                 >
                                 Mauritius                                  
                              </option>
                              <option value="116" 
                                 >
                                 Malta                                  
                              </option>
                              <option value="115" 
                                 >
                                 Montserrat                                  
                              </option>
                              <option value="114" 
                                 >
                                 Mauritania                                  
                              </option>
                              <option value="113" 
                                 >
                                 Mongolia                                  
                              </option>
                              <option value="112" 
                                 >
                                 Myanmar                                  
                              </option>
                              <option value="111" 
                                 >
                                 Mali                                  
                              </option>
                              <option value="110" 
                                 >
                                 Marshall Islands                                  
                              </option>
                              <option value="109" 
                                 >
                                 Madagascar                                  
                              </option>
                              <option value="108" 
                                 >
                                 Montenegro                                  
                              </option>
                              <option value="107" 
                                 >
                                 Moldova                                  
                              </option>
                              <option value="106" 
                                 >
                                 Monaco                                  
                              </option>
                              <option value="105" 
                                 >
                                 Morocco                                  
                              </option>
                              <option value="104" 
                                 >
                                 Latvia                                  
                              </option>
                              <option value="103" 
                                 >
                                 Luxembourg                                  
                              </option>
                              <option value="102" 
                                 >
                                 Lithuania                                  
                              </option>
                              <option value="101" 
                                 >
                                 Lesotho                                  
                              </option>
                              <option value="100" 
                                 >
                                 Liberia                                  
                              </option>
                              <option value="99" 
                                 >
                                 Sri Lanka                                  
                              </option>
                              <option value="98" 
                                 >
                                 Liechtenstein                                  
                              </option>
                              <option value="97" 
                                 >
                                 Saint Lucia                                  
                              </option>
                              <option value="96" 
                                 >
                                 Lebanon                                  
                              </option>
                              <option value="95" 
                                 >
                                 Laos                                  
                              </option>
                              <option value="94" 
                                 >
                                 Kazakhstan                                  
                              </option>
                              <option value="93" 
                                 >
                                 Cayman Islands                                  
                              </option>
                              <option value="92" 
                                 >
                                 Kuwait                                  
                              </option>
                              <option value="91" 
                                 >
                                 Comoros                                  
                              </option>
                              <option value="90" 
                                 >
                                 Kiribati                                  
                              </option>
                              <option value="89" 
                                 >
                                 Cambodia                                  
                              </option>
                              <option value="88" 
                                 >
                                 Kyrgyzstan                                  
                              </option>
                              <option value="87" 
                                 >
                                 Kenya                                  
                              </option>
                              <option value="86" 
                                 >
                                 Japan                                  
                              </option>
                              <option value="85" 
                                 >
                                 Jordan                                  
                              </option>
                              <option value="84" 
                                 >
                                 Jamaica                                  
                              </option>
                              <option value="83" 
                                 >
                                 Jersey                                  
                              </option>
                              <option value="82" 
                                 >
                                 Italy                                  
                              </option>
                              <option value="81" 
                                 >
                                 Iceland                                  
                              </option>
                              <option value="80" 
                                 >
                                 Iraq                                  
                              </option>
                              <option value="79" 
                                 >
                                 India                                  
                              </option>
                              <option value="78" 
                                 >
                                 Isle of Man                                  
                              </option>
                              <option value="77" 
                                 >
                                 Israel                                  
                              </option>
                              <option value="76" 
                                 >
                                 Ireland                                  
                              </option>
                              <option value="75" 
                                 >
                                 Indonesia                                  
                              </option>
                              <option value="74" 
                                 >
                                 Hungary                                  
                              </option>
                              <option value="73" 
                                 >
                                 Haiti                                  
                              </option>
                              <option value="72" 
                                 >
                                 Croatia                                  
                              </option>
                              <option value="71" 
                                 >
                                 Honduras                                  
                              </option>
                              <option value="70" 
                                 >
                                 Hong Kong                                  
                              </option>
                              <option value="69" 
                                 >
                                 Guyana                                  
                              </option>
                              <option value="68" 
                                 >
                                 Guinea-Bissau                                  
                              </option>
                              <option value="67" 
                                 >
                                 Guatemala                                  
                              </option>
                              <option value="66" 
                                 >
                                 Greece                                  
                              </option>
                              <option value="65" 
                                 >
                                 Equatorial Guinea                                  
                              </option>
                              <option value="64" 
                                 >
                                 Guinea                                  
                              </option>
                              <option value="63" 
                                 >
                                 Gibraltar                                  
                              </option>
                              <option value="62" 
                                 >
                                 Ghana                                  
                              </option>
                              <option value="61" 
                                 >
                                 Guernsey                                  
                              </option>
                              <option value="60" 
                                 >
                                 Georgia                                  
                              </option>
                              <option value="59" 
                                 >
                                 Grenada                                  
                              </option>
                              <option value="58" 
                                 >
                                 United Kingdom                                  
                              </option>
                              <option value="57" 
                                 >
                                 Gabon                                  
                              </option>
                              <option value="56" 
                                 >
                                 France                                  
                              </option>
                              <option value="55" 
                                 >
                                 Faroe Islands                                  
                              </option>
                              <option value="54" 
                                 >
                                 Fiji                                  
                              </option>
                              <option value="53" 
                                 >
                                 Finland                                  
                              </option>
                              <option value="52" 
                                 >
                                 Ethiopia                                  
                              </option>
                              <option value="51" 
                                 >
                                 Spain                                  
                              </option>
                              <option value="50" 
                                 >
                                 Eritrea                                  
                              </option>
                              <option value="49" 
                                 >
                                 Egypt                                  
                              </option>
                              <option value="48" 
                                 >
                                 Estonia                                  
                              </option>
                              <option value="47" 
                                 >
                                 Ecuador                                  
                              </option>
                              <option value="46" 
                                 >
                                 Algeria                                  
                              </option>
                              <option value="45" 
                                 >
                                 Dominican Republic                                  
                              </option>
                              <option value="44" 
                                 >
                                 Dominica                                  
                              </option>
                              <option value="43" 
                                 >
                                 Denmark                                  
                              </option>
                              <option value="42" 
                                 >
                                 Djibouti                                  
                              </option>
                              <option value="41" 
                                 >
                                 Germany                                  
                              </option>
                              <option value="40" 
                                 >
                                 Czech Republic                                  
                              </option>
                              <option value="39" 
                                 >
                                 Cyprus                                  
                              </option>
                              <option value="38" 
                                 >
                                 Cape Verde                                  
                              </option>
                              <option value="37" 
                                 >
                                 Cuba                                  
                              </option>
                              <option value="36" 
                                 >
                                 Costa Rica                                  
                              </option>
                              <option value="35" 
                                 >
                                 Colombia                                  
                              </option>
                              <option value="34" 
                                 >
                                 China                                  
                              </option>
                              <option value="33" 
                                 >
                                 Cameroon                                  
                              </option>
                              <option value="32" 
                                 >
                                 Chile                                  
                              </option>
                              <option value="31" 
                                 >
                                 Cook Islands                                  
                              </option>
                              <option value="30" 
                                 >
                                 Cote d&#039;Ivoire                                  
                              </option>
                              <option value="29" 
                                 >
                                 Switzerland                                  
                              </option>
                              <option value="28" 
                                 >
                                 Canada                                  
                              </option>
                              <option value="27" 
                                 >
                                 Belize                                  
                              </option>
                              <option value="26" 
                                 >
                                 Belarus                                  
                              </option>
                              <option value="25" 
                                 >
                                 Botswana                                  
                              </option>
                              <option value="24" 
                                 >
                                 Bhutan                                  
                              </option>
                              <option value="23" 
                                 >
                                 Brazil                                  
                              </option>
                              <option value="22" 
                                 >
                                 Bermuda                                  
                              </option>
                              <option value="21" 
                                 >
                                 Benin                                  
                              </option>
                              <option value="20" 
                                 >
                                 Burundi                                  
                              </option>
                              <option value="19" 
                                 >
                                 Bahrain                                  
                              </option>
                              <option value="18" 
                                 >
                                 Bulgaria                                  
                              </option>
                              <option value="17" 
                                 >
                                 Burkina Faso                                  
                              </option>
                              <option value="16" 
                                 >
                                 Belgium                                  
                              </option>
                              <option value="15" 
                                 >
                                 Bangladesh                                  
                              </option>
                              <option value="14" 
                                 >
                                 Barbados                                  
                              </option>
                              <option value="13" 
                                 >
                                 Azerbaijan                                  
                              </option>
                              <option value="12" 
                                 >
                                 Aruba                                  
                              </option>
                              <option value="11" 
                                 >
                                 Australia                                  
                              </option>
                              <option value="10" 
                                 >
                                 Austria                                  
                              </option>
                              <option value="9" 
                                 >
                                 Argentina                                  
                              </option>
                              <option value="8" 
                                 >
                                 Angola                                  
                              </option>
                              <option value="7" 
                                 >
                                 Armenia                                  
                              </option>
                              <option value="6" 
                                 >
                                 Albania                                  
                              </option>
                              <option value="5" 
                                 >
                                 Anguilla                                  
                              </option>
                              <option value="4" 
                                 >
                                 Antigua and Barbuda                                  
                              </option>
                              <option value="3" 
                                 >
                                 Afghanistan                                  
                              </option>
                              <option value="2" 
                                 >
                                 United Arab Emirates                                  
                              </option>
                              <option value="1" 
                                 >
                                 Andorra                                  
                              </option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label" for="example-input-normal">City</label>
                        <div class="col-sm-12">
                           <input type="text" name="city" class="form-control" value="Baghdad">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label" for="example-input-normal">State</label>
                        <div class="col-sm-12">
                           <input type="text" name="state" class="form-control" value="Baghdad">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label" for="example-input-normal">Postcode</label>
                        <div class="col-sm-12">
                           <input type="text" name="postcode" class="form-control" value="255511">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-4 control-label" for="example-input-normal">Adderss</label>
                        <div class="col-sm-12">
                           <input type="text" name="address" class="form-control" value="Moon Ave., Ricardo Shopping Festival, #01-03 (Corner, next to McDonald&#039;s)">
                        </div>
                     </div>
                  </div>
                  <div class="box-footer">
                     <!-- csrf token -->
                     <input type="hidden" name="csrf_test_name" value="35d25f187e62cecfe6992206132448c3">
                     <button type="submit" class="btn btn-info waves-effect rounded w-md waves-light"><i class="fa fa-check"></i> Save Changes</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </section>
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>