<?php

namespace Zanox\AppBundle\Services;

use Doctrine\ORM\EntityManager;

/**
 * OrderService Class responsable for creating all Orders business login  
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
class OrderService {

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
     * Udated existing Merchant's order
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @access public
     * 
     * @param int $id
     * @param float $amount
     * @param \DateTime $date
     * @param int $merchant
     * @param int $currency
     * 
     * @return boolean
     * 
     * @throws Exception Amount invalid value    
     * @throws Exception Date invalid value
     * @throws Exception Merchant invalid value
     * @throws Exception Currency invalid value    
     */
    public function update($id, $amount = false, $date = false, $merchant = false, $currency = false) {

        //Check if amount is valid
        if ($amount !== false && !is_numeric($amount)) {
            throw new \Exception('Amount invalid value');
        }

        //Check if Date is valid
        if ($date !== false && !$date instanceof \DateTime) {
            throw new \Exception('Date invalid value');
        }

        //Check if Merchant is valid
        if ($merchant !== false && !is_numeric($merchant)) {
            throw new \Exception('Merchant invalid value');
        }

        //Check if Currency is valid
        if ($currency !== false && !is_numeric($currency)) {
            throw new \Exception('Currency invalid value');
        }

        try {

            $orders = $this->_em->getRepository('ZanoxAppBundle:Orders')->findOneBy(['id' => $id]);

            //set Order's amount
            (false !== $amount) ? $orders->setAmount($amount) : null;

            //set Order's date
            (false !== $date) ? $orders->setDate($date) : null;

            //set Order's merchant
            (false !== $merchant) ? $orders->setMerchant($merchant) : null;

            //set Order's currency
            (false !== $currency) ? $orders->setCurrency($currency) : null;


            //persist merchant object
            $this->_em->persist($orders);

            $this->_em->flush();
        } catch (\Exception $ex) {
            //Logging Error
        }

        return $orders;
    }

    /**
     * Find all orders
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @access public
     * 
     * @return array all merchants orders
     */
    public function listOrders() {
        //Get Order Repository using entity manager service
        $orderRepo = $this->_em->getRepository('ZanoxAppBundle:Orders');

        //Select all from orders
        $orders = $orderRepo->findAll();

        return $orders;
    }

    /**
     * Get All orders for a specific merchant using his ID as a criteria  
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @access public
     * @param int $id
     * 
     * @return array Merchant Orders
     *
     * @throws Exception "Merchant ID is required"
     * @throws Exception "Merchant ID is invalid"
     * @throws Exception "Merchant not found"
     */
    public function getMerchantOrders($id) {
        //Check if Merchant ID is given
        if (empty($id)) {
            throw new \Exception('Merchant ID is required');
        }

        //Check if Merchat Id valid type
        if (!is_numeric($id)) {
            throw new \Exception('Merchant ID is invalid');
        }

        //select from merchant by ID
        $merchant = $this->_em->getRepository('ZanoxAppBundle:Merchants')->findOneBy(['id' => $id]);

        //Check if merchant exists
        if (empty($merchant)) {
            throw new \Exception('Merchant not found');
        }

        //Get orders repository
        $reportsRepo = $this->_em->getRepository('ZanoxAppBundle:Orders');

        //Select merchant by ID
        $orders = $reportsRepo->findBy(['merchant' => $id]);

        return $orders;
    }

}
