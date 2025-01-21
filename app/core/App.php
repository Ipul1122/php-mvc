<?php

// Kelas utama untuk menangani routing dan eksekusi dalam arsitektur MVC
class App {
    // Properti untuk menyimpan controller, method, dan parameter
    protected $controller = 'Home'; // Controller default jika tidak ada yang ditentukan di URL
    protected $method = 'index'; // Method default jika tidak ada yang ditentukan
    protected $params = []; // Parameter default (kosong)

    // Konstruktor: otomatis dieksekusi saat objek kelas ini dibuat
    public function __construct(){
        $url = $this->parseURL(); // Memproses URL untuk mendapatkan controller, method, dan params

        // Jika ada URL dan elemen pertama adalah nama file controller
        if ($url && isset($url[0])) {
            if (file_exists('../app/controllers/' . $url[0] . '.php')) { // Cek apakah file controller ada
                $this->controller = $url[0]; // Tetapkan controller sesuai dengan URL
                unset($url[0]); // Hapus elemen ini dari array URL
            }
        }

        // Include file controller yang sudah ditentukan
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller; // Buat instance dari controller

        // Cek apakah ada method di URL
        if ($url && isset($url[1])) {
            if (method_exists($this->controller, $url[1])) { // Cek apakah method ada dalam controller
                $this->method = $url[1]; // Tetapkan method sesuai URL
                unset($url[1]); // Hapus elemen ini dari array URL
            }
        }

        // Ambil parameter tambahan dari URL jika ada
        $this->params = $url ? array_values($url) : []; // Array nilai-nilai URL yang tersisa

        // Validasi apakah method benar-benar ada dalam controller
        if (!method_exists($this->controller, $this->method)) {
            http_response_code(404); // Berikan response 404 jika method tidak ditemukan
            die("Error: Method '{$this->method}' not found in controller '" . get_class($this->controller = new $this->controller) . "'.");
        }

        // Eksekusi method dalam controller dengan parameter
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Fungsi untuk memproses URL
    public function parseURL(){
        if (isset($_GET['url'])) { // Cek apakah ada parameter `url` di query string
            $url = rtrim($_GET['url'], '/'); // Hapus karakter '/' di akhir URL
            $url = filter_var($url, FILTER_SANITIZE_URL); // Bersihkan URL dari karakter berbahaya
            $url = explode('/', $url); // Pecah URL menjadi array berdasarkan karakter '/'
            return $url; // Kembalikan array URL
        }
        return null; // Jika tidak ada parameter `url`, kembalikan null
    }
}
