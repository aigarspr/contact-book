<?php
require("motors.php");
$response = null;
$phoneNumber = [];
if (isset($_POST['submit'])) {
    $response = storeContact($_POST['name'], $_POST['sname'], $_POST['nr'], $_POST['email']);
    if ($response == "saved") {
        unset($_POST);
    }
}
?>
<!--//php saite un parbaudes-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact-book</title>
</head>

<body>

    <header>
        <a href="http://localhost/contact-book/index.php">Jauns Kontakts</a>
        <a href="http://localhost/contact-book/contacts.php">Kontakti</a>
    </header>
    <!--//header-->

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <h1>Jauns Kontakts</h1>
        <label>Vārds: </label>
        <input type="text" name="name" value="<?php echo htmlspecialchars(@$_POST['name']) ?>" required pattern="^[A-Za-zĀāČčĒēĢģĪīĶķĻļŅņŠšŪūŽž\s\-]+$"><br>
        <label>Uzvārds: </label>
        <input type="text" name="sname" value="<?php echo htmlspecialchars(@$_POST['sname']) ?>" required pattern="^[A-Za-zĀāČčĒēĢģĪīĶķĻļŅņŠšŪūŽž\s\-]+$"><br>
        <label>Tālrunis: </label>
        <input type="tel" name="nr" value="<?php echo htmlspecialchars(@$_POST['nr']) ?>"required pattern="(\+\d{1,3}\s?)?\d{1,4}[\s]?\d{1,4}[\s]?\d{1,4}" title="Tālruņa nr. jābūt formātā: +000 00000000"><br>
        <label>e-mail: </label>
        <input type="email" name="email" value="<?php echo htmlspecialchars(@$_POST['email']) ?>"required><br>
        <input type="submit" name="submit" value="Saglabāt">

        <?php
        if ($response == "saved") 
        {
            echo "Saglabāts!";
        }
        if ($response == "not_saved") 
        {
            echo "Saglabāt neizdevās!";
        }
        ?>
    </form>
    <!--//contactu glabāšanas forma-->
</body>

</html>