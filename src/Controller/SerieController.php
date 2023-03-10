<?php

namespace App\Controller;


use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/series", name="app_serie_")
 */
class SerieController extends AbstractController
{
    /* Route("/series", name="app_serie_list") */
    /**
     * @Route("", name="list")
     */
    public function list(SerieRepository $serieRepository): Response
    {

        //dd($serie.poster);
        //dd($serie);
        //$serie = $serieRepository->findAll();

        //$serie = $serieRepository->findBy([],['popularity'=>'DESC','vote'=>'DESC'],30);
        $serie = $serieRepository->findBestSeries();

        return $this->render('serie/list.html.twig', [
            "series" =>$serie
        ]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(int $id, SerieRepository $serieRepository): Response
    {
        $serie = $serieRepository->find($id);

        if (!$serie){
            throw $this->createNotFoundException("oh no, the serie don't exist");
        }
        //foreach ($serie->getSeasons() as $season)
        //    dd($serie);


        return $this->render('serie/details.html.twig',[
            "serie"=>$serie
        ]);

    }

    /**
     * @Route("/create", name="create")
     */
    public function create(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        //dump("yeah");

        $serie = new Serie();
        $serie->setDateCreated(new \DateTime());


        $serieForm = $this->createForm(SerieType::class, $serie);
        //dump($serie);

        $serieForm->handleRequest($request);
        //dump($serie);

        if ($serieForm->isSubmitted() && $serieForm->isValid()){

            //$images = $wishForm->get('images')->getData();
            $image = $serieForm->get('poster')->getData();
            if ($image){
                $fichier = md5(uniqid()).'.'.$image->guessExtension();
                $serie->setPoster($fichier);
                //$serie->setBackdrop($image);
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
            }else{
                $serie->setPoster("na");
            }


            //dd($serie);
            $entityManager->persist($serie);
            $entityManager->flush();
            $this->addFlash('sucess','serie added! good');
            return $this->redirectToRoute('app_serie_details',[
                'id'=>$serie->getId(),
            ]);

        }
        return $this->render('serie/create.html.twig', [
            'serieForm' => $serieForm ->createView(),
        ]);

    }

    /**
     * @Route("/delete0/{id}", name="delete0")
     */
    public function delete0(Serie $serie, EntityManagerInterface $entityManager)
    {
        dump($serie);
        //$serie = $serieRepository->find($id);

        if (!$serie){
            throw $this->createNotFoundException("oh no delete, the serie don't exist");
        }
        //dd($serie);
        $entityManager->remove($serie);

        $entityManager->flush();

        return $this->redirectToRoute('app_main_home');
    }


    /**
     * @Route("/test/{id}", name="test")
     *
     */
    public function test(Serie $serie, EntityManagerInterface $entityManager): Response
    {


        if (!$serie){
            throw $this->createNotFoundException("oh no, the serie don't exist");
        }
        //foreach ($serie->getSeasons() as $season)
        //    dd($serie);


        return $this->render('serie/tests.html.twig',[
            "serie"=>$serie
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(int $id, SerieRepository $serieRepository, EntityManagerInterface $entityManager): Response
    {
        $serie = $serieRepository->find($id);

        if (!$serie){
            throw $this->createNotFoundException("oh no, the serie don't exist");
        }
        //foreach ($serie->getSeasons() as $season)
        //    dd($serie);

        $entityManager->remove($serie);
        $entityManager->flush();

        return $this->render('main/home.html.twig');

    }

    /**
     * @Route("/demo", name="em-demo")
     */
    public function demo(EntityManagerInterface $entityManager): Response
    {
        //cr??e une instance de mon entit??
        $serie = new Serie();

        //hydrate toutes propri??t??s
        $serie->setName('pif');
        $serie->setBackdrop('dafsd');
        $serie->setPoster('dafsdf');
        $serie->setDateCreated(new \DateTime());
        $serie->setFirstAirDate(new \DateTime('- 1 year'));
        $serie->setLastAirDate(new \DateTime('- 6 month'));
        $serie->setGenre('drama');
        $serie->setOverview('bla bla bla');
        $serie->setPopularity(123.00);
        $serie->setVote(8.2);
        $serie->setStatus('canceled');
        $serie->setTmbdId(329432);


        //dump($serie);

        $entityManager->persist($serie);
        $entityManager->flush();
        //$entityManager = $this->getDoctrine()->getManager();

        //dump($serie);

        //$entityManager->remove($serie);
        $serie->setGenre('comedy');
        $entityManager->flush();

        return $this->render('serie/create.html.twig');

    }

}
