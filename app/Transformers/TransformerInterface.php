<?php

namespace app\Transformers;

interface TransformerInterface
{
    /**
     * Transforms the given item.
     * Returns an array.
     */
    public function transform($item);
}
