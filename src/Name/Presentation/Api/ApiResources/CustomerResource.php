<?php

namespace Src\Name\Presentation\Api\ApiResources;

use Src\Name\Domain\Entities\Customer;

/**
 * @OA\Schema(
 *     schema="Customer",
 *     title="Customer",
 *     description="Customer resource",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="first_name",
 *         type="string",
 *         example="Alireza"
 *     ),
 *     @OA\Property(
 *         property="last_name",
 *         type="string",
 *         example="Porthos"
 *     ),
 *     @OA\Property(
 *         property="date_of_birth",
 *         type="string",
 *         format="date-time",
 *         example="1999-11-9"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         example="alireza@example.com"
 *     ),
 *     @OA\Property(
 *         property="phone_number",
 *         type="string",
 *         example="09910451706"
 *     ),
 *     @OA\Property(
 *         property="bank_account_number",
 *         type="string",
 *         minLength=9,
 *         maxLength=18,
 *         example="1234567890"
 *     ),
 * )
 */
class CustomerResource
{
    public function __construct(private readonly Customer $entity)
    {
    }

    public static function EntityToArray(Customer $entity)
    {
        return [
            'id' => $entity->getId()->getValue(),
            'first_name' => $entity->getFirstName()->getValue(),
            'last_name' => $entity->getLastName()->getValue(),
            'phone_number' => $entity->getPhoneNumber()->getValue(),
            'bank_account_number' => $entity->getBankAccountNumber()->getValue(),
            'date_of_birth' => $entity->getDateOfBirth()->getDateTime()->format('D M d Y H:i:s T'),
            'email' => $entity->getEmail()->getAddress()
        ];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->entity->getId()->getValue(),
            'first_name' => $this->entity->getFirstName()->getValue(),
            'last_name' => $this->entity->getLastName()->getValue(),
            'phone_number' => $this->entity->getPhoneNumber()->getValue(),
            'bank_account_number' => $this->entity->getBankAccountNumber()->getValue(),
            'date_of_birth' => $this->entity->getDateOfBirth()->getDateTime()->format('D M d Y H:i:s T'),
            'email' => $this->entity->getEmail()->getAddress()
        ];
    }
}
