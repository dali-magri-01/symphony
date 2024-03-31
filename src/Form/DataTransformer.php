<?php

namespace App\Form;

// src/Form/DataTransformer/DateTimeToStringTransformer.php

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DateTimeToStringTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }

        // Transforme l'objet DateTime en chaîne de caractères
        return $value->format('Y-m-d');
    }

    public function reverseTransform($value)
    {
        // Convertit la chaîne de caractères en objet DateTime
        try {
            return new \DateTime($value);
        } catch (\Exception $e) {
            throw new TransformationFailedException('Invalid date format');
        }
    }
}
