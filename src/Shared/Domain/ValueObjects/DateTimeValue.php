<?php

namespace Src\Shared\Domain\ValueObjects;

use DateTime;
use Src\Shared\Exceptions\ValueObjects\DateTimeIsInvalid;

class DateTimeValue
{
    private DateTime $datetime;

    public function __construct(private ?string $dateTimeString)
    {
        $this->validateDate($dateTimeString);
        $this->datetime = new DateTime($dateTimeString);
    }

    public function getDateTime()
    {
        return $this->datetime;
    }

    private function validateDate($dateTimeString)
    {
        $format = 'Y-m-d\TH:i';

        $dateTime = DateTime::createFromFormat($format, $dateTimeString);

        $isValid = $dateTime && $dateTime->format($format) === $dateTimeString;

        if (!$isValid) {
            throw new DateTimeIsInvalid();
        }
    }

    public function __toString()
    {
        return $this->datetime->format("d/m/Y H:i");
    }
}
