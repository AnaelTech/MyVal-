<?php

namespace App\Controller;

use App\Entity\Agents;
use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AgentsController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private CallApiService $callApiService
    ) {
    }

    #[Route('/agents', name: 'app_agents')]
    public function index(): Response
    {
        // Connexion à l'API
        $AgentsData = $this->callApiService->getData();
        // dd($AgentsData);
        // Désérialisation des données en objets
        $Agents = $this->serializer->deserialize(json_encode($AgentsData['data']), Agents::class .  '[]', 'json');
        //dd($Agents);
        // Rendre la vue avec les données désérialisées
        return $this->render('agents/agents.html.twig', [
            'agents' => $Agents,
        ]);
    }

    #[Route('/agents/{id}', name: 'app_agent')]
    public function agent(Request $request, string $id): Response
    {
        //Récupére les données de l'API de l'agent 
        $AgentsData = $this->callApiService->getAgent($id);
        //dd($AgentsData);
        $Agent = $this->serializer->deserialize(json_encode($AgentsData['data']), Agents::class, 'json');

        //dd($Agent);
        return $this->render('agents/agent.html.twig', [
            'agent' => $Agent,
        ]);
    }
}
