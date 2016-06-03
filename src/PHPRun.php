<?php

namespace Lemon\PHPRun;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Lemon\Cli\App;
use Lemon\PHPRun\Provider\AppServiceProvider;
use Lemon\PHPRun\Console\Command\InitialCommand;

/**
 * @property-read \Lemon\Cli\Console\ContainerAwareApplication $console
 * @property-read \Lemon\PHPRun\Type\Collection $servers
 * @property-read \Lemon\PHPRun\Type\Collection $environments
 * @property-read \Lemon\PHPRun\Type\Collection $parameters
 * @property-read \Lemon\PHPRun\Type\Collection $tasks
 * @property-read \Lemon\PHPRun\Type\Collection $scenarios
 */
class PHPRun extends App
{
    protected static $instance;

    public static function get()
    {
        return self::$instance;
    }

    public function __construct($name, $version = null, array $values = array())
    {
        parent::__construct($name, $version, $values);

        $this->register(new AppServiceProvider());

        // add build-in commands
        $this->addCommand(new InitialCommand('init'));
        $this->addCommand($this->createSelfUpdateCommand());

        $this->console->getDefinition()->addOption(new InputOption('--file', '-f', InputOption::VALUE_OPTIONAL, 'Specify Deployer file.'));

        self::$instance = $this;
    }

    public function __get($key)
    {
        if (isset($this->container[$key])) {
            return $this->container[$key];
        }
    }

    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        // TODO: add task command
        parent::run($input, $output);
    }

    protected function createSelfUpdateCommand()
    {
        $command = new \Deployer\Component\PharUpdate\Console\Command('self-update');
        $command->setDescription('Updates deployer.phar to the latest version');
        $command->setManifestUri('http://deployer.org/manifest.json');

        return $command;
    }
}