<?php


class Councilor
{
    protected $id;
    public $firstName;
    public $lastName;
    public $officialDenomination;
    public $number;
    public $code;
    public $salutationLetter;
    public $salutationTitle;
    public $active;
    public $updated;


    public function __construct($json = false) {
        if ($json) $this->set(json_decode($json, true));
    }

    public function set($data) {
        foreach ($data AS $key => $value) {
            if (is_array($value)) {
                $sub = new JSONObject;
                $sub->set($value);
                $value = $sub;
            }
            $this->{$key} = $value;
        }
    }


}