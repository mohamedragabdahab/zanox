<?php

namespace Zanox\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Report Controller responsable for presenting Merchant's transaction reports
 * 
 * @category    Controller
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
 * @Route("merchant")
 * 
 */
class ReportController extends Controller {

    /**
     * Show transaction report regarding to the given merchant ID
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @access public
     * 
     * @Route("/{id}/report", name="merchant-report")
     * 
     * @param int $id   Merchant ID
     */
    public function showAction($id) {
        try {
            //Order Service
            $orderService = $this->get('zanox_app.orderService');

            //merchant Orders
            $orders = $orderService->getMerchantOrders($id);

            //render view and pass orders array
            return $this->render('ZanoxAppBundle:Report:show.html.twig', ['orders' => $orders]);
        } catch (\Exception $ex) {
            //log errors
        }
    }

}
