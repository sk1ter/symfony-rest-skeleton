<?php

namespace App\User\Command;

use App\User\Entity\User;
use App\Common\Enum\Role;
use App\User\Entity\UserProfile;
use App\User\Service\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

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
            ->addOption('username', 'i', InputArgument::REQUIRED, 'The username of user')
            ->addOption('password', null, InputArgument::REQUIRED, 'The password of user')
            ->addOption('roles', null, InputArgument::IS_ARRAY, 'The roles of user')
            ->setDescription('Creates a new user')
            ->setHelp('This command allows you to create a user;');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $input_username = new Question('username: ');
        $username = $helper->ask($input, $output, $input_username);

        $input_roles = new ChoiceQuestion(
            'roles:',
            [Role::USER, Role::ADMIN]
        );
        $input_roles->setMultiselect(true);
        $roles = $helper->ask($input, $output, $input_roles);

        $input_firstname = new Question('firstname: ');
        $firstname = $helper->ask($input, $output, $input_firstname);

        $input_lastname = new Question('lastname: ');
        $lastname = $helper->ask($input, $output, $input_lastname);

        $input_password = new Question('password: ');
        $input_password->setHidden(true);
        $password = $helper->ask($input, $output, $input_password);

        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setRoles($roles);

        $user_profile = new UserProfile();
        $user_profile->setFirstName($firstname);
        $user_profile->setLastName($lastname);
        $user_profile->setUser($user);

        $user->setProfile($user_profile);

        if ($this->userService->create($user)) {
            return Command::SUCCESS;
        }

        return Command::FAILURE;
    }
}
