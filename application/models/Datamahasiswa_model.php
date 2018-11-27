<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Datamahasiswa_model extends CI_Model {

    public function getdatamahasiswa()
    {
        $this->db->select('*');
        $this->db->from('mahasiswa');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insertmahasiswa($data)
    {
        return $this->db->insert('mahasiswa', $data);
    }

    public function datamahasiswaedit($id)
    {
        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function ubahmahasiswa($data,$id)
    {
        $this->db->where('id',$id);
        return $this->db->update('mahasiswa',$data);
    }

    public function hapusdatamahasiswa($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete('mahasiswa');
        
    }
}

/* End of file Datamahasiswa_model.php */
