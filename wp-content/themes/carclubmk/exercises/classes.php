<?php 

// @link: https://www.php.net/manual/en/language.oop5.php

namespace ccmk;

class Car {
    private $model;
    const YEAR = 2023;

    public function __construct( $model ) {
        $this->model = $model;
    }

    public function get_model() {
        return $this->model . ' ' . self::YEAR;
    }
}

$bmw = new Car( 'BWM' );