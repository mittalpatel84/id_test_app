<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShorterLinks;
use Response;

class ShorterLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $ShorterLinks = ShorterLinks::select('code')->get();

        $shortURLArr = [];

        foreach ($ShorterLinks as $ShorterLinksSub) {
          $shortURLArr[] = env('APP_URL')."/".$ShorterLinksSub->code;
        }
        return Response::json(
          $shortURLArr
        , 200);
    }

    public function create(Request $request)
    {
      $request->validate([
         'link' => 'required|url'
      ]);

      $ShorterLinksObj = ShorterLinks::select('code')->where('link',$request->link)->first();

      if(!empty($ShorterLinksObj)){
        return Response::json([
          'short_url' => env('APP_URL')."/".$ShorterLinksObj->code
        ], 200);
      }else{
        $input['link'] = $request->link;
        $input['code'] = str_random(8);

        if(ShorterLinks::create($input)){
          return Response::json([
            'short_url' => env('APP_URL')."/".$input['code']
          ], 201);
        }
      }
    }

    public function delete(Request $request, $id)
    {
      $ShorterLinksObj = ShorterLinks::select('code')->where('code',$request->code)->first();

      if(!empty($ShorterLinksObj)){
        ShorterLinks::select('code')->where('code',$request->code)->delete();
        return Response::json('URL deleted', 200);
      }else{
        return Response::json('URL not found', 404);
      }
    }
}
