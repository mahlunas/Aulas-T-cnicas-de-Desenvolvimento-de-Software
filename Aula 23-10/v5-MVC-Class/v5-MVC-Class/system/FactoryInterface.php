<?php

/**
 * Interface for a factory
 *
 * A factory is an callable object that is able to create an object.
 */
interface FactoryInterface
{
    public function __invoke();
}
