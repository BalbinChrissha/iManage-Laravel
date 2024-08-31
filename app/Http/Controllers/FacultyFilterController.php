<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FacultyFilterController extends Controller
{

    public function facultyFilterInventory()
    {
        $facultyId = Session::get('facultyId');
        $currentMonth = Carbon::now()->format('F');
        $currentYear = Carbon::now()->year;


        $records = DB::select('SELECT item_transfer.recordno, item_state.checkedID, stateID, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty,month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND facultyID = ? AND category.categoryID = 1 AND month=? AND year =? ORDER BY item_state.recordno', [$facultyId, $currentMonth, $currentYear]);
        return view('faculty.filterInventory', ['records' => $records,  'month' => $currentMonth, 'year' => $currentYear]);
    }

    public function changeDropdown(Request $request)
    {
        $dropdown = $request->input('dropdown');

        return view('filter.changeDropdown', ['dropdown' => $dropdown]);
    }


    public function facFilterItem(Request $request)
    {
        $dropdown = $request->input('dropdown');
        $category = $request->input('category');
        $state  = $request->input('state');
        $year = $request->input('year');
        $facultyID = $request->input('facultyID');


        $cate = 0;
        $query = "";


        if ($category == "Equipment") {
            $cate = 1;
            if ($state == "Available") {
                $query = "available_qty";
            } else if ($state == "Unavailable - Decomissioned") {
                $query = "unavailable1_qty";
            } else if ($state == "Unavailable - In repair") {
                $query = "unavailable2_qty";
            }
        } else {
            $cate = 2;
            if ($state == "Available") {
                $query = "available_qty";
            } else if ($state == "Consumed") {
                $query = "unavailable1_qty";
            } else if ($state == "Expired") {
                $query = "unavailable2_qty";
            }
        }


        $records = DB::select("SELECT item_transfer.recordno, item_state.checkedID, stateID, item.itemid, item_name, category_name, $query as mema,month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND facultyID =? AND category.categoryID =? AND month=? AND year = ? ORDER BY item_state.recordno", [$facultyID, $cate, $dropdown, $year]);
        return view('filter.fac_filter_item', ['records' => $records, 'state' => $state]);
    }


    public function facultyReport()
    {
        $currentYear = Carbon::now()->year;
        $facultyID = Session::get('facultyId');




        $totalfetch1 = DB::select("select category.categoryID, sum(qty_transferred) as totaltrans FROM item, category, faculty_incharge, item_transfer WHERE item.itemid=item_transfer.itemID AND category.categoryID=item.categoryID AND faculty_incharge.facultyID=item_transfer.facultyID AND faculty_incharge.staffID = item.staffID AND faculty_incharge.facultyID=$facultyID AND category.categoryID=1 GROUP BY category.categoryID");
        if (count($totalfetch1) > 0) {
            $totalfetch1 =  $totalfetch1[0];
            $totalqty1  =  $totalfetch1->totaltrans;
        } else {
            $totalqty1 = 0;
        }


        $totalfetch2 = DB::select("select category.categoryID, sum(qty_transferred) as totaltrans FROM item, category, faculty_incharge, item_transfer WHERE item.itemid=item_transfer.itemID AND category.categoryID=item.categoryID AND faculty_incharge.facultyID=item_transfer.facultyID AND faculty_incharge.staffID = item.staffID AND faculty_incharge.facultyID=$facultyID AND category.categoryID=2 GROUP BY category.categoryID");
        if (count($totalfetch2) > 0) {
            $totalfetch2 =  $totalfetch2[0];
            $totalqty2  =  $totalfetch2->totaltrans;
        } else {
            $totalqty2 = 0;
        }



        $sql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='January' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $sqlfeb1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='February' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");

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


        $marchsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='March' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $aprilsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='April' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $maysql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='May' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $junesql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='June' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $julysql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='July' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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

        $augsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='August' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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

        $septsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='September' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $octsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='October' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $novsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='November' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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

        $decsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='December' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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

        $sql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='January' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $sqlfeb1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='February' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");

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


        $marchsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='March' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $aprilsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='April' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $maysql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='May' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $junesql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='June' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $julysql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='July' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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

        $augsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='August' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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

        $septsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='September' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $octsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='October' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $novsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='November' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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

        $decsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$facultyID AND month='December' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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

        $availableCat2 = array($availableC2, $febavailableC2, $marchavailableC2, $aprilavailableC2, $mayavailableC2, $juneavailableC2, $julyavailableC2, $augavailableC2, $septavailableC2, $octavailableC2, $novavailableC2, $decavailableC2);
        $consumed = array($consumed, $febconsumed, $marchconsumed, $aprilconsumed, $mayconsumed, $juneconsumed, $julyconsumed, $augconsumed, $septconsumed, $octconsumed, $novconsumed, $decconsumed);
        $expired = array($expired, $febexpired, $marchexpired, $aprilexpired, $mayexpired, $juneexpired, $julyexpired, $augexpired, $septexpired, $octexpired, $novexpired, $decexpired);


        return view('faculty.facultyReport', ['year' => $currentYear, 'total1' => $totalqty1,  'total2' => $totalqty2, 'available' => $available, 'decommissioned' => $decommissioned, 'repair' => $repair, 'availableCat2' => $availableCat2, 'consumed' => $consumed, 'expired' => $expired]);
    }



    public function sosFilterItem(Request $request)
    {
        $dropdown = $request->input('dropdown');
        $category = $request->input('category');
        $state  = $request->input('state');
        $year = $request->input('year');
        $staffID = $request->input('staffID');


        $cate = 0;
        $query = "";


        if ($category == "Equipment") {
            $cate = 1;
            if ($state == "Available") {
                $query = "available_qty";
            } else if ($state == "Unavailable - Decomissioned") {
                $query = "unavailable1_qty";
            } else if ($state == "Unavailable - In repair") {
                $query = "unavailable2_qty";
            }
        } else {
            $cate = 2;
            if ($state == "Available") {
                $query = "available_qty";
            } else if ($state == "Consumed") {
                $query = "unavailable1_qty";
            } else if ($state == "Expired") {
                $query = "unavailable2_qty";
            }
        }


        $records = DB::select("SELECT item.itemid, item_name, quantity, sum(qty_transferred) as totaltransfer, sum($query) as mema, month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND item.staffID =? AND category.categoryID = ? AND month=? AND year =?  GROUP BY item.itemid, item.item_name, item.quantity, item_last_checked.month, item_last_checked.year", [$staffID, $cate, $dropdown, $year]);
        return view('filter.staff_filter_item', ['records' => $records, 'state' => $state]);
    }


    public function adminFilterItem(Request $request)
    {
        $dropdown = $request->input('dropdown');
        $category = $request->input('category');
        $state  = $request->input('state');
        $year = $request->input('year');

        
        $cate = 0;
        $query = "";


        if ($category == "Equipment") {
            $cate = 1;
            if ($state == "Available") {
                $query = "available_qty";
            } else if ($state == "Unavailable - Decomissioned") {
                $query = "unavailable1_qty";
            } else if ($state == "Unavailable - In repair") {
                $query = "unavailable2_qty";
            }
        } else {
            $cate = 2;
            if ($state == "Available") {
                $query = "available_qty";
            } else if ($state == "Consumed") {
                $query = "unavailable1_qty";
            } else if ($state == "Expired") {
                $query = "unavailable2_qty";
            }
        }

       

// $records = DB::select("SELECT item.itemid, item_name, quantity, sum(qty_transferred) as totaltransfer, sum($query) as mema, month, year
//     FROM item, category, item_transfer, item_last_checked, item_state
//     WHERE category.categoryID = item.categoryID
//         AND item.itemid = item_transfer.itemID
//         AND item_transfer.recordno = item_state.recordno
//         AND item_state.checkedID = item_last_checked.checkedID
//         AND item.staffID = ?
//         AND category.categoryID = ?
//         AND month = ?
//         AND year = ?
//     GROUP BY item.itemid, item.item_name, item.quantity, item_last_checked.month, item_last_checked.year", [$cate, $dropdown, $year]);

        
        $records = DB::select("SELECT item.itemid, item_name, quantity, sum(qty_transferred) as totaltransfer, sum($query) as mema, month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND category.categoryID = ? AND month=? AND year =?  GROUP BY item.itemid, item.item_name, item.quantity, item_last_checked.month, item_last_checked.year", [$cate, $dropdown, $year]);
        return view('filter.staff_filter_item', ['records' => $records, 'state' => $state]);
    }
}
