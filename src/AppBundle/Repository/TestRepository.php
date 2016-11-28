<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 28.11.16
 * Time: 21:29
 */
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Test;

class TestRepository extends EntityRepository
{
    public function findNormalAndSuccess(){
        return $this->createQueryBuilder('t')
            ->where('t.result = :normal')
            ->orWhere('t.result = :success')
            ->setParameters(['normal' => Test::RESULT_NORMAL, 'success' => Test::RESULT_SUCCESS])
            ->getQuery()
            ->getResult();
    }
}