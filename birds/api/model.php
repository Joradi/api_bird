<?php

require_once "commands.php";
require_once "queries.php";

class Model
{
    public $queries;
    public $commands;

    function __construct($conn)
    {
        $this->queries = new Queries($conn, 'birds');
        $this->commands = new Commands($conn, 'birds');
    }
}
?>