<?php

namespace AppBundle\Controller;

//use AppBundle\Entity\Init;
use AppBundle\Controller\Init;
use AppBundle\Entity\Test;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class InitController
 * @package AppBundle\Controller
 */
class InitController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $this->create();
        $this->fill();

        echo "<pre>";
        print_r($this->getTest());


        return new Response();
    }

    /**
     * Creates table test
     * @return string
     */
    private function create()
    {
        $kernel = $this->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(array(
            'command' => 'doctrine:schema:drop',
            '--force' => true,
        ));

        $output = new BufferedOutput();
        $application->run($input, $output);

        $input = new ArrayInput(array(
            'command' => 'doctrine:schema:create',
        ));

        $application->run($input, $output);

        $content = $output->fetch();

        return $content;
    }

    /**
     * Fills test by random data
     * @return string
     */
    private function fill()
    {
        $kernel = $this->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);


        $output = new BufferedOutput();

        $input = new ArrayInput(array(
            'command' => 'doctrine:fixtures:load',
        ));

        $application->run($input, $output);

        $content = $output->fetch();

        return $content;
    }

    /**
     * Returns normal and success
     * @return mixed
     */
    public function getTest()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Test');

        $query = $repository->createQueryBuilder('t')
            ->where('t.result = :normal')
            ->orWhere('t.result = :success')
            ->setParameters(['normal' => Test::RESULT_NORMAL, 'success' => Test::RESULT_SUCCESS])
            ->getQuery();

        $result = $query->getResult();

        return $result;
    }
}
