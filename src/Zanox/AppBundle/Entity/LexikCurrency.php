<?php

namespace Zanox\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LexikCurrency Entity Class
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
 * @ORM\Table(name="lexik_currency")
 * @ORM\Entity
 */
class LexikCurrency {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=3, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="symbol", type="string", length=10, nullable=false)
     */
    private $symbol;

    /**
     * @var string
     *
     * @ORM\Column(name="rate", type="decimal", precision=10, scale=4, nullable=false)
     */
    private $rate;

    /**
     * Get id
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * 
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set code
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @param string $code
     * 
     * @return LexikCurrency
     */
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * 
     * @return string 
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * Set symbol
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @param string $symbol
     * 
     * @return LexikCurrency
     */
    public function setSymbol($symbol) {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get symbol
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * 
     * @return string 
     */
    public function getSymbol() {
        return $this->symbol;
    }

    /**
     * Set rate
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @param string $rate
     * 
     * @return LexikCurrency
     */
    public function setRate($rate) {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * 
     * @return string 
     */
    public function getRate() {
        return $this->rate;
    }

}
