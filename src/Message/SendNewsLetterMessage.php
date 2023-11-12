<?php

namespace App\Message;

final class SendNewsLetterMessage
{

    private $userId;
    private $newsLetterId;

    public function __construct(int $userId, int $newsLetterId) {
        $this->userId = $userId;
        $this->newsLetterId = $newsLetterId;
    }


    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getNewsLetterId(): string
    {
        return $this->newsLetterId;
    }

}
