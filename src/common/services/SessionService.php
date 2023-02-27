<?php

namespace common\services;

use yii\web\Session;

final class SessionService
{
    public function __construct(
       public readonly Session $session
    ) {
        $this->session->open();
    }

    public function hasSessionUserFullName(): bool
    {
        return $this->session->has('user');
    }

    public function hasSessionUserId(): bool
    {
        return $this->session->has('id_user');
    }

    public function setSessionUser(int $userId, string $user): void
    {
        $this->session->set('user', $user);
        $this->session->set('id_user', $userId);
        $this->session->addFlash('success', 'Вас успешно добавлены!');
    }

    public function getSessionUserFullName(): string
    {
        return $this->session->get('user');
    }

    public function getSessionUserId(): string
    {
        return $this->session->get('id_user');
    }
}