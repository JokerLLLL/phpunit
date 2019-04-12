<?php


namespace base;


use PHPUnit\Framework\TestCase;

class Unit extends TestCase
{
    /**
     * 测试array
     */
    public static function testArray()
    {

//        self::markTestIncomplete('this is not complete!');
        $array = [
            1 => [
                'b' => [
                    'c' => 'cqn'
                ]
            ],
            2 => [
                'b' => [
                    'c' => 'xxx'
                ]
            ]
        ];
        self::assertEquals('xxx','xxx');

        /**
         * assertInternalType() is deprecated and will be removed in PHPUnit 9.
         * Refactor your test to use
         * assertIsArray(), assertIsBool(), assertIsFloat(), assertIsInt(),
         * assertIsNumeric(), assertIsObject(), assertIsResource(), assertIsString(),
         * assertIsScalar(), assertIsCallable(), or assertIsIterable()
         * instead.
         */
         // $this->assertInternalType('array',$array);

         self::assertIsArray($array,'this is not array');
         self::assertEquals(1,'01');            //相等
         self::assertArrayHasKey('abc',['abc'=>'aaa']);

    }

    /**
     * @var DataTeller
     */
    private $clazz;
    private $input = '1456265665';

    /**
     * 初始化试用参数
     */
    public  function setUp(): void
    {
        $this->clazz = new DataTeller($this->input);
    }

    public  function testDataIsTrue()
    {
        $data = $this->clazz->getData(true);
        $this->assertIsString($data);
    }

    public function testDataIsFalse()
    {
        $data = $this->clazz->getData(false);
        $this->assertIsNumeric($data);
    }

    public function testDataException()
    {
        $this->clazz = new DataTeller(null);
        try{
            $data = $this->clazz->getData(false);
        }catch (\Throwable $exception) {
            $this->assertEquals('data is not init!',$exception->getMessage());
        }

    }
}