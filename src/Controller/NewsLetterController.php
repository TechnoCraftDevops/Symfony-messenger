<?php

namespace App\Controller;

use App\Entity\NewsLetter;
use App\Message\SendNewsLetterMessage;
use App\Repository\NewsLetterRepository;
use App\Service\NewsLetterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class NewsLetterController extends AbstractController
{
    #[Route('/newsLetter', name: 'newsletter', methods:['GET'])]
    public function newsLetter(NewsLetterRepository $newsLetterRepo): Response
    {
        $allNewsLetters = $newsLetterRepo->findAll();

        return $this->render('newsLetters/newsLetters.html.twig',[
            'allNewsLetters' => $allNewsLetters
        ]);
    }

    #[Route('/newsLetter/send/{id}', name: 'newsletter_send', methods:['POST'])]
    public function newsLetterSend(
        int $id,
        NewsLetterRepository $newsLetterRepo,
        MessageBusInterface $messageBus
    ): Response
    {
        $newsLetter = $newsLetterRepo->findOneBy(['id' => $id]);

        foreach ($newsLetter->getUsers() as $user) {
            // $NewsLetterService->send($user, $newsLetter);
            $messageBus->dispatch(
                new SendNewsLetterMessage(
                    $user->getId(),
                    $newsLetter->getId()
                )
            );
        }

        return $this->redirectToRoute('newsletter');
    }
}
