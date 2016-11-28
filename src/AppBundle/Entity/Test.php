<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 26.11.16
 * Time: 16:57
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TestRepository")
 * @ORM\Table(name="test")
 */
class Test{
    /**
     * Result statuses constants
     */
    const RESULT_NORMAL = 'normal';
    const RESULT_ILLEGAL = 'illegal';
    const RESULT_FAILED = 'failed';
    const RESULT_SUCCESS = 'success';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, name="script_name", nullable=true)
     */
    private $scripName;

    /**
     * @ORM\Column(type="integer", name="start_time", nullable=true)
     */
    private $startTime;

    /**
     * @ORM\Column(type="integer", name="end_time", nullable=true)
     */
    private $endTime;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('normal', 'illegal', 'failed', 'success')", nullable=true)
     */
    private $result;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getScripName()
    {
        return $this->scripName;
    }

    /**
     * @param mixed $scripName
     */
    public function setScripName($scripName)
    {
        $this->scripName = $scripName;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

}