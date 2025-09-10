<?php

// added this so it render
if (PHP_SAPI !== 'cli') {
    header('Content-Type: text/plain');
}

class Student
{
    public string $name;
    public int $age;
    public array $grades;

    public function __construct(string $name, int $age, array $grades)
    {
        $this->name = $name;
        $this->age = $age;
        $this->grades = $grades;
    }
}

class StudentUtils
{

    public static function calculateAverage(Student $student): float
    {
        $sum = 0;
        $count = 0;
        foreach ($student->grades as $iValue) {
            $sum += $iValue;
            $count++;
        }

        return $count === 0 ? 0 : $sum / $count;
    }

    public static function getMention(Student $student): string
    {
        $average = self::calculateAverage($student);
        
//      return $average >= 90 ? "Excellent" : $average >= 75 ? "Bien" : $average >= 50 ? "Moyen" : "Insuffisant";
//      Mon IDE m'a dit que les ternaires imbriqués sont déprécié depuis PHP 7.4 donc j'ai cherché une autre solution  
//      match est apparament la bonne facon de faire depuis PHP 8.0
        return match (true) {
            $average >= 90 => "Excellent",
            $average >= 75 => "Bien",
            $average >= 50 => "Moyen",
            default => "Insuffisant",
        };
        
    }

    public static function isAdult(Student $student): bool
    {
        return $student->age >= 18;
    }


    public static function display(Student $student): void
    {
        echo "Nom : " . $student->name . PHP_EOL;
        echo "Âge : " . $student->age . PHP_EOL;
        echo "Notes : " . implode(", ", $student->grades) . PHP_EOL;
        echo "Moyenne : " . self::calculateAverage($student) . PHP_EOL;
        echo "Mention : " . self::getMention($student) . PHP_EOL;
        if (self::isAdult($student)) {
            echo "Statut : Adulte" . PHP_EOL;
        } else {
            echo "Statut : Mineur" . PHP_EOL;
        }
    }

    public static function loadStudents(): array
    {
        $students = [];

        $students[] = new Student("Alice", 20, [15, 18, 12, 14]);
        $students[] = new Student("Bob", 17, [10, 8, 9, 11]);
        $students[] = new Student("Charlie", 22, [20, 19, 18, 20]);
        $students[] = new Student("Diane", 19, [12, 14, 16, 13]);
        $students[] = new Student("Eve", 16, [7, 6, 5, 8]);

        return $students;
    }

    public static function displayAll(): void
    {
        $students = self::loadStudents();
        foreach ($students as $iValue) {
            echo "====================" . PHP_EOL;
            self::display($iValue);
        }
    }
}

StudentUtils::displayAll();
