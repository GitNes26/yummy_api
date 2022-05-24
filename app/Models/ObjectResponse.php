<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectResponse extends Model
{
    public function DefaultResponse() {
        $response = [
            "status" => false,
            "message" => "no se logro completar la petcion.",
            "data" => [],
        ];
        return $response;
    }
    public function CatchResponse() {
        $response = [
            "status" => false,
            "message" => "Ocurrio un error, verifica tus datos.",
            "data" => [],
        ];
        return $response;
    }
}
