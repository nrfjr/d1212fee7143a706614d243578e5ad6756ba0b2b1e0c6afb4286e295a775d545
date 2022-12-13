<?php

class Securities extends Controller{

    private $db;
    
    public function __construct(){
        $this->securityModel = $this->model('Security');

        if (!isset($_SESSION['username'])){
            redirect('users/login');
        }
    }

    public function roleprivilege($DB)
    {
        $_SESSION['SecurityDB'] = $DB;

        if (isset($_SESSION['StorageDB'])) {
            $this->db = $_SESSION['StorageDB'];
        }

        $granted = $this->securityModel->getGrantedUsers($this->db);
        $privileges = $this->securityModel->getDBPrivileges($this->db);

        $data = [
            'granted' => ($granted ) ? $granted  : [],
            'privilege' => ($privileges) ? $privileges : []
        ];

        $this->view('security/roleprivilege', $data);
    }

    public function ldifforsso($DB)
    {
        $_SESSION['SecurityDB'] = $DB;

        isset($_SESSION['SecurityDB']);

        $this->view('security/ldifforsso',[]);
    }

    public function download($DB)
    {
        $_SESSION['SecurityDB'] = $DB;

        isset($_SESSION['SecurityDB']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $raw_contents = trim($_POST['contents']);
        }

        $filtered_contents = explode('\n', $raw_contents);
        $file = fopen("MyLDIF.ldif", "w") or die("Unable to open file!");
        foreach($filtered_contents as $contents){
            fwrite($file, $contents.PHP_EOL);
        }
        fclose($file);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename('MyLDIF.ldif'));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('MyLDIF.ldif'));
        ob_clean();
        flush();
        readfile('MyLDIF.ldif');
        exit();
        $this->view('securities/ldifforsso/'.$DB, []);
        
    }
    
}