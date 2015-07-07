<?php

namespace Zanox\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Merchant Controller responsable for presenting Merchant's actions 
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
class MerchantController extends Controller {

    /**
     * List all available merchants
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @access public
     * 
     * @Route("/list", name="merchant-list")
     * 
     * @return type
     */
    public function indexAction() {
        try {
            //Merchant Service
            $merchantService = $this->get('zanox_app.merchantService');

            //get all available merchants through merchant service
            $merchants = $merchantService->listMerchants();

            //Render stuitable view and pass merchants array to it
            return $this->render('ZanoxAppBundle:Merchant:index.html.twig', ['merchants' => $merchants]);
        } catch (Exception $ex) {
            //loggin error
        }
    }

}
