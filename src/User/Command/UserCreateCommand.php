<?php

namespace App\User\Command;

use App\User\Entity\User;
use App\User\Service\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserCreateCommand extends Command
{
    protected static $defaultName = 'app:user:create';

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('username', InputArgument::REQUIRED, 'The username of user')
            ->addArgument('password', InputArgument::REQUIRED, 'The password of user')
            ->addArgument('roles', InputArgument::IS_ARRAY, 'The roles of user')
            ->setDescription('Creates a new user')
            ->setHelp('This command allows you to create a user;');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = new User();
        $user->setUsername($input->getArgument('username'));
        $user->setPassword($input->getArgument('password'));

        if ($this->userService->create($user, $input->getArgument('roles'))) {
            return Command::SUCCESS;
        }

        return Command::FAILURE;
    }
}
