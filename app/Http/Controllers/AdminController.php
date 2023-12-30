<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Drink;
use App\Models\User;
use App\Models\Catgory;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

session_start();

class AdminController extends Controller
{
    public function index()
    {
        return view('admin_login');
    }

    public function showdashboard()
    {
        return view('admin_layout');
    }


    //category
    public function formthem()
    {
        return view('category.add');
    }

    public function add_category(Request $request)
    {
        $request->validate([
            'cat_id' => 'unique:category'
        ]);
        $cat_id = $request->input('cat_id');
        $cat_name = $request->input('cat_name');



        Category::create([
            'cat_id' => $cat_id,
            'cat_name' => $cat_name,
        ]);

        return redirect()->route('listcategory')->with('success', 'Thêm thành công');
    }

    public function show_category()
    {
        $category = Category::select('cat_id', 'cat_name')->get();

        return view('category.show', ['category' => $category]);
    }

    public function edit_category($id)
    {
        $category = Category::find($id);

        return view('category.edit', ['category' => $category]);
    }

    public function update_category(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update([
            'cat_name' => $request->input('cat_name'),
        ]);

        return redirect()->route('listcategory')->with('success', 'Đã cập nhật thành công!');
    }

    public function delete_category($id)
    {
        $category = Category::find($id);
        $drink = Drink::where('cat_id', $id)->count();
        if (Drink::where('cat_id', $id)->exists()) {
            return redirect()->route('listcategory')->with('errordelete', 'Danh mục đã tồn tại ' . $drink . ' sản phẩm không thể xóa');
        } else {
            $category->delete();
            return redirect()->route('listcategory')->with('success', 'Đã xóa thành công!');
        }
    }

    //Drink
    public function add_drink(Request $request)
    {
        $request->validate([
            'drink_id' => 'unique:drink'
        ]);
        $filename = '';

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('backend/images/', $filename);
        }


        $drink_id = $request->input('drink_id');
        $drink_name = $request->input('drink_name');
        $price = $request->input('price');
        $img = $filename;
        $cat_id = $request->input('cat_id');

        Drink::create(
            [
                'drink_id' => $drink_id,
                'drink_name' => $drink_name,
                'price' => $price,
                'img' => $img,
                'cat_id' => $cat_id,

            ]
        );

        return redirect()->route('listdrink')->with('success', 'Thêm thành công');
    }

    public function show_drink()
    {
        $drink = Drink::all();

        foreach ($drink as $d) {
            $category = Category::find($d->cat_id);
            $d->cat_name = $category ? $category->cat_name : '???';
        }

        return view('item.showitem', ['drink' => $drink]);
    }

    public function formthemdrink()
    {

        $category = Category::select('cat_id', 'cat_name')->get();
        return view('item.additem', ['category' => $category]);
    }

    public function edit_drink($id)
    {
        $drink = Drink::find($id);
        $category = Category::select('cat_id', 'cat_name')->get();
        return view('item.edititem', ['drink' => $drink], ['category' => $category]);
    }

    public function update_drink(Request $request, $id)
    {
        $drink = Drink::find($id);

        $image_path = public_path('backend/images/' . $drink->img);
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $filename = '';

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('backend/images/', $filename);
        }

        $drink_name = $request->input('drink_name');
        $price = $request->input('price');
        $img = $filename;
        $cat_id = $request->input('cat_id');

        $drink->update(
            [
                'drink_name' => $drink_name,
                'price' => $price,
                'img' => $img,
                'cat_id' => $cat_id,

            ]
        );

        return redirect()->route('listdrink')->with('success', 'Đã cập nhật thành công!');
    }

    public function delete_drink($id)
    {
        $drink = Drink::find($id);
        $image_path = public_path('backend/images/' . $drink->img);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $drink->delete();

        return redirect()->route('listdrink')->with('success', 'Đã xóa thành công!');
    }

    public function show_users()
    {
        $users = User::select('email', 'password', 'name', 'is_admin')->get();

        return view('users.showusers', ['users' => $users]);
    }

    public function show_order_user()
    {
        $order = Order::all();

        return view('orders.show_order_user', ['order' => $order]);
    }

    public function LogOut()
    {
        if (Auth::user()->is_admin == 1) {
            Auth::logout();
            return redirect()->route('trangindex');
        }
    }

    public function confirm_order($id)
    {
        $order = Order::where('id_order', $id)->first();
        $order->status = 1;
        $order->save();

        return redirect()->route('listorderuser')->with('success', 'Xác nhận đơn hàng thành công');
    }

    public function unconfirm_order($id)
    {
        $order = Order::where('id_order', $id)->first();
        $order->status = 0;
        $order->save();

        return redirect()->route('listorderuser')->with('success', 'Hủy xác nhận đơn hàng thành công');
    }
    public function delivery_order($id)
    {
        $order = Order::where('id_order', $id)->first();
        $order->status = 2;
        $order->save();

        return redirect()->route('listorderuser')->with('success', 'Xác nhận đang giao hàng thành công');
    }

    public function admin_setrole($email)
    {
        $user = User::where('email', $email)->first();
        $user->is_admin = 1;
        $user->save();

        return redirect()->route('listusers')->with('success', 'Set role admin thành công');
    }

    public function admin_unsetrole($email)
    {
        $user = User::where('email', $email)->first();
        $user->is_admin = 0;
        $user->save();

        return redirect()->route('listusers')->with('success', 'UnSet role admin thành công');
    }

    public function delete_order($id)
    {
        $order = Order::find($id);
        $order->delete();

        $orderdetail = OrderDetail::find($id);
        $orderdetail->delete();
    }



    public function delete_user($email)
    {
        $user = User::where('email', $email);
        $user->delete();

        $order = DB::select("SELECT * FROM `orders` WHERE `email_user`= '$email'");

        foreach ($order as $i) {
            $this->delete_order($i->id_order);
        }


        return redirect()->route('listusers')->with('success', 'Xóa thành công');
    }
}
