<?php

namespace App\Http\Controllers\Admin;

use App\Config;
use App\Http\Controllers\Controller;
use App\Link;
use App\Setting;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{

    public function createLink() {
        return view('user.link.create-link');
    }

    public function createLinkAjax(Request  $request) {
        try {
            if(!$request->ajax()){
                throw new \Exception('error');
            }
            $data = $request->all();
            $_link = $data['_link'];
            $dataInsert = [
                'user_id' => intval($data['user_id']),
                'linkfile' => $data['linkfile'],
                'linkyoutube' => $data['linkyoutube'],
                'title' => time(),
                'slug' => SlugService::createSlug(Link::class, 'slug', time())
            ];
            if (!empty($_link)) {
                $dataInsert['_link'] = $_link;
            }
            Link::query()->create($dataInsert);
            return response()->json([
                'status' => 'success',
                'message' => 'success',
                'data' => []
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'cocainit',
                'data' => []
            ], 500);
        }

    }
    public function getLinks(Request $request)
    {
        $user_id = $request->get('user_id');
        $links = Link::query()->where('user_id',$user_id)->orderByDesc('id')->paginate(10);
        $linkConfig = Config::query()
                    ->where('user_id', $user_id)
                    ->where('status', 1)
                    ->first();
        $setting = Setting::query()->where('name', 'domain_default')->first();
        return view('site.link')->with(['links' => $links, 'linkConfig' => $linkConfig, 'setting' => $setting]);
    }

    public function getLinkAjax(Request $request)
    {
        try {
            $id = $request->get('id') ?? '';
            $link = Link::query()->where('slug', $id)->first();
            if (!empty($link)) {
                return response()->json([
                    'data' => $link
                ]);
            } else {
                throw new \Exception('khobng co du lieu');
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }

    }

}
