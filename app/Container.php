<?php

namespace App;

use App\Exception\ContainerException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements ContainerInterface
{

    private array $entries = [];

//    public function get(string $id)
//    {
//        if (! $this->has($id)) {
//            throw new NotFoundException("Class '" . $id . "' has no binding");
//        }
//
//        $entry = $this->entries[$id];
//
//        return $entry($this);
//    }

    public function get(string $id)
    {
        // Using "autowiring" technique

        if ($this->has($id)) {
            $entry = $this->entries[$id];

            if (is_callable($entry)) {
                return $entry($this);
            }

            // Here, since the $entry is not callable, it is safe to say that
            // the string passed is the full qualified class name of an interface.

//            return $this->resolve($entry);

            $id = $entry;
        }

        return $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable|string $concrete)
    {
        $this->entries[$id] = $concrete;
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws \ReflectionException
     * @throws ContainerExceptionInterface
     * @throws ContainerException
     */
    public function resolve(string $id)
    {
        // 1. Inspect the class that we are trying to get from the container
        $reflectionClass = new \ReflectionClass($id);
        if (! $reflectionClass->isInstantiable()) {
            throw new ContainerException("Class '$id' is not instantiable");
        }

        // 2. Inspect the constructor of the class
        $constructor = $reflectionClass->getConstructor();
        if (! $constructor) {
//            return $reflectionClass->newInstance();
            return new $id;
        }

        // 3. Inspect the constructor parameters (dependencies)
        $parameters = $constructor->getParameters();
        if (! $parameters) {
            return new $id;
        }

        // 4. If the constructor parameter is a class then try to resolve that class using the container
        $dependencies = array_map(function (\ReflectionParameter $param) use ($id) {
            $name = $param->getName();
            $type = $param->getType();

            if (! $type) {
                throw new ContainerException(
                    "Failed to resolve class $id because param $name is missing a type hint"
                );
            }

            if ($type instanceof \ReflectionUnionType) {
                throw new ContainerException(
                    "Failed to resolve class $id because of union type for param $name"
                );
            }

            if ($type instanceof \ReflectionNamedType && ! $type->isBuiltin()) {
                return $this->get($type->getName());
            }

            throw new ContainerException(
                "Failed to resolve class $id because invalid param $name"
            );

        }, $parameters);

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    public function getEntries(): array
    {
        return $this->entries;
    }
}