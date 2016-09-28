<?php

class Transport_m extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getTransportDetail()
    {
        return $this->db->get('transport')->result();
    }

    public function getTransportTypes()
    {
        return $this->db->distinct()->select('type')->get('transport')->result();
    }

    public function addVehicle($data)
    {
        return $this->db->insert('transport', $data);
    }

    public function getVehicle($id)
    {
        return $this->db->where('id', $id)->get('transport')->row();
    }

    public function editVehicle($id, $data)
    {
        return $this->db->where('id', $id)->update('transport', $data);
    }

    public function deleteVehicle($id)
    {
        $this->db->where('id', $id)->delete('transport');
    }

    public function getBookedVehicles($filter)
    {
        $type = $filter['type'];
        $start = $filter['start'];
        $end = $filter['end'];

        $sql = "select a.* from transport_booking a left join transport b on a.transport_id = b.id where a.type = '$type' ";
        $result = $this->db->query($sql);
        if (!$result) return array();
        return $result->result();
    }

    public function getBookableVehicles($filter)
    {

        $booked_vehicles = $this->getBookedVehicles($filter);
        $booked = array();
        foreach ($booked_vehicles as $b) {
            $booked[] = $b->id;
        }
        $sql = "select * from transport where type = '" . $filter['type'] . "'";
        if (!empty($booked)) $sql .= ' and id not in (' . implode(',', $booked) . ')';
        $result = $this->db->query($sql);
        if (!$result) return array();
        return $result->result();

    }

    public function bookTransport($data)
    {
        return $this->db->insert('transport_booking', $data);
    }


}