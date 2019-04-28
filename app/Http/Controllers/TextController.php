<?php

namespace App\Http\Controllers;

use App\Text;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TextController extends Controller
{
    public function updateText(Request $request)
    {
        $text = Text::findOrFail($request->input('id'));
        $text->short_text = $request->input('short_text');
        $text->long_text = $request->input('long_text');
        $text->save();
        return response()->json([
            'message' => 'Text changed'
        ],201);

    }
    public function getText() {
        return response(Text::all()->jsonSerialize(), Response::HTTP_OK);
    }
}
