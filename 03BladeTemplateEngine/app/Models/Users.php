<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    public function getAllUsers()
    {
        $users = DB::select('SELECT * FROM ' . $this->table . ' ORDER BY create_at DESC');
        return $users;
    }
    public function addUser($data)
    {
        DB::insert('INSERT INTO ' . $this->table . ' (fullname, email, create_at) values (?, ?, ?)', $data);
    }
    public function getDetails($id)
    {
        return DB::select('SELECT * FROM ' . $this->table . ' WHERE id = ?', [$id]);
    }
    public function updateUser($data, $id)
    {
        $data[] = $id;
        return DB::update('UPDATE  ' . $this->table . ' SET fullname = ?, email = ?, updated_at = ? WHERE id = ?', $data);
    }

    public function deleteUser($id)
    {
        return DB::delete('DELETE FROM ' . $this->table . ' WHERE id = ?', [$id]);
    }
    public function statement($sql)
    {
        return DB::statement($sql);
    }
}
