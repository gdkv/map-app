<?php

namespace App\DataFixtures;

use App\Entity\Marker;
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

    private const MARKERS = [
        [
            'Заголовок метки',
            'Описание метки',
            [37.1618431, 56.7381785]
        ],
        [
            'Заголовок метки 2',
            'Описание метки',
            [37.1518431, 56.7381785]
        ],
        [
            'Заголовок метки 3',
            'Описание метки',
            [37.1558431, 56.7371785]
        ],
        [
            'Заголовок метки 4',
            'Описание метки',
            [37.1558431, 56.7391785]
        ],
    ];

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $this->usersLoad($manager);
        $this->markersLoad($manager);
    }

    private function usersLoad($manager) {
        foreach(self::USERS as list($email, $password, $fullName, $role)){
            $user = new User();
            $user->setEmail($email);
            $user->setFullName($fullName);
            $user->setRoles($role);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
            $manager->persist($user);

            $this->addReference($email, $user);
        }
        $manager->flush();
    }

    private function markersLoad($manager) {
        foreach(self::MARKERS as list($title, $description, $coords)){
            $ref = $this->getReference(self::USERS[rand(0, count(self::USERS)-1)][0]);

            $marker = new Marker();
            $marker->setTitle($title);
            $marker->setDescription($description);
            $marker->setCoord($coords);
            $marker->setUsers($ref);

            $manager->persist($marker);
        }
        $manager->flush();
    }
}
