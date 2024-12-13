<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-test-users',
    description: 'Crée des utilisateurs de test (admin et user)',
)]
class CreateUserCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Création de l'admin
        $admin = new User();
        $admin->setEmail('admin@test.com');
        $admin->setName('Admin Test');
        $admin->setPhoneNumber('0123456789');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
            $this->passwordHasher->hashPassword($admin, 'admin123')
        );

        // Création de l'utilisateur
        $user = new User();
        $user->setEmail('user@test.com');
        $user->setName('User Test');
        $user->setPhoneNumber('0987654321');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, 'user123')
        );

        $this->entityManager->persist($admin);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $output->writeln('Utilisateurs de test créés avec succès!');

        return Command::SUCCESS;
    }
}