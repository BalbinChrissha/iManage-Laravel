<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class CustomAuthController extends Controller
{

    public function login(){
    return view("login");
    }


    public function index()
    {
        return view("login");
    }


    public function loginUser(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        
        
        $customMessages = [
    'required' => 'The :attribute field can not be blank',
    'email' => 'The :attribute field invalid format'
    ];


    $rules = [
        'username' => 'required',
        'password'=>'required|min:6',
        
    ];

    $this->validate($request, $rules, $customMessages);

    $admin = DB::table('admin')
    ->where('username', $username)
    ->where('password', $password)
    ->first();

    $sos = DB::table('supply_office_staff')
    ->where('staff_username', $username)
    ->where('staff_password', $password)
    ->first();


    $faculty = DB::table('faculty_incharge')
    ->where('faculty_username', $username)
    ->where('faculty_password', $password)
    ->first();

        if ($admin) {
            $request->session()->put('adminId', $admin->adminID);
            // User credentials are valid, proceed with login logic
            return redirect("adminDashboard");
        }else if($sos) {
            $request->session()->put('sosId', $sos->staffID);
            // User credentials are valid, proceed with login logic
            return redirect("sosDashboard");
        }else if($faculty) {
            $request->session()->put('facultyId', $faculty->facultyID);
            // User credentials are valid, proceed with login logic
            return redirect("facultyDashboard");
        }
        else {
            // User credentials are invalid, show error message or redirect
            return back()->with('fail', 'Invalid username or password');
        }

    }


    public function adminDashboard(){
        $data = array ();
        if(Session::has('adminId')){
            $data = DB::table('admin')
            ->where('adminID', '=', Session::get('adminId'))->first();
            // Get and store the admin name in the session

        $adminName = $data->admin_name;
        session(['adminName' => $adminName]);
        }

        $currentMonth = Carbon::now()->format('F');
        $currentYear = Carbon::now()->year;
        $sql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND month='January' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($sql1) > 0) {
            $sql1  = $sql1[0];
            $availablecount = $sql1->available_qty;
            $decomcount =  $sql1->unavailable1_qty;
            $repaircount =  $sql1->unavailable2_qty;
        } else {
            $availablecount = 0;
            $decomcount = 0;
            $repaircount = 0;
        }
        
        
        $sqlfeb1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND month='February' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
                
        if (count($sqlfeb1) > 0) {
            $sqlfeb1  = $sqlfeb1[0];
            $febavailablecount = $sqlfeb1->available_qty;
            $febdecomcount =  $sqlfeb1->unavailable1_qty;
            $febrepaircount = $sqlfeb1->unavailable2_qty;
        } else {
            $febavailablecount = 0;
            $febdecomcount = 0;
            $febrepaircount = 0;
        }
        
        
        $marchsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND month='March' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($marchsql1) > 0) {
            $marchsql1 = $marchsql1[0];
            $marchavailablecount = $marchsql1->available_qty;
            $marchdecomcount =  $marchsql1->unavailable1_qty;
            $marchrepaircount = $marchsql1->unavailable2_qty;
        } else {
            $marchavailablecount = 0;
            $marchdecomcount = 0;
            $marchrepaircount = 0;
        }
        
        
        $aprilsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND month='April' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($aprilsql1) > 0) {
            $aprilsql1 = $aprilsql1[0];
            $aprilavailablecount = $aprilsql1->available_qty;
            $aprildecomcount =  $aprilsql1->unavailable1_qty;
            $aprilrepaircount = $aprilsql1->unavailable2_qty;
        } else {
            $aprilavailablecount = 0;
            $aprildecomcount = 0;
            $aprilrepaircount = 0;
        }
        
        
        $maysql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND month='May' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($maysql1) > 0) {
            $maysql1 =  $maysql1[0];
            $mayavailablecount = $maysql1->available_qty;
            $maydecomcount =  $maysql1->unavailable1_qty;
            $mayrepaircount = $maysql1->unavailable2_qty;
        } else {
            $mayavailablecount = 0;
            $maydecomcount = 0;
            $mayrepaircount = 0;
        }
        
        
        $junesql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND month='June' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($junesql1) > 0) {
            $junesql1 = $junesql1[0];
            $juneavailablecount = $junesql1->available_qty;
            $junedecomcount = $junesql1->unavailable1_qty;
            $junerepaircount = $junesql1->unavailable2_qty;
        } else {
            $juneavailablecount = 0;
            $junedecomcount = 0;
            $junerepaircount = 0;
        }
        
        
        $julysql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND month='July' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($julysql1) > 0) {
            $julysql1 = $julysql1[0];
            $julyavailablecount = $julysql1->available_qty;
            $julydecomcount = $julysql1->unavailable1_qty;
            $julyrepaircount = $julysql1->unavailable2_qty;
        } else {
            $julyavailablecount = 0;
            $julydecomcount = 0;
            $julyrepaircount = 0;
        }
        
        $augsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND month='August' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($augsql1) > 0) {
            $augsql1 = $augsql1[0];
            $augavailablecount = $augsql1->available_qty;
            $augdecomcount = $augsql1->unavailable1_qty;
            $augrepaircount = $augsql1->unavailable2_qty;
        } else {
            $augavailablecount = 0;
            $augdecomcount = 0;
            $augrepaircount = 0;
        }
        
        $septsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND month='September' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($septsql1) > 0) {
            $septsql1 = $septsql1[0];
            $septavailablecount = $septsql1->available_qty;
            $septdecomcount = $septsql1->unavailable1_qty;
            $septrepaircount = $septsql1->unavailable2_qty;
        } else {
            $septavailablecount = 0;
            $septdecomcount = 0;
            $septrepaircount = 0;
        }
        
        
        $octsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND month='October' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($octsql1) > 0) {
            $octsql1 = $octsql1[0];
            $octavailablecount = $octsql1->available_qty;
            $octdecomcount = $octsql1->unavailable1_qty;
            $octrepaircount = $octsql1->unavailable2_qty;
        } else {
            $octavailablecount = 0;
            $octdecomcount = 0;
            $octrepaircount = 0;
        }
        
        
        $novsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND month='November' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($novsql1) > 0) {
            $novsql1 = $novsql1[0];
            $novavailablecount = $novsql1->available_qty;
            $novdecomcount = $novsql1->unavailable1_qty;
            $novrepaircount = $novsql1->unavailable2_qty;
        } else {
            $novavailablecount = 0;
            $novdecomcount = 0;
            $novrepaircount = 0;
        }
        
        $decsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND month='December' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($decsql1) > 0) {
            $decsql1 = $decsql1[0];
            $decavailablecount = $decsql1->available_qty;
            $decdecomcount = $decsql1->unavailable1_qty;
            $decrepaircount = $decsql1->unavailable2_qty;
        } else {
            $decavailablecount = 0;
            $decdecomcount = 0;
            $decrepaircount = 0;
        }
        
        ////////////////////////////////CATEGORY 2////////////////////////////////////
        
        $sql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND month='January' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($sql1) > 0) {
            $sql1  = $sql1[0];
            $availableC2 = $sql1->available_qty;
            $consumed =  $sql1->unavailable1_qty;
            $expired =  $sql1->unavailable2_qty;
        } else {
            $availableC2 = 0;
            $consumed = 0;
            $expired = 0;
        }
        
        
        $sqlfeb1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND month='February' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($sqlfeb1) > 0) {
            $sqlfeb1  = $sqlfeb1[0];
            $febavailableC2 = $sqlfeb1->available_qty;
            $febconsumed =  $sqlfeb1->unavailable1_qty;
            $febexpired = $sqlfeb1->unavailable2_qty;
        } else {
            $febavailableC2 = 0;
            $febconsumed = 0;
            $febexpired = 0;
        }
        
        
        $marchsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND month='March' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($marchsql1) > 0) {
            $marchsql1 = $marchsql1[0];
            $marchavailableC2 = $marchsql1->available_qty;
            $marchconsumed =  $marchsql1->unavailable1_qty;
            $marchexpired = $marchsql1->unavailable2_qty;
        } else {
            $marchavailableC2 = 0;
            $marchconsumed = 0;
            $marchexpired = 0;
        }
        
        
        $aprilsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND month='April' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($aprilsql1) > 0) {
            $aprilsql1 = $aprilsql1[0];
            $aprilavailableC2 = $aprilsql1->available_qty;
            $aprilconsumed =  $aprilsql1->unavailable1_qty;
            $aprilexpired = $aprilsql1->unavailable2_qty;
        } else {
            $aprilavailableC2 = 0;
            $aprilconsumed = 0;
            $aprilexpired = 0;
        }
        
        
        $maysql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND month='May' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($maysql1) > 0) {
            $maysql1 =  $maysql1[0];
            $mayavailableC2 = $maysql1->available_qty;
            $mayconsumed =  $maysql1->unavailable1_qty;
            $mayexpired = $maysql1->unavailable2_qty;
        } else {
            $mayavailableC2 = 0;
            $mayconsumed = 0;
            $mayexpired = 0;
        }
        
        
        $junesql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND month='June' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($junesql1) > 0) {
            $junesql1 = $junesql1[0];
            $juneavailableC2 = $junesql1->available_qty;
            $juneconsumed = $junesql1->unavailable1_qty;
            $juneexpired = $junesql1->unavailable2_qty;
        } else {
            $juneavailableC2 = 0;
            $juneconsumed = 0;
            $juneexpired = 0;
        }
        
        
        $julysql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND month='July' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($julysql1) > 0) {
            $julysql1 = $julysql1[0];
            $julyavailableC2 = $julysql1->available_qty;
            $julyconsumed = $julysql1->unavailable1_qty;
            $julyexpired = $julysql1->unavailable2_qty;
        } else {
            $julyavailableC2 = 0;
            $julyconsumed = 0;
            $julyexpired = 0;
        }
        
        $augsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND month='August' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($augsql1) > 0) {
            $augsql1 = $augsql1[0];
            $augavailableC2 = $augsql1->available_qty;
            $augconsumed = $augsql1->unavailable1_qty;
            $augexpired = $augsql1->unavailable2_qty;
        } else {
            $augavailableC2 = 0;
            $augconsumed = 0;
            $augexpired = 0;
        }
        
        $septsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND month='September' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($septsql1) > 0) {
            $septsql1 = $septsql1[0];
            $septavailableC2 = $septsql1->available_qty;
            $septconsumed = $septsql1->unavailable1_qty;
            $septexpired = $septsql1->unavailable2_qty;
        } else {
            $septavailableC2 = 0;
            $septconsumed = 0;
            $septexpired = 0;
        }
        
        
        $octsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND month='October' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($octsql1) > 0) {
            $octsql1 = $octsql1[0];
            $octavailableC2 = $octsql1->available_qty;
            $octconsumed = $octsql1->unavailable1_qty;
            $octexpired = $octsql1->unavailable2_qty;
        } else {
            $octavailableC2 = 0;
            $octconsumed = 0;
            $octexpired = 0;
        }
        
        
        $novsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND month='November' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($novsql1) > 0) {
            $novsql1 = $novsql1[0];
            $novavailableC2 = $novsql1->available_qty;
            $novconsumed = $novsql1->unavailable1_qty;
            $novexpired = $novsql1->unavailable2_qty;
        } else {
            $novavailableC2 = 0;
            $novconsumed = 0;
            $novexpired = 0;
        }
        
        $decsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND month='December' AND year =$currentYear GROUP BY category.categoryID, category_name, item_last_checked.month, item_last_checked.year");
        if (count($decsql1) > 0) {
            $decsql1 = $decsql1[0];
            $decavailableC2 = $decsql1->available_qty;
            $decconsumed = $decsql1->unavailable1_qty;
            $decexpired = $decsql1->unavailable2_qty;
        } else {
            $decavailableC2 = 0;
            $decconsumed = 0;
            $decexpired = 0;
        }
        
         $available = array($availablecount, $febavailablecount, $marchavailablecount, $aprilavailablecount, $mayavailablecount, $juneavailablecount, $julyavailablecount, $augavailablecount, $septavailablecount, $octavailablecount, $novavailablecount, $decavailablecount);
         $decommissioned = array($decomcount, $febdecomcount, $marchdecomcount, $aprildecomcount, $maydecomcount, $junedecomcount, $julydecomcount, $augdecomcount, $septdecomcount, $octdecomcount, $novdecomcount, $decdecomcount);
        $repair = array($repaircount, $febrepaircount, $marchrepaircount, $aprilrepaircount, $mayrepaircount, $junerepaircount, $julyrepaircount, $augrepaircount, $septrepaircount, $octrepaircount, $novrepaircount, $decrepaircount);

        
        $available2 = array($availableC2, $febavailableC2, $marchavailableC2, $aprilavailableC2, $mayavailableC2, $juneavailableC2, $julyavailableC2, $augavailableC2, $septavailableC2, $octavailableC2, $novavailableC2, $decavailableC2);
        $consumed = array($consumed, $febconsumed, $marchconsumed, $aprilconsumed, $mayconsumed, $juneconsumed, $julyconsumed, $augconsumed, $septconsumed, $octconsumed, $novconsumed, $decconsumed);
        $expired = array($expired, $febexpired, $marchexpired, $aprilexpired, $mayexpired, $juneexpired, $julyexpired, $augexpired, $septexpired, $octexpired, $novexpired, $decexpired);


        $totalfetch1 = DB::select("SELECT item.categoryID, category_name, sum(quantity) as totalqty FROM item, category, supply_office_staff WHERE category.categoryID = item.categoryID AND supply_office_staff.staffID=item.staffID AND category.categoryID= 1 GROUP BY category.categoryID, item.categoryID, category.category_name");
        if (count( $totalfetch1) > 0) {
            $totalfetch1 =  $totalfetch1[0];
            $totalqty1  =  $totalfetch1 -> totalqty;

        }else{
            $totalqty1 = 0;
        }


        $totaldata1 = DB::select("SELECT item.categoryID,  sum(qty_transferred) as totaltransfer FROM item, category, supply_office_staff, item_transfer WHERE item.itemid = item_transfer.itemID AND category.categoryID = item.categoryID AND supply_office_staff.staffID=item.staffID AND category.categoryID= 1 GROUP BY category.categoryID, item.categoryID");
        if (count( $totaldata1) > 0) {
            $totaldata1 = $totaldata1[0];
            $totaltransfer = $totaldata1 -> totaltransfer;

        }else{
            $totaltransfer = 0;
        }

        $remainder = $totalqty1 - $totaltransfer;





        $totalfetch2 = DB::select("SELECT item.categoryID, category_name, sum(quantity) as totalqty FROM item, category, supply_office_staff WHERE category.categoryID = item.categoryID AND supply_office_staff.staffID=item.staffID AND category.categoryID= 2  GROUP BY category.categoryID, item.categoryID,category.category_name");
        if (count( $totalfetch2) > 0) {
            $totalfetch2 =  $totalfetch2[0];
            $totalqty2  =  $totalfetch2 -> totalqty;
        }else{
            $totalqty2 = 0;
        }


        
        $totaldata2= DB::select("SELECT item.categoryID,  sum(qty_transferred) as totaltransfer FROM item, category, supply_office_staff, item_transfer WHERE item.itemid = item_transfer.itemID AND category.categoryID = item.categoryID AND supply_office_staff.staffID=item.staffID AND category.categoryID= 2 GROUP BY category.categoryID, item.categoryID");
        if (count( $totaldata2) > 0) {
            $totaldata2 = $totaldata2[0];
            $totaltransfer2 = $totaldata2 -> totaltransfer;

        }else{
            $totaltransfer2 = 0;
        }

        $remainder2 = $totalqty2 - $totaltransfer2;

        return view('admin.adminDashboard', ['adminId' => session('adminId'), 'data' => $data, 'available' => $available, 'decommissioned' => $decommissioned, 'repair'=>$repair, 'availableCat2' =>  $available2, 'consumed' =>  $consumed, 'expired' => $expired, 'remainder' => $remainder , 'totalqty1'=> $totalqty1 ,'totaltransfer' => $totaltransfer, 'remainder2' =>  $remainder2, 'totalqty2' => $totalqty2,'totaltransfer2'=> $totaltransfer2]);
   
   
    }


    public function sosDashboard(){
        $data = array ();
        if(Session::has('sosId')){
            $data = DB::table('supply_office_staff')
            ->where('staffID', '=', Session::get('sosId'))->first();
            $staffName = $data->staff_name;
            session(['staffName' => $staffName]);
        }

        $sosID =  Session::get('sosId');
        $currentMonth = Carbon::now()->format('F');
        $currentYear = Carbon::now()->year;
        $sql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND supply_office_staff.staffID =$sosID AND month='January' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($sql1) > 0) {
            $sql1  = $sql1[0];
            $availablecount = $sql1->available_qty;
            $decomcount =  $sql1->unavailable1_qty;
            $repaircount =  $sql1->unavailable2_qty;
        } else {
            $availablecount = 0;
            $decomcount = 0;
            $repaircount = 0;
        }
        
        
        $sqlfeb1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND supply_office_staff.staffID =$sosID AND month='February' AND year =$currentYear GROUP BY category.categoryID , category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        
        if (count($sqlfeb1) > 0) {
            $sqlfeb1  = $sqlfeb1[0];
            $febavailablecount = $sqlfeb1->available_qty;
            $febdecomcount =  $sqlfeb1->unavailable1_qty;
            $febrepaircount = $sqlfeb1->unavailable2_qty;
        } else {
            $febavailablecount = 0;
            $febdecomcount = 0;
            $febrepaircount = 0;
        }
        
        
        $marchsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND supply_office_staff.staffID =$sosID AND month='March' AND year =$currentYear GROUP BY category.categoryID , category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($marchsql1) > 0) {
            $marchsql1 = $marchsql1[0];
            $marchavailablecount = $marchsql1->available_qty;
            $marchdecomcount =  $marchsql1->unavailable1_qty;
            $marchrepaircount = $marchsql1->unavailable2_qty;
        } else {
            $marchavailablecount = 0;
            $marchdecomcount = 0;
            $marchrepaircount = 0;
        }
        
        
        $aprilsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND supply_office_staff.staffID =$sosID AND month='April' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($aprilsql1) > 0) {
            $aprilsql1 = $aprilsql1[0];
            $aprilavailablecount = $aprilsql1->available_qty;
            $aprildecomcount =  $aprilsql1->unavailable1_qty;
            $aprilrepaircount = $aprilsql1->unavailable2_qty;
        } else {
            $aprilavailablecount = 0;
            $aprildecomcount = 0;
            $aprilrepaircount = 0;
        }
        
        
        $maysql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND supply_office_staff.staffID =$sosID AND month='May' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($maysql1) > 0) {
            $maysql1 =  $maysql1[0];
            $mayavailablecount = $maysql1->available_qty;
            $maydecomcount =  $maysql1->unavailable1_qty;
            $mayrepaircount = $maysql1->unavailable2_qty;
        } else {
            $mayavailablecount = 0;
            $maydecomcount = 0;
            $mayrepaircount = 0;
        }
        
        
        $junesql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND supply_office_staff.staffID =$sosID AND month='June' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($junesql1) > 0) {
            $junesql1 = $junesql1[0];
            $juneavailablecount = $junesql1->available_qty;
            $junedecomcount = $junesql1->unavailable1_qty;
            $junerepaircount = $junesql1->unavailable2_qty;
        } else {
            $juneavailablecount = 0;
            $junedecomcount = 0;
            $junerepaircount = 0;
        }
        
        
        $julysql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND supply_office_staff.staffID =$sosID AND month='July' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($julysql1) > 0) {
            $julysql1 = $julysql1[0];
            $julyavailablecount = $julysql1->available_qty;
            $julydecomcount = $julysql1->unavailable1_qty;
            $julyrepaircount = $julysql1->unavailable2_qty;
        } else {
            $julyavailablecount = 0;
            $julydecomcount = 0;
            $julyrepaircount = 0;
        }
        
        $augsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND supply_office_staff.staffID =$sosID AND month='August' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($augsql1) > 0) {
            $augsql1 = $augsql1[0];
            $augavailablecount = $augsql1->available_qty;
            $augdecomcount = $augsql1->unavailable1_qty;
            $augrepaircount = $augsql1->unavailable2_qty;
        } else {
            $augavailablecount = 0;
            $augdecomcount = 0;
            $augrepaircount = 0;
        }
        
        $septsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND supply_office_staff.staffID =$sosID AND month='September' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($septsql1) > 0) {
            $septsql1 = $septsql1[0];
            $septavailablecount = $septsql1->available_qty;
            $septdecomcount = $septsql1->unavailable1_qty;
            $septrepaircount = $septsql1->unavailable2_qty;
        } else {
            $septavailablecount = 0;
            $septdecomcount = 0;
            $septrepaircount = 0;
        }
        
        
        $octsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND supply_office_staff.staffID =$sosID AND month='October' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($octsql1) > 0) {
            $octsql1 = $octsql1[0];
            $octavailablecount = $octsql1->available_qty;
            $octdecomcount = $octsql1->unavailable1_qty;
            $octrepaircount = $octsql1->unavailable2_qty;
        } else {
            $octavailablecount = 0;
            $octdecomcount = 0;
            $octrepaircount = 0;
        }
        
        
        $novsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND supply_office_staff.staffID =$sosID AND month='November' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($novsql1) > 0) {
            $novsql1 = $novsql1[0];
            $novavailablecount = $novsql1->available_qty;
            $novdecomcount = $novsql1->unavailable1_qty;
            $novrepaircount = $novsql1->unavailable2_qty;
        } else {
            $novavailablecount = 0;
            $novdecomcount = 0;
            $novrepaircount = 0;
        }
        
        $decsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 1 AND supply_office_staff.staffID =$sosID AND month='December' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($decsql1) > 0) {
            $decsql1 = $decsql1[0];
            $decavailablecount = $decsql1->available_qty;
            $decdecomcount = $decsql1->unavailable1_qty;
            $decrepaircount = $decsql1->unavailable2_qty;
        } else {
            $decavailablecount = 0;
            $decdecomcount = 0;
            $decrepaircount = 0;
        }
        
        ////////////////////////////////CATEGORY 2////////////////////////////////////
        
        $sql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND supply_office_staff.staffID =$sosID AND month='January' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($sql1) > 0) {
            $sql1  = $sql1[0];
            $availableC2 = $sql1->available_qty;
            $consumed =  $sql1->unavailable1_qty;
            $expired =  $sql1->unavailable2_qty;
        } else {
            $availableC2 = 0;
            $consumed = 0;
            $expired = 0;
        }
        
        
        $sqlfeb1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND supply_office_staff.staffID =$sosID AND month='February' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($sqlfeb1) > 0) {
            $sqlfeb1  = $sqlfeb1[0];
            $febavailableC2 = $sqlfeb1->available_qty;
            $febconsumed =  $sqlfeb1->unavailable1_qty;
            $febexpired = $sqlfeb1->unavailable2_qty;
        } else {
            $febavailableC2 = 0;
            $febconsumed = 0;
            $febexpired = 0;
        }
        
        
        $marchsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND supply_office_staff.staffID =$sosID AND month='March' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($marchsql1) > 0) {
            $marchsql1 = $marchsql1[0];
            $marchavailableC2 = $marchsql1->available_qty;
            $marchconsumed =  $marchsql1->unavailable1_qty;
            $marchexpired = $marchsql1->unavailable2_qty;
        } else {
            $marchavailableC2 = 0;
            $marchconsumed = 0;
            $marchexpired = 0;
        }
        
        
        $aprilsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND supply_office_staff.staffID =$sosID AND month='April' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($aprilsql1) > 0) {
            $aprilsql1 = $aprilsql1[0];
            $aprilavailableC2 = $aprilsql1->available_qty;
            $aprilconsumed =  $aprilsql1->unavailable1_qty;
            $aprilexpired = $aprilsql1->unavailable2_qty;
        } else {
            $aprilavailableC2 = 0;
            $aprilconsumed = 0;
            $aprilexpired = 0;
        }
        
        
        $maysql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND supply_office_staff.staffID =$sosID AND month='May' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($maysql1) > 0) {
            $maysql1 =  $maysql1[0];
            $mayavailableC2 = $maysql1->available_qty;
            $mayconsumed =  $maysql1->unavailable1_qty;
            $mayexpired = $maysql1->unavailable2_qty;
        } else {
            $mayavailableC2 = 0;
            $mayconsumed = 0;
            $mayexpired = 0;
        }
        
        
        $junesql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND supply_office_staff.staffID =$sosID AND month='June' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($junesql1) > 0) {
            $junesql1 = $junesql1[0];
            $juneavailableC2 = $junesql1->available_qty;
            $juneconsumed = $junesql1->unavailable1_qty;
            $juneexpired = $junesql1->unavailable2_qty;
        } else {
            $juneavailableC2 = 0;
            $juneconsumed = 0;
            $juneexpired = 0;
        }
        
        
        $julysql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND supply_office_staff.staffID =$sosID AND month='July' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($julysql1) > 0) {
            $julysql1 = $julysql1[0];
            $julyavailableC2 = $julysql1->available_qty;
            $julyconsumed = $julysql1->unavailable1_qty;
            $julyexpired = $julysql1->unavailable2_qty;
        } else {
            $julyavailableC2 = 0;
            $julyconsumed = 0;
            $julyexpired = 0;
        }
        
        $augsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND supply_office_staff.staffID =$sosID AND month='August' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($augsql1) > 0) {
            $augsql1 = $augsql1[0];
            $augavailableC2 = $augsql1->available_qty;
            $augconsumed = $augsql1->unavailable1_qty;
            $augexpired = $augsql1->unavailable2_qty;
        } else {
            $augavailableC2 = 0;
            $augconsumed = 0;
            $augexpired = 0;
        }
        
        $septsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND supply_office_staff.staffID =$sosID AND month='September' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($septsql1) > 0) {
            $septsql1 = $septsql1[0];
            $septavailableC2 = $septsql1->available_qty;
            $septconsumed = $septsql1->unavailable1_qty;
            $septexpired = $septsql1->unavailable2_qty;
        } else {
            $septavailableC2 = 0;
            $septconsumed = 0;
            $septexpired = 0;
        }
        
        
        $octsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND supply_office_staff.staffID =$sosID AND month='October' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($octsql1) > 0) {
            $octsql1 = $octsql1[0];
            $octavailableC2 = $octsql1->available_qty;
            $octconsumed = $octsql1->unavailable1_qty;
            $octexpired = $octsql1->unavailable2_qty;
        } else {
            $octavailableC2 = 0;
            $octconsumed = 0;
            $octexpired = 0;
        }
        
        
        $novsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND supply_office_staff.staffID =$sosID AND month='November' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($novsql1) > 0) {
            $novsql1 = $novsql1[0];
            $novavailableC2 = $novsql1->available_qty;
            $novconsumed = $novsql1->unavailable1_qty;
            $novexpired = $novsql1->unavailable2_qty;
        } else {
            $novavailableC2 = 0;
            $novconsumed = 0;
            $novexpired = 0;
        }
        
        $decsql1 = DB::select("SELECT category_name, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, supply_office_staff, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND supply_office_staff.staffID=item.staffID AND category.categoryID = 2 AND supply_office_staff.staffID =$sosID AND month='December' AND year =$currentYear GROUP BY category.categoryID, category.category_name, imanage.item_last_checked.month, imanage.item_last_checked.year");
        if (count($decsql1) > 0) {
            $decsql1 = $decsql1[0];
            $decavailableC2 = $decsql1->available_qty;
            $decconsumed = $decsql1->unavailable1_qty;
            $decexpired = $decsql1->unavailable2_qty;
        } else {
            $decavailableC2 = 0;
            $decconsumed = 0;
            $decexpired = 0;
        }
        
         $available = array($availablecount, $febavailablecount, $marchavailablecount, $aprilavailablecount, $mayavailablecount, $juneavailablecount, $julyavailablecount, $augavailablecount, $septavailablecount, $octavailablecount, $novavailablecount, $decavailablecount);
         $decommissioned = array($decomcount, $febdecomcount, $marchdecomcount, $aprildecomcount, $maydecomcount, $junedecomcount, $julydecomcount, $augdecomcount, $septdecomcount, $octdecomcount, $novdecomcount, $decdecomcount);
        $repair = array($repaircount, $febrepaircount, $marchrepaircount, $aprilrepaircount, $mayrepaircount, $junerepaircount, $julyrepaircount, $augrepaircount, $septrepaircount, $octrepaircount, $novrepaircount, $decrepaircount);

        
        $available2 = array($availableC2, $febavailableC2, $marchavailableC2, $aprilavailableC2, $mayavailableC2, $juneavailableC2, $julyavailableC2, $augavailableC2, $septavailableC2, $octavailableC2, $novavailableC2, $decavailableC2);
        $consumed = array($consumed, $febconsumed, $marchconsumed, $aprilconsumed, $mayconsumed, $juneconsumed, $julyconsumed, $augconsumed, $septconsumed, $octconsumed, $novconsumed, $decconsumed);
        $expired = array($expired, $febexpired, $marchexpired, $aprilexpired, $mayexpired, $juneexpired, $julyexpired, $augexpired, $septexpired, $octexpired, $novexpired, $decexpired);


        $totalfetch1 = DB::select("SELECT item.categoryID, category_name, sum(quantity) as totalqty FROM item, category, supply_office_staff WHERE category.categoryID = item.categoryID AND supply_office_staff.staffID=item.staffID AND category.categoryID= 1 AND supply_office_staff.staffID = $sosID GROUP BY category.categoryID, item.categoryID, category.category_name");
        if (count( $totalfetch1) > 0) {
            $totalfetch1 =  $totalfetch1[0];
            $totalqty1  =  $totalfetch1 -> totalqty;

        }else{
            $totalqty1 = 0;
        }


        $totaldata1 = DB::select("SELECT item.categoryID,  sum(qty_transferred) as totaltransfer FROM item, category, supply_office_staff, item_transfer WHERE item.itemid = item_transfer.itemID AND category.categoryID = item.categoryID AND supply_office_staff.staffID=item.staffID AND category.categoryID= 1 AND supply_office_staff.staffID = $sosID GROUP BY category.categoryID, item.categoryID");
        if (count( $totaldata1) > 0) {
            $totaldata1 = $totaldata1[0];
            $totaltransfer = $totaldata1 -> totaltransfer;

        }else{
            $totaltransfer = 0;
        }

        $remainder = $totalqty1 - $totaltransfer;





        $totalfetch2 = DB::select("SELECT item.categoryID, category_name, sum(quantity) as totalqty FROM item, category, supply_office_staff WHERE category.categoryID = item.categoryID AND supply_office_staff.staffID=item.staffID AND category.categoryID= 2 AND supply_office_staff.staffID = $sosID GROUP BY category.categoryID, item.categoryID,category.category_name");
        if (count( $totalfetch2) > 0) {
            $totalfetch2 =  $totalfetch2[0];
            $totalqty2  =  $totalfetch2 -> totalqty;
        }else{
            $totalqty2 = 0;
        }


        
        $totaldata2= DB::select("SELECT item.categoryID,  sum(qty_transferred) as totaltransfer FROM item, category, supply_office_staff, item_transfer WHERE item.itemid = item_transfer.itemID AND category.categoryID = item.categoryID AND supply_office_staff.staffID=item.staffID AND category.categoryID= 2 AND supply_office_staff.staffID = $sosID GROUP BY category.categoryID, item.categoryID");
        if (count( $totaldata2) > 0) {
            $totaldata2 = $totaldata2[0];
            $totaltransfer2 = $totaldata2 -> totaltransfer;

        }else{
            $totaltransfer2 = 0;
        }

        $remainder2 = $totalqty2 - $totaltransfer2;
        


        return view('staff.staffDashboard', ['sosId' => session('sosId'), 'data' => $data, 'available' => $available, 'decommissioned' => $decommissioned, 'repair'=>$repair, 'availableCat2' =>  $available2, 'consumed' =>  $consumed, 'expired' => $expired, 'remainder' => $remainder , 'totalqty1'=> $totalqty1 ,'totaltransfer' => $totaltransfer, 'remainder2' =>  $remainder2, 'totalqty2' => $totalqty2,'totaltransfer2'=> $totaltransfer2]);
    }

    public function facultyDashboard(){
        $data = array ();
        if(Session::has('facultyId')){
            $data = DB::table('faculty_incharge')
            ->where('facultyID', '=', Session::get('facultyId'))->first();
            $facultyName = $data->faculty_name;
            session(['facultyName' => $facultyName]);
        }
        $facultyId =  Session::get('facultyId');
        $records = DB::select('select recordno, category_name, item.itemid, item_name, item_desc, dep_name,  room_no, date_transferred, qty_transferred, category.categoryID FROM item, category, faculty_incharge, item_transfer, department WHERE item.itemid=item_transfer.itemID AND category.categoryID=item.categoryID AND faculty_incharge.facultyID=item_transfer.facultyID AND department.departmentno=faculty_incharge.departmentno AND faculty_incharge.staffID = item.staffID AND faculty_incharge.facultyID =?', [$facultyId]);

      //  dd(session()->all()); 
      return view('faculty.facultyDashboard', ['facultyId' => session('facultyId'), 'data' => $data, 'records' =>$records]);
    //return view('faculty.facultyDashboard', compact('data'));
    }


    public function logout(){
        if(Session::has('adminId')){
           Session::pull('adminId');
        }else if(Session::has('sosId')){
            Session::pull('sosId');
        }else if(Session::has('facultyId')){
            Session::pull('facultyId');
        }
        return redirect('login');
    }


}
