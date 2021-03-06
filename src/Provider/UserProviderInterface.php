<?php

namespace PragmaPHP\UserAccess\Provider;

use \PragmaPHP\UserAccess\Entry\UserInterface;

interface UserProviderInterface extends EntryProviderInterface {

    public function createUser(UserInterface $user): UserInterface;

    public function getUser(string $id): UserInterface;

    public function getUsers(): array;

    public function findUsers(string $attributeName, string $attributeValue): array;

    public function updateUser(UserInterface $user): UserInterface;

    public function deleteUser(string $id);

    public function deleteUsers();

}