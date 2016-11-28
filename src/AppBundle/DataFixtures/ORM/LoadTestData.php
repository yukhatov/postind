<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 28.11.16
 * Time: 20:19
 */
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Test;

class LoadTestData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $result = [
            Test::RESULT_NORMAL,
            Test::RESULT_ILLEGAL,
            Test::RESULT_FAILED,
            Test::RESULT_SUCCESS
        ];

        for($i = 0; $i < 20; $i++){
            $test = new Test();
            $test->setScripName('test');
            $test->setStartTime(rand(1480351311, 1480361311));
            $test->setEndTime(rand(1480351311, 1480361311));
            $test->setResult($result[rand(0, 3)]);

            $manager->persist($test);
        }

        $manager->flush();
    }
}