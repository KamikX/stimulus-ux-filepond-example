<?php

namespace App\DTO;
use Symfony\Component\Validator\Constraints as Assert;
class PostDTO
{

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public ?string $name = null;
    public ?string $fileName = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): void
    {
        $this->fileName = $fileName;
    }




}