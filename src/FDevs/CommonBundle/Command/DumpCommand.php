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

    /** @var string */
    private $backupDir = 'backups';

    /** @var array */
    private $errors = array();

    /** @var array */
    private $output = array();

    /** @var string */
    private $host;

    /** @var  string */
    private $db;

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
        $this->db = $input->getOption('database') ? : $this->getContainer()->getParameter('mongodb.default_database');
        $dumpDir = $input->getOption('dump-dir') ? : $this->getContainer()->getParameter('kernel.root_dir') . "/dump/";
        $server = $input->getOption('server') ? : $this->getContainer()->getParameter('mongodb.default_server');

        $processBuilder = new ProcessBuilder();
        $processBuilder->setPrefix('mongodump');

        $this->host = parse_url($server, PHP_URL_HOST);
        $processBuilder->add('--host')->add($this->host);
        $processBuilder->add('--db')->add($this->db);

        if ($port = parse_url($server, PHP_URL_PORT)) {
            $processBuilder->add('--port')->add($port);
        }

        $processBuilder->add('--out')->add($dumpDir . $this->backupDir);

        $process = $processBuilder->getProcess();
        $process->run();
        if (!$this->checkStatus($process) || !$this->archive($dumpDir) || !$this->remove($dumpDir, $this->backupDir)) {
            /** @var \Symfony\Bridge\Monolog\Logger $logger */
            $logger = $this->getContainer()->get('logger');
            $logger->addError('error dump database', $this->errors);
        } else {
            $this->removeOld($dumpDir, 5);
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
     * @param  string $dumpDir
     * @return bool
     */
    private function archive($dumpDir)
    {
        $process = new Process("tar -zcvf " . $this->host . "-" . $this->db . "-" . date('d-m-Y') . ".tar.gz " . $this->backupDir, $dumpDir);
        $process->run();

        return $this->checkStatus($process);
    }

    /**
     * remove backup dir
     *
     * @param  string $dumpDir
     * @param  string $file
     * @return bool
     */
    private function remove($dumpDir, $file)
    {
        $process = new Process('rm -rf ' . $file, $dumpDir);
        $process->run();

        return $this->checkStatus($process);
    }

    /**
     * remove otd dumps
     *
     * @param  string $dumpDir
     * @param  int    $limit
     * @return bool
     */
    private function removeOld($dumpDir, $limit = 5)
    {
        $return = false;
        $process = new Process('ls -atr | egrep "^' . $this->host . '-' . $this->db . '-\d{2}-\d{2}-\d{4}\.tar\.gz"', $dumpDir);
        $process->run();

        if ($this->checkStatus($process)) {
            $data = explode("\n", $process->getOutput());
            if (count($data) > $limit + 1) {
                $return = $this->remove($dumpDir, current($data));
            } else {
                $return = true;
            }
        }

        return $return;
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
