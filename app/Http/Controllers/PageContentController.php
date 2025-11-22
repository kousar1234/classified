<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PageContentTranslation;

class PageContentController extends Controller
{

    public function updatePageContent(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->except(['_token', 'lang', 'page']) as $key => $value) {

                $page_content = PageContent::firstOrCreate([
                    'key' => $key,
                ]);

                if ($request['lang'] == 'en') {
                    $page_content->value = $value;
                    $page_content->save();
                } else {
                    $page_content_translation = PageContentTranslation::firstOrCreate([
                        'page_content_id' => $page_content->id,
                        'lang' => $request['lang']
                    ]);
                    $page_content_translation->value = $value;
                    $page_content_translation->save();
                }
            }
            DB::commit();
            toastNotification('success', 'Page Content Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
            toastNotification('error', 'Page Content Update Failed', 'Error');
            return redirect()->back();
        }
    }
    public function homePageContent(Request $request)
    {
        $lang = $request->lang ?? 'en';
        return view('backend.modules.page_content.home', ['lang' => $lang]);
    }

    public function aboutPageContent(Request $request)
    {
        $lang = $request->lang ?? 'en';
        return view('backend.modules.page_content.about', ['lang' => $lang]);
    }

    public function contactPageContent(Request $request)
    {
        $lang = $request->lang ?? 'en';
        return view('backend.modules.page_content.contact', ['lang' => $lang]);
    }
}
