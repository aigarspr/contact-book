<?php
function storeContact($name, $sname, $nr, $email)
{
    if (filesize("contacts.json") == 0) {
        $old_records = array();
    } else {
        $old_records = json_decode(file_get_contents("contacts.json"), true);
    }

    $new_contact = [
        "id" => count($old_records) + 1,
        "name" => $name,
        "sname" => $sname,
        "nr" => $nr,
        "email" => $email

    ];

    foreach ($new_contact as $value) {
        if ($value == "") {
            return "err";
        }
    }

    if (filesize("contacts.json") == 0) {
        $data_to_save = array($new_contact);
    } else {
        $old_records = json_decode(file_get_contents("contacts.json"), true);
        array_push($old_records, $new_contact);
        $data_to_save = $old_records;
    }

    $encoded_data = json_encode($data_to_save,FILTER_SANITIZE_SPECIAL_CHARS, JSON_PRETTY_PRINT);

    if (!file_put_contents("contacts.json", $encoded_data)) {
        return "not_saved";
    } else {
        return "saved";
    }
}
//contactu saglabāšana

function getContacts()
{
    $contacts = file_get_contents("contacts.json");
    $decoded_contacts = json_decode($contacts, true);

    return $decoded_contacts;
}
//contactu iznešana

function deleteContact($contacts, $key)
{
    unset($contacts[$key]);

    $encoded_data = json_encode($contacts, FILTER_SANITIZE_SPECIAL_CHARS, JSON_PRETTY_PRINT);
    $response = file_put_contents("contacts.json", $encoded_data);
    if (!$response) {
        return "error";
    } else {
        return header("Location: contacts.php");
    }
}
//contactu izdzēšana

function updateContact($id, $name, $sname, $nr, $email)
{

    $old_contacts = file_get_contents("contacts.json");
    $contacts = json_decode($old_contacts, true);

    $renew_contact = [
        "id" => $id,
        "name" => $name,
        "sname" => $sname,
        "nr" => $nr,
        "email" => $email
    ];

    foreach ($contacts as &$contact) {
        if ($contact['id'] == $renew_contact['id']) {
            $contact = $renew_contact;
            break;
        }
    }



    $renew_contact = json_encode($contacts,FILTER_SANITIZE_SPECIAL_CHARS, JSON_PRETTY_PRINT);

    if (!file_put_contents("contacts.json", $renew_contact)) {
        return "not_saved";
    } else {
        return "saved";
    }
}
