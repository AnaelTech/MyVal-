<?php

namespace App\Controller;

use App\Entity\LogoDefaultTeam;
use App\Entity\User;
use App\Form\UserSearchType;
use App\Repository\MapsRepository;
use App\Repository\UserRepository;
use App\Service\CallApiStat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\Image;

class UserController extends AbstractController
{

    public function __construct(
        private CallApiStat $callApiStat
    ) {
    }

    #[Route('/user/{id}', name: 'app_user')]
    public function index(UserRepository $userRepository, MapsRepository $mapAlls): Response
    {
        $maps = $mapAlls->findAll();
        //dd($maps);
        if ($user = $this->getUser()) {
            //dd($user);
            $User = $userRepository->find(['id' => $user]);
            // dd($User);
            $PseudoValo = $User->getPseudoValo();
            $tag = $User->getTag();
            $ProfilPic = $User->getProfilPic();
            //dd($ProfilPic);
            $UserStat = $this->callApiStat->getStat($PseudoValo, $tag);
            //dd($UserStat);

            $UserHistory = $this->callApiStat->getHistory($UserStat['data']['puuid']);
            //dd($UserHistory);
        } else {
            throw new \Exception('Sorry mais non');
        }
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserControlerController',
            'UserStat' => $UserStat,
            'Historys' => $UserHistory,
            'maps' => $maps,
            'ProfilPic' => $ProfilPic,
        ]);
    }
    #[Route('/user/edit/{id}', name: 'app_user_edit')]
    public function edit(Request $request, EntityManagerInterface $em, User $user, SluggerInterface $slugger): Response
    {
        $user = $this->getUser();
        //dd($user);
        $form = $this->createFormBuilder()
            ->add('profilPic', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image()
                ]
            ])
            ->add('submit', SubmitType::class, ['label' => 'Update Profile Picture'])
            ->getForm();

        $form->handleRequest($request);
        //dd($form);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $profilePic */
            $profilePic = $form->get('profilPic')->getData();
            if ($profilePic) {
                $oldFilename = $user->getProfilPic();
                if ($oldFilename) {
                    $oldFilePath = $this->getParameter('uploads_directory') . '/' . $oldFilename;
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }
                $originalFilename = pathinfo($profilePic->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);

                $filename = $safeFilename . '-' . uniqid() . '.' . $profilePic->guessExtension();

                try {
                    $profilePic->move(
                        'uploads/users',
                        $filename
                    );
                    $user->setprofilPic($filename);
                } catch (FileException $e) {
                    $form->addError(new FormError("Erreur lors de l'upload du fichier"));
                }
            }
            $em->flush();
            return $this->redirectToRoute('app_user', ['id' => $user->getId()]);
        }
        return $this->render('user/edit.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/search', name: 'app_search')]
    public function search(Request $request,  UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserSearchType::class);
        $form->handleRequest($request);

        $users = [];

        //dd($filters = $form->getData());

        if ($form->isSubmitted() && $form->isValid()) {
            $filters = $form->getData();
            //dd($filters);
            $users = $userRepository->search($filters);
        }

        return $this->render('search/results.html.twig', [
            'form' => $form,
            'users' => $users,
        ]);
    }
}
