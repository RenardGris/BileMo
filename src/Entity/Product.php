<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;
use OpenApi\Annotations as OA;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 *
 *
 * @Serializer\ExclusionPolicy("all")
 *
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "api_products_show",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *     exclusion = @Hateoas\Exclusion(groups={"global","details"})
 * )
 *
 * @OA\Schema()
 *
 */
class Product
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
     * @OA\Property(type="string")
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"global","details"})
     * @Serializer\Expose
     * @OA\Property(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"global","details"})
     * @Serializer\Expose
     * @OA\Property(type="string")
     */
    private $model;

    /**
     * @ORM\Column(type="float")
     * @Serializer\Groups({"details"})
     * @Serializer\Expose
     * @OA\Property(type="number", format="double")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"details"})
     * @Serializer\Expose
     * @OA\Property(type="string")
     */
    private $color;

    /**
     * @ORM\Column(type="float")
     * @Serializer\Groups({"details"})
     * @Serializer\Expose
     * @OA\Property(type="number", format="double")
     */
    private $screenSize;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"details"})
     * @Serializer\Expose
     * @OA\Property(type="string")
     */
    private $storage;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"details"})
     * @Serializer\Expose
     * @OA\Property(type="string")
     */
    private $chargerType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $Color): self
    {
        $this->color = $Color;

        return $this;
    }

    public function getScreenSize(): ?float
    {
        return $this->screenSize;
    }

    public function setScreenSize(float $screenSize): self
    {
        $this->screenSize = $screenSize;

        return $this;
    }

    public function getStorage(): ?string
    {
        return $this->storage;
    }

    public function setStorage(string $storage): self
    {
        $this->storage = $storage;

        return $this;
    }

    public function getChargerType(): ?string
    {
        return $this->chargerType;
    }

    public function setChargerType(string $chargerType): self
    {
        $this->chargerType = $chargerType;

        return $this;
    }
}
