<?php
// for database connnection and username information
include('session.php');

// looking at POST form to either logout or add an owner or to add a patient
// specifically, if those buttons are pressed
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_REQUEST['logout'])){
        header("location:logout.php");
        exit();
    }
    if(isset($_REQUEST['addOwner'])){
        header("location:addOwner.php");
        exit();
    }
    if(isset($_REQUEST['addPatient'])){
        header("location:addPatient.php");
        exit();
    }
}

// requesting if any edit or delete button is pressed for patients/owners
if(isset($_REQUEST['editoid'])) {
    $oid = intval($_REQUEST['editoid']);
    header("Location:editOwner.php?oid=$oid");
    exit();
}
if(isset($_REQUEST['deleteoid'])) {
    $oid = intval($_REQUEST['deleteoid']);
    header("Location:deleteOwner.php?oid=$oid");
    exit();
}
if(isset($_REQUEST['editpid'])) {
    $pid = intval($_REQUEST['editpid']);
    header("Location:editPatient.php?pid=$pid");
    exit();
}
if(isset($_REQUEST['deletepid'])) {
    $pid = intval($_REQUEST['deletepid']);
    header("Location:deletePatient.php?pid=$pid");
    exit();
} 

print "<body class='p-3 mb-2 bg-primary text-white'> 
        <h1>Welcome, ";
echo htmlspecialchars($login_session);
print "!</h1>";
print "<img src='../images/hospital-512.png' width='128' height='128' class='img-fluid rounded mx-auto d-block'>
        <br>
        <form action = '' method = post>
            <div class='row justify-content-center'>
                <button type='submit' name='addOwner' type='button' class='btn btn-secondary active'>Add New Owner</button>
                &nbsp;&nbsp;
                <button type='submit' name='addPatient' type='button' class='btn btn-secondary active'>Add New Patient</button>
                &nbsp;&nbsp;
                <button type='submit' name='logout' type='button' class='btn btn-secondary active'>Logout</button>
            </div>
        </form><br>
    </body>";

// function to query the database
function query($query) {
    global $db;
    $result = mysqli_query($db, $query);
    if (!$result) {
        return -1;
    }
    return $result; 
}

// this function renders patients from an array as a table
function renderPatientTable($patients){
    print "<div class='table-responsive'><table class='table table-dark'>";
    print "<tr><td class = 'active font-weight-bold'>PatientID</td><td class = 'active font-weight-bold'>OwnerID</td><td>Name</td><td class = 'active font-weight-bold'>Species</td><td class = 'active font-weight-bold'>Color</td><td class = 'active font-weight-bold'>Date Of Birth</td><td class = 'active font-weight-bold'>Actions</td></tr>";
    foreach($patients as $row){
        $pid = htmlspecialchars($row['pid']);
        $oid = htmlspecialchars($row['ownerID']);
        $name = htmlspecialchars($row['fName']);
        $species = htmlspecialchars($row['species']);
        $color = htmlspecialchars($row['color']);
        $dateOfBirth = $row['dOB'];
        print "<tr><td>$pid</td><td>$oid</td><td>$name</td><td>$species</td><td>$color</td><td>$dateOfBirth</td><td><div><a href ='welcome.php?editpid=$pid' class='btn btn-primary active' role='button' aria-pressed='true'>Edit</a>  <a href ='welcome.php?deletepid=$pid' class='btn btn-primary active' role='button' aria-pressed='true'>Delete</a></div></tr>";
    }
    print "</table></div>";
}

// this function renders owners from an array as a table
function renderOwnerTable($patients){
    print "<div class='table-responsive'><table class='table table-dark'>";
    print "<tr><td class = 'active font-weight-bold'>OwnerID</td><td class = 'active font-weight-bold'>First Name</td><td class = 'active font-weight-bold'>Last Name</td><td class = 'active font-weight-bold'>Phone Number</td><td class = 'active font-weight-bold'>Actions</td></tr>";
    foreach($patients as $row){
        $oid = htmlspecialchars($row['oid']);
        $fname = htmlspecialchars($row['fName']);
        $lname = htmlspecialchars($row['lName']);
        $phone = htmlspecialchars($row['phoneNum']);
        print "<tr><td>$oid</td><td>$fname</td><td>$lname</td><td>$phone</td><td><div><a href ='welcome.php?editoid=$oid' class='btn btn-primary active' role='button' aria-pressed='true'>Edit</a>  <a href ='welcome.php?deleteoid=$oid' class='btn btn-primary active' role='button' aria-pressed='true'>Delete</a></div></tr>";
    }
    print "</table></div>";
}

// method to generate tables based on parameter: patients/owners
function generate($data) {
    print "<h4>$data:</h4>";
    $patOwn = array();
    $result = query("select * from $data;");
    $i = 0;
    while($row = mysqli_fetch_assoc($result)){
        $patOwn[$i] = $row;
        $i += 1; 
    }
    if ($data == 'Patients') {
        renderPatientTable($patOwn);
    } else {
        renderOwnerTable($patOwn);
    }
    
}

// creating our tables, as well as add buttons 
generate('Patients');

if (strlen($_GET['error']) > 0) {
    $error = $_GET['error'];
    print "<div style = 'font-size:1 rem; color: white;' class = 'text-center font-weight-bold'>";
    print $error; 
    print "</div>";
}

generate('Owners');

include('../html/welcome.html');
?>