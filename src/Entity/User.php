<?php


namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="user")
     */
    protected $articles;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string")
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $klasse;

    public function getId()
    {
        return $this->id;
    }

     /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param mixed $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }

    /**
     * @return mixed $article
     */
    public function addArticle(Article $article)
    {
        $this->articles[] = $article;
        $article->setUser($this);

        return $this;
    }

    /*
     * //TODO DAS Ergänzen von Artikeln auf der USER-Seite funktioniert nicht. Schätze es muss erst setUser den alten User gegen den neuen ersetzen?
     *
    */

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getKlasse()
    {
        return $this->klasse;
    }

    /**
     * @param mixed $klasse
     */
    public function setKlasse($klasse): void
    {
        $this->klasse = $klasse;
    }


    public function getAvatar()
    {
        return 'http://thecatapi.com/api/images/get?format=src&type=gif&r='.rand(100, 999);
    }


    /**
     * Overridden so that username is now optional
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->setUsername($email);
        return parent::setEmail($email);
    }

    public function __construct()
    {
        parent::__construct();
        $this->articles = new ArrayCollection();
    }
}

//
//namespace App\Entity;
//
//use Doctrine\Common\Collections\ArrayCollection;
//use Doctrine\ORM\Mapping as ORM;
//use Ramsey\Uuid\Uuid;
//use Symfony\Component\Security\Core\User\AdvancedUserInterface;
///**
// * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
// */
//class User implements AdvancedUserInterface, \Serializable
//{
//    /**
//     * @ORM\Id()
//     * @ORM\Column(type="uuid_binary")
//     */
//    private $id;
//
//    /**
//     * @ORM\Column(type="string")
//     */
//    private $name;
//
//    /**
//     * @ORM\Column(type="string")
//     */
//    private $vname;
//
//    /**
//     * @ORM\Column(type="string", length=25, unique=true)
//     */
//    private $username;
//
//    /**
//     * @ORM\Column(type="string")
//     */
//    private $email;
//
//    /**
//     * @ORM\Column(type="json")
//     */
//    private $roles = [];
//
//    /**
//     * @ORM\Column(type="string", unique=true)
//     */
//    private $apiKey;
//
//    /**
//     * @ORM\Column(type="string")
//     */
//    private $password;
//
//
//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="user")
//     */
//    private $articles;
//
//    /**
//     * @ORM\Column(name="is_active", type="boolean")
//     */
//    private $isActive;
//
//    public function __construct()
//    {
//        $this->id = Uuid::uuid4();
//        $this->articles = new ArrayCollection();
//        $this->isActive = true;
////        $this->name =  $name;
////        $this->vname = $vname;
////        $this->email = $email;
////        $this->role = $role;
//    }
//
//
//    public function addUser(string $name, string $vname, string $email, string $roles)
//    {
//        $this->name = $name;
//        $this->vname = $vname;
//        $this->email = $email;
//        $this->role = $role;
//        // may not be needed, see section on salt below
//        // $this->salt = md5(uniqid('', true));
//    }
//
//    public function getUser()
//    {
//        return $this;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * @param mixed $id
//     */
//    public function setId($id): void
//    {
//        $this->id = $id;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getName()
//    {
//        return $this->name;
//    }
//
//    /**
//     * @param mixed $name
//     */
//    public function setName($name): void
//    {
//        $this->name = $name;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getVname()
//    {
//        return $this->vname;
//    }
//
//    /**
//     * @param mixed $vname
//     */
//    public function setVname($vname): void
//    {
//        $this->vname = $vname;
//    }
//
//
//    /**
//     * @param mixed $vname
//     */
//    public function setUsername($username): void
//    {
//        $this->username = $username;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getEmail()
//    {
//        return $this->email;
//    }
//
//    /**
//     * @param mixed $email
//     */
//    public function setEmail($email): void
//    {
//        $this->email = $email;
//    }
//
//
//
//    /**
//     * @return mixed
//     */
//    public function getArticles()
//    {
//        return $this->articles;
//    }
//
//    /**
//     * @param mixed $articles
//     */
//    public function setArticles($articles): void
//    {
//        $this->articles = $articles;
//    }
//
//    /**
//     * @return mixed $article
//     */
//    public function addArticle(Article $article)
//    {
//        $this->articles[] = $article;
//        $article->addUser($this);
//
//        return $this;
//    }
//
//    /**
//     * @param mixed $apiKey
//     */
//    public function setApiKey($apiKey): void
//    {
//        $this->apiKey = $apiKey;
//    }
//
//
//    /**
//     * @param mixed $roles
//     */
//    public function setRoles(array $roles)
//    {
//        $this->roles = $roles;
//    }
//    /**
//     * Returns the roles granted to the user.
//     *
//     * <code>
//     * public function getRoles()
//     * {
//     *     return array('ROLE_USER');
//     * }
//     * </code>
//     *
//     * Alternatively, the roles might be stored on a ``roles`` property,
//     * and populated in any number of different ways when the user object
//     * is created.
//     *
//     * @return (Role|string)[] The user roles
//     */
//    public function getRoles()
//    {
//        $roles = $this->roles;
//
//        // give everyone ROLE_USER!
//        if (!in_array('ROLE_USER', $roles)) {
//            $roles[] = 'ROLE_USER';
//        }
//
//        return $roles;
//    }
//    /**
//     * Returns the password used to authenticate the user.
//     *
//     * This should be the encoded password. On authentication, a plain-text
//     * password will be salted, encoded, and then compared to this value.
//     *
//     * @return string The password
//     */
//    public function getPassword()
//    {
//        return $this->password;
//
//    }
//
//    /**
//     * Returns the salt that was originally used to encode the password.
//     *
//     * This can return null if the password was not encoded using a salt.
//     *
//     * @return string|null The salt
//     */
//    public function getSalt()
//    {
//        return null;
//    }
//
//    /**
//     * Returns the username used to authenticate the user.
//     *
//     * @return string The username
//     */
//    public function getUsername()
//    {
//        return $this->username;
//    }
//
//    /**
//     * Removes sensitive data from the user.
//     *
//     * This is important if, at any given point, sensitive information like
//     * the plain-text password is stored on this object.
//     */
//    public function eraseCredentials()
//    {
//
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getisActive()
//    {
//        return $this->isActive;
//    }
//
//    /**
//     * @param mixed $isActive
//     */
//    public function setIsActive($isActive): void
//    {
//        $this->isActive = $isActive;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getApiKey()
//    {
//        return $this->apiKey;
//    }
//
//    /**
//     * @param mixed $password
//     */
//    public function setPassword($password): void
//    {
//        $this->password = $password;
//    }
//
//    public function isAccountNonExpired()
//    {
//        return true;
//    }
//
//    public function isAccountNonLocked()
//    {
//        return true;
//    }
//
//    public function isCredentialsNonExpired()
//    {
//        return true;
//    }
//
//    public function isEnabled()
//    {
//        return $this->isActive;
//    }
//
//
//    /** @see \Serializable::serialize() */
//    public function serialize()
//    {
//        return serialize(array(
//            $this->id,
//            $this->username,
//            $this->password,
//            $this->isActive,
//            // see section on salt below
//            // $this->salt,
//        ));
//    }
//
//    /** @see \Serializable::unserialize() */
//    public function unserialize($serialized)
//    {
//        list (
//            $this->id,
//            $this->username,
//            $this->password,
//            $this->isActive,
//            // see section on salt below
//            // $this->salt
//            ) = unserialize($serialized);
//    }
//
//
//    public function __toString()
//    {
//        return $this->getVname().' '.$this->getName();
//    }
//
//}
//
//
//
