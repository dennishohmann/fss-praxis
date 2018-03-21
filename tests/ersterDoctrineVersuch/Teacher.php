<?php

namespace App\Entity;

Use App\Entity\Student;
use App\Entity\Teacher;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\TeacherRepository")
*/
class Teacher
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $vname;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Klasse", mappedBy="teacher")
     */
    private $klassen;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Student", mappedBy="teachers")
     */
    private $students;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getVname()
    {
        return $this->vname;
    }

    /**
     * @param mixed $vname
     */
    public function setVname($vname): void
    {
        $this->vname = $vname;
    }

    /**
     * @return ArrayCollection|KlasseTeacher[]
     */
    public function getKlassen()
    {
        return $this->klassen;
    }

    /**
     * @param mixed $klassen
     */
    public function setKlasse(Klasse $klasse)
    {
        $this->klasse = $klasse;
    }

    /**
     * @return ArrayCollection|TeacherStudent[]
     */
    public function getStudents()
    {
        return $this->students;
    }


    public function __construct() {
        $this->klassen = new ArrayCollection();
        $this->students = new ArrayCollection();
    }


}