<?php
require __DIR__ . '/database_connection.php';

class Pedido{

    protected $db;

    public function __construct()
    {
        $this->db = DB();
    }

    
    public function getItems()
    {
        $query = $this->db->prepare("SELECT * FROM carrito");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }
}