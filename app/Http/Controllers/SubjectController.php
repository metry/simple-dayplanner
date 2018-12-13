<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    const UPLOAD_DIR = 'upload';
    const SUBJECTS_UPLOAD_DIRECTORY = 'subjects';

    private $deleted;
    private $deletedSource;

    public function delete($id)
    {
        $this->deleted = Subject::find($id);

        if (!$this->deleted) {
            return response()->json([
                'result' => 'error'
            ]);
        }

        Subject::destroy($id);

        $this->deletedSource = public_path() . '/' . self::UPLOAD_DIR . '/' .
            self::SUBJECTS_UPLOAD_DIRECTORY . '/' . $this->deleted->order_id . '/' .
            $this->deleted->src;

        if (file_exists($this->deletedSource)) {
            unlink($this->deletedSource);
        }

        return response()->json([
            'result' => 'success'
        ]);
    }
}
