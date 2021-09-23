<?php

namespace Hotelchamp\Larabee\Tests;

use InvalidArgumentException;
use Hotelchamp\Larabee\Filters\FilterBuilder;

class FilterBuilderTest extends TestCase
{
    /**
     * Test it can build a filter correctly
     */
    public function testItCanBuildAFilter()
    {
        $callBack = function (array $filter) {
            $this->assertEquals(
                [
                    'planId[is]' => '123',
                    'name[isNot]' => 'testName',
                    'status[in]' => ['active'],
                    'category[notIn]' => ['tech'],
                    'price[isPresent]' => true,
                    'firstName[startsWith]' => 'Jo',
                    'total[gt]' => 999,
                    'sum[gte]' => 99.99,
                    'productsCount[lt]' => 100,
                    'inventory[lte]' => 1000,
                    'age[between]' => [18, 35],
                    'createdAt[on]' => 1456147530,
                    'updatedAt[before]' => 1456147530,
                    'createdAt[after]' => 1456147530
                ],
                $filter
            );
        };

        $filterBuilder = new FilterBuilder($callBack);

        $filterBuilder
            ->where('planId', '=', '123')
            ->where('name', '!=', 'testName')
            ->where('status', 'in', ['active'])
            ->where('category', 'not in', ['tech'])
            ->where('price', 'isset', true)
            ->where('firstName', 'starts with', 'Jo')
            ->where('total', '>', 999)
            ->where('sum', '>=', 99.99)
            ->where('productsCount', '<', 100)
            ->where('inventory', '<=', 1000)
            ->where('age', 'between', [18, 35])
            ->where('age', 'between', [18, 35])
            ->where('createdAt', 'on', 1456147530)
            ->where('updatedAt', 'before', 1456147530)
            ->where('createdAt', 'after', 1456147530)
            ->get();
    }

    /**
     * Test it throws exception on invalid arguments
     */
    public function testItThrowsExceptionOnInvalidArguments()
    {
        $this->expectException(InvalidArgumentException::class);

        $filterBuilder = new FilterBuilder(fn($filter) => dump($filter));

        $filterBuilder->where('test', '<>', 'something');
    }

    /**
     * Test shortened version of equal filter
     */
    public function testItSupportsShortenedVersionForEqual()
    {
        $callBack = function (array $filter) {
            $this->assertEquals(['test[is]' => 'something'], $filter);
        };

        $filterBuilder = new FilterBuilder($callBack);

        $filterBuilder->where('test', 'something')->get();
    }

    /**
     * Test limiting returned records
     */
    public function testItSetsALimit()
    {
        $callBack = function (array $filter) {
            $this->assertEquals(['limit' => 10], $filter);
        };

        $filterBuilder = new FilterBuilder($callBack);

        $filterBuilder->limit(10)->get();
    }

    /**
     * Test sorting
     */
    public function testItSorts()
    {
        $callBack = function (array $filter) {
            $this->assertEquals(['sort_by[asc]' => 'createdAt'], $filter);
        };

        $filterBuilder = new FilterBuilder($callBack);

        $filterBuilder->sortBy('createdAt', 'asc')->get();
    }
}
