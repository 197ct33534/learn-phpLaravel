<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Phone;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    public function phone()
    {
        return $this->hasOne(Phone::class, 'user_id', 'id');
    }
    public function getAllUsers($filters = [], $keywords = null, $sortArr = null, $perpage = 0)
    {
        // DB::enableQueryLog();

        // $users = DB::select('SELECT * FROM ' . $this->table . ' ORDER BY create_at DESC');
        $users = DB::table($this->table)
            ->select('users.*', 'groups.name as group_name')
            ->join('groups', 'users.group_id', '=', 'groups.id');
        $orderBy = 'users.create_at';
        $orderType = 'asc';

        if (!empty($sortArr) && is_array($sortArr)) {
            if (!empty($sortArr['sortBy']) && !empty($sortArr['sortType'])) {
                $orderBy = 'users.' . trim($sortArr['sortBy']);
                $orderType = trim($sortArr['sortType']);
            }
        }
        $users = $users->orderBy($orderBy, $orderType);


        if (!empty($filters)) {
            $users = $users->where($filters);
        }
        if (!empty($keywords)) {
            $users = $users->where(function ($query) use ($keywords) {
                $query->orWhere('fullname', 'like', '%' . $keywords . '%');
                $query->orWhere('email', 'like', '%' . $keywords . '%');
            });
        }
        // $users = $users->get();
        if (!empty($perpage)) {
            $users = $users->paginate($perpage)->withQueryString();
        } else {
            $users = $users->get();
        }

        // $sql = DB::getQueryLog();

        // dd($sql);
        return $users;
    }
    public function addUser($data)
    {
        // DB::insert('INSERT INTO ' . $this->table . ' (fullname, email, create_at) values (?, ?, ?)', $data);
        return DB::table($this->table)->insert($data);
    }
    public function getDetails($id)
    {
        return DB::select('SELECT * FROM ' . $this->table . ' WHERE id = ?', [$id]);
    }
    public function updateUser($data, $id)
    {

        // $data[] = $id;
        // return DB::update('UPDATE  ' . $this->table . ' SET fullname = ?, email = ?, updated_at = ? WHERE id = ?', $data);
        return DB::table($this->table)->where('id', $id)->update($data);
    }

    public function deleteUser($id)
    {
        // return DB::delete('DELETE FROM ' . $this->table . ' WHERE id = ?', [$id]);
        return DB::table($this->table)->where('id', $id)->delete();
    }
    public function statement($sql)
    {
        return DB::statement($sql);
    }

    public function learnQueryBuilder()
    {
        DB::enableQueryLog();
        $id = 3;
        // lấy tất cả bản ghi
        // $lists = DB::table($this->table)
        //     ->select('id', 'fullname as hoten', 'email')
        // and
        // ->where('id', '>', 1)
        // ->where('id', '<', 3)

        // ->where(['id', '>=', 1], ['id', '<=', 2])

        // ->where('id', '=', 1)
        // ->where(function ($query) use ($id) {
        //     $query->where('id', '<', $id);
        //     $query->where('id', '>', $id);
        // })

        // ->where('fullname', 'like', '%Nghĩa%')

        // ->whereNotBetween('id', [2, 3])

        // ->whereIn('id', [1, 3])

        // ->whereNull('updated_at')
        // ->whereDate('updated_at', '2022-08-20')
        // ->whereMonth('updated_at', '2022-07-13')
        // ->whereColumn('updated_at', '>', 'create_at')
        // ->get();

        // join bảng
        // $lists = DB::table($this->table)
        //     ->select('users.*', 'groups.name as group_name')
        //     ->leftJoin('groups', 'users.group_id', '=', 'groups.id')
        //     ->get();
        // ->toSql();
        // $sql = DB::getQueryLog();
        // dd($sql);

        //sắp xếp
        // $lists = DB::table($this->table)
        //     // ->orderBy('id', 'desc')
        //     ->inRandomOrder()
        //     ->get();

        // truy vấn theo nhóm
        // $lists = DB::table($this->table)
        //     ->select(DB::raw('count(fullname) as SL'), 'fullname', 'email')
        //     ->groupBy('fullname', 'email')
        //     ->having('SL', '>', '1')
        //     ->get();
        // limit offset
        // $lists = DB::table($this->table)
        //     ->select('id', 'fullname', 'email')
        //     ->offset(2)
        //     ->limit(2)
        //     ->get();

        // $status = DB::table($this->table)
        //     ->insert([
        //         'fullname' => 'Nguyễn văn A',
        //         'email' => 'nguyenvana@gmail.com',
        //         'group_id' => 2,
        //         'create_at' => date('Y-m-d H:i:s')
        //     ]);
        // dd($status);// insert trả về true false

        // $lastId = DB::getPdo()->lastInsertId();// trả về id

        // $status = DB::table($this->table)
        //     ->insertGetId([
        //         'fullname' => 'Nguyễn văn A',
        //         'email' => 'nguyenvana@gmail.com',
        //         'group_id' => 2,
        //         'create_at' => date('Y-m-d H:i:s')
        //     ]);
        // dd($status);// insert sau đó trả về id

        // $status = DB::table($this->table)
        //     ->where('id', 7)
        //     ->update([
        //         'fullname' => 'Nguyễn văn b',
        //         'email' => 'nguyenvanb@gmail.com',
        //         'group_id' => 2,
        //         'updated_at' => date('Y-m-d H:i:s')
        //     ]);
        // $status =    DB::table($this->table)->whereIn('id', [5, 6, 8, 9])->delete();
        // dd($status);
        // đếm số bản ghi
        // $lists = DB::table($this->table)->where('id', '>', 3)->count();

        $lists = DB::table($this->table)
            // ->where('group_id', '=', function ($query) {
            //     $query->select('id')->from('groups')->where('name', 'admin');
            // })->get();

            ->select('email', DB::raw('(SELECT count(id) FROM `groups`) as group_count'))
            ->get();

        $sql = DB::getQueryLog();

        dd($sql);
        // dd($lists);
        // // lấy 1 bản ghi đầu tiện
        // $detail = DB::table($this->table)->first();
        // dd($detail->fullname);
    }
}
