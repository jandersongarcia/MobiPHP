<?php

namespace Core;

class errorMessage {
    
    public $title = 'Error Found';
    public function data_base_not_found($type){
        return "The database class <strong>$type</strong> was not found. Check that the database name is correct.<br><br><span><strong>Solution:</strong> In the <em>config.php</em> file, if you don't intend to use a database, just change the value of 'use' to false. However, if your intention is to employ a database, you must set the 'type' element of the array to 'mysql' or 'postgre'.</span>";
    }
}