<?php

namespace App\Http\Controllers;

use App\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    const UPLOAD_DIR = 'upload';
    const RESULTS_UPLOAD_DIRECTORY = 'results';

    private $deleted;
    private $deletedSource;

    public function delete($id)
    {
        $this->deleted = Result::find($id);

        if (!$this->deleted) {
            return response()->json([
                'result' => 'error'
            ]);
        }

        Result::destroy($id);

        $this->deletedSource = public_path() . '/' . self::UPLOAD_DIR . '/' .
            self::RESULTS_UPLOAD_DIRECTORY . '/' . $this->deleted->order_id . '/' .
            $this->deleted->src;

        if (file_exists($this->deletedSource)) {
            unlink($this->deletedSource);
        }

        return response()->json([
            'result' => 'success'
        ]);
    }
}
