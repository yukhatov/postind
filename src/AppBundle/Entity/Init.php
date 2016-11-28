<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 26.11.16
 * Time: 18:04
 */

namespace AppBundle\Entity;

use Doctrine\DBAL\Connection;
use AppBundle\Entity\Test;
use Doctrine\Bundle\DoctrineBundle\Registry;

/**
 * Class Init
 * @package AppBundle\Entity
 */
final class Init
{
    /**
     * Result statuses constants
     */
    const RESULT_NURMAL = 'normal';
    const RESULT_ILLEGAL = 'illegal';
    const RESULT_FAILED = 'failed';
    const RESULT_SUCCESS = 'success';

    /**
     * @var Connection
     */
    private $connection;
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * Init constructor.
     * @param Connection $connection
     * @param Registry $doctrine
     */
    public function __construct(Connection $connection, Registry $doctrine)
    {
        $this->connection = $connection;
        $this->doctrine = $doctrine;

        $this->create();
    }

    /**
     * Creates table test
     */
    private function create(){
        if($this->connection){
            $sqlCheck = "SHOW TABLES LIKE 'test'";

            if(!count($this->connection->fetchAll($sqlCheck)))
            {
                $sql = "CREATE TABLE `test` (
                    `id` int(11) NOT NULL auto_increment,
                    `script_name` VARCHAR (25),
                    `start_time` int(11),
                    `end_time` int(11),
                    `result` ENUM('" . self::RESULT_NURMAL . "', '" . self::RESULT_ILLEGAL . "', '" . self::RESULT_FAILED . "', '" . self::RESULT_SUCCESS . "'),
                    PRIMARY KEY (`id`))";

                $this->connection->executeQuery($sql);

                $this->fill();
            }
        }
    }

    /**
     * Fills test by random data
     */
    private function fill()
    {
        $result = [
            self::RESULT_NURMAL,
            self::RESULT_ILLEGAL,
            self::RESULT_FAILED,
            self::RESULT_SUCCESS
        ];

        for($i = 0; $i < 20; $i++){
            $test = new Test();
            $test->setScripName('test');
            $test->setStartTime(rand(1480351311, 1480361311));
            $test->setEndTime(rand(1480351311, 1480361311));
            $test->setResult($result[rand(0, 3)]);

            $this->doctrine->getEntityManager()->persist($test);
            $this->doctrine->getEntityManager()->flush();
        }
    }

    /**
     * Returns normal and success
     * @return mixed
     */
    public function get()
    {
        $query = $this->doctrine
            ->getRepository('AppBundle:Test')
            ->createQueryBuilder('t')
            ->where('t.result = :normal')
            ->orWhere('t.result = :success')
            ->setParameters(['normal' => self::RESULT_NURMAL, 'success' => self::RESULT_SUCCESS])
            ->getQuery();

        $result = $query->getResult();

        return $result;
    }
}