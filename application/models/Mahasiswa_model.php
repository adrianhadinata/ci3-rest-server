<?php

class Mahasiswa_model extends CI_Model
{
    public function getAll($id = null)
    {
        if ($id == null) {
            return $this->db->get("mahasiswa")->result_array();
        } else {
            return $this->db->get_where("mahasiswa", ["id" => $id])->result_array();
        }
    }

    public function delete($id)
    {
        $this->db->delete("mahasiswa", ["id" => $id]);
        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert("mahasiswa", $data);
        return $this->db->affected_rows();
    }

    public function update($id, $data)
    {
        $this->db->update("mahasiswa", $data, ["id" => $id]);
        return $this->db->affected_rows();
    }
}
