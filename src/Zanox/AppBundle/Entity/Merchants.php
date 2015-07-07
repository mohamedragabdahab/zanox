<?php

namespace Zanox\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Merchants Entity Class
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
 * @ORM\Table(name="merchants")
 * @ORM\Entity
 */
class Merchants {

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
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

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
     * Set name
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * @param string $name
     * 
     * @return Merchants
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     * @author Mohamed Ragab Dahab <eng.mohamed.dahab@gmail.com>
     * 
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

}
