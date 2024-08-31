<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Carbon\Carbon;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function faculty_Dashboard()
    {
        $facultyId = Session::get('facultyId');
        $records = DB::select('select recordno, category_name, item.itemid, item_name, item_desc, dep_name,  room_no, date_transferred, qty_transferred, category.categoryID FROM item, category, faculty_incharge, item_transfer, department WHERE item.itemid=item_transfer.itemID AND category.categoryID=item.categoryID AND faculty_incharge.facultyID=item_transfer.facultyID AND department.departmentno=faculty_incharge.departmentno AND faculty_incharge.staffID = item.staffID AND faculty_incharge.facultyID =?', [$facultyId]);
        return view('faculty.facultyDashboard', ['records' => $records]);
    }


    public function monthlyReport()
    {
        $facultyId = Session::get('facultyId');
        $currentMonth = Carbon::now()->format('F');
        $currentYear = Carbon::now()->year;

        $month = mb_strtoupper($currentMonth);

        $records = DB::select('select recordno, category_name, item.itemid, item_name, item_desc, dep_name,  room_no, date_transferred, qty_transferred, category.categoryID FROM item, category, faculty_incharge, item_transfer, department WHERE item.itemid=item_transfer.itemID AND category.categoryID=item.categoryID AND faculty_incharge.facultyID=item_transfer.facultyID AND department.departmentno=faculty_incharge.departmentno AND faculty_incharge.staffID = item.staffID AND faculty_incharge.facultyID =?', [$facultyId]);
        $equipments = DB::select('SELECT item_transfer.recordno, item_state.checkedID, stateID, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty,month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND facultyID = ? AND category.categoryID = 1 AND month=? AND year =? ORDER BY item_state.recordno', [$facultyId, $currentMonth, $currentYear]);
        $supplies = DB::select('SELECT item_transfer.recordno, item_state.checkedID, stateID, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty,month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND facultyID = ? AND category.categoryID = 2 AND month=? AND year =? ORDER BY item_state.recordno', [$facultyId, $currentMonth, $currentYear]);
        return view('faculty.monthlyReport', ['records' => $records, 'equipments' => $equipments, 'supplies' => $supplies, 'month' => $month, 'year' => $currentYear]);
    }


    public function addMonthlyReport($id, $categoryId)
    {
        $item = DB::select('select item_name, item_transfer.itemID, qty_transferred from item, item_transfer where item.itemid=item_transfer.itemID AND recordno=?', [$id]);
        $item = $item[0];
        $name = $item->item_name;
        $itemID = $item->itemID;
        $qty_transferred = $item->qty_transferred;

        if ($categoryId == 1) {
            return view('faculty.equipmentMReport', ['name' =>  $name, 'itemID' => $itemID, 'qty_transferred' => $qty_transferred, 'recordno' => $id]);
        } else {
            return view('faculty.supplyMReport', ['name' =>  $name, 'itemID' => $itemID, 'qty_transferred' => $qty_transferred, 'recordno' => $id]);
        }
        //return view('admin.adminDashboard');
    }


    public function updateInventoryState(Request $request, $recordno)
    {

        $qty_transferred =  $request->input('qty_transferred');
        $available_qty =  $request->input('available_qty');
        $unavailable1_qty = $request->input('unavailable1_qty');
        $unavailable2_qty = $request->input('unavailable2_qty');
        $month       = $request->input('month');
        $year      =  $request->input('year');


        $customMessages = [
            'required' => 'The :attribute field can not be blank',
            'email' => 'The :attribute field invalid format',
        ];


        $rules = [
            'qty_transferred' => 'required',
            'available_qty' => 'required',
            'unavailable1_qty' => 'required',
            'unavailable2_qty' => 'required',
            'month' => 'required',
            'year' => 'required',

        ];
        $this->validate($request, $rules, $customMessages);

        $item = DB::select('SELECT recordno, item_last_checked.checkedID, month, year FROM item_state, item_last_checked WHERE recordno =? AND item_last_checked.checkedID = item_state.checkedID AND month =?  AND year=?', [$recordno, $month, $year]);
        if (count($item) == 0) {
            $total = $available_qty + $unavailable1_qty + $unavailable2_qty;
            if (($total > $qty_transferred) || ($total < $qty_transferred)) {
                return redirect()->back()->withErrors(["The record for the of $month should not be less than or exceed the transferred quantity"]);
            } else if ($total == $qty_transferred) {
                $insert = DB::insert('insert into  item_last_checked (month, year) values (?, ?)', [$month, $year]);
                $getnum = DB::select('SELECT max(checkedID) as maxid FROM item_last_checked');
                $getnum = $getnum[0];
                $maxcheckID = $getnum->maxid;
                $state = DB::insert('INSERT INTO item_state (recordno, checkedID, available_qty, unavailable1_qty, unavailable2_qty) values (?, ?, ?, ?, ?)', [$recordno, $maxcheckID, $available_qty, $unavailable1_qty, $unavailable2_qty]);
                return redirect()->route('faculty.monthlyReport');
            }
        } else {
            return redirect()->back()->withErrors(["There is already a record of the Item for the month of $month year of $year!"]);
        }

        // $update = DB::update('update faculty_incharge set departmentno = ?, faculty_name = ?, faculty_username = ?, faculty_password = ?, room_no = ? , room_name = ? where facultyID = ?', [$depno, $name, $username, $password, $roomno, $roomname, $id]);
        // if ($update) {
        //     return redirect()->route('staff.manageFaculty');
        // }
    }


    public function deleleteInventoryState($stateID, $checkedID)
    {
        $state = DB::select('select * from item_state where stateID=?', [$stateID]);
        if (count($state) > 0) {


            $admins = DB::delete('delete from item_state where stateID=?', [$stateID]);
            if ($admins) {
                $admins = DB::delete('delete from item_last_checked where checkedID=?', [$checkedID]);
                return redirect()->route('faculty.monthlyReport');
            }
        } else {
            return redirect()->back()->withErrors(["Office Staff ID Not Found!', 'The Record  is already deleted (from the database) or could not be found in the database"]);
        }
    }

    public function  editInventoryState($stateID, $checkedID, $categoryID)
    {

        $state = DB::select('select * from item_state where stateID=?', [$stateID]);
        if (count($state) > 0) {


            $state = DB::select('SELECT item_transfer.recordno, item_last_checked.checkedID, item.itemid, item_name, qty_transferred, month, year, available_qty, unavailable1_qty, unavailable2_qty FROM item, item_transfer, item_state, item_last_checked WHERE item.itemid = item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID=item_last_checked.checkedID AND stateID =?', [$stateID]);
            $state  = $state[0];

            $recordno = $state->recordno;
            $itemid = $state->itemid;
            $item_name = $state->item_name;
            $qty_transferred = $state->qty_transferred;
            $month = $state->month;
            $year = $state->year;
            $available_qty = $state->available_qty;
            $unavailable1_qty = $state->unavailable1_qty;
            $unavailable2_qty = $state->unavailable2_qty;
            if ($categoryID == 1) {
                return view('faculty.updateEquipMReport', ['recordno' => $recordno, 'itemid' => $itemid, 'item_name' => $item_name, 'qty_transferred' => $qty_transferred, 'month' => $month, 'year' => $year, 'available_qty' => $available_qty, 'unavailable1_qty' => $unavailable1_qty, 'unavailable2_qty' => $unavailable2_qty, 'stateID' => $stateID, 'checkedID' => $checkedID,]);
            } else {
                return view('faculty.updateSuppMReport', ['recordno' => $recordno, 'itemid' => $itemid, 'item_name' => $item_name, 'qty_transferred' => $qty_transferred, 'month' => $month, 'year' => $year, 'available_qty' => $available_qty, 'unavailable1_qty' => $unavailable1_qty, 'unavailable2_qty' => $unavailable2_qty, 'stateID' => $stateID, 'checkedID' => $checkedID]);
            }
        } else {
            return redirect()->back()->withErrors(["The record is not found!', 'The Record is already deleted (from the database) or could not be found in the database"]);
        }
    }


    public function updateInventoryStateReport(Request $request, $stateID, $checkedID, $recordno)
    {

        $qty_transferred =  $request->input('qty_transferred');
        $available_qty =  $request->input('available_qty');
        $unavailable1_qty = $request->input('unavailable1_qty');
        $unavailable2_qty = $request->input('unavailable2_qty');
        $month       = $request->input('month');
        $year      =  $request->input('year');


        $customMessages = [
            'required' => 'The :attribute field can not be blank',
            'email' => 'The :attribute field invalid format',
        ];


        $rules = [

            'available_qty' => 'required',
            'unavailable1_qty' => 'required',
            'unavailable2_qty' => 'required',
        ];
        $this->validate($request, $rules, $customMessages);

        $total = $available_qty + $unavailable1_qty + $unavailable2_qty;
        if (($total > $qty_transferred) || ($total < $qty_transferred)) {
            return redirect()->back()->withErrors(["The record for the of $month should not be less than or exceed the transferred quantity"]);
        } else if ($total == $qty_transferred) {
            $update = DB::update('UPDATE item_state set available_qty = ? , unavailable1_qty = ?,  unavailable2_qty = ?  WHERE  stateID=?', [$available_qty,  $unavailable1_qty, $unavailable2_qty, $stateID]);
            if ($update) {
                return redirect()->route('faculty.monthlyReport');
            }
        }
    }


    /***************************************CHARTS*************************************************/


    public function  viewDatachart($recordno, $categoryID)
    {
        $currentYear = Carbon::now()->year;
        $facultyId = Session::get('facultyId');


        $currentMonth = Carbon::now()->format('F');

        $total = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
        FROM item, category, item_transfer, item_last_checked, item_state 
        WHERE category.categoryID = item.categoryID 
            AND item.itemid = item_transfer.itemID 
            AND item_transfer.recordno = item_state.recordno 
            AND item_state.checkedID = item_last_checked.checkedID  
            AND item_transfer.recordno = ? 
            AND facultyID = ? 
            AND month = ? 
            AND year = ? 
        GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
        ORDER BY item_state.recordno', [$recordno, $facultyId, $currentMonth, $currentYear]);
        if (count($total) > 0) {
            $total  =  $total[0];
            $Cavailablecount =  $total->available_qty;
            $Cdecomcount =   $total->unavailable1_qty;
            $Crepaircount =   $total->unavailable2_qty;
        } else {
            $Cavailablecount = 0;
            $Cdecomcount = 0;
            $Crepaircount = 0;
        }




        // $state = DB::select('SELECT item_transfer.recordno, qty_transferred, item.itemid, item_name, category_name FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_transfer.recordno =? AND facultyID = ? GROUP BY item_transfer.recordno ORDER BY item_state.recordno', [$recordno, $facultyId]);
        $state = DB::select('SELECT item_transfer.recordno, qty_transferred, item.itemid, item_name, category_name 
       FROM item, category, item_transfer, item_last_checked, item_state 
       WHERE category.categoryID = item.categoryID 
           AND item.itemid = item_transfer.itemID 
           AND item_transfer.recordno = item_state.recordno 
           AND item_transfer.recordno = ? 
           AND facultyID = ? 
       GROUP BY item_transfer.recordno, qty_transferred, item.itemid, item_name, category_name 
       ORDER BY item_state.recordno', [$recordno, $facultyId]);

        if (count($state) > 0) {
            $state  = $state[0];
            $item_name = $state->item_name;
            $qty_transferred = $state->qty_transferred;


            $currentYear = Carbon::now()->year;
            //january
            $sql1 = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            FROM item, category, item_transfer, item_last_checked, item_state 
            WHERE category.categoryID = item.categoryID 
                AND item.itemid = item_transfer.itemID 
                AND item_transfer.recordno = item_state.recordno 
                AND item_state.checkedID = item_last_checked.checkedID  
                AND item_transfer.recordno = ? 
                AND facultyID = ? 
                AND month = "January" 
                AND year = ? 
            GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            ORDER BY item_state.recordno', [$recordno, $facultyId, $currentYear]);
            //  $sql1 = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty,month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND item_transfer.recordno =? AND facultyID = ? AND month="January" AND year =? GROUP BY item_transfer.recordno ORDER BY item_state.recordno', [$recordno, $facultyId, $currentYear]);
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


            $sqlfeb1 = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            FROM item, category, item_transfer, item_last_checked, item_state 
            WHERE category.categoryID = item.categoryID 
                AND item.itemid = item_transfer.itemID 
                AND item_transfer.recordno = item_state.recordno 
                AND item_state.checkedID = item_last_checked.checkedID  
                AND item_transfer.recordno = ? 
                AND facultyID = ? 
                AND month = "February" 
                AND year = ? 
            GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            ORDER BY item_state.recordno', [$recordno, $facultyId, $currentYear]);

            // $sqlfeb1 = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty,month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND item_transfer.recordno =? AND facultyID = ? AND month="February" AND year =? GROUP BY item_transfer.recordno ORDER BY item_state.recordno', [$recordno, $facultyId, $currentYear]);
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


            $marchsql1 = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            FROM item, category, item_transfer, item_last_checked, item_state 
            WHERE category.categoryID = item.categoryID 
                AND item.itemid = item_transfer.itemID 
                AND item_transfer.recordno = item_state.recordno 
                AND item_state.checkedID = item_last_checked.checkedID  
                AND item_transfer.recordno = ? 
                AND facultyID = ? 
                AND month = "March" 
                AND year = ? 
            GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            ORDER BY item_state.recordno', [$recordno, $facultyId, $currentYear]);
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


            $aprilsql1 = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            FROM item, category, item_transfer, item_last_checked, item_state 
            WHERE category.categoryID = item.categoryID 
                AND item.itemid = item_transfer.itemID 
                AND item_transfer.recordno = item_state.recordno 
                AND item_state.checkedID = item_last_checked.checkedID  
                AND item_transfer.recordno = ? 
                AND facultyID = ? 
                AND month = "April" 
                AND year = ? 
            GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            ORDER BY item_state.recordno', [$recordno, $facultyId, $currentYear]);
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


            $maysql1 = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            FROM item, category, item_transfer, item_last_checked, item_state 
            WHERE category.categoryID = item.categoryID 
                AND item.itemid = item_transfer.itemID 
                AND item_transfer.recordno = item_state.recordno 
                AND item_state.checkedID = item_last_checked.checkedID  
                AND item_transfer.recordno = ? 
                AND facultyID = ? 
                AND month = "May" 
                AND year = ? 
            GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            ORDER BY item_state.recordno', [$recordno, $facultyId, $currentYear]);
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


            $junesql1 = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            FROM item, category, item_transfer, item_last_checked, item_state 
            WHERE category.categoryID = item.categoryID 
                AND item.itemid = item_transfer.itemID 
                AND item_transfer.recordno = item_state.recordno 
                AND item_state.checkedID = item_last_checked.checkedID  
                AND item_transfer.recordno = ? 
                AND facultyID = ? 
                AND month = "June" 
                AND year = ? 
            GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            ORDER BY item_state.recordno', [$recordno, $facultyId, $currentYear]);
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


            $julysql1 = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            FROM item, category, item_transfer, item_last_checked, item_state 
            WHERE category.categoryID = item.categoryID 
                AND item.itemid = item_transfer.itemID 
                AND item_transfer.recordno = item_state.recordno 
                AND item_state.checkedID = item_last_checked.checkedID  
                AND item_transfer.recordno = ? 
                AND facultyID = ? 
                AND month = "July" 
                AND year = ? 
            GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            ORDER BY item_state.recordno', [$recordno, $facultyId, $currentYear]);
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

            $augsql1 = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            FROM item, category, item_transfer, item_last_checked, item_state 
            WHERE category.categoryID = item.categoryID 
                AND item.itemid = item_transfer.itemID 
                AND item_transfer.recordno = item_state.recordno 
                AND item_state.checkedID = item_last_checked.checkedID  
                AND item_transfer.recordno = ? 
                AND facultyID = ? 
                AND month = "August" 
                AND year = ? 
            GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            ORDER BY item_state.recordno', [$recordno, $facultyId, $currentYear]);
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

            $septsql1 = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            FROM item, category, item_transfer, item_last_checked, item_state 
            WHERE category.categoryID = item.categoryID 
                AND item.itemid = item_transfer.itemID 
                AND item_transfer.recordno = item_state.recordno 
                AND item_state.checkedID = item_last_checked.checkedID  
                AND item_transfer.recordno = ? 
                AND facultyID = ? 
                AND month = "September" 
                AND year = ? 
            GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            ORDER BY item_state.recordno', [$recordno, $facultyId, $currentYear]);
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


            $octsql1 = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            FROM item, category, item_transfer, item_last_checked, item_state 
            WHERE category.categoryID = item.categoryID 
                AND item.itemid = item_transfer.itemID 
                AND item_transfer.recordno = item_state.recordno 
                AND item_state.checkedID = item_last_checked.checkedID  
                AND item_transfer.recordno = ? 
                AND facultyID = ? 
                AND month = "October" 
                AND year = ? 
            GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            ORDER BY item_state.recordno', [$recordno, $facultyId, $currentYear]);
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


            $novsql1 = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            FROM item, category, item_transfer, item_last_checked, item_state 
            WHERE category.categoryID = item.categoryID 
                AND item.itemid = item_transfer.itemID 
                AND item_transfer.recordno = item_state.recordno 
                AND item_state.checkedID = item_last_checked.checkedID  
                AND item_transfer.recordno = ? 
                AND facultyID = ? 
                AND month = "November" 
                AND year = ? 
            GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            ORDER BY item_state.recordno', [$recordno, $facultyId, $currentYear]);
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

            $decsql1 = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            FROM item, category, item_transfer, item_last_checked, item_state 
            WHERE category.categoryID = item.categoryID 
                AND item.itemid = item_transfer.itemID 
                AND item_transfer.recordno = item_state.recordno 
                AND item_state.checkedID = item_last_checked.checkedID  
                AND item_transfer.recordno = ? 
                AND facultyID = ? 
                AND month = "December" 
                AND year = ? 
            GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
            ORDER BY item_state.recordno', [$recordno, $facultyId, $currentYear]);
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


            $availble = array($availablecount, $febavailablecount, $marchavailablecount, $aprilavailablecount, $mayavailablecount, $juneavailablecount, $julyavailablecount, $augavailablecount, $septavailablecount, $octavailablecount, $novavailablecount, $decavailablecount);
            $decommissioned = array($decomcount, $febdecomcount, $marchdecomcount, $aprildecomcount, $maydecomcount, $junedecomcount, $julydecomcount, $augdecomcount, $septdecomcount, $octdecomcount, $novdecomcount, $decdecomcount);
            $repair = array($repaircount, $febrepaircount, $marchrepaircount, $aprilrepaircount, $mayrepaircount, $junerepaircount, $julyrepaircount, $augrepaircount, $septrepaircount, $octrepaircount, $novrepaircount, $decrepaircount);


            $item_name = $state->item_name;
            $qty_transferred = $state->qty_transferred;

            if ($categoryID == 1) {
                return view('faculty.viewEquipDataChart', ['recordno' => $recordno, 'year' => $currentYear, 'month' => $currentMonth, 'item_name' => $item_name, 'qty_transferred' => $qty_transferred, 'available' => $availble, 'decommissioned' => $decommissioned, 'repair' => $repair, 'Cavailablecount' => $Cavailablecount, 'Cdecomcount' => $Cdecomcount, 'Crepaircount' => $Crepaircount]);
            } else {
                return view('faculty.viewSuppDataChart', ['recordno' => $recordno, 'year' => $currentYear, 'month' => $currentMonth, 'item_name' => $item_name, 'qty_transferred' => $qty_transferred, 'available' => $availble, 'decommissioned' => $decommissioned, 'repair' => $repair, 'Cavailablecount' => $Cavailablecount, 'Cdecomcount' => $Cdecomcount, 'Crepaircount' => $Crepaircount]);
            }
        } else {
            return redirect()->route('faculty.facultyDasboard');
        }
    }


    public function itemMonthlyChart(Request $request)
    {
        $dropdown = $request->input('dropdown');
        $year = $request->input('year');
        $facultyID = $request->input('facultyID');
        $recordno = $request->input('recordID');

        $facultyId = Session::get('facultyId');


        $total = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
        FROM item, category, item_transfer, item_last_checked, item_state 
        WHERE category.categoryID = item.categoryID 
            AND item.itemid = item_transfer.itemID 
            AND item_transfer.recordno = item_state.recordno 
            AND item_state.checkedID = item_last_checked.checkedID  
            AND item_transfer.recordno = ? 
            AND facultyID = ? 
            AND month = ? 
            AND year = ? 
        GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
        ORDER BY item_state.recordno', [$recordno, $facultyId, $dropdown, $year ]);
        if (count($total) > 0) {
            $total  =  $total[0];
            $availablecount =  $total->available_qty;
            $decomcount =   $total->unavailable1_qty;
            $repaircount =   $total->unavailable2_qty;
        } else {
            $availablecount = 0;
            $decomcount = 0;
            $repaircount = 0;
        }


        
      return view('filter.item_monthly_chart', compact('availablecount', 'decomcount', 'repaircount'));
    }



    public function itemMonthlyChart2(Request $request)
    {
        $dropdown = $request->input('dropdown');
        $year = $request->input('year');
        $facultyID = $request->input('facultyID');
        $recordno = $request->input('recordID');

        $facultyId = Session::get('facultyId');


        $total = DB::select('SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
        FROM item, category, item_transfer, item_last_checked, item_state 
        WHERE category.categoryID = item.categoryID 
            AND item.itemid = item_transfer.itemID 
            AND item_transfer.recordno = item_state.recordno 
            AND item_state.checkedID = item_last_checked.checkedID  
            AND item_transfer.recordno = ? 
            AND facultyID = ? 
            AND month = ? 
            AND year = ? 
        GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year 
        ORDER BY item_state.recordno', [$recordno, $facultyId, $dropdown, $year ]);
        if (count($total) > 0) {
            $total  =  $total[0];
            $availablecount =  $total->available_qty;
            $decomcount =   $total->unavailable1_qty;
            $repaircount =   $total->unavailable2_qty;
        } else {
            $availablecount = 0;
            $decomcount = 0;
            $repaircount = 0;
        }

      return view('filter.item_monthly_chart2', compact('availablecount', 'decomcount', 'repaircount'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
