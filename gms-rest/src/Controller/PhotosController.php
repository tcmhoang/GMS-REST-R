<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Photo;
use App\Model\Table\PhotosTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Event\EventInterface;
use Cake\Http\Response;

/**
 * Photos Controller
 *
 * @property PhotosTable $Photos
 *
 * @method Photo[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class PhotosController extends AppController
{

    /**
     * Index method
     *
     * @return Response|null|void Renders view
     */
    public function index()
    {
        $photos = $this->Photos->find();

        $this->set(compact('photos'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Photo id.
     * @return Response|null|void Renders view
     * @throws RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $photo = $this->Photos->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('photo'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Add method
     *
     * @return Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $res = [];
        $photo = $this->Photos->newEmptyEntity();
        if ($this->request->is('post')) {
            $photo = $this->Photos->patchEntity($photo, $this->request->getData());
            if ($this->Photos->save($photo))
                $res = ["code" => 200,
                    "message" => 'The photo has been saved.'];

            else
                $res = ["code" => 400,
                    "message" => 'The photo could not be saved. Please, try again.'];
        }
        $this->set($res);
        $this->viewBuilder()->setOption('serialize', true);

    }

    public function upload()
    {
        if ($this->request->is('post')) {

            $file = $this->request->getUploadedFile('file');

            $name = $file->getClientFilename();
            $type = $file->getClientMediaType();
            $uploadPath = WWW_ROOT . 'upload' . DS . $name;
            if ($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png') {
                if (!empty($name)) {
                    if ($file->getSize() > 0 && $file->getError() == 0) {
                        $file->moveTo($uploadPath);
                    }
                }
            }

            $size = $file->getSize();

            $res = ["code" => 200,
                "message" => 'uploaded successfully',
                'size' => $size,
                'type' => $type,
                'name' => $name];
            $this->set($res);
            $this->viewBuilder()->setOption('serialize', true);

        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Photo id.
     * @return Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $res = [];
        $photo = $this->Photos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $photo = $this->Photos->patchEntity($photo, $this->request->getData());
            if ($this->Photos->save($photo))
                $res = ["code" => 200,
                    "message" => 'The photo has been saved.'];
            else
                $res = ["code" => 400,
                    "message" => 'The photo could not be saved. Please, try again.'];
        }
        $this->set($res);
        $this->viewBuilder()->setOption('serialize', true);

    }

    /**
     * Delete method
     *
     * @param string|null $id Photo id.
     * @return Response|null|void Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $photo = $this->Photos->get($id);
        if ($this->Photos->delete($photo))
            $res = ["code" => 200,
                "message" => 'The photo has been deleted.'];
        else
            $res = ["code" => 400,
                "message" => 'The photo could not be deleted. Please, try again.'];


        $this->set($res);
        $this->viewBuilder()->setOption('serialize', true);

    }

    public function search(string $title)
    {
        $photos = $this->Photos->find('all', ['conditions' => ['Photos.title LIKE' => "%{$title}%"]])->toArray();
        $this->set($photos);
        $this->viewBuilder()->setOption("serialize", true);
    }

    public function count()
    {
        $size = $this->Photos->find()->count();
        $this->set('size', $size);
        $this->viewBuilder()->setOption('serialize', true);
    }
}
