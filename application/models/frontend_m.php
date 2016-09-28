<?php
class Frontend_m extends CI_Model{
    
    private $_table_countires = 'countries';
    public function __construct()
    {
        parent::__construct();
    }
    
    function getCountriesList(){
        return $this->db->get($this->_table_countires)->result();
    }
    function getUserReservationData($id, $page)
    {
        switch ($page) {
            case 'reservation' :
                $col = 'customer_id';
                $table = 'reservation';
                $data = $this->db->where($col, $id)->get($table)->result();
                foreach ($data as $id => $d) {
                    $data[$id]->detail = $this->room_m->getRoomDetail($d->room_id);
                }

                break;
            case 'restaurant' :
                $col = 'customer_id';
                $table = 'restaurant_booking';
                $data = $this->db->where($col, $id)->get($table)->result();
                break;
            case 'transport' :
                $col = 'user_id';
                $table = 'transport_booking';
                $data = $this->db->where($col, $id)->get($table)->result();
                foreach ($data as $id => $d) {
                    $data[$id]->detail = $this->transport_m->getVehicle($d->transport_id);
                }
                break;
            default :
                return false;
                break;
        }
        return $data;
    }


}