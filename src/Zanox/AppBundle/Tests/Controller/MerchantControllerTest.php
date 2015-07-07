<?php

namespace Zanox\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * MerchantControllerTest Class responsable for executing merchants functional tests
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
 */
class MerchantControllerTest extends WebTestCase {

    /**
     * Test MerchantController::indexAction that it renders the page successfully with the expected content
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @access public
     * 
     * @covers MerchantController::indexAction
     * 
     * @assertions Assert that Page is loaded ok
     * @assertions Assert that the response content contains 'Merchant Listing' text
     * @assertions Assert that the response content contains 'Merchant' text
     * @assertions Assert that the response content contains 'Action' text
     * @assertions Assert that clicking of 'View Report' link will redirect to a new page that has 'Merchant Report' text 
     */
    public function testIndex() {

        //Client instance
        $client = static::createClient();

        //Act like browsing the merchant listing page, via GET method
        $crawler = $client->request('GET', '/merchant/list');

        //Getting the response of the requested URL
        $crawlerResponse = $client->getResponse();

        //Assert that Page is loaded ok
        $this->assertEquals(200, $crawlerResponse->getStatusCode());

        //Assert that the response content contains 'Merchant Listing' text
        $this->assertTrue($crawler->filter('html:contains("Merchants Listing")')->count() > 0);

        //Assert that the response content contains 'Merchant' text
        $this->assertTrue($crawler->filter('html:contains("Merchant")')->count() > 0);

        //Assert that the response content contains 'Action' text
        $this->assertTrue($crawler->filter('html:contains("Action")')->count() > 0);

        //Gettting the first link item that has the text 'View Report' text
        $link = $crawler->filter('a:contains("View Report")')->eq(0)->link();

        //Clicking on selected link
        $crawler = $client->click($link);

        //Assert that clicking of 'View Report' link will redirect to a new page that has 'Merchant Report' text 
        $this->assertTrue($crawler->filter('html:contains("Report")')->count() > 0);
    }

}
