<?php

namespace App\Service\CRUD;

use App\Entity\Role;

class RoleCrud extends AbstractDoctrineCrud
{
    protected string $entityName = Role::class;
}