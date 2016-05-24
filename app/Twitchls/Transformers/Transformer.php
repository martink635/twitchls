<?php

namespace Twitchls\Transformers;

class Transformer
{
    /**
     * Transforms an iterable object or a single entity with
     * the given transformer. The transformer can be an anonymous
     * function or it has to implement the TransformerInterface.
     *
     * @param  $object
     * @param  $transformer
     * @param  $collection
     * @return array
     */
    public function transform($object, $transformer, $collection = true)
    {
        if (! $collection) {
            return $this->fireTransformer($transformer, $object);
        }

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
