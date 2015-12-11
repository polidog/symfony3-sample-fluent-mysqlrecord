<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2015/12/11
 * Time: 22:34
 */

namespace AppBundle\Command;


use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ArticleSaveCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:article:save')
            ->setDescription('Save article')
            ->addArgument(
                'title',
                InputArgument::REQUIRED,
                'title'
            )
            ->addArgument(
                'content',
                InputArgument::REQUIRED,
                'content'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $title = $input->getArgument('title');
        $content = $input->getArgument('content');

        $article = new Article();
        $article->setTitle($title)
            ->setContent($content);

        $this->getContainer()->get('app.service.fluent_output_service')->save($article);
    }
}