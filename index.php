<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Manager</title>
    <script src="assets/js/1351.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.js" 
    integrity="sha512-4WpSQe8XU6Djt8IPJMGD9Xx9KuYsVCEeitZfMhPi8xdYlVA5hzRitm0Nt1g2AZFS136s29Nq4E4NVvouVAVrBw==" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel = "stylesheet" href="https://nightly.datatables.net/css/dataTables.bootstrap4.min.css" >
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="assets/export/src/tableHTMLExport.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.10/jspdf.plugin.autotable.min.js"></script>
</head>

<body>
    <?php include 'assets/php/config.php'; 
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
                <button class="navbar-toggler d-md-none d-sm-block" id="nav-btn" data-toggle="collapse"
                    data-target="#coll-menu">
                    <i class="fad fa-bars"></i>
                </button>
                <div id="coll-menu" class="collapse navbar-collapse navbar nav justify-content-right ">
                    <ul class="sec-nav d-flex flex-row justify-content-center">
                        <li class="list-group-item lf-p-li lf-s text-black-50"><a href = "index.php">Dashboard</a></li>
                        <li class="list-group-item lf-p-li lf-s text-black-50"><a href = "admin.php">Settings </a></li>
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


    <!--Main Container Starts-->
    <div id="main-container">

        <!--Top Setting Bar Starts-->
        <div class="top-panel d-flex flex-row justify-content-between">
            <h4 class="db-title">Dashboard</h3>


                <div class="dropdown">
                    <button class="btn btn-primary" type="button" id="dropdown-m" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fal fa-cog"></i>
                        &nbsp;Settings &nbsp;<i class="far fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-m">
                        <a class="dropdown-item" href="index">Application Preferences</a>
                        <a class="dropdown-item" href="admin.php">Admin Settings</a>
                    </div>
                </div>
        </div>
        <!--Top Setting Bar Starts-->

        <?php
            function dbquery($type) {
            require 'assets/php/db.php';

            if(mysqli_connect_error()) {
            echo "Connection To The Database Failed";
            } 

            $sql = "SELECT SUM(amount) as total FROM records WHERE `type` = '$type'";
            $result = $connection_db->query($sql);
            $row = $result->fetch_assoc();
            return $row['total'];
            $connection_db->close();                    
            }
        ?>

        <!--Card Deck Starts-->
        <div class="container" id="panels-container">

            <div class="row d-flex flex-row justify-content-center" id="info-cards">
                <!-- Income -->
                <div class="card crd-1 text-white border-0 col-md-4 col-xs-6">
                    <div class="card-body">
                        <h4 class="crd-t">Income</h4>
                        <h3 class="font-weight-bolder crd-b float-right"><span class = "currency-i"><?php echo $icurrency ?></span><?php echo dbquery(0) ?></h3>
                    </div>
                    <div class="card-inc mb-2 mr-2"><span class="badge badge-danger cd-bdg">-20%</span> From Last Month
                    </div>
                    <button class="card-footer align-items-center border-0 text-white font-weight-bolder crd-ft"
                        onclick="incEvent('type-selector')">
                        Add a new income
                    </button>
                </div>

                <!-- Balance -->
                <div class="card crd-3 text-white border-0 col-md-3 col-xs-6">

                    <div class="card-body">
                        <h4 class="crd-t">Balance</h4>
                        <h3 class="font-weight-bolder crd-b float-right"><span class = "currency-i"><?php echo $icurrency ?></span><?php echo (double)str_replace(',','',dbquery(0))-(double)str_replace(',','',dbquery(1)) ?></h3>
                    </div>
                    <div class="card-inc mb-3 mr-2"><span class="badge badge-success cd-bdg">20%</span> From Last Month
                    </div>
                    <button class="card-footer align-items-center border-0 text-white font-weight-bolder crd-ft">
                        View Summary
                    </button>
                </div>

                <!-- Expense -->
                <div class="card crd-2 text-white border-0 col-md-4 col-xs-6">
                    <div class="card-body">
                        <h4 class="crd-t">Expense</h4>
                        <h3 class="font-weight-bolder crd-b float-right"><span class = "currency-i"><?php echo $icurrency ?></span><?php echo dbquery(1) ?></h3>
                    </div>
                    <div class="card-inc mb-3 mr-2"><span class="badge badge-success cd-bdg">-10%</span> From Last Month
                    </div>
                    <button class="card-footer align-items-center border-0 text-white font-weight-bolder crd-ft"
                        onclick="expEvent('type-selector');">
                        Add a new expense
                    </button>
                </div>

            </div>
        </div>
        <!--Card Deck Ends-->

        <!--Input Area Starts-->

        <div id="input-area" class="bg-light">
            <form name="f-form" id="f-form" method="POST" action="assets/php/engine.php" target = "formtarget">
                <div class="row d-flex flex-row justify-content-center form-inline input-group-lg in-fr" >
                    <input type="date" class="form-control" id="f-date" name="d-date" required>
                    <input type="text" class="form-control" id="f-title" name="d-title" placeholder="Title" required>
                    <input type="number" class="form-control" id="f-amount" name="d-amount" placeholder="Amount"
                        required>
                </div>

                <div class="row d-flex flex-row justify-content-center form-inline input-group-lg in-fr">
                    <input type="text" class="form-control" placeholder="Description" name="d-description" required>

                    <select name = "selected" id="select-inc" class="custom-select">
                        <option value="uncategorized">Uncategorized</option>
                        <option value="gift">Gift</option>
                        <option value="salary">Salary</option>
                        <option value="business income">Business Income</option>
                        <option value="saving">Saving</option>
                        <option value="others">Others</option>
                    </select>


                    <select name = "hidden" id="select-exp" class="custom-select">
                        <option value="uncategorized">Uncategorized</option>
                        <option value="shopping">Shopping</option>
                        <option value="food and groceries">Food and Groceries</option>
                        <option value="transportation">Transportation</option>
                        <option value="bills and payments">Bills and Payments</option>
                        <option value="others">Others</option>
                    </select>
                </div>

                <div class="row d-flex flex-row justify-content-center form-inline" id="sub-control">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input t-sel" id="type-selector" name="d-switch"
                            value="expense" onclick = "switchListener('type-selector','select-inc','select-exp') ">
                        <label for="type-selector" class="custom-control-label t-leb">Expense?</label>
                    </div>
                    <button class="submit-btn" onclick="validator();">Add Record</button>
                </div>
            </form>
        </div>
        <!--Input Area Ends-->
        <div id="table-top-wrapper" class="d-flex flex-row justify-content-between row">
                <h3 id="r-title">Records</h3>
                <button class="navbar-toggler bg-fn bg-fn-1" id="nav-btn" data-toggle="collapse"
                    data-target="#export-group">Export
                </button>
        </div>
            <div class="button-container btn-group-sm collapse" id = "export-group" role="group">
                    <button class="bg-fn bg-fn-1" id = "dwnjson"><i class="fab fa-js"></i>&nbsp;<span>JSON</span></button>
                    <button class="bg-fn bg-fn-2" id = "dwncsv"><i class="fad fa-file-csv"></i>&nbsp;<span>CSV</span></button>
                    <button class="bg-fn bg-fn-3" id = "dwnpdf"><i class="fad fa-file-pdf"></i>&nbsp;<span>PDF</span></button>
                </div>  
        <div id="table-wrapper">
        
      

    <div class="table-responsive">
        <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
        <?php
            require 'assets/php/db.php';

            if(mysqli_connect_error()) {
            echo "Connection To The Database Failed";
            } 

            if (isset($sortf)) {
            echo $sortf;
            }

            if (isset($displayf)) {
            echo $displayf;
            }

            $sql = "SELECT id, `date`, title, amount, `description`, category, `type` FROM records";
            $result = $connection_db->query($sql);
            if ($result->num_rows > 0) {
            // output data of each row
            $vid = 1;
            while($row = $result->fetch_assoc()) { 
            if ($row["type"] == 1) {
                $class = "tp-exp";
            } 
            else if ($row["type"] == 0) {
            $class = "tp-inc";
            }
                echo "<tr class = \"$class\"> <td> 
                    <div class = \"tb-icon\">
                    <i class=\"fal fa-edit i-fn-1\" onclick = \" editData(". $row["id"] ."," . $row["type"] .")\"></i>
                    <i class=\"fal fa-trash i-fn-2\"onclick = \" deleteRow(". $row["id"] .")\"></i>
                    </div>

                    </td> <td>" .$vid. "</td><td>" . $row["date"]. "</td><td>" . $row["title"] . "</td><td>"
                    . $row["amount"]. "</td><td>" . $row["description"] . "</td><td>" . $row["category"] . "</td></tr>";
                    $vid++;
                }
            } 
                $connection_db->close();                    
        ?>
                            
                        </tbody>
                </table>
            </div>
        </div>
    </div>    

    <!-- Modal Boxes -->

<button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#deletemodal">
  Launch demo modal
</button>


<div class="modal fade" id="successmodal" tabindex="-1" role="dialog"              aria-labelledby="successmodal"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title text-center" id="exampleModal3Label">Record added successfully</h5>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-block" data-dismiss="modal" id = "sm-btn" onclick = "location.reload()" >Close</button>
                </div>
            </div>
        </div>
</div>

<div class="modal fade" id="edsuccessmodal" tabindex="-1" role="dialog"              aria-labelledby="edsuccessmodal"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title text-center" id="exampleModal3Label">Record Modified successfully</h5>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-block" data-dismiss="modal" id = "sm-btn" onclick = "location.reload()" >Close</button>
                </div>
            </div>
        </div>
</div>

<div class="modal fade" id="delsuccessmodal" tabindex="-1" role="dialog"              aria-labelledby="delsuccessmodal"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title text-center" id="exampleModal3Label">Record Deleted successfully</h5>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-block" data-dismiss="modal" id = "sm-btn" onclick = "location.reload()" >Close</button>
                </div>
            </div>
        </div>
</div>

<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog"              aria-labelledby="deletemodal"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title text-center" id="exampleModal3Label">Are you sure you want to delete the record?</h5>
                </div>

                <div class="modal-footer">
                <form name = "dmform" id = "dmform" action="assets/php/dbdestruct.php" method = "POST" target = "formtarget">
                    <input type="hidden" name = "delholder" id = "delholder">
                    <button type="submit" class="btn btn-danger" data-dismiss="modal" id = "sm-btn" onclick = "dmaction()">Yes</button>
                    </form>
                    <button type="button" class="btn btn-success" data-dismiss="modal" id = "sm-btn">No</button>
                </div>
            </div>
        </div>
</div>
    <!-- Modal Box For Edit Window Begins -->

    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div id="input-area" class="bg-light">
            <form name="fe-form" id="fe-form" method="POST" action="assets/php/dbcrawler.php" target="formtarget">
                <div class="row d-flex flex-row justify-content-center form-inline input-group-lg in-fr">
                    <input type="date" class="form-control" id="fe-date" name="fe-date" required>
                    <input type="text" class="form-control" id="fe-title" name="fe-title" placeholder="Title" required>
                    <input type="number" step = "0.01" class="form-control" id="fe-amount" name="fe-amount" placeholder="Amount" required>
                </div>

                <div class="row d-flex flex-row justify-content-center form-inline input-group-lg in-fr">
                    <input type="text" class="form-control" placeholder="Description" name="fe-description" required id = "fe-description">

                    <select name="ondisplay" id="select-inc-ed" class="custom-select">
                        <option selected value="uncategorized">Uncategorized</option>
                        <option value="gift">Gift</option>
                        <option value="salary">Salary</option>
                        <option value="business income">Business Income</option>
                        <option value="saving">Saving</option>
                        <option value="others">Others</option>
                    </select>


                    <select name="hidden" id="select-exp-ed" class="custom-select">
                        <option selected value="uncategorized">Uncategorized</option>
                        <option value="shopping">Shopping</option>
                        <option value="food and groceries">Food and Groceries</option>
                        <option value="transportation">Transportation</option>
                        <option value="bills and payments">Bills and Payments</option>
                        <option value="others">Others</option>
                    </select>
                    <input type="hidden" name = "rowid" id = "rowid">
                </div>

                    <div class="row d-flex flex-row justify-content-center form-inline" id="sub-control">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input t-sel" id="type-selector-ed" name="e-switch"
                            value="expense" onclick = "switchListener('type-selector-ed','select-inc-ed','select-exp-ed')">
                            <label for="type-selector-ed" class="custom-control-label t-leb">Expense?</label>
                        </div>
                        <button class="submit-btn" onclick="edValidator();">Modify Record</button>
                    </div>
                </form>
            </div>            
        </div>
    </div>
</div>

        <!-- Modal Box For Edit Window Ends -->
    <iframe src="" class = 'd-none' frameborder="0" name="formtarget"></iframe> <!-- Hidden Frame for form -->
        <!-- Footer Begins -->

    
    <footer class="container-fluid footer d-flex flex-column justify-content-center">
        <h3 class="col-12 ft-title text-center">Thank you for using the App. Need any help?</h3> 
        <div class="container-fluid d-flex flex-row justify-content-center">
            <div class="row d-flex flex-row justify-content-center ft-b-group" role="group" aria-label="Basic example">
            <button class="col-sm-4 ft-btn">Report Problem</button>
            <button class="col-sm-4 ft-btn"><a href= "https://www.linkedin.com/in/anupbh/">Find Me Here</a></button>
            </div>        
        </div>
    </footer>

    <div class="bottom-footer bg-dark text-white-50 d-flex flex-row justify-content-center text-center">
    &copy; 2020 Copyright <?php echo $iusername ?> - <?php echo $itagline ?> 
    </div>
</body>
<script src="assets/js/formvalidator.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"
integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd"
crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/sortcontroller.js"></script>
<script type="text/javascript" src="assets/js/buttonevents.js"></script>
</html>