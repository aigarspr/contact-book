<?php
require "motors.php";
$contacts = getContacts();
$response = null;
if (isset($_GET['confirm-deletion'])) {
    $array_key = $_GET['key'];
    $response = deleteContact($contacts, $array_key);
}
?>
<!--//php saite un parbaudes-->

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
    <!--//nav-->

    <h1>Kontakti</h1>
    <div class="kontaktinfo">
        <p class="kontaktnr">
            <?php echo count($contacts) ?> Ieraksti
        </p>

        <?php
        foreach ($contacts as $key => $value) {
        ?>
            <p>
                Vārds: <input type="text" name="name" value="<?php echo $value["name"] ?>"><br>
                Uzvārds: <input type="text" name="sname" value="<?php echo $value["sname"] ?>"><br>
                Tālr.nr: <input type="text" name="nr" value="<?php echo $value["nr"] ?>"><br>
                E-pasts: <input type="email" name="email" value="<?php echo $value["email"] ?>"><br>
            </p>

            <button onclick="ShowEnablDialog(this)" class="update-button">Rediģēt kontaktu</button>
            <div class="update">
                <p>Vai tiešām rediģēt kontaktu?</p>
                <a href="">Jā</a>
                <button onclick="hideConfirmDialog(this)" class="cancel">Atcelt</button>

            </div>

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
    <!--//Izvades forma + pogas-->


    <script src="script.js"></script>
    <!--//js aktivs-->

</body>

</html>