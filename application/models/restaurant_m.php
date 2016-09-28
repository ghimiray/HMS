<?php

class Restaurant_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_restaurants()
    {
        $query = $this->db->from('restaurant')->get();
        $data = array();

        foreach (@$query->result() as $row)
        {
            $data[] = $row;
        }
        if(count($data))
            return $data;
        return false;
    } 

    function addRestaurant($restaurantName, $restaurantOpenTime, $restaurantCloseTime, $restaurantDetails, $tableCount)
    {
        $data = array('restaurant_name' => $restaurantName, 'restaurant_open_time' => $restaurantOpenTime, 'restaurant_close_time' => $restaurantCloseTime, 'restaurant_details' => $restaurantDetails, 'table_count' => $tableCount);
        $this->db->insert('restaurant', $data);
        return $this->db->affected_rows();
    } 

    function deleteRestaurant($restaurant_name)
    {
        $this->db->delete('restaurant', array('restaurant_name' => $restaurant_name));
        return $this->db->affected_rows();
    }

    function editRestaurant($restaurant_name, $restaurant_open_time, $restaurant_close_time, $restaurant_details, $tableCount)
    {
        $data = array('restaurant_name' => $restaurant_name, 'restaurant_open_time' => $restaurant_open_time, 'restaurant_close_time' => $restaurant_close_time, 'restaurant_details' => $restaurant_details, 'table_count' => $tableCount);

        $this->db->where('restaurant_name', $restaurant_name);
        $this->db->update('restaurant', $data); 
    }

    function getRestaurant($restaurant_name)
    {
        $query = $this->db->get_where('restaurant', array('restaurant_name' => $restaurant_name));
        return $query->result();
    }

    function add_service($restaurant, $customer, $date, $table_num, $price)
    {
        $data = array(
            'restaurant_name' => $restaurant,
            'customer_id' => $customer,
            'book_date' => $date,
            'table_number' => $table_num,
            'book_price' => $price
        );
        $this->db->insert('restaurant_booking', $data);
    }
    function getBookedTables($restaurant, $date){
        $query = $this->db->query("SELECT GROUP_CONCAT(table_number) AS tables FROM restaurant_booking where restaurant_name = '$restaurant' and book_date = '$date'");
        if($query){
            return explode(',',$query->row()->tables);
        }
        return array();
    }

    function findBookableTables($filter){
        $tables_count = $this->db->where('restaurant_name',$filter->restaurant)->get('restaurant')->row();
        if(!$tables_count) return array();
        $tables_count = $tables_count->table_count;
        if(!(int) $tables_count) return array();
        $booked_tables = $this->getBookedTables($filter->restaurant,$filter->date);
        $all_tables = array();
        $bookable_tables = array();
        for($i = 1; $i <=$tables_count; $i++){
            if(!in_array($i,$booked_tables)) $bookable_tables[] = $i;
        }
        return $bookable_tables;
    }
}
