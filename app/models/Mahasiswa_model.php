<?php

class Mahasiswa_model {
  
    // private $mhs = []
    private $table = "mahasiswa";
    private $db;

    public function __construct(){
            $this->db = new Database; 
        }
   
        
        public function getAllMahasiswa(){
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getMahasiswaById($id){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id'); // query untuk mengambil data berdasarkan id
        $this->db->bind('id', $id); // bind untuk menghindari sql injection
        return $this->db->single(); // single untuk satu data
    }

}

