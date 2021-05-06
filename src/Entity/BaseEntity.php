<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\HasLifecycleCallbacks
 */
class BaseEntity
{

    /**
     * @var DateTime $created
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;


    /**
     * @var DateTime $updated
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;



    public function getCreatedAt() :?\DateTime
    {
        return $this->createdAt;
    }



    public function getUpdatedAt() :?\DateTime
    {
        return $this->updatedAt;
    }

}