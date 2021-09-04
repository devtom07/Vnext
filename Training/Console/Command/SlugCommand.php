<?php

namespace Vnext\Training\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Vnext\Training\Model\StudentFactory;

/**
 * Class SomeCommand
 */
class SlugCommand extends Command
{

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('slug:command');
        $this->setDescription('This is my console command.');

        parent::configure();
    }


    protected $StudentFactory;

    public function __construct(StudentFactory $StudentFactory)
    {
        parent::__construct('toslug:command');
        $this->StudentFactory = $StudentFactory;
    }

    public static function toSlug($str, $delimiter = '-')
    {

        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $slug;

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $post = $this->StudentFactory->create();
        $students = $this->StudentFactory->create()->getCollection();
        foreach ($students as $student) {
            $string = $student['name'] . '-' . $student['entity_id'];
            $slug = $this->toSlug($string);
            $postUpdate = $post->load($student['entity_id']);
            $postUpdate->setSlug($slug);
            $postUpdate->save();
        }
        $output->writeln('<info>Success change to slug.</info>');
    }
}


