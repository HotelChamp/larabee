<?php

namespace Hotelchamp\Larabee\Contracts;

use Illuminate\Support\Collection;

interface Resource
{
    /**
     * Get all entities
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Find an entity by id
     *
     * @param string $id
     * @return mixed
     */
    public function findById(string $id): mixed;

    /**
     * Create a new entity
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed;

    /**
     * Update an entity
     *
     * @param string $id
     * @param array $data
     * @return mixed
     */
    public function update(string $id, array $data): mixed;

    /**
     * Delete an entity
     *
     * @param string $id
     * @return mixed
     */
    public function delete(string $id): mixed;
}
