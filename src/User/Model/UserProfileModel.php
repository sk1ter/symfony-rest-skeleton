<?php

/** @noinspection PhpPropertyOnlyWrittenInspection */
/** @noinspection UnusedConstructorDependenciesInspection */

namespace App\User\Model;

use DateTime;
use JetBrains\PhpStorm\Pure;
use App\User\Entity\UserProfile;
use JMS\Serializer\Annotation as Serializer;

class UserProfileModel
{
    private string $firstName;
    private string $lastName;
    private ?string $middleName;
    private ?string $phone;
    private ?string $email;

    /**
     * @Serializer\Exclude
     */
    private ?DateTime $birthday;

    #[Pure]
    public function __construct(UserProfile $userProfile)
    {
        $this->firstName = $userProfile->getFirstName();
        $this->lastName = $userProfile->getLastName();
        $this->middleName = $userProfile->getMiddleName();
        $this->phone = $userProfile->getPhone();
        $this->email = $userProfile->getEmail();
        $this->birthday = $userProfile->getBirthday();
    }

    /**
     * @Serializer\VirtualProperty()
     */
    public function getBirthday(): ?string
    {
        return $this->birthday->format('Y-m-d');
    }
}
