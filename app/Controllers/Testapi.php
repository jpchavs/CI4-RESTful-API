<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Inventory as InventoryModel;

class Testapi extends BaseController
{
    use \CodeIgniter\API\ResponseTrait;
    public function index()
    {
        return view('welcome_message');
    }

    public function show($id)
    {
        $items = new InventoryModel();
        $item = $items->find($id);
        return $this->respond($item);
    }    

    public function create()
    {
        $data = $this->request->getPost();
        $items = new InventoryModel();
        $id = $items->insert($data);
    }
}
