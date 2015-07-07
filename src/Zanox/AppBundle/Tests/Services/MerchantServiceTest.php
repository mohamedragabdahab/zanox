<?php

namespace Zanox\AppBundle\Tests\Services;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * MerchantServiceTest Class responsable for executing merchants unit tests
 * 
 * @category    Tests
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
 * @property Faker\Generator $_faker 
 */
class MerchantServiceTest extends WebTestCase {

    /**
     * @var Faker\Generator 
     */
    private $_faker;

    public function __construct() {
        //Initalize Faker Generator
        $this->_faker = \Faker\Factory::create();
    }

    /**
     * Test MerchantService::listMerchants() that it returns all the merchants
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @access public
     * 
     * @covers MerchantService::listMerchants
     * 
     * @assertions Assert that the returned value of the method under the test is a type or array
     * @assertions Assert that the reurned array has only one record
     * @assertions Assert that $merchant is an instance of \Zanox\AppBundle\Entity\Merchants  
     * @assertions Assert that the inserted merchant name value is equal to the retrived value from the method under test call
     */
    public function testListMerchants() {
        //Service container
        $container = static::createClient()->getContainer();

        //Merchant Service
        $merchantService = $container->get('zanox_app.merchantService');

        //Make sure the merchant table is empty
        $merchantService->deleteAll();

        //Random merchant name to be used in creating new merchant record
        $randomMerchatName = $this->_faker->name;

        //create a new record in merchant table
        $merchantService->create($randomMerchatName);

        //Methed under test call
        $merchants = $merchantService->listMerchants();

        //Assert that the returned value of the method under the test is a type or array
        $this->assertInternalType('array', $merchants);

        //Assert that the reurned array has only one record
        $this->assertCount(1, $merchants);

        //Get the first value of the array
        $merchant = reset($merchants);

        //Assert that $merchant is an instance of \Zanox\AppBundle\Entity\Merchants  
        $this->assertInstanceOf('\Zanox\AppBundle\Entity\Merchants', $merchant);

        //Assert that the inserted merchant name value is equal to the retrived value from the method under test call
        $this->assertEquals($randomMerchatName, $merchant->getName());
    }

}
