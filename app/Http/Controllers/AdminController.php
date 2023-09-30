<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;




class AdminController extends Controller
{
    public function adminloginpage()
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',

        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->user_type == "admin") {
                return redirect('/');
                // return redirect()->route('admin-vieworders', app()->getLocale())->with('success', 'You have successfully logged in');
            } else {
                Auth::logout();
                return redirect(__('routes.admin-login'))->with('danger', 'Oops! You do not have the required access permission');
            }
        }
        return redirect(__('routes.admin-login'))->with('danger', 'Oppes! You have entered invalid credentials');
    }

    // public function adminLogin(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);
    // }




    public function adminLogout()
    {
        Session::flush();
        Auth::logout();

        return Redirect(__('routes.admin-login'));
    }

    public function viewOrders(Request $request)
    {

        $authuser = auth()->user()->id;
        if ($request->status_filter != '') {
            if ($request->status_filter == 'pending') {
                $data = Order::with('Order_address', 'category', 'user')->orderBy('id', 'desc')->where('status', 'pending')->get();
            }
            if ($request->status_filter == 'delivered') {
                $data = Order::with('Order_address', 'category', 'user')->orderBy('id', 'desc')->where('status', 'delivered')->get();
            }
            return Datatables::of($data)->addIndexColumn()
                ->editColumn('catgory', function ($row) {
                    $category = $row->category->category_name;
                    return $category;
                })
                ->editColumn('user', function ($row) {
                    $user = $row->user->name;
                    return $user;
                })
                ->editColumn('date', function ($row) {
                    $date = $row->created_at->format('Y-m-d');
                    return $date;
                })
                ->editColumn('selection', function ($row) {
                    $date = __($row->selection);
                    return $date;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<div class="d-flex" style="gap:20px;">
                                    <div><a class="btn btn-secondary btn-sm" href=' . __("routes.admin-orderdetails") . $row->id . '>Order detail</a></div>
                                </div>';
                    return $btn;
                })
                ->rawColumns(['catgory', 'date', 'user', 'action', 'selection'])
                ->make(true);
        } else {
            if ($request->ajax()) {
                $data = Order::with('Order_address', 'category', 'user')->orderBy('id', 'desc')->get();
                return Datatables::of($data)->addIndexColumn()
                    ->editColumn('catgory', function ($row) {
                        $category = $row->category->category_name;
                        return $category;
                    })
                    ->editColumn('user', function ($row) {
                        $user = $row->user->name;
                        return $user;
                    })
                    ->editColumn('date', function ($row) {
                        $date = $row->created_at->format('Y-m-d');
                        return $date;
                    })
                    ->editColumn('selection', function ($row) {
                        $date = __($row->selection);
                        return $date;
                    })
                    ->addColumn('action', function ($row) {

                        $btn = '<div class="d-flex" style="gap:20px;">
                                    <div><a class="btn btn-secondary btn-sm" href=' . __("routes.admin-orderdetails") . $row->id . '>Order detail</a></div>
                                </div>';
                        return $btn;
                    })
                    ->rawColumns(['catgory', 'date', 'user', 'action', 'selection'])
                    ->make(true);
            }
        }
        return view('admin.orders.vieworders');
    }

    public function changePassword()
    {
        return view('admin.changepassword');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'password_confirmation' => 'required|same:newpassword'
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {

            $users = User::find(Auth::user()->id);
            $users->password = bcrypt($request->newpassword);
            $users->save();
            session()->flash('message', 'password updated successfully');
            return redirect(__('/'));
        } else {
            session()->flash('message', 'old password does not matched');
            return redirect(__('routes.admin-changepassword'));
        }
    }

    public function adminProfile()
    {
        $authuser = auth()->user()->id;
        $user = User::where('id', $authuser)->first();
        return view('admin.profile.profile', compact('user'));
    }
    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('sidebar', true);
        }
        $user = auth()->user();
        $address = $request->address;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '-' . $file->getClientOriginalName();
            $destination = $user->id . '-profile' . $filename;
            $path = Storage::disk('s3')->put($destination, file_get_contents($file));
            $imageUrl = Storage::disk('s3')->url($destination);
            $user->image = $imageUrl;
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->contact_no = $request->input('number');
        $user->address = $address;
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully!')->with('sidebar', true);
    }
    public function orderDetails($locale, $id)
    {
        $order = Order::with('Order_address', 'Orderfile_uploads', 'Orderfile_formats')->where('id', $id)->first();
        return view('common.orderdetails', compact('order'));
    }


    public function AdminviewOrders(Request $request)
    {
        $authuser = auth()->user()->id;
        if ($request->status_filter != '') {
            if ($request->status_filter == 'pending') {
                $data = Order::with('Order_address', 'category', 'user')->orderBy('id', 'desc')->where('status', 'pending')->get();
            }
            if ($request->status_filter == 'delivered') {
                $data = Order::with('Order_address', 'category', 'user')->orderBy('id', 'desc')->where('status', 'delivered')->get();
            }
            return Datatables::of($data)->addIndexColumn()
                ->editColumn('catgory', function ($row) {
                    $category = $row->category->category_name;
                    return $category;
                })
                ->editColumn('user', function ($row) {
                    $user = $row->user->name;
                    return $user;
                })
                ->editColumn('date', function ($row) {
                    $date = $row->created_at->format('Y-m-d');
                    return $date;
                })
                ->editColumn('selection', function ($row) {
                    $date = __($row->selection);
                    return $date;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<div class="d-flex" style="gap:20px;">
                                    <div><a class="btn btn-secondary btn-sm" href=' . __("routes.admin-orderdetails") . $row->id . '>Order detail</a></div>
                                </div>';
                    return $btn;
                })
                ->rawColumns(['catgory', 'date', 'user', 'action', 'selection'])
                ->make(true);
        } else {
            if ($request->ajax()) {
                $data = Order::with('Order_address', 'category', 'user')->orderBy('id', 'desc')->get();
                return Datatables::of($data)->addIndexColumn()
                    ->editColumn('catgory', function ($row) {
                        $category = $row->category->category_name;
                        return $category;
                    })
                    ->editColumn('user', function ($row) {
                        $user = $row->user->name;
                        return $user;
                    })
                    ->editColumn('date', function ($row) {
                        $date = $row->created_at->format('Y-m-d');
                        return $date;
                    })
                    ->editColumn('selection', function ($row) {
                        $date = __($row->selection);
                        return $date;
                    })
                    ->addColumn('action', function ($row) {

                        $btn = '<div class="d-flex" style="gap:20px;">
                                    <div><a class="btn btn-secondary btn-sm" href=' . __("routes.admin-orderdetails") . $row->id . '>Order detail</a></div>
                                </div>';
                        return $btn;
                    })
                    ->rawColumns(['catgory', 'date', 'user', 'action', 'selection'])
                    ->make(true);
            }
        }
        return response()->json([
            'messgae' => 'done'
        ]);
    }
}
