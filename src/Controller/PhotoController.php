<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Photo;
use App\Entity\Tamanhos;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;

class PhotoController extends AbstractController
{

  /**
   * @Route("/", name="photo_list")
   */
  public function index()
  {
    $photos = $this->getDoctrine()->getRepository(Photo::class)->findAll();

    return $this->render("photo/index.html.twig", array('photos' => $photos));
  }

  /**
   * @Route(path="/upload", methods={"GET", "POST"}, name="new_photo")
   */
  public function new(Request $request)
  {
    $photo = new Photo();

    $tamanhos = $this->getDoctrine()->getRepository(Tamanhos::class)->findAll();


    $form = $this->createFormBuilder($photo)
      ->add('tamanho', ChoiceType::class, [
        'choices' => [
          $tamanhos
        ],
        'choice_label' => function (Tamanhos $tamanho) {
          return strtoupper($tamanho->getTamanho());
        },

        'group_by' => function (Tamanhos $tamanho) {
          return 'Tamanhos disponíveis';
        },

        'attr' => [
          'class' => 'form-control mb-3'
        ],
        'label' => 'Tamanho para impressão'
      ])
      ->add('copias', NumberType::class, [
        'attr' => ['class' => 'form-control mb-3'],
        'html5' => true,
        'label' => 'Número de cópias'
      ])

      ->add('photo', FileType::class, [
        'label' => 'Selecione uma imagem para upload',

        // unmapped means that this field is not associated to any entity property
        'mapped' => false,

        // make it optional so you don't have to re-upload the file
        // everytime you edit the details
        'required' => false,

        'attr' => [
          'class' => 'form-control-file mb-3'
        ],

        'constraints' => [
          new File([
            'maxSize' => '1024k',
            'mimeTypes' => [
              'image/jpeg',
              'image/png',
            ],
            'mimeTypesMessage' => 'Please upload a valid image',
          ])
        ]
      ])
      ->add('save', SubmitType::class, ['label' => "Create", 'attr' => ['class' => 'btn btn-primary mt-3']])
      ->getform();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $photo = $form->getData();

      $photoUploaded = $form['photo']->getData();

      if ($photoUploaded) {
        $originalFilename = pathinfo($photoUploaded->getClientOriginalName(), PATHINFO_FILENAME);

        // this is needed to safely include the file name as part of the URL
        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $photoUploaded->guessExtension();

        // Move the file to the directory where brochures are stored
        try {
          $photoUploaded->move(
            $this->getParameter('photo_directory'),
            $newFilename
          );
        } catch (FileException $e) {
          // ... handle exception if something happens during file upload
        }

        // updates the 'brochureFilename' property to store the PDF file name
        // instead of its contents
        $photo->setPhotoFileName($newFilename);
      }

      $quantidade = $photo->getCopias();

      $photo->setTamanho($form['tamanho']->getData());

      $valor = $photo->getTamanho()->getValor();

      $photo->setPreco($quantidade * $valor);

      // ... persist the variable or any other work
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($photo);
      $entityManager->flush();
      return $this->redirectToRoute('photo_list');
    }


    return $this->render('photo/new.html.twig', ['form' => $form->createView()]);
  }



  // Apenas para testes

  // /**
  //  * @Route("/save")
  //  */
  // public function save()
  // {
  //   $entityManager = $this->getDoctrine()->getManager();

  //   // Photo
  //   //  tamanho
  //   //  preco
  //   //  copias
  //   //  photoFileName


  //   $photo = new Photo();
  //   $photo->setTamanho("10X15");
  //   $photo->setPreco(15.75);
  //   $photo->setCopias(7);
  //   $photo->setPhotoFileName("C:\\temp\\teste.txt");

  //   $entityManager->persist($photo);

  //   $entityManager->flush();

  //   return new Response("saved photo with id of " . $photo->getId());
  // }
}
