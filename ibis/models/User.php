<?php
class User
{
    public string $firstName;
    public string $secondName;
    public bool $isValid;

    function __construct($firstName, $secondName, $validity)
    {
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this->isValid = $validity;
    }
}
