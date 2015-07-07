<?php

namespace Zanox\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zanox\AppBundle\Entity\Merchants;
use Doctrine\Common\DataFixtures\AbstractFixture;

/**
 * MerchantsFixture Class responsable for creating and loading Merchants records to be used for testing purposes
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
class MerchantsFixture extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * Create orders records and Load them through fixtures
     * 
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

        //Interate to create set of merchants 
        for ($i = 0, $ii = 3; $i < $ii; $i++) {

            //Instantiate merchant entity object
            $merchant = new Merchants();

            //set merchant's date
            $merchant->setName($faker->name);

            //persist values to datebase
            $manager->persist($merchant);
            $manager->flush();

            //adding an incremental references to be used for Merchant's table dependencies
            $this->addReference('merchant-' . $i, $merchant);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 2; // the order in which fixtures will be loaded
    }

}
