<?php

namespace App\Service\CRUD;

use App\Entity\User;

class UserCrud extends AbstractDoctrineCrud
{
    protected string $entityName = User::class;
}