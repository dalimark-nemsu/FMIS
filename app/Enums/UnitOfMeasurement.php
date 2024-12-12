<?php

namespace App\Enums;

enum UnitOfMeasurement: string
{
    case PIECE = 'piece';
    case KILOGRAM = 'kilogram';
    case GRAM = 'gram';
    case LITER = 'liter';
    case MILLILITER = 'milliliter';
    case METER = 'meter';
    case CENTIMETER = 'centimeter';
    case MILLIMETER = 'millimeter';
    case SQUARE_METER = 'square_meter';
    case CUBIC_METER = 'cubic_meter';
    case PACK = 'pack';
    case BOX = 'box';
    case DOZEN = 'dozen';
    case GALLON = 'gallon';
    case PINT = 'pint';
    case QUART = 'quart';
    case TON = 'ton';
    case UNIT = 'unit';
    case REAM = 'ream';

    /**
     * Get all enum values as an array.
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get the label for each enum value.
     *
     * @return array
     */
    public static function labels(): array
    {
        return [
            self::PIECE->value => 'Piece',
            self::KILOGRAM->value => 'Kilogram',
            self::GRAM->value => 'Gram',
            self::LITER->value => 'Liter',
            self::MILLILITER->value => 'Milliliter',
            self::METER->value => 'Meter',
            self::CENTIMETER->value => 'Centimeter',
            self::MILLIMETER->value => 'Millimeter',
            self::SQUARE_METER->value => 'Square Meter',
            self::CUBIC_METER->value => 'Cubic Meter',
            self::PACK->value => 'Pack',
            self::BOX->value => 'Box',
            self::DOZEN->value => 'Dozen',
            self::GALLON->value => 'Gallon',
            self::PINT->value => 'Pint',
            self::QUART->value => 'Quart',
            self::TON->value => 'Ton',
            self::UNIT->value => 'Unit',
            self::REAM->value => 'Ream',
        ];
    }

    /**
     * Get the label for a specific enum value.
     *
     * @param string $value
     * @return string|null
     */
    public static function label(string $value): ?string
    {
        return self::labels()[$value] ?? null;
    }
}
