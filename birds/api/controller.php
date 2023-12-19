<?php

require_once "model.php";

// Executes functions
class Controller
{
    private $model;

    function __construct($conn)
    {
        $this->model = new Model($conn);
    }

    function list($params)
    {
        $result = $this->model->queries->list($params); 
        return $result;
    }

    function create($params)
    {
        $result = $this->model->commands->create($params); 
        return $result;
    }

    function update($params, $id)
    {
        $result = $this->model->commands->update($params, $id);
        return $result;
    }

    function delete($params)
    {
        $result = $this->model->commands->delete($params); 
        return $result;
    }
}
?>