<?php

namespace App\Http\Controllers;

use App\Models\OperationLog;

class LogController extends Controller
{
    public function getLog()
    {
        $form = request()->only(['page', 'limit', 'manager', 'type', 'date']);

        $list = OperationLog::where(function ($query) use ($form) {
            $query->when(count($form['date'] ?: []), function ($query) use ($form) {
                $form['date'][0] = $form['date'][0] . ' 00:00:00';
                $form['date'][1] = $form['date'][1] . ' 23:59:59';
                $query->whereBetween('created_at', $form['date']);
            })
                ->when(count($form['type']), function ($query) use ($form) {
                    $query->whereIn('type', $form['type']);
                })
                ->when(count($form['manager']), function ($query) use ($form) {
                    $query->whereIn('manager_id', $form['manager']);
                });
        })->select('id', 'username', 'type', 'remark', 'ip', 'created_at');

        $total = $list->count();
        $list = $list->offset(($form['page'] - 1) * $form['limit'])
            ->limit($form['limit'])
            ->orderByDesc('id')
            ->get();
        

        return response(['code' => 200, 'data' => $list, 'total' => $total]);
    }
}
