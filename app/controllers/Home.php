<?php

class Home extends Controller {
    public function index(){
        $data['judul'] = 'Home'; //membuat array judul dengan isi Home
        $data['nama'] = $this->model('User_model')->getUser(); //membuat array nama dengan isi model User_model dan method getUser
        $this->view('templates/header', $data); //folder views mencari file templates/header
        $this->view('home/index' , $data); { //folder views mencari file home/index
        $this->view('templates/footer'); //folder views mencari file templates/footer
        }
    }
}