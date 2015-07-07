<?php

namespace Zanox\AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Zanox\AppBundle\Entity\Merchants;

/**
 * MerchantService Class responsable for creating all Merchants business login  
 * 
 * @category    Services
 * @package     AppBundle
 * @author      Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
 * @version     1.0
 * @link        http://zanox.com/
 * @since       Class available since Release 1.0
 * 
 * @copyright
 * Zanox Affiliate Window Candidate Task 1.0
 * Copyright © 2015 by Zanox
 * http://www.zanox.com
 * 
 * 
 * 
 * @property Doctrine\ORM\EntityManager $_em Doctrine Entity Manager Service
 */
class MerchantService {

    /**
     * @var Doctrine\ORM\EntityManager 
     */
    protected $_em;

    /**
     * Constrauctor used to inject dependancies
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @access public
     * 
     * @param Doctrine\ORM\EntityManager $em
     */
    public function __construct(EntityManager $em) {
        $this->_em = $em;
    }

    /**
     * Creates new Merchant record
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @access public
     * 
     * @param string $name merchant name
     * 
     * @return boolean true if record created successfully otherwise throw exception
     * 
     * @throws Exception 'Merchant name is required'
     */
    public function create($name) {

        //Check if merchant name is provided
        if (empty($name)) {
            throw new \Exception('Merchant name is required');
        }

        try {
            //Create an instance if merchant entity
            $merchant = new Merchants();

            //set Merchant name
            $merchant->setName($name);

            //persist merchant object
            $this->_em->persist($merchant);

            $this->_em->flush();
        } catch (Exception $ex) {
            //Logging Error
        }

        return true;
    }

    /**
     * Delete all records from merchant table
     * @access public
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * 
     * @return boolean true if record deleted successfully otherwise false
     */
    public function deleteAll() {
        try {
            return $this->_em->createQuery('DELETE FROM ZanoxAppBundle:Merchants')->execute();
        } catch (Exception $ex) {
            //Logging Error
        }
    }

    /**
     * Find all merchants' details from merchants table
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @access public
     * 
     * @return array all merchants' details
     */
    public function listMerchants() {
        //Get Mechant Repository using entity manager service
        $merchantRepo = $this->_em->getRepository('ZanoxAppBundle:Merchants');

        //Select all from merchants
        $merchants = $merchantRepo->findAll();

        return $merchants;
    }

}
