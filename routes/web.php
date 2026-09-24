<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Weight;

Route::get('/', function () {
    return redirect('/active/index');
});

Route::get('/gallery', function () {
    $ant = "https://cdn3.movieweb.com/i/article/Oi0Q2edcVVhs4p1UivwyyseezFkHsq/1107:50/Ant-Man-3-Talks-Michael-Douglas-Update.jpg";
    $bird = "https://images.indianexpress.com/2021/03/falcon-anthony-mackie-1200.jpg";
    $cat = "https://media.newyorker.com/photos/5a875e3f33aebd0cab9bab12/master/w_2560%2Cc_limit/Brody-Passionate-Politics-Black-Panther.jpg";
    $god = "https://www.blackoutx.com/wp-content/uploads/2021/04/Thor.jpg";
    $spider = "https://icdn5.digitaltrends.com/image/spiderman-far-from-home-poster-2-720x720.jpg";

    return view('test.index', compact('ant', 'bird', 'cat', 'god', 'spider'));
});

Route::get('/gallery/ant', function () {
    $ant = "https://cdn3.movieweb.com/i/article/Oi0Q2edcVVhs4p1UivwyyseezFkHsq/1107:50/Ant-Man-3-Talks-Michael-Douglas-Update.jpg";
    return view('test.ant', compact('ant'));
});

Route::get('/gallery/bird', function () {
    $bird = "https://images.indianexpress.com/2021/03/falcon-anthony-mackie-1200.jpg";
    return view('test.bird', compact('bird'));
});

Route::get('/gallery/cat', function () {
    $cat = "https://media.newyorker.com/photos/5a875e3f33aebd0cab9bab12/master/w_2560%2Cc_limit/Brody-Passionate-Politics-Black-Panther.jpg";
    return view('test.cat', compact('cat'));
});

Route::get('/active/index', function () {
    return view('active.index');
})->name('index');

Route::get('/active/about', function () {
    return view('active.about');
})->name('about');

Route::get('/active/services', function () {
    return view('active.services');
})->name('services');

Route::get('/active/portfolio', function () {
    return view('active.portfolio');
})->name('portfolio');

Route::get('/active/team', function () {
    return view('active.team');
})->name('team');

Route::get('/active/blog', function () {
    return view('active.blog');
})->name('blog');

Route::get('/active/contact', function () {
    return view('active.contact');
})->name('contact');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/coronavirus', function () {
    $reports = [
        (object) ["country" => "chaina", "date" => "2020-04-19", "total" => "2765", "active" => "790", "death" => "47", "recovered" => "1928"],
        (object) ["country" => "Thailand", "date" => "2020-04-18", "total" => "2733", "active" => "899", "death" => "47", "recovered" => "1787"],
        (object) ["country" => "Thailand", "date" => "2020-04-17", "total" => "2700", "active" => "964", "death" => "47", "recovered" => "1689"],
        (object) ["country" => "Thailand", "date" => "2020-04-16", "total" => "2672", "active" => "1033", "death" => "46", "recovered" => "1593"],
        (object) ["country" => "Thailand", "date" => "2020-04-15", "total" => "2643", "active" => "1103", "death" => "43", "recovered" => "1497"],
    ];

    return view("coronavirus", compact("reports"));
})->name('coronavirus');

Route::get('/active/teacher', function () {
    $teachers = json_decode(
        file_get_contents('https://raw.githubusercontent.com/arc6828/laravel8/main/public/json/teachers.json')
    );

    return view("active.teacher", compact("teachers"));
})->name('active.teacher');

Route::get('/category/sport', [CategoryController::class, 'sport']);

Route::get('/category/politic', [CategoryController::class, 'politic']);

Route::get('/category/entertain', [CategoryController::class, 'entertain']);

Route::get('/category/auto', [CategoryController::class, 'auto']);


// ==================== PRODUCT ====================

Route::get('product-index', function () {
    $products = Product::get();

    return view('query-test', compact('products'));
})->name("product.index");

Route::get('product-form', function () {
    return view('product-form');
})->name("product.form");

Route::post('/product-submit', function (Request $request) {

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');

        $url = Storage::url($imagePath);

        $data["image"] = $url;
    }

    Product::create($data);

    return redirect()
        ->route('product.index')
        ->with('success', 'เพิ่มสินค้าแล้ว!');

})->name('product.submit');


// ==================== WEIGHT ====================

Route::get('/weight', function () {

    // ตารางเรียงข้อมูลล่าสุดก่อน
    $weights = Weight::orderBy('date', 'desc')->get();

    // กราฟเรียงวันที่จากเก่าไปใหม่
    $chartWeights = Weight::orderBy('date', 'asc')->get();

    return view('weight.index', compact('weights', 'chartWeights'));

})->name('weight.index');


Route::get('/weight/form', function () {

    return view('weight.form');

})->name('weight.form');


Route::post('/weight', function (Request $request) {

    $data = $request->validate([
        'date' => 'required|date',
        'weight' => 'required|numeric|min:0',
    ]);

    Weight::create($data);

    return redirect()
        ->route('weight.index')
        ->with('success', 'บันทึกข้อมูลน้ำหนักแล้ว');

})->name('weight.store');

Route::get('/weight/{id}/edit', function ($id) {

    $weight = Weight::findOrFail($id);

    return view('weight.edit', compact('weight'));

})->name('weight.edit');

Route::put('/weight/{id}', function (Request $request, $id) {

    $weight = Weight::findOrFail($id);

    $data = $request->validate([
        'date' => 'required|date',
        'weight' => 'required|numeric|min:0',
    ]);

    $weight->update($data);

    return redirect()
        ->route('weight.index')
        ->with('success', 'แก้ไขข้อมูลน้ำหนักแล้ว');

})->name('weight.update');

Route::delete('/weight/{id}', function ($id) {

    $weight = Weight::findOrFail($id);

    $weight->delete();

    return redirect()
        ->route('weight.index')
        ->with('success', 'ลบข้อมูลน้ำหนักแล้ว');

})->name('weight.destroy');