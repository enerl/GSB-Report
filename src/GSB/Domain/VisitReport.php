<?php

namespace GSB\Domain;

class VisitReport 
{
    /**
     * Visit Report id.
     *
     * @var integer
     */
    private $id;
    /**
     * practitioner id.
     *
     * @var integer
     */
    private $practitionerId;
    /**
     * Visit id.
     *
     * @var integer
     */
    private $visitorId;
    /**
     * Visit Report date.
     *
     * @var date
     */
    private $date;
    /**
     * Visit Report assessment.
     *
     * @var string
     */
    private $assessment;
    /**
     * Visit Report purpose.
     *
     * @var string
     */
    private $purpose;
    
    public function getId() {
        return $this->id;
    }

    public function getPractitionerId() {
        return $this->practitionerId;
    }

    public function getVisitorId() {
        return $this->visitorId;
    }

    public function getDate() {
        return $this->date;
    }

    public function getAssessment() {
        return $this->assessment;
    }

    public function getPurpose() {
        return $this->purpose;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPractitionerId($practitionerId) {
        $this->practitionerId = $practitionerId;
    }

    public function setVisitorId($visitorId) {
        $this->visitorId = $visitorId;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setAssessment($assessment) {
        $this->assessment = $assessment;
    }

    public function setPurpose($purpose) {
        $this->purpose = $purpose;
    }


}