<?php

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
        if ($average >= 90) {
            return "Excellent";
        }

        if ($average >= 75) {
            return "Bien";
        }

        if ($average >= 50) {
            return "Moyen";
        }

        return "Insuffisant";
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
