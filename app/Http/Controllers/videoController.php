<?php

namespace App\Http\Controllers;

use App\Models\video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class videoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $video = video::latest()->paginate(2);
        return view('video.index', compact('video'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video' => ['required', 'file', 'mimetypes:video/mp4,video/mpeg,video/quicktime', 'max:10240'],
            'caption' => 'required','caption' => 'nullable|max:100',
        ]);

        $video = new video();
        $video->created_by = Auth::id();
        $video->video = $request->file('video')->store('video');
        $video->caption = $request->caption;
        $video->save();

        return redirect()->route('video.index')->with('success', 'Video Berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(video $video)
    {
        // Hapus video dari penyimpanan sebelum menghapus data dari database
        if ($video->video) {
            Storage::delete($video->video);
        }

        if ($video->delete()) {
            return redirect()->route('video.index')->with('success', 'Video berhasil dihapus!');
        }

        return redirect()->route('video.index')->with('error', 'Gagal menghapus video.');
    }
}
