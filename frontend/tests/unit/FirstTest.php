<?php namespace frontend\tests;

class FirstTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * @dataProvider pageProvider
     */
    public function testSum()
    {
        $this->assertEquals(
            $example['res'], $math->sum($example['a'], $example['b'])
        );
    }

    public function sumProvider()
    {

        return [
            ['a' => 4, 'b' => 5, 'res' => 9],
            ['a' => 0, 'b' => 5, 'res' => 5],
            ['a' => -2, 'b' => 5, 'res' => 3],
        ];
    }

    public function testSecond()
    {
        $this->assertEquals(4, 2 + 2);
    }
}