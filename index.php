<?php
require("motors.php");
$response = null;
if (isset($_POST['submit'])) {
    $response = storeContact($_POST['name'], $_POST['sname'], $_POST['nr'], $_POST['email']);
    if ($response == "saved") {
        unset($_POST);
    }
}
?>

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

    <form action="index.php" method="post">
        <h1>Jauns Kontakts</h1>
        <label for="">Vārds:</label>
        <input type="text" name="name" value="<?php echo @$_POST['name'] ?>"><br>
        <label for="">Uzvārds:</label>
        <input type="text" name="sname" value="<?php echo @$_POST['sname'] ?>"><br>
        <label for="">Tālrunis:</label>
        <input type="text" name="nr" value="<?php echo @$_POST['nr'] ?>"><br>
        <label for="">e-mail:</label>
        <input type="email" name="email" value="<?php echo @$_POST['email'] ?>"><br>
        <input type="submit" name="submit" value="Saglabāt">

        <?php
        if ($response == "saved") {
            echo "Saglabāts!";
        } elseif ($response == "not_saved") {
            echo "Saglabāt neizdevās!";
        }
        ?>
    </form>
</body>

</html>