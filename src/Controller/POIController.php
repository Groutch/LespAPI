<?php
namespace App\Controller;

use App\Repository\POIRepository;
use App\Entity\POI;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


class POIController extends AbstractController
{
    private POIRepository $POIRepository;

    public function __construct(POIRepository $POIRepository)
    {
        $this->POIRepository = $POIRepository;
    }

    /**
     * @Route("/pois/add", name="add_poi", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (empty($data['longitude']) || empty($data['latitude'])) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $longitude = $data['longitude'];
        $latitude = $data['latitude'];
        $title = $data['title']??'';
        $description = $data['description']??'';
        $img_src = $data['img_src']??'';

        $newPOI = new POI(
            $longitude,
            $latitude,
            $title,
            $description,
            $img_src
        );

        $this->POIRepository->savePOI($newPOI);

        return new JsonResponse(['status' => 'POI created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/pois/{id}", name="get_one_poi", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $POI = $this->POIRepository->findOneBy(['id' => $id]);
        
        $response = ($POI === null) ? $POI : $POI->toArray();

        return new JsonResponse($response, Response::HTTP_OK);
    }

    /**
     * @Route("/pois", name="get_all_pois", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $POIs = $this->POIRepository->findAll();
        $listPOI = [];
        foreach ($POIs as $POI) {
            $listPOI[] = $POI->toArray();
        }

        return new JsonResponse($listPOI, Response::HTTP_OK);
    }

    /**
     * @Route("/pois/{id}", name="update_poi", methods={"PUT"})
     */
    public function update($id, Request $request): JsonResponse
    {
        $POI = $this->POIRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['longitude']) ? true : $POI->setLongitude($data['longitude']);
        empty($data['title']) ? true : $POI->setTitle($data['title']);
        empty($data['description']) ? true : $POI->setDescription($data['description']);
        empty($data['latitude']) ? true : $POI->setLatitude($data['latitude']);
        empty($data['img_src']) ? true : $POI->setImgSrc($data['img_src']);

        $updatedPOI = $this->POIRepository->updatePOI($POI);

        return new JsonResponse($updatedPOI->toArray(), Response::HTTP_OK);
    }

    /**
     * @Route("/pois/{id}", name="delete_poi", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $POI = $this->POIRepository->findOneBy(['id' => $id]);
        $this->POIRepository->deletePOI($POI);
        return new JsonResponse(['status' => 'POI deleted'], Response::HTTP_NO_CONTENT);
    }

}