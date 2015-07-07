<?php

namespace Zanox\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders Entity Class
 * 
 * @category    Entity
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
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="merchant_id", columns={"merchant_id"}), @ORM\Index(name="currency_id", columns={"currency_id"})})
 * @ORM\Entity
 */
class Orders {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=0, nullable=false)
     */
    private $amount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \LexikCurrency
     *
     * @ORM\ManyToOne(targetEntity="LexikCurrency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     * })
     */
    private $currency;

    /**
     * @var \Merchants
     *
     * @ORM\ManyToOne(targetEntity="Merchants")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="merchant_id", referencedColumnName="id")
     * })
     */
    private $merchant;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set amount
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @param float $amount
     * 
     * @return Orders
     */
    public function setAmount($amount) {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * 
     * @return float 
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * Set date
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * 
     * @param \DateTime $date
     * @return Orders
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * 
     * @return \DateTime 
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set currency
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @param \Zanox\AppBundle\Entity\LexikCurrency $currency
     * 
     * @return Orders
     */
    public function setCurrency(\Zanox\AppBundle\Entity\LexikCurrency $currency = null) {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * 
     * @return \Zanox\AppBundle\Entity\LexikCurrency 
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * Set merchant
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @param \Zanox\AppBundle\Entity\Merchants $merchant
     * 
     * @return Orders
     */
    public function setMerchant(\Zanox\AppBundle\Entity\Merchants $merchant = null) {
        $this->merchant = $merchant;

        return $this;
    }

    /**
     * Get merchant
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * 
     * @return \Zanox\AppBundle\Entity\Merchants 
     */
    public function getMerchant() {
        return $this->merchant;
    }

}
