<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateI = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $etatI = null;


    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Event $event = null;

    #[ORM\ManyToOne(inversedBy: 'inscriptions')]
    private ?User $user = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateI(): ?\DateTimeInterface
    {
        return $this->dateI;
    }

    public function setDateI(?\DateTimeInterface $dateI): static
    {
        $this->dateI = $dateI;

        return $this;
    }

    public function getEtatI(): ?string
    {
        return $this->etatI;
    }

    public function setEtatI(?string $etatI): static
    {
        $this->etatI = $etatI;

        return $this;
    }



    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): static
    {
        $this->event = $event;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }


}
