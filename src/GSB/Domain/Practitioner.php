<?php

namespace GSB\Domain;

class Practitioner
{
    /**
     * Practitioner id.
     *
     * @var integer
     */
    private $id;
    
    /**
     * Practitioner Type id.
     *
     * @var integer
     */
    private $idType;
    
    /**
     * Practitioner name.
     *
     * @var string
     */
    private $name;
    /**
     * Practitioner first name.
     *
     * @var string
     */
    private $firstName;
    /**
     * Practitioner address.
     *
     * @var string
     */
    private $address;
    
    /**
     * Practitioner zip code.
     *
     * @var string
     */
    private $zipCode;
    
    /**
     * Practitioner city.
     *
     * @var string
     */
    private $city;
    
    /**
     * Practitioner notoriety coefficient.
     *
     * @var integer
     */
    private $notorietyCoefficient;
    
    public function getId() {
        return $this->id;
    }

    public function getIdType() {
        return $this->idType;
    }

    public function getName() {
        return $this->name;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getZipCode() {
        return $this->zipCode;
    }

    public function getCity() {
        return $this->city;
    }

    public function getNotorietyCoefficient() {
        return $this->notorietyCoefficient;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdType($idType) {
        $this->idType = $idType;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setNotorietyCoefficient($notorietyCoefficient) {
        $this->notorietyCoefficient = $notorietyCoefficient;
    }    
}