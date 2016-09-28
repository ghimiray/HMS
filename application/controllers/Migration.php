<?php
/**
 * Project: hotelmanagement
 * File: Migration.php
 * User: Arjun Paudel
 * Date: 8/22/2016
 * Time: 6:17 AM
 */

class Migration extends CI_Controller{
    
    
    function index(){
        $version = 1;
        $this->load->library('migration');
        if($this->migration->version(1)){
            echo 'Migrated to version '.$version.'.';
        } else {
            echo 'Nothing to migrate.';
        }
    }
}