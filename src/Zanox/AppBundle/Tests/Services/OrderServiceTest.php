<?php

namespace Zanox\AppBundle\Tests\Services;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * OrderServiceTest Class responsable for executing orders unit tests
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
class OrderServiceTest extends WebTestCase {

    /**
     * Test OrderService::testGetMerchantOrders() valid case
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @access public
     * 
     * @covers MerchantService::listMerchants
     * 
     * @assertions Assert that the expected order ID is equal to the passed merchant's order that passed as an argument to method under test 
     */
    public function testGetMerchantOrdersValidCase() {

        //Service container
        $container = static::createClient()->getContainer();

        //Merchant Service
        $merchantService = $container->get('zanox_app.merchantService');

        //Get merchants created by fixtures
        $merchants = $merchantService->listMerchants();

        //Get one item
        $merchant = reset($merchants);

        //Order Service
        $orderService = $container->get('zanox_app.orderService');

        //List all availabe order created by fixtures
        $orders = $orderService->listOrders();

        //Get first order
        $order = reset($orders);

        //Update the selected order record with the targeted merchant ID
        $updatedOrder = $orderService->update(
                /* $id */$order->getId(),
                /* $amount */ false,
                /* $date */ false,
                /* $merchant */ $merchant->getId()
        );

        //Method under test call
        $expectedOrders = $orderService->getMerchantOrders($merchant->getId());

        //Get the first order of the expected response 
        $expectedOrder = reset($expectedOrders);

        //Assert that the expected order ID is equal to 
        //the passed merchant's order that passed as an argument to method under test 
        $this->assertEquals($expectedOrder->getId(), $updatedOrder->getId());
    }

    /**
     * Test OrderService::testGetMerchantOrders() invalid cases
     * Test scenario: Merchant ID is required
     * Test scenario: Merchant ID is invalid
     * Test scenario: Merchant not found
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @access public
     * 
     * @param mixed $merchantId false for required value and string for invalid value
     * @param string $expectedExceptionMessage Description
     * 
     * @covers MerchantService::listMerchants
     * 
     * @dataProvider dataProviderForTestGetMerchantOrdersInvalidCase
     * 
     * @assertions Assert for exception asserted on "exception message"
     */
    public function testGetMerchantOrdersInvalidCase($merchantId, $expectedExceptionMessage) {
        //Service container
        $container = static::createClient()->getContainer();

        //Order Service
        $orderService = $container->get('zanox_app.orderService');

        $this->setExpectedException('\Exception', $expectedExceptionMessage);

        //Method under test call
        $orderService->getMerchantOrders($merchantId);
    }

    /**
     * prepare data to be used as providers for test cases
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com> 
     * @access public
     * 
     * @covers MerchantService::listMerchants
     * 
     * @return array arguments needed to test different test cases array
     */
    public function dataProviderForTestGetMerchantOrdersInvalidCase() {
        return [
            //Test scenario: Merchant ID is required
            [/* $merchantId */false, /* $expectedExceptionMessage */ 'Merchant ID is required'],
            //Test scenario: Merchant ID is invalid
            [/* $merchantId */'invalid value', /* $expectedExceptionMessage */ 'Merchant ID is invalid'],
            //Test scenario: Merchant not found
            [/* $merchantId */'-1', /* $expectedExceptionMessage */ 'Merchant not found'],
        ];
    }

}
