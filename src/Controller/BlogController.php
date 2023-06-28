<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class BlogController extends Controller
{
    /**
     * @Route("/article", name="article_liste")
     */
    public function liste(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Article::class);
        $articles = $repo->findListArticle();

        return $this->render("blog/liste.html.twig", ["articles" => $articles]);
    }
    /**
     * @Route("/article{id}", name="article_detail", requirements={"id": "\d+"})
     */
    public function detail(int $id, EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Article::class);
        $article = $repo->find($id);

        return $this->render("blog/detail.html.twig", ["article" => $article]);
    }
    /**
     * @Route("/add", name="article_add")
     *
     */
    public function add(Request $request, EntityManagerInterface $em)
    {
        $article = new Article();

        $user = $this->getUser();
        $article->setAuteur($user->getUsername());

        $articleForm = $this->createForm(ArticleType::class, $article);
        $articleForm->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid()){

            // insertion de l'image dans la BDD
            $file = $article->getImage();
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('image_article'),$fileName);
            } catch (FileException $e) {
            }
            $article->setImage($fileName);
            // FIN
            $article->setEstPublie(true);
            $article->setDateCreated(new \DateTime());

            $em->persist($article);
            $em->flush();

            $this->addFlash("success", "Votre Article a été enregistré avec succès !! ");
            return $this->redirectToRoute("article_detail", ["id" => $article->getId()]);
        }

        return $this->render('blog/article.html.twig', ["articleForm" => $articleForm->createView()]);
    }
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

}
