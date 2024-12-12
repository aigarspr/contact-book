<?php
require "motors.php";
require "search.php";
$contacts = getContacts();
$response = null;
if (isset($_GET['confirm-deletion'])) {
    $array_key = $_GET['key'];
    $response = deleteContact($contacts, $array_key);
}
if (isset($_POST['submit'])) {
    $uresponse = updateContact($_POST['id'], $_POST['name'], $_POST['sname'], $_POST['nr'], $_POST['email']);
    if ($uresponse == "saved") {
        unset($_POST);
    }
}
$results = [];
if (isset($_POST['search'])) {
    
    $results = searchContact( $_POST['kontakti']);
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

    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label>Meklēt kontaktos:</label>
            <input type="text" id="kontakti" name="kontakti" pattern="^[A-Za-zĀāČčĒēĢģĪīĶķĻļŅņŠšŪūŽž\s\-]+$|(\+\d{1,3}\s?)?\d{1,4}[\s]?\d{1,4}[\s]?\d{1,4}|^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"><br>
            <input type="submit" name="search" value="Meklēt"><br>
            <?php
                if (!empty($results)) 
                {
                    foreach ($results as $result) 
                    {
                        echo"<p>Vārds:</p>". $result['name']. "<br>", 
                        "<p>Uzvārds:</p>".$result['sname']. "<br>",
                        "<p>Tālr.nr:</p>".$result['nr']. "<br>",
                        "<p>E-mail:</p>".$result['email']."<br><br>";
                    }
                }
                 else 
                 {
                    echo "<p>Ievade netika atrasta!</p>";
                }

            ?>
            <br><br>
        </form>
        <!--//search form-->
        <p class="kontaktnr">
            <?php echo count($contacts) ?> Ieraksti
        </p>

        <?php
        foreach ($contacts as $key => $value) {
        ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <input type="text" name="id" value="<?php echo $value["id"] ?>" hidden>
                Vārds: <input type="text" name="name" value="<?php echo $value["name"] ?><?php echo htmlspecialchars(@$_POST['name']) ?>" pattern="^[A-Za-zĀāČčĒēĢģĪīĶķĻļŅņŠšŪūŽž\s\-]+$"><br>
                Uzvārds: <input type="text" name="sname" value="<?php echo $value["sname"] ?><?php echo htmlspecialchars(@$_POST['sname']) ?>" pattern="^[A-Za-zĀāČčĒēĢģĪīĶķĻļŅņŠšŪūŽž\s\-]+$"><br>
                Tālr.nr: <input type="tel" name="nr" value="<?php echo $value["nr"] ?><?php echo htmlspecialchars(@$_POST['nr']) ?>" pattern="(\+\d{1,3}\s?)?\d{1,4}[\s]?\d{1,4}[\s]?\d{1,4}"><br>
                E-pasts: <input type="email" name="email" value="<?php echo $value["email"] ?><?php echo htmlspecialchars(@$_POST['email']) ?>"><br>
                <input type="submit" name="submit" value="Saglabāt izmaiņas">
            </form>



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