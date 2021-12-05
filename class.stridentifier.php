<?php

namespace StrIdentifier;

class StrIdentifier
{
    public static array $chars = [];
    public static array $mainRepository = [];
    public const REAL_LIMIT = 1679616;
    public const DIGIT = 4;

    public function __construct(int $_countOfStrInstance = 1000)
    {
        self::$chars = array_merge(range(0, 9), range('A', 'Z'));
        self::$mainRepository = self::fillRepository($_countOfStrInstance);
    }


    public static function checkStrInRepository(string $str, array $_repository): bool
    {
        return in_array($str, $_repository) ? 1 : 0;
    }

    public static function addStrInRepository(string $str, array &$_repository): void
    {
        if (!self::checkStrInRepository($str, $_repository))
            array_push($_repository, $str);

    }

    public static function factory(int $digit = self::DIGIT): string
    {
        $a = "";
        while (strlen($a) < $digit) {
            $randChar = array_rand(self::$chars, 1);
            $a .= self::$chars[$randChar];
        }

        //$this->addStrInRepository($a);

        return $a;
    }

    public static function fillRepository(int $_countOfStrInstance): array
    {

        while (count(self::$mainRepository) < $_countOfStrInstance) {
            $str = self::factory();
            self::addStrInRepository($str, self::$mainRepository);
        }

        return self::$mainRepository;
    }

    public static function countOfRepository(array &$_repository): int
    {
        return count($_repository);
    }

    public static function getRandomIndex(array &$_repository): int
    {
        return array_rand($_repository);
    }

    public static function getSliceRepository(int $_countOfSlice): array
    {
        if ($_countOfSlice < 1)
            return array("Parameter must bigger than 1");

        $_sliceOfRepository = array();

        for ($i = 0; $i <= $_countOfSlice; $i++)
            self::addStrInRepository(self::$mainRepository[self::getRandomIndex(self::$mainRepository)], $_sliceOfRepository);

        return $_sliceOfRepository;
    }

}