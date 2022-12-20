<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StructureController extends Controller
{
    public function displayHead()
    {
        $content = DB::table('wp_structure')->where('id', '=', 1)->get()->first();
        return view('admin.structure.head_html', compact('content'));
    }

    public function updateHead(Request $request)
    {
        try {
            $content = DB::table('wp_structure')->where('id', '=', 1)->update([
                'head' => $request->noi_dung_head
            ]);
            return redirect()->route('trang_chu');
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function displayFooter()
    {
        $content = DB::table('wp_structure')->where('id', '=', 1)->get()->first();
        return view('admin.structure.footer_html', compact('content'));
    }

    public function updateFooter(Request $request)
    {
        try {
            $content = DB::table('wp_structure')->where('id', '=', 1)->update([
                'footer' => $request->noi_dung_footer
            ]);
            return redirect()->route('trang_chu');
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}
