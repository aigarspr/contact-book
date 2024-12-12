<?php
function searchContact($kontakti){
    $jcontacts = file_get_contents('contacts.json');
    $contacts = json_decode($jcontacts, true);
    


    $results = array_filter($contacts, function($item) use ($kontakti) {
        
        return stripos($item['name'], $kontakti) !== false || 
               stripos($item['email'], $kontakti) !== false || 
               stripos($item['sname'], $kontakti) !== false ||
               stripos($item['nr'], $kontakti) !== false;
        
        
        
});
return $results;

}
//search funkcija


    

    
    

   
    
    



