
<?php

class DatabaseController
{
    //Klasa za lakši pristup bazi
    private mysqli $mysqli;

    function __construct(string $host, string $username, string $password, string $database)
    {
        $this->mysqli = new mysqli($host, $username, $password, $database);
        if ($this->mysqli->connect_error) {
            echo $this->mysqli->connect_error;
        }
    }
    //Korisno za upite koji ne sadrže korsnički-unijete podatke
    //U suprotnom koristiti STMTQuery(...)
    function SQLQuery(string $query)
    {
        return $this->mysqli->query($query);
    }

    function STMTQuery(string $query, string $format, array $args)
    {
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param($format, ...$args);
        $success = $stmt->execute();
        $result = $stmt->get_result();

        //$stmt->get_result() može vratiti bool
        //pa u tom slučaju vraćamo informaciju o uspješnosti upita
        if (is_bool($result)) {
            return $success;
        } else {
            return $result;
        }
    }
}





?>

