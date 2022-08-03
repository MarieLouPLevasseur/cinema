<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class MaintenanceSubscriber implements EventSubscriberInterface
{
    public function onKernelResponse(ResponseEvent $event): void
    {
        // récupération de l'objet response
        $currentHtml = $event->getResponse()->getContent();
        
        // dump($currentHtml);

        // autre méthode de remplacement avec regex: 
        // $maintenanceContent = preg_replace('#<body( [^>]*)>#', '<body$1><div class="alert alert-danger">Maintenance prévue vendredi 05 août à 17h00</div>', $originalContent);

        // remplacement de la chaine souhaité dans le contenu de l'objet response
        $HtmlToReplace = str_replace('<body>', '<body><div class="alert alert-danger">Maintenance prévue Vendredi 5 Aout à 17h00</div>', $currentHtml);

        // injection du contenu de remplacement
        $event->getResponse()->setContent($HtmlToReplace);

    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.response' => 'onKernelResponse',
        ];
    }
}
