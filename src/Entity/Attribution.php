<?php

namespace App\Entity;

use App\Repository\AttributionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttributionRepository::class)
 */
class Attribution
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

	// Pour les besoins de la sérialisation voir à migrer datetime_immutable
	// en string et gérer le datetime dans les mutateurs
    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $points;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="attributions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $beneficiaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPoints(): ?string
    {
        return $this->points;
    }

    public function setPoints(string $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getBeneficiaire(): ?User
    {
        return $this->beneficiaire;
    }

    public function setBeneficiaire(?User $beneficiaire): self
    {
        $this->beneficiaire = $beneficiaire;

        return $this;
    }

	public function __toString()
	{
		return $this->created_at->format('Y-m-d H:i:s') . ", " .$this->points;
	}
}
