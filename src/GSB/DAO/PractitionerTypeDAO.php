<?php

namespace GSB\DAO;

use GSB\Domain\PractitionerType;

class PractitionerTypeDAO extends DAO
{
    /**
     * Returns the list of all Practitioner Type, sorted by name.
     *
     * @return array The list of all Type.
     */
    public function findAll() {
        $sql = "select * from type order by practitioner_type_name";
        $result = $this->getDb()->fetchAll($sql);
        
        // Converts query result to an array of domain objects
        $types = array();
        foreach ($result as $row) {
            $typeId = $row['practitioner_type_id'];
            $types[$typeId] = $this->buildDomainObject($row);
        }
        return $$types;
    }

    /**
     * Returns the Practitioner Type matching the given id.
     *
     * @param integer $id The Type id.
     *
     * @return \GSB\Domain\Type|throws an exception if no family is found.
     */
    public function find($id) {
        $sql = "select * from type where practitioner_type_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No practitioner type found for id " . $id);
    }
    
    /**
     * Creates a Practitioner Type instance from a DB query result row.
     *
     * @param array $row The DB query result row.
     *
     * @return \GSB\Domain\Type
     */
    protected function buildDomainObject($row) {
        $type = new Type();
        $type->setId($row['practitioner_type_id']);
        $type->setName($row['practitioner_type_name']);
        $type->setPlace($row['practitioner_type_place']);
        return $type;
    }
}