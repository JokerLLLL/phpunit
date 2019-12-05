<?php


namespace base;


use phpDocumentor\Reflection\Types\This;
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

    public static function testTwo()
    {
        $a = $b = 3;
        self::assertEquals(1,$a);
        self::assertEquals(2,$b);
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

    /**
     * 测试输入参数模拟
     * @throws \ReflectionException
     */
    public function testCallBackArgument()
    {
         $mockObserver = $this->getMockBuilder(Observer::class)
             ->setConstructorArgs(['testObserver'])
             ->setMethods(['update'])
             ->getMock();

         $mockObserver->expects($this->exactly(2))
             ->method('update')
             ->withConsecutive( // 每次调用使用不用的参数。
                 [$this->callback(function ($args){var_dump($args);return true;})],
                 [$this->equalTo('aaa')]
             );
         $subject = new Subject();
         $subject->attach($mockObserver);
         $subject->notify('aaa');
         $subject->notify('aaa');

        // 阻止 __constructor函数 返回true
        $mockObserver2 = $this->createMock(Observer::class);
        $mockObserver2->method('update')->will($this->returnValue(true));
        $this->assertEquals(true, $mockObserver2->update('aaa2'));

        // 返回参数自己
        $mockObserver2->method('delete')->will($this->returnArgument(0));
        $this->assertEquals('self', $mockObserver2->delete('self'));

    }

    public function testAsset()
    {
        $this->assertThat('aaa', $this->equalTo('aaa'));

        $mockObserver = $this->getMockBuilder(Observer::class)
            ->setMethods(['update','delete'])
            ->getMock();

        $mockObserver->expects($this->exactly(1))
            ->method('update')
            ->with($this->stringContains('bbb'));

        $mockObserver->expects($this->any())
            ->method('delete')
            ->with($this->stringContains('bbb'))
            ->will($this->returnArgument(true));

        $mockObserver->update('testaaabbb');
        $this->assertEquals(true, $mockObserver->delete('testaaabbb'));
    }
}