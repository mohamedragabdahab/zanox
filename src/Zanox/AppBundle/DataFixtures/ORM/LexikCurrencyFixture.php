<?php

namespace Zanox\AppBundle\Entity;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zanox\AppBundle\Entity\LexikCurrency;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

/**
 * LexikCurrencyFixture Class responsable for creating and loading currency records to be used for testing purposes
 * 
 * @category    DataFixtures
 * @package     AppBundle
 * @author      Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
 * @version     1.0
 * @link        http://zanox.com/
 * @since       Class available since Release 1.0
 * 
 * 
 * @property Symfony\Component\DependencyInjection\ContainerInterface $_container Description
 * 
 * 
 * @copyright
 * Zanox Affiliate Window Candidate Task 1.0
 * Copyright © 2015 by Zanox
 * http://www.zanox.com
 * 
 */
class LexikCurrencyFixture extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $_container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->_container = $container;
    }

    /**
     * Create currency records and Load them through fixtures
     * 
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @access public
     * 
     * @param Doctrine\Common\Persistence\ObjectManager $manager entity manager object used to talk to database
     * 
     * @return void
     */
    public function load(ObjectManager $manager) {

        //Faker instance
        $faker = \Faker\Factory::create();

        //Get available currencies
        $managedCurrencies = $this->_container->getParameter('lexik_currency.currencies.managed');

        //Supported currencies symbols
        $currenciesSymbol = ['£', '€', '$'];

        //Create a row for each available currency 
        foreach ($managedCurrencies as $key => $currency) {

            //Random conversion rate for currencies
            $randomRate = $faker->numberBetween(2, 3);

            //Make sure that the default currency conversio rate is [1] comparing to itself
            if ($currency === $this->_container->getParameter('lexik_currency.currencies.default')) {
                $randomRate = 1;
            }

            //An instance of LexikCurrency
            $currecy = new LexikCurrency();

            //set currency's code
            $currecy->setCode($currency);

            //set currency's Symbol
            $currecy->setSymbol($currenciesSymbol[$key]);

            //set currency's Rate
            $currecy->setRate($randomRate);

            //Persist data to database
            $manager->persist($currecy);
            $manager->flush();

            //adding an incremental references to be used for Currency's table dependencies
            $this->addReference('currency-' . $key, $currecy);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 1; // the order in which fixtures will be loaded
    }

}
