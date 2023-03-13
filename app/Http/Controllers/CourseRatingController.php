<?php

namespace App\Http\Controllers;

use App\Services\CourseRatingService;
use Illuminate\Http\Request;

class CourseRatingController extends Controller
{
    public function add(Request $request)
    {
        try {
            $data = $request->only('courseId','rate');
            $request->validate([
                'courseId'=>['required','string'],
                'rate'=>['required','string'],
            ]);
            $data['userId']=auth()->user()->uniqueId;
            if (((new CourseRatingService())->getFirst(['userId'=>$data['userId'],'courseId'=>$data['courseId']])) != null)
            {throw new \Exception('you have rated this course before');}
            if(!(new CourseRatingService())->save($data))
            {
                throw new \Exception('data dose not save');
            }
            return \response()->json([
                'error'=>0,
                'msg'=>'save successfully'
            ]);
        }catch (\Exception $e)
        {
            return \response()->json([
                'error'=>1,
                'msg'=>$e->getMessage()
            ]);
        }
    }
    public function edit(Request $request)
    {
        try
        {
            $data = $request->only('id', 'rate');
            $request->validate([
                'id'=>['required','string'],
                'rate'=>['required','numeric']
            ],$data);
            if (!((new CourseRatingService())->update($data,['id'=>$data['id']])))
            {
                throw new \Exception('does not update');
            }
            return response()->json([
                'error'=>0,
                'msg'=>'update successful'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'error'=>1,
                'msg'=>$e->getMessage()
            ]);
        }
    }
    public function view(Request $request)
    {
        $data =$request->only('userId','courseId');
        $request->validate([
            'userId'=>['string'],
            'courseId'=>['string'],
        ],$data);
        $rating = ((new CourseRatingService())->getListQuery());
            if ($request->has('userId')) {
                $rating = $rating->where(['userId' => $data['userId']]);
            }
            if ($request->has('courseId')) {
                $rating = $rating->where(['hotelId' => $data['hotelId']]);
            }
        return response()->json([
            'error'=>0,
            'rating'=>$rating->get()
        ]);
    }

    public function delete(Request $request)
    {
        try {
            $data = $request->only('id');
            $request->validate([
                'id' => ['required', 'string']
            ]);
            if (!((new CourseRatingService())->delete(['id' => $data['id']]))) {
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
