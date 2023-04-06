<?php

namespace App\DataTables;

use App\Models\StartingCities;
use App\Models\StartingSubmarket;
use Yajra\DataTables\Services\DataTable;

class StartingSubmarketDataTable extends DataTable
{
    protected $exportColumns = ['city_id', 'name'];

    public function ajax()
    {
        $startingCities ="";
     
        $startingSubmarket = $this->query();

        if(isset($startingSubmarket)){
            //$startingCities = $startingSubmarket[0];
        }
        
        
        return datatables()
            ->of($startingSubmarket)
            ->addColumn('city', function ($startingSubmarket) {
                $cities = StartingCities::where('id','=',$startingSubmarket->city_id)->first();
                return '<a target="_blank" href="' . url('admin/settings/edit-starting-submarket/' . $startingSubmarket->id) . '">'.$cities->name.'</a>';
            })
            ->addColumn('action', function ($startingSubmarket) {
                return '<a target="_blank" href="' . url('admin/settings/edit-starting-submarket/' . $startingSubmarket->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;<a href="' . url('admin/settings/delete-starting-submarket/' . $startingSubmarket->id) . '" class="btn btn-xs btn-danger delete-warning"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->addColumn('name', function ($startingSubmarket) {
                return '<a target="_blank" href="' . url('admin/settings/edit-starting-submarket/' . $startingSubmarket->id) . '">' . $startingSubmarket->name . '</a>';
            })
            ->rawColumns(['action','name','city'])
            ->make(true);
    }

    public function query()
    {
        $startingSubmarket = StartingSubmarket::select();
        return $this->applyScopes($startingSubmarket);
    }


    public function html()
    {
        return $this->builder()
        ->columns([
            'city',
            'name',
        ])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])
        ->parameters(dataTableOptions());
    }

    protected function filename()
    {
        return 'spacetypedatatables_' . time();
    }
}
