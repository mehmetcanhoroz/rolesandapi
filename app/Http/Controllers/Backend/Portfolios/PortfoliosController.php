<?php

namespace App\Http\Controllers\Backend\Portfolios;

use App\Http\Requests\SliderCreateRequest;
use App\Http\Requests\SliderDeleteRequest;
use App\Http\Requests\SliderViewRequest;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PortfoliosController extends Controller
{
    //
    public function show(SliderViewRequest $request)
    {
        $portfolios = Portfolio::all();
        return view("backend.portfolio.index", compact("portfolios"));
    }

    public function delete(SliderDeleteRequest $request)
    {
        $portfolio = Portfolio::find($request->id);
        Storage::disk("uploads")->delete($portfolio->image);

        if ($portfolio->delete()) {
            return ["status" => "success", "title" => "Başarılı!", "message" => "Portfolyo silindi!"];
        }
        return ["status" => "error", "title" => "Hata Oluştu!", "message" => "Portfolyo bulunamadı yada silinemez!"];
    }


    public function create(SliderCreateRequest $request)
    {
        $portfolio = new Portfolio();
        $portfolio->name = $request->name;
        $file = Storage::disk("uploads")->putFile("portfolios", $request->file("image"));
        $portfolio->image = $file;


        $portfolio->save();
        return redirect()->back();
    }

}
