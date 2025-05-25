<?php

class CalorieCalculator
{
    // Використання констант для підвищення читабельності та підтримуваності формул
    const BMR_MALE_CONSTANT = 5;
    const BMR_FEMALE_CONSTANT = -161;
    const WEIGHT_MULTIPLIER = 10;
    const HEIGHT_MULTIPLIER = 6.25;
    const AGE_MULTIPLIER = 5;

    // Масив для множників активності
    private array $activityMultipliers = [
        'sedentary' => 1.2,
        'lightly' => 1.375,
        'moderately' => 1.55,
        'very' => 1.725,
        'extra' => 1.9
    ];

    /**
     * Обчислює добову норму калорій на основі вхідних даних.
     *
     * @param string $gender Стать ('male' або 'female').
     * @param float $weight Вага у кг.
     * @param float $height Зріст у см.
     * @param int $age Вік у роках.
     * @param string $activity Рівень активності (ключ з $activityMultipliers).
     * @return float Добова норма калорій.
     */
    public function calculateCalories(string $gender, float $weight, float $height, int $age, string $activity): float
    {
        $bmr = $this->calculateBMR($gender, $weight, $height, $age);
        // Якщо рівень активності не знайдено, використовуємо значення для "sedentary" за замовчуванням
        $calories = $bmr * ($this->activityMultipliers[$activity] ?? $this->activityMultipliers['sedentary']);
        return $calories;
    }

    /**
     * Обчислює базовий метаболізм (BMR) за формулою Міффліна-Сан-Жеора.
     *
     * @param string $gender Стать ('male' або 'female').
     * @param float $weight Вага у кг.
     * @param float $height Зріст у см.
     * @param int $age Вік у роках.
     * @return float Значення BMR.
     */
    private function calculateBMR(string $gender, float $weight, float $height, int $age): float
    {
        if ($gender === 'male') {
            return self::WEIGHT_MULTIPLIER * $weight + self::HEIGHT_MULTIPLIER * $height - self::AGE_MULTIPLIER * $age + self::BMR_MALE_CONSTANT;
        } else {
            return self::WEIGHT_MULTIPLIER * $weight + self::HEIGHT_MULTIPLIER * $height - self::AGE_MULTIPLIER * $age + self::BMR_FEMALE_CONSTANT;
        }
    }
}