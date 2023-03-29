<?php include "template.php";
/** @var $conn */
?>
    <title>Contact Us</title>
<body>
<h1>Contact Us</h1>
<div class="container-fluid">
    <form action="contact.php" method="post">
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="inputMessage" class="form-label">Message</label>
            <input type="text" class="form-control" id="inputMessage" name="inputMessage">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formError = false;
    if (empty($_POST['inputEmail'])){
        $formError = true;
        echo "Enter an email address";
    }
    if (empty($_POST['inputMessage'])) {
        $formError = true;
        echo "Enter a message to submit";
    }
    if ($formError == false) {
        $emailAddress = $_POST['inputEmail'];
        $messageSubmitted = $_POST['inputMessage'];

        $SQLStmt = $conn->prepare("INSERT INTO Contact (Email, Message) VALUES (:Email, :Message)");
        $SQLStmt->bindParam(':Email', $ContactEmail);
        $SQLStmt->bindParam(':Message', $ContactMessage);
        $SQLStmt->execute();

        }
      //  $csvFile = fopen("contact.csv", "a");
       // fwrite($csvFile, $emailAddress. ",". $messageSubmitted."\n");
      //  fclose($csvFile);
    }
?>

?>
<?php echo footer() ?>
</body>
<script src="js/bootstrap.bundle.min.js" ></script>
</html>