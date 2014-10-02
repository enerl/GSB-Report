<?php

namespace GSB\DAO;

use GSB\Domain\Practitioner;

class PractitionerDAO extends DAO
{
    /**
     * @var \GSB\DAO\PractitionerDAO
     */
    private $practitionerDAO;

    public function setPractitionerDAO($practitionerDAO) {
        $this->practitionerDAO = $practitionerDAO;
    }

    /**
     * Returns the list of all Practitioners, sorted by Practitioner_name.
     *
     * @return array The list of all Practitioners.
     */
    public function findAll() {
        $sql = "select * from Practitioner order by practitioner_name";
        $result = $this->getDb()->fetchAll($sql);
        
        // Converts query result to an array of domain objects
        $practitioners = array();
        foreach ($result as $row) {
            $practitionerId = $row['practitioner_id'];
            $practitioners[$practitionerId] = $this->buildDomainObject($row);
        }
        return $practitioners;
    }

    /**
     * Returns the list of all practitioner for a given type, sorted by Practitioner name.
     *
     * @param integer $familyDd The family id.
     *
     * @return array The list of Practitioners.
     */
    public function findAllByType($practitionerTypeId) {
        $sql = "select * from Practitioner where practitioner_type_id=? order by practitioner_name";
        $result = $this->getDb()->fetchAll($sql, array($practitionerTypeId));
        
        // Convert query result to an array of domain objects
        $practitioners = array();
        foreach ($result as $row) {
            $practitionerID = $row['practitioner_id'];
            $practitioners[$practitionerID] = $this->buildDomainObject($row);
        }
        return $practitioners;
    }

    /**
     * Returns the Practitioner matching a given id.
     *
     * @param integer $id The Practitioner id.
     *
     * @return \GSB\Domain\Practitioner|throws an exception if no drug is found.
     */
    public function find($id) {
        $sql = "select * from Practitioner where practitioner_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No Practitioner found for id " . $id);
    }

    /**
     * Creates a Practitioner instance from a DB query result row.
     *
     * @param array $row The DB query result row.
     *
     * @return \GSB\Domain\Practitioner
     */
    protected function buildDomainObject($row) {
        $typeId = $row['practitioner_id'];
        $type = $this->practitionerDAO->find($typeId);

        $practitioner = new Practitioner();
        $practitioner->setId($row['practitioner_id']);
        $practitioner->setName($row['practitioner_name']);
        $practitioner->setFirstName($row['practitioner_first_name']);
        $practitioner->setAddress($row['practitioner_address']);
        $practitioner->setZipCode($row['practitioner_zip_code']);
        $practitioner->setCity($row['practitioner_city']);
        $practitioner->setNotorietyCoefficient($row['notoriety_coefficient']);
        $practitioner->setIdType($type);

        return $type;
    }
}