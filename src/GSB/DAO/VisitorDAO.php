<?php

namespace GSB\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use GSB\Domain\Visitor;

class VisitorDAO extends DAO implements UserProviderInterface {
    
    /**
     * Returns a visitor matching the supplied id.
     *
     * @param integer $id
     *
     * @return \MicroCMS\Domain\Visitor|throws an exception if no matching visitor is found
     */
    public function find($id) {
        $sql = "select * from visitor where visitor_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("Aucun utilisateur ayant cette id" . $id);
        }
    }
    
    /**
     * Creates a Visitor instance from a DB query result row.
     *
     * @param array $row The DB query result row.
     *
     * @return \GSB\Domain\Visitor
     */
    protected function buildDomainObject($row) {
        $visitor = new Visitor();
        $visitor->setId($row['visitor_id']);
        $visitor->setIdSector($row['sector_id']);
        $visitor->setIdLaboratory($row['laboratory_id']);
        $visitor->setLastName($row['visitor_last_name']);
        $visitor->setFirstName($row['visitor_first_name']);
        $visitor->setAddress($row['visitor_address']);
        $visitor->setZipCode($row['visitor_zip_code']);
        $visitor->setCity($row['visitor_city']);
        $visitor->setHiringDate($row['hiring_date']);
        $visitor->setUserName($row['user_name']);
        $visitor->setPassword($row['password']);
        $visitor->setSalt($row['salt']);
        $visitor->setRole($row['role']);
        $visitor->setVisitorType($row['visitor_type']);

        return $visitor;
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username) {
        $sql = "select * from visitor where user_name=?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new UsernameNotFoundException(sprintf('Utilisateur "%s" non trouvé.', $username));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $visitor) {
        $class = get_class($visitor);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('L\'instance de "%s" n\'est pas supportée.', $class));
        }
        return $this->loadUserByUsername($visitor->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class) {
        return 'GSB\Domain\Visitor' === $class;        
    }

}
