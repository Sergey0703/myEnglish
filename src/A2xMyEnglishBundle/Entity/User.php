<?php
/**
 * Created by PhpStorm.
 * User: admins
 * Date: 15.03.16
 * Time: 13:06
 */
// src/A2xMyEnglishBundle/Entity/User.php

namespace A2xMyEnglishBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}