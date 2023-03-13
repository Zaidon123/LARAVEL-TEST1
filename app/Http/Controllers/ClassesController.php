<?php

namespace App\Http\Controllers;

use App\Services\ClassService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClassesController extends Controller
{
    public function add(Request $request)
    {
        try {
            $data = $request->only( 'courseId', 'note');
            $request->validate([
                'courseId' => ['required', 'string', 'max:255'],
                'note' => ['string'],
            ], $data);
            $data['userId']=auth()->user()->uniqueId;
            if (((new ClassService())->getFirst(['userId' => $data['userId'], 'courseId' => $data['courseId']])) != null) {
                throw new \Exception('you have been add this course before');
            }
            $data['uniqueId'] = Str::random(20);
            if (!(new ClassService())->save($data)) {
                throw new \Exception('failed save');
            }
            return \response()->json([
                'error' => 0,
                'msg' => 'save successfully',
            ]);
        } catch (\Exception $e) {
            return \response()->json([
                'error' => 1,
                'msg' => $e->getMessage()
            ]);
        }
    }
    public function view(Request $request)
    {
        try {
            $class = (new  ClassService())->getList();
            return \response()->json([
                'error' => 0,
                'user' => $class,
            ]);
        } catch (\Exception $e) {
            return \response()->json([
                'error' => 1,
                'Section' => $e->getMessage()
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $data = $request->only('uniqueId');
            $request->validate([
                'uniqueId' => ['required', 'string']
            ]);
            if (!((new ClassService())->delete(['uniqueId' => $data['uniqueId']]))) {
                throw new \exception('does not delete');
            }
            return \response()->json([
                'error' => 0,
                'msg' => 'delete successful',
            ]);
        } catch (\Exception $e) {
            return \response()->json([
                'error' => 1,
                'msg' => $e->getMessage()
            ]);
        }
    }

}
