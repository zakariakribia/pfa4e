<?php

namespace App\DataFixtures;

use App\Entity\DirecteurPedagogique;
use App\Entity\Entreprise;
use App\Entity\Etablissement;
use App\Entity\Laureat;
use App\Entity\Secretaire;
use App\Entity\Pays;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // Pays fixture
        $pays = new Pays();
        $pays->setNom('Pays test');

        $manager->persist($pays);

        // Etablissement fixture
        $etablissement = new Etablissement();
        $etablissement->setEmail('etablissement@diplome.com');
        $etablissement->setNom('Etablissement');
        $etablissement->setPrenom('Test');
        $etablissement->setTelephone('+21261000000');
        $etablissement->setDatenaissance(new \DateTime());
        $password = $this->encoder->encodePassword($etablissement, '123456');
        $etablissement->setPassword($password);
        $etablissement->setDeleted(false);
        $etablissement->setRoles(["ROLE_ETABLISSEMENT"]);
        $etablissement->setNomEtablissement('Etablissement Test');
        $etablissement->setLogo('test');
        $etablissement->setPays($pays);

        $manager->persist($etablissement);

        // Entreprise fixture
        $entreprise = new Entreprise();
        $entreprise->setEmail('entreprise@diplome.com');
        $entreprise->setNom('Etablissement');
        $entreprise->setPrenom('Test');
        $entreprise->setTelephone('+21261000000');
        $entreprise->setDatenaissance(new \DateTime());
        $password = $this->encoder->encodePassword($entreprise, '123456');
        $entreprise->setPassword($password);
        $entreprise->setDeleted(false);
        $entreprise->setRoles(["ROLE_ETABLISSEMENT"]);
        $entreprise->setNomEntreprise('Entreprise Test');
        $entreprise->setLogo('test');

        $manager->persist($entreprise);


        // Laureat fixture
        $laureat = new Laureat();
        $laureat->setEmail('laureat@diplome.com');
        $laureat->setNom('Laureat');
        $laureat->setPrenom('Test');
        $laureat->setTelephone('+21261000000');
        $laureat->setDatenaissance(new \DateTime());
        $password = $this->encoder->encodePassword($laureat, '123456');
        $laureat->setPassword($password);
        $laureat->setDeleted(false);
        $laureat->setRoles(["ROLE_LAUREAT"]);
        $laureat->setCinNumSejour('BKTest');
        $laureat->setLieuNaissance('Test City');
        $laureat->setNationalite('Test country');
        $laureat->setNomarabe('دويفلان');
        $laureat->setPrenomarabe('الفلاني');

        $manager->persist($laureat);


        // Directeur fixture
        $directeur = new DirecteurPedagogique();
        $directeur->setEmail('directeur@diplome.com');
        $directeur->setNom('Directeur');
        $directeur->setPrenom('Test');
        $directeur->setTelephone('+21261000000');
        $directeur->setDatenaissance(new \DateTime());
        $password = $this->encoder->encodePassword($directeur, '123456');
        $directeur->setPassword($password);
        $directeur->setRoles(["ROLE_DIRECTEUR"]);
        $directeur->setDeleted(false);
        $directeur->setEtablissement($etablissement);

        $manager->persist($directeur);

        // Secretaire fixture
        $secretaire = new Secretaire();
        $secretaire->setEmail('secretaire@diplome.com');
        $secretaire->setNom('Directeur');
        $secretaire->setPrenom('Test');
        $secretaire->setTelephone('+21261000000');
        $secretaire->setDatenaissance(new \DateTime());
        $password = $this->encoder->encodePassword($secretaire, '123456');
        $secretaire->setPassword($password);
        $secretaire->setRoles(["ROLE_SECRETAIRE"]);
        $secretaire->setDeleted(false);
        // Secretaire need setEnterprise() ??
        $secretaire->setEtablissement($etablissement);

        $manager->persist($secretaire);


        $manager->flush();
    }
}
