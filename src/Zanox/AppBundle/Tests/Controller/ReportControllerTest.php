<?php

namespace Zanox\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * ReportControllerTest Class responsable for executing reports functional tests 
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
class ReportControllerTest extends WebTestCase {

    /**
     * Test ReportController::showAction that it renders the page successfully with the expected content
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @access public
     * 
     * @covers ReportController::showAction
     * 
     * @assertions Assert that Page is loaded ok
     * @assertions Assert that the response content contains 'Merchants Listing' text
     * @assertions Assert that the response content contains 'Original Amount' text
     * @assertions Assert that the response content contains 'Amount in GBP (£)' text
     * @assertions Assert that the response content contains 'transation Date' text
     * @assertions Assert that there is only one back to merchant link in the page
     * @assertions Assert that the requsted order's amount is displayed as expected
     * @assertions Assert that the requsted order's date is displayed as expected
     * @assertions Assert clicking on 'Back to merchants' link it goes back to Merchants page
     */
    public function testShow() {
        //Client instance
        $client = static::createClient();

        //Merchant Service
        $merchantService = $client->getContainer()->get('zanox_app.merchantService');

        //Order Service
        $orderService = $client->getContainer()->get('zanox_app.orderService');

        //List all merchants
        $merchants = $merchantService->listMerchants();

        //Get first merchant
        $merchant = reset($merchants);

        //Get the orders of the requested merchant reports
        $merchantOrders = $orderService->getMerchantOrders($merchant->getId());

        //First order
        $merchantFirstOrder = reset($merchantOrders);

        $orderAmount = $merchantFirstOrder->getAmount();

        $orderDate = $merchantFirstOrder->getDate()->format('Y-m-d');


        //ASSERTIONS
        //Act like browsing the merchant listing page, via GET method
        $crawler = $client->request('GET', sprintf('merchant/%d/report', $merchant->getId()));

        //Getting the response of the requested URL
        $crawlerResponse = $client->getResponse();

        //Assert that Page is loaded ok
        $this->assertEquals(200, $crawlerResponse->getStatusCode());

        //Assert that the response content contains 'Merchants Listing' text
        $this->assertTrue($crawler->filter('html:contains("Transactions Report")')->count() > 0);

        //Assert that the response content contains 'Original Amount' text
        $this->assertTrue($crawler->filter('html:contains("Original Amount")')->count() > 0);

        //Assert that the response content contains 'Amount in GBP (£)' text
        $this->assertTrue($crawler->filter('html:contains("Amount in GBP (£)")')->count() > 0);

        //Assert that the response content contains 'transation Date' text
        $this->assertTrue($crawler->filter('html:contains("transation Date")')->count() > 0);

        //Assert that there is only one back to merchant link in the page
        $this->assertCount(1, $crawler->filter('html:contains("Back to merchants")'));

        //Assert that the requsted order's amount is displayed as expected
        $this->assertCount(1, $crawler->filter("html:contains('{$orderAmount}')"));

        //Assert that the requsted order's date is displayed as expected
        $this->assertCount(1, $crawler->filter("html:contains('{$orderDate}')"));

        //Gettting the first link item that has the text 'View Report' text
        $link = $crawler->filter('a:contains("Back to merchants")')->eq(0)->link();

        //Clicking on selected link
        $crawler = $client->click($link);

        //Assert clicking on 'Back to merchants' link it goes back to Merchants page
        $this->assertTrue($crawler->filter('html:contains("Merchants Listing")')->count() > 0);
    }

}
