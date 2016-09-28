<?php

class Configuration_m extends CI_Model
{

    private $_table = 'configurations';

    function __construct()
    {
        parent::__construct();
    }

    public function getAllConfigData()
    {
        $data = $this->db->get($this->_table)->result();
        $ret = array();
        foreach ($data as $detail) {
            ($detail->config_type == 'information' || $detail->config_type == 'social') ?
                $ret[$detail->config_type][$detail->config_key] = $detail->config_value :
                $ret[$detail->config_type][$detail->config_key] = $detail->description;
        }
        return $ret;
    }


    public function updateConfigData($type, $key, $value)
    {
        if (!$value) $value = '';
        $params = [
            'config_type' => $type,
            'config_key' => $key,
        ];
        if ($type == 'information' || $type == 'social') {
            return $this->db->where($params)->update($this->_table, array('config_value' => $value));
        } else {
            return $this->db->where($params)->update($this->_table, array('description' => $value));
        }
    }

    public function getConfigByType($type)
    {
        return $this->db->where('type', $type)->get($this->_table)->result();
    }

    public function parseConfigByTypeAndKey($type, $key, $value = false, $update = false)
    {
        $ret = $this->db->where('config_type', $type)->where('config_key', $key)->get($this->_table)->row();
        if ($ret) {
            if ($update) $this->updateConfigData($type, $key, $value);
            $ret = $this->db->where('config_type', $type)->where('config_key', $key)->get($this->_table)->row();
            return ($type == 'information' || $type == 'social') ? $ret->config_value : $ret->description;
        } else {
            $this->saveConfigData($type, $key, $value);
            return null;
        }
    }

    public function saveConfigData($type, $key, $value)
    {
        if (!$value) $value = '';
        $params = [
            'config_type' => $type,
            'config_key' => $key,
        ];
        if ($type == 'information' || $type == 'social') {
            $params['config_value'] = $value;
            return $this->db->insert($this->_table, $params);
        } else {
            $params['description'] = $value;
            return $this->db->insert($this->_table, $params);
        }
    }

}