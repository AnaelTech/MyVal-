<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\User;
use App\Form\TeamType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class TeamController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/team', name: 'app_team')]
    public function HomeTeam(UserRepository $user): Response
    {
        if ($use = $this->getUser()) {
            //dd($use);

            $users = $user->findBy(['team' => $use->getTeam()]);
        } else {
            throw new \Exception('Sorry mais non');
        }
        //dd($users);

        return $this->render('team/homeTeam.html.twig', [
            'members' => $users,
        ]);
    }

    #[Route('/team/registration', name: 'app_team_regist')]

    public function RegistTeam(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);

        $form->handleRequest($request);
        //dd($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dd($request);
            $logoteam = $form->get('Logo')->getData();
            if ($logoteam === null) {
                $logoDef = $form->get('name')->getData();

                if ($logoDef) {
                    $team->setLogoTeam($logoDef->getName());
                }
                //dd($team);
            } else {
                $logoteam = $form->get('Logo')->getData();

                //dd($logoteam);

                $originalFilename = pathinfo($logoteam->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);

                $filename = $safeFilename . '-' . uniqid() . '.' . $logoteam->guessExtension();

                $logoteam->move(
                    'uploads/logoTeam',
                    $filename
                );
                $team->setLogoTeam($filename);
            }
            $team
                ->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($team);
            $entityManager->flush();

            /** @var User $user */
            $user = $this->security->getUser();
            $user->setRoles(['ROLE_ADMIN_TEAM']);
            $user->setTeam($team);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_team');
        } {
            return $this->render('team/registTeam.html.twig', [
                'controller_name' => 'TeamController',
                'form' => $form,
            ]);
        }
    }
}
