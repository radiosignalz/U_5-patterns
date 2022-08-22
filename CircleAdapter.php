<?php

//
//interface IPublisher
//{
//    public function publisher(string $content): void;
//}
//
//
//class TwitterAdapter implements IPublisher
//{
//    private $twitter;
//    public function __construct(Twitter $twitter)
//    {
//        $this->twitter = $twitter;
//    }
//
//
//    public function publisher(string $content): void
//    {
//        $this->twitter>sendTweet($content);
//    }

//2. Реализовать паттерн Адаптер для связи внешней библиотеки (классы SquareAreaLib и
//CircleAreaLib) вычисления площади квадрата (getSquareArea) и площади круга
//(getCircleArea) с интерфейсами ISquare и ICircle имеющегося кода. Примеры классов даны
//ниже. Причём во внешней библиотеке используются для расчётов формулы нахождения через
//диагонали фигур, а в интерфейсах квадрата и круга — формулы, принимающие значения
//одной стороны и длины окружности соответственно-->




interface ICircle
{
    function circleArea( $circumference);
}



class CircleAreaLib
{
    public function getCircleArea( $diagonal)
    {
        $area = (M_PI * $diagonal**2)/4;
return $area;
}
}

class CircleAreaAdapter implements ICircle
{
    protected $CirclAdd;

   public function __construct( )
   {

       $this->CirclAdd  = new CircleAreaLib();
   }

    public function circleArea( $circumference)
    {
        $this->CirclAdd->getCircleArea($circumference);
    }
}

function Circle($circumference){
    $circumference ->getCircleArea(34);
}




//
////Имеющиеся интерфейсы:
//
//interface ISquare
//{
//    function squareArea(int $sideSquare);
//}
//
//class SquareAreaLib
//{
//    public function getSquareArea(int $diagonal)
//    {
//        $area = ($diagonal**2)/2;
//        return $area;
//    }
//}