<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class UserUpdateDto
{
    #[Assert\NotBlank]
    public $username;

    #[Assert\NotBlank]
    public $mail;
}
