<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 * @Vich\Uploadable()
 */
class Item extends BaseEntity
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="items")
     */
    private $categories;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @Vich\UploadableField(mapping="item_files", fileNameProperty="filename")
     * 
     * @var File
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $format;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="items")
     */
    private $tags;

    
    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category)
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category)
    {
        $this->categories->removeElement($category);

        return $this;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function setFilename(string $filename)
    {
        $this->filename = $filename;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(?File $file = null)
    {
        $this->file = $file;

        if ($file instanceof UploadedFile) {

            $this->updatedAt = new \DateTime();
        }

        return $this;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat(string $format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }

}
