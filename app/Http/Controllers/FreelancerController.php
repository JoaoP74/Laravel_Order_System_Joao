<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Order_address;
use App\Models\OrderAddress;
use Intervention\Image\Facades\Image;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\DeliveryFile;
use Illuminate\Support\Facades\Validator;



use DataTables;

use App\Models\Order_file_upload;
use Illuminate\Support\Env;

use function PHPUnit\Framework\returnCallback;

class FreelancerController extends Controller
{
    public function freelancerloginpage()
    {
        return view('freelancer.login');
    }

    public function adminloginpage11()
    {
        return view('admin.login');
    }

    public function freelancerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',

        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->user_type == "freelancer") {
                return redirect('/');
            } else {
                Auth::logout();
                return redirect(__('routes.freelancer-login'))->with('danger', 'Oops! You do not have the required access permission');
            }
        }
        return redirect(__('routes.freelancer-login'))->with('danger', 'Oppes! You have entered invalid credentials');
    }




    public function freelancerLogout()
    {
        Session::flush();
        Auth::logout();

        return Redirect(__('routes.freelancer-login'));
    }

    public function viewOrder(Request $request)
    {
        $authuser = auth()->user()->id;
        if ($request->status_filter != '') {
            if ($request->status_filter == 'pending') {
                $data = Order::with('Order_address', 'category', 'Orderfile_uploads')->orderBy('id', 'desc')->where('status', 'pending')->get();
                return Datatables::of($data)->addIndexColumn()
                    ->editColumn('catgory', function ($row) {
                        $category = $row->category->category_name;
                        return $category;
                    })
                    ->editColumn('company', function ($row) {
                        $company = $row->order_address->company;
                        return $company;
                    })
                    ->editColumn('user', function ($row) {
                        $user = $row->user->name;
                        return $user;
                    })
                    ->editColumn('date', function ($row) {
                        $date = $row->created_at->format('Y-m-d');
                        return $date;
                    })
                    ->addColumn('detail', function ($row) {
                        $btn =  '<a style="text-decoration:none;" class="btn btn-secondary btn-sm" href=' . __("routes.freelancer-orderdetails") . $row->id . '>Order deatils</a>';
                        return $btn;
                    })
                    // ->addColumn('action', function ($row) {
                    //     $btn =  '<div class="d-flex" style="gap:20px;">
                    //                 <div><a href=""><i class="fa-solid fa-circle-xmark" style="color: #d41616;"></i></a></div>
                    //                 <div><a href=""><i class="fa-solid fa-circle-check" style="color: #0d8604;"></i></a></div>
                    //             </div>';
                    //     return $btn;
                    // })
                    ->addColumn('upload', function ($row) {
                        $btn =  '<a href=' . __("routes.delivery-files") . $row->id . ' class="btn btn-secondary btn-sm"> Upload Files </a>';
                        return $btn;
                    })
                    ->rawColumns(['catgory', 'upload', 'user', 'date', 'company', 'detail'])
                    ->make(true);
            }
            if ($request->status_filter == 'delivered') {
                $data = Order::with('Order_address', 'category', 'Orderfile_uploads')->orderBy('id', 'desc')->where('status', 'delivered')->get();
            }
            return Datatables::of($data)->addIndexColumn()
                    ->editColumn('catgory', function ($row) {
                        $category = $row->category->category_name;
                        return $category;
                    })
                    ->editColumn('company', function ($row) {
                        $company = $row->order_address->company;
                        return $company;
                    })
                    ->editColumn('date', function ($row) {
                        $date = $row->created_at->format('Y-m-d');
                        return $date;
                    })
                    ->editColumn('user', function ($row) {
                        $user = $row->user->name;
                        return $user;
                    })
                    ->editColumn('selection', function ($row) {
                        $date = __($row->selection);
                        return $date;
                    })
                    ->addColumn('detail', function ($row) {
                        $btn =  '<a style="text-decoration:none;" class="btn btn-secondary btn-sm" href=' . __("routes.freelancer-orderdetails") . $row->id . '>Order deatils</a>';
                        return $btn;
                    })
                    // ->addColumn('action', function ($row) {
                    //     $btn =  '<div class="d-flex" style="gap:20px;">
                    //                 <div><a href=""><i class="fa-solid fa-circle-xmark" style="color: #d41616;"></i></a></div>
                    //                 <div><a href=""><i class="fa-solid fa-circle-check" style="color: #0d8604;"></i></a></div>
                    //             </div>';
                    //     return $btn;
                    // })
                    ->addColumn('upload', function ($row) {
                        $btn =  '<a href=' . __("routes.delivery-files") . $row->id . ' class="btn btn-secondary btn-sm"> Upload Files </a>';
                        return $btn;
                    })
                    ->rawColumns(['catgory', 'upload', 'user', 'date', 'company', 'detail'])
                    ->make(true);
        } else {
            if ($request->ajax()) {
                $data = Order::with('Order_address', 'category', 'Orderfile_uploads')->orderBy('id', 'desc')->where('assigned_to', $authuser)->get();
                return Datatables::of($data)->addIndexColumn()
                    ->editColumn('catgory', function ($row) {
                        $category = $row->category->category_name;
                        return $category;
                    })
                    ->editColumn('user', function ($row) {
                        $user = $row->user->name;
                        return $user;
                    })
                    ->editColumn('company', function ($row) {
                        $company = $row->Order_address->company;
                        return $company;
                    })
                    ->editColumn('date', function ($row) {
                        $date = $row->created_at->format('Y-m-d');
                        return $date;
                    })
                    ->editColumn('selection', function ($row) {
                        $date = __($row->selection);
                        return $date;
                    })
                    ->addColumn('detail', function ($row) {
                        $btn =  '<a style="text-decoration:none;" class="btn btn-secondary btn-sm" href=' . __("routes.freelancer-orderdetails") . $row->id . '>Order deatils</a>';
                        return $btn;
                    })
                    // ->addColumn('action', function ($row) {

                    //     $btn =  '<div class="d-flex" style="gap:20px;">
                    //                 <div><a href=""><i class="fa-solid fa-circle-xmark" style="color: #d41616;"></i></a></div>
                    //                 <div><a href=""><i class="fa-solid fa-circle-check" style="color: #0d8604;"></i></a></div>
                    //             </div>';
                    //     return $btn;
                    // })
                    ->addColumn('upload', function ($row) {
                        $btn =  '<a href=' . __("routes.delivery-files") . $row->id . ' class="btn btn-secondary btn-sm"> Upload Files </a>';
                        return $btn;
                    })
                    ->rawColumns(['catgory', 'upload', 'user', 'date', 'company', 'detail'])
                    ->make(true);
            }
        }
        return view('freelancer.orders.vieworders');
    }

    public function orderDetails($locale, $id)
    {
        $authuser = auth()->user()->id;
        $order = Order::with('Order_address', 'Orderfile_uploads', 'Orderfile_formats')->where('id', $id)->first();
        return view('common.orderdetails', compact('order'));
    }

    public function downloadAddressFIle(Request $request)
    {
        $uploadedFile = $request->image;
        $jpgImage = Image::make($uploadedFile)->encode('jpg');
        // $response = response()->streamDownload(function () use ($jpgImage) {
        //     echo $jpgImage;
        // }, $filename . '.jpg');

        // return $response->header('Content-Type', 'image/jpeg');
    }


    public function downloadFile(Request $request)
    {
        $file = $request->addressfile;
        $file_path = public_path() . "/orders/$file";

        $headers = array(
            'Content-Type: image/jpeg',
        );
        return Response::download($file_path, $file, $headers);
    }

    public function checkFiles(Request $request)
    {
        $id = $request->id;
        $category = $request->category;
        $ordersfiles = Order_file_upload::where('order_id', $id)->get();
        // $ordersfiles = Order::with('Orderfile_uploads')->where('id', $id)->first();
        return response()->json([
            'data' => $ordersfiles
        ]);
    }

    public function freelancerProfile()
    {
        $authuser = auth()->user()->id;
        $user = User::where('id', $authuser)->first();
        return view('freelancer.profile.profile', compact('user'));
    }
    public function Profileupdate(Request $request)
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
            $destination = $user->id.'-profile'.$filename;
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

    public function changePassword()
    {
        return view('freelancer.changepassword');
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
            return redirect(__('routes.freelancer-changepassword'));
        }
    }

    public function DeleteFile($locale, $id, $orderid)
    {
        $indexToDelete = $id;
        $ordersid = $orderid;

        $deleteFile = DeliveryFile::where('order_id', $orderid)->first();
        $deliveryFiles = json_decode($deleteFile->delivery_files);
        if ($indexToDelete >= 0 && $indexToDelete < count($deliveryFiles)) {
            unset($deliveryFiles[$indexToDelete]);
            $deliveryFiles = array_values($deliveryFiles);
            $update = DeliveryFile::where('order_id', $orderid)->update([
                'delivery_files' => $deliveryFiles,
            ]);
        } else {
            return response()->json([
                'message' => 'Not Deleted',
            ]);
        }
        return back()->with('success', 'File Deleted Successfully');
    }


    public function filtersData()
    {
        dd('ok');
    }
}
