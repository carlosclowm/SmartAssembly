<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function startScript(Request $res){
        $command = escapeshellcmd('python C:\MyRuleEngine.py "'.$res->get('input').'" ');
        $output = shell_exec($command);
        $result = preg_replace('/\s+/', '+', $output);
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://serpapi.com/search.json?q=core+i9+16+ram+&location=M%C3%A9xico&hl=es&gl=mx&api_key=139c270037bcf4176540b5277e232efdad96569b1b793187c2de47bc650863a3',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        $array = json_decode($response,true);
        curl_close($curl);
        if($array){
            $Products = $array['shopping_results'];
        }else{
            $Products = null;
        }
        //var_dump($array['shopping_results'][0]['title']);
        //return view('home', compact('Products', 'output'));
        return view('home', compact('Products'));
    }
}
