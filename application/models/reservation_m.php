<?php

class Reservation_m extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_available_rooms($room_type, $checkin_date, $checkout_date)
    {
        $query = $this->db->query("CALL get_available_rooms('$room_type','$checkin_date','$checkout_date')");

        $this->db->reconnect();
        $data = array();

        if ($query) {
            foreach (@$query->result() as $row) {
                $data[] = $row;
            }
        }
        if (count($data))
            return $data;
        return false;
    }

    public function add_reservation($data, $date = NULL)
    {
        $data['reservation_date'] = $date ? $date : date('Y-m-d H:i:s');
        if ($this->db->insert('reservation', $data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function makePayment($data)
    {
        return $this->db->insert('payment', $data);
    }
    function getAllBookedRooms(){
        return $this->db->get('reservation')->result();
    }

    function getBookedRooms($checkin, $checkout)
    {
        $rooms = $this->db->query("select * from reservation where ($checkin > checkin_date and $checkin < checkout_date) or ($checkout > checkin_date and $checkout < checkout_date)");
    }

    function getAllBookableRooms($checkin, $checkout)
    {
        $booked_rooms = $this->db->query("select group_concat(room_id) as rooms from reservation where ($checkin < checkin_date or $checkin > checkout_date) and ($checkout < checkin_date and $checkout > checkout_date)")->row()->rooms;
        $rooms = $this->db->query("select a.room_id from room a left join reservation b on a.room_id = b.room_id where room_id not in $booked_rooms");
    }

    function getBookableRooms($filter)
    {
        if (empty($filter)) return false;
        $query = "select distinct group_concat(room_id) as rooms from reservation where (checkin_date >= '" . $filter->checkin . "' and  checkin_date <= '" . $filter->checkout . "') or (checkout_date >= '" . $filter->checkin . "' and  checkout_date <= '" . $filter->checkout . "')";
        $booked_rooms_get = $this->db->query($query);
        $booked_rooms = $booked_rooms_get ? $booked_rooms_get->row()->rooms : false;
        $type_filter = ($filter->room_type == 'any' or !$filter->room_type) ? null : " a.room_type = '$filter->room_type'";
        $book_filter = $booked_rooms ? " a.room_id not in ($booked_rooms)" : null;
        if ($type_filter) {
            $type_filter = ' where ' . $type_filter;
            if ($book_filter) $book_filter = ' and ' . $book_filter;
        } elseif ($book_filter) {
            $book_filter = ' where ' . $book_filter;
        }
        return $this->db->query("select a.* ,c.room_price from  room a left join reservation b on a.room_id = b.room_id left join room_type c on a.room_type = c.room_type $type_filter $book_filter")->result();
    }

    function getRoomDetail($room_id)
    {
        $detail = $this->db->query("select a.*, b.room_price from room a left join room_type b on a.room_type = b.room_type where a.room_id = $room_id");
        return $detail ? $detail->row() : false;
    }
}
