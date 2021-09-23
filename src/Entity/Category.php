<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="category")
     */
    private $content_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_date;

    /**
     * @ORM\OneToMany(targetEntity=Content::class, mappedBy="ida")
     */
    private $content_ida;

    public function __construct()
    {
        $this->content_ida = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentId(): ?int
    {
        return $this->content_id;
    }

    public function setContentId(int $content_id): self
    {
        $this->content_id = $content_id;

        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->create_date;
    }

    public function setCreateDate(\DateTimeInterface $create_date): self
    {
        $this->create_date = $create_date;

        return $this;
    }

    /**
     * @return Collection|Content[]
     */
    public function getContentIda(): Collection
    {
        return $this->content_ida;
    }

    public function addContentIda(Content $contentIda): self
    {
        if (!$this->content_ida->contains($contentIda)) {
            $this->content_ida[] = $contentIda;
            $contentIda->setIda($this);
        }

        return $this;
    }

    public function removeContentIda(Content $contentIda): self
    {
        if ($this->content_ida->removeElement($contentIda)) {
            // set the owning side to null (unless already changed)
            if ($contentIda->getIda() === $this) {
                $contentIda->setIda(null);
            }
        }

        return $this;
    }
}
