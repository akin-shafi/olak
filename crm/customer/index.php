<?php 
  require_once('../private/initialize.php');

$page = 'Dashboard';
$page_title = 'User Dashboard';
include(SHARED_PATH . '/admin_header.php'); 

?>
<div class="content-wrapper" style="min-height: 623px;">

  <!-- Main content -->
  <section class="content">

    <div class="col-md-6 m-auto box add_area" style="display: none">
      <div class="box-header with-border">
                  <h3 class="box-title">Add New Customer </h3>
        
        <div class="box-tools pull-right">
                      <a href="#" class="text-right rounded btn btn-default btn-sm cancel_btn"><i class="fa fa-angle-left"></i> Back</a>
                  </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="http://accufy.originlabsoft.com/admin/customer/add" role="form" novalidate="">

          <div class="form-group">
            <label>Customer Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required="" name="name" value="">
          </div>

          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="">
          </div>

          <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" name="phone" value="">
          </div>

          <div class="form-group">
            <label>Address </label>
            <textarea class="form-control" name="address"></textarea>
          </div>

          <div class="form-group">
            <label>Business Number</label>
            <input type="text" class="form-control" name="cus_number" value="">
          </div>

          <div class="form-group">
            <label>Tax/vat Number</label>
            <input type="text" class="form-control" name="vat_code" value="">
          </div>

          <hr>

          <h4>Billing Information</h4><br>

          <div class="form-group">
              <label class="col-sm-2 control-label p-0" for="example-input-normal">Country </label>
              <select class="form-control single_select col-sm-12 select2-hidden-accessible" id="country" name="country" style="width: 100%" data-select2-id="country" tabindex="-1" aria-hidden="true">
                  <option value="0" data-select2-id="2">Select</option>
                                                                <option value="1">
                          Andorra                        </option>
                                                                                      <option value="2">
                          United Arab Emirates                        </option>
                                                                                      <option value="3">
                          Afghanistan                        </option>
                                                                                      <option value="4">
                          Antigua and Barbuda                        </option>
                                                                                      <option value="5">
                          Anguilla                        </option>
                                                                                      <option value="6">
                          Albania                        </option>
                                                                                      <option value="7">
                          Armenia                        </option>
                                                                                      <option value="8">
                          Angola                        </option>
                                                                                      <option value="9">
                          Argentina                        </option>
                                                                                      <option value="10">
                          Austria                        </option>
                                                                                      <option value="11">
                          Australia                        </option>
                                                                                      <option value="12">
                          Aruba                        </option>
                                                                                      <option value="13">
                          Azerbaijan                        </option>
                                                                                      <option value="14">
                          Barbados                        </option>
                                                                                      <option value="15">
                          Bangladesh                        </option>
                                                                                      <option value="16">
                          Belgium                        </option>
                                                                                      <option value="17">
                          Burkina Faso                        </option>
                                                                                      <option value="18">
                          Bulgaria                        </option>
                                                                                      <option value="19">
                          Bahrain                        </option>
                                                                                      <option value="20">
                          Burundi                        </option>
                                                                                      <option value="21">
                          Benin                        </option>
                                                                                      <option value="22">
                          Bermuda                        </option>
                                                                                      <option value="23">
                          Brazil                        </option>
                                                                                      <option value="24">
                          Bhutan                        </option>
                                                                                      <option value="25">
                          Botswana                        </option>
                                                                                      <option value="26">
                          Belarus                        </option>
                                                                                      <option value="27">
                          Belize                        </option>
                                                                                      <option value="28">
                          Canada                        </option>
                                                                                      <option value="29">
                          Switzerland                        </option>
                                                                                      <option value="30">
                          Cote d'Ivoire                        </option>
                                                                                      <option value="31">
                          Cook Islands                        </option>
                                                                                      <option value="32">
                          Chile                        </option>
                                                                                      <option value="33">
                          Cameroon                        </option>
                                                                                      <option value="34">
                          China                        </option>
                                                                                      <option value="35">
                          Colombia                        </option>
                                                                                      <option value="36">
                          Costa Rica                        </option>
                                                                                      <option value="37">
                          Cuba                        </option>
                                                                                      <option value="38">
                          Cape Verde                        </option>
                                                                                      <option value="39">
                          Cyprus                        </option>
                                                                                      <option value="40">
                          Czech Republic                        </option>
                                                                                      <option value="41">
                          Germany                        </option>
                                                                                      <option value="42">
                          Djibouti                        </option>
                                                                                      <option value="43">
                          Denmark                        </option>
                                                                                      <option value="44">
                          Dominica                        </option>
                                                                                      <option value="45">
                          Dominican Republic                        </option>
                                                                                      <option value="46">
                          Algeria                        </option>
                                                                                      <option value="47">
                          Ecuador                        </option>
                                                                                      <option value="48">
                          Estonia                        </option>
                                                                                      <option value="49">
                          Egypt                        </option>
                                                                                      <option value="50">
                          Eritrea                        </option>
                                                                                      <option value="51">
                          Spain                        </option>
                                                                                      <option value="52">
                          Ethiopia                        </option>
                                                                                      <option value="53">
                          Finland                        </option>
                                                                                      <option value="54">
                          Fiji                        </option>
                                                                                      <option value="55">
                          Faroe Islands                        </option>
                                                                                      <option value="56">
                          France                        </option>
                                                                                      <option value="57">
                          Gabon                        </option>
                                                                                      <option value="58">
                          United Kingdom                        </option>
                                                                                      <option value="59">
                          Grenada                        </option>
                                                                                      <option value="60">
                          Georgia                        </option>
                                                                                      <option value="61">
                          Guernsey                        </option>
                                                                                      <option value="62">
                          Ghana                        </option>
                                                                                      <option value="63">
                          Gibraltar                        </option>
                                                                                      <option value="64">
                          Guinea                        </option>
                                                                                      <option value="65">
                          Equatorial Guinea                        </option>
                                                                                      <option value="66">
                          Greece                        </option>
                                                                                      <option value="67">
                          Guatemala                        </option>
                                                                                      <option value="68">
                          Guinea-Bissau                        </option>
                                                                                      <option value="69">
                          Guyana                        </option>
                                                                                      <option value="70">
                          Hong Kong                        </option>
                                                                                      <option value="71">
                          Honduras                        </option>
                                                                                      <option value="72">
                          Croatia                        </option>
                                                                                      <option value="73">
                          Haiti                        </option>
                                                                                      <option value="74">
                          Hungary                        </option>
                                                                                      <option value="75">
                          Indonesia                        </option>
                                                                                      <option value="76">
                          Ireland                        </option>
                                                                                      <option value="77">
                          Israel                        </option>
                                                                                      <option value="78">
                          Isle of Man                        </option>
                                                                                      <option value="79">
                          India                        </option>
                                                                                      <option value="80">
                          Iraq                        </option>
                                                                                      <option value="81">
                          Iceland                        </option>
                                                                                      <option value="82">
                          Italy                        </option>
                                                                                      <option value="83">
                          Jersey                        </option>
                                                                                      <option value="84">
                          Jamaica                        </option>
                                                                                      <option value="85">
                          Jordan                        </option>
                                                                                      <option value="86">
                          Japan                        </option>
                                                                                      <option value="87">
                          Kenya                        </option>
                                                                                      <option value="88">
                          Kyrgyzstan                        </option>
                                                                                      <option value="89">
                          Cambodia                        </option>
                                                                                      <option value="90">
                          Kiribati                        </option>
                                                                                      <option value="91">
                          Comoros                        </option>
                                                                                      <option value="92">
                          Kuwait                        </option>
                                                                                      <option value="93">
                          Cayman Islands                        </option>
                                                                                      <option value="94">
                          Kazakhstan                        </option>
                                                                                      <option value="95">
                          Laos                        </option>
                                                                                      <option value="96">
                          Lebanon                        </option>
                                                                                      <option value="97">
                          Saint Lucia                        </option>
                                                                                      <option value="98">
                          Liechtenstein                        </option>
                                                                                      <option value="99">
                          Sri Lanka                        </option>
                                                                                      <option value="100">
                          Liberia                        </option>
                                                                                      <option value="101">
                          Lesotho                        </option>
                                                                                      <option value="102">
                          Lithuania                        </option>
                                                                                      <option value="103">
                          Luxembourg                        </option>
                                                                                      <option value="104">
                          Latvia                        </option>
                                                                                      <option value="105">
                          Morocco                        </option>
                                                                                      <option value="106">
                          Monaco                        </option>
                                                                                      <option value="107">
                          Moldova                        </option>
                                                                                      <option value="108">
                          Montenegro                        </option>
                                                                                      <option value="109">
                          Madagascar                        </option>
                                                                                      <option value="110">
                          Marshall Islands                        </option>
                                                                                      <option value="111">
                          Mali                        </option>
                                                                                      <option value="112">
                          Myanmar                        </option>
                                                                                      <option value="113">
                          Mongolia                        </option>
                                                                                      <option value="114">
                          Mauritania                        </option>
                                                                                      <option value="115">
                          Montserrat                        </option>
                                                                                      <option value="116">
                          Malta                        </option>
                                                                                      <option value="117">
                          Mauritius                        </option>
                                                                                      <option value="118">
                          Maldives                        </option>
                                                                                      <option value="119">
                          Malawi                        </option>
                                                                                      <option value="120">
                          Mexico                        </option>
                                                                                      <option value="121">
                          Malaysia                        </option>
                                                                                      <option value="122">
                          Mozambique                        </option>
                                                                                      <option value="123">
                          Namibia                        </option>
                                                                                      <option value="124">
                          New Caledonia                        </option>
                                                                                      <option value="125">
                          Niger                        </option>
                                                                                      <option value="126">
                          Nigeria                        </option>
                                                                                      <option value="127">
                          Nicaragua                        </option>
                                                                                      <option value="128">
                          Netherlands                        </option>
                                                                                      <option value="129">
                          Norway                        </option>
                                                                                      <option value="130">
                          Nepal                        </option>
                                                                                      <option value="131">
                          Nauru                        </option>
                                                                                      <option value="132">
                          Niue                        </option>
                                                                                      <option value="133">
                          New Zealand                        </option>
                                                                                      <option value="134">
                          Oman                        </option>
                                                                                      <option value="135">
                          Panama                        </option>
                                                                                      <option value="136">
                          Peru                        </option>
                                                                                      <option value="137">
                          French Polynesia                        </option>
                                                                                      <option value="138">
                          Papua New Guinea                        </option>
                                                                                      <option value="139">
                          Philippines                        </option>
                                                                                      <option value="140">
                          Pakistan                        </option>
                                                                                      <option value="141">
                          Poland                        </option>
                                                                                      <option value="142">
                          Portugal                        </option>
                                                                                      <option value="143">
                          Palau                        </option>
                                                                                      <option value="144">
                          Paraguay                        </option>
                                                                                      <option value="145">
                          Qatar                        </option>
                                                                                      <option value="146">
                          Romania                        </option>
                                                                                      <option value="147">
                          Serbia                        </option>
                                                                                      <option value="148">
                          Russia                        </option>
                                                                                      <option value="149">
                          Rwanda                        </option>
                                                                                      <option value="150">
                          Saudi Arabia                        </option>
                                                                                      <option value="151">
                          Solomon Islands                        </option>
                                                                                      <option value="152">
                          Seychelles                        </option>
                                                                                      <option value="153">
                          Sudan                        </option>
                                                                                      <option value="154">
                          Sweden                        </option>
                                                                                      <option value="155">
                          Singapore                        </option>
                                                                                      <option value="156">
                          Slovenia                        </option>
                                                                                      <option value="157">
                          Slovakia                        </option>
                                                                                      <option value="158">
                          Sierra Leone                        </option>
                                                                                      <option value="159">
                          San Marino                        </option>
                                                                                      <option value="160">
                          Senegal                        </option>
                                                                                      <option value="161">
                          Somalia                        </option>
                                                                                      <option value="162">
                          Suriname                        </option>
                                                                                      <option value="163">
                          El Salvador                        </option>
                                                                                      <option value="164">
                          Swaziland                        </option>
                                                                                      <option value="165">
                          Chad                        </option>
                                                                                      <option value="166">
                          Togo                        </option>
                                                                                      <option value="167">
                          Thailand                        </option>
                                                                                      <option value="168">
                          Tajikistan                        </option>
                                                                                      <option value="169">
                          Turkmenistan                        </option>
                                                                                      <option value="170">
                          Tunisia                        </option>
                                                                                      <option value="171">
                          Tonga                        </option>
                                                                                      <option value="172">
                          Turkey                        </option>
                                                                                      <option value="173">
                          Trinidad and Tobago                        </option>
                                                                                      <option value="174">
                          Tuvalu                        </option>
                                                                                      <option value="175">
                          Taiwan                        </option>
                                                                                      <option value="176">
                          Ukraine                        </option>
                                                                                      <option value="177">
                          Uganda                        </option>
                                                                                      <option value="178">
                          United States                        </option>
                                                                                      <option value="179">
                          Uruguay                        </option>
                                                                                      <option value="180">
                          Uzbekistan                        </option>
                                                                                      <option value="181">
                          Vietnam                        </option>
                                                                                      <option value="182">
                          Vanuatu                        </option>
                                                                                      <option value="183">
                          Wallis and Futuna                        </option>
                                                                                      <option value="184">
                          Samoa                        </option>
                                                                                      <option value="185">
                          Yemen                        </option>
                                                                                      <option value="186">
                          South Africa                        </option>
                                                                                      <option value="187">
                          Zambia                        </option>
                                                                                      <option value="188">
                          Zimbabwe                        </option>
                                                      </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="1" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-country-container"><span class="select2-selection__rendered" id="select2-country-container" role="textbox" aria-readonly="true" title="Select">Select</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
          </div>

          <div class="form-group">
              <label class="col-sm-2 control-label p-0" for="example-input-normal">Currency </label>
              <select class="form-control col-sm-12 wd-100" id="currency" name="currency" disabled="">
                  <option value="">Select</option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        AED - United Arab Emirates                      </option>
                                        <option>
                        AFN - Afghan afghani                      </option>
                                        <option>
                        XCD - East Caribbean dolla                      </option>
                                        <option>
                        XCD - East Caribbean dolla                      </option>
                                        <option>
                        ALL - Albanian lek                      </option>
                                        <option>
                        AMD - Armenian dram                      </option>
                                        <option>
                        AOA - Angolan kwanza                      </option>
                                        <option>
                        ARS - Argentine peso                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        AUD - Australian dollar                      </option>
                                        <option>
                        AWG - Aruban florin                      </option>
                                        <option>
                        AZN - Azerbaijani manat                      </option>
                                        <option>
                        BBD - Barbadian dollar                      </option>
                                        <option>
                        BDT - Bangladeshi taka                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        XOF - West African CFA fra                      </option>
                                        <option>
                        BGN - Bulgarian lev                      </option>
                                        <option>
                        BHD - Bahraini dinar                      </option>
                                        <option>
                        BIF - Burundian franc                      </option>
                                        <option>
                        XOF - West African CFA fra                      </option>
                                        <option>
                        BMD - Bermudian dollar                      </option>
                                        <option>
                        BRL - Brazilian real                      </option>
                                        <option>
                        BTN - Bhutanese ngultrum                      </option>
                                        <option>
                        BWP - Botswana pula                      </option>
                                        <option>
                        BYR - Belarusian ruble                      </option>
                                        <option>
                        BZD - Belize dollar                      </option>
                                        <option>
                        CAD - Canadian dollar                      </option>
                                        <option>
                        CHF - Swiss franc                      </option>
                                        <option>
                        XOF - West African CFA fra                      </option>
                                        <option>
                        NZD - New Zealand dollar                      </option>
                                        <option>
                        CLP - Chilean peso                      </option>
                                        <option>
                        XAF - Central African CFA                       </option>
                                        <option>
                        CNY - Chinese yuan                      </option>
                                        <option>
                        COP - Colombian peso                      </option>
                                        <option>
                        CRC - Costa Rican colón                      </option>
                                        <option>
                        CUC - Cuban convertible pe                      </option>
                                        <option>
                        CVE - Cape Verdean escudo                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        CZK - Czech koruna                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        DJF - Djiboutian franc                      </option>
                                        <option>
                        DKK - Danish krone                      </option>
                                        <option>
                        XCD - East Caribbean dolla                      </option>
                                        <option>
                        DOP - Dominican peso                      </option>
                                        <option>
                        DZD - Algerian dinar                      </option>
                                        <option>
                        USD - United States dollar                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        EGP - Egyptian pound                      </option>
                                        <option>
                        ERN - Eritrean nakfa                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        ETB - Ethiopian birr                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        FJD - Fijian dollar                      </option>
                                        <option>
                        DKK - Danish krone                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        XAF - Central African CFA                       </option>
                                        <option>
                        GBP - British pound                      </option>
                                        <option>
                        XCD - East Caribbean dolla                      </option>
                                        <option>
                        GEL - Georgian lari                      </option>
                                        <option>
                        GBP - British pound                      </option>
                                        <option>
                        GHS - Ghana cedi                      </option>
                                        <option>
                        GIP - Gibraltar pound                      </option>
                                        <option>
                        GNF - Guinean franc                      </option>
                                        <option>
                        XAF - Central African CFA                       </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        GTQ - Guatemalan quetzal                      </option>
                                        <option>
                        XOF - West African CFA fra                      </option>
                                        <option>
                        GYD - Guyanese dollar                      </option>
                                        <option>
                        HKD - Hong Kong dollar                      </option>
                                        <option>
                        HNL - Honduran lempira                      </option>
                                        <option>
                        HRK - Croatian kuna                      </option>
                                        <option>
                        HTG - Haitian gourde                      </option>
                                        <option>
                        HUF - Hungarian forint                      </option>
                                        <option>
                        IDR - Indonesian rupiah                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        ILS - Israeli new shekel                      </option>
                                        <option>
                        GBP - British pound                      </option>
                                        <option>
                        INR - Indian rupee                      </option>
                                        <option>
                        IQD - Iraqi dinar                      </option>
                                        <option>
                        ISK - Icelandic króna                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        GBP - British pound                      </option>
                                        <option>
                        JMD - Jamaican dollar                      </option>
                                        <option>
                        JOD - Jordanian dinar                      </option>
                                        <option>
                        JPY - Japanese yen                      </option>
                                        <option>
                        KES - Kenyan shilling                      </option>
                                        <option>
                        KGS - Kyrgyzstani som                      </option>
                                        <option>
                        KHR - Cambodian riel                      </option>
                                        <option>
                        AUD - Australian dollar                      </option>
                                        <option>
                        KMF - Comorian franc                      </option>
                                        <option>
                        KWD - Kuwaiti dinar                      </option>
                                        <option>
                        KYD - Cayman Islands dolla                      </option>
                                        <option>
                        KZT - Kazakhstani tenge                      </option>
                                        <option>
                        LAK - Lao kip                      </option>
                                        <option>
                        LBP - Lebanese pound                      </option>
                                        <option>
                        XCD - East Caribbean dolla                      </option>
                                        <option>
                        CHF - Swiss franc                      </option>
                                        <option>
                        LKR - Sri Lankan rupee                      </option>
                                        <option>
                        LRD - Liberian dollar                      </option>
                                        <option>
                        LSL - Lesotho loti                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        MAD - Moroccan dirham                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        MDL - Moldovan leu                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        MGA - Malagasy ariary                      </option>
                                        <option>
                        USD - United States dollar                      </option>
                                        <option>
                        XOF - West African CFA fra                      </option>
                                        <option>
                        MMK - Burmese kyat                      </option>
                                        <option>
                        MNT - Mongolian tögrög                      </option>
                                        <option>
                        MRO - Mauritanian ouguiya                      </option>
                                        <option>
                        XCD - East Caribbean dolla                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        MUR - Mauritian rupee                      </option>
                                        <option>
                        MVR - Maldivian rufiyaa                      </option>
                                        <option>
                        MWK - Malawian kwacha                      </option>
                                        <option>
                        MXN - Mexican peso                      </option>
                                        <option>
                        MYR - Malaysian ringgit                      </option>
                                        <option>
                        MZN - Mozambican metical                      </option>
                                        <option>
                        NAD - Namibian dollar                      </option>
                                        <option>
                        XPF - CFP franc                      </option>
                                        <option>
                        XOF - West African CFA fra                      </option>
                                        <option>
                        NGN - Nigerian naira                      </option>
                                        <option>
                        NIO - Nicaraguan córdoba                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        NOK - Norwegian krone                      </option>
                                        <option>
                        NPR - Nepalese rupee                      </option>
                                        <option>
                        AUD - Australian dollar                      </option>
                                        <option>
                        NZD - New Zealand dollar                      </option>
                                        <option>
                        NZD - New Zealand dollar                      </option>
                                        <option>
                        OMR - Omani rial                      </option>
                                        <option>
                        PAB - Panamanian balboa                      </option>
                                        <option>
                        PEN - Peruvian nuevo sol                      </option>
                                        <option>
                        XPF - CFP franc                      </option>
                                        <option>
                        PGK - Papua New Guinean ki                      </option>
                                        <option>
                        PHP - Philippine peso                      </option>
                                        <option>
                        PKR - Pakistani rupee                      </option>
                                        <option>
                        PLN - Polish z?oty                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option selected="">
                         - Palauan dollar                      </option>
                                        <option>
                        PYG - Paraguayan guaraní                      </option>
                                        <option>
                        QAR - Qatari riyal                      </option>
                                        <option>
                        RON - Romanian leu                      </option>
                                        <option>
                        RSD - Serbian dinar                      </option>
                                        <option>
                        RUB - Russian ruble                      </option>
                                        <option>
                        RWF - Rwandan franc                      </option>
                                        <option>
                        SAR - Saudi riyal                      </option>
                                        <option>
                        SBD - Solomon Islands doll                      </option>
                                        <option>
                        SCR - Seychellois rupee                      </option>
                                        <option>
                        SDG - Sudanese pound                      </option>
                                        <option>
                        SEK - Swedish krona                      </option>
                                        <option>
                        BND - Brunei dollar                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        SLL - Sierra Leonean leone                      </option>
                                        <option>
                        EUR - Euro                      </option>
                                        <option>
                        XOF - West African CFA fra                      </option>
                                        <option>
                        SOS - Somali shilling                      </option>
                                        <option>
                        SRD - Surinamese dollar                      </option>
                                        <option>
                        USD - United States dollar                      </option>
                                        <option>
                        SZL - Swazi lilangeni                      </option>
                                        <option>
                        XAF - Central African CFA                       </option>
                                        <option>
                        XOF - West African CFA fra                      </option>
                                        <option>
                        THB - Thai baht                      </option>
                                        <option>
                        TJS - Tajikistani somoni                      </option>
                                        <option>
                        TMT - Turkmenistan manat                      </option>
                                        <option>
                        TND - Tunisian dinar                      </option>
                                        <option>
                        TOP - Tongan pa?anga                      </option>
                                        <option>
                        TRY - Turkish lira                      </option>
                                        <option>
                        TTD - Trinidad and Tobago                       </option>
                                        <option>
                        AUD - Australian dollar                      </option>
                                        <option>
                        TWD - New Taiwan dollar                      </option>
                                        <option>
                        UAH - Ukrainian hryvnia                      </option>
                                        <option>
                        UGX - Ugandan shilling                      </option>
                                        <option>
                        USD - United States dollar                      </option>
                                        <option>
                        UYU - Uruguayan peso                      </option>
                                        <option>
                        UZS - Uzbekistani som                      </option>
                                        <option>
                        VND - Vietnamese ??ng                      </option>
                                        <option>
                        VUV - Vanuatu vatu                      </option>
                                        <option>
                        XPF - CFP franc                      </option>
                                        <option>
                        WST - Samoan t?l?                      </option>
                                        <option>
                        YER - Yemeni rial                      </option>
                                        <option>
                        ZAR - South African rand                      </option>
                                        <option>
                        ZMW - Zambian kwacha                      </option>
                                        <option>
                        BWP - Botswana pula                      </option>
                                </select>
          </div>
          
          <div class="form-group hide">
            <label>City</label>
            <input type="text" class="form-control" name="city" value="">
          </div>

          <div class="form-group hide">
            <label>Postal / Zip code</label>
            <input type="text" class="form-control" name="postal_code" value="">
          </div>

          <div class="form-group hide">
            <label>Address 1</label>
            <textarea class="form-control" name="address1"></textarea>
          </div>

          <div class="form-group hide">
            <label>Address 2</label>
            <textarea class="form-control" name="address2"></textarea>
          </div>


          <input type="hidden" name="id" value="">
          <!-- csrf token -->
          <input type="hidden" name="csrf_test_name" value="068df1bcd3d2903a41d948503457ba0f">

          <hr>

          <div class="row m-t-30">
            <div class="col-sm-12">
                              <button type="submit" class="btn btn-info rounded pull-left"><i class="fa fa-check"></i> Save </button>
                          </div>
          </div>

        </form>
      </div>

      <div class="box-footer">

      </div>
    </div>


    
      <div class="list_area container">
      
                  <h3 class="box-title">All customers <a href="#" class="pull-right btn btn-info rounded btn-sm add_btn"><i class="fa fa-plus"></i> Add New Customer</a></h3>
        
        <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-20 p-0">
            <table class="table table-hover cushover ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Info</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                                  </tbody>
            </table>
        </div>

      </div>
    
  </section>
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>