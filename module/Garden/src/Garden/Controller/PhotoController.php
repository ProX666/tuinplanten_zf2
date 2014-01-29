<?php

namespace Garden\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\FormInterface;

class PhotoController extends AbstractActionController {

    protected $em;
    protected $config;
    protected $imagineService;

    protected function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    protected function getConfig() {
        if (!isset($this->config)) {
            $this->config = $this->getServiceLocator()->get('config');
        }

        return $this->config;
    }

    protected function getConfigItem($item) {
        $config = $this->getConfig();
        return $config[$item];
    }

    public function uploadAction() {
        $id = $this->params('id');
        $imagesConfig = $this->getConfigItem('images');

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Plants');
        $plant = $repository->find($id);

        $form = new \Garden\Form\PhotoForm($id, "Upload");
        $form->setLabel("Foto toevoegen");
        $form->get('submit')->setValue('Upload');
        $form->setAttribute('class', 'form-horizontal form-box');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = array_merge_recursive(
                    $request->getPost()->toArray(), $request->getFiles()->toArray()
            );
            $form->setData($post);
            if ($form->isValid()) {
                try {
                    $upload_repository = $this->getEntityManager()->getRepository('Garden\Entity\Uploads');
                    $uploadedData = $form->getData();

                    $uploadModel = new \Garden\Entity\Uploads($plant);
                    $this->getEntityManager()->persist($uploadModel);

                    $adapter = new \Zend\File\Transfer\Adapter\Http();
                    $adapter->setDestination($imagesConfig['original']);

                    if ($adapter->receive($uploadedData['fileupload']['name'])) {
                        $uploadModel->exchangeArray($uploadedData);
                    }
                    // now create thumb images (we'll do web images on the fly)
                    $file = $imagesConfig['original'] . '/' . $uploadedData['fileupload']['name'];

                    $height = 75;
                    $this->imageToThumbAction($height, $file, $uploadedData['fileupload']['name']);

                    // reset other first photo and set new photo as first photo
                    if ($photo = $upload_repository->findOneBy(array('selected' => true, 'plant' => $plant))) {
                        $photo->setSelected(false);
                    }
                    $uploadModel->setSelected(true);

                    $this->getEntityManager()->flush();
                    return $this->redirect()->toUrl('/');
                } catch (Exception $ex) {
                    echo "Exception!\n";
                    echo $ex->getMessage();
                }
            }
        }
        return array(
            'id' => $id,
            'form' => $form
        );
    }

    public function firstphotoAction() {
        $id = $this->params('id');

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Plants');
        $plant = $repository->find($id);

        $form = new \Garden\Form\FirstPhotoForm($id, "Firstphoto");
        $form->get('submit')->setValue('Kies');
        $form->setAttribute('class', 'form-horizontal form-box');
        $form->get('firstPhoto')->setValueOptions($this->getPhotoArray($id));

        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                try {
                    $formdata = $form->getData();
                    $upload_repository = $this->getEntityManager()->getRepository('Garden\Entity\Uploads');
                    if ($photo = $upload_repository->findOneBy(array('selected' => true, 'plant' => $plant))) {
                        $photo->setSelected(false);
                    }

                    if ($photo = $upload_repository->findOneBy(array('id' => $formdata['firstPhoto'], 'plant' => $plant))) {
                        $photo->setSelected(true);
                    }

                    $this->getEntityManager()->flush();
                    return $this->redirect()->toUrl('/');
                } catch (Exception $ex) {
                    echo "Exception!\n";
                    echo $ex->getMessage();
                }
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function imageToThumbAction($height, $file, $filename) {
        $imagesConfig = $this->getConfigItem('images');
        $imagine = $this->getImagineService();

        $image = $imagine->open($file);

        $image->resize(
                // get original size and set width (widen) or height (heighten).
                // width or height will be set maintaining aspect ratio.
                $image->getSize()->heighten($height)
        );
        $image->save($imagesConfig['thumbs'] . '/' . $filename);

        return;
        // $size = new \Imagine\Image\Box($width, $height);
        // $mode = \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
        // $imagine->open($file)->thumbnail($size, $mode)->save($imagesConfig['thumbs'] . '/' . $filename);
    }

    public function getImagineService() {
        if ($this->imagineService === null) {
            $this->imagineService = $this->getServiceLocator()->get('my_image_service');
        }
        return $this->imagineService;
    }

    /**
     * Idea was to return images as html and view them in the checkbox overview.
     * Unfortunately this is not possible in zf2 without writing a view helper for this :(
     * So now only the titles are returned.
     * @param type $id
     * @return string
     */
    public function getPhotoArray($id) {
        $photoArray = array();
        $query = $this->getEntityManager()->createQuery('SELECT p.title, p.id, p.filename FROM Garden\Entity\Uploads p where p.plant = ' . $id);
        $photos = $query->getResult();
        foreach ($photos as $photo) {

//            $imgHtml = '';
//            $imgHtml .= '<div class="single_photo">';
//            $imgHtml .= '<img src="/uploads/thumbs/' . $photo['filename'] . '" />';
//            $imgHtml .= '</div>';

            $photoArray[$photo['id']] = $photo['title'];
        }

        return !empty($photoArray) ? $photoArray : null;
    }

    public function thumbAction() {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        $query = $this->getEntityManager()->createQuery('SELECT p.filename FROM Garden\Entity\Uploads p where p.id = ' . $id);
        if ($photo = $query->getResult()) {
            echo "/uploads/thumbs/" . $photo[0]['filename'];
        }
        die;
    }

    public function deleteAction() {
        $imagesConfig = $this->getConfigItem('images');
        $id = $this->params('id');

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Plants');

        $form = new \Garden\Form\DeletePhotoForm($id, "Deletephoto");
        $form->get('submit')->setValue('Kies');
        $form->setAttribute('class', 'form-horizontal form-box');

        if ($photos = $this->getPhotoArray($id)) {
            $form->get('deletePhoto')->setValueOptions($photos);
        } else {
            $this->flashMessenger()->addMessage('Er zijn geen foto\'s voor deze plant.');
            return $this->redirect()->toUrl('/');
        }


        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                try {
                    $formdata = $form->getData();
                    $repository = $this->getEntityManager()->getRepository('Garden\Entity\Uploads');
                    foreach ($formdata['deletePhoto'] as $delete) {
                        $photo = $repository->findOneBy(array('id' => $delete));

                        unlink($imagesConfig['original'] . '/' . $photo->getFileName());
                        unlink($imagesConfig['thumbs'] . '/' . $photo->getFileName());

                        $this->getEntityManager()->remove($photo);
                    }
                    $this->getEntityManager()->flush();
                    return $this->redirect()->toUrl('/');
                } catch (Exception $ex) {
                    echo "Exception!\n";
                    echo $ex->getMessage();
                }
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

}

