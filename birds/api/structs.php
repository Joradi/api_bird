<?php

class Bird
{
    public $id;
    public $name_latin;
    public $name_spanish;
    public $name_english;
    public $image;

    function __construct($id, $name_latin, $name_spanish, $name_english, $image)
    {
        $this->id = $id;
        $this->name_latin = $name_latin;
        $this->name_spanish = $name_spanish;
        $this->name_english = $name_english;
        $this->image = $image;
    }

    function render()
    {
        return json_encode([
            "id" => $this->id,
            "name" => [
                "english" => $this->name_english,
                "spanish" => $this->name_spanish,
                "latin" => $this->name_latin
            ]
        ]);
    }
}
