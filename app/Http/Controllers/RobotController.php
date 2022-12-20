<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RobotController extends Controller
{
    public static function index(){
        $path = public_path() . "/robots.txt";
        $content = File::get($path);
        return view('admin.robot.tao_robots',compact('content'));

//    $robots = App::make('robots');
//    $robots->add("Nấmcacjajksckac");
//    $robots->store('txt','myrobot');
//    return redirect(url('robots.txt'));
//    return \Illuminate\Support\Facades\Redirect::to('robots.txt');
    }

    public function update(Request $request){
        $path = public_path() . "/robots.txt";
        $file = File::put( $path, $request->noi_dung_robot);
//    return view('admin.robot.tao_robots',compact('content'));

//    $robots = App::make('robots');
//    $robots->add("Nấmcacjajksckac");
//    $robots->store('txt','myrobot');
//    return redirect(url('robots.txt'));
    return \Illuminate\Support\Facades\Redirect::to('robots.txt');
    }

}
