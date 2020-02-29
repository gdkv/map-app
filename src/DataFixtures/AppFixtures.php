<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class AppFixtures extends Fixture
{
    private $passwordEncoder;

    private const USERS = [
        [
            'admin@super.com',
            'admin12345',
            'Super Admin',
            ['ROLE_ADMIN'],
        ],
        [
            'dima@epictes.dev',
            'Dima1990!!',
            'Dima Gudkov',
            ['ROLE_USER'],
        ],
    ];

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $this->usersLoad($manager);
    }

    private function usersLoad($manager) {
        foreach(self::USERS as list($email, $password, $fullName, $role)){
            $user = new User();
            $user->setEmail($email);
            $user->setFullName($fullName);
            $user->setRoles($role);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
            $manager->persist($user);
        }
        $manager->flush();
    }
}
