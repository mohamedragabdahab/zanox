<?php

namespace Zanox\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zanox\AppBundle\Entity\Orders;
use Doctrine\Common\DataFixtures\AbstractFixture;

/**
 * OrdersFixture Class responsable for creating and loading orders records to be used for testing purposes
 * 
 * @category    DataFixtures
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
 */
class OrdersFixture extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * Create orders records and Load them through fixtures
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @access public
     * 
     * @param Doctrine\Common\Persistence\ObjectManager $manager entity manager object used to talk to database
     * 
     * @return void
     */
    public function load(ObjectManager $manager) {

        //Faker Objects used to generate random values
        $faker = \Faker\Factory::create();

        //Interate to create set of orders 
        for ($i = 0, $ii = 3; $i < $ii; $i++) {

            //Instantiate order entity object
            $order = new Orders();

            //set order's amount
            $order->setAmount($faker->numberBetween(50, 1000));

            //set order's date
            $order->setDate(new \DateTime(date('Y-m-d')));

            //set order's currency using currecny reference
            $order->setCurrency($this->getReference('currency-' . $i));

            //set order's currency using merchant reference
            $order->setMerchant($this->getReference('merchant-' . $i));

            //persist values to datebase
            $manager->persist($order);
            $manager->flush();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 3; // the order in which fixtures will be loaded
    }

}
