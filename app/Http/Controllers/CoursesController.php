<?php

namespace App\Http\Controllers;

use App\Services\CoursesService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CoursesController extends Controller
{
    public function add(Request $request)
    {
        try {
            $data = $request->only('name', 'teacher', 'description', 'cost');
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'teacher' => ['required', 'string', 'max:255'],
                'description' => ['string'],
                'cost' => ['numeric', 'max:255'],
            ], $data);
            if (((new CoursesService())->getFirst(['name'=>$data['name'],'teacher'=>$data['teacher']])) != null)
            {throw new \Exception('this course have been added before');}
            $data['uniqueId'] = Str::random(20);
            if (!(new CoursesService())->save($data)) {
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

    public function edit(Request $request)
    {
        try {
            $data = $request->only('uniqueId', 'name', 'teacher', 'description', 'cost');
            $request->validate([
                'uniqueId' => ['required', 'string'],
                'name' => ['string', 'max:255'],
                'teacher' => ['string', 'max:255'],
                'description' => ['numeric'],
                'cost' => ['string'],
            ], $data);
            if (!(new CoursesService())->update($data, ['uniqueId' => $data['uniqueId']])) {
                throw new \Exception('the data does not update');
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
            $data = $request->only('uniqueId','search');
            $request->validate([
                'uniqueId' => ['string'],
                'search' => ['string']
            ]);
            $user = (new CoursesService())->getList();
            if ($request->has('uniqueId')) {
                $user = (new CoursesService())->getFirst(['uniqueId' => $data['uniqueId']]);
            } elseif ($request->has('search')) {
                $user = ((new CoursesService())->getList(['keyword' => $data['search']]));
            }
            return \response()->json([
                'error' => 0,
                'hotel' => $user,
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
            if (!((new CoursesService())->delete(['uniqueId' => $data['uniqueId']]))) {
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
