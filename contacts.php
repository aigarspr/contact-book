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
    $uresponse = updateContact(htmlspecialchars(@$_POST['id']), htmlspecialchars(@$_POST['name']), htmlspecialchars(@$_POST['sname']), htmlspecialchars(@$_POST['nr']), htmlspecialchars(@$_POST['email']));
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
    <title>Kontakti</title>
    <link rel="stylesheet" href="styles.css">
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
        <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label>Meklēt kontaktos:</label>
            <input type="text" id="kontakti" name="kontakti" required><br>
            <input class="srch" type="submit" id="search" name="search" value="Meklēt"><br>
        </form>   
            <?php
                if (!empty($results)) 
                {
                    foreach ($results as $key => $result) 
                    {
                        ?><form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <input type="text" name="id" value="<?php echo $result["id"] ?>" hidden>
                        <label>Vārds: </label> 
                        <input type="text" name="name" value="<?php echo $result["name"] ?><?php echo htmlspecialchars(@$_POST['name']) ?>" pattern="^[A-Za-zĀāČčĒēĢģĪīĶķĻļŅņŠšŪūŽž\s\-]+$"><br>
                        <label>Uzvārds: </label> 
                        <input type="text" name="sname" value="<?php echo $result["sname"] ?><?php echo htmlspecialchars(@$_POST['sname']) ?>" pattern="^[A-Za-zĀāČčĒēĢģĪīĶķĻļŅņŠšŪūŽž\s\-]+$"><br>
                        <label>Tālr.nr: </label> 
                        <input type="tel" name="nr" value="<?php echo $result["nr"] ?><?php echo htmlspecialchars(@$_POST['nr']) ?>" pattern="(\+\d{1,3}\s?)?\d{1,4}[\s]?\d{1,4}[\s]?\d{1,4}"><br>
                        <label>E-pasts: </label> 
                        <input type="email" name="email" value="<?php echo $result["email"] ?><?php echo htmlspecialchars(@$_POST['email']) ?>"><br>
                        <input class="update" type="submit" id="submit" name="submit" value="Saglabāt izmaiņas">
                    </form>
        
        
        
                    <button onclick="ShowConfirmDialog(this)" class="delete-button">Izdzēst Kontaktu</button>
                    <div class="confirm-deletion">
                        <p>Vai tiešām dzēst kontaktu?</p>
                        <a href="contacts.php?confirm-deletion&key=<?php echo $key ?>">Jā</a>
                        <button onclick="hideConfirmDialog(this)" class="cancel">Atcelt</button>
                    </div>
        
                    <p class="error"><?php echo $response ?></p><?php
                    }
                }else{
                    ?>
                    <p class="noResult"> Meklēšanas rezultāti netika atrasti</p>
                    <?php
                }
              
            ?>
            <br><br>
        
        <!--//search form-->
        <p class="kontaktnr">
            <?php echo count($contacts) ?> Ieraksti
        </p>

        <?php
        foreach ($contacts as $key => $value) {
        ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <input type="text" name="id" value="<?php echo $value["id"] ?>" hidden>
                <label>Vārds: </label> 
                <input type="text" name="name" value="<?php echo $value["name"] ?><?php echo htmlspecialchars(@$_POST['name']) ?>" pattern="^[A-Za-zĀāČčĒēĢģĪīĶķĻļŅņŠšŪūŽž\s\-]+$"><br>
                <label>Uzvārds: </label> 
                <input type="text" name="sname" value="<?php echo $value["sname"] ?><?php echo htmlspecialchars(@$_POST['sname']) ?>" pattern="^[A-Za-zĀāČčĒēĢģĪīĶķĻļŅņŠšŪūŽž\s\-]+$"><br>
                <label>Tālr.nr: </label> 
                <input type="tel" name="nr" value="<?php echo $value["nr"] ?><?php echo htmlspecialchars(@$_POST['nr']) ?>" pattern="(\+\d{1,3}\s?)?\d{1,4}[\s]?\d{1,4}[\s]?\d{1,4}"><br>
                <label>E-pasts: </label> 
                <input type="email" name="email" value="<?php echo $value["email"] ?><?php echo htmlspecialchars(@$_POST['email']) ?>"><br>
                <input class="update" type="submit" name="submit" value="Saglabāt izmaiņas">
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