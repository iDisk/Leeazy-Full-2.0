<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\StartingSubmarketDataTable;
use App\Models\StartingSubmarket;
use App\Models\StartingCities;
use Validator;
use App\Http\Helpers\Common;


class StartingSubmarketController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }
    
    public function index(StartingSubmarketDataTable $dataTable)
    {
        return $dataTable->render('admin.startingSubmarket.view');
    }


    public function add(Request $request)
    {
        if (! $request->isMethod('post')) {

            $submarket = StartingCities::all();
           
            foreach($submarket as $items){
                $consulta[$items->id]=$items->name;
            }

            $data['result'] = $consulta;
         
            return view('admin.startingSubmarket.add', $data);

        } elseif ($request->isMethod('post')) {
            $rules = array(
                    'name'    => 'required|max:100',
                    'city'   => 'required',
                    'status'  =>'required'
                    );

            $fieldNames = array(
                        'name'    => 'Starting Submarket Name',
                        'city'   => 'City',
                        'status'  =>'Status'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);


            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {

                $starting_submarket = new StartingSubmarket;

                $starting_submarket->city_id = $request->city;
                $starting_submarket->name  = $request->name;
                $starting_submarket->status=$request->status;

                $starting_submarket->save();

                $this->helper->vrCacheForget('vr-submarket');

                $this->helper->one_time_message('success', 'Added Successfully');
                return redirect('admin/settings/starting-submarket');
            }
        } else {
            return redirect('admin/settings/starting-submarket');
        }
    }

    public function update(Request $request)
    {
        if (! $request->isMethod('post')) {
            $submarket = StartingCities::all();
            $data['result'] = StartingSubmarket::find($request->id);

            foreach($submarket as $items){
                $consulta[$items->id]=$items->name;
            }

            $data['cities'] =$consulta;

            
             return view('admin.startingSubmarket.edit', $data);
        } elseif ($request->isMethod('post')) {
            $rules = array(
                'city'   => 'required',
                'name'    => 'required|max:100',
                'status'  =>'required'
                );

            $fieldNames = array(
                    'city'   => 'City',
                    'name'    => 'Starting City Name',
                    'status'  =>'Status'
                    );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $starting_submarket =StartingSubmarket::find($request->id);
                $starting_submarket->city_id  = $request->city;
                $starting_submarket->name  = $request->name;
                $starting_submarket->status= $request->status;
                $starting_submarket->save();

                $this->helper->vrCacheForget('vr-submarket');

                $this->helper->one_time_message('success', 'Updated Successfully');
                return redirect('admin/settings/starting-submarket');
            }
        } else {
            return redirect('admin/settings/starting-submarket');
        }
    }

    public function delete(Request $request)
    {
        if (env('APP_MODE', '') != 'test') {

            StartingSubmarket::find($request->id)->delete();

            $this->helper->vrCacheForget('vr-submarket');

            $this->helper->one_time_message('success', 'Deleted Successfully');
        }
        
        return redirect('admin/settings/starting-submarket');
    }
}
