<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Modele;
use App\Entity\Voiture;
use App\Entity\Locateur;
use App\Entity\Location;

use Doctrine\Persistence\ObjectManager;
use function Symfony\Component\Clock\now;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        // L'objectif de la création de l'objet $faker de type Generator est de générer des données fictives
        $faker = Factory::create();

        $voitures = [];
        for ($i = 0; $i < 50; $i++) {
            $voiture = new Voiture();
            $voiture->setNom($faker->name);
            $voiture->setImage($faker->imageUrl());
            $voiture->setNbKm($faker->numberBetween());
            $voiture->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($voiture);
            $voitures[] = $voiture;
        }

        $locateurs = [];
        for ($i = 0; $i < 50; $i++) {
            $locateur = new Locateur();
            $locateur->setNom($faker->name);
            $locateur->setPrenom($faker->name);
            $locateur->setAge($faker->numberBetween(18, 60));
            $locateur->setAdresse($faker->address());
            $locateur->setVoiture($voitures[$faker->numberBetween(12,13)]);
            $manager->persist($locateur);
            $locateurs[] = $locateur;
        }

        $locations = [];



        for ($i = 0; $i < 50; $i++) {

            // Créer une nouvelle instance de l'entité Location

            $location = new Location();
            // Définir la date de location comme la date et l'heure actuelles
            $location->setDateLocation(new \DateTime());
            // Générer un nombre aléatoire de jours de location entre 1 et 30
            $location->setNbJrLocation($faker->numberBetween(1, 30));

            // Générer un prix de location aléatoire entre 150 et 1600
            $location->setPrixLocation($faker->numberBetween(150, 1600));
            // Persist est l'objet Location (pour enregistrement en base de données)
            $manager->persist($location);
            // Ajouter l'objet Location au tableau $locations

            $locations[] = $location;
        }

        $modeles = [];


        for ($i = 0; $i < 100; $i++) {

            $modele = new Modele();

            $modele->setTypeModele($faker->name()); // Utiliser setTypeModele() au lieu de settype_modele()

            $modele->setAnneeModele($faker->numberBetween(1999, 2023)); // Utiliser setAnneeModele() au lieu de setannee_modele()

            $modele->setConso($faker->numberBetween(2, 15)); // Utiliser setConso() au lieu de setConso()

            $modele->addLocateur($locateurs[$faker->numberBetween(0, 49)]);

            $modele->addLocation($locations[$faker->numberBetween(0, 49)]);

            $manager->persist($modele);

            $modeles[] = $modele;
        }

        $manager->flush();
    }
}
