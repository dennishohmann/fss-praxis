<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\KlasseRepository")
*/
class Klasse
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
    private $jahrgang;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Student", mappedBy="klasse")
     */
    private $students;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="klasse")
     */
    private $teacher;

    /**
     * @return integer
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
    public function getJahrgang()
    {
        return $this->jahrgang;
    }

    /**
     * @param mixed $jahrgang
     */
    public function setJahrgang($jahrgang): void
    {
        $this->jahrgang = $jahrgang;
    }

    /**
     * @return mixed
     */
    public function getStudents()
    {
        return $this->students;
    }

    public function __toString()
    {
        return (string) $this->getStudents();
    }

    public function addStudent(Student $student)
    {
        $this->students->add($student);
    }

    function removeStudent(Student $student)
    {
        $this->students->remove($student);
    }

    /**
     * @return integer
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * @param mixed $teacher
     */
    public function setTeacher(Teacher $teacher): void
    {
        $this->teacher = $teacher;
    }

    public function __construct(string $name, string $jahrgang, string $teacher) {

        $this->name = $name;
        $this->jahrgang = $jahrgang;
        $this->teacher = $teacher;
        $this->students = new ArrayCollection();
    }

/*    public function __toString(){
        // to show the name of the Category in the select
        return $this->teacher;
        // to show the id of the Category in the select
        // return $this->id;
    }*/
}