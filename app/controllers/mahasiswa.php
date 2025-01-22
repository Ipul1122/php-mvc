<?php

class Mahasiswa extends Controller{
    public function index()
    {
        $data['judul'] = 'Daftar Mahasiswa'; //membuat array judul dengan isi Daftar Mahasiswa
        $data['mhs'] = $this->model('Mahasiswa_model')->getAllMahasiswa(); //membuat array mhs dengan isi model Mahasiswa_model dan method getAllMahasiswa
        $this->view('templates/header' , $data); //folder views mencari file templates/header
        $this->view('mahasiswa/index', $data);  //folder views mencari file home/index
        $this->view('templates/footer'); //folder views mencari file templates/footer
        
    }
    public function detail($id)
    {
        $data['judul'] = 'Detail Mahasiswa'; //membuat array judul dengan isi Daftar Mahasiswa
        $data['mhs'] = $this->model('Mahasiswa_model')->getMahasiswaById($id); //membuat array mhs dengan isi model Mahasiswa_model dan method getMahasiswaById
        $this->view('templates/header' , $data); //folder views mencari file templates/header
        $this->view('mahasiswa/detail', $data);  //folder views mencari file home/index
        $this->view('templates/footer'); //folder views mencari file templates/footer
        
    }
}    
