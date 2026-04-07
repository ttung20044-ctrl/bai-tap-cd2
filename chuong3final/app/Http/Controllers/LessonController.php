<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Hiển thị danh sách bài học của 1 khóa học
     */
    public function index($course_id)
    {
        $lessons = Lesson::where('course_id', $course_id)
                         ->orderBy('order', 'asc')
                         ->get();
                         
        return view('lessons.index', compact('lessons'));
    }

    /**
     * Thêm bài học mới vào khóa học
     */
    public function store(Request $request, $course_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'order' => 'required|integer'
        ]);

        $course = Course::findOrFail($course_id);
        
        $course->lessons()->create([
            'title' => $request->title,
            'content' => $request->content,
            'video_url' => $request->video_url,
            'order' => $request->order
        ]);

        return back()->with('success', 'Thêm bài học thành công!');
    }

    /**
     * Cập nhật bài học
     */
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'order' => 'required|integer'
        ]);

        $lesson->update($request->only(['title', 'content', 'video_url', 'order']));
        return back()->with('success', 'Cập nhật bài học thành công!');
    }

    /**
     * Xóa bài học
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return back()->with('success', 'Đã xóa bài học!');
    }
}