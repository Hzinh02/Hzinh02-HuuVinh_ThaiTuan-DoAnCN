<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drink;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

use function Laravel\Prompts\password;
use function Laravel\Prompts\table;

class HomeController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $drink = Drink::all();
        // $drink = Drink::paginate(3); //phân trang


        //         <div style="text-align: right;">
        //     {{ $drink->links() }}
        // </div> 

        return view('pages.home', ['drink' => $drink], ['category' => $category]);
    }

    public function sort_Drink_Asc()
    {
        $category = Category::all();
        $drink = Drink::orderBy('price', 'asc')->get();
        return view('pages.home', ['drink' => $drink], ['category' => $category]);
    }
    public function sort_Drink_Desc()
    {
        $category = Category::all();
        $drink = Drink::orderBy('price', 'desc')->get();
        return view('pages.home', ['drink' => $drink], ['category' => $category]);
    }

    public function sort_Drink_Name_Asc()
    {
        $category = Category::all();
        $drink = Drink::orderBy('drink_name', 'asc')->get();
        return view('pages.home', ['drink' => $drink], ['category' => $category]);
    }
    public function sort_Drink_Name_Desc()
    {
        $category = Category::all();
        $drink = Drink::orderBy('drink_name', 'desc')->get();
        return view('pages.home', ['drink' => $drink], ['category' => $category]);
    }

    public function filter_drink($x)
    {
        $drink = DB::select("SELECT * FROM `drink` WHERE `cat_id`= '$x'");
        // $ten = DB::select("SELECT `cat_name` FROM `category` WHERE `cat_id`= '$x'");
        // $a = $ten;
        $category = Category::all();
        $ma = DB::select("SELECT `cat_id` FROM `category` WHERE `cat_id`= '$x'");
        $a = $ma;
        return view('pages.filter', ['drink' => $drink], ['category' => $category])->with(compact('a'));
    }

    public function addDrinktoCart($id)
    {
        $drink = Drink::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id_drink" => $drink->drink_id,
                "name" => $drink->drink_name,
                "quantity" => 1,
                "price" => $drink->price,
                "image" => $drink->img,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Thêm thành công');
    }

    public function DrinkCart()
    {
        $countorder = Order::where('email_user', Auth::user()->email)->count();
        $category = Category::all();
        return view('pages.cart', ['category' => $category], ['countorder' => $countorder]);
    }

    public function DeleteCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Xóa thành công');
        }
    }

    public function delete($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('shopping.cart');
    }

    public function UpdateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if ($request->change_to == 'down') {
            if (isset($cart[$id])) {
                if ($cart[$id]['quantity'] > '1') {
                    $cart[$id]['quantity']--;
                    return $this->putCart($cart);
                } else {
                    return $this->delete($id);
                }
            }
        } else {
            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
                return $this->putCart($cart);
            }
        }
    }

    public function putCart($cart)
    {
        session()->put('cart', $cart);
        return redirect()->route('shopping.cart');
    }

    public function form()
    {
        return view('pages.register_signin');
    }

    public function PostRegister(Request $request)
    {
        $request->validate([
            'Email' => 'unique:users|email',
            'Name' => 'required',
            'Password' => 'required|min:8',
        ]);

        $name = $request->input('Name');
        $email = $request->input('Email');
        $password = Hash::make($request->input('Password'));

        User::create([
            "email" => $email,
            "password" => $password,
            "name" => $name,
        ]);

        session()->flash('successregister', 'Đăng ký thành công');
        return redirect()->back();
    }

    public function PostLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->Email_Login, 'password' => $request->Password_Login, 'is_admin' => 1])) {
            return redirect()->route('adminpage')->with('success', 'Đăng nhập thành công!');
        } else if (Auth::attempt(['email' => $request->Email_Login, 'password' => $request->Password_Login, 'is_admin' => 0])) {
            return redirect()->route('trangchu')->with('success', 'Đăng nhập thành công!');
        } else {
            return redirect()->back()->with('error', 'Sai tài khoản hoặc mật khẩu');
        }
    }

    public function formorder()
    {
        return view('pages.order');
    }

    public function AddOrder(Request $request)
    {
        $request->validate([
            'name_user' => 'required',
            'address' => 'required',
            'phone' => 'required|min:10|max:10',
        ]);


        $name = $request->input('name_user');
        $address = $request->input('address');
        $phone = $request->input('phone');

        $order = new Order();
        $order->name = $name;
        $order->address = $address;
        $order->phone = $phone;
        $order->email_user = Auth::user()->email;
        $order->save();


        foreach (session('cart') as $id => $detailcart) {
            $id_drink = $detailcart['id_drink'];
            $price = $detailcart['price'];
            $quantity = $detailcart['quantity'];
            $subtotal = $price * $quantity;

            $orderdetail = new OrderDetail();
            $orderdetail->id_order = $order->id_order;
            $orderdetail->id_drink = $id_drink;
            $orderdetail->price = $price;
            $orderdetail->quantity = $quantity;
            $orderdetail->subtotal = $subtotal;
            $orderdetail->save();

            if (count((array) session('cart')) > 0) {
                $this->delete($id);
            }
        }

        return redirect()->route('listorder');
    }

    public function show_order()
    {
        $x = Auth::user()->email;
        $order = DB::select("SELECT * FROM `orders` WHERE `email_user`= '$x'");

        return view('pages.show_order', ['order' => $order]);
    }

    public function delete_order($id)
    {
        $order = Order::find($id);
        $order->delete();

        $orderdetail = OrderDetail::find($id);
        $orderdetail->delete();


        return redirect()->route('listorder');
    }

    public function detail_order($id)
    {
        $orderdetail = DB::select("SELECT * FROM `orders_detail` WHERE `id_order`= '$id'");
        foreach ($orderdetail as $o) {
            $drink = Drink::find($o->id_drink);
            $o->drink_name = $drink ? $drink->drink_name : '???';
        }
        return view('pages.order_detail', ['orderdetail' => $orderdetail]);
    }

    public function Search(Request $request)
    {
        $query = $request->input('query');

        $drink = Drink::where('drink_name', 'LIKE', "%$query%")
            ->orWhere('price', 'LIKE', "%$query%")
            ->get();

        $category = Category::all();
        return view('pages.home', ['drink' => $drink], ['category' => $category]);
    }


    public function LogOut()
    {
        if (Auth::user()->is_admin == 0) {
            Auth::logout();
            return redirect()->route('trangindex');
        }
    }

    public function sort_DrinkByCategory_Asc($id)
    {
        $ma = DB::select("SELECT `cat_id` FROM `category` WHERE `cat_id`= '$id'");
        $a = $ma;
        $category = Category::all();
        $drink = Drink::where('cat_id', $id)->orderBy('price', 'asc')->get();
        return view('pages.filter', ['drink' => $drink], ['category' => $category])->with(compact('a'));
        // dd($id);
    }

    public function sort_DrinkByCategory_Desc($id)
    {
        $ma = DB::select("SELECT `cat_id` FROM `category` WHERE `cat_id`= '$id'");
        $a = $ma;
        $category = Category::all();
        $drink = Drink::where('cat_id', $id)->orderBy('price', 'desc')->get();
        return view('pages.filter', ['drink' => $drink], ['category' => $category])->with(compact('a'));
    }

    public function sort_DrinkNameByCategory_Asc($id)
    {
        $ma = DB::select("SELECT `cat_id` FROM `category` WHERE `cat_id`= '$id'");
        $a = $ma;
        $category = Category::all();
        $drink = Drink::where('cat_id', $id)->orderBy('drink_name', 'asc')->get();
        return view('pages.filter', ['drink' => $drink], ['category' => $category])->with(compact('a'));
    }

    public function sort_DrinkNameByCategory_Desc($id)
    {
        $ma = DB::select("SELECT `cat_id` FROM `category` WHERE `cat_id`= '$id'");
        $a = $ma;
        $category = Category::all();
        $drink = Drink::where('cat_id', $id)->orderBy('drink_name', 'desc')->get();
        return view('pages.filter', ['drink' => $drink], ['category' => $category])->with(compact('a'));
    }

    public function Detail($id)
    {
        $drink = Drink::where('drink_id', $id)->get();

        return view('pages.detail')->with(compact('drink'));
    }
}
