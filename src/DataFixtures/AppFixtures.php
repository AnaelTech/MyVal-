<?php

namespace App\DataFixtures;

use App\Entity\LogoDefaultTeam;
use App\Entity\Maps;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {
    }
    public function load(ObjectManager $manager): void
    {

        $mapsData = [
            ["name" => "Ascent", "image" => "https://media.valorant-api.com/maps/7eaecc1b-4337-bbf6-6ab9-04b8f06b3319/splash.png"],
            ["name" => "Split", "image" => "https://media.valorant-api.com/maps/d960549e-485c-e861-8d71-aa9d1aed12a2/splash.png"],
            ["name" => "Fracture", "image" => "https://media.valorant-api.com/maps/b529448b-4d60-346e-e89e-00a4c527a405/splash.png"],
            ["name" => "Bind", "image" => "https://media.valorant-api.com/maps/2c9d57ec-4431-9c5e-2939-8f9ef6dd5cba/splash.png"],
            ["name" => "Breeze", "image" => "https://media.valorant-api.com/maps/2fb9a4fd-47b8-4e7d-a969-74b4046ebd53/splash.png"],
            ["name" => "District", "image" => "https://media.valorant-api.com/maps/690b3ed2-4dff-945b-8223-6da834e30d24/splash.png"],
            ["name" => "Kasbah", "image" => "https://media.valorant-api.com/maps/12452a9d-48c3-0b02-e7eb-0381c3520404/splash.png"],
            ["name" => "Drift", "image" => "https://media.valorant-api.com/maps/2c09d728-42d5-30d8-43dc-96a05cc7ee9d/splash.png"],
            ["name" => "Piazza", "image" => "https://media.valorant-api.com/maps/de28aa9b-4cbe-1003-320e-6cb3ec309557/splash.png"],
            ["name" => "Lotus", "image" => "https://media.valorant-api.com/maps/2fe4ed3a-450a-948b-6d6b-e89a78e680a9/splash.png"],
            ["name" => "Sunset", "image" => "https://media.valorant-api.com/maps/92584fbe-486a-b1b2-9faa-39b0f486b498/splash.png"],
            ["name" => "Pearl", "image" => "https://media.valorant-api.com/maps/fd267378-4d1d-484f-ff52-77821ed10dc2/splash.png"],
            ["name" => "Icebox", "image" => "https://media.valorant-api.com/maps/e2ad5c54-4114-a870-9641-8ea21279579a/splash.png"],
            ["name" => "The Range", "image" => "https://media.valorant-api.com/maps/ee613ee9-28b7-4beb-9666-08db13bb2244/splash.png"],
            ["name" => "Haven", "image" => "https://media.valorant-api.com/maps/2bee0dc9-4ffe-519b-1cbd-7fbe763a6047/splash.png"],
        ];

        foreach ($mapsData as $data) {
            $map = new Maps();
            $map->setName($data["name"]);
            $map->setImage($data["image"]);

            $manager->persist($map);
        }

        $logoName = [
            ["name" => "https://dt2sdf0db8zob.cloudfront.net/wp-content/uploads/2019/08/10-Best-Gaming-Team-Logos-and-How-to-Make-Your-Own-CurrentYear-image1-1.png"],
            ["name" => "https://static.vecteezy.com/system/resources/previews/016/467/720/original/tiger-logo-esport-team-png.png"],
            ["name" => "https://marketplace.canva.com/EAFzgKeP2Ks/1/0/1600w/canva-abstract-vintage-spartan-warrior-mascot-logo-XmgpXpNtu3Y.jpg"],
        ];

        foreach ($logoName as $logo) {
            $logoDefaultTeam = new LogoDefaultTeam;
            $logoDefaultTeam->setName($logo["name"]);
            $manager->persist($logoDefaultTeam);
        }
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();


        $user
            ->setEmail("test@test.com")
            ->setPseudoValo("LuniiiKzz")
            ->setTag("6165")
            ->setPassword($this->hasher->hashPassword($user, "test1234"));

        $manager->persist($user);

        $manager->flush();
    }
}
