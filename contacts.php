<?php
require "motors.php";
$contacts = getContacts();
$response = null;
if (isset($_GET['confirm-deletion'])) {
    $array_key = $_GET['key'];
    $response = deleteContact($contacts, $array_key);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Kontakti</title>
</head>
<!--//header-->

<body>
    <header>
        <a href="http://localhost/contact-book/index.php">Jauns Kontakts</a>
        <a href="http://localhost/contact-book/contacts.php">Kontakti</a>
    </header>

    <h1>Kontakti</h1>
    <div class="kontaktinfo">
        <p class="kontaktnr">
            <?php echo count($contacts) ?> Ieraksti
        </p>

        <?php
        foreach ($contacts as $key => $value) {
        ?>
            <p>
                Vārds: <?php echo $value["name"] ?><br>
                Uzvārds: <?php echo $value["sname"] ?><br>
                Tālr.nr: <?php echo $value["nr"] ?><br>
                E-pasts: <?php echo $value["email"] ?><br>
            </p>

            <button onclick="ShowConfirmDialog(this)" class="delete-button">Izdzēst Kontaktu</button>
            <div class="confirm-deletion">
                <p>Vai tiešām dzēst kontaktu?</p>
                <a href="contacts.php?confirm-deletion&key=<?php echo $key ?>">Jā</a>
                <button onclick="hideConfirmDialog(this)" class="cancel">Atcelt</button>
            </div>

            <p class="error"><?php echo $response ?></p>
        <?php
        }
        ?>

    </div>


    <script src="script.js"></script>

</body>

</html>