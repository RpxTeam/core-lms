<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class Lesson extends Model
{
    protected $fillable = ['order', 'title', 'slug', 'description', 'type','content','mime'];
    protected $hidden = [];
    public static $searchable = [
        'title',
        'slug',
        'description',
        'content',
    ];

    public static function courseLessons($course){
        $lessons = DB::table('course_lesson')
        ->leftJoin('lessons','course_lesson.lesson_id','=','lessons.id')
        ->where('course_lesson.course_id','=',$course->id)
        ->get();

        foreach($lessons as $lesson){
            if($lesson->content != null && $lesson->mime != null){
                $lesson->content = Storage::url($lesson->content);
            }
        }
        
        return $lessons;
    }

    public static function userLessons($user,$course){
        $lessons = DB::table('data_lessons')
        ->leftJoin('lessons','data_lessons.lesson_id','=','lessons.id')
        ->where('data_lessons.user_id','=',$user)
        ->where('data_lessons.course_id','=',$course)
        ->get();

        return $lessons;
    }

    public static function uploadFileLesson(Request $request, Lesson $lesson){
        $filename = $lesson->id . '-' . str_slug($lesson->title) . '.' . $request->file('content')->getClientOriginalExtension();
        $request->file('content')->storeAs('lessons/content', $filename);
        $lesson->content = 'lessons/content/' . $filename;
        $lesson->mime = $request->file('content')->getClientMimeType();
        $lesson->save();
    }

    public static function updateFileLesson(Request $request, Lesson $lesson){
        $filename = $lesson->id . '-' . str_slug($lesson->title) . '.' . $request->file('content')->getClientOriginalExtension();
        $filepath = 'lessons/content/' . $filename;
        if(Storage::exists($filepath)){
            Storage::delete($filepath);
        }
        $request->file('content')->storeAs('lessons/content', $filename);
        $lesson->content =  $filepath;
        $lesson->mime = $request->file('content')->getClientMimeType();
        $lesson->save();
    }
}
