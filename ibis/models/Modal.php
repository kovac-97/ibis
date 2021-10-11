<?php

require_once('../controllers/DatabaseController.php');

class Modal
{

    public int $id;
    public string $title;
    public string $text;
    public string $url;


    function __construct($id, $title, $text, $url)
    {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
        $this->url = $url;
    }

    public static function GetModals()
    {
        //izvlačimo sve modale iz baze
        $DB = new DatabaseController('localhost', 'root', '', 'ibis');
        $sqlData = $DB->SQLQuery("SELECT * FROM `modals`");
        $modals = array();
        while ($row = $sqlData->fetch_array()) {
            $id = $row['id'];
            $title = $row['title'];
            $text = $row['text'];
            $url = $row['url'];
            $modal = new Modal($id, $title, $text, $url);
            array_push($modals, $modal);
        }

        return $modals;
    }
}
