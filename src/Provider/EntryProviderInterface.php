<?php

namespace PragmaPHP\UserAccess\Provider;

use \PragmaPHP\UserAccess\Entry\EntryInterface;

interface EntryProviderInterface {

    public function isReadOnly(): bool;

    public function isIdExisting(string $id): bool;

    public function isUniqueNameExisting(string $uniqueName): bool;

    // public function createEntry(EntryInterface $entry): EntryInterface;

    // public function getEntry(string $id): EntryInterface;

    // public function getEntries(): array;

    // public function findEntries(string $attributeName, string $attributeValue): array;

    // public function updateEntry(EntryInterface $entry): EntryInterface;

    // public function deleteEntry(string $uniqueName);

    // public function deleteEntries();

}