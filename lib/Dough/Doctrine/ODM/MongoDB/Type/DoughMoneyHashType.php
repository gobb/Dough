<?php
namespace Dough\Doctrine\ODM\MongoDB\Type;

use Doctrine\ODM\MongoDB\Mapping\Types\Type;

class DoughMoneyHashType extends Type
{
    public function convertToDatabaseValue($value)
    {
        foreach ($value as $key => $item) {
            if ($item) {
                $value[$key] = Type::getType('dough_money')->convertToDatabaseValue($item);
            }
        }

        return $value;
    }

    public function convertToPHPValue($value)
    {
        foreach ($value as $key => $item) {
            if ($item) {
                $value[$key] = Type::getType('dough_money')->convertToPHPValue($item);
            }
        }

        return $value;
    }

    public function closureToMongo()
    {
        return '$process = $value;foreach ($process as $key => $value) { if ($value) { ' .
            Type::getType('dough_money')->closureToMongo() .
            '$process[$key] = $return; } } $return = $process;';
    }

    public function closureToPHP()
    {
        return '$process = $value;foreach ($process as $key => $value) { if ($value) { ' .
            Type::getType('dough_money')->closureToPHP() .
            '$process[$key] = $return; } } $return = $process;';
    }
}
