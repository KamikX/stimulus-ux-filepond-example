<?php

namespace App\Twig\Components;

use App\DTO\PostDTO;
use App\Form\PostFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class PostForm extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp(fieldName: 'formData')]
    public ?PostDTO $initialFormData = null;

    #[LiveAction]
    public function save(Request $request): void
    {


        // (1 - submitForm) Working with classic FileType without file-pond controller
        $this->submitForm(false);
        $file =  $request->files->get($this->formName)['file'] ?? null;


        // (2 - submit ) Working with classic FileType without file-pond controller
//        $dataWithFiles = array_merge($this->formValues, $request->files->all($this->formName));
//        $this->getForm()->submit($dataWithFiles);
//        $file = $this->getForm()->get('file')->getData();


        $isSubmitted = $this->getForm()->isSubmitted();
        $errors = $this->getForm()->getErrors();
        $data = $this->getForm()->getData();
        dd(['isSubmitted' => $isSubmitted, 'data' => $data, 'file' => $file, 'errors' => $errors]);

    }


    protected function instantiateForm(): FormInterface
    {

        return $this->createForm(
            PostFormType::class,
            $this->initialFormData
        );
    }
}
