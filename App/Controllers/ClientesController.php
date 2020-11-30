<?php
declare(strict_types = 1);

namespace App\Controllers;

use Core\Controller;

class ClientesController extends Controller
{

    public function index()
    {
        $Obj = new Controller('clientes');      
        $Obj->index();
    }

    public function add(){
      $Obj = new Controller('clientes');
      $Obj->add();
    }

    public function delete($field_id){
      $Obj = new Controller('clientes');
      $Obj->delete($field_id);
    }

    public function edit($field_id){
      $Obj = new Controller('clientes');
      $Obj->edit($field_id);
    }

    public function update(){
      $Obj = new Controller('clientes');
      $Obj->update();
    }

}
