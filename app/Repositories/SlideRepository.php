<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use App\Models\Slide;
use App\Repositories\Interfaces\SlideRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class SlideRepository implements SlideRepositoryInterface
{
    public function getListSlide()
    {
        try {
            return Slide::all()
                ->sortByDesc('id');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function StoreSlide(StoreSlideRequest $req)
    {
        try {
            $slide = new Slide();
            $slide->name = $req->name;
            $slide->url = $req->url;

            $maxSort = Slide::all()->sortByDesc('sort_by')->first();
            $slide->sort_by = $maxSort == null ? $slide->sort_by = 1 : $maxSort->sort_by + 1;

            $slide->thumb = $req->file('thumb')->store('slides');

            return $slide->save();
        } catch (Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public function UpdateSlide(UpdateSlideRequest $req, Slide $slide)
    {
        try {
            $slide->name = $req->name;
            $slide->url = $req->url;

            $ListSlide = Slide::all();
            foreach ($ListSlide as $index => $s) {
                if ($s->sort_by == $req->sort_by) {
                    $temp = $s->sort_by;
                    $s->sort_by = $slide->sort_by;
                    $slide->sort_by = $temp;
                    $s->save();
                }
            }
            $slide->sort_by = $req->sort_by;

            if ($req->hasFile('thumb')) {
                Storage::delete($slide->thumb);
                $path = Storage::putFile('slides', $req->file('thumb'));
                $slide->thumb = $path;
            }

            $slide->active = $req->active;
            return $slide->save();
        } catch (Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public function RemoveSlide(Slide $slide)
    {
        try {
            Storage::delete($slide->thumb);
            $slide->delete();
            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }
}
