<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\PostDTO;
use App\Form\PostFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{
    #[Route('/')]
    public function index(Request $request): Response
    {

        /**
         * 1. LiveComponent + custom stimulus controller (file-pond) + submitting with a normal controller
         *    - Working with duplicate "file" field on rerender, edge case: "If JavaScript removes an element that was originally rendered by the component, that change will be lost: the element will be re-added during the next re-render."
         *    - Workaround hide originally rendered field via file-pond controller
         * 2. LiveComponent + custom stimulus controller (file-pond) + submitting via a LiveAction =>
         * */

        $post = new PostDTO();
        $form = $this->createForm(PostFormType::class, $post);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $data = $form->getData();

            // Classic FileType access = > UploadFile instance, working
            /**
             * @var $file UploadedFile
             */
            $file = $form->get('file')->getData();

            dd($data, $file);
        }


        return $this->render('pages/post/index.html.twig', [
            'form' => $form,
            'post' => $post,
        ]);
    }
}
