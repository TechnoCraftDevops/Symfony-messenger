<?php

namespace App\MessageHandler;

use App\Message\SendNewsLetterMessage;
use App\Repository\NewsLetterRepository;
use App\Repository\UserRepository;
use App\Service\NewsLetterService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class SendNewsLetterMessageHandler
{
    private UserRepository $userRepo;
    private NewsLetterRepository $newLetterRepo;
    private NewsLetterService $newsLetterservice;

    public function __construct(
        UserRepository $userRepo,
        NewsLetterRepository $newLetterRepo,
        NewsLetterService $newsLetterservice
    )
    {
        $this->userRepo = $userRepo;
        $this->newLetterRepo = $newLetterRepo;
        $this->newsLetterservice = $newsLetterservice;
    }
    public function __invoke(SendNewsLetterMessage $message)
    {
        $newsLetter = $this->newLetterRepo->findOneBy(['id' => $message->getNewsLetterId()]);
        $user= $this->userRepo->findOneBy(['id' => $message->getUserId()]);

        if ($user !== null && $newsLetter !== null) {
            $this->newsLetterservice->send($user, $newsLetter);
        }
    }
}
