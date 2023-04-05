<?php include "template.php";
/** @var $conn */
?>
<title>User Registration</title>
<h1 class='text-primary'>User Registration</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <!--Customer Details-->

            <div class="col-md-6">
                <h2>Account Details</h2>
                <p>Please enter wanted username and password:</p>
                <p>Email Address<input type="text" name="username" class="form-control" required="required"></p>
                <p>Password<input type="password" name="password" class="form-control" required="required"></p>

            </div>
            <div class="col-md-6">
                <h2>More Details</h2>
                <!--Product List-->
                <p>Please enter More Personal Details:</p>
                <p>First Name<input type="text" name="FirstName" class="form-control" required="required"></p>
                <p>Second Name<input type="text" name="SecondName" class="form-control" required="required"></p>
                <p>Address<input type="text" name="Adress" class="form-control" required="required"></p>
                <p>Phone Number<input type="text" name="PhoneNumber" class="form-control" required="required"></p>
            </div>
        </div>
    </div>
    <input type="submit" name="formSubmit" value="Submit">
</form>


<?php
IF ($_SERVER["REQUEST_METHOD"] == "POST") { //will return true when user presses submit button
    $username = sanitiseData($_POST['username']);
    $password = sanitiseData($_POST['password']);
    $FirstName = sanitiseData($_POST['FirstName']);
    $SecondName = sanitiseData($_POST['SecondName']);
    $Address = sanitiseData($_POST['address']);
    $PhoneNumber = sanitiseData($_POST['PhoneNumber']);

    //check if the username already exists in the database
    $query = $conn->query("SELECT COUNT(*) FROM customers WHERE EmailAdress= $username");
    $data = $query->fetchArray();
    $numberOfUsers = (int)$data[0];

    if ($numberOfUsers > 0) { //username already exists
        echo "That username already exists, try a new one";
    }else{
        //the username enter is unique (doesn't already exist in database)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $SQLStmt = $conn->prepare("INSERT INTO customers (EmailAdress, hashedPassword, FirstName, SecondName, Adress, PhoneNumber) VALUES (:EmailAdress, :hashedPassword, :FirstName, :SecondName, :Adress, :PhoneNumber)");
        $SQLStmt->bindParam(':EmailAdress', $username);
        $SQLStmt->bindParam(':hashedPassword', $hashedPassword);
        $SQLStmt->bindParam(':FirstName', $FirstName);
        $SQLStmt->bindParam(':SecondName', $SecondName);
        $SQLStmt->bindParam(':Address', $Address);
        $SQLStmt->bindParam(':PhoneNumber', $PhoneNumber);
        $SQLStmt->execute();
    }
    
}
?>

