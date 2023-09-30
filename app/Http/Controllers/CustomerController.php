<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\DeliveryFile;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use App\Mail\inviteEmployeeMail;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Validator;





class CustomerController extends Controller
{
    //
    public function homePage()
    {
        return view('home');
    }


    public function login()
    {
        return view('users.login');
    }



    public function customerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',

        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->user_type == "customer" || Auth::user()->user_type == 'employer') {
                return redirect('/');
            } else {
                Auth::logout();
                return redirect(__('routes.customer-login'))->with('danger', 'Oops! You do not have the required access permission');
            }
        }
        return redirect(__('routes.customer-login'))->with('danger', 'Oppes! You have entered invalid credentials');
    }



    // ----------------------------Customer Register------------------------------

    public function registration()
    {
        return view('users.register');
    }

    public function customerRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'number' => 'required|numeric',
            'company' => 'required',
            'Salutation' => 'required',
            'site' => 'required',
            'address' => 'required',
            'place' => 'required',
            'zip_code' => 'required',
            'vat_no' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ],[
            'email.required' => __('home.email') . ' ' . __('home.required'),
            'email.unique' => __('home.unique_email'),
            'password.required' => __('home.password_req_val'),
            'password.min' => __('home.password_min_val'),
            'confirm_password.required' => __('home.confirm_req_val'),
            'confirm_password.same' => __('home.password_confirm_val')
        ]
    );

        $data = $request->all();
        $userid = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'contact_no' => $data['number'],
            'Salutation' => $data['Salutation'],
            'site' => $data['site'],
            'company' => $data['company'],
            'address' => $data['address'],
            'place' => $data['place'],
            'zip_code' => $data['zip_code'],
            'vat_no' => $data['vat_no'],
            'password' => Hash::make($data['password']),
            'user_type' => 'customer',
        ]);
        $update = User::where('id', $userid->id)->update([
            'org_id' => $userid->id
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/')->with('message', 'You have Successfully loggedin');
        }
    }

    public function customerLogout()
    {
        Session::flush();
        Auth::logout();

        return Redirect(__('routes.customer-login'));
    }

    public function changePassword()
    {
        return view('users.changepassword');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([

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
            return redirect(__('routes.customerchange-password'));
        }
    }

    public function CustomerProfile()
    {
        $authuser = auth()->user()->id;
        $user = User::where('id', $authuser)->first();
        $employees = User::orderBy('id', 'desc')->where('org_id', $authuser)->where('user_type', 'employer')->get();
        return view('users.profile.profile', compact('user', 'employees'));
    }


    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'number' => 'required',
            'address' => 'required',
            'salutation' => 'required',
            'company' => 'required',
            'zip_code' => 'required',
            'place' => 'required',
            'vat_no' => 'required',
            'site' => 'required',
            'thread' => 'required',
            'file_emb' => 'required',
            'file_vect' => 'required',
            'thread_instruction' => 'required',
            'thread_cut' => 'required',
            'needle_instruction' => 'required',
            'font_instruction' => 'required',
            'special_instruction' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('sidebar', true);
        }

        $user1 = auth()->user();
        $user = User::find($user1->id);
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
        $user->salutation = $request->salutation;
        $user->company = $request->company;
        $user->address = $request->address;
        $user->zip_code = $request->zip_code;
        $user->place = $request->place;
        $user->vat_no = $request->vat_no;
        $user->site = $request->site;
        $user->thread = $request->thread;
        $user->emb_fileType = $request->file_emb;
        $user->vec_fileType = $request->file_vect;
        $user->thread_notes = $request->thread_instruction;
        $user->thread_cut_notes = $request->thread_cut;
        $user->needle_notes = $request->needle_instruction;
        $user->font_notes = $request->font_instruction;
        $user->special_notes = $request->special_instruction;

        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully!')->with('sidebar', true);;
    }

    public function files($locale, $id)
    {
        $authuser = auth()->user()->id;
        $order = Order::findOrFail($id);
        $files = DeliveryFile::where('order_id', $id)->where('customer_id', $order->user_id)->first();
        if ($files == '') {
            return view('users.downloadfiles', compact('files'));
        } else {
            $data = json_decode($files->delivery_files);
            return view('users.downloadfiles', compact('data', 'files'));
        }
    }

    public function setEmployerPassword()
    {
        $currentUrl = request()->fullUrl();
        $lastSegment = Str::afterLast($currentUrl, '/');
        $customerid = User::where('emp_invite_id', $lastSegment)->first();
        if ($customerid == '') {
            return redirect(__('routes.customer-login'))->with([
                'danger' => 'Link Expired Please create a new Invite '
            ]);
        } else {
            $customerid = User::where('emp_invite_id', $lastSegment)->first();
            $customerid = $customerid->org_id;
            return view('common.setpassword', compact('lastSegment', 'customerid'));
        }
    }

    public function EmployerPasswordUpdate(Request $request)
    {

        $validate = $request->validate([
            'emp_id' => 'required',
            'customerid' => 'required',
            'password' => 'required|confirmed'
        ]);
        if ($validate) {
            $employerid = User::where('emp_invite_id', $request->emp_id)->update([
                'password' => Hash::make($request->password),
                'user_type' => 'employer',
                'emp_invite_id' => ''
            ]);
            return redirect(__('routes.customer-login'))->with('success', 'Employer Password Updated Successfully');
        } else {
            return back();
        }
    }

    public function InviteEmployeeView()
    {
        return view('users.employee.inviteEmployee');
    }

    public function sendInvite(Request $request)
    {
        try {
            $data = $request->all();
            $customer = auth()->user();
            $email = $data['email'];
            $routeName = 'homepage';
            $url = url(__('routes.employer-setPassword'));
            $max = 16;
            $randomNumber = Str::random($max);
            $link = $url . '/' . $randomNumber;
            try {
                Mail::to($email)->send(new inviteEmployeeMail($data, $link, $customer)); // Pass $link to the mail constructor
                $userid = User::create([
                    'email' => $data['email'],
                    'user_type' => 'employer',
                    'org_id' => $customer['id'],
                    'emp_invite_id' => $randomNumber,
                ]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Error sending invitation email.', 'error' => $e->getMessage()], 500);
            }
            return response()->json([
                'success' => true,
                'message' => 'Invitation sent successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error sending invitation email.', 'error' => $e->getMessage()], 500);
        }
    }

    public function listEmployees(Request $request)
    {
        $authuser = auth()->user()->id;
        $data = User::orderBy('id', 'desc')->where('org_id', $authuser)->where('user_type', 'employer')->get();
        return view('users.employee.listEmployees', compact('data'));
    }

    public function editEmployee($locale, $id)
    {
        $user = User::where('id', $id)->first();
        return view('users.employee.editEmployee', compact('user'));
    }

    public function updateEmployee(Request $request)
    {
        try {

            $user = User::where('id', $request->id)->first();
            $data = $request->all();

            if ($request->input('email') != $user->email) {
                $confirmed = $request->has('confirmed_email_update');
                if ($confirmed == '1') {
                    $customer = auth()->user();
                    $email = $data['email'];
                    $url = url(__('routes.employer-setPassword'));
                    $max = 16;
                    $randomNumber = Str::random($max);
                    $link = $url . '/' . $randomNumber;
                    try {

                        if ($request->hasFile('image')) {
                            $file = $request->file('image');
                            $filename = time() . '-' . $file->getClientOriginalName();
                            $destination = $user->id . '-profile' . $filename;
                            $path = Storage::disk('s3')->put($destination, file_get_contents($file));
                            $imageUrl = Storage::disk('s3')->url($destination);
                        } else {
                            $imageUrl = $user->image;
                        }
                        $user->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'contact_no' => $request->input('number'),
                            'salutation' => $request->salutation,
                            'company' => $request->company,
                            'address' => $request->address,
                            'zip_code' => $request->zip_code,
                            'place' => $request->place,
                            'vat_no' => $request->vat_no,
                            'site' => $request->site,
                            'thread' => $request->thread,
                            'emb_fileType' => $request->file_emb,
                            'vec_fileType' => $request->file_vect,
                            'thread_notes' => $request->thread_instruction,
                            'thread_cut_notes' => $request->thread_cut,
                            'needle_notes' => $request->needle_instruction,
                            'font_notes' => $request->font_instruction,
                            'special_notes' => $request->special_instruction,
                            'emp_invite_id' => $randomNumber,
                            'password' => '',
                            'image' => $imageUrl
                        ]);
                        Mail::to($email)->send(new inviteEmployeeMail($data, $link, $customer)); // Pass $link to the mail constructor

                        return back()->with('success', 'Profile is updated successfully and invitation mail sent to new employee !');
                    } catch (\Exception $e) {
                        return response()->json(['message' => 'Error sending invitation email.', 'error' => $e->getMessage()], 500);
                    }
                }
            } else {
                $address = $request->address;
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $filename = time() . '-' . $file->getClientOriginalName();
                    $destination = $user->id . '-profile' . $filename;
                    $path = Storage::disk('s3')->put($destination, file_get_contents($file));
                    $imageUrl = Storage::disk('s3')->url($destination);
                } else {
                    $imageUrl = $user->image;
                }
                $user->update([
                    'name' => $request->name,
                    'contact_no' => $request->input('number'),
                    'salutation' => $request->salutation,
                    'company' => $request->company,
                    'address' => $request->address,
                    'zip_code' => $request->zip_code,
                    'place' => $request->place,
                    'vat_no' => $request->vat_no,
                    'site' => $request->site,
                    'thread' => $request->thread,
                    'emb_fileType' => $request->file_emb,
                    'vec_fileType' => $request->file_vect,
                    'thread_notes' => $request->thread_instruction,
                    'thread_cut_notes' => $request->thread_cut,
                    'needle_notes' => $request->needle_instruction,
                    'font_notes' => $request->font_instruction,
                    'special_notes' => $request->special_instruction,
                    'image' => $imageUrl
                ]);
                return back()->with('success', 'Profile updated successfully!');
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteEmployee($locale, $id)
    {
        $delete = User::where('id', $id)->delete();
        if ($delete) {
            return response()->json([
                'success' => 'Successfully deleted'
            ]);
        } else {
            abort(422, 'Error deleting employee.');
        }
    }
    public function EmployeeProfile()
    {
        $authuser = auth()->user()->id;
        $user = User::where('id', $authuser)->first();
        return view('users.employee.employeeProile', compact('user'));
    }
}
