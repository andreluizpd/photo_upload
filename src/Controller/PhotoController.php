<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
}
