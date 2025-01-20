<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:repository')]
class MakeRepositoryCommand extends GeneratorCommand
{

    /**
    * The type of class being generated.
    *
    * @var string
    */
    protected $type = 'Repository';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate repository class.';

    protected function getStub()
    {
        return  app_path().'/Console/CustomStubs/repository.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {

        return $rootNamespace.'\Repositories';
    }

    /**
     * Get thecommand arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of repository.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['name', null, InputOption::VALUE_REQUIRED, 'The name of repository that should be assigned.'],
        ];
    }
}
