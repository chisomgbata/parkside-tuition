<?php

use App\Models\Student;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $courses = [
        [
            'name' => 'Math',
            "description" => 'Become exceptional in arithmetics',
            'icon' => 'heroicon-o-plus-circle'
        ], [
            'name' => 'Biology',
            "description" => 'Learn about living organisms',
            'icon' => 'heroicon-s-heart'
        ], [
            'name' => ' Chemistry',
            "description" => 'Study the composition of matter',
            'icon' => 'heroicon-o-beaker'
        ], [
            'name' => 'Physics',
            "description" => 'Learn about the nature and properties of matter and energy',
            'icon' => 'heroicon-o-bolt'

        ], [
            'name' => '11 Plus',
            "description" => 'Prepare for the 11 plus exam',
            'icon' => 'heroicon-o-academic-cap'
        ]
    ];

    return view('welcome', compact('courses'));
});

Route::get('/classes', function () {

    $user = session()->get('user');
    if (!$user) {
        return redirect()->route('access-class');
    }

    $links = Student::find($user->id)->links;

    return view('class', compact(['user', 'links']));
})->name('classes');

Route::get('/access-class', function () {
    return view('access-form');
})->name('access-class');

