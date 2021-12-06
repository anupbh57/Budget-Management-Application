<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.js"
    integrity="sha512-4WpSQe8XU6Djt8IPJMGD9Xx9KuYsVCEeitZfMhPi8xdYlVA5hzRitm0Nt1g2AZFS136s29Nq4E4NVvouVAVrBw=="
    crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
</head>

<body>

<?php 
  include 'assets/php/config.php';
  include 'assets/php/db.php';
    $host  = $_SERVER['HTTP_HOST'];

  if(mysqli_connect_error()) {
    echo "Connection To The Database Failed";
  } 

  $sql = "SELECT id, setting_name, setting_option FROM settings";
  $result = $connection_db->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) { 
        switch($row['id']) {
          case 1:
            $appname = $row['setting_option'];
          break;
          case 2:
            $footername = $row['setting_option'];
          break;
          case 3:
            $footertagline = $row['setting_option'];
          break;
          case 4:
            $country = $row['setting_option'];
          break;
          case 5:
            $currency = $row['setting_option'];
          break;
        }
      }
    } 

    $sql = "SELECT  username, email FROM user WHERE id = 1";
    $result = $connection_db->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) { 
        $dbausername = $row['username'];
        $dbaemail = $row['email'];
      }
    } 
    if(mysqli_connect_error()) {
      echo "Connection To The Database Failed";
    } 
    else {
      if (mysqli_query($connection_db, $sql)) {
    } 
    else {
      echo "There appears to be an error with the database. Please refer to the error below:";
      echo "Error: " . $sql . "<br>" . mysqli_error($connection_db);
    }
}
    $connection_db->close();



    //POST

    

    if (isset($_POST['sitename']) && isset($_POST['footername']) && isset($_POST['footertagline']) && isset($_POST['country']) && isset($_POST['currencyList'])) {
      $asitename = $_POST['sitename'];
      $afootername = $_POST['footername'];
      $afootertagline = $_POST['footertagline'];
      $acountry = $_POST['country'];
      $acurrencylist = $_POST['currencyList'];


      $connectionnew = new mysqli($host, $dbUsername, $dbPassword, $dbname);
      if(mysqli_connect_error()) {
      echo "Connection To The Database Failed";
    } 
    else {
      $sql1 = "UPDATE settings SET setting_option = '$asitename' WHERE id = '1'";
      $sql2 = "UPDATE settings SET setting_option = '$afootername' WHERE id = '2'";
      $sql3 = "UPDATE settings SET setting_option = '$afootertagline' WHERE id = '3'";
      $sql4 = "UPDATE settings SET setting_option = '$acountry' WHERE id = '4'";
      $sql5 = "UPDATE settings SET setting_option = '$acurrencylist' WHERE id = '5'";
      
    if (mysqli_query($connectionnew, $sql1) && mysqli_query($connectionnew, $sql2) && mysqli_query($connectionnew, $sql3) && mysqli_query($connectionnew, $sql4) && mysqli_query($connectionnew, $sql5)) {
  } 
    else {
      echo "There appears to be an error with the database. Please refer to the error below:";
      echo "Error: " . $sql . "<br>" . mysqli_error($connectionnew);
    }
  }
    $connectionnew->close();
  header("Refresh:0");

  }
  if (isset($_POST['emailaddress']) || isset($_POST['userpassword'])) {
  if ( !empty($_POST['emailaddress']) && !empty($_POST['userpassword']) ){
    $aemail = $_POST['emailaddress'];
    $apassword = password_hash($_POST['userpassword'], PASSWORD_DEFAULT);
    echo $apassword;
    $sql = "UPDATE user SET email = '$aemail', `password` = '$apassword' WHERE id = '$usrid'";
}

if ( !empty($_POST['emailaddress']) && empty($_POST['userpassword']) ){
    $aemail = $_POST['emailaddress'];
    $sql = "UPDATE user SET email = '$aemail' WHERE id = '$usrid'";
}

if ( empty($_POST['emailaddress']) && !empty($_POST['userpassword']) ){
    $apassword = password_hash($_POST['userpassword'], PASSWORD_DEFAULT);
    echo $apassword;
    $sql = "UPDATE user SET `password` = '$apassword' WHERE id = '$usrid'";
}
  include 'assets/php/db.php';
    if(mysqli_connect_error()) {
      echo "Connection To The Database Failed";
    } 
    else {
      if (mysqli_query($connection_db, $sql)) {
    } 
    else {
      echo "There appears to be an error with the database. Please refer to the error below:";
      echo "Error: " . $sql . "<br>" . mysqli_error($connection_db);
    }
}
  $connection_db->close();
}
?>





<header>
  <nav>
    <!-- Primary Navigation Starts-->
    <div class="navbar navbar-dark bg-dark nav justify-content-right" id="primary-nav">

      <ul class="left-primary list-group list-group-horizontal d-flex flex-row justify-content-center col-md-6"
        id="dp-m">
        <li class="list-group-item lf-p-li">App</li>
        <li class="list-group-item lf-p-li ml-3">Activity</li>
      </ul>

      <ul
                    class="right-primary list-group list-group-horizontal d-flex flex-row justify-content-center col-md-6">
                    <li class="list-group-item lf-p-li ml-3 dropdown"> 
                        <a id = "notification" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"  aria-expanded="false">
                        <i class="fal fa-bell"></i>
                        </a>
                    <div class="dropdown-menu" id = "nav-dp" aria-labelledby="notification">
                        <p>No new Notifications</p>
                    </div>
                </li>
                <li class="list-group-item lf-p-li ml-3"><i class="fal fa-ellipsis-v"></i></li>
                <li class="list-group-item lf-p-li">
                        <a class = "dropdown-toggle" type="button" id="usercontrl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fad fa-user-circle"></i> &nbsp;<?php echo $dbausername ?>
                        </a> 
                    
                    <div class="dropdown-menu" aria-labelledby="usercontrl">
                        <input type="hidden" name="logout">
                        <a class="dropdown-item" href="assets/php/user.php?logout">Logout</a>
                    </div>
                </li>

                    <li class="list-group-item lf-p-li"></li>
                </ul>
                
            </div>
    <!-- Primary Navigation Ends -->

    <!-- Secondary Navigation Starts -->
    <div class="navbar navbar-light bg-light nav justify-content-center navbar-expand-md" id="secondary-nav">
      <button class="navbar-toggler d-md-none d-sm-block" id="nav-btn" data-toggle="collapse" data-target="#coll-menu">
        <i class="fad fa-bars"></i>
      </button>
      <div id="coll-menu" class="collapse navbar-collapse navbar nav justify-content-right ">
        <ul class="sec-nav d-flex flex-row justify-content-center">
          <li class="list-group-item lf-p-li lf-s text-black-50"><a href = "index.php">Dashboard</a></li>
          <li class="list-group-item lf-p-li lf-s text-black-50"><a href = "">Settings</a></li>
          <li class="list-group-item lf-p-li lf-s text-black-50"><a href = "">Components</a></li>
          <li class="list-group-item lf-p-li lf-s text-black-50"><a href = "">Advanced</a></li>
          <li class="list-group-item lf-p-li lf-s text-black-50"><a href = "">Pages</a></li>
        </ul>
      </div>
    </div>
    <!-- Secondary Navigation Ends -->
  </nav>
</header>
<!--Header Ends-->

<div id="ad-main-container" class = "d-flex flex-row justify-content-center">
  <div id="ad-side-left" class = "">
   <ul class = "list-group ad-list-menu">
     <li class="list-group-item ad-list-item" onclick = "settingController('basicform','securityform','userform')">Basic Settings</li>
     <li class="list-group-item ad-list-item" onclick = "settingController('securityform','basicform','userform')">Security Settings</li>
     <li class="list-group-item ad-list-item" onclick = "settingController('userform','basicform','securityform')">User Settings</li>
   </ul>
  </div>
  <div id="ad-side-right" class = "">

    <form action="" class = "form" id = "basicform" method = "POST">
      <h3>Basic Settings</h3>
      <label for = "sitename">Application Name</label>
      <input type="text" class="form-control" placeholder="Prototype" name="sitename" id = "ad-bf-appname" required>
      <label for = "footername">Footer Name</label>
      <input type="text" class="form-control" placeholder="Author Name" name="footername" id = "ad-bf-ftname" required>
      <label for = "footertagline">Footer Tagline</label>
      <input type="text" class="form-control" placeholder="Designed and Coded with Love" name="footertagline" id = "ad-bf-fttag"required>
      <label  for="country">Country</label>
      <select id= "ad-bf-country" name="country" class="custom-select">
        <option value="Afganistan">Afghanistan</option>
        <option value="Albania">Albania</option>
        <option value="Algeria">Algeria</option>
        <option value="American Samoa">American Samoa</option>
        <option value="Andorra">Andorra</option>
        <option value="Angola">Angola</option>
        <option value="Anguilla">Anguilla</option>
        <option value="Antigua & Barbuda">Antigua & Barbuda</option>
        <option value="Argentina">Argentina</option>
        <option value="Armenia">Armenia</option>
        <option value="Aruba">Aruba</option>
        <option value="Australia">Australia</option>
        <option value="Austria">Austria</option>
        <option value="Azerbaijan">Azerbaijan</option>
        <option value="Bahamas">Bahamas</option>
        <option value="Bahrain">Bahrain</option>
        <option value="Bangladesh">Bangladesh</option>
        <option value="Barbados">Barbados</option>
        <option value="Belarus">Belarus</option>
        <option value="Belgium">Belgium</option>
        <option value="Belize">Belize</option>
        <option value="Benin">Benin</option>
        <option value="Bermuda">Bermuda</option>
        <option value="Bhutan">Bhutan</option>
        <option value="Bolivia">Bolivia</option>
        <option value="Bonaire">Bonaire</option>
        <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
        <option value="Botswana">Botswana</option>
        <option value="Brazil">Brazil</option>
        <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
        <option value="Brunei">Brunei</option>
        <option value="Bulgaria">Bulgaria</option>
        <option value="Burkina Faso">Burkina Faso</option>
        <option value="Burundi">Burundi</option>
        <option value="Cambodia">Cambodia</option>
        <option value="Cameroon">Cameroon</option>
        <option value="Canada">Canada</option>
        <option value="Canary Islands">Canary Islands</option>
        <option value="Cape Verde">Cape Verde</option>
        <option value="Cayman Islands">Cayman Islands</option>
        <option value="Central African Republic">Central African Republic</option>
        <option value="Chad">Chad</option>
        <option value="Channel Islands">Channel Islands</option>
        <option value="Chile">Chile</option>
        <option value="China">China</option>
        <option value="Christmas Island">Christmas Island</option>
        <option value="Cocos Island">Cocos Island</option>
        <option value="Colombia">Colombia</option>
        <option value="Comoros">Comoros</option>
        <option value="Congo">Congo</option>
        <option value="Cook Islands">Cook Islands</option>
        <option value="Costa Rica">Costa Rica</option>
        <option value="Cote DIvoire">Cote DIvoire</option>
        <option value="Croatia">Croatia</option>
        <option value="Cuba">Cuba</option>
        <option value="Curaco">Curacao</option>
        <option value="Cyprus">Cyprus</option>
        <option value="Czech Republic">Czech Republic</option>
        <option value="Denmark">Denmark</option>
        <option value="Djibouti">Djibouti</option>
        <option value="Dominica">Dominica</option>
        <option value="Dominican Republic">Dominican Republic</option>
        <option value="East Timor">East Timor</option>
        <option value="Ecuador">Ecuador</option>
        <option value="Egypt">Egypt</option>
        <option value="El Salvador">El Salvador</option>
        <option value="Equatorial Guinea">Equatorial Guinea</option>
        <option value="Eritrea">Eritrea</option>
        <option value="Estonia">Estonia</option>
        <option value="Ethiopia">Ethiopia</option>
        <option value="Falkland Islands">Falkland Islands</option>
        <option value="Faroe Islands">Faroe Islands</option>
        <option value="Fiji">Fiji</option>
        <option value="Finland">Finland</option>
        <option value="France">France</option>
        <option value="French Guiana">French Guiana</option>
        <option value="French Polynesia">French Polynesia</option>
        <option value="French Southern Ter">French Southern Ter</option>
        <option value="Gabon">Gabon</option>
        <option value="Gambia">Gambia</option>
        <option value="Georgia">Georgia</option>
        <option value="Germany">Germany</option>
        <option value="Ghana">Ghana</option>
        <option value="Gibraltar">Gibraltar</option>
        <option value="Great Britain">Great Britain</option>
        <option value="Greece">Greece</option>
        <option value="Greenland">Greenland</option>
        <option value="Grenada">Grenada</option>
        <option value="Guadeloupe">Guadeloupe</option>
        <option value="Guam">Guam</option>
        <option value="Guatemala">Guatemala</option>
        <option value="Guinea">Guinea</option>
        <option value="Guyana">Guyana</option>
        <option value="Haiti">Haiti</option>
        <option value="Hawaii">Hawaii</option>
        <option value="Honduras">Honduras</option>
        <option value="Hong Kong">Hong Kong</option>
        <option value="Hungary">Hungary</option>
        <option value="Iceland">Iceland</option>
        <option value="Indonesia">Indonesia</option>
        <option value="India">India</option>
        <option value="Iran">Iran</option>
        <option value="Iraq">Iraq</option>
        <option value="Ireland">Ireland</option>
        <option value="Isle of Man">Isle of Man</option>
        <option value="Israel">Israel</option>
        <option value="Italy">Italy</option>
        <option value="Jamaica">Jamaica</option>
        <option value="Japan">Japan</option>
        <option value="Jordan">Jordan</option>
        <option value="Kazakhstan">Kazakhstan</option>
        <option value="Kenya">Kenya</option>
        <option value="Kiribati">Kiribati</option>
        <option value="Korea North">Korea North</option>
        <option value="Korea Sout">Korea South</option>
        <option value="Kuwait">Kuwait</option>
        <option value="Kyrgyzstan">Kyrgyzstan</option>
        <option value="Laos">Laos</option>
        <option value="Latvia">Latvia</option>
        <option value="Lebanon">Lebanon</option>
        <option value="Lesotho">Lesotho</option>
        <option value="Liberia">Liberia</option>
        <option value="Libya">Libya</option>
        <option value="Liechtenstein">Liechtenstein</option>
        <option value="Lithuania">Lithuania</option>
        <option value="Luxembourg">Luxembourg</option>
        <option value="Macau">Macau</option>
        <option value="Macedonia">Macedonia</option>
        <option value="Madagascar">Madagascar</option>
        <option value="Malaysia">Malaysia</option>
        <option value="Malawi">Malawi</option>
        <option value="Maldives">Maldives</option>
        <option value="Mali">Mali</option>
        <option value="Malta">Malta</option>
        <option value="Marshall Islands">Marshall Islands</option>
        <option value="Martinique">Martinique</option>
        <option value="Mauritania">Mauritania</option>
        <option value="Mauritius">Mauritius</option>
        <option value="Mayotte">Mayotte</option>
        <option value="Mexico">Mexico</option>
        <option value="Midway Islands">Midway Islands</option>
        <option value="Moldova">Moldova</option>
        <option value="Monaco">Monaco</option>
        <option value="Mongolia">Mongolia</option>
        <option value="Montserrat">Montserrat</option>
        <option value="Morocco">Morocco</option>
        <option value="Mozambique">Mozambique</option>
        <option value="Myanmar">Myanmar</option>
        <option value="Nambia">Nambia</option>
        <option value="Nauru">Nauru</option>
        <option value="Nepal">Nepal</option>
        <option value="Netherland Antilles">Netherland Antilles</option>
        <option value="Netherlands">Netherlands (Holland, Europe)</option>
        <option value="Nevis">Nevis</option>
        <option value="New Caledonia">New Caledonia</option>
        <option value="New Zealand">New Zealand</option>
        <option value="Nicaragua">Nicaragua</option>
        <option value="Niger">Niger</option>
        <option value="Nigeria">Nigeria</option>
        <option value="Niue">Niue</option>
        <option value="Norfolk Island">Norfolk Island</option>
        <option value="Norway">Norway</option>
        <option value="Oman">Oman</option>
        <option value="Pakistan">Pakistan</option>
        <option value="Palau Island">Palau Island</option>
        <option value="Palestine">Palestine</option>
        <option value="Panama">Panama</option>
        <option value="Papua New Guinea">Papua New Guinea</option>
        <option value="Paraguay">Paraguay</option>
        <option value="Peru">Peru</option>
        <option value="Phillipines">Philippines</option>
        <option value="Pitcairn Island">Pitcairn Island</option>
        <option value="Poland">Poland</option>
        <option value="Portugal">Portugal</option>
        <option value="Puerto Rico">Puerto Rico</option>
        <option value="Qatar">Qatar</option>
        <option value="Republic of Montenegro">Republic of Montenegro</option>
        <option value="Republic of Serbia">Republic of Serbia</option>
        <option value="Reunion">Reunion</option>
        <option value="Romania">Romania</option>
        <option value="Russia">Russia</option>
        <option value="Rwanda">Rwanda</option>
        <option value="St Barthelemy">St Barthelemy</option>
        <option value="St Eustatius">St Eustatius</option>
        <option value="St Helena">St Helena</option>
        <option value="St Kitts-Nevis">St Kitts-Nevis</option>
        <option value="St Lucia">St Lucia</option>
        <option value="St Maarten">St Maarten</option>
        <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
        <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
        <option value="Saipan">Saipan</option>
        <option value="Samoa">Samoa</option>
        <option value="Samoa American">Samoa American</option>
        <option value="San Marino">San Marino</option>
        <option value="Sao Tome & Principe">Sao Tome & Principe</option>
        <option value="Saudi Arabia">Saudi Arabia</option>
        <option value="Senegal">Senegal</option>
        <option value="Seychelles">Seychelles</option>
        <option value="Sierra Leone">Sierra Leone</option>
        <option value="Singapore">Singapore</option>
        <option value="Slovakia">Slovakia</option>
        <option value="Slovenia">Slovenia</option>
        <option value="Solomon Islands">Solomon Islands</option>
        <option value="Somalia">Somalia</option>
        <option value="South Africa">South Africa</option>
        <option value="Spain">Spain</option>
        <option value="Sri Lanka">Sri Lanka</option>
        <option value="Sudan">Sudan</option>
        <option value="Suriname">Suriname</option>
        <option value="Swaziland">Swaziland</option>
        <option value="Sweden">Sweden</option>
        <option value="Switzerland">Switzerland</option>
        <option value="Syria">Syria</option>
        <option value="Tahiti">Tahiti</option>
        <option value="Taiwan">Taiwan</option>
        <option value="Tajikistan">Tajikistan</option>
        <option value="Tanzania">Tanzania</option>
        <option value="Thailand">Thailand</option>
        <option value="Togo">Togo</option>
        <option value="Tokelau">Tokelau</option>
        <option value="Tonga">Tonga</option>
        <option value="Trinidad & Tobago">Trinidad & Tobago</option>
        <option value="Tunisia">Tunisia</option>
        <option value="Turkey">Turkey</option>
        <option value="Turkmenistan">Turkmenistan</option>
        <option value="Turks & Caicos Is">Turks & Caicos Is</option>
        <option value="Tuvalu">Tuvalu</option>
        <option value="Uganda">Uganda</option>
        <option value="United Kingdom">United Kingdom</option>
        <option value="Ukraine">Ukraine</option>
        <option value="United Arab Erimates">United Arab Emirates</option>
        <option value="United States of America">United States of America</option>
        <option value="Uraguay">Uruguay</option>
        <option value="Uzbekistan">Uzbekistan</option>
        <option value="Vanuatu">Vanuatu</option>
        <option value="Vatican City State">Vatican City State</option>
        <option value="Venezuela">Venezuela</option>
        <option value="Vietnam">Vietnam</option>
        <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
        <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
        <option value="Wake Island">Wake Island</option>
        <option value="Wallis & Futana Is">Wallis & Futana Is</option>
        <option value="Yemen">Yemen</option>
        <option value="Zaire">Zaire</option>
        <option value="Zambia">Zambia</option>
        <option value="Zimbabwe">Zimbabwe</option>
      </select>
      <label for = "currencyList">Currency</label>
      <select id = "ad-bf-currencylist" name = "currencyList" class="custom-select">
        <option value="USD" selected="selected" label="US dollar">USD</option>
        <option value="EUR" label="Euro">EUR</option>
        <option value="JPY" label="Japanese yen">JPY</option>
        <option value="GBP" label="Pound sterling">GBP</option>
        <option disabled>──────────</option>
        <option value="AED" label="United Arab Emirates dirham">AED</option>
        <option value="AFN" label="Afghan afghani">AFN</option>
        <option value="ALL" label="Albanian lek">ALL</option>
        <option value="AMD" label="Armenian dram">AMD</option>
        <option value="ANG" label="Netherlands Antillean guilder">ANG</option>
        <option value="AOA" label="Angolan kwanza">AOA</option>
        <option value="ARS" label="Argentine peso">ARS</option>
        <option value="AUD" label="Australian dollar">AUD</option>
        <option value="AWG" label="Aruban florin">AWG</option>
        <option value="AZN" label="Azerbaijani manat">AZN</option>
        <option value="BAM" label="Bosnia and Herzegovina convertible mark">BAM</option>
        <option value="BBD" label="Barbadian dollar">BBD</option>
        <option value="BDT" label="Bangladeshi taka">BDT</option>
        <option value="BGN" label="Bulgarian lev">BGN</option>
        <option value="BHD" label="Bahraini dinar">BHD</option>
        <option value="BIF" label="Burundian franc">BIF</option>
        <option value="BMD" label="Bermudian dollar">BMD</option>
        <option value="BND" label="Brunei dollar">BND</option>
        <option value="BOB" label="Bolivian boliviano">BOB</option>
        <option value="BRL" label="Brazilian real">BRL</option>
        <option value="BSD" label="Bahamian dollar">BSD</option>
        <option value="BTN" label="Bhutanese ngultrum">BTN</option>
        <option value="BWP" label="Botswana pula">BWP</option>
        <option value="BYN" label="Belarusian ruble">BYN</option>
        <option value="BZD" label="Belize dollar">BZD</option>
        <option value="CAD" label="Canadian dollar">CAD</option>
        <option value="CDF" label="Congolese franc">CDF</option>
        <option value="CHF" label="Swiss franc">CHF</option>
        <option value="CLP" label="Chilean peso">CLP</option>
        <option value="CNY" label="Chinese yuan">CNY</option>
        <option value="COP" label="Colombian peso">COP</option>
        <option value="CRC" label="Costa Rican colón">CRC</option>
        <option value="CUC" label="Cuban convertible peso">CUC</option>
        <option value="CUP" label="Cuban peso">CUP</option>
        <option value="CVE" label="Cape Verdean escudo">CVE</option>
        <option value="CZK" label="Czech koruna">CZK</option>
        <option value="DJF" label="Djiboutian franc">DJF</option>
        <option value="DKK" label="Danish krone">DKK</option>
        <option value="DOP" label="Dominican peso">DOP</option>
        <option value="DZD" label="Algerian dinar">DZD</option>
        <option value="EGP" label="Egyptian pound">EGP</option>
        <option value="ERN" label="Eritrean nakfa">ERN</option>
        <option value="ETB" label="Ethiopian birr">ETB</option>
        <option value="EUR" label="EURO">EUR</option>
        <option value="FJD" label="Fijian dollar">FJD</option>
        <option value="FKP" label="Falkland Islands pound">FKP</option>
        <option value="GBP" label="British pound">GBP</option>
        <option value="GEL" label="Georgian lari">GEL</option>
        <option value="GGP" label="Guernsey pound">GGP</option>
        <option value="GHS" label="Ghanaian cedi">GHS</option>
        <option value="GIP" label="Gibraltar pound">GIP</option>
        <option value="GMD" label="Gambian dalasi">GMD</option>
        <option value="GNF" label="Guinean franc">GNF</option>
        <option value="GTQ" label="Guatemalan quetzal">GTQ</option>
        <option value="GYD" label="Guyanese dollar">GYD</option>
        <option value="HKD" label="Hong Kong dollar">HKD</option>
        <option value="HNL" label="Honduran lempira">HNL</option>
        <option value="HKD" label="Hong Kong dollar">HKD</option>
        <option value="HRK" label="Croatian kuna">HRK</option>
        <option value="HTG" label="Haitian gourde">HTG</option>
        <option value="HUF" label="Hungarian forint">HUF</option>
        <option value="IDR" label="Indonesian rupiah">IDR</option>
        <option value="ILS" label="Israeli new shekel">ILS</option>
        <option value="IMP" label="Manx pound">IMP</option>
        <option value="INR" label="Indian rupee">INR</option>
        <option value="IQD" label="Iraqi dinar">IQD</option>
        <option value="IRR" label="Iranian rial">IRR</option>
        <option value="ISK" label="Icelandic króna">ISK</option>
        <option value="JEP" label="Jersey pound">JEP</option>
        <option value="JMD" label="Jamaican dollar">JMD</option>
        <option value="JOD" label="Jordanian dinar">JOD</option>
        <option value="JPY" label="Japanese yen">JPY</option>
        <option value="KES" label="Kenyan shilling">KES</option>
        <option value="KGS" label="Kyrgyzstani som">KGS</option>
        <option value="KHR" label="Cambodian riel">KHR</option>
        <option value="KID" label="Kiribati dollar">KID</option>
        <option value="KMF" label="Comorian franc">KMF</option>
        <option value="KPW" label="North Korean won">KPW</option>
        <option value="KRW" label="South Korean won">KRW</option>
        <option value="KWD" label="Kuwaiti dinar">KWD</option>
        <option value="KYD" label="Cayman Islands dollar">KYD</option>
        <option value="KZT" label="Kazakhstani tenge">KZT</option>
        <option value="LAK" label="Lao kip">LAK</option>
        <option value="LBP" label="Lebanese pound">LBP</option>
        <option value="LKR" label="Sri Lankan rupee">LKR</option>
        <option value="LRD" label="Liberian dollar">LRD</option>
        <option value="LSL" label="Lesotho loti">LSL</option>
        <option value="LYD" label="Libyan dinar">LYD</option>
        <option value="MAD" label="Moroccan dirham">MAD</option>
        <option value="MDL" label="Moldovan leu">MDL</option>
        <option value="MGA" label="Malagasy ariary">MGA</option>
        <option value="MKD" label="Macedonian denar">MKD</option>
        <option value="MMK" label="Burmese kyat">MMK</option>
        <option value="MNT" label="Mongolian tögrög">MNT</option>
        <option value="MOP" label="Macanese pataca">MOP</option>
        <option value="MRU" label="Mauritanian ouguiya">MRU</option>
        <option value="MUR" label="Mauritian rupee">MUR</option>
        <option value="MVR" label="Maldivian rufiyaa">MVR</option>
        <option value="MWK" label="Malawian kwacha">MWK</option>
        <option value="MXN" label="Mexican peso">MXN</option>
        <option value="MYR" label="Malaysian ringgit">MYR</option>
        <option value="MZN" label="Mozambican metical">MZN</option>
        <option value="NAD" label="Namibian dollar">NAD</option>
        <option value="NGN" label="Nigerian naira">NGN</option>
        <option value="NIO" label="Nicaraguan córdoba">NIO</option>
        <option value="NOK" label="Norwegian krone">NOK</option>
        <option value="NPR" label="Nepalese rupee">NPR</option>
        <option value="NZD" label="New Zealand dollar">NZD</option>
        <option value="OMR" label="Omani rial">OMR</option>
        <option value="PAB" label="Panamanian balboa">PAB</option>
        <option value="PEN" label="Peruvian sol">PEN</option>
        <option value="PGK" label="Papua New Guinean kina">PGK</option>
        <option value="PHP" label="Philippine peso">PHP</option>
        <option value="PKR" label="Pakistani rupee">PKR</option>
        <option value="PLN" label="Polish złoty">PLN</option>
        <option value="PRB" label="Transnistrian ruble">PRB</option>
        <option value="PYG" label="Paraguayan guaraní">PYG</option>
        <option value="QAR" label="Qatari riyal">QAR</option>
        <option value="RON" label="Romanian leu">RON</option>
        <option value="RON" label="Romanian leu">RON</option>
        <option value="RSD" label="Serbian dinar">RSD</option>
        <option value="RUB" label="Russian ruble">RUB</option>
        <option value="RWF" label="Rwandan franc">RWF</option>
        <option value="SAR" label="Saudi riyal">SAR</option>
        <option value="SEK" label="Swedish krona">SEK</option>
        <option value="SGD" label="Singapore dollar">SGD</option>
        <option value="SHP" label="Saint Helena pound">SHP</option>
        <option value="SLL" label="Sierra Leonean leone">SLL</option>
        <option value="SLS" label="Somaliland shilling">SLS</option>
        <option value="SOS" label="Somali shilling">SOS</option>
        <option value="SRD" label="Surinamese dollar">SRD</option>
        <option value="SSP" label="South Sudanese pound">SSP</option>
        <option value="STN" label="São Tomé and Príncipe dobra">STN</option>
        <option value="SYP" label="Syrian pound">SYP</option>
        <option value="SZL" label="Swazi lilangeni">SZL</option>
        <option value="THB" label="Thai baht">THB</option>
        <option value="TJS" label="Tajikistani somoni">TJS</option>
        <option value="TMT" label="Turkmenistan manat">TMT</option>
        <option value="TND" label="Tunisian dinar">TND</option>
        <option value="TOP" label="Tongan paʻanga">TOP</option>
        <option value="TRY" label="Turkish lira">TRY</option>
        <option value="TTD" label="Trinidad and Tobago dollar">TTD</option>
        <option value="TVD" label="Tuvaluan dollar">TVD</option>
        <option value="TWD" label="New Taiwan dollar">TWD</option>
        <option value="TZS" label="Tanzanian shilling">TZS</option>
        <option value="UAH" label="Ukrainian hryvnia">UAH</option>
        <option value="UGX" label="Ugandan shilling">UGX</option>
        <option value="USD" label="United States dollar">USD</option>
        <option value="UYU" label="Uruguayan peso">UYU</option>
        <option value="UZS" label="Uzbekistani soʻm">UZS</option>
        <option value="VES" label="Venezuelan bolívar soberano">VES</option>
        <option value="VND" label="Vietnamese đồng">VND</option>
        <option value="VUV" label="Vanuatu vatu">VUV</option>
        <option value="WST" label="Samoan tālā">WST</option>
        <option value="XAF" label="Central African CFA franc">XAF</option>
        <option value="XCD" label="Eastern Caribbean dollar">XCD</option>
        <option value="XOF" label="West African CFA franc">XOF</option>
        <option value="XPF" label="CFP franc">XPF</option>
        <option value="ZAR" label="South African rand">ZAR</option>
        <option value="ZMW" label="Zambian kwacha">ZMW</option>
        <option value="ZWB" label="Zimbabwean bonds">ZWB</option>
      </select>

      <button class = "ad-save-btn" type = "submit">Save <i class="fad fa-save"></i></button>
    </form>



    <!-- Security Settings -->
    
    <form action="" class="form" id="securityform">
      <h3>Security Settings</h3>
      <label for="sitename">Application Name</label>
      <input type="text" class="form-control" placeholder="Prototype" name="sitename" id = "ad-sf-name"required>
      <label for="footername">Footer Name</label>
      <input type="text" class="form-control" placeholder="Anup Bhandari" name="footername" id = "ad-sf-ftname" required>
      <label for="footertagline">Footer Tagline</label>
      <input type="text" class="form-control" placeholder="Designed and Coded with Love" name="footertagline" id = "ad-sf-ftname" required>
      
    
      <button class="ad-save-btn">Save <i class="fad fa-save"></i></button>
    </form>

    <!-- User Settings -->

    <form action="" class="form" id="userform" method = "POST" target="_self">
      <h3>User Settings</h3>
      <label for="sitename">User Name</label>
      <input type="text" class="form-control" name="username" id = "ad-uf-username" readonly>
      <label for="footername">Email address</label>
      <input type="text" class="form-control" name="emailaddress" id = "ad-uf-email" >
      <label for="footertagline">New Password</label>
      <input type="password" class="form-control"  name="userpassword" id= "userpassword" autocomplete="off">
    <button class="ad-save-btn"  type = "submit">Save <i class="fad fa-save"></i></button>
    
    </form>
      


  </div>
</div>



<footer class="container-fluid footer d-flex flex-column justify-content-center ad-main-footer">
  <h3 class="col-12 ft-title text-center">Thank you for using the App. Need any help?</h3>
  <div class="container-fluid d-flex flex-row justify-content-center">
    <div class="row d-flex flex-row justify-content-center ft-b-group" role="group" aria-label="Basic example">
      <button class="col-sm-4 ft-btn">Report Problem</button>
      <button class="col-sm-4 ft-btn"><a href = "https://www.linkedin.com/in/anupbh/">Find Me Here</a></button>
    </div>
  </div>
</footer>

<div class="bottom-footer bg-dark text-white-50 d-flex flex-row justify-content-center text-center">
  &copy; 2020 Copyright <?php echo $iusername ?> - <?php echo $itagline ?> 
</div>
<iframe class="d-none" id = "formtarget"></iframe>

<script type = "text/javascript">

  document.getElementById('ad-bf-appname').value = "<?php echo $appname ?>";
  document.getElementById('ad-bf-ftname').value = "<?php echo $footername ?>";
  document.getElementById('ad-bf-fttag').value = "<?php echo $footertagline ?>";
  document.getElementById('ad-bf-country').value = "<?php echo $country ?>";
  document.getElementById('ad-bf-currencylist').value = "<?php echo $currency ?>";
  document.getElementById('ad-uf-username').value = "<?php echo $dbausername ?>";
  document.getElementById('ad-uf-email').value = "<?php echo $dbaemail ?>";

</script>


</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"
  integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
  <script src="assets/js/1351.js"></script>
  <script type="text/javascript" src="assets/js/buttonevents.js"></script>
  <script type="text/javascript" src="assets/js/formvalidator.js"></script>
  </html>