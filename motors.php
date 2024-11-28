<?php
function storeContact($name, $sname, $nr, $email)
{
    $new_contact = [
        "name" => $name,
        "sname" => $sname,
        "nr" => $nr,
        "email" => $email,
        "stored-on" => date("l d M Y H:i:s")
    ];

    foreach ($new_contact as $value) {
        if ($value == "") {
            return "Visiem logiem jābūt aizpildītiem!";
        }
    }

    $sanitized_contact = array_map(function ($item) {
        return htmlspecialchars($item);
    }, $new_contact);

    if (filesize("contacts.json") == 0) {
        $data_to_save = array($sanitized_contact);
    } else {
        $old_records = json_decode(file_get_contents("contacts.json"), true);
        array_push($old_records, $sanitized_contact);
        $data_to_save = $old_records;
    }

    $encoded_data = json_encode($data_to_save, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    if (!file_put_contents("contacts.json", $encoded_data, LOCK_EX)) {
        return "not_saved";
    } else {
        return "saved";
    }
}

function getContacts()
{
    $contacts = file_get_contents("contacts.json");
    $decoded_contacts = json_decode($contacts, true);

    return $decoded_contacts;
}

function deleteContact($contacts, $key)
{
    unset($contacts[$key]);

    $encoded_data = json_encode($contacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $response = file_put_contents("contacts.json", $encoded_data, LOCK_EX);
    if (!$response) {
        return "error";
    } else {
        return header("Location: contacts.php");
    }
}
