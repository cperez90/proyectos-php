<?php

namespace Core;

class Container
{
    protected $bindings = [];
    public function bind($key,$resolver)
    {
        $this->bindings[$key] = $resolver;
    }

    public function resolve($key)
    {
        if (! array_key_exists($key,$this->bindings)){
            throw new \Exception("No matching binding found for {$key}");
        }

        $resolver = $this->bindings[$key];

        if (is_callable($resolver)) {
            return $resolver($this);
        }

        return $this->instantiate($key);
    }

    private function instantiate($class)
    {
        $reflection = new \ReflectionClass($class);
        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            return new $class();
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {

            $dependency = $parameter->getClass();

            if ($dependency !== null) {

                $dependencies[] = $this->resolve($dependency->getName());
            } else {

                $dependencies[] = null;
            }
        }

        return $reflection->newInstanceArgs($dependencies);
    }
}