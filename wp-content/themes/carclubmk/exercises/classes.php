<?php 

// @link: https://www.php.net/manual/en/language.oop5.php

// Class properties may be defined as public, private, or protected. Properties declared without any explicit visibility keyword are defined as public.

// The visibility of a property, a method or (as of PHP 7.1.0) a constant can be defined by prefixing the declaration with the keywords public, protected or private. 
// Class members declared public can be accessed everywhere. Members declared protected can be accessed only within the class itself and by inheriting and parent classes. 
// Members declared as private may only be accessed by the class that defines the member.

// Namespace: A way of encapsulating items such as classes, functions, and constants under a specific name, preventing naming conflicts and providing better organization.


namespace ccmk;

class Vehicle {
    // Properties
    protected $brand;
    protected $model;
    protected $year;
    private $registrationNumber;
    private $registrationPlate;
    const WHEEL_COUNT = 4; // Constant for number of wheels

    // Constructor
    public function __construct($brand, $model, $year, $registrationNumber, $registrationPlate) {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->registrationNumber = $registrationNumber;
        $this->registrationPlate = $registrationPlate;
    }

    // Methods
    public function getBrand() {
        return $this->brand;
    }

    public function getModel() {
        return $this->model;
    }

    public function getYear() {
        return $this->year;
    }

    public function getRegistrationNumber() {
        return $this->registrationNumber;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function displayInfo() {
        return "This is a " . $this->year . " " . $this->brand . " " . $this->model . " with registration number " . $this->registrationNumber . " and registration plate " . $this->registrationPlate . ".";
    }
}

// Creating objects of the Vehicle class
$car = new Vehicle( 'Toyota', 'Camry', 2022, 'ABC123', 'SK-2345-BJ' );
$truck = new Vehicle( 'Ford', 'F-150', 2023, 'XYZ789', 'SR-3456-DF' );

// Accessing properties and methods
echo $car->displayInfo() . "<br>"; // Output: This is a 2022 Toyota Camry with registration number ABC123.
echo $truck->displayInfo() . "<br>"; // Output: This is a 2023 Ford F-150 with registration number XYZ789.

// Accessing the constant
echo "Wheels in a vehicle: " . Vehicle::WHEEL_COUNT; // Output: Wheels in a vehicle: 4

// Creating an array of Vehicle objects
$vehicles = array(
    new Vehicle( 'Toyota', 'Land Cruiser', 2022, 'ABC123', 'BE-3456-BJ' ),
    new Vehicle( 'Ford', 'F-150', 2023, 'XYZ789', 'SK-4567-HY' ),
    new Vehicle( 'BMW', 'iX M60', 2023, 'RTY095', 'MB-4567-UR')
);

// Accessing properties and methods of objects in the array
foreach( $vehicles as $vehicle ) {
    echo $vehicle->displayInfo() . "<br>"; // Display information about each vehicle
}