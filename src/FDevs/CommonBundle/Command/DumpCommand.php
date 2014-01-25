<?php

namespace FDevs\CommonBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class DumpCommand extends Command
{

    /**
     * @var string
     */
    private $backupDir = 'backups';

    /**
     * @var array
     */
    private $errors = array();

    /**
     * @var array
     */
    private $output = array();

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('fdevs:dump')
            ->setDescription('Dump mongo')
            ->addOption('database', 'db', InputOption::VALUE_REQUIRED, 'Name Database')
            ->addOption('server', NULL, InputOption::VALUE_REQUIRED, 'server for example "localhost:27017"')
            ->addOption('dump-dir', NULL, InputOption::VALUE_REQUIRED, 'set Dump Dir');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $db = $input->getOption('database') ? : $this->getContainer()->getParameter('mongodb.default_database');
        $dumpDir = $input->getOption('dump-dir') ? : $this->getContainer()->getParameter('kernel.root_dir') . "/dump/";
        $server = $input->getOption('server') ? : $this->getContainer()->getParameter('mongodb.default_server');

        $processBuilder = new ProcessBuilder();
        $processBuilder->setPrefix('mongodump');

        $processBuilder->add('--host')->add(parse_url($server, PHP_URL_HOST));
        $processBuilder->add('--db')->add($db);

        if ($port = parse_url($server, PHP_URL_PORT)) {
            $processBuilder->add('--port')->add($port);
        }

        $processBuilder->add('--out')->add($dumpDir . $this->backupDir);

        $process = $processBuilder->getProcess();
        $process->run();
        if (!$this->checkStatus($process) || !$this->archive($dumpDir) || !$this->remove($dumpDir)) {
            /** @var \Symfony\Bridge\Monolog\Logger $logger */
            $logger = $this->getContainer()->get('logger');
            $logger->addError('error dump database', $this->errors);
        }

        if (!$input->getOption('no-debug')) {
            foreach ($this->output as $proOutput) {
                $output->writeln($proOutput);
            }
        }
    }

    /**
     * archive dumps dir
     *
     * @param $dumpDir
     * @return bool
     */
    private function archive($dumpDir)
    {
        $process = new Process("tar -zcvf " . date('d-m-Y') . ".tar.gz " . $this->backupDir, $dumpDir);
        $process->run();

        return $this->checkStatus($process);
    }

    /**
     * remove backup dir
     *
     * @param $dumpDir
     * @return bool
     */
    private function remove($dumpDir)
    {
        $process = new Process('rm -rf ' . $this->backupDir, $dumpDir);
        $process->run();

        return $this->checkStatus($process);
    }

    /**
     * check Process status
     *
     * @param  Process $process
     * @return bool
     */
    private function checkStatus(Process $process)
    {
        $status = $process->isSuccessful();

        if (!$status) {
            $this->errors[] = $process->getErrorOutput();
        } else {
            $this->output[] = $process->getOutput();
        }

        return $status;
    }
}
