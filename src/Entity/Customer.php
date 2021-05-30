<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;
use OpenApi\Annotations as OA;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 *
 * @Serializer\ExclusionPolicy("all")
 *
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "api_customers_show",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(groups={"global","details"})
 * )
 * @Hateoas\Relation(
 *      "update",
 *      href = @Hateoas\Route(
 *          "api_customers_update",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(groups={"global","details"})
 * )
 * @Hateoas\Relation(
 *      "delete",
 *      href = @Hateoas\Route(
 *          "api_customers_delete",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(groups={"global","details"})
 * )
 * @Hateoas\Relation(
 *     "user",
 *     embedded = @Hateoas\Embedded("expr(object.getUser())"),
 *     exclusion = @Hateoas\Exclusion(groups={"global","details"})
 * )
 *
 * @OA\Schema()
 *
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"global","details"})
     * @Serializer\Expose
     * @OA\Property(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"global","details"})
     * @Serializer\Expose
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Customer firstname must be at least {{ limit }} characters long",
     *      maxMessage = "Customer firstname cannot be longer than {{ limit }} characters"
     * )
     * @OA\Property(type="string")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"global","details"})
     * @Serializer\Expose
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Customer lastname must be at least {{ limit }} characters long",
     *      maxMessage = "Customer lastname cannot be longer than {{ limit }} characters"
     * )
     * @OA\Property(type="string")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"details"})
     * @Serializer\Expose
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     * @Assert\Length(
     *      min = 5,
     *      max = 255,
     *      minMessage = "Customer email must be at least {{ limit }} characters long",
     *      maxMessage = "Customer email cannot be longer than {{ limit }} characters"
     * )
     * @OA\Property(type="string")
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="customers")
     * @ORM\JoinColumn(nullable=false)
     * @OA\Property(type="array", @OA\Items(ref="#/components/schemas/userGlobal"))
     */
    private $User;

    /**
     * @ORM\Column(type="string", length=15)
     * @Serializer\Groups({"details"})
     * @Serializer\Expose
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 10,
     *      max = 15,
     *      minMessage = "Customer phone must be at least {{ limit }} characters long",
     *      maxMessage = "Customer phone cannot be longer than {{ limit }} characters"
     * )
     * @OA\Property(type="string")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"details"})
     * @Serializer\Expose
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 5,
     *      max = 255,
     *      minMessage = "Customer address must be at least {{ limit }} characters long",
     *      maxMessage = "Customer address cannot be longer than {{ limit }} characters"
     * )
     * @OA\Property(type="string")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"details"})
     * @Serializer\Expose
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Customer address must be at least {{ limit }} characters long",
     *      maxMessage = "Customer address cannot be longer than {{ limit }} characters"
     * )
     * @OA\Property(type="string")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=10)
     * @Serializer\Groups({"details"})
     * @Serializer\Expose
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 10,
     *      minMessage = "Customer postal code must be at least {{ limit }} characters long",
     *      maxMessage = "Customer postal code cannot be longer than {{ limit }} characters"
     * )
     * @OA\Property(type="string")
     */
    private $postalCode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }
}
