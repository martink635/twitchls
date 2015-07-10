<?php

namespace App\Transformers;

class Transformer
{
    /**
     * Transforms an iterable object with the given transformer.
     * The transformer can be an anonymouse function or it has
     * to implement the TransformerInterface.
     *
     * @param  $object
     * @param  $transformer
     * @return array
     */
    public function transform($object, $transformer)
    {
        $transformedData = [];

        foreach ($object as $item) {
            $transformedData[] = $this->fireTransformer($transformer, $item);
        }

        return $transformedData;
    }

    /**
     * Fire the transformerm on the given item.
     *
     * @param  $transformer
     * @param  $item
     */
    public function fireTransformer($transformer, $item)
    {
        if (is_callable($transformer)) {
            return call_user_func($transformer, $item);
        }

        return $transformer->transform($item);
    }
}
