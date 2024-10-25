<?php
namespace App\Helpers;

use App\Models\CampusBudgetCeiling;
use App\Models\UnitBudgetCeiling;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class BudgetCeilingCalculation
{
    /**
     * Get the total allocated budget at the campus level.
     *
     * @param Collection $data
     * @return float
     */
    public static function getCampusTotalAllocatedBudget(Collection $data): float
    {
        return $data->pluck('total_amount')->sum();
    }

    /**
     * Get the total allocated budget across all units for the specified campus.
     *
     * @param Collection $data
     * @return float
     */
    public static function getCampusUnitTotalAllocated(Collection $data): float
    {
        return $data->map(function ($budget) {
            return $budget->unitBudgetCeilings->sum('total_amount');
        })->sum();
    }

    /**
     * Get the total unallocated budget for the campus.
     *
     * Unallocated budget = total campus budget - total allocated to units
     *
     * @param Collection $data
     * @return float
     */
    public static function getCampusUnitTotalUnallocated(Collection $data): float
    {
        $campusTotalAllocated = self::getCampusTotalAllocatedBudget($data);
        $unitTotalAllocated = self::getCampusUnitTotalAllocated($data);

        return $campusTotalAllocated - $unitTotalAllocated;
    }

    /**
     * Get the total allocated PS budget for the unit.
     *
     * @param CampusBudgetCeiling $data
     * @return float
     */
    public static function getUnitPSTotalAllocated(CampusBudgetCeiling $data): float
    {
        return $data->unitBudgetCeilings->sum('ps');
    }

    /**
     * Get the total allocated MOOE budget for the unit.
     *
     * @param CampusBudgetCeiling $data
     * @return float
     */
    public static function getUnitMOOETotalAllocated(CampusBudgetCeiling $data): float
    {
        return $data->unitBudgetCeilings->sum('mooe');
    }

    /**
     * Get the total allocated CO budget for the unit.
     *
     * @param CampusBudgetCeiling $data
     * @return float
     */
    public static function getUnitCOTotalAllocated(CampusBudgetCeiling $data): float
    {
        return $data->unitBudgetCeilings->sum('co');
    }

    /**
     * Get the total allocated budget for the unit.
     *
     * @param CampusBudgetCeiling $data
     * @return float
     */
    public static function getUnitTotalAllocated(CampusBudgetCeiling $data): float
    {
        return $data->unitBudgetCeilings->sum('total_amount');
    }

    /**
     * Get the unallocated amount based on the allocated amount and a specific field.
     *
     * @param float $allocatedAmount
     * @param float $dataField
     * @return float
     */
    public static function getUnitUnallocated(float $allocatedAmount, float $dataField): float
    {
        return $dataField - $allocatedAmount;
    }

    /**
     * Get the total unallocated PS budget for the unit.
     *
     * @param CampusBudgetCeiling $data
     * @return float
     */
    public static function getUnitPSTotalUnallocated(CampusBudgetCeiling $data): float
    {
        $allocatedPSTotal = self::getUnitPSTotalAllocated($data);
        return self::getUnitUnallocated($allocatedPSTotal, $data->ps);
    }

    /**
     * Get the total unallocated MOOE budget for the unit.
     *
     * @param CampusBudgetCeiling $data
     * @return float
     */
    public static function getUnitMOOETotalUnallocated(CampusBudgetCeiling $data): float
    {
        $allocatedMOOETotal = self::getUnitMOOETotalAllocated($data);
        return self::getUnitUnallocated($allocatedMOOETotal, $data->mooe);
    }

    /**
     * Get the total unallocated CO budget for the unit.
     *
     * @param CampusBudgetCeiling $data
     * @return float
     */
    public static function getUnitCOTotalUnallocated(CampusBudgetCeiling $data): float
    {
        $allocatedCOTotal = self::getUnitCOTotalAllocated($data);
        return self::getUnitUnallocated($allocatedCOTotal, $data->co);
    }

    /**
     * Get the total unallocated budget for the unit.
     *
     * @param CampusBudgetCeiling $data
     * @return float
     */
    public static function getUnitTotalUnallocated(CampusBudgetCeiling $data): float
    {
        $allocatedTotal = self::getUnitTotalAllocated($data);
        return self::getUnitUnallocated($allocatedTotal, $data->total_amount);
    }

    /**
     * Calculate the total amount from PS, MOOE, and CO values.
     *
     * @param float $ps
     * @param float $mooe
     * @param float $co
     * @param float $providedTotal
     * @return float
     */
    public static function calculateTotalAmount(float $ps, float $mooe, float $co, float $providedTotal): float
    {
        // Calculate the sum if PS, MOOE, and CO are provided, otherwise return the provided total
        return ($ps > 0 || $mooe > 0 || $co > 0) ? $ps + $mooe + $co : $providedTotal;
    }

}
