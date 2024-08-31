<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function staff_Dashboard()
    {

        $currentMonth = Carbon::now()->format('F');
        $currentYear = Carbon::now()->year;
        $sosID = Session::get('sosId');

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
        if (count($totalfetch1) > 0) {
            $totalfetch1 =  $totalfetch1[0];
            $totalqty1  =  $totalfetch1->totalqty;
        } else {
            $totalqty1 = 0;
        }


        $totaldata1 = DB::select("SELECT item.categoryID,  sum(qty_transferred) as totaltransfer FROM item, category, supply_office_staff, item_transfer WHERE item.itemid = item_transfer.itemID AND category.categoryID = item.categoryID AND supply_office_staff.staffID=item.staffID AND category.categoryID= 1 AND supply_office_staff.staffID = $sosID GROUP BY category.categoryID, item.categoryID");
        if (count($totaldata1) > 0) {
            $totaldata1 = $totaldata1[0];
            $totaltransfer = $totaldata1->totaltransfer;
        } else {
            $totaltransfer = 0;
        }

        $remainder = $totalqty1 - $totaltransfer;





        $totalfetch2 = DB::select("SELECT item.categoryID, category_name, sum(quantity) as totalqty FROM item, category, supply_office_staff WHERE category.categoryID = item.categoryID AND supply_office_staff.staffID=item.staffID AND category.categoryID= 2 AND supply_office_staff.staffID = $sosID GROUP BY category.categoryID, item.categoryID,category.category_name");
        if (count($totalfetch2) > 0) {
            $totalfetch2 =  $totalfetch2[0];
            $totalqty2  =  $totalfetch2->totalqty;
        } else {
            $totalqty2 = 0;
        }



        $totaldata2 = DB::select("SELECT item.categoryID,  sum(qty_transferred) as totaltransfer FROM item, category, supply_office_staff, item_transfer WHERE item.itemid = item_transfer.itemID AND category.categoryID = item.categoryID AND supply_office_staff.staffID=item.staffID AND category.categoryID= 2 AND supply_office_staff.staffID = $sosID GROUP BY category.categoryID, item.categoryID");
        if (count($totaldata2) > 0) {
            $totaldata2 = $totaldata2[0];
            $totaltransfer2 = $totaldata2->totaltransfer;
        } else {
            $totaltransfer2 = 0;
        }

        $remainder2 = $totalqty2 - $totaltransfer2;



        return view('staff.staffDashboard', ['available' => $available, 'decommissioned' => $decommissioned, 'repair' => $repair, 'availableCat2' =>  $available2, 'consumed' =>  $consumed, 'expired' => $expired, 'remainder' => $remainder, 'totalqty1' => $totalqty1, 'totaltransfer' => $totaltransfer, 'remainder2' =>  $remainder2, 'totalqty2' => $totalqty2, 'totaltransfer2' => $totaltransfer2]);

        // return view('staff.staffDashboard', ['records' => $records]);


    }


    public function manageFaculty()
    {
        $staffId = Session::get('sosId');

        $staffs = DB::select('SELECT facultyID, dep_name, faculty_name, faculty_username, faculty_password, room_no, room_name FROM faculty_incharge, department WHERE faculty_incharge.departmentno = department.departmentno  AND staffID=?', [$staffId]);
        $departments = DB::select('SELECT * FROM Department');

        return view('staff.manageFaculty', ['staffs' => $staffs, 'departments' => $departments]);
    }



    public function addFacultyIncharge(Request $request)
    {
        $staffId = Session::get('sosId');

        $employno = $request->input('employno');
        $depno = $request->input('depno');
        $name = $request->input('name');
        $username = $request->input('username');
        $password = $request->input('password');
        $roomno = $request->input('roomno');
        $roomname = $request->input('roomname');


        $customMessages = [
            'required' => 'The :attribute field can not be blank',
            'email' => 'The :attribute field invalid format',
        ];


        $rules = [
            'employno' => 'required',
            'name' => 'required',
            'username' => 'required|min:6',
            'password' => 'required|min:6',
            'roomno' => 'required',
            'roomname' => 'required',
        ];

        $this->validate($request, $rules, $customMessages);

        $insert = DB::insert('insert into faculty_incharge (facultyID, 	departmentno, staffID, faculty_name, faculty_username, faculty_password, room_no, room_name) values (?, ?, ?, ?, ?, ?, ?, ?)', [$employno, $depno, $staffId, $name, $username, $password, $roomno, $roomname]);
        if ($insert) {
            return redirect()->route('staff.manageFaculty');
        }
    }


    public function deleteFaculty($id)
    {
        $admins = DB::delete('delete from faculty_incharge where facultyID=?', [$id]);
        return redirect()->route('staff.manageFaculty');
    }

    public function editFaculty($id)
    {
        $faculty = DB::select('select * from faculty_incharge where facultyID=?', [$id]);
        $departments = DB::select('SELECT * FROM Department');
        $faculty = $faculty[0];

        $facultyId = $faculty->facultyID;
        $depno = $faculty->departmentno;
        $name = $faculty->faculty_name;
        $username = $faculty->faculty_username;
        $password = $faculty->faculty_password;
        $roomno = $faculty->room_no;
        $roomname = $faculty->room_name;
        return view('staff.facultyUpdate', ['departments' => $departments, 'facultyId' =>  $facultyId, 'depno' => $depno, 'name' => $name, 'username' => $username, 'password' => $password, 'roomno' => $roomno, 'roomname' => $roomname]);
        //return view('admin.adminDashboard');
    }


    public function updatefaculty(Request $request, $id)
    {
        $depno = $request->input('depno');
        $name = $request->input('name');
        $username = $request->input('username');
        $password = $request->input('password');
        $roomno = $request->input('roomno');
        $roomname = $request->input('roomname');


        $customMessages = [
            'required' => 'The :attribute field can not be blank',
            'email' => 'The :attribute field invalid format',
        ];


        $rules = [
            'name' => 'required',
            'username' => 'required|min:6',
            'password' => 'required|min:6',
            'roomno' => 'required',
            'roomname' => 'required',

        ];

        $this->validate($request, $rules, $customMessages);

        $update = DB::update('update faculty_incharge set departmentno = ?, faculty_name = ?, faculty_username = ?, faculty_password = ?, room_no = ? , room_name = ? where facultyID = ?', [$depno, $name, $username, $password, $roomno, $roomname, $id]);
        if ($update) {
            return redirect()->route('staff.manageFaculty');
        }
    }


    public function manageItem()
    {
        $staffId = Session::get('sosId');
        $items = DB::select('select itemid, staffID,  category_name, item_name, serialno, item_desc, cost, date_purchased, quantity, item.categoryID from item, category WHERE item.categoryID = category.categoryID AND staffID=?', [$staffId]);
        $categories = DB::select('SELECT * FROM Category');
        return view('staff.manageItem', ['categories' => $categories, 'items' => $items]);
    }


    public function addItem(Request $request)
    {
        $staffId = Session::get('sosId');

        $categoryno = $request->input('categoryno');
        $name = $request->input('name');
        $serialno = $request->input('serialno');
        $description = $request->input('description');
        $cost = $request->input('cost');
        $quantity = $request->input('quantity');
        $d8_purchased = $request->input('d8_purchased');


        $customMessages = [
            'required' => 'The :attribute field can not be blank',
        ];

        $rules = [
            'categoryno' => 'required',
            'name' => 'required',
            'serialno' => 'required',
            'description' => 'required',
            'cost' => 'required',
            'quantity' => 'required',
            'd8_purchased' => 'required',
        ];


        $this->validate($request, $rules, $customMessages);

        $insert = DB::insert('insert into item (categoryID, staffID, item_name, serialno, item_desc, cost, date_purchased, quantity) values (?, ?, ?, ?, ?, ?, ?, ?)', [$categoryno, $staffId, $name, $serialno, $description, $cost, $d8_purchased, $quantity]);
        if ($insert) {
            return redirect()->route('staff.manageItem');
        }
    }

    public function deleteItem($id)
    {
        $admins = DB::delete('delete from item where itemid=?', [$id]);
        return redirect()->route('staff.manageItem');
    }

    public function editItem($id)
    {
        $item = DB::select('select * from item where itemid=?', [$id]);
        $categories = DB::select('SELECT * FROM Category');
        $item = $item[0];


        $itemId = $item->itemid;
        $categoryno = $item->categoryID;
        $name = $item->item_name;
        $serialno = $item->serialno;
        $description = $item->item_desc;
        $cost = $item->cost;
        $d8_purchased = $item->date_purchased;
        $quantity = $item->quantity;

        return view('staff.itemUpdate', ['categories' => $categories, 'itemId' => $itemId, 'categoryno' => $categoryno, 'name' =>  $name, 'serialno' => $serialno, 'description' => $description, 'cost' => $cost, 'd8_purchased' => $d8_purchased, 'quantity' => $quantity]);
        //return view('admin.adminDashboard');
    }




    public function updateItem(Request $request, $id)
    {
        $staffId = Session::get('sosId');

        $categoryno = $request->input('categoryno');
        $name = $request->input('name');
        $serialno = $request->input('serialno');
        $description = $request->input('description');
        $cost = $request->input('cost');
        $quantity = $request->input('quantity');
        $d8_purchased = $request->input('d8_purchased');


        $customMessages = [
            'required' => 'The :attribute field can not be blank',
        ];

        $rules = [
            'categoryno' => 'required',
            'name' => 'required',
            'serialno' => 'required',
            'description' => 'required',
            'cost' => 'required',
            'quantity' => 'required',
            'd8_purchased' => 'required',
        ];


        $this->validate($request, $rules, $customMessages);
        $insert = DB::insert('Update item  set categoryID = ?, item_name = ?, serialno = ?, item_desc = ?, cost =?, date_purchased = ?, quantity = ? where itemid =?', [$categoryno, $name, $serialno, $description, $cost, $d8_purchased, $quantity, $id]);
        if ($insert) {
            return redirect()->route('staff.manageItem');
        }
    }


    public function transferItem()
    {
        $staffId = Session::get('sosId');

        $faculties = DB::select('select facultyID, dep_name, faculty_name, room_no from faculty_incharge, department WHERE department.departmentno = faculty_incharge.departmentno AND staffID=?', [$staffId]);
        $items = DB::select('select  itemid, category_name, item_name, date_purchased, quantity FROM item, category WHERE item.categoryID = category.categoryID AND staffID =?', [$staffId]);
        $records = DB::select('select recordno, item.itemid, category_name, item_name, faculty_incharge.facultyID, dep_name, faculty_name, room_no, date_transferred, qty_transferred FROM item, category, faculty_incharge, item_transfer, department WHERE item.itemid=item_transfer.itemID AND category.categoryID=item.categoryID AND faculty_incharge.facultyID=item_transfer.facultyID AND department.departmentno=faculty_incharge.departmentno AND faculty_incharge.staffID = item.staffID AND item.staffID =?', [$staffId]);

        $addItems = DB::select("SELECT itemid, CONCAT (item_name, ' : Quantity = ', quantity ) as itemquan FROM item WHERE staffID=?", [$staffId]);
        $addFacs = DB::select("SELECT facultyID, faculty_name FROM faculty_incharge WHERE staffID=?", [$staffId]);

        return view('staff.transferItem', ['faculties' => $faculties, 'items' => $items, 'records' => $records, 'addItems' => $addItems, 'addFacs' => $addFacs]);
    }


    public function addTransfer(Request $request)
    {

        $itemID = $request->input('itemID');
        $facultyID = $request->input('facultyID');
        $d8_transfer = $request->input('d8_transfer');
        $qty_transferred = $request->input('qty_transferred');


        $customMessages = [
            'required' => 'The :attribute field can not be blank',
        ];

        $rules = [
            'd8_transfer' => 'required',
            'qty_transferred' => 'required',
        ];

        $this->validate($request, $rules, $customMessages);
        $item = DB::select('SELECT * FROM item WHERE itemid=? LIMIT 1', [$itemID]);
        $item = $item[0];
        $qty1 = $item->quantity;
        $name = $item->item_name;

        if ($qty_transferred <= 0) {
            return redirect()->back()->withErrors(['The item quantity should be greater than zero. Try again!']);
        } else if ($qty_transferred <= $qty1) {

            $insert = DB::insert('INSERT INTO item_transfer (itemID, facultyID, date_transferred, qty_transferred) values (?, ?, ?, ?)', [$itemID, $facultyID, $d8_transfer, $qty_transferred]);
            if ($insert) {
                return redirect()->route('staff.transferItem');
            }
        } else {
            return redirect()->back()->withErrors(["The item $name only have quantity of $qty1, which inadequate for the quantity ($qty_transferred) of the item being transferred. Try again!"]);
        }
    }


    public function deleteTransfer($id)
    {
        $records = DB::delete('delete from item_transfer where recordno=?', [$id]);
        return redirect()->route('staff.transferItem');
    }



    public function editTransfer($id)
    {
        $staffId = Session::get('sosId');

        $itemT = DB::select('Select * from item_transfer where recordno=?', [$id]);
        $addItems = DB::select("SELECT itemid, CONCAT (item_name, ' : Quantity = ', quantity ) as itemquan FROM item WHERE staffID=?", [$staffId]);
        $addFacs = DB::select("SELECT facultyID, faculty_name FROM faculty_incharge WHERE staffID=?", [$staffId]);

        $itemT = $itemT[0];
        $recordno = $itemT->recordno;
        $itemID = $itemT->itemID;
        $facultyID = $itemT->facultyID;
        $date_transferred = $itemT->date_transferred;
        $qty_transferred = $itemT->qty_transferred;


        return view('staff.updateTransfer', ['addItems' => $addItems, 'addFacs' =>  $addFacs, 'recordno' => $recordno, 'itemID' => $itemID, 'facultyID' => $facultyID, 'date_transferred' => $date_transferred, 'qty_transferred' => $qty_transferred]);
        //return view('admin.adminDashboard');
    }


    public function updateTransfer(Request $request, $id)
    {

        $itemID = $request->input('itemID');
        $facultyID = $request->input('facultyID');
        $d8_transfer = $request->input('d8_transfer');
        $qty_transferred = $request->input('qty_transferred');

        $customMessages = [
            'required' => 'The :attribute field can not be blank',
        ];

        $rules = [
            'd8_transfer' => 'required',
            'qty_transferred' => 'required',
        ];

        $this->validate($request, $rules, $customMessages);
        $item = DB::select('SELECT * FROM item WHERE itemid=? LIMIT 1', [$itemID]);
        $item = $item[0];
        $qty1 = $item->quantity;
        $name = $item->item_name;

        if ($qty_transferred <= 0) {
            return redirect()->back()->withErrors(['The item quantity should be greater than zero. Try again!']);
        } else if ($qty_transferred <= $qty1) {
            $insert = DB::update('Update item_transfer set itemID = ?, facultyID = ?, date_transferred = ?, qty_transferred = ? where recordno = ?', [$itemID, $facultyID, $d8_transfer, $qty_transferred, $id]);
            if ($insert) {
                return redirect()->route('staff.transferItem');
            }
        } else {
            return redirect()->back()->withErrors(["The item $name only have quantity of $qty1, which inadequate for the quantity ($qty_transferred) of the item being transferred. Try again!"]);
        }
    }


    public function viewFacultyR($id)
    {
        $records = DB::select("select recordno, item.itemid, category_name, item_name, item_desc, dep_name,  room_no, date_transferred, qty_transferred, category.categoryID FROM item, category, faculty_incharge, item_transfer, department WHERE item.itemid=item_transfer.itemID AND category.categoryID=item.categoryID AND faculty_incharge.facultyID=item_transfer.facultyID AND department.departmentno=faculty_incharge.departmentno AND faculty_incharge.staffID = item.staffID AND faculty_incharge.facultyID =?", [$id]);
        $faculty = DB::select("SELECT * from faculty_incharge WHERE facultyID=?", [$id]);
        $faculty = $faculty[0];
        $name = $faculty->faculty_name;
        $facultyid = $faculty->facultyID;


        $currentMonth = Carbon::now()->format('F');
        $currentYear = Carbon::now()->year;
        $sql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='January' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $sqlfeb1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='February' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");

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


        $marchsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='March' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $aprilsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='April' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $maysql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='May' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $junesql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='June' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $julysql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='July' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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

        $augsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='August' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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

        $septsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='September' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $octsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='October' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $novsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='November' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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

        $decsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='December' AND year =$currentYear AND category.categoryID= 1 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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

        $sql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='January' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $sqlfeb1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='February' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $marchsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='March' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $aprilsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='April' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $maysql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='May' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $junesql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='June' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $julysql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='July' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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

        $augsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='August' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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

        $septsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='September' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $octsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='October' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $novsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='November' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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

        $decsql1 = DB::select("SELECT sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty , month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND facultyID =$id AND month='December' AND year =$currentYear AND category.categoryID= 2 GROUP BY category.categoryID, item_last_checked.month, item_last_checked.year");
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


        $totalfetch1 = DB::select("select sum(qty_transferred) as totaltrans FROM item, category, faculty_incharge, item_transfer WHERE item.itemid=item_transfer.itemID AND category.categoryID=item.categoryID AND faculty_incharge.facultyID=item_transfer.facultyID AND faculty_incharge.staffID = item.staffID AND faculty_incharge.facultyID=$id AND category.categoryID=1 GROUP BY category.categoryID");
        if (count($totalfetch1) > 0) {
            $totalfetch1 =  $totalfetch1[0];
            $totalqty1  =  $totalfetch1->totaltrans;
        } else {
            $totalqty1 = 0;
        }



        $totalfetch2 = DB::select("select sum(qty_transferred) as totaltrans FROM item, category, faculty_incharge, item_transfer WHERE item.itemid=item_transfer.itemID AND category.categoryID=item.categoryID AND faculty_incharge.facultyID=item_transfer.facultyID AND faculty_incharge.staffID = item.staffID AND faculty_incharge.facultyID=$id AND category.categoryID=2 GROUP BY category.categoryID");
        if (count($totalfetch2) > 0) {
            $totalfetch2 =  $totalfetch2[0];
            $totalqty2  =  $totalfetch2->totaltrans;
        } else {
            $totalqty2 = 0;
        }

        return view('staff.viewFacultyR', ['records' => $records, 'name' => $name, 'available' => $available, 'decommissioned' => $decommissioned, 'repair' => $repair, 'availableCat2' =>  $available2, 'consumed' =>  $consumed, 'expired' => $expired,  'totalqty1' => $totalqty1, 'totalqty2' => $totalqty2, 'facultyID' => $facultyid]);
    }


    public function viewFacultyChart($id, $recordno, $catID)
    {

        $query = DB::select("SELECT item_transfer.recordno, qty_transferred, item.itemid, item_name, category_name
        FROM item, category, item_transfer, item_last_checked, item_state
        WHERE category.categoryID = item.categoryID
            AND item.itemid = item_transfer.itemID
            AND item_transfer.recordno = item_state.recordno
            AND item_transfer.recordno = $recordno
            AND facultyID = $id
        GROUP BY item_transfer.recordno, item.itemid, qty_transferred, item_name, category_name
        ORDER BY item_state.recordno, item_transfer.qty_transferred");

        if (count($query) > 0) {
            $count = 1;
            $result = $query[0];
            $item_name = $result->item_name;
            $qty_transferred = $result->qty_transferred;





            $currentMonth = Carbon::now()->format('F');
            $currentYear = Carbon::now()->year;
            $sql1 = DB::select("SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year FROM item, category, item_transfer, item_last_checked, item_state WHERE category.categoryID = item.categoryID AND item.itemid = item_transfer.itemID AND item_transfer.recordno = item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND item_transfer.recordno = $recordno AND facultyID = $id AND month='January' AND year =$currentYear GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year ORDER BY item_state.recordno");
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


            $sqlfeb1 = DB::select("SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year FROM item, category, item_transfer, item_last_checked, item_state WHERE category.categoryID = item.categoryID AND item.itemid = item_transfer.itemID AND item_transfer.recordno = item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND item_transfer.recordno = $recordno AND facultyID = $id AND month='February' AND year =$currentYear GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year ORDER BY item_state.recordno");

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


            $marchsql1 = DB::select("SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year FROM item, category, item_transfer, item_last_checked, item_state WHERE category.categoryID = item.categoryID AND item.itemid = item_transfer.itemID AND item_transfer.recordno = item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND item_transfer.recordno = $recordno AND facultyID = $id AND month='March' AND year =$currentYear GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year ORDER BY item_state.recordno");
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


            $aprilsql1 = DB::select("SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year FROM item, category, item_transfer, item_last_checked, item_state WHERE category.categoryID = item.categoryID AND item.itemid = item_transfer.itemID AND item_transfer.recordno = item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND item_transfer.recordno = $recordno AND facultyID = $id AND month='April' AND year =$currentYear GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year ORDER BY item_state.recordno");
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


            $maysql1 = DB::select("SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year FROM item, category, item_transfer, item_last_checked, item_state WHERE category.categoryID = item.categoryID AND item.itemid = item_transfer.itemID AND item_transfer.recordno = item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND item_transfer.recordno = $recordno AND facultyID = $id AND month='May' AND year =$currentYear GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year ORDER BY item_state.recordno");
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


            $junesql1 = DB::select("SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year FROM item, category, item_transfer, item_last_checked, item_state WHERE category.categoryID = item.categoryID AND item.itemid = item_transfer.itemID AND item_transfer.recordno = item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND item_transfer.recordno = $recordno AND facultyID = $id AND month='June' AND year =$currentYear GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year ORDER BY item_state.recordno");
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


            $julysql1 = DB::select("SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year FROM item, category, item_transfer, item_last_checked, item_state WHERE category.categoryID = item.categoryID AND item.itemid = item_transfer.itemID AND item_transfer.recordno = item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND item_transfer.recordno = $recordno AND facultyID = $id AND month='July' AND year =$currentYear GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year ORDER BY item_state.recordno");
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

            $augsql1 = DB::select("SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year FROM item, category, item_transfer, item_last_checked, item_state WHERE category.categoryID = item.categoryID AND item.itemid = item_transfer.itemID AND item_transfer.recordno = item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND item_transfer.recordno = $recordno AND facultyID = $id AND month='August' AND year =$currentYear GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year ORDER BY item_state.recordno");
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

            $septsql1 = DB::select("SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year FROM item, category, item_transfer, item_last_checked, item_state WHERE category.categoryID = item.categoryID AND item.itemid = item_transfer.itemID AND item_transfer.recordno = item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND item_transfer.recordno = $recordno AND facultyID = $id AND month='September' AND year =$currentYear GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year ORDER BY item_state.recordno");
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


            $octsql1 = DB::select("SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year FROM item, category, item_transfer, item_last_checked, item_state WHERE category.categoryID = item.categoryID AND item.itemid = item_transfer.itemID AND item_transfer.recordno = item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND item_transfer.recordno = $recordno AND facultyID = $id AND month='October' AND year =$currentYear GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year ORDER BY item_state.recordno");
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


            $novsql1 = DB::select("SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year FROM item, category, item_transfer, item_last_checked, item_state WHERE category.categoryID = item.categoryID AND item.itemid = item_transfer.itemID AND item_transfer.recordno = item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND item_transfer.recordno = $recordno AND facultyID = $id AND month='November' AND year =$currentYear GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year ORDER BY item_state.recordno");
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

            $decsql1 = DB::select("SELECT item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year FROM item, category, item_transfer, item_last_checked, item_state WHERE category.categoryID = item.categoryID AND item.itemid = item_transfer.itemID AND item_transfer.recordno = item_state.recordno AND item_state.checkedID = item_last_checked.checkedID  AND item_transfer.recordno = $recordno AND facultyID = $id AND month='December' AND year =$currentYear GROUP BY item_transfer.recordno, item.itemid, item_name, category_name, available_qty, unavailable1_qty, unavailable2_qty, month, year ORDER BY item_state.recordno");
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

            $available = array($availablecount, $febavailablecount, $marchavailablecount, $aprilavailablecount, $mayavailablecount, $juneavailablecount, $julyavailablecount, $augavailablecount, $septavailablecount, $octavailablecount, $novavailablecount, $decavailablecount);
            $decommissioned = array($decomcount, $febdecomcount, $marchdecomcount, $aprildecomcount, $maydecomcount, $junedecomcount, $julydecomcount, $augdecomcount, $septdecomcount, $octdecomcount, $novdecomcount, $decdecomcount);
            $repair = array($repaircount, $febrepaircount, $marchrepaircount, $aprilrepaircount, $mayrepaircount, $junerepaircount, $julyrepaircount, $augrepaircount, $septrepaircount, $octrepaircount, $novrepaircount, $decrepaircount);

            if ($catID == 1) {

                return view('staff.viewEquipChartF', ['month' => $currentMonth, 'year' => $currentYear, 'available' => $available, 'decommissioned' => $decommissioned, 'repair' => $repair, 'pAvailable' => $juneavailablecount, 'pDecommissioned' => $junedecomcount, 'pRepair' =>  $junerepaircount, 'count' => $count, 'recordno' => $recordno, 'facultyID' => $id, 'item_name' => $item_name]);
            }else{
                return view('staff.viewSuppChartF', ['month' => $currentMonth, 'year' => $currentYear, 'available' => $available, 'decommissioned' => $decommissioned, 'repair' => $repair, 'pAvailable' => $juneavailablecount, 'pDecommissioned' => $junedecomcount, 'pRepair' =>  $junerepaircount, 'count' => $count, 'recordno' => $recordno, 'facultyID' => $id, 'item_name' => $item_name]);


            }
        } else {
            $count = 0;
            $item_name = '';
            $qty_transferred = 0;
            return view('staff.viewNone');
        }
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
