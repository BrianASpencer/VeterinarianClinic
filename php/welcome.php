<?php
// for database connnection and username information
include('session.php');

print "<body class='p-3 mb-2 bg-primary text-white'> 
        <h1>Welcome ";
echo htmlspecialchars($login_session);
print "!</h1>";
print "<img src='hospital-512.png' width='128' height='128' class='img-fluid rounded mx-auto d-block'>
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

generate('Owners');




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
?>
<html>

    <head>
        <title>Welcome</title>
        <link rel="shortcut icon" href="parkway-veterinary-hospital-dublin-veterinarian-png-vet-400_387.png">
        <link rel="stylesheet" href="design.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    
    <footer><p class='text-center font-weight-bold'>Copyright &copy; Hippo Manager Assessment</p><p class='text-center font-weight-bold'>Created by Brian Spencer</p></footer>

</html>
