<?php

namespace App\Http\Controllers;
use Session;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StaffFilterController extends Controller
{
    
    public function staffFilterInventory()
    {
        $StaffId = Session::get('sosId');
        $currentMonth = Carbon::now()->format('F');
        $currentYear = Carbon::now()->year;

        $records = DB::select('SELECT item.itemid, item_name, quantity, sum(qty_transferred) as totaltransfer, sum(available_qty) as available_qty, sum(unavailable1_qty) as unavailable1_qty, sum(unavailable2_qty) as unavailable2_qty, month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND item.staffID =? AND category.categoryID = 1 AND month=? AND year=? GROUP BY item.itemid, item.item_name, item.quantity, item_last_checked.month, item_last_checked.year', [$StaffId, $currentMonth, $currentYear]);
        return view('staff.sFilterInventory', ['records' => $records,  'month' => $currentMonth, 'year' => $currentYear]);
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
        $records = DB::select('SELECT item.itemid, item_name, quantity, sum(qty_transferred) as totaltransfer, sum($query) as mema,  month, year FROM item, category, item_transfer, item_last_checked , item_state WHERE category.categoryID=item.categoryID AND item.itemid=item_transfer.itemID AND item_transfer.recordno=item_state.recordno AND item_state.checkedID = item_last_checked.checkedID AND category.categoryID = ? AND month=? AND year =? GROUP BY item.itemid, item.item_name, item.quantity, item_last_checked.month, item_last_checked.year' , [ $cate, $dropdown, $year]);
        return view('filter.staff_filter_item', ['records' => $records, 'state' => $state]);
    }

}
