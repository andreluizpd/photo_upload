<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Photo;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PhotoController extends AbstractController
{

  /**
   * @Route("/")
   */
  public function number()
  {
    $number = random_int(0, 100);

    return $this->render('photo/index.html.twig', [
      'number' => $number,
    ]);
  }


  /**
   * @Route("/save")
   */
  public function save()
  {
    $entityManager = $this->getDoctrine()->getManager();

    // Photo
    //  tamanho
    //  preco
    //  copias
    //  photoFileName


    $photo = new Photo();
    $photo->setTamanho("10X15");
    $photo->setPreco(15.75);
    $photo->setCopias(7);
    $photo->setPhotoFileName("C:\\temp\\teste.txt");

    $entityManager->persist($photo);

    $entityManager->flush();

    return new Response("saved photo with id of " . $photo->getId());
  }
}
