<?php

namespace App\Http\Controllers;

class DeploymentController extends Controller
{
    public function deploy()
    {
       echo $res=shell_exec(base_path('gitpull.sh'));
    }
}
