<?php

namespace App\Command;

use App\Entity\Idea;
use App\Repository\IdeaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use Symfony\Component\String\ByteString;

#[AsCommand(
    name: 'gen-ideas',
    description: 'Add a short description for your command',
)]
class GenIdeasCommand extends Command
{

    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('amount', InputArgument::REQUIRED, 'Ideas amount')
        ;
    }

    protected function randomText(): string {
        $words = [];
        for($i = 0; $i<= random_int(8, 30); $i++) {
            $words[] = ByteString::fromRandom(random_int(3, 16));
        }
        return implode(" ", $words);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $amount = $input->getArgument('amount');

        if ($amount) {
            $io->note(sprintf('Start ideas generator : %s', $amount));
        }
        $io->progressStart($amount);
        $f = 0;
        // $this->entityManager->beginTransaction();
        for ($i = 0; $i < $amount; $i++) {
            $left = $amount - $i;
            if ($i - $f > 1000) {
                $this->entityManager->flush();
                gc_collect_cycles();
                sleep(1);
                $f = $i;
            }
            $di = \DateInterval::createFromDateString("$left hours");
            $dt = (new \DateTime())->sub($di);
            $idea = new Idea();
            $idea->setTitle($this->randomText());
            $idea->setCreatedAt(\DateTimeImmutable::createFromInterface($dt));
            $this->entityManager->persist($idea);
            $io->progressAdvance();
            unset($idea);
            unset($dt);
            unset($di);
        }
        // $this->entityManager->commit();
        $this->entityManager->flush();

        $io->progressFinish();
        $io->success('finish.');

        return Command::SUCCESS;
    }
}
