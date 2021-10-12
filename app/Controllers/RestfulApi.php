<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Inventory;
class RestfulApi extends ResourceController
{
    use ResponseTrait;
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new Inventory();
        $data = $model->findAll();
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new Inventory();
        $data = $model->find($id);

        if($data) {
            return $this->respond($data);
        }
        else {
            return $this->failNotFound("Item not found");
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $rules = [
            'item_name' => 'required'
        ];

        if(!$this->validate($rules))
        {
            return $this->fail($this->validator->getErrors());
        }
        else {
            $data = [
                'item_name' => $this->request->getVar('item_name'),
                'quantity' => $this->request->getVar('quantity'),
                'available' => $this->request->getVar('available')
            ];

            $model = new Inventory();
            $model->save($data);

            return $this->respondCreated($data);
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $model = new Inventory();
        $data = $model->find($id);

        if($data) {
            $input = $this->request->getRawInput();

            $data = [
                'item_name' => $input['item_name'],
                'quantity' => $input['quantity'],
                'availability' => $input['availability']
            ];
            
            $model->update($id, $data);
            return $this->respond($data);
        }
        else {
            return $this->failNotFound("Item not found");
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new Inventory();
        $data = $model->find($id);

        if($data) {
            $model->delete($id);

            return $this->respond("Item Deleted Successfully");
        }
        else {
            return $this->failNotFound("Item Not Found");
        }
    }
}
