<?php
class Koneksi
{
    private $host,
        $user,
        $password,
        $dbName,
        $conn;

    // Konstruktor yang otomatis dijalankan untuk koneksi ke database berdasarkan argumen yang diberikan
    public function __construct($host, $user, $password, $dbName)
    {
        // Menginisialisasi properti yang dibutuhkan untuk koneksi ke database
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->dbName = $dbName;

        // Menjalankan method connection untuk koneksi ke database
        $this->connection();
    }

    // Method untuk koneksi ke database dan menampilkan error jika database tidak dapat terkoneksi ke database
    private function connection()
    {
        // Menginisialisasi properti untuk koneksi ke database
        $this->conn = mysqli_connect(
            $this->host,
            $this->user,
            $this->password,
            $this->dbName
        );

        // Menampilkan error koneksi
        if (!$this->conn) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
    }

    // Method untuk koneksi ke database dan menampilkan error jika database tidak dapat terkoneksi ke database
    public function query($query)
    {
        // Menjalankan query mysql
        $result = mysqli_query($this->conn, $query);

        // Menampilkan error koneksi
        if (!$result) {
            die("Query gagal: " . mysqli_error($this->conn));
        }

        // Mengembalikan hasil dari query
        return $result;
    }

    // Method untuk mengambil semua baris data pada tabel
    public function fetchAll($query)
    {
        // Mendapatkan hasil dari query
        $result = $this->query($query);
        $rows = [];

        // Mengambil semua baris data pada tabel dan memasukkannya ke dalam array $rows
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        // Mengembalikan hasil fetch (pengambilan data)
        return $rows;
    }

    // Method untuk mengambil satu baris data pada tabel
    public function fetchRow($query)
    {
        $result = $this->query($query);

        return mysqli_fetch_assoc($result);
    }

    // Method untuk mengecek jumlah baris yang berubah
    public function affectedRows()
    {
        return mysqli_affected_rows($this->conn);
    }

    // Method untuk menutup koneksi database
    public function close()
    {
        mysqli_close($this->conn);
    }
}
