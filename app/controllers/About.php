<?php

// Class About merupakan turunan dari class Controller yang menangani logika pada halaman "About".
class About extends Controller {
    
    // Method index adalah metode default untuk menampilkan halaman utama About.
    // Parameter $nama dan $pekerjaan memiliki nilai default masing-masing 'ipul' dan 'pedagang'.
    public function index($nama = 'ipul', $pekerjaan = 'pedagang') {
        // Menyiapkan data untuk dikirim ke view.
        $data['nama'] = $nama; // Nama pengguna atau orang yang ditampilkan.
        $data['pekerjaan'] = $pekerjaan; // Pekerjaan pengguna.
        $data['judul'] = 'About Me'; // Judul halaman.

        // Memuat view header dengan data yang diberikan.
        $this->view('templates/header', $data);
        // Memuat view utama halaman About.
        $this->view('about/index', $data);
        // Memuat view footer.
        $this->view('templates/footer');
    }

    // Method page adalah metode untuk menampilkan halaman "Pages" pada About.
    public function page() {
        // Menyiapkan judul untuk halaman.
        $data['judul'] = 'Pages';

        // Memuat view header dengan data yang diberikan.
        $this->view('templates/header', $data);
        // Memuat view utama halaman Pages.
        $this->view('about/page');
        // Memuat view footer.
        $this->view('templates/footer');
    }
}
