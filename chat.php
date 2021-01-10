<?php
require('config.php');
session_start();
class Chat
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        $alreadyExists = $this->db->query('SELECT 1 from message LIMIT 1');
        if(!$alreadyExists) $this->create(); 

        $this->render();
    }

    public function create()
    {
        $query = file_get_contents('migrations/create.sql');
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }

    public function get()
    {
        $result = $this->db->query('SELECT pseudo, content FROM message ORDER BY id DESC LIMIT 30');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($pseudo, $content)
    {
        $req = $this->db->prepare("INSERT INTO message(pseudo, content) VALUES(:pseudo, :content)");
        $req->execute(array(
            'pseudo' => $pseudo,
            'content' => $content
        ));
        
    }

    private function render() {
        $_SESSION['pseudo'] = $_GET['pseudo'] ?? '';

        if(isset($_GET['init'])) {
            echo json_encode($this->get());
            die();
        }
        if(isset($_GET['update'])) {
            $this->update($_GET['pseudo'], $_GET['message'] );
            echo json_encode($this->get());
            die();
        }
    }
}

new Chat();

