<?php

namespace App\Entity;

Use App\Entity\Student;
use App\Entity\Teacher;
use App\Entity\Klasse;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
     */
class Student
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $vname;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Klasse", inversedBy="students")
     * @ORM\JoinColumn(name="klasse_id", referencedColumnName="id")
     */
    private $klasse;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="students")
     * @ORM\JoinTable(name="students_teachers")
     */
    private $teachers;




    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getVname()
    {
        return $this->vname;
    }

    public function setVname($vname)
    {
        $this->vname = $vname;
    }

    public function setKlasse(Klasse $klasse): void
    {
        $this->klasse = $klasse;
    }

    public function getKlasse()
    {
        return $this->klasse;
    }

    /**
     * @return ArrayCollection|StudentTeacher[]
     */
    public function getTeachers()
    {
        return $this->teachers;
    }

    public function __toString()
    {
        return (string) $this->getTeachers();
    }

    /**
     * @param mixed $teachers
     */
    public function addTeacher(User $teacher)
    {
        $this->teachers[] = $teacher;
    }

    public function __construct()
    {
        $this->teachers = new ArrayCollection();
    }
}
