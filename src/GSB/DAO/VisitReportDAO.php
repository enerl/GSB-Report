<?php

namespace GSB\DAO;

use GSB\Domain\VisitReport;

class VisitReportDAO extends DAO
{
    /**
     * @var \GSB\DAO\PractitionerDAO
     */
    private $PractitionerDAO;
    
    /**
     * @var \GSB\DAO\VisitorDAO
     */
    private $VisitorDAO;
    
    public function setPractitionerDAO($PractitionerDAO) {
        $this->PractitionerDAO = $PractitionerDAO;
    }

    public function setVisitorDAO($VisitorDAO) {
        $this->VisitorDAO = $VisitorDAO;
    }
    
    /**
     * Returns the list of all Visit Report, sorted by reporting date.
     *
     * @return array The list of all Visit Report.
     */
    public function findAll() {
        $sql = "select * from visit_report order by reporting_date";
        $result = $this->getDb()->fetchAll($sql);
        
        // Converts query result to an array of domain objects
        $visitReport = array();
        foreach ($result as $row) {
            $visitReportId = $row['report_id'];
            $visitReport[$visitReportId] = $this->buildDomainObject($row);
        }
        return $visitReport;
    }
    
    /**
     * Returns the Visit Report matching a given id.
     *
     * @param integer $id The Visit Report id.
     *
     * @return \GSB\Domain\VisitReport|throws an exception if no Visit Report is found.
     */
    public function find($id) {
        $sql = "select * from visit_report where report_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No visit report found for id " . $id);
        }
    }

        /**
     * Creates a Visit Report instance from a DB query result row.
     *
     * @param array $row The DB query result row.
     *
     * @return \GSB\Domain\VisitReport
     */
    protected function buildDomainObject($row) {
        $practitionerId = $row['practitioner_id'];
        $practitioner = $this->PractitionerDAO->find($practitionerId);
        $visitorId = $row['visitor_id'];
        $visitor = $this->VisitorDAO->find($visitorId);
        
        $visitReport = new VisitReport();
        $visitReport->setId($row['report_id']);
        $visitReport->setDate($row['reporting_date']);
        $visitReport->setAssessment($row['assessment']);
        $visitReport->setPurpose($row['purpose']);
        $visitReport->setPractitionerId($practitioner);
        $visitReport->setVisitorId($visitor);
        return $visitReport;
    }
}
