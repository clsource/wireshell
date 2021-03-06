<?php namespace Wireshell\Commands\Field;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Wireshell\Helpers\PwConnector;
use Wireshell\Helpers\WsTools;

/**
 * Class FieldCreateCommand
 *
 * Lists all available fieldtypes
 *
 * @package Wireshell
 * @author Tabea David
 */
class FieldTypesCommand extends PwConnector
{

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this
            ->setName('field:types')
            ->setDescription('Lists all available fieldtypes.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::bootstrapProcessWire($output);

        // get available fieldtypes
        $fieldtypes = array();
        foreach (\ProcessWire\wire('modules') as $module) {
            if (preg_match('/^Fieldtype/', $module->name)) {
                $fieldtypes[] = $module->name;
            }
        }

        WsTools::renderList('Fieldtypes', $fieldtypes, $output);
    }

}
