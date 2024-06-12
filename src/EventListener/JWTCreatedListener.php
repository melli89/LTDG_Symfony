<?php
namespace App\EventListener;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener {
    /**
     * @param JWTCreatedEvent
     */
    public function onJWTCreated(JWTCreatedEvent $event) {
        $user = $event -> getUser();

        if (!$user instanceof User) {
            return;
        }

        $payload = $event -> getData();
        $payload["id"] = $user -> getId();
        $event -> setData($payload);
    }
}